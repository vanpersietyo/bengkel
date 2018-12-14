<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 13/12/2018
 * Time: 11:05
 */
?>
<div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Data <?=$subtitle?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post"  action="javascript:void(0)" id="form_edit_supplier" onsubmit="edit_supplier()">
            <div class="box-body">

                <div class="form-group">
                    <div class="col-sm-12">
                        <label >Kode <?=capitalize_each_first($subtitle);?></label>
                        <input type="text" readonly="readonly" class="form-control" name="kode" required="required" value="<?=$supplier->kode_supplier?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label >Nama <?=capitalize_each_first($subtitle);?></label>
                        <input type="text" class="form-control" name="nama" id="nama" required="required" value="<?=capitalize_each_first($supplier->nama_supplier);?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label >Alamat  <?=capitalize_each_first($subtitle);?></label>
                        <input name="alamat" type="text" class="form-control" required="required" value="<?=capitalize_each_first($supplier->alamat_supplier);?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label >Telepon  <?=capitalize_each_first($subtitle);?></label>
                        <input name="telepon" type="tel" class="form-control" required="required" value="<?=$supplier->telp_supplier;?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label >Keterangan  <?=capitalize_each_first($subtitle);?></label>
                        <input type="text" name="keterangan" class="form-control" value="<?=$supplier->keterangan_supplier?>">
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="<?= site_url('master/supplier.php')?>" type="button" class="btn btn-default">Batal</a>
                <button type="submit" class="btn btn-info pull-right">Edit</button>
            </div>
            <!-- /.box-footer -->
        </form>
</div>


<script>
    //auto focus kolom merk
    $( document ).ready(function() {
//        $("#nama").focus();
    });
    //function Edit delete data
    function edit_supplier() {
        $.ajax({
            url : '<?=site_url('master/edit_supplier.php')?>',
            data: $('#form_edit_supplier').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
            }
        });
    }
</script>
