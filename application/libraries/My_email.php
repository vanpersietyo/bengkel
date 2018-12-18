<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 18/12/2018
 * Time: 15:05
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class My_email {

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('email');
    }

    function send_email($data)
    {
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://sibengkel.online',
            'smtp_port' =>  465,
            'smtp_user' => 'admin@sibengkel.online',
            'smtp_pass' => 'candra123890',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->CI->email->initialize($config);
        $this->CI->email->set_mailtype("html");
        $this->CI->email->set_newline("\r\n");

        //Email content
        $htmlContent 	= $data['header_content'];
        $htmlContent   .= $data['detail_content'];

        //tujuan email
        $this->CI->email->to($data['to']);
        $this->CI->email->from($data['from'],$data['from_nama']);
        $this->CI->email->subject($data['subject']);
        $this->CI->email->message($htmlContent);
        //Send email
        if($this->CI->email->send()) {
            return true;
        }
        else {
            //return $this->CI->email->print_debugger();
            return false;
        }
    }

}