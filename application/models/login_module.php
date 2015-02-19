<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login_module
 *
 * @author Rhytha
 */
class login_module extends CI_Model {
    //put your code here
    
     function login($username, $password) 
        {
            //create query to connect user login database
            $this->db->select('uid, uname, uemail');
            $this->db->from('users');
            $this->db->where('uemail', $username);
            $this->db->where('upassword',  md5($password));
            $this->db->where('status >=',2);
            $this->db->limit(1);
            //get query and processing
            $query = $this->db->get();
            if($query->num_rows() == 1) 
            {
                return $query->result();
            } 
            else 
            {
                return false; //if data is wrong
            }
        }
}
