<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class category extends CI_Controller
{
    //加载辅助函数
    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model','cate');
    }
    //
    public function index()
    {
        $this->load->model('category_model','cate');
        $data['category']=$this->cate->check();
        $this->load->view('admin/cate.html',$data);
    }


    public function add_cate()
    {
        $this->load->helper('form');
        $this->load->view('admin/add_cate.html');
    }

    public function add()
    {
        $this->load->library('form_validation');
        $status = $this->form_validation->run('cate');

        if($status)
        {

            $data = array(
              'cname'=> $this->input->post('cname'),
            );
            $this->load->model('category_model','cate');
            $this->cate->add($data);

        }
        else
        {
            $this->load->helper('form');
            $this->load->view('admin/add_cate.html');
        }
    }

    public function edit_cate(){
        $cid = $this->uri->segment(4);

        $this->load->model('category_model','cate');
        $data['category'] = $this->cate->check_cate($cid);

        $this->load->helper('form');
        $this->load->view('admin/edit_cate.html', $data);
    }

    public function edit()
    {
        $this->load->library('form_validation');

        $status = $this->form_validation->run('cate');

        if($status)
        {
            $this->load->model('category_model','cate');
            $cid = $this->input->post('cid');
            $cname = $this->input->post('cname');
            $data = array(
              'cname'=>$cname
            );
            $data['category'] = $this->cate->update_cate($cid,$data);
        }
        else
        {
            $this->load->helper('form');
            $this->load->view('admin/add_cate.html');
        }

    }

    public function del()
    {
        $cid = $this->uri->segment(4);
        $this->load->model('category_model','cate');
        $this->cate->del($cid);
    }
}