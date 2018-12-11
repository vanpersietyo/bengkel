<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Montir extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (show_session("level")!='3'){
            redirect('');
        }
    }

/**
 * @return object
 */
    public function index()
    {
        $data   = array('data'=>'dashboard');
        $this->load->view('pages/dashboard/montir',$data);
    }

}
