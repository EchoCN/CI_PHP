<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller
{
    public function index()
    {
        $this->load->view('admin/index.html');
    }

    public function copy()
    {
        $this->load->view('admin/copy.html');
    }

    public function change()
    {
        $this->load->view('admin/change_passwd.html');
    }
    public function change_passwd()
    {
        $this->load->model('admin_model','admin');

        $username = $this->session->userdata('username');
        $userData = $this->admin->check($username);


        $passwd = $this->input->post('passwd');

        //原始密码错误
        if($passwd != $userData[0]['passwd']) error('不正确!');
        $passwdF = $this->input->post('passwdF');
        $passwdS = $this->input->post('passwdS');

        if($passwdF != $passwdS) error('两次密码不同！');

        $uid = $this->session->userdata('uid');

        $data = array(
            'passwd'=>$passwd,
        );
        $this->admin->change($uid,$data);

        success('admin/admin/index','修改成功!');
    }
}