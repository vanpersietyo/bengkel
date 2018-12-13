<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 13/12/2018
 * Time: 17:19
 */
?>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Tambah Data Kendaraan</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" method="post"  action="javascript:void(0)" id="form_add_kendaraan" onsubmit="tambah_kendaraan()">
        <div class="box-body">

            <div class="form-group">
                <div class="col-lg-12">
                    <label>Merk / Tipe Kendaraan</label>
                    <select data-live-search-placeholder="Cari Kendaraan" class="selectpicker form-control" name="id_kendaraan" data-show-subtext="true" data-live-search="true">
                        <?php
                        $i = 1;
                        foreach ($kendaraan->result() as $key => $value){ ?>
                            <option value="<?=$value->id?>"><?=$value->merk.' - '.$value->tipe?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <label >Nomor Polisi</label>
                    <input type="text" name="nopol" required="required" class="form-control" placeholder="Ex : W 1234 BC">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <label >Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" placeholder="Keterangan Kendaraan">
                </div>
            </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <a href="<?= site_url('master/kendaraan.php')?>" type="button" class="btn btn-default">Batal</a>
            <button type="submit" class="btn btn-info pull-right">Tambah</button>
        </div>
        <!-- /.box-footer -->
    </form>
</div>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    });
    //function tambah delete data
    function tambah_kendaraan() {
        $.ajax({
            url : '<?=site_url('tambah_kendaraan.php')?>',
            data: $('#form_add_kendaraan').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
            }
        });
    }
</script>
