<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Bowl_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/* 
	*  returns an array of results for the leaderboard
	*  total points, name, remaining points, most confident, least confident, tie breaker
	*/
	function get_results()
	{
		$results = array();
		
		$sql = "SELECT * FROM users";
		$result = mysql_query($sql);
		
		$query = $this->db->get('sheets');
		
		$z = 0;
		foreach($query->result() as $row){
			$sheets_id = $row->id;
			$tie_breaker = $row->tie_break;
			
			$picks = $this->db->get_where('picks', array('sheets_id' => $sheets_id));
			
			$master = array();
			$counter = 0;
			
			foreach($picks->result() as $pick){
				$master[$pick->confidence] = $pick->winner;
				$counter++;
			}
			krsort($master);
			
			$this->db->select('*');
			$this->db->from('bowls');
			$this->db->join('picks', 'bowls.id = picks.bowls_id', 'left');
			$this->db->where('picks.sheets_id', $sheets_id);
			
			$user_results = $this->db->get();
			
			$total_points = 0;
			$remaining_points = 0;
			$count = 0;
			
			foreach($user_results->result() as $user_result){
				if($user_result->won == $user_result->winner){
					$total_points += $user_result->confidence;
				} elseif($user_result->won == NULL) {
					$remaining_points += $user_result->confidence;
				}
			}
			
			$results[$z]['total_points'] = $total_points;
			$results[$z]['name'] = $row->name;
			$results[$z]['remaining_points'] = $remaining_points;
			$results[$z]['most_confident'] = $master['35'];
			$results[$z]['least_confident'] = $master['1'];
			$results[$z]['tie_breaker'] = $tie_breaker;
			$results[$z]['id'] = $row->id;
				
			$z++;
		}
		
		if($results){
			$results = $this->_subval_sort($results,'total_points'); 
			krsort($results);
			return $results;
		}
	}
	
	/* 
	*  returns an array of all the bowls for the leaderboard page
	*  bowl name, location, date, network, %picked of each team, avg. confidence, score
	*/
	function get_bowls()
	{
		$query = $this->db->get('bowls');
		
		$z = 0;
		foreach($query->result() as $row) {
			$results[$z]['id'] = $row->id;
			$results[$z]['year'] = $row->year;
			$results[$z]['bowl'] = $row->bowl;
			$results[$z]['location'] = $row->location;
			$results[$z]['date'] = $row->date;
			$results[$z]['network'] = $row->network;
			$results[$z]['team_1'] = $row->team_1;
			$results[$z]['team_2'] = $row->team_2;
			$results[$z]['won'] = $row->won;
			$results[$z]['winning_score'] = $row->winning_score;
			$results[$z]['losing_score'] = $row->losing_score;
			$results[$z]['team_1_percent'] = $this->_get_percent_picked($row->team_1);
			$results[$z]['team_2_percent'] = $this->_get_percent_picked($row->team_2);
			$results[$z]['avg_confidence'] = $this->_get_average_confidence($row->id);
			$z++;
		}
		return $results;
	}
	
	/* 
	*  returns an array of a single sheets picks 
	*/
	function user_picks($sheets_id)
	{
		$this->db->select('*');
		$this->db->from('bowls');
		$this->db->join('picks', 'bowls.id = picks.bowls_id', 'left');
		$this->db->where('bowls.year', '2011');
		$this->db->where('picks.sheets_id', $sheets_id);
		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	/* 
	*  returns an array of all the picks for a single bowl game 
	*/
	function bowl_picks($bowl_id)
	{
		$sql = "SELECT * FROM picks WHERE bowls_id = '$bowl_id';";
		$this->db->select('*');
		$this->db->from('picks');
		$this->db->join('sheets', 'picks.sheets_id = sheets.id', 'left');
		$this->db->where('picks.bowls_id', $bowl_id);
		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	/* 
	*  returns the name a sheet belongs to 
	*/
	function user_name($sheets_id)
	{
		$this->db->select('name');
		$this->db->from('sheets');
		$this->db->where('id',$sheets_id);
		
		$query = $this->db->get();
		$row = $query->row();
		
		return $row->name;
	}
	
	/* 
	*  gets the tie break for a sheet
	*/
	function user_tie_break($sheets_id)
	{
		$this->db->select('tie_break');
		$this->db->from('sheets');
		$this->db->where('id',$sheets_id);
		
		$query = $this->db->get();
		$row = $query->row();
		
		return $row->tie_break;
	}
	
	/* 
	*  returns the name of a bowl game
	*/
	function bowl_name($bowl_id)
	{
		$this->db->select('bowl');
		$this->db->from('bowls');
		$this->db->where('id',$bowl_id);
		
		$query = $this->db->get();
		$row = $query->row();
		
		return $row->bowl;
	}
	
	/* 
	*  returns the percent people picked of a bowl game 
	*/
	private function _get_percent_picked($team)
	{
		
		$this->db->select('winner');
		$this->db->from('picks');
		$this->db->where('winner',$team);
		
		$query = $this->db->get();
		$picked = $query->num_rows();
		
		$query = $this->db->get('sheets');
		$sheets = $query->num_rows();
		
		if(!$sheets == 0){
			$percent = ($picked/$sheets)*100;
			$percent = round($percent, 0);
			return $percent;
		} else {
			return 0;
		}
	}
	
	/* 
	*  returns the average confidence given for a bowl game
	*/
	private function _get_average_confidence($bowls_id)
	{
		
		$this->db->select('confidence');
		$this->db->from('picks');
		$this->db->where('bowls_id',$bowls_id);
		
		$query = $this->db->get();
		$total_picks = $query->num_rows();
		
		$total = 0;
		foreach($query->result() as $row){
			$total += $row->confidence;
		}
		
		if(!$total_picks == 0){
			return round($total/$total_picks);
		} else {
			return 0;
		}
	}
	
	/* 
	*  used by get_results() function
	*  sorts the results array by total points most points to least points
	*/
	private function _subval_sort ($a, $subkey) 
	{   
		foreach($a as $k=>$v) {
			$b[$k] = strtolower($v[$subkey]);
		}
		asort($b);
		foreach($b as $key=>$val) {
			$c[] = $a[$key];
		}
		return $c;
	} 
}
