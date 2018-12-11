<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 22/10/2018
 * Time: 14:39
 */
?>

<?php $this->load->view('templates/header',true)?>

<?php $this->load->view('templates/sidebar',true)?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?=$title?>
                <small><?=$subtitle?></small>
            </h1>
<!--            <ol class="breadcrumb">-->
<!--                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>-->
<!--                <li class="active">Dashboard</li>-->
<!--            </ol>-->
        </section>
        <!-- Main content -->
        <section class="content">
            <?php $this->load->view($page)?>
        </section>
        <!-- /.content -->
    </div>

<?php $this->load->view('templates/footer',true)?>

<?php $this->load->view('templates/script',true)?>