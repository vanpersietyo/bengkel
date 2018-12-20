<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$title.' '.$subtitle?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?=base_url('assets/adminlte/')?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- datepicker -->
    <link rel="stylesheet" href="<?=base_url('assets/adminlte/')?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?=base_url('assets/adminlte/')?>plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url('assets/adminlte/')?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?=base_url('assets/adminlte/')?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('assets/adminlte/')?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?=base_url('assets/adminlte/')?>dist/css/skins/_all-skins.min.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- jQuery 3 -->
    <script src="<?=base_url('assets/adminlte/')?>bower_components/jquery/dist/jquery.min.js"></script>
    <!-- InputMask -->
    <script src="<?=base_url('assets/adminlte/')?>bower_components/inputmask/dist/jquery.inputmask.bundle.js"></script>

    <!-- additional -->

    <!-- selectpicker -->
    <link rel="stylesheet" href="<?=base_url('assets/adminlte/').'bower_components/bootstrap-selectpicker/dist/css/bootstrap-select.min.css'?>">
    <!-- Pace style -->
    <link rel="stylesheet" href="<?=base_url('assets/adminlte/')?>plugins/pace/pace.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?=base_url('assets/adminlte/')?>plugins/iCheck/square/blue.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?=base_url('assets/adminlte/')?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url('assets/adminlte/')?>bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
    <!-- sweetalert -->
    <link rel="stylesheet" href="<?=base_url('assets/third_party/')?>sweetalert/dist/sweetalert2.css">
    <!--    select 2-->
    <link rel="stylesheet"  href="<?=base_url('assets/adminlte/').'bower_components/select2/dist/css/select2.min.css'?>">
    <!--loading-->
    <link rel="stylesheet"  href="<?=base_url('assets/third_party/loading.css')?>">
</head>
<style>
    .padding_right{padding-right: 5px !important;}
    .padding_left{padding-left: 5px !important;}
    .padding_top{padding-top: 5px !important;}
    .padding_bottom{padding-bottom: 5px !important;}
    .padding_both{padding-right: 5px !important;padding-left: 5px !important;}
</style>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?=base_url('assets/adminlte/')?>index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>SI</b>BKL</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>SI </b>Bengkel</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" id="push-menu">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <?php

            $user   = $this->login_model->cek_data(array('kode_user'=>$this->session->userdata('kode_user')),'user')->row();
            $level  = $this->login_model->cek_data(array('id_level'=>$this->session->userdata('level')),'level')->row();

            ?>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?=base_url('assets/adminlte/')?>dist/img/male-circle-512.png" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?=$this->session->userdata("username")?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?=base_url('assets/adminlte/')?>dist/img/male-circle-512.png" class="img-circle" alt="User Image">
                                <p>
                                    <?=$this->session->userdata('username') ?: $this->session->userdata('no_reg') ?> - <?=$level->nama_level?>
                                    <?php

                                    $member_since = $this->login_model->cek_data(array('kode_user'=>$this->session->userdata('kode_user')),'user')->row()->entry_time;
                                    $date=date_create($member_since);
                                    ?>
                                    <small>Member sejak <?=dateIndo(date_format($date,'d-m-Y'),1)?> </small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?= site_url('profile.php')?>" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?=site_url('logout.php')?>" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>
    <!-- =============================================== -->