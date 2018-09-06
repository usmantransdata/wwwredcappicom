<?php
/**
  *	Model class for subscriptions 
  *	It have  functions for interaction with database.
 */
class Segmentation_Model extends CI_Model
{
	//Constructor class with parent constructor
	function Segmentation_Model(){
		parent::__construct();
	}
	
	/**
	 *	Function create_segmentation
	 *
	 *	Function to create new segmentation
	 *
	 *	@param (array) (input_array)  values to insert into database
	 *	@return (int)	return inserted subscription id
	 */
	function create_segmentation($input_array){
		$this->db->insert('red_segmentation',$input_array);
		return $this->db->insert_id();
	}
	
	/**
	 *	Function update_segmentation
	 *
	 *	Function to update existing segmentation
	 *
	 *	@param (array) (input_array)  values to update into database
	 *
	 *	@param (array) (conditions_array)  conditions to checked with database with conditions
	 *
	 *	@return (int)	return updated subscription id
	 */
	function update_segmentation($input_array,$conditions_array){
		$this->db->update('red_segmentation',$input_array,$conditions_array);
		return $this->db->affected_rows();
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
	function delete_segmentation($conditions_array){
		$this->db->where($conditions_array);
		$this->db->delete('red_segmentation');
		return true;
	}
	
	/**
	 *	Function get_subscription_data
	 *
	 *	Function to fetch subscription data
	 *
	 *	@param (array) (conditions_array)  conditions to checked with database with conditions
	 *
	 *	@param (int) (rows_per_page)  number of record per page
	 *
	 *	@param (int) (start)  These determine which number to start the record
	 *
	 *	@return (array)	return fetch records
	 */
	function get_segmentation_data($conditions_array=array(),$rows_per_page=10,$start=0){
		$rows=array();
		$this->db->order_by('subscription_id','asc');	// define order by		
		$result=$this->db->get_where('red_email_subscriptions',$conditions_array); //execute query		
		foreach($result->result_array() as $row){
			$rows[]=$row;
		}
		$result->free_result();
		return $rows;
	}
	
	/**
	 *	Function get_subscription_count
	 *
	 *	Function to fetch subscription count
	 *
	 *	@param (array) (conditions_array)  conditions to checked with database with conditions
	 *
	 *	@return (int)	return total number of records
	 */
	function get_subscription_count($conditions_array=array()){
		$this->db->where($conditions_array);
		return $this->db->count_all_results('red_email_subscriptions');		
	}
	/**
		function get_subscription_list to fetch subscription list from red_email_subscription_subscriber
	*/
	function get_subscription_list($conditions_array=array()){
		$rows=array();
		$this->db->select('*');
		$this->db->from('red_email_subscription_subscriber as ress');
		$this->db->join('red_email_subscriptions as res','res.subscription_id =ress.subscription_id');
		$this->db->where($conditions_array); //execute query
		$result=$this->db->get();		
		foreach($result->result_array() as $row){
			$rows[]=$row;
		}
		$result->free_result();
		echo '<pre>';print_r($rows);exit;
	}
	
	/*fetch all the segmented list*/
	
	function get_segment_list($conditions_array=array()){
		$rows=array();
		$this->db->select('DISTINCT ress.sg_subscription_id',false);
		$this->db->from('red_segmentation as ress');
		$this->db->join('red_email_subscriptions as res','res.subscription_id =ress.sg_subscription_id');
		$this->db->where($conditions_array); //execute query
		$result=$this->db->get();		
		foreach($result->result_array() as $row => $val){
			//echo '<pre>';print_r($val);
			$finalArray[]= $val['sg_subscription_id'];
			
		}
		
		return $finalArray;
	}
	
}
?>