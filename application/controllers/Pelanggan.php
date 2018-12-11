<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (show_session("level")!='5'){
            redirect('');
        }
    }

    /**
     * @return object
     */
    public function index()
    {
        $data   = array('data'=>'Dashboard Pelanggan');
        $this->load->view('pages/dashboard/pelanggan',$data);
    }
}
