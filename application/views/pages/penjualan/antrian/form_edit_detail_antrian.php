<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 19/12/2018
 * Time: 17:28
 */
?>

<div class="row">
    <!--  start  -->
    <div class="col-lg-4">
        <?php $this->load->view('pages/penjualan/antrian/header_antrian') ?>
    </div>
    <!--  end  -->

    <!--  start  -->
    <div class="col-lg-8 padding_left">

        <div class="row">
            <div class="col-md-12">
                <!--start box-->
                <div class="box">
                    <form method="post"  action="javascript:void(0)" id="form_edit_detail_barang" onsubmit="edit_detail_barang()">

                        <div class="box-body with-border">
                            <!-- form group -->
                            <div class="form-group">

                                <div class="row padding_bottom">
                                    <div class="col-lg-6 padding_right">
                                        <label>Spare Part</label>
                                        <select disabled="disabled" id="kode_barang" class="selectpicker form-control" name="kode_barang">
                                                <option value="<?=$barang->kode_barang?>"><?=$barang->kode_barang.' - '.$barang->nama_barang?></option>
                                        </select>
                                    </div>
                                    <?php if($barang->jenis=='layanan'){?>

                                        <div class="col-lg-3 padding_both">
                                            <label>Qty</label>
                                            <input readonly type="number" class="form-control" id="qty" name="qty" value="1">
                                        </div>

                                        <div class="col-lg-3 padding_left">
                                            <label>Satuan</label>
                                            <input type="text" readonly="readonly" id="satuan" class="form-control" name="satuan">
                                        </div>
                                    <?php }else {?>
                                        <div class="col-lg-3 padding_both">
                                            <label>Qty</label>
                                            <input onfocus="$(this).select()" autofocus="autofocus" type="number" class="form-control" id="qty" name="qty" value="<?=$barang->qty?>" onkeyup="hitung_subtotal()">
                                        </div>

                                        <div class="col-lg-3 padding_left">
                                            <label>Satuan</label>
                                            <input type="text" readonly="readonly" value="<?=$barang->satuan?>" id="satuan" class="form-control" name="satuan">
                                        </div>

                                    <?php } ?>
                                </div>

                                <div class="row padding_top">
                                    <div class="col-lg-6 padding_right">
                                        <label>Harga (Rp.) </label>
                                        <input onkeyup="hitung_subtotal()" value="<?=$barang->harga?>" onfocus="$(this).select()" type="text" class="form-control" id="harga" name="harga">
                                    </div>
                                    <div class="col-lg-6 padding_left">
                                        <label>Subtotal (Rp.)</label>
                                        <input readonly="readonly" type="text" value="<?=$barang->subtotal?>" class="form-control" id="subtotal" name="subtotal">
                                    </div>
                                </div>

                            </div>
                            <!-- /.form group -->
                            <!-- end box-body -->
                        </div>
                        <!-- start box-footer -->
                        <div class="box-footer">
                            <a type="button" href="<?=site_url('add_detail_antrian/'.$barang->kode_penjualan)?>" class="btn btn-danger">Batal</a>
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
            <div class="col-md-12">
                <?php $this->load->view('pages/penjualan/antrian/tabel_detail_antrian') ?>
            </div>
        </div>

    </div>

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

    function edit_detail_barang() {
        loading();
        $.ajax({
            url : "<?=site_url('edit_detail_antrian.do/'.$kode_penjualan.'/'.$barang->kode_barang)?>",
            data: $('#form_edit_detail_barang').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
            }
        });
    }

    //untuk mengisi subtotal
    function hitung_subtotal() {
        var a;
        var b;
        var c;
        a = converttoint(document.getElementById("qty").value);
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

</script>



