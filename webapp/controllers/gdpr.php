<?php
class Gdpr extends CI_Controller
{

	function __construct(){
        parent::__construct();
        $this->load->model('GdprModel');
		force_ssl();		
	}
	function index($member_id,$emailaddress)
	{
	    //Prepare member array from posted data
	$member_data = array(
	    'member_id' => $member_id,
	    'email_address' => $emailaddress,
	    'ip'		=>	$this->is_authorized->getRealIpAddr(),
	    'date_time'=>	date("Y-m-d H:i:s")
	    );	
	    	$username_exists=$this->GdprModel->get_user_data($member_id,$emailaddress);
	    	if($username_exists<1)
	    	{
	    	 $this->GdprModel->create_user($member_data) ;  
	    	 $this->load->model('SeoModel');
		    $data['msg']="Thank you for consenting to GDPR!";
    	
    		//Loads header, About us and footer view.
    	
    		$this->load->view('gdpr',$data);
    	
                
	    	}
	    	else{
	    	  $data['msg']="Email Address already exist!";
    	
    		//Loads header, About us and footer view.
    	
    		$this->load->view('gdpr',$data);
    	
	    	    
	    	}
		
	}
	
    function exportcsv($subscription_id = 0) {
            //Check if user is not login then redirect to index page
            if ($this->session->userdata('member_id') == '')
                redirect('user/index');
                
              $filename = 'users_'.date('Ymd').'.csv'; 
               header("Content-Description: File Transfer"); 
               header("Content-Disposition: attachment; filename=$filename"); 
               header("Content-Type: application/csv; ");
               
               // get data 
               $usersData = $this->GdprModel->get_members_list($this->session->userdata('member_id'));

               // file creation 
               $file = fopen('php://output', 'w');
             
               $header = array("Id","Email","Date","Ip"); 
               fputcsv($file, $header);
               foreach ($usersData as $key=>$line){ 
                 fputcsv($file,$line); 
               }
               fclose($file); 
               exit; 
      
               
             
            
              
        }

	


}
/* End of file */
?>