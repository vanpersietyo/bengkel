<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 13/12/2018
 * Time: 17:17
 */
?>

<div class="row">
    <div class="col-md-4">
        <?php
        if ($action=='input'){
            $this->load->view('pages/menu_pelanggan/kendaraan/tambah_kendaraan');
        }elseif ($action=='edit'){
            $this->load->view('pages/menu_pelanggan/kendaraan/edit_kendaraan');
        }?>
    </div>
    <div class="col-md-8">
        <?php $this->load->view('pages/menu_pelanggan/kendaraan/tabel_daftar_kendaraan')?>
    </div>
</div>

<div class="result_content"></div>
<?php echo $this->session->flashdata('notif');?>
