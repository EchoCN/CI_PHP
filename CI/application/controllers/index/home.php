<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class home extends CI_Controller
{
    public function index()
    {

        $this->load->helper('url');
        //echo base_url().'resources/index/';
        //echo site_url().'/index/home/category';

        $this->load->model('category_model','cate');
        $data['category'] = $this->cate->limit_category(2);

        $this->load->model('article_model','art');
        $data = $this->art->check();

        //p($data);die;
        $this->load->view('index/index.html',$data);
    }
    public function category()
    {
        $this->load->view('index/category.html');
    }

    public function article()
    {
        $this->load->view('index/details.html');
    }
}