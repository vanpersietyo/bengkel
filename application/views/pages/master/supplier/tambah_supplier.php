<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 13/12/2018
 * Time: 10:50
 */
?>

<div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Data <?=$subtitle?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post"  action="javascript:void(0)" id="form_add_supplier" onsubmit="tambah_supplier()">
            <div class="box-body">

                <div class="form-group">
                    <div class="col-sm-12">
                        <label >Kode <?=capitalize_each_first($subtitle);?></label>
                        <input type="text" disabled="disabled" class="form-control" value="<?=$kode_supplier?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label >Nama <?=capitalize_each_first($subtitle);?></label>
                        <input type="text" class="form-control" name="nama" id="nama" required="required" placeholder="Nama <?=capitalize_each_first($subtitle);?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label >Alamat  <?=capitalize_each_first($subtitle);?></label>
                        <input name="alamat" type="text" class="form-control" required="required" placeholder="Alamat <?=capitalize_each_first($subtitle);?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label >Telepon  <?=capitalize_each_first($subtitle);?></label>
                        <input name="telepon" type="tel" class="form-control" required="required" placeholder="Nomor Telepon <?=capitalize_each_first($subtitle);?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label >Keterangan  <?=capitalize_each_first($subtitle);?></label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Keterangan supplier">
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="<?= site_url('master/supplier.php')?>" type="button" class="btn btn-default">Batal</a>
                <button type="submit" class="btn btn-info pull-right">Tambah</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>


<script>
    //auto focus kolom merk
    $( document ).ready(function() {
//        $("#nama").focus();
    });
    //function tambah delete data
    function tambah_supplier() {
        $.ajax({
            url : '<?=site_url('master/tambah_supplier.php')?>',
            data: $('#form_add_supplier').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
            }
        });
    }
</script>