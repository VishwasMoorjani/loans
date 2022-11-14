  <!-- /.content -->
  <div class="clearfix"></div>
  <!-- Footer -->
  <footer class="site-footer bg-white p-2">
    <div class="container-fluid">
      <div class="footer-inner">
        <div class="row">
          <div class="col-sm-6">  </div>
          <!-- <div class="col-sm-6 text-right"> Designed by <a href="#">Course Saviour</a> </div> -->
        </div>
      </div>
    </div>
  </footer>
  <!-- /.site-footer --> 
</div>
<!-- /#right-panel --> 
<script type="text/javascript">
//Delete Record
    function deleteRecord($this) {
        $('#DeleteModal').modal('show');
        $('#RecordID').val($($this).data('id'));
        $('#DeleteForm').attr('action', $($this).data('url'));
    }

    function callBackCommonDelete(data)
    {
        $('#DeleteModal').modal('hide');
        $('#alert_confirm_div').modal('hide');
        // submitSearchData();
        location.reload();
    }

//Change Record Status
    function changeStatusCommon($this)  {
        var action_url = $($this).attr('data-url');
        var record_id = $($this).attr('data-id');
        var next_status = $($this).attr('data-status');
        if(action_url && record_id && next_status)
        {
            $.getJSON(action_url,{id:record_id,status:next_status},function(data){
                if(data.success)
                {
                    checkTosterResponse(data);
                    // submitSearchData();
                    location.reload();
                }
            })
        }
    }
</script>


<script>
            $(document).ready(function() {
                $("#menuToggle").click(function() {
                    $("body").toggleClass("open");
                });
            });
        </script> 
<script>
            $(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script> 
<script>
            jQuery(document).ready(function($) {
                var alterClass = function() {
                    var ww = document.body.clientWidth;
                    if (ww < 768) {
                        $("body").addClass("open");
                    } else if (ww >= 769) {
                        $("body").removeClass("open");
                    }
                };
                $(window).resize(function() {
                    alterClass();
                });
                //Fire it when the page first loads:
                alterClass();
            });
        </script>
</body>
</html>