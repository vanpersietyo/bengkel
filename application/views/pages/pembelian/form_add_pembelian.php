<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 14/12/2018
 * Time: 18:03
 */
?>

<div class="row">
    <!--  start  -->
    <div class="col-lg-4">
        <!--start box-->
        <div class="box">
            <!--start form-->
            <form class="form-horizontal" method="post"  action="javascript:void(0)" id="form_add_pembelian" onsubmit="tambah_pembelian()">
                <!-- start box-body -->
                <div class="box-body with-border">
                    <div class="box-body pad">

                        <div class="form-group">
                            <label for="AlamatPemesan">Kode Pembelian</label>
                            <input readonly="readonly" type="text" name="kode_pembelian" value="<?=$kode_pembelian?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-8">
                                    <label >Tanggal</label>
                                    <input readonly="readonly" type="text" name="tanggal_pembelian" class="form-control" value="<?=dateIndo(date('d-m-Y'),1,date('N'))?>">
                                </div>
                                <div class="col-lg-4 padding_left">
                                    <label>Waktu</label>
                                    <input readonly="readonly" type="text" name="waktu" class="form-control" value="<?=date('H:i:s')?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="namaPemesan">Pilih Supplier</label>

                            <div class="input-group">
                                <select id="kode_supplier" data-live-search-placeholder="Cari Supplier" class="selectpicker form-control" name="kode_supplier" data-show-subtext="true" data-live-search="true">
                                    <option value=""> -- Cari Supplier -- </option>
                                    <?php
                                    $i = 1;
                                    foreach ($daftar_supplier->result() as $key => $value){ ?>
                                        <option value="<?=$value->kode_supplier?>"><?=$value->kode_supplier.' - '.$value->nama_supplier?></option>
                                    <?php } ?>
                                </select>
                                <span class="input-group-btn">
                                    <a type="button" class="btn btn-primary btn-flat" href="<?= site_url('master/add_supplier.php')?>" title="Tambah Supplier"><i class="fa fa-plus"></i></a>
                                </span>
                            </div>


                        </div>

                        <div class="form-group">
                            <label for="AlamatPemesan">Keterangan</label>
                            <input type="text" name="keterangan_pembelian" class="form-control pull-right" placeholder="Keterangan">
                        </div>

                    </div>
                    <!-- /.form group -->
                </div>
                <!-- end box-body -->

                <!-- start box-footer -->
                <div class="box-footer">
                    <a href="<?= site_url('master/kendaraan.php')?>" type="button" class="btn btn-default">Batal</a>
                    <button type="submit" class="btn btn-info pull-right">Tambah</button>
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
    $(function () {
        $('.select2').select2();
    });
    //function tambah data
    function tambah_pembelian() {
        $.ajax({
            url : "<?=site_url('add_supplier_pembelian.php')?>",
            data: $('#form_add_pembelian').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
            }
        });
    }
</script>