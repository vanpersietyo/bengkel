<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 20/12/2018
 * Time: 15:31
 */
?>

<?php echo $this->session->flashdata('notif');?>
<div class="result_content"></div>

<div class="row">
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ubah Data Personal</h3>
            </div>
            <form method="post"  action="javascript:void(0)" id="form_ubah_profile" onsubmit="ubah_profile()">
                <div class="box-body">
                    <?php if($user->username==null){?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input name="username" class="form-control" type="text" placeholder="Masukkan Username Anda">
                        </div>
                    <?php }
                    ?>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama </label>
                        <input class="form-control" required="required" name="nama" type="text" value="<?=$user->nama?>" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat </label>
                        <input class="form-control" name="alamat" type="text" value="<?=$user->alamat?>" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Telepon </label>
                        <input class="form-control" name="telepon" type="text" value="<?=$user->telepon?>" autofocus>
                    </div>


                </div>
                <div class="box-footer text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a type="button" class="btn btn-danger" href="<?=site_url('dashboard')?>">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ubah Password</h3>
            </div>
            <form method="post"  action="javascript:void(0)" id="form_ubah_password" onsubmit="ubah_password()">
                <div class="box-body">
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Current Password </label>
                        <input class="form-control" type="password" name="current_password" placeholder="Password Saat Ini" required="required">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">New Password </label>
                        <input class="form-control" type="password" name="new_password" placeholder="Password Baru" required="required">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Confirm New Password</label>
                        <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password Baru" required="required">
                    </div>


                </div>
                <div class="box-footer text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a type="button" class="btn btn-danger" href="<?=site_url('dashboard')?>">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    });
    //function edit data
    function ubah_profile() {
        $.ajax({
            url : '<?=site_url("ubah_profile.do")?>',
            data: $('#form_ubah_profile').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
            }
        });
    }//function edit data
    function ubah_password() {
        $.ajax({
            url : '<?=site_url("ubah_password.do")?>',
            data: $('#form_ubah_password').serialize(),
            type: 'POST',
            success: function (data) {
                $('.result_content').html(data);
            }
        });
    }
</script>
