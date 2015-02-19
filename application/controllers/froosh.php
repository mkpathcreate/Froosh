<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class froosh extends CI_Controller {
    public function __construct()
    {
	parent::__construct();
        $this->load->database();
	$this->load->helper('url');
	$this->load->library('grocery_CRUD');        
    }
    
    /*
     * Index page
     */
    public function index()
    {
	$this->usermgmt();
    }
    
    
    function verify()
    {
        if($this->session->userdata('froosh_login'))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /*
     * call to view page
     */
    
    public function _example_output($output = null)
    {
	if($this->verify())
        {
            $this->load->view('froosh.php',$output);
        }
        else
        {
            $this->load->view('login_admin.php');
        }
    }
        
    /*
     *  Login form
     */
    public function login()
    {
       
        $this->load->view('login_admin.php');
    }
    /*
     * User Management
     */
    
    public function usermgmt()
    {
        $crud = new grocery_CRUD();
        
        $crud->set_model('softdelete');
        $crud->where('status','1');
        $crud->set_table('users');
        
        $crud->columns('uid','uname','uemail','uage','ugender','ubdate','uprefecture','ucity','umedia','ulogin_mode','status');
	$crud->callback_column('status',array($this,'_callback_webpage_url'));	

        $crud->display_as('uid','ID')->display_as('uname','Name')->display_as('uemail','Email')
             ->display_as('uage','Age')->display_as('ugender','Gender')->display_as('uprefecture','Prefecture')
             ->display_as('ucity','City')->display_as('ubdate','Date of birth')->display_as('umedia','Media')->display_as('status','Level')->display_as('ulogin_mode','Register');
    
        $crud->field_type('ubdate', 'integer');
        

            $crud_state =$crud->getState();
            if($crud_state == 'read')
            {
                 $crud->fields('uname', 'uemail', 'uage', 'ugender', 'ubdate', 'uprefecture', 'ucity','umedia'); 
            }
            else if($crud_state == 'export' || $crud_state == 'print')
            { 
                $crud->columns( 'uname', 'uemail', 'uage', 'ugender', 'ubdate', 'uprefecture', 'ucity' );
            }
            else
            {
                $crud->fields('uname', 'uemail', 'ugender', 'uprefecture', 'ucity');
            }
            
        $crud->unset_add();
        $crud->required_fields('uname');
        $crud->field_type('uemail','readonly');
        $crud->set_lang_string('list_record','User');
        $crud->set_lang_string('form_edit','Edit');
        $crud->add_action('Images', base_url().'assets/grocery_crud/themes/flexigrid/css/images/camera.png', 'images_admin/example2');

    
        $crud->set_subject('');
        
        $output = $crud->render();
        $this->_example_output($output);       
       
    }

    /*
     * Profile View
     */
    public function profileview()
    {
        
        $session_data =  $this->session->userdata('froosh_login');
        $id= $session_data['id'];
        
        $crud = new grocery_CRUD();
        $crud->set_table('users');
         
        $crud->columns('uname', 'uemail', 'ugender', 'uprefecture', 'ucity');
        $crud->display_as('uid','ID')->display_as('uname','Name')->display_as('uemail','Email')->display_as('upassword','Password')
             ->display_as('uage','Age')->display_as('ugender','Gender')->display_as('uprefecture','Prefecture')
             ->display_as('ucity','City')->display_as('ubdate','Date of birth')->display_as('umedia','Media');
        $crud->unset_list();
        $crud->unset_back_to_list();
        $crud->set_subject('');
        $crud->callback_before_update(array($this,'password_encrypt'));
        $crud->set_rules('upassword', 'Password', 'trim|required|xss_clean|min_length[6]');
        $crud->fields('uname', 'uemail','upassword', 'ugender', 'uprefecture', 'ucity');
        $crud->field_type('uemail', 'readonly');
        $crud->field_type('upassword', 'password');
        $crud->required_fields('upassword');
        $crud->callback_edit_field('upassword',array($this,'set_password_input_to_empty'));
        $crud->set_lang_string('form_edit','Profile details');
        
          
        $crud->set_lang_string('alert_edit_form','The data you had change may not be saved.\\nAre you sure you want to go back to list? ');

        
             
        try
        {
              $output =  $crud->render();
        }
        catch(Exception $e)
        {
            if($e->getCode() == 14) //The 14 is the code of the "You don't have permissions" error on grocery CRUD.
            {
                redirect(strtolower(__CLASS__).'/'.strtolower(__FUNCTION__).'/edit/'.$id);
            }
            else
            {
                show_error($e->getMessage());
            }
        } 
        

        $this->_example_output($output);
    }
    
    function password_encrypt($encrypted)
    {        
        $encrypt_data=$encrypted['upassword'];
        $encrypted['upassword']= md5($encrypt_data);
        return $encrypted;
    }
    function set_password_input_to_empty($value,$password) 
    {
        return "<input type='password' name='upassword' value='' />";
    }
  
	public function _callback_webpage_url($value, $row)
{

$v2=0;
$this->db->select_max('phase');
	$this->db->from('images');
	$this->db->where('fstatus',1);
	$this->db->where('u_id',$row->uid);
	$tempres=$this->db->get();
	$res_phase=$tempres->result_array();
	if($res_phase[0]['phase']=='')
	$v2=0;
	else
	$v2=$res_phase[0]['phase'];



	if($v2==0){
   return "<p style='color:red'>$v2</p>";
  }
  else
  return "<p style='color:green'>$v2</p>";
	
}

 public function downloading()
    {  
            $this->load->helper('download');
            $data ='Name,Email,	Age,Gender,Date of birth,Prefecture,City';
            force_download('file.csv', $data);
    }



}