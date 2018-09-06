<?php
class St extends CI_Controller
{

  function __construct(){
        parent::__construct();
        $this->load->helper('cookie');
    $this->load->library('encrypt');
    $this->load->helper('transactional_notification');
    $this->load->model('UserModel');
    $this->load->model('newsletter/Subscriber_Model');
    $this->load->model('Activity_Model');
    $this->load->model('newsletter/subscription_Model');
    $this->load->model('newsletter/contact_model');
        force_ssl();    
  }
  function index1($member_id,$emailaddress)
  {
      //Prepare member array from posted data
  
    
  }
  
    function register() {

           if($this->session->userdata('member_id')!=''){
      redirect('newsletter/campaign');
    }
        
    //$this->output->enable_profiler(TRUE);
    // Validation rules are applied
    $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
    $this->form_validation->set_rules('verifycheckbox', 'Terms of Service', 'required');

    //To check form is submitted
    
    if($this->input->post('btnRegister')!='' && $this->form_validation->run()){
         
      //Prepare member array from posted data
      $member_data = array(
           'member_username' => $this->input->post('username',true),
           'email_address' => $this->input->post('email',true),
           'member_password' => $this->is_authorized->hashPassword($this->input->post('password',true)),
           'ip_address'   =>  $this->is_authorized->getRealIpAddr(),
           'phone_number' => null,
          'first_name' => null,
          'last_name' => null,
          'address_line_1' => null,
          'address_line_2' => null,
          'city' => null,
          'state' => null,
          'zipcode' => null,
           'last_login_time'=>date("Y-m-d H:i:s"),
           'created_on'=>date("Y-m-d H:i:s"),
           'login_expiration_notification_date'=>NULL,
           'status'=>'unconfirmed',
           'company' => null,
          'autoresponder_status' => 0,
          'sign_up_form_status' => 0,
          'contact_import' => 0,
          'package_id' => 0,
          'is_authentic' => 0,
          'segment_size' => 0,
          'authenticated_on' =>NULL,
          'unauthentic_contacts' => 0,
          'reset_password_token' => '',
          'login_expiration_notification_date' =>NULL,
          'cancel_subscription_date' =>NULL
      );

      
      
      

      //check username exists by loading user from database
      $username_exists=$this->UserModel->get_user_data(array('member_username'=>$this->input->post('username',true),'is_deleted'=>0));
      //check email exists by loading email from database
      $email_exists=$this->UserModel->get_user_data(array('email_address'=>$this->input->post('email',true),'is_deleted'=>0));
      
      //check username or email exists
      if(count($username_exists)) {
        $this->messages->add('Username already exists', 'error');
      }elseif(count($email_exists)) {
        $this->messages->add('Email Address already exists', 'error');
      }elseif($this->UserModel->is_temp_mail($this->input->post('email',true))) {
        $this->messages->add('Please use your permanent email address', 'error');
      }else{
        //To insert user data in database
        $inserted_user_id=$this->UserModel->create_user($member_data);    
        // Fetch user data from database
        $user_data_array=$this->UserModel->get_user_data(array('member_id'=>$inserted_user_id));
        // To check user have credentails matching in database
        if(count($user_data_array)){
          $this->checkReferredMember($inserted_user_id,$member_data['member_username'],$member_data['email_address']);
          $max_quota = $this->UserModel->get_package_quota(-1);
          // submit free pckage for register user
          $member_package_id=$this->UserModel->insert_member_package(array(
          'member_id'=>$user_data_array[0]['member_id'],
          'package_id'=>-1, 'max_campaign_quota'=>$max_quota, 'credit_card_last_digit' =>NULL, 'expiration_date' =>NULL, 'card_holder_name' =>NULL, 'first_name' =>NULL, 'last_name' =>NULL, 'address' =>NULL, 'city' =>NULL, 'state' =>NULL, 'zip' =>NULL, 'country' =>NULL, 'subscription_id'=>NULL ));
          $this->UserModel->update_user(array('package_id'=>$member_package_id),array('member_id'=>$user_data_array[0]['member_id']));
          //Assign  session to user
          $this->session->set_userdata('member_id', $user_data_array[0]['member_id']);
          $this->session->set_userdata('member_username', $user_data_array[0]['member_username']);
          $this->session->set_userdata('member_email_address', $user_data_array[0]['email_address']);
          $this->session->set_userdata('member_autoresponder_status', $user_data_array[0]['autoresponder_status']);
          $this->session->set_userdata('user_packages_id', $member_package_id);
          $this->session->set_userdata('member_status','inactive');
          $this->session->set_userdata('member_time_zone',WEBMASTER_TIMEZONE);
          // fetch package information for set in session
          $user_packages=array();
          $user_packages_array=$this->UserModel->get_user_packages(array('member_id'=>$user_data_array[0]['member_id'],'is_deleted'=>0));
          //$this->is_authorized->saveCookieTocken($user_data_array[0]['member_id'], $user_data_array[0]['member_username']);

          foreach($user_packages_array as $package)
          $user_packages[]=$package['package_id'];
          $this->session->set_userdata('user_packages', $user_packages);
          // create default subscription
          $input_array=array('subscription_title'=>'All My Contacts', 'subscription_id'=>'-'.$this->session->userdata('member_id'), 'subscription_is_name'=>'1', 'subscription_created_by'=>$this->session->userdata('member_id'));
          
          // Sends form input data to database via model object
          $subscription_id=$this->subscription_Model->create_subscription($input_array);
          /**** Create default open contact list ****/
          $opencontactlistArray = array(
            'subscription_title'=>'Recently Opened',
            'subscription_created_by'=>$this->session->userdata('member_id'),
            'subscription_is_name'=>'1',
            'subscription_type'=>'1',
          );
          
          $opencontacts_id=$this->subscription_Model->create_subscription($opencontactlistArray);
          
          
          
          /**** Create default click contact list ****/
          $clickcontactlistArray = array(
            'subscription_title'=>'Recently Clicked',
            'subscription_created_by'=>$this->session->userdata('member_id'),
            'subscription_is_name'=>'1',
            'subscription_type'=>'2',
          );
          
          $clickcontacts_id=$this->subscription_Model->create_subscription($clickcontactlistArray);
          
          
          /**** Create default unresposive contact list ****/
          $unresponsivelistArray = array(
            'subscription_title'=>'Unresponsive',
            'subscription_created_by'=>$this->session->userdata('member_id'),
            'subscription_is_name'=>'1',
            'subscription_type'=>'3',
          );
          
          $unresponsive =$this->subscription_Model->create_subscription($unresponsivelistArray);
          // Sends form input data to database via model object
          $subscription_id=$this->subscription_Model->create_subscription($input_array);
          $thisIP = $this->is_authorized->getRealIpAddr();
          $this->Activity_Model->create_activity(array('user_id'=>$this->session->userdata('member_id'),'activity'=>'login:'.$thisIP  ));         
          $this->register_member_to_redcappi_account($this->session->userdata('member_id'));
          $this->user_confirmation_notification($inserted_user_id);
        }
      }
      print_r("ff");
    }

    //Get the messages
    $messages=$this->messages->get();

    $data = array('messages' =>$messages, 'title'=>"Registration - Email Marketing",'stform'=>'yes');
    //Load the  register  view
    $this->load->view('header_login',array('title'=>'Register','previous_page_url'=>$previous_page_url)); 
    $this->load->view('user/user_register',$data);
      
               
             
            
              
        }

  
function checkReferredMember($mid,$strUsername, $strEmail ){
            


                                  $siteid = $this->encrypt->decode($this->input->cookie('rc_ls_site_id'));
    $time_entered = $this->encrypt->decode($this->input->cookie('rc_ls_added_on'));
    If ($siteid != "") {
      $input_array['ls_site_id'] = $siteid;
      $input_array['ls_added_on'] = $time_entered;
    }
                
    $encodedTrackDetail = get_cookie('prc_rctrack');
    $decodedTrackDetail = $this->encrypt->decode($encodedTrackDetail);
    $arrTrackDetail = explode(':-:',$decodedTrackDetail);
    $thisSignupTime = $arrTrackDetail[0];
    $thisIp = $arrTrackDetail[1];
    $siteid = $arrTrackDetail[2]; 
    $this->db->query("update red_members set ls_site_id='$siteid' where member_id='$mid'");
                                  $ch_lead_source = '';
                                    If ($siteid != "") 
                                    {
                                            if ($siteid == 'google_adword')
                                            {
                                                $ch_lead_source = 'Google AdWords';
                                            }
                                            if ($siteid == 'capterra')
                                            {
                                                $ch_lead_source = 'Capterra';
                                            }
                                            if ($siteid == 'Powered by RedCappi Logo')
                                            {
                                                $ch_lead_source = 'Powered by RedCappi Email Logo';
                                            }

                                    }
                                    else
                                    {
                                        $ch_lead_source = 'Other';
                                    }
                         
                     

      }
      /**
    Send registration confirmation email
  **/
  function user_confirmation_notification($user_id,$redirect=""){
    if($this->session->userdata('member_id') == $user_id){
      // Fetch user data from database
      $user_data_array=$this->UserModel->get_user_data(array('member_id'=>$user_id));
      $to_email=$user_data_array[0]['email_address'];
      $to_username=$user_data_array[0]['member_username'];
      $user_password=$user_data_array[0]['member_password'];
      //$user_id=$this->is_authorized->base64UrlSafeEncode($user_id);
      $user_id=$this->is_authorized->encryptor('encrypt',$user_id);
      $user_info=array($user_id,$to_email,$to_username,$user_password);

      create_transactional_notification("confirm_user_registration",$user_info);
      if($redirect != "confirmation_msg"){
        redirect('newsletter/campaign/');
      }else{
        echo "success";
      }
    }else{
      die("success");
    }
  }

  /**
    function registration_notification to display notification message
  **/
  function registration_notification(){   
     
    
    $this->load->view('user/user_confirmation');
  }
        
        
                function usernameexists(){
                    
                    $username = $_REQUEST['email'];
                    $email = $username;
                    $password = $_POST['Password'];
                    
                    //print_r($username . $password);
                    
                         //check username exists by loading user from database
                        // print_r("in the usernameexists function");
                         $username_exists=$this->UserModel->get_user_data(array('member_username'=>$email,'is_deleted'=>0));
                        //check email exists by loading email from database
                        $email_exists=$this->UserModel->get_user_data(array('email_address'=>$email,'is_deleted'=>0));

                        //check username or email exists
                        if(count($username_exists)) {
                                                                print_r('Username already exists');
                                                               
                        }elseif(count($email_exists)) {
                                print_r('Email Address already exists');
                                                                    
                        }elseif($this->UserModel->is_temp_mail($this->input->post('email',true))) {
                                print_r('Please use your permanent email address');
                        
                        
                        }

                }

  function confirm_user($user_id=""){
    //$user_id=$this->is_authorized->base64UrlSafeDecode($user_id); // Decode user id
    $user_id=$this->is_authorized->encryptor('decrypt',$user_id);
    
    // Fetch user data from database
    $user_data_array=$this->UserModel->get_user_data(array('member_id'=>$user_id));
    // To check user have credentails matching in database
    if(count($user_data_array)){
     
      if($user_data_array[0]['status']=='unconfirmed'){
        $ip_address=$this->is_authorized->getRealIpAddr();
        $this->UserModel->update_user(array('ip_address'=>$ip_address,'last_login_time'=>date("Y-m-d H:i:s"),'login_expiration_notification_date'=>NULL,'status'=>'active','status_inactive_description'=>''),array('member_id'=>$user_data_array[0]['member_id']));
        // echo $this->db->last_query();
        //Assign  session to user
        $this->session->set_userdata('member_id', $user_data_array[0]['member_id']);
        $this->session->set_userdata('member_username', $user_data_array[0]['member_username']);
        $this->session->set_userdata('member_email_address', $user_data_array[0]['email_address']);
        $this->session->set_userdata('member_autoresponder_status', $user_data_array[0]['autoresponder_status']);
        $this->session->set_userdata('user_packages_id', $user_data_array[0]['package_id']);
        $this->session->set_userdata('member_status','active');
        $this->session->set_userdata('manage_campaigns', 1);            
        $this->session->set_userdata('manage_contacts', 1 );            
        $this->session->set_userdata('manage_stats', 1 );           
        $this->session->set_userdata('manage_autoresponders', 1);           
        $this->session->set_userdata('manage_signupforms', 1);
        $this->session->set_userdata('manage_extra', 1);
        // fetch package information for set in session
        $user_packages=array();
         
        $user_packages_array=$this->UserModel->get_user_packages(array('member_id'=>$user_data_array[0]['member_id'],'is_deleted'=>0));

        foreach($user_packages_array as $package)
        $user_packages[]=$package['package_id'];
        $this->session->set_userdata('user_packages', $user_packages);
        // create array for insert values in activty table
        $values=array('user_id'=>$this->session->userdata('member_id'), 'activity'=>'login:'.$ip_address);
        $this->Activity_Model->create_activity($values);
        $this->register_member_to_redcappi_account($user_id);
        redirect('newsletter/campaign');
      }else{
        $this->register_member_to_redcappi_account($user_id);
        redirect('/');
      }
    }else{
      redirect('/');
    }
  }

      function register_member_to_redcappi_account($user_id=0){
    

    $subscriber_created_by=157;

    //Get registered users from database
    $user_count=$this->UserModel->get_user_count(array('is_deleted'=>0,'member_id'=>$user_id));
    $users_array=$this->UserModel->get_user_data(array('is_deleted'=>0,'member_id'=>$user_id),$user_count);
    $signup_data=array();
    foreach($users_array as $user){
      $register_user=false;
      foreach($user as $key=>$value){
        if($key=="email_address"){
          if($value!=''){
            $signup_data['subscriber_email_address']=$value;
            $arrEmailExploded = explode( '@',$signup_data['subscriber_email_address'] );
            $signup_data['subscriber_email_domain'] = $arrEmailExploded[1];
            $register_user=true;
          }
        }
        if($register_user){
          if($key=="first_name"){
            $signup_data['subscriber_first_name']=$value;
          }
          if($key=="last_name"){
            $signup_data['subscriber_last_name']=$value;
          }
          if($key=="address_line_1"){
            $signup_data['subscriber_address']=$value;
          }
          if($key=="city"){
            $signup_data['subscriber_city']=$value;
          }
          if($key=="state"){
            $signup_data['subscriber_state']=$value;
          }
          if($key=="zipcode"){
            $signup_data['subscriber_zip_code']=$value;
          }
          if($key=="country_name"){
            $signup_data['subscriber_country']=$value;
          }
          if($key=="company"){
            $signup_data['subscriber_company']=$value;
          }
          
          //create subscriber
          $qry = "INSERT INTO red_email_subscribers SET ";
          $flds = '';
          foreach($signup_data as $key=>$val)  $flds .= $key . ' = \'' . mysql_real_escape_string($val) . '\', ';
          $flds .=  'subscriber_created_by = '.$subscriber_created_by ;
          $qry .=  $flds .' ON DUPLICATE KEY UPDATE ' . $flds . ', is_deleted = 0,subscriber_status=1,is_signup=1 , subscriber_id=LAST_INSERT_ID(subscriber_id)';
          $this->db->query($qry);
          $last_inserted_id = $this->db->insert_id();
          if($subscriber_created_by==157){
            $sublistid=122;
          }else{
            $sublistid=78;
          }
          if ($last_inserted_id > 0 and $sublistid > 0){
            $input_array=array('subscriber_id'=>$last_inserted_id,'subscription_id'=>$sublistid);
            $this->Subscriber_Model->replace_subscription_subscriber($input_array);
          }
        }
      }
    }
  }

}
/* End of file */
?>