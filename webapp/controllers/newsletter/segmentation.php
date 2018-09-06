<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Segmentation extends CI_Controller {

    /**
     * 	Contructor for controller.
     * 	It checks user session and redirects user if not logged in
     */
    private $confg_arr = array();

    function __construct() {
        parent::__construct();
        # check via common model
        if (!$this->is_authorized->check_user())
            redirect('user/index');

        # Create user's folders
        $this->is_authorized->createUserFiles();

        $this->load->model('newsletter/subscription_Model');
        $this->load->model('newsletter/segmentation_Model');
        $this->load->model('newsletter/Subscriber_Model');
        $this->load->model('newsletter/contact_model');
        $this->load->model('newsletter/Signup_Model');
        $this->load->model('newsletter/Campaign_Model');
        $this->load->model('newsletter/Subscription_subscriber_Model');

        $this->load->model('UserModel');
        $this->load->model('newsletter/Emailreport_Model');

        $this->output->enable_profiler(false);
        // Force SSL
        force_ssl();
        $this->load->model('ConfigurationModel');
        $this->confg_arr = $this->ConfigurationModel->get_site_configuration_data_as_array();
        if ($this->confg_arr['maintenance_mode'] != 'no') {
            redirect("/site_under_maintenance/");
            exit;
        }
    }

    /**
     * Function index
     *
     * 'Index' controller function for listing of subscriptions.
     *
     * @param (int) (subscription_id)  for displaying subscription selectable(blue color)  in view of subscription list
     */
    function index($subscription_id = 0, $scroll = 0, $action = "") {
		$customfields = array();
		$globalfields = array();
		$customArray = array();
		$globalArray = array();
		
		/*All Fixed fields*/
		$all_other_fields = array(
			'subscriber_email_address' => 'Email Address',
			'subscriber_first_name' => 'First Name',
			'subscriber_last_name' => 'Last Name',
			'subscriber_state' => 'State',
			'subscriber_country' => 'Country',
			'subscriber_company' => 'Company',
			'subscriber_city' => 'City',
			'subscriber_dob' => 'Birthday(mm/dd/yyyy)',
			'subscriber_phone' => 'Phone',
			'subscriber_address' => 'Address',
		);
		
		/*GET Custom fields*/
		$customfields = $this->Subscriber_Model->get_custom_field_segment('member_id = '.$this->session->userdata('member_id'));
		if(count($customfields)){
			$customArray = $customfields;
		}
		
		/*GET Global fields*/
		$globalfields =$this->Subscriber_Model->get_global_field_segment('member_id = '.$this->session->userdata('member_id'));
		if(count($globalfields)){
			$globalArray = $globalfields;
		}
		$otherfields = array();
		
		/* $otherfields = array(
			'last_clicked' => '	Last Clicked Date',
			'last_opened' => 'Last Opened Date'
		); */
		$allfields = array_merge($all_other_fields,$customArray,$globalArray,$otherfields);
		
		$recent_fields = array(
			'recently_opened' => 'Recently Opened',
			'recently_clicked' => 'Recently Clicked',
			'unresponsive' => 'Unresponsive',
		);
		

		$segmentArray = array();
		if($subscription_id){
			$getsegmentation = $this->subscription_Model->get_segmentation(array('subscription_created_by' => $this->session->userdata('member_id'),'subscription_id' => $subscription_id,));
			//echo '<pre>';print_r($getsegmentation);exit;
			foreach($getsegmentation as $key => $val){
				$subscription_title = $val['subscription_title'];
				$subscription_type = $val['subscription_type'];
				if($val['subscription_type'] == 5){
					$segmentArray = $val['segmentation'];
				}else{
					$recentArray = $val['segmentation'];
				}		
				
			}
			
		}
			//echo '<pre>';print_r($segmentArray);exit;
		
        /*** GET ALL THE FIELDS OF THE USERS ***/


        $this->load->view('header', array('title' => 'List Segmentation'));
        $this->load->view('contacts/segmentation', array('subscription_title'=>$subscription_title,'subscription_type'=>$subscription_type,'segmentdata' => $segmentArray,'allfields'=> $allfields,'subscription_id' => $subscription_id,'recent_fields'=> $recent_fields,'recentArray' => $recentArray));
        $this->load->view('footer');
    }
	
	
	
	/**
     * Function segment_create
     *
     * 'segment_create' controller function for creating segment.
     *
     * @param (int) (subscription_id)  for displaying subscription selectable(blue color)  in view of subscription list
     */
    function segment_create($subscription_id = 0) {
	
	if($_POST){
		/* EDIT MODE*/
		if($subscription_id > 0){

			if($_POST['seg_type'] == 6){
				
				$subscriptionArray = array(
					'subscription_title'=> $_POST['seg_title'],
					'subscription_type' => $_POST['seg_type']
				);
				$this->subscription_Model->update_subscription($subscriptionArray,array('subscription_id' => $subscription_id ));
				
				$getsegmentation = $this->subscription_Model->get_segmentation(array('subscription_id' => $subscription_id));
				$segmentData = $getsegmentation[$subscription_id]['segmentation'];
				//print_r($segmentData);
				
				$_POST['field_val'] = trim($_POST['field_val']);
				$segmentupdateArray['sg_segment_key'] = $_POST['field'];
				$segmentupdateArray['sg_segment_val'] = $_POST['field_val'];
				$segmentupdateArray['sg_subscription_id '] = $subscription_id;
				$segmentupdateArray['sg_segment_condition '] = 'is';
				$segmentupdateArray['sg_ref_id '] = 1;
				
				if(count($segmentData) > 1){
					$this->segmentation_Model->delete_segmentation(array('sg_subscription_id' => $subscription_id));
					$this->segmentation_Model->create_segmentation($segmentupdateArray);
				}else{
					
					/*Update the segment*/
					//$this->segmentation_Model->create_segmentation($segmentupdateArray);
					$this->segmentation_Model->update_segmentation($segmentupdateArray,array('sg_subscription_id' => $subscription_id));
				}
				

				/*
					delete all the data from subscription_subscriber
				*/ 
			
				$this->Subscription_subscriber_Model->delete_subscription_subscriber($subscription_id);

				$segmentdatafetchcondition = $this->subscription_Model->get_segmentation_data(array('subscription_id' => $subscription_id),$this->session->userdata('member_id'));

				$opensubscriber_data = $this->Subscriber_Model->get_recent_subscription_data($segmentdatafetchcondition);	
				
				
				foreach($opensubscriber_data as $sub => $subval){
					$subscriber_id = $subval['subscriber_id'];
					$subArray = array(
						'subscription_id' => $subscription_id,
						'subscriber_id' => $subscriber_id
					);
					$this->Subscription_subscriber_Model->create_subscription_subscriber($subArray);
				}
						
			
						

			}else{
				
				$getsegmentation = $this->subscription_Model->get_segmentation(array('subscription_id' => $subscription_id));
				
				$segmentData = $getsegmentation[$subscription_id]['segmentation']; 	
			
				$subscriptionArray = array(
					'subscription_title'=> $_POST[0]['seg_title'],
					'subscription_type' => $_POST[0]['seg_type']
				);
				$this->subscription_Model->update_subscription($subscriptionArray,array('subscription_id' => $subscription_id ));
					
							
				$segmentupdateArray = array();
				$segmentArray = array();
		
				if(count($segmentData)>0){
				$searcharray = (array_map(function($element) {
						  return $element['sg_ref_id'];
					}, $_POST));
					//print_r($searcharray);
				foreach($segmentData as $skey => $sval){
					if(!in_array($sval['sg_ref_id'],$searcharray)){
						$ref_id = $sval['sg_ref_id'];
						$this->segmentation_Model->delete_segmentation(array('sg_subscription_id' => $subscription_id,'sg_ref_id' => $ref_id));
					}else{
						continue;
					}
				}	
				
				$i = 1;
					$checkarray = (array_map(function($element) {
						  return $element['sg_ref_id'];
					}, $segmentData));
					$last = max($searcharray);
				
					foreach($_POST as $pkey => $pval){
					
						 //if(in_array($pval['sg_ref_id'],$checkarray)){
						if(array_key_exists('sg_ref_id',$pval)){
							//print_r($pval);
							$pval['fields_value'] = trim($pval['fields_value']);
							$pval['fields_value'] = htmlentities($pval['fields_value']);
							$segmentupdateArray['sg_segment_key'] = $pval['field'];
							$segmentupdateArray['sg_segment_val'] = $pval['fields_value'];
							$segmentupdateArray['sg_segment_condition '] = $pval['criteria_is'];
							//$segmentupdateArray['sg_ref_id'] = $i;
						
							$this->segmentation_Model->update_segmentation($segmentupdateArray,array('sg_subscription_id' => $subscription_id,'sg_ref_id' => $pval['sg_ref_id']));
						
							$jsonArray['subscription_id'] = $subscription_id;
							$jsonArray['status'] =  'success'; 
							$i = $last;
							
						}else{
							if($pval['fields_value'] != ''){
								$pval['fields_value'] = trim($pval['fields_value']);
								$pval['fields_value'] = htmlentities($pval['fields_value']);
								$segmentArray['sg_segment_key'] = $pval['field'];
								$segmentArray['sg_segment_val'] = $pval['fields_value'];
								$segmentArray['sg_segment_condition '] = $pval['criteria_is'];
								$segmentArray['sg_subscription_id '] = $subscription_id;
								$segmentArray['sg_ref_id'] = $i;
								//print_r($segmentArray);
							}	
							$this->segmentation_Model->create_segmentation($segmentArray); 
						} 
					$i++;	
					}
			} 
			/*
				delete all the data from subscription_subscriber
			*/ 
			
			$this->Subscription_subscriber_Model->delete_subscription_subscriber($subscription_id);
						
			/*
				Get updated segment criteria condition
				
			*/
			$segmentdatafetchcondition = $this->subscription_Model->get_segmentation_data(array('subscription_id' => $subscription_id),$this->session->userdata('member_id'));
			
			/*
				Get latest contact data as per the criteria
			*/
			
			$subscriptionData =  $this->Subscriber_Model->get_segment_subscription_data($segmentdatafetchcondition);
			
			/*	
				Insert contact data in red_email_subscription_subscriber
			*/
			
			 if(count($subscriptionData) > 0){
				foreach($subscriptionData as $sub => $subval){
					$subscriber_id = $subval['subscriber_id'];
					$subArray = array(
						'subscription_id' => $subscription_id,
						'subscriber_id' => $subscriber_id
					);
					$this->Subscription_subscriber_Model->create_subscription_subscriber($subArray);
					
				}
			} 
			}
			$jsonArray['subscription_id'] = $subscription_id;
			$jsonArray['status'] =  'success';
		
			echo json_encode($jsonArray);
			exit;
		
			
		}else{/*INSERT MODE*/
		
	
			if($_POST['seg_type'] == 6){
				
				$subscriptionArray = array(
						'subscription_title'=> $_POST['seg_title'],
						'subscription_created_by'=>$this->session->userdata('member_id'),
						'subscription_is_name'=>'1',
						'subscription_type'=>$_POST['seg_type'],
					);
				
				$subscription_id = $this->subscription_Model->create_subscription($subscriptionArray);
				
					$segmentArray['sg_segment_key'] = $_POST['field'];
					$segmentArray['sg_segment_val'] = $_POST['field_val'];
					$segmentArray['sg_segment_condition '] = 'is';
					$segmentArray['sg_subscription_id '] = $subscription_id;
					$segmentArray['sg_ref_id'] = 1;
					
					$this->segmentation_Model->create_segmentation($segmentArray);
				
				$segmentdatafetchcondition = $this->subscription_Model->get_segmentation_data(array('subscription_id' => $subscription_id),$this->session->userdata('member_id'));

				$opensubscriber_data = $this->Subscriber_Model->get_recent_subscription_data($segmentdatafetchcondition);	
				
				foreach($opensubscriber_data as $sub => $subval){
					$subscriber_id = $subval['subscriber_id'];
					$subArray = array(
						'subscription_id' => $subscription_id,
						'subscriber_id' => $subscriber_id
					);
					$this->Subscription_subscriber_Model->create_subscription_subscriber($subArray);
				}
			
				$jsonArray['subscription_id'] = $subscription_id;
				$jsonArray['status'] =  'success';
			   
				echo json_encode($jsonArray);
				exit;	
					
				
			}else{
			
			if(array_key_exists('seg_title',$_POST[0])){
				$subscriptionArray = array(
						'subscription_title'=> $_POST[0]['seg_title'],
						'subscription_created_by'=>$this->session->userdata('member_id'),
						'subscription_is_name'=>'1',
						'subscription_type'=>'5',
					);
				$subscription_id = $this->subscription_Model->create_subscription($subscriptionArray);
			} 
			$i = 1;
			foreach($_POST as $key => $val){
				if($val['fields_value'] != ''){
					$val['fields_value'] = trim($val['fields_value']);
					$val['fields_value'] = htmlentities($val['fields_value']);
					$segmentArray['sg_segment_key'] = $val['field'];
					$segmentArray['sg_segment_val'] = $val['fields_value'];
					$segmentArray['sg_segment_condition '] = $val['criteria_is'];
					$segmentArray['sg_subscription_id '] = $subscription_id;
					$segmentArray['sg_ref_id'] = $i;
				}
				$this->segmentation_Model->create_segmentation($segmentArray);
				
			$i++;
			}
			
			
			/*
				Get updated segment criteria condition
				
			*/
			$segmentdatafetchcondition = $this->subscription_Model->get_segmentation_data(array('subscription_created_by' => $this->session->userdata('member_id'),'subscription_type' => 5,'subscription_id' => $subscription_id),$this->session->userdata('member_id'));
			
			/*
				Get latest contact data as per the criteria
			*/
			
			$subscriptionData =  $this->Subscriber_Model->get_segment_subscription_data($segmentdatafetchcondition);
			
			/*	
				Insert contact data in red_email_subscription_subscriber
			*/
			
			
			foreach($subscriptionData as $sub => $subval){
				$subscriber_id = $subval['subscriber_id'];
				$subArray = array(
					'subscription_id' => $subscription_id,
					'subscriber_id' => $subscriber_id
				);
				$this->Subscription_subscriber_Model->create_subscription_subscriber($subArray);
			}
			
			
			
			$jsonArray['subscription_id'] = $subscription_id;
			$jsonArray['status'] =  'success';
		   
			echo json_encode($jsonArray);
			exit;
		}	
		}
		
		}
		
			
	}
	


}
