      <script type="text/javascript">
          $('.tes_ajax').click(function () {
              $.ajax({
                  url: '<?=site_url("admin/tes_ajax")?>',
                  success: function (result) {
                      $('.ajax-content').html(result)
                  }
              })
          })
      </script>
