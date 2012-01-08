<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Cp_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/* 
	*  adds a sheet user to the database
	*  returns the id of the sheet
	*/
	function add_sheet($name, $email, $tie_break)
	{
		$orig_name = $name;
		$name = $this->_proper_name($orig_name, $name, 1);
		
		$data = array(
			'name' => $name,
			'email' => $email,
			'tie_break' => $tie_break
		);
		
		if($this->db->insert('sheets', $data)){
			return $this->db->insert_id();
		} else {
			return false;
		}	
	}
	
	/* 
	*  adds a sheet pick to the database
	*  returns true on success, false on fail
	*/
	function add_pick($bowl_game, $sheets_id, $winner, $confidence)
	{
		$bowls_id = $this->_get_bowl_id('2011',$bowl_game);
			
		$data = array(
			'sheets_id' => $sheets_id,
			'bowls_id' => $bowls_id,
			'winner' => $winner,
			'confidence' => $confidence
		);
		
		if($this->db->insert('picks', $data)){
			return true;
		} else {
			return false;
		}
	}
	
	/* 
	*  returns an array of all the sheets entered
	*  
	*/
	function get_sheets()
	{
		$query = $this->db->get('sheets');
		
		return $query->result_array();
	}
	
	/* 
	*  A person may have multiple sheets
	*  If they do we need to append a number to their name
	*  returns the proper name to insert in the db
	*/
	private function _proper_name($orig_name, $name, $sheet_num)
	{
		$query = $this->db->get_where('sheets',array('name' => $name));
		$count = $query->num_rows();
		
		if($count == 1) {
			$sheet_num++;
			$number = '[' . $sheet_num . ']';
			$name = $orig_name . ' ' . $number;
			$name = $this->_proper_name($orig_name, $name, $sheet_num);
		} 
		
		return $name;
	}
	
	/* 
	*  returns the bowl id of a single bowl name
	*  
	*/
	private function _get_bowl_id($year, $bowl){
		$query = $this->db->get_where('bowls',array('year' => $year, 'bowl' => $bowl));
		
		$row = $query->row();
		return $row->id;
	}
	
}
