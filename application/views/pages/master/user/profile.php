<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 27/10/2018
 * Time: 22:16
 */
?>

<?php echo $this->session->flashdata('notif');?>
<div class="result_content"></div>

<div class="row">

    <div class="col-lg-12" >

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><?=capitalize_each_first($user->nama);?></h3>
            </div>
            <div class="panel-body">
                <table class="table table-user-information">
                    <tbody>
                    <tr>
                        <td>Nama</td>
                        <td>: <?=capitalize_each_first($user->nama)?></td>
                    </tr>
                    <tr>
                        <td>No. Registrasi</td>
                        <td>: <?=$user->no_registrasi?></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>: <?=$user->username;?></td>
                    </tr>
                    <tr>
                        <td>Member Sejak</td>
                        <td>: <?=formatDate($user->entry_time,'d-m-Y')?></td>
                    </tr>

                    <tr>

                    <tr>
                        <td>Level</td>
                        <td>: <?=capitalize_each_first($subtitle);?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: <?=$user->alamat?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>: <a href="mailto:<?=$user->email?>"><?=$user->email?></a></td>
                    </tr>
                    <td>Nomor Telepon</td>
                    <td>: <?=$user->telepon?>
                    </td>

                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <a href="<?=site_url('ubah_profile.php')?>" data-original-title="Ubah Profile" data-toggle="tooltip" type="button" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="<?=site_url('dashboard')?>" data-original-title="Batal" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger pull-right"><i class="glyphicon glyphicon-remove"></i></a>
            </div>

        </div>
    </div>
</div>