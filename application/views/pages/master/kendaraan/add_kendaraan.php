<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 08/12/2018
 * Time: 18:14
 */
?>

<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Data Kendaraan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post"  action="javascript:void(0)" id="form_add_kendaraan" onsubmit="tambah_kendaraan()">
                <div class="box-body">

                    <div class="form-group">
                        <div class="col-sm-12">

                            <label>Minimal</label>
                            <select onchange="cari_barang()" id="kode_barang" data-live-search-placeholder="Cari Layanan / Spare Part" autofocus="autofocus" class="selectpicker form-control" name="kode_barang" data-show-subtext="true" data-live-search="true">
                                <option value="">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Merk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="merk" id="merk" required="required" placeholder="Merk Kendaraan : Honda, Yamaha, Suzuki, dll.">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Type</label>
                        <div class="col-sm-10">
                            <input name="tipe" type="text" class="form-control" required="required" placeholder="Tipe Kendaraan : Beat, Vario, Vixion, dll.">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-10">
                            <input type="text" name="keterangan" class="form-control" placeholder="Keterangan Kendaraan">
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="button" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-info pull-right">Sign in</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box -->
    </div>
</div>

<script>
    $( document ).ready(function() {
        $("#merk").focus();
    });

    function tambah_kendaraan() {
        $.ajax({
            url : '<?=site_url('master/tambah_kendaraan.do')?>',
            data: $('#form_add_kendaraan').serialize(),
            type: 'POST',
            success: function (data) {

                if (data=='data sudah ada'){
                    swal({
                        type    : 'error',
                        title   : 'Gagal',
                        html    : '<h4>Data Sudah Ada</h4>',
                        allowOutsideClick: false,
                        focusConfirm: true,
                    })
                } else if(data='data sukses'){
                    $("#form_add_kendaraan")[0].reset();
                    $("#merk").focus();
                    swal({
                        type    : 'success',
                        title   : 'Berhasil',
                        html    : '<h4>Data Berhasil Ditambahkan</h4>',
                        allowOutsideClick: false,
                        focusConfirm: true,
                    });
                }

            }
        });
    }
</script>