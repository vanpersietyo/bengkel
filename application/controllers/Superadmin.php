<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("level")!='1'){
            redirect('');
        }
    }

    /**
     * @return object
     */
    public function index()
    {
        $data   = array(
            'title'     =>'Dashboard',
            'subtitle'  =>'Superadmin',
            'page'      =>'pages/dashboard/superadmin');
        $this->load->view('templates/layout',$data);
    }

    /**
     * @return object
     */
    public function user()
    {
        $data   = array(
            'title'     =>'List user',
            'subtitle'  =>'',
            'page'      =>'pages/master/user/daftar_user');
        $this->load->view('templates/layout',$data);
    }

}
