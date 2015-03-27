<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author Rhytha
 */
class login extends CI_Controller{
    //put your code here
     function __construct()
    {
        parent::__construct();
        $this->load->library(array('table','form_validation'));

        $this->load->model('login_module','',TRUE);
    }
     public function index()
    {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('emailid', 'Email address', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[6]|callback_check_database');// call function check database

        if($this->form_validation->run() == FALSE)
        {
          
          $this->load->view('login_admin.php');
        }
        else
        {
        
          redirect('froosh', 'refresh');
        }
    }

    function check_database($password)
    {
        $username = $this->input->post('emailid');

        $result = $this->login_module->login($username, $password);
        if($result)
        {
            $sess_array = array();
            foreach($result as $row)
            {
                $sess_array = array(
                'id' => $row->uid,
                'username' => $row->uname,
                'email_id' => $row->uemail);
            }
            $this->session->set_userdata('froosh_login', $sess_array);
            return TRUE;
        }
        else
        {
          $this->form_validation->set_message('check_database', 'Invalid Emailid or password');
          return FALSE;
        }
    }
}
