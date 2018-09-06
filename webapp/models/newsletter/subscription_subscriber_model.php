<?php
/**
  *	Model class for subscriptions 
  *	It have  functions for interaction with database.
 */
class Subscription_subscriber_Model extends CI_Model
{
	//Constructor class with parent constructor
	function Subscription_Model(){
		parent::__construct();
	}
	
	
	/**
	 *	Function create_subscription
	 *
	 *	Function to create new subscription
	 *
	 *	@param (array) (input_array)  values to insert into database
	 *	@return (int)	return inserted subscription id
	 */
	function create_subscription_subscriber($input_array){
		$this->db->insert('red_email_subscription_subscriber',$input_array);
		return $this->db->insert_id();
	}
	
	/**
	 *	Function delete_subscription
	 *
	 *	Function to delete existing subscription
	 *
	 *	@param (array) (conditions_array)  conditions to checked with database with conditions
	 *
	 *	@return (int)	return deleted subscription id
	 */
	function delete_subscription_subscriber($id){
		$this->db->where('subscription_id', $id);
		$this->db->delete('red_email_subscription_subscriber');
		return true;
	}
	
	
	
	/****
	
	Get segmentation criteria
	
	****/
	
	function get_segmentation($conditions_array=array(),$rows_per_page = 10, $start = 0, $bounce = false){
		$rows=array();
		$this->db->select('*');
		$this->db->from('red_email_subscriptions as res');
		$this->db->join('red_segmentation as sg','res.subscription_id = sg.sg_subscription_id','left');
		$this->db->where($conditions_array); //execute query
		$result=$this->db->get();		
		foreach($result->result_array() as $row => $val){
			
			$rows[$val['subscription_id']]['subscription_id']=$val['subscription_id'];
			$rows[$val['subscription_id']]['subscription_title']=$val['subscription_title'];
			$rows[$val['subscription_id']]['subscription_created_by']=$val['subscription_created_by'];
			if(count($val['sg_ref_id']) >0 ){
				$rows[$val['subscription_id']]['segmentation'][$val['sg_ref_id']]['sg_ref_id']=$val['sg_ref_id'];
				$rows[$val['subscription_id']]['segmentation'][$val['sg_ref_id']]['sg_segment_key']=$val['sg_segment_key'];
				$rows[$val['subscription_id']]['segmentation'][$val['sg_ref_id']]['sg_segment_val']=$val['sg_segment_val'];
				$rows[$val['subscription_id']]['segmentation'][$val['sg_ref_id']]['sg_segment_condition']=$val['sg_segment_condition'];
			}
			
		}
		$result->free_result();
		
		return $rows;
	}
	
}
?>