<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('form_validation','database','xmlrpc','session','conversion');

$autoload['drivers'] = array();

$autoload['helper'] = array('url', 'form','text','new_helper');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array('login_model','admin_model');
