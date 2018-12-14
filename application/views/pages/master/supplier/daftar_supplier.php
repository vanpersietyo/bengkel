<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 13/12/2018
 * Time: 10:03
 */
?>

<div class="row">
    <div class="col-md-4">
        <?php
        if ($action=='input'){
            $this->load->view('pages/master/supplier/tambah_supplier');
        }elseif ($action=='edit'){
            $this->load->view('pages/master/supplier/edit_supplier');
        }?>
    </div>
    <div class="col-md-8">
        <?php $this->load->view('pages/master/supplier/tabel_daftar_supplier')?>
    </div>
</div>

<div class="result_content"></div>
<?php echo $this->session->flashdata('notif');?>