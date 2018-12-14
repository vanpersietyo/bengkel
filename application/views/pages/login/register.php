<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 23/10/2018
 * Time: 11:57
 */
?>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="<?=base_url('assets/login/')?>images/img-02.png" alt="IMG">
            </div>

            <form class="login100-form validate-form" method="post" id="form_register" action="javascript:void(0)" onsubmit="cek_register()" autocomplete="off">
                <span class="login100-form-title">
                            Daftar Ke SiBengkeL
                        </span>
                <div class="result-content"> </div>


                <div class="wrap-input100 validate-input">
                    <input class="input100" type="text" name="username" placeholder="Username" autocomplete="off" required="required">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                </div>

                <div class="wrap-input100 validate-input">
                    <input class="input100" type="text" name="email" placeholder="Email" autocomplete="off" required="required">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required"  required="required">
                    <input class="input100" type="password" name="password" id="password" placeholder="Password" autocomplete="off">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required"  required="required">
                    <input class="input100" type="password" name="confirm_password" placeholder="Confirm Password" autocomplete="off">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn button_register" id="button_register">
                        Daftar
                    </button>
                </div>

                <div class="text-center p-t-12">
                            <span class="txt1">
                                Lupa
                            </span>
                    <a class="txt2" href="<?=site_url('forgot_password')?>">
                        Password?
                    </a>
                    <br>
                    <span class="txt1">
                                Sudah Punya Akun?
                            </span>
                    <a class="txt2 ajax_login" href="<?=site_url('login')?>">
                        Login Disini!
                    </a>
                </div>

                <div class="text-center p-t-12">

                </div>

            </form>
        </div>
    </div>
</div>


<!-- notif -->
<?=$this->session->flashdata('register');?>
<!-- notif -->

<script type="text/javascript">

    function cek_register(){
        swal({html : '<div id="fountainG">' +
        '<div id="fountainG_1" class="fountainG"></div>' +
        '<div id="fountainG_2" class="fountainG"></div>' +
        '<div id="fountainG_3" class="fountainG"></div>' +
        '<div id="fountainG_4" class="fountainG"></div>' +
        '<div id="fountainG_5" class="fountainG"></div>' +
        '<div id="fountainG_6" class="fountainG"></div>' +
        '<div id="fountainG_7" class="fountainG"></div>' +
        '<div id="fountainG_8" class="fountainG"></div>' +
        '</div>',
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: false,});
        $.ajax({
            type: "POST",
            url : "<?php echo site_url('login/cek_register');?>",
            data: $('#form_register').serialize(),
            success: function(result){
                swal.close();
                $('.result-content').html(result);
            },
            error: function(result){
                $('.result-content').html(result)
            },
        });
    };
</script>