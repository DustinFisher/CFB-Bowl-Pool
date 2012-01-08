<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bowl extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('url');
	}
	
	//site index page
	//lists the leaderboard and games
	function index()
	{
		$this->load->model('Bowl_model', 'bowl');
		
		//set the flash data error message if there is one
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		
		$this->data['results'] = $this->bowl->get_results();
		$this->data['bowls'] = $this->bowl->get_bowls();
		
		$this->load->view('template/header', $this->data);
		$this->load->view('bowl/index', $this->data);
		$this->load->view('template/footer', $this->data);
	}
	
	//displays the picks for all bowls by a user
	//used on the index page as a popup when a name is clicked on
	function user_picks()
	{
		$this->load->model('Bowl_model', 'bowl');
		
		$sheets_id = $this->uri->segment(3);
		
		$this->data['name'] = $this->bowl->user_name($sheets_id);
		$this->data['tie_break'] = $this->bowl->user_tie_break($sheets_id);
		
		$this->data['results'] = $this->bowl->user_picks($sheets_id);
		
		$this->load->view('template/blank_header', $this->data);
		$this->load->view('bowl/user_picks', $this->data);
		$this->load->view('template/footer', $this->data);
		
	}
	
	//displays the picks by all sheets for a bowl game
	//used on the index page as a popup when a bowl name is clicked on
	function bowl_picks()
	{
		$this->load->model('Bowl_model', 'bowl');
		
		$bowl_id = $this->uri->segment(3);
		
		$this->data['results'] = $this->bowl->bowl_picks($bowl_id);
		$this->data['bowl_name'] = $this->bowl->bowl_name($bowl_id);
		
		$this->load->view('template/blank_header', $this->data);
		$this->load->view('bowl/bowl_picks', $this->data);
		$this->load->view('template/footer', $this->data);
		
	}

}
