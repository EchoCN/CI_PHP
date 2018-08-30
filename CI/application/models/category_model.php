<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class category_model extends CI_Model
{
    //加
    public function add($data)
    {
        $this->db->insert('category',$data);
    }
    //查
    public function check()
    {
        $data = $this->db->get('category')->result_array();
        return $data;
    }
    //
    public function check_cate($cid)
    {
        $data = $this->db->where(array('cid'=>$cid))->get('category')->result_array();
        return $data;
    }
    //更
    public function update_cate($cid,$data)
    {
        $this->db->update('category',$data,array('cid'=>$cid));
    }
    //删
    public function del($cid)
    {
        $this->db->delete('category',array('cid'=>$cid));
    }
    //调取导航栏
    public function limit_category($limit)
    {
       $data =  $this->db->limit($limit)->get('category')->result_array();
        return $data;
    }
}