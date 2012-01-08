<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cp extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		
		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin())
		{
			//redirect them to the home page because they must be an administrator to view this
			redirect($this->config->item('base_url'), 'refresh');
		}
		else
		{
			//do nothing they have admin access
		}
	}
	
	//control panel index page
	function index()
	{
		$this->load->model('Cp_model', 'cp');
			
		//set the flash data error message if there is one
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			
		$this->data['sheets'] = $this->cp->get_sheets();
		$this->data['css_files'] = null;
		$this->data['js_files'] = null;
			
		$this->load->view('template/cp_header', $this->data);
		$this->load->view('cp/index', $this->data);
		$this->load->view('template/footer', $this->data);
	}
	
	// uploads an excel file or a zip with excel files
	function upload_file()
	{
		$config['upload_path']   = './uploads/';
		$config['allowed_types'] = 'xls|xlsx|zip';
			
		$this->load->library('upload',$config);
			
		if (!$this->upload->do_upload()) {
			$error = array('error' => $this->upload->display_errors());
			// return json error
			$status = 'error';
			echo json_encode(array('status' => $status));
		}    
		else {
			$data = array('upload_data' => $this->upload->data());
				
			$file = $data['upload_data']['full_path'];
			$file_ext = $data['upload_data']['file_ext'];
			$this->_import_picks($file, $file_ext);
				
			// return json success
			$status = 'success';
			echo json_encode(array('status' => $status));
		}
	}
	
	//allows admin to update the score or details of a bowl game
	function update_game()
	{
		$this->grocery_crud->set_table('bowls');
		$output = $this->grocery_crud->render();
			
		$this->load->view('template/cp_header',$output);
		$this->load->view('template/crud',$output);
		$this->load->view('template/footer');
	}
	
	//allows admin to edit picks of a user if something needs changed
	function edit_picks()
	{
		$sheet_id = $this->uri->segment(3);
		
		$this->grocery_crud->set_table('picks');
		$this->grocery_crud->where('sheets_id',$sheet_id);
		$this->grocery_crud->display_as('bowls_id','Bowl Name');
		$this->grocery_crud->set_relation('bowls_id','bowls','bowl');
        $output = $this->grocery_crud->render();
		
		$this->load->view('template/cp_header',$output);
		$this->load->view('template/crud',$output);
		$this->load->view('template/footer');
	}
	
	// used by the upload file method, handles the uploading of the file(s), unzips if a zip is uploaded
	private function _import_picks($file, $file_ext)
	{
		$this->load->database();
		$this->load->model('Cp_model', 'cp');
		$this->load->helper('PHPExcel/IOFactory');
		
		if($file_ext == '.zip'){
			$zip = new ZipArchive;
			$zip->open($file);
			$zip->extractTo('./uploads/extract/');
			$zip->close();
			
			$scan = scandir('./uploads/extract/');
			
			for ($x=0; $i<count($scan); $x++) {
				$file = './uploads/extract/' . $scan[$x];
				if(strlen($scan[$x]) >= 3) {
					if(strpos($scan[$x], 'xls')){
						$objReader = PHPExcel_IOFactory::createReader('Excel5');
					} elseif(strpos($scan[$x], 'xlsx')) {
						$objReader = PHPExcel_IOFactory::createReader('Excel2007');
					} else {
						//not valid
					}
					/**  Advise the Reader that we only want to load cell data  **/
					$objReader->setReadDataOnly(true);
					/**  Load $inputFileName to a PHPExcel Object  **/
					$objPHPExcel = $objReader->load($file);
					
					$objWorksheet = $objPHPExcel->getActiveSheet();
					
					$name = $objWorksheet->getCell('H4')->getValue();
					$email = $objWorksheet->getCell('H5')->getValue();
					$tie_break = $objWorksheet->getCell('E49')->getValue();
					
					$sheets_id = $this->cp->add_sheet($name, $email, $tie_break);
					
					//BOWL GAMES
					for($row = 11; $row<46; $row++){
						$bowl_game_cell = 'C' . $row;
						$confidence_cell = 'K' . $row; 
						$pick_cell_1 = 'H' . $row;
						$pick_cell_2 = 'J' . $row;
						$winner_cell_1 = 'G' . $row;
						$winner_cell_2 = 'I' . $row;
						
						if($objWorksheet->getCell($pick_cell_1)->getValue() == 'x' || $objWorksheet->getCell($pick_cell_1)->getValue() == 'X' ){
							$bowl_game = $objWorksheet->getCell($bowl_game_cell)->getValue();
							$winner = $objWorksheet->getCell($winner_cell_1)->getValue();
							$confidence = $objWorksheet->getCell($confidence_cell)->getValue();
						} elseif ($objWorksheet->getCell($pick_cell_2)->getValue() == 'x' || $objWorksheet->getCell($pick_cell_2)->getValue() == 'X' ) {
							$bowl_game = $objWorksheet->getCell($bowl_game_cell)->getValue();
							$winner = $objWorksheet->getCell($winner_cell_2)->getValue();
							$confidence = $objWorksheet->getCell($confidence_cell)->getValue();
						}	
						//insert pick
						$this->cp->add_pick($bowl_game, $sheets_id, $winner, $confidence);
					}
				}
			}
		} elseif($file_ext == '.xls' || $file_ext = '.xlsx'){
			if($file_ext == 'xls'){
				$objReader = PHPExcel_IOFactory::createReader('Excel5');
			} elseif($file_ext == 'xlsx') {
				$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			} else {
				//not valid
			}
			
			$objReader = PHPExcel_IOFactory::createReader('Excel5');
			
			/**  Advise the Reader that we only want to load cell data  **/
			$objReader->setReadDataOnly(true);
			/**  Load $inputFileName to a PHPExcel Object  **/
			$objPHPExcel = $objReader->load($file);
			
			$objWorksheet = $objPHPExcel->getActiveSheet();
			
			$name = $objWorksheet->getCell('H4')->getValue();
			$email = $objWorksheet->getCell('H5')->getValue();
			$tie_break = $objWorksheet->getCell('E49')->getValue();
			
			$sheets_id = $this->cp->add_sheet($name, $email, $tie_break);
			
			//BOWL GAMES
			for($row = 11; $row<46; $row++){
				$bowl_game_cell = 'C' . $row;
				$confidence_cell = 'K' . $row; 
				$pick_cell_1 = 'H' . $row;
				$pick_cell_2 = 'J' . $row;
				$winner_cell_1 = 'G' . $row;
				$winner_cell_2 = 'I' . $row;
				
				if($objWorksheet->getCell($pick_cell_1)->getValue() == 'x' || $objWorksheet->getCell($pick_cell_1)->getValue() == 'X' ){
					$bowl_game = $objWorksheet->getCell($bowl_game_cell)->getValue();
					$winner = $objWorksheet->getCell($winner_cell_1)->getValue();
					$confidence = $objWorksheet->getCell($confidence_cell)->getValue();
				} elseif ($objWorksheet->getCell($pick_cell_2)->getValue() == 'x' || $objWorksheet->getCell($pick_cell_2)->getValue() == 'X' ) {
					$bowl_game = $objWorksheet->getCell($bowl_game_cell)->getValue();
					$winner = $objWorksheet->getCell($winner_cell_2)->getValue();
					$confidence = $objWorksheet->getCell($confidence_cell)->getValue();
				}	
				//insert pick
				$this->cp->add_pick($bowl_game, $sheets_id, $winner, $confidence);
			}	
		}
		return true;
	}
}
