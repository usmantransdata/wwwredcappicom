<?php
class beeModel extends CI_Model
{
	function get_bee_configuration_data($conditions_array=array())
	{
		$rows=array();
		$result=$this->db->get_where('red_beefree_temp as rsc',$conditions_array);
		# echo $this->db->last_query();
		foreach($result->result_array() as $row)
		{
			$rows[]=$row;
		}
		return $rows;
	}
	
}
?>