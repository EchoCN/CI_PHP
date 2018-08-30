<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_model extends CI_Model
{
    public function check($username)
    {
        //$this->db->where(array(''=>$))->get(表名);
        $data = $this->db->get_where('admin',array(
            'username'=>$username
        ))->result_array();
        return $data;
    }

    public function change($uid,$data)
    {
        $this->db->update('admin',$data,array(
            'uid'=>$uid,
        ));
    }


}