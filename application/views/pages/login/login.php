<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 23/10/2018
 * Time: 12:00
 */
?>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="<?=base_url('assets/login/')?>images/img-02.png" alt="IMG">
            </div>

            <!-- notif -->
            <?=$this->session->flashdata('login');?>
            <!-- notif -->

            <form class="login100-form validate-form" method="post" id="form_login" action="javascript:void(0)" onsubmit="cek_login()">
                        <span class="login100-form-title">
                            Login Ke SiBengkeL
                        </span>
                <div class="result-content"> </div>
                <div class="wrap-input100 validate-input">
                    <input class="input100" type="text" name="username" placeholder="Username / Email" autocomplete="off"  required="required">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100" type="password" name="password" placeholder="Password" autocomplete="off"  required="required">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" id="button_login">
                        Login
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
                    <a class="txt2" href="<?=site_url('register')?>">
                        Pelanggan Baru? Daftar Akun Baru disini !
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>



                <div class="text-center p-t-136">

                </div>

            </form>
        </div>
    </div>
</div>


<script type="text/javascript">

    function cek_login(){
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
            url : "<?php echo site_url('login/cek_login');?>",
            data: $('#form_login').serialize(),
            success: function(result){
                swal.close();
                $('.result-content').html(result)
            },
            error: function(result){
                $('.result-content').html(result)
            },
        });
    };
</script>