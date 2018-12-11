<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemilik extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (show_session("level")!='6'){
            redirect('');
        }
    }

}
