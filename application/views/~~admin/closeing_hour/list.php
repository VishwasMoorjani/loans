<?php

if ($this->session->flashdata('message')) {

echo '<div class="alert alert-success">' . $this->session->flashdata('message') . '</div>';

}

?>

<div class="container-fluid">

  <div class="path">

    <nav aria-label="breadcrumb">

      <ol class="breadcrumb">

        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>admin">Dashboard</a></li>

        <li class="breadcrumb-item active" aria-current="page"> <?php echo $page_title; ?> </li>

      </ol>

    </nav>

  </div>

</div>

<div class="container-fluid">

  <div class="card search-panel ">

    <div class="card-body">

           <form class="ajax_form" method="post" action="<?php echo site_url() ?>admin/closeing_hour/add">

      <div class="row">

        <div class="col-md-4">

          <div class="card date_time_picker">

            <div class="card-header card-header-icon bg-success" data-background-color="rose">

              <h4 class="card-title"> <i class="fas fa-table"></i> Day</h4>

            </div>

            <div class="card-content">

              

              <div class="form-group is-empty">

                



              <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">

              <select name= "title" class="select2 form-control">

                  <option value="">Select</option>

                  <!-- <option value="today">Today</option> -->

                  <option value="tomorrow">Tomorrow</option>

                  <option value="dft">Day after tomorrow</option>

              </select>

                <span class="material-input"></span>

                <div class="input-group-append">

                    <!-- <span class="input-group-text"> <i class="fas fa-table"></i></span> -->

                  </div>

                </div>





              </div>

              </div>

            </div>

          </div>

          <div class="col-md-4">

            <div class="card date_time_picker">

              <div class="card-header card-header-icon bg-danger" data-background-color="rose">

              <h4 class="card-title"> <i class="far fa-clock"></i> Start Hour</h4>

               

              </div>

              <div class="card-content">

                

                <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">

                  <input type="text" class="form-control"  name="start_hour" id="end_at" readonly="" value="19:00" >

                  <div class="input-group-append">

                    <span class="input-group-text"> <i class="far fa-clock"></i></span>

                  </div>

                </div>

              </div>

            </div>

          </div>

          <div class="col-md-4">

            <div class="card date_time_picker">

              <div class="card-header card-header-icon bg-primary" data-background-color="rose">

              <h4 class="card-title"><i class="far fa-clock"></i> End Hour</h4>

                

              </div>

              <div class="card-content">

               

                <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">

                  <input type="text" class="form-control"  name="end_hour" id="end_at" readonly="" value="19:00">

                  <div class="input-group-append">

                    <span class="input-group-text"> <i class="far fa-clock"></i></span>

                  </div>

                </div>

              </div>

            </div>

            <div>

            </div></div></div>

          <center> <button type="submit" class="btn btn-success rounded-0 mb-4">Submit</button></center>

          </form>

      <!-- Content -->

      <div class="container-fluid">

        <div class="content_container loader-parent">

          

          <div class="admin_table table-responsive">

            <table class="table">

              <thead class="thead-white">

                <tr>

                  <th onclick="sortByColumnName(this);" data-sorting_order="ASC" data-column_name="name"><span id="name"><i class="fa fa-sort" aria-hidden="true"></i></span> Date</th>

                  <th>Start Hour</th>

                  <th> End Hour</th>

                  <th onclick="sortByColumnName(this);" data-sorting_order="ASC" data-column_name="is_status"><span id="status"><i class="fa fa-sort" aria-hidden="true"></i></span> Status</th>

                  <th onclick="sortByColumnName(this);" data-sorting_order="ASC" data-column_name="add_date"><span id="add_date"><i class="fa fa-sort" aria-hidden="true"></i></span> Add Date</th>

                  <th>Options</th>

                </tr>

              </thead>

              <div class="loader-parent">

                <tbody class="container">

                  

                </tbody>

                <div class="loader-bx lodding">

                  <img src="<?php echo site_url(); ?>assets/lodder.gif" alt="loader" class="loadder-img">

                </div>

              </div>

            </table>

            <div class="paging_div">

            </div>

          </div>

          <!-- /.card-body -->

          

          

          

        </div>

      </div>

      

      <script type="text/javascript">

      function sortByColumnName($this) {

      $("#name").html('<i class="fa fa-sort" aria-hidden="true"></i>');

      $("#email").html('<i class="fa fa-sort" aria-hidden="true"></i>');

      $("#phone").html('<i class="fa fa-sort" aria-hidden="true"></i>');

      $("#status").html('<i class="fa fa-sort" aria-hidden="true"></i>');

      $("#add_date").html('<i class="fa fa-sort" aria-hidden="true"></i>');

      var column_name = $($this).attr('data-column_name');

      var sorting_order = $($this).attr('data-sorting_order');

      if(sorting_order == "ASC") {

      $($this).attr('data-sorting_order','DESC');

      $("#"+column_name).html('<i class="fa fa-sort-asc" aria-hidden="true"></i>');

      } else {

      $($this).attr('data-sorting_order','ASC');

      $("#"+column_name).html('<i class="fa fa-sort-desc" aria-hidden="true"></i>');

      }

      var keyword = $('#keyword').val();

      var page_limit = 15;

      var surl = site_url+'admin/closeing_hour/get_ajax_list?page_limit='+page_limit+'&sorting_order='+sorting_order+'&column_name='+column_name;

      getAjaxSearchData(surl);

      }

      function searchRecords()

      {

      var keyword = $('#keyword').val();

      var page_limit = 15;

      var sorting_order = 'DESC';

      var column_name = 'add_date';

      $(".lodding").css('display','block');

      var selfOrInCricle = $('#selfOrInCricle').val();

      var useradminapprove = $('#useradminapprove').val();

      var surl = site_url+'admin/closeing_hour/get_ajax_list?page_limit='+page_limit+'&sorting_order='+sorting_order+'&column_name='+column_name;

      var user_data = getAjaxSearchData(surl);

      //kill the request

      if(keyword.length > 0) {

      user_data.abort()

      }

      }

      function getAjaxSearchData(surl)

      {

      $(".lodding").css('display','block');

      // $(".ajax_content").html('<div class="loader"></div>');

      $('#ticket-popup-loader').addClass('loadercanvas-visible');

      $.getJSON(surl,function(response){

      if (response.success)

      {

      $('#ticket-popup-loader').removeClass('loadercanvas-visible');

      $('.container').html(response.html);

      $('.paging_div').html(response.paging);

      $(".lodding").css('display','none');

      }

      });

      }

      $(document).ready(function(){

      searchRecords();

      $(document).on('click','.pagination a',function(e){

      e.preventDefault();

      $(".lodding").css('display','block');

      if ($(this).hasClass('active'))

      return false;

      if($(this).attr('href'))

      {

      getAjaxSearchData($(this).attr('href'));

      }

      return false;

      })

      });

      </script>

      <!-- Modal -->

      <div class="modal fade" id="DeleteUser" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-dialog" role="document">

          <div class="modal-content">

            <div class="modal-header">

              <h5 class="modal-title" id="exampleModalLabel">Are You Sure ?</h5>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

              <span aria-hidden="true">&times;</span>

              </button>

            </div>

            <div class="modal-body">

              <p>You will not able to revert this.</p>

              <form role="form" method="post" action="" class="ajax_form" id="DeleteUserForm">

                <input type="hidden" class="form-control" name="record_id" value="" id="UserID">

              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                <button type="submit" class="btn btn-danger">Delete</button>

              </div>

            </form>

          </div>

        </div>

      </div>

      <script type="text/javascript">

      function deleteUser($this) {

      $('#DeleteUser').modal('show');

      $('#UserID').val($($this).data('id'));

      $('#customerID').val($($this).data('customer'));

      $('#DeleteUserForm').attr('action', $($this).data('url'));

      }

      

      </script>

      <script type="text/javascript">

      function callBackRefresh()

      {

      searchRecords();

      $('#DeleteUser').modal('hide');

      $('#VerifyUser').modal('hide');

      }

      </script>

      <script type="text/javascript">

      function informationVerified($this) {

      

      $('#VerifyUser').modal('show');

      $('#user_id').val($($this).data('id'));

      $('#VerifyUserForm').attr('action', $($this).data('url'));

      }

      </script>

      <div class="modal fade bs-modal-sm" id="VerifyUser" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-dialog modal-sm">

          <div class="modal-content">

            <form role="form" method="post" action="" class="ajax_form" id="VerifyUserForm">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                <h4 class="modal-title">Verify User</h4>

              </div>

              <div class="modal-body">

                <input type="hidden" class="form-control" name="record_id" value="" id="user_id">

                Are You Sure! You want to Verify it?

              </div>

              <div class="modal-footer">

                <button type="button" class="btn default" data-dismiss="modal">Close</button>

                <button type="submit" class="btn green">Verify</button>

              </div>

            </form>

          </div>

        </div>

      </div>



                      <script type="text/javascript">

            $('.clockpicker').clockpicker();

        </script>



        <script type="text/javascript">

            $('.data-autoclose').datepicker({

    autoclose: true,

    todayHighlight: true,

    format: 'yyyy-mm-dd'

});

</script>