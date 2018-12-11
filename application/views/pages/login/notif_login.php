<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 23/10/2018
 * Time: 11:04
 */
?>

<?php
if ($notif=='login_sukses') {?>
    <script type='text/javascript'>
        swal({
            title: '<strong>Welcome <?=$this->session->userdata("username");?> </strong>',
            type: 'success',
            html:
            '<h5>Login Berhasil. </h5>',
            showCloseButton: false,
            showCancelButton: false,
            showConfirmButton: false,
        });

        setTimeout(function(){
            window.location.href = '<?=site_url('dashboard')?>';
            },
        500);

    </script>
    <?php
} elseif ($notif=='login_gagal') {?>
    <script type='text/javascript'>
        swal({
            title: '<strong>Login Gagal</strong>',
            type: 'error',
            html:
                '<h5>Cek Username / Email dan Password Anda. </h5>',
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
        })
    </script>
    <?php
} elseif ($notif=='register_gagal') {?>

        <script type='text/javascript'>
        swal.close();
        </script>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fa fa-ban"></i> Alert!</h5>
        <?php echo validation_errors()?>
    </div>
    <?php
} elseif ($notif=='register_sukses') {
    if ($result==1){?>
        <script type='text/javascript'>
            swal({
                title: 'Berhasil',
                html: '<h5>Silahkan Cek Email Untuk Aktivasi</h5>',
                type: 'success',
                showCancelButton: false,
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oke'
            }).then((result) => {
                if (result.value) {
                window.location.href = '<?=site_url('register')?>';
            }
            })

        </script>
    <?php }else{?>
        <script type='text/javascript'>
            swal({
                type    : 'error',
                title   : 'Gagal',
                html    : '<h5>Silahkan Coba Kembali</h5>',
                // timer   : 1000
            })
        </script>
    <?php    }
} elseif ($notif=='aktivasi_gagal') {?>

    <script type='text/javascript'>
        $( document ).ready(function() {
            swal({
                type    : 'error',
                title   : 'Aktivasi Gagal',
                html    : '<h5>Link Sudah Tidak Valid</h5>',
            })
        });
    </script>
    <?php
} elseif ($notif=='aktivasi_sukses') {?>

    <script type='text/javascript'>
        $( document ).ready(function() {
            swal({
                type    : 'success',
                title   : 'Aktivasi Berhasil',
                html    : '<h5>Silahkan Login Ke Si Bengkel</h5>',
            })
        });
    </script>
    <?php
} elseif ($notif=='forgot_password_gagal') {?>
<!--    <script type='text/javascript'>-->
<!--        swal({-->
<!--            title: '<strong>Gagal</strong>',-->
<!--            type: 'error',-->
<!--            html:-->
<!--                '<h5>Username / Email Belum Terdaftar</h5>',-->
<!--            showCloseButton: true,-->
<!--            showCancelButton: false,-->
<!--            focusConfirm: false,-->
<!--        })-->
<!--    </script>-->
    <script type='text/javascript'>
        swal.close();
    </script>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close text-center center" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fa fa-ban"></i> Alert!</h5>
        <p>Username / Email Belum Terdaftar</p>
    </div>

    <?php
} elseif ($notif=='kirim_forgot_password_gagal') {?>
    <script type='text/javascript'>
        swal.close();
    </script>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close text-center center" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fa fa-ban"></i> Alert!</h5>
        <p>Pengiriman Email Gagal. Coba Lagi!</p>
        <?php //echo $this->email->print_debugger() ;?>
    </div>

    <?php
} elseif ($notif=='forgot_password_sukses') {?>
    <script type='text/javascript'>
        swal.close();
    </script>

    <script type='text/javascript'>
        swal({
            title: 'Berhasil',
            html: "<h5>Silahkan Cek Email Untuk Reset Password</h5>",
            type: 'success',
            showCancelButton: false,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oke'
        }).then((result) => {
            if (result.value) {
            window.location.href = '<?=site_url('forgot_password')?>';
        }
        })
    </script>

    <?php
} elseif ($notif=='reset_gagal') {?>

    <script type='text/javascript'>
        $( document ).ready(function() {
            swal({
                type    : 'error',
                title   : 'Reset Password Gagal',
                html    : '<h5>Link Sudah Tidak Valid</h5>',
            })
        });
    </script>
    <?php
}elseif ($notif=='input_reset_password_gagal') {?>

    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close text-center center" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fa fa-ban"></i> Alert!</h5>
        <?php echo validation_errors()?>
    </div>

<?php }elseif ($notif=='input_reset_password_sukses') {?>

    <script type='text/javascript'>
        swal({
            title: 'Berhasil',
            html: "<h5>Reset Password Sukses. Silahkan Login</h5>",
            type: 'success',
            showCancelButton: false,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oke'
        }).then((result) => {
            if (result.value) {
            window.location.href = '<?=site_url('login')?>';
        }
        })
    </script>

<?php } ?>


