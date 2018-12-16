<?php
/**
 * Created by PhpStorm.
 * User: Adhitya
 * Date: 15/12/2018
 * Time: 23:54
 */
?>

<div class="row">
    <!--  start  -->
    <div class="col-lg-4">
        <!--start box-->
        <div class="box">
            <!--start form-->
                <!-- start box-body -->
                <div class="box-body with-border">
                    <div class="box-body pad">

                        <div>
                            <label for="AlamatPemesan">Kode Pembelian</label>
                            <input disabled="disabled" type="text" name="kode_pembelian" value="<?=$pembelian->kode_pembelian?>" class="form-control">
                        </div>

                        <div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <label >Tanggal</label>
                                    <input disabled="disabled" class="form-control" value="<?=dateIndo(formatDate($pembelian->tgl_pembelian,'d-m-Y'),1,date('N'))?>">
                                </div>
                                <div class="col-lg-4 padding_left">
                                    <label>Waktu</label>
                                    <input disabled="disabled"  class="form-control" value="<?=formatDate($pembelian->tgl_pembelian,'H:i:s')?>">
                                </div>
                            </div>
                        </div>

                        <div>
                        <label for="namaPemesan">Nama Supplier</label>
                            <input disabled="disabled" class="form-control pull-right" value="<?=$supplier->kode_supplier.' - '.$supplier->nama_supplier?>">
                        </div>

                        <div>
                            <label>Keterangan</label>
                            <input disabled="disabled" class="form-control" value="<?=$pembelian->keterangan_pembelian?>">
                        </div>

                    </div>
                    <!-- /.form group -->
                </div>
                <!-- end box-body -->
        </div>
        <!--end box-->
    </div>
    <!--  end  -->

    <!--  start  -->
    <div class="col-lg-8 padding_left">

        <div class="row">
            <div class="col-md-12">
                <!--start box-->
                <div class="box">
                    <!-- start box-body -->
                    <form method="post"  action="javascript:void(0)" id="form_add_pembelian_barang" onsubmit="tambah_pembelian_barang()">

                        <div class="box-body with-border">
                            <!-- form group -->
                            <div class="form-group">

                                <div class="row padding_bottom">
                                    <div class="col-lg-6 padding_right">
                                        <label>Spare Part</label>
                                        <select onchange="cari_barang()" id="kode_barang" data-live-search-placeholder="Cari Supplier" autofocus="autofocus" class="selectpicker form-control" name="kode_barang" data-show-subtext="true" data-live-search="true">
                                            <option value=""> -- Cari Spare Part -- </option>
                                            <?php
                                            $i = 1;
                                            foreach ($daftar_barang->result() as $key => $value){ ?>
                                                <option value="<?=$value->kode?>"><?=$value->kode.' - '.$value->nama?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 padding_both">
                                        <label>Qty</label>
                                        <input onfocus="$(this).select()" type="number" min="0" class="form-control" id="qty" name="qty" value="0" onkeyup="hitung_subtotal()">
                                    </div>
                                    <div class="col-lg-3 padding_left">
                                        <label>Satuan</label>
                                        <input type="text" readonly="readonly" id="satuan" class="form-control" name="satuan">
                                    </div>
                                </div>

                                <div class="row padding_top">
                                    <div class="col-lg-6 padding_right">
                                        <label>Harga (Rp.) </label>
                                        <input onkeyup="hitung_subtotal()" onfocus="$(this).select()" type="text" class="form-control" id="harga" name="harga">
                                    </div>
                                    <div class="col-lg-6 padding_left">
                                        <label>Subtotal (Rp.)</label>
                                        <input readonly="readonly" type="text" class="form-control" id="subtotal" name="subtotal">
                                    </div>
                                </div>

                            </div>
                            <!-- /.form group -->
                            <!-- end box-body -->
                        </div>
                        <!-- start box-footer -->
                        <div class="box-footer">
                            <button type="button" onclick="reset_form()" class="btn btn-danger">Reset</button>
                            <button type="submit" class="btn btn-info pull-right">Tambah</button>
                        </div>
                        <!-- end box-footer -->
                        <!--end box-->
                    </form>

                </div>
                <!--end box-->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!--start box-->
                <div class="box">
                    <!-- start box-body -->
                    <div class="box-body with-border">
                        <div class="box-body pad">

                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No.</th>
                                        <th width="30%">Spare Part</th>
                                        <th width="10%">Qty</th>
                                        <th width="10%">Satuan</th>
                                        <th width="15%">Harga</th>
                                        <th width="15%">Subtotal</th>
                                        <th width="12%">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1; foreach ($pembelian_barang->result() as $key => $value){?>
                                        <tr>
                                            <td class="text-center"><?=$i++?></td>
                                            <td ><?=$value->kode_barang.' - '.capitalize_each_first($value->nama_barang);?></td>
                                            <td class="text-center"><?=$value->qty;?></td>
                                            <td><?=$value->satuan;?></td>
                                            <td><?=$value->harga;?></td>
                                            <td><?=numberFormat($value->subtotal);?></td>
                                            <td class="text-center">
                                                <a title="edit data kendaraan" class="btn btn-flat btn-primary btn-xs" href="<?= site_url('edit_pembelian_barang/').$value->kode_pembelian.'/'.$value->kode_barang?>"><i class="fa fa-edit"></i></a>
                                                <a title="hapus data kendaraan" class="btn btn-flat btn-danger btn-xs" onclick="delete_pembelian_barang('<?=$value->kode_pembelian?>','<?=$value->kode_barang?>')" href="javascript:void(0)"><i class="fa fa-close"></i></a>
                                            </td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                    <tfoot>
                                    <tr >
<!--                                        <th colspan="2" class="text-right"> Jenis Barang:</th>-->
<!--                                        <th class="text-center"> --><?//=sizeof($pembelian_barang)?><!--</th>-->
                                        <th colspan="5" class="text-right">Total Tagihan (Rp)</th>
                                        <th colspan="2"> <?=numberFormat($pembelian->total_pembelian)?></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>

                        <div class="box-footer text-center">
                            <a type="button" href="<?= site_url('order_pembelian.php')?>" class="btn btn-warning">Kembali</a>
                            <a type="button" href="#" onclick="delete_pembelian('<?=$pembelian->kode_pembelian?>')" class="btn btn-danger">Hapus</a>
                            <a type="button" href="<?= site_url('simpan_pembelian_barang/').$pembelian->kode_pembelian?>" class="btn btn-primary">Simpan</a>
                            <a type="button" href="<?= site_url('bayar_pembelian_barang/').$pembelian->kode_pembelian?>" class="btn btn-info">Simpan & Bayar</a>
                        </div>

                    </div>
                    <!-- end box-body -->
                </div>
                <!--end box-->
            </div>
        </div>


    </div>
    <!--  end  -->
</div>

<div class="result_content"></div>
<?php echo $this->session->flashdata('notif');?>

<script>

    function reset_form() {
        $("#form_add_pembelian_barang")[0].reset();
    }

    function cari_barang() {
        $('#qty').val(0);
        $('#satuan').val('');
        $('#harga').val(0);
        $('#subtotal').val(0);
        $.ajax({
            url : "<?=site_url('cari_barang_pembelian.php')?>",
            data: $('#form_add_pembelian_barang').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
            }
        });
    }

    //fungsi untuk konversi titik
    function converttoint(money) {
        a= money.replace(/,/g, '');
        b= parseInt(a);
        return b;
    }

    //untuk mengisi subtotal
    function hitung_subtotal() {
        var a;
        var b;
        var c;
        a = parseInt(document.getElementById("qty").value);
        b = converttoint(document.getElementById("harga").value);
        c = parseInt(a*b);
        $('#subtotal').val(c);
    }

    $(document).ready(function() {
        //untuk format input uang
        $("#harga").inputmask({
            groupSeparator: ".",
            alias: "numeric",
            placeholder: "0",
            autoGroup: !0,
            digits: 0,
            digitsOptional: !1,
            clearMaskOnLostFocus: !1,
            rightAlign: false
        });//untuk format input uang kolom subtotal
        $("#subtotal").inputmask({
            groupSeparator: ".",
            alias: "numeric",
            placeholder: "0",
            autoGroup: !0,
            digits: 0,
            digitsOptional: !1,
            clearMaskOnLostFocus: !1,
            rightAlign: false
        });
    });

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        //data tabel
        $('#example2').DataTable({
            'paging'      : false,
            'lengthChange': false,
            'searching'   : false,
            'autoWidth'   : false
        });
    });

    //function tambah data
    function tambah_pembelian_barang() {
        $.ajax({
            url : "<?=site_url('add_pembelian_barang.do/'.$pembelian->kode_pembelian)?>",
            data: $('#form_add_pembelian_barang').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
            }
        });
    }
    //function untuk delete data
    function delete_pembelian_barang($kode_pembelian,$kode_barang) {
        swal({
            title: 'Delete Data?',
            html: '<h5>Yakin akan delete data pembelian ini?</h5>',
            type: 'info',
            showCancelButton: true,
        }).then((result) => {
            if (result.value) {
                window.location.href = "<?= site_url('delete_pembelian_barang/')?>"+$kode_pembelian+'/'+$kode_barang;
            }
        })
    }
    //function untuk delete data
    function delete_pembelian($id) {
        swal({
            title: $id,
            html: '<h5>Yakin akan delete data pembelian ini?</h5>',
            type: 'info',
            showCancelButton: true,
        }).then((result) => {
            if (result.value) {
                window.location.href = "<?= site_url('delete_order_pembelian/')?>"+$id;
            }
        })
    }

</script>
