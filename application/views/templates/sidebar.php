<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 22/10/2018
 * Time: 14:43
 */
?>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <li>
                <a  href="<?=site_url('dashboard')?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <?php
            //load menu template
            $this->load->view('templates/sidebar_menu/'.$this->conversion->get_level());
            ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->
