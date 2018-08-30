<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class article extends CI_Controller
{
    public function index()
    {
        //分页
        $this->load->library('pagination');
        $perPage = 3;
        //配置项设置
        $config['base_url']= site_url('admin/article/index');
        $config['total_rows'] = $this->db->count_all_results('article');
        $config['per_page'] = $perPage;
        $config['uri_segment'] = 4;
        $config['first_link'] = '第一页';
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';
        $config['last_link'] = '最后一页';

        $this->pagination->initialize($config);

        $data['links'] = $this->pagination->create_links();

        $offset = $this->uri->segment(4);

        $this->db->limit($perPage,$offset);


        $this->load->model('article_model','art');

        $data['article'] = $this->art->article_category();
        $this->load->view('admin/check_article.html',$data);
    }


    public function send_article()
    {

        $this->load->model('category_model','cate');

        $data['category'] = $this->cate->check();
        $this->load->helper('form');
        $this->load->view('admin/article.html',$data);
    }

    public function send()
    {
        $this->load->library('form_validation');
        //$this->form_validation->set_rules('title','文章标题','required|min_length[5]');
        //$this->form_validation->set_rules('type','类型','required|integer');
        //$this->form_validation->set_rules('cid','栏目','integer');
        //$this->form_validation->set_rules('info','摘要','max_length[10]');
        //$this->form_validation->set_rules('content','内容','max_length[100]|required');
        $status = $this->form_validation->run('article');

        if($status){
            $this->load->model('article_model','art');
            $data = array(
                'title'=>$this->input->post('title'),
                'type'=>$this->input->post('type'),
                'cid'=>$this->input->post('cid'),
                'thumb'=>$this->input->post('thumb'),
                'info'=>$this->input->post('info'),
                'content'=>$this->input->post('content')
            );
            $this->art->add($data);
        }else
        {
            $this->load->helper('form');
            $this->load->view('admin/article.html');
        }
    }

    public function edit()
    {
        $this->load->helper('form');
        $this->load->view('admin/edit_article.html');
        $this->load->library('form_validation');
        $status = $this->form_validation->run('article');


        if($status)
        {
            echo '数据库操作！';
        }
        else
        {
            $status = $this->form_validation->run('article');
        }
    }

    public function edit_article(){
        $aid = $this->uri->segment(4);

        $this->load->model('article_model','art');
        $data['article'] = $this->art->check_art($aid);

        $this->load->helper('form');
        $this->load->view('admin/edit_article.html', $data);
    }


    public function del()
    {
        $aid = $this->uri->segment(4);
        $this->load->model('article_model','art');
        $this->art->del($aid);
    }
}