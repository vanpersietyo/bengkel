<?php
/**
 * Created by PhpStorm.
 * User: Candra Dewi
 * Date: 22/10/2018
 * Time: 14:45
 */
?>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url('assets/adminlte/')?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- datepicker-->
<script src="<?=base_url('assets/adminlte/')?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url('assets/adminlte/')?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="<?=base_url('assets/adminlte/')?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url('assets/adminlte/')?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/adminlte/')?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('assets/adminlte/')?>dist/js/demo.js"></script>
<!--additional-->

<!-- PACE -->
<script src="<?=base_url('assets/adminlte/')?>bower_components/PACE/pace.min.js"></script>
<!-- icheck -->
<script src="<?=base_url('assets/adminlte/')?>plugins/iCheck/icheck.min.js"></script>
<!-- DataTables -->
<script src="<?=base_url('assets/adminlte/')?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets/adminlte/')?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url('assets/adminlte/')?>bower_components/datatables.net-bs/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url('assets/adminlte/')?>bower_components/datatables.net-bs/js/buttons.html5.min.js"></script>
<script src="<?=base_url('assets/adminlte/')?>bower_components/datatables.net-bs/js/pdfmake.min.js"></script>
<script src="<?=base_url('assets/adminlte/')?>bower_components/datatables.net-bs/js/buttons.print.min.js"></script>
<script src="<?=base_url('assets/adminlte/')?>bower_components/datatables.net-bs/js/jszip.min.js"></script>
<script src="<?=base_url('assets/adminlte/')?>bower_components/datatables.net-bs/js/vfs_fonts.js"></script>
<!-- sweetalert -->
<script src="<?=base_url('assets/third_party/').'sweetalert/dist/sweetalert2.all.min.js'?>"></script>
<script src="<?=base_url('assets/third_party/').'sweetalert/dist/sweetalert2.min.js'?>"></script>
<!--select 2 -->
<script src="<?=base_url('assets/adminlte/').'bower_components/select2/dist/js/select2.full.min.js'?>"></script>
<!--selectpicker-->
<script src="<?=base_url('assets/adminlte/').'bower_components/bootstrap-selectpicker/dist/js/bootstrap-select.min.js'?>"></script>

<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree();
    });

    function push_menu(){
        $( "#push-menu" ).click();
    }
    function loading() {
        swal({
            html: '<div id="fountainG">' +
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
            allowOutsideClick: false,
        });
    }
</script>
</body>
</html>
