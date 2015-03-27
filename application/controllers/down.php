<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dowm
 *
 * @author Rhytha
 */
class down extends CI_Controller{
    //put your code here
    
    function __construct()
    {
        parent::__construct();
    }
    
    
    public function index()
    {  
$this->load->dbutil();
$this->load->helper('download');

$query = $this->db->query("SELECT uname as Name, uemail as Email, uage as Age, ugender as Gender, ubdate as Date_of_birth, uprefecture as Prefecture, ucity as City FROM users where status = 1");
$delimiter = "\t";
            $newline = "\r\n";
            
            $data = $this->dbutil->csv_from_result($query, $delimiter,$newline);
$data = "\xFF\xFE" .mb_convert_encoding($data, 'UTF-16LE', 'UTF-8');
force_download('Report.csv', $data); 
    }
}
