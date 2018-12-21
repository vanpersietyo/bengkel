<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 19/12/2018
 * Time: 11:08
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 19/12/2018
 * Time: 9:37
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
                    <form method="post"  action="javascript:void(0)" id="form_add_detail_barang" onsubmit="tambah_detail_barang()">

                        <div class="box-body with-border">
                            <!-- form group -->
                            <div class="form-group">

                                <div class="row padding_bottom">
                                    <div class="col-lg-6 padding_right">
                                        <label>Spare Part</label>
                                        <select onchange="cari_barang()" id="kode_barang" data-live-search-placeholder="Cari Layanan / Spare Part" autofocus="autofocus" class="selectpicker form-control" name="kode_barang" data-show-subtext="true" data-live-search="true">
                                            <option value="">Cari Layanan / Spare Part</option>
                                            <?php
                                            $i = 1;
                                            foreach ($barang->result() as $key => $value){ ?>
                                                <option value="<?=$value->kode?>"><?=$value->kode.' - '.$value->nama?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 padding_both">
                                        <label>Qty</label>
                                        <input onfocus="$(this).select()" type="number" min="0" class="form-control" id="qty" name="qty" value="1" onkeyup="hitung_subtotal()">
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

                        <?php if($penjualan->status_penjualan!=5){?>
                            <div class="box-footer">
                                <button type="button" onclick="reset_form()" class="btn btn-danger">Reset</button>
                                <button type="submit" class="btn btn-info pull-right">Tambah</button>
                            </div>
                        <?php }?>

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
    function reset_form() {
        $("#form_add_detail_barang")[0].reset();
    }

    function cari_barang() {
        $('#qty').val(1);
        $('#satuan').val('');
        $('#harga').val(0);
        $('#subtotal').val(0);
        $.ajax({
            url : "<?=site_url('cari_barang_penjualan.php')?>",
            data: $('#form_add_detail_barang').serialize(),
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

    function tambah_detail_barang() {
        loading();
        $.ajax({
            url : "<?=site_url('add_detail_barang/'.$kode_penjualan)?>",
            data: $('#form_add_detail_barang').serialize(),
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


