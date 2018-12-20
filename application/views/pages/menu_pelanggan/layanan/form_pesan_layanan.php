<?php
/**
 * Created by PhpStorm.
 * User: tipk
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
            <form class="form-horizontal" method="post"  action="javascript:void(0)" id="form_add_penjualan" onsubmit="tambah_penjualan()">
                <!-- start box-body -->
                <div class="box-header with-border">
                    <h3 class="box-title">Header Pesanan Transaksi</h3>
                </div>

                <div class="box-body with-border padding_bottom">

                    <div class="box-body pad">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label >Kode Penjualan</label>
                                    <input readonly="readonly" type="text" name="kode_penjualan" value="<?=$kode_penjualan?>" class="form-control">
                                </div>
                                <div class="col-lg-6">
                                    <label>Antrian</label>
                                    <input readonly="readonly" type="text" name="antrian" class="form-control" value="<?=$antrian?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label >Tanggal</label>
                                    <input type="text" name="tgl_penjualan" data-date-format="dd/mm/yyyy" value="<?=date('d/m/Y')?>" class="form-control" id="datepicker">
                                </div>
                                <div class="col-lg-6">
                                    <label>Waktu</label>
                                    <input type="text" id="timepicker" name="waktu" class="form-control timepicker" value="<?=date('H:i:s')?>">
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
                                    <label for="namaPemesan">Pilih Kendaraan</label>
                                    <div class="input-group">
                                        <select id="kode_kendaraan" data-live-search-placeholder="Cari Kendaraan" class="selectpicker form-control" name="kode_kendaraan" data-show-subtext="true" data-live-search="true">
                                            <?php
                                            $i = 1;
                                            foreach ($kendaraan->result() as $key => $value){ ?>
                                                <option value="<?=$value->id?>"><?=$value->merk.' - '.$value->tipe?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="input-group-btn">
                                    <a type="button" class="btn btn-primary btn-flat" href="<?= site_url('master/kendaraan.php')?>" title="Tambah Supplier"><i class="fa fa-plus"></i></a>
                                </span>
                                    </div>
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
    function tambah_penjualan() {
        loading();
        $.ajax({
            url : "<?=site_url('add_antrian.do')?>",
            data: $('#form_add_penjualan').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
            }
        });
    }

    $(function () {
        //data tabel
        $('#example2').DataTable({
            'paging'      : false,
            'lengthChange': false,
            'searching'   : false,
            'autoWidth'   : false,
            'info'        : false,
            'ordering'    : false
        });
        //data tabel
        $('#example').DataTable({
            'paging'      : false,
            'lengthChange': false,
            'searching'   : false,
            'autoWidth'   : false,
            'info'        : false,
            'ordering'    : false
        });
    });

    $(function() {
        var date = new Date();
        date.setDate(date.getDate());
        $('#datepicker').datepicker({
            startDate: date,
            autoclose: true
        });

        $('.timepicker').timepicker({
            showInputs: false,
            timeFormat: 'h:mm:ss p'
        });
    });

</script>

