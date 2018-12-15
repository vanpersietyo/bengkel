<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 14/12/2018
 * Time: 18:03
 */
?>
<style>
    .padding_right{
        padding-right: 5px !important;
    }
    .padding_left{
        padding-left: 5px !important;
    }
    .padding_both{
        padding-right: 5px !important;
        padding-left: 5px !important;
    }
</style>

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
                            <input readonly="readonly" type="text" name="kode_pembelian" value="" class="form-control">
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-8">
                                    <label >Tanggal</label>
                                    <input readonly="readonly" type="text" name="tanggal_pembelian" class="form-control" value="<?=dateIndo(date('d-m-Y'),1,date('N'))?>">
                                </div>
                                <div class="col-lg-4">
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

    <!--  start  -->
    <div class="col-lg-8 padding_left">

        <div class="row">
            <div class="col-md-12">
                <!--start box-->
                <div class="box">
                        <!-- start box-body -->
                    <div class="box-body with-border">
                                <!-- form group -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3 padding_right">
                                            <label>Spare Part</label>
                                            <select id="kode_supplier" data-live-search-placeholder="Cari Supplier" class="selectpicker form-control" name="kode_supplier" data-show-subtext="true" data-live-search="true">
                                                <option value=""> -- Cari Spare Part -- </option>
                                                <?php
                                                $i = 1;
                                                foreach ($daftar_barang->result() as $key => $value){ ?>
                                                    <option value="<?=$value->kode?>"><?=$value->kode.' - '.$value->nama?></option>
                                                <?php } ?>
                                            </select></div>

                                        <div class="col-lg-1 padding_both">
                                            <label>Qty</label>
                                            <input type="number" min="0" class="form-control" id="qty" name="qty" value="0">
                                        </div>

                                        <div class="col-lg-2 padding_both">
                                            <label>Satuan</label>
                                            <input type="text" readonly="readonly" class="form-control" name="satuan">
                                        </div>

                                        <div class="col-lg-3 padding_both">
                                            <label>Harga (Rp.) </label>
                                            <input type="number" min="0" class="form-control" id="harga" name="harga" value="0">
                                        </div>

                                        <div class="col-lg-3 padding_left">
                                            <label>Subtotal (Rp.)</label>
                                            <input type="number" min="0" class="form-control" id="subtotal" name="harga" value="0">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.form group -->
                        <!-- end box-body -->
                    </div>

                    <!-- start box-footer -->
                    <div class="box-footer">
                                <button type="button" class="btn btn-danger">Reset</button>
                                <button type="submit" class="btn btn-info pull-right">Tambah</button>
                            </div>
                    <!-- end box-footer -->
                <!--end box-->
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
                                        <th width="20%">Qty</th>
                                        <th width="15%">Satuan</th>
                                        <th width="15%">Harga</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

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
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        $('#example2').DataTable({
            'paging'      : false,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        });
    });


    //function tambah data
    function tambah_pembelian() {
        $.ajax({
            url : "<?=site_url('add_pembelian.do')?>",
            data: $('#form_add_pembelian').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
            }
        });
    }
</script>