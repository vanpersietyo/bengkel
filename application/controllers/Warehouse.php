<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 24/10/2018
 * Time: 14:29
 */
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (show_session("level")!='3'){
            redirect('');
        }
    }

}

