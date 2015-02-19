<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images_admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->database();
		/* ------------------ */
		
		$this->load->helper('url'); //Just for the examples, this is not required thought for the library
		
		$this->load->library('image_CRUD');
	}
	
	function _example_output($output = null)
	{
		$this->load->view('image_view.php',$output);	
	}
	
	function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}	
	
	
	
	function example2()
	{
		$image_crud = new image_CRUD();
		$image_crud->unset_upload();
		$image_crud->unset_delete();
		
		
		
		
		
		$image_crud->set_primary_key_field('id');
		$image_crud->set_url_field('image_name');
		$image_crud->set_table('images')
		->set_image_path('uploads');
		$output = $image_crud->render();
	
		$this->_example_output($output);
	}
function example2_2()
	{
		$image_crud = new image_CRUD();
		$image_crud->unset_upload();
		$image_crud->unset_delete();
		
		
		
		
		
		$image_crud->set_primary_key_field('id');
		$image_crud->set_url_field('image_name');
		$image_crud->set_table('images')
		
		->set_relation_field2('fstatus')// this for where condition
		
			->set_image_path('uploads');
		$output = $image_crud->render();
	
		$this->_example_output($output);
	}
	
	
	function favourite()
	{
		$image_crud = new image_CRUD();
		$image_crud->unset_upload();
	
		$image_crud->set_primary_key_field('id');
		$image_crud->set_url_field('image_name');
		$image_crud->set_table('favourite')
		
		->set_image_path('uploads');
		$output = $image_crud->render();
	
		$this->_example_output($output);
	}
	
	
}