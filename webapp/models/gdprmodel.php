<?php
class GdprModel extends CI_Model
{
	//Constructor class with parent constructor
	function GdprModel(){
		parent::__construct();
		$this->load->helper('cookie');
		$this->load->library('encrypt');
		
	}
	
	
	function create_user($input_array){
	
		$this->db->insert('red_member_gdpr',$input_array);
        return $this->db->insert_id();
	}
	
	
	function get_user_data($member_id,$emailaddress)
	{
	  
	 
	 $this->db->select('member_id')->from('red_member_gdpr');
	 $this->db->where('member_id',$member_id);
     $this->db->where('email_address',$emailaddress);
      $q = $this->db->get(); 
      return $q->num_rows();
	}
	
	function get_members_list($member_id)
	{
		
		
		$this->db->where(array('member_id'=>$member_id));
        $this->db->select('id,email_address,date_time,ip');
        
        $q = $this->db->get('red_member_gdpr');
       
		if($q->num_rows() > 0)
       {
       $response = $q->result_array();
       return $response;
    }
		
		
	}
	

}
?>
