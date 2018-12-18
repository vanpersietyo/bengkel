<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 18/12/2018
 * Time: 16:27
 */
?>
<div class="row">
    <div class="col-md-4 padding_right">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Ubah <?=$subtitle?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post"  action="javascript:void(0)" id="form_edit_pelanggan" onsubmit="edit_pelanggan()">
                <div class="box-body">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Kode Registrasi <?=$subtitle?></label>
                            <input type="text" readonly="readonly" class="form-control" name="kode_registrasi" value="<?=$pelanggan->no_registrasi?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Email <?=$subtitle?></label>
                            <input readonly="readonly" type="email" name="email" class="form-control" value="<?=$pelanggan->email?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Nama <?=$subtitle?></label>
                            <input type="text" name="nama" class="form-control" value="<?=$pelanggan->nama?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Alamat <?=$subtitle?></label>
                            <input type="text" name="alamat" class="form-control" value="<?=$pelanggan->alamat?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Telepon <?=$subtitle?></label>
                            <input type="text" name="telepon" class="form-control" value="<?=$pelanggan->telepon?>">
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="<?= site_url('master/pelanggan.php')?>" type="button" class="btn btn-default">Batal</a>
                    <button type="submit" class="btn btn-info pull-right">Ubah</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <div class="col-md-8 padding_left">
        <?php $this->load->view('pages/master/pelanggan/tabel_pelanggan'); ?>
    </div>
</div>

<div class="result_content"></div>
<?php echo $this->session->flashdata('notif');?>

<script>
    //function tambah delete data
    function edit_pelanggan() {
        $.ajax({
            url : "<?=site_url('master/edit_pelanggan.php')?>",
            data: $('#form_edit_pelanggan').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
            }
        });
    }
</script>

