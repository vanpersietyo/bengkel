<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

//    public function index(){
//        if ($this->session->userdata('level')=='1'){
//            redirect(site_url('admin'));
//        }elseif ($this->session->userdata('level')=='2'){
//            redirect(site_url('kasir'));
//        }
//    }

    public function index(){
        $data=array(
            'page'=>'pages/blank');
        $this->load->view('templates/layout',$data);
    }

    public function get_menu($menu){
        redirect(site_url($this->session->userdata('username').'/'.$menu));
    }

public function view($page = 'home'){
        if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
            show_404();
        }
        $data['title'] = ucfirst($page);
        $this->load->view('templates/header');
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer');
    }
}
