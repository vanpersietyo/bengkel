<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 20/12/2018
 * Time: 19:24
 */
?>

<div class="row">
    <!--  start  -->
    <div class="col-lg-12">
        <!--start box-->
        <div class="box">
            <!--start form-->
            <form class="form-horizontal" method="post"  action="javascript:void(0)" id="form_add_antrian_pelanggan" onsubmit="tambah_antrian_pelanggan()">
                <!-- start box-body -->
                <div class="box-header with-border">
                    <h3 class="box-title">Header Pesanan Transaksi</h3>
                </div>

                <div class="box-body with-border padding_bottom">

                    <div class="box-body pad">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label >Kode Antrian</label>
                                    <input readonly="readonly" type="text" name="kode_penjualan" value="<?=$kode_penjualan?>" class="form-control">
                                </div>
                                <div class="col-lg-6">
                                    <label for="namaPemesan">Pilih Kendaraan</label>
                                    <div class="input-group">
                                        <select id="kode_kendaraan" data-live-search-placeholder="Cari Kendaraan" class="selectpicker form-control" name="kode_kendaraan" data-show-subtext="true" data-live-search="true">
                                            <?php
                                            $i = 1;
                                            foreach ($kendaraan->result() as $key => $value){ ?>
                                                <option value="<?=$value->id_kendaraan.'|'.$value->nopol_kendaraan?>"><?=$value->merk.' - '.$value->tipe.' - '.$value->nopol_kendaraan?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="input-group-btn">
                                            <a type="button" class="btn btn-primary btn-flat" href="<?= site_url('kendaraan.php')?>" data-original-title="Tambah Kendaraan" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label >Tanggal</label>
                                    <input onchange="cari_antrian()" type="text" name="tanggal" data-date-format="dd-mm-yyyy" value="<?=date('d-m-Y')?>" class="form-control" id="datepicker">
                                </div>
                                <div class="col-lg-6">
                                    <label>Waktu</label>
                                    <input type="text" id="timepicker" name="waktu" value="<?=date('H:i')?>" class="form-control timepicker" >
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="namaPemesan">Keterangan</label>
                                    <textarea name="keterangan_penjualan" class="form-control" type="text"  rows="4" cols="50" placeholder="Keterangan Penjualan"></textarea>
                                </div>
                                <div class="col-lg-6">
                                    <label>Antrian</label>
                                    <input readonly="readonly" type="text" name="antrian" id="antrian" class="form-control" value="<?=$antrian?>">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.form group -->
                </div>
                <!-- end box-body -->

                <!-- start box-footer -->
                <div class="box-footer padding_top">
                    <a href="<?= site_url('add_penjualan.php')?>" type="button" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-info pull-right">Lanjutkan</button>
                </div>
                <!-- end box-footer -->
            </form>
            <!--end form-->
        </div>
        <!--end box-->
    </div>
    <!--  end  -->
</div>

<div class="result_content"></div>
<?php echo $this->session->flashdata('notif');?>

<script>
    //function tambah data
    function tambah_antrian_pelanggan() {
        loading();
        $.ajax({
            url : "<?=site_url('add_antrian_pelanggan.php')?>",
            data: $('#form_add_antrian_pelanggan').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
                swal.close();
            }
        });
    }

    //function cari antrian
    function cari_antrian() {
        loading();
        $.ajax({
            url : "<?=site_url('cari_antrian.php')?>",
            data: $('#form_add_antrian_pelanggan').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
                swal.close();
            }
        });
    }

    $(function() {
        var date = new Date();
        date.setDate(date.getDate());
        $('#datepicker').datepicker({
            startDate: date,
            autoclose: true
        });

        $('.timepicker').timepicker({
            showInputs: false,
            showMeridian: false,
        });
    });

</script>

