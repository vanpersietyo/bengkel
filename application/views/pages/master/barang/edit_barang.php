<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 09/12/2018
 * Time: 11:11
 */
?>
<div class="row">
    <div class="col-md-4">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Ubah Data <?=$subtitle?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post"  action="javascript:void(0)" id="form_edit_barang" onsubmit="edit_barang()">
                <div class="box-body">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Kode <?=$subtitle?></label>
                            <input type="text" readonly="readonly" class="form-control" name="kode" value="<?=$barang->kode;?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-12">
                            <label>Jenis <?=$subtitle?></label>
                            <select data-live-search-placeholder="Cari <?=$jenis?>" class="selectpicker form-control" name="kategori" data-show-subtext="true" data-live-search="true">
                                <?php
                                $i = 1;
                                foreach ($kategori->result() as $key => $value){
                                    if ($value->kode_kategori==$barang->kode_kategori){?>
                                        <option selected="selected" value="<?=$value->kode_kategori?>"><?=$value->kode_kategori.' - '.$value->nama_kategori?></option>
                                    <?php }else{?>
                                        <option value="<?=$value->kode_kategori?>"><?=$value->kode_kategori.' - '.$value->nama_kategori?></option>
                                        <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Nama <?=$subtitle?></label>
                            <input type="text" class="form-control" name="nama" id="nama" required="required" value="<?=$barang->nama?>">
                        </div>
                    </div>
                    <?php
                    if ($jenis=='spare_part'){?>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label >Satuan <?=$subtitle?></label>
                                <input type="text" class="form-control" name="satuan" required="required" value="<?=$barang->satuan?>">
                            </div>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Harga <?=$subtitle?></label>
                            <input type="text" onfocus="$(this).select()" id="harga" name="harga" value="<?=$barang->harga?>" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label >Keterangan <?=$subtitle?></label>
                            <input type="text" name="keterangan" class="form-control" value="<?=$barang->keterangan?>">
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="<?= site_url('master/'.$jenis.'.php')?>" type="button" class="btn btn-default">Batal</a>
                    <button type="submit" class="btn btn-info pull-right">Ubah</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <?php $this->load->view('pages/master/barang/tabel_barang')?>
    </div>
</div>

<div class="result_content"></div>
<?php echo $this->session->flashdata('notif');?>

<script>//auto focus kolom merk
    $( document ).ready(function() {
        $("#nama").focus();

        //untuk format input uang
        $("#harga").inputmask({
            prefix: "Rp. ",
            groupSeparator: ".",
            alias: "numeric",
            placeholder: "0",
            autoGroup: !0,
            digits: 0,
            digitsOptional: !1,
            clearMaskOnLostFocus: !1,
            rightAlign: false });
    });
    //function tambah delete data
    function edit_barang() {
        $.ajax({
            url : "<?=site_url('master/edit_'.$jenis.'.do')?>",
            data: $('#form_edit_barang').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
            }
        });
    }
</script>
