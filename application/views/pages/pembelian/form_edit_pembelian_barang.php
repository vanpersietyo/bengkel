<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 17/12/2018
 * Time: 9:42
 */
?>

<div class="row">
<?php $this->load->view('pages/pembelian/header_pembelian_barang')?>

    <!--  start  -->
    <div class="col-lg-8 padding_left">

        <div class="row">
            <div class="col-md-12">
                <!--start box-->
                <div class="box">
                    <!-- start box-body -->
                    <form method="post" action="javascript:void(0)" id="form_edit_pembelian_barang" onsubmit="edit_pembelian_barang()">
                        <input type="hidden" name="kode_barang"     value="<?=$barang->kode_barang?>">
                        <input type="hidden" name="kode_pembelian"  value="<?=$pembelian->kode_pembelian?>" >
                        <div class="box-body with-border">
                            <!-- form group -->
                            <div class="form-group">

                                <div class="row padding_bottom">
                                    <div class="col-lg-6 padding_right">
                                        <label>Spare Part</label>
                                        <select disabled="disabled" class="form-control">
                                            <option><?=$barang->kode_barang.' - '.$barang->nama_barang?></option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 padding_both">
                                        <label>Qty</label>
                                        <input onfocus="$(this).select()" type="number" class="form-control" id="qty" name="qty" value="<?=$barang->qty?>" onkeyup="hitung_subtotal()" autofocus="autofocus">
                                    </div>
                                    <div class="col-lg-3 padding_left">
                                        <label>Satuan</label>
                                        <input type="text" readonly="readonly" value="<?=$barang->satuan?>" id="satuan" class="form-control" name="satuan">
                                    </div>
                                </div>

                                <div class="row padding_top">
                                    <div class="col-lg-6 padding_right">
                                        <label>Harga (Rp.) </label>
                                        <input onkeyup="hitung_subtotal()" onfocus="$(this).select()" type="text" class="form-control" id="harga" value="<?=$barang->harga?>" name="harga">
                                    </div>
                                    <div class="col-lg-6 padding_left">
                                        <label>Subtotal (Rp.)</label>
                                        <input readonly="readonly" type="text" class="form-control" id="subtotal" name="subtotal" value="<?=$barang->subtotal?>">
                                    </div>
                                </div>

                            </div>
                            <!-- /.form group -->
                        </div><!-- end box-body -->
                        <!-- start box-footer -->
                        <div class="box-footer">
                            <a type="button" href="<?=site_url('add_pembelian_barang/'.$pembelian->kode_pembelian)?>" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-info pull-right">Ubah</button>
                        </div>
                        <!-- end box-footer -->
                        <!--end box-->
                    </form>
                </div>
                <!--end box-->
            </div>
        </div>

        <div class="row">
            <?php $this->load->view('pages/pembelian/tabel_detail_pembelian_barang')?>
        </div>


    </div>
    <!--  end  -->
</div>

<div class="result_content"></div>
<?php echo $this->session->flashdata('notif');?>

<script>
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
    });

    //function tambah data
    function edit_pembelian_barang() {
        $.ajax({
            url : "<?=site_url('edit_pembelian_barang.do')?>",
            data: $('#form_edit_pembelian_barang').serialize(),
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
</script>

