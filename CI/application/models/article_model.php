<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class article_model extends CI_Model
{
    public function add($data)
    {
        $this->db->insert('article',$data);
    }

    public function article_category()
    {
       $data = $this->db->select('aid,title,cname,time')->from('article')->join('category','article.cid=category.cid')->
            order_by('aid','asc')->get()->result_array();

        return $data;
    }
    public function update_art($aid,$data)
    {
        $this->db->update('article',$data,array('aid'=>$aid));
    }

    public function del($aid)
    {
        $this->db->delete('article',array('aid'=>$aid));
    }


    //首页查询
    public function check()
    {
        $data['art'] = $this->db->select('aid,thumb,title,info')->order_by('time','desc')->get_where('article',array('type'=>0))
        ->result_array();
        $data['hot'] = $this->db->select('aid,thumb,title,info')->order_by('time','desc')->get_where('article',array('type'=>1))
            ->result_array();

        return $data;
    }


}