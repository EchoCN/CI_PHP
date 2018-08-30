<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class login extends CI_Controller
{
    public function index()
    {
        //验证码
        $this->load->helper('captcha');

        $speed = 'aasdfghjsdsfksafa';
        $word = '';
        for($i = 0 ; $i<4;$i++)
        {
            $word.=$speed[mt_rand(0,strlen($speed-1))];
        }

        //配置
        $vals = array(
            'word'=>$word,
            'img_path'=>'./captcha/',
            'img_url'=>base_url() . '/captcha/',
            'img_width'=>80,
            'img_height'=>25,
            'expiration'=>1

        );
        //创建
        $cap = create_captcha($vals);
        if(!isset($_SESSION)){
            session_start();
        }
        $_SESSION['code'] = $cap['word'];
        $data['captcha'] = $cap['image'];



        $this->load->view('admin/login.html',$data);
    }


    public function login_in()
    {
        $code = $this->input->post('captcha');
        if(!isset($_SESSION)){
            session_start();
        }
        //if(strtoupper($code) != $_SESSION['code'])
        //{
           // echo '错误';
        //}

        $username = $this->input->post('username');
        $this->load->model('admin_model','admin');
        $userdata =  $this->admin->check($username);

        $passwd = $this->input->post('passwd');

        if(!$userdata || $userdata[0]['passwd'] != $passwd)
        {
            echo 123;
        }

        $sessionData = array(
            'username'=>$username,
            'uid'=>$userdata[0]['uid'],
            'login_time'=>time()
        );

        $this->session->set_userdata($sessionData);
        success('admin/admin/index','登入成功');
    }

    public function login_out()
    {
        $this->session->sess_destroy();
        success('admin/login/index','退出成功');
    }

}