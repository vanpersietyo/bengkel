<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 27/10/2018
 * Time: 21:59
 */?>

<div class="row">
    <div class="col-md-4 padding_right">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah <?=$subtitle?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post"  action="javascript:void(0)" id="form_add_pelanggan" onsubmit="tambah_pelanggan()">
                <div class="box-body">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Kode Registrasi <?=$subtitle?></label>
                            <input type="text" readonly="readonly" class="form-control" name="kode_registrasi" value="<?=$kode_pelanggan?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Email <?=$subtitle?></label>
                            <input type="email" name="email" class="form-control" placeholder="email@email.com">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Nama <?=$subtitle?></label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Pelanggan">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Alamat <?=$subtitle?></label>
                            <input type="text" name="alamat" class="form-control" placeholder="Alamat Pelanggan">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Telepon <?=$subtitle?></label>
                            <input type="text" name="telepon" class="form-control" placeholder="No. Telepon Pelanggan">
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="<?= site_url('dashboard')?>" type="button" class="btn btn-default">Batal</a>
                    <button type="submit" class="btn btn-info pull-right">Tambah</button>
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
    function tambah_pelanggan() {
        $.ajax({
            url : "<?=site_url('master/tambah_pelanggan.php')?>",
            data: $('#form_add_pelanggan').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
            }
        });
    }
</script>

