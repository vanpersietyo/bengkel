<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 19/12/2018
 * Time: 9:37
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
                    <h3 class="box-title">Header Transaksi Penjualan</h3>
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
                                    <input readonly="readonly" type="text" name="tgl_penjualan" class="form-control" value="<?=dateIndo(date('d-m-Y'),1,date('N'))?>">
                                </div>
                                <div class="col-lg-6">
                                    <label>Waktu</label>
                                    <input readonly="readonly" type="text" name="waktu" class="form-control" value="<?=date('H:i:s')?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="namaPemesan">Pilih Pelanggan</label>
                                    <div class="input-group">
                                        <select id="kode_pelanggan" data-live-search-placeholder="Cari Pelanggan" class="selectpicker form-control" name="kode_pelanggan" autofocus="autofocus" data-show-subtext="true" data-live-search="true">
                                            <?php
                                            $i = 1;
                                            foreach ($pelanggan->result() as $key => $value){
                                                if($value->no_registrasi=='462TP36UOE'){?>
                                                    <option selected="selected" value="<?=$value->no_registrasi?>"><?=$value->nama?></option>
                                                <?php }else{?>
                                                    <option value="<?=$value->no_registrasi?>"><?=$value->nama?></option>
                                                <?php }?>
                                            <?php } ?>
                                        </select>
                                        <span class="input-group-btn">
                                    <a type="button" class="btn btn-primary btn-flat" href="<?= site_url('master/add_pelanggan.php')?>" title="Tambah Supplier"><i class="fa fa-plus"></i></a>
                                </span>
                                    </div>
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

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="AlamatPemesan">Keterangan</label>
                                    <textarea name="keterangan_penjualan" class="form-control" type="text"  rows="4" cols="50" placeholder="Keterangan Penjualan"></textarea>
                                </div>
                                <div class="col-lg-6">
                                    <label for="AlamatPemesan">No. Polisi Kendaraan</label>
                                    <input name="nopol_kendaraan" required="required" class="form-control" type="text" placeholder="W 1234 YZ"><!--                            <input type="text" name="keterangan_penjualan" class="form-control pull-right" placeholder="Keterangan">-->
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
</script>
