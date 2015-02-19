<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of softdelete
 *
 * @author Rhytha
 */
class softdelete extends grocery_CRUD_Model
{
    function db_delete($primary_key_value)
    {
    	$primary_key_field = $this->get_primary_key();

    	if($primary_key_field === false)
    		return false;

        $this->db->update($this->table_name,array('status'=>'0'), array( $primary_key_field => $primary_key_value));

    	if( $this->db->affected_rows() != 1)
    		return false;
    	else
    		return true;
    }
    
}
