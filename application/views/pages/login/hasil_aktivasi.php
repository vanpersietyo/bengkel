<?php
/**
 * Created by PhpStorm.
 * User: Adhitya
 * Date: 26/10/2018
 * Time: 20:05
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: tipk
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

            <form class="login100-form validate-form" method="post" id="form_login" action="javascript:void(0)" onsubmit="cek_login()">
                        <span class="login100-form-title">
                            Login Ke SiBengkeL
                        </span>
                <div class="result-content"> </div>
                <div class="wrap-input100 validate-input">
                    <input class="input100" type="text" name="username" placeholder="Username / Email" autocomplete="username">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100" type="password" name="password" placeholder="Password" autocomplete="current-password">
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
                </div>


                <div class="text-center p-t-136">
                    <a class="txt2" href="<?=site_url('register')?>">
                        Pelanggan Baru? Daftar Akun Baru disini !
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>