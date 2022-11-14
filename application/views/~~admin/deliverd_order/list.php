<?php
if ($this->session->flashdata('message')) {
echo '<div class="alert alert-success">' . $this->session->flashdata('message') . '</div>';
}
?>
<!-- path -->
<div class="container-fluid">
  <div class="path">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"> <?php echo $page_title; ?> </li>
      </ol>
    </nav>
  </div>
</div>
<!-- #path -->
<!-- #path --><div class="container-fluid">
<div class="card search-panel ">
  <div class="card-body">
    <h5 class="card-title" style="display: inline-block;"><?php echo $page_title; ?></h5>
    <div class="row mb-3">
      <div class="col-lg-1 col-md-1 my-2">
        <select name="page_limit" class="form-control input-xsmall input-inline select2" id="page_limit" onchange="searchRecords(this)">
          <option value="5">5</option>
          <option value="15" selected>15</option>
          <option value="20">20</option>
          <option value="50">50</option>
          <option value="100">100</option>
          <option value="300">300</option>
        </select>
      </div>
      <div class="col-lg-3 col-md-6 my-2">
        <input type="text" class="form-control" placeholder="Search By keyword" id="keyword">
      </div>
      <div class="col-lg-2 col-md-4 p-l-0 my-2">
        <button class="btn btn-danger rounded-0" onclick="searchRecords()">Search</button>
      </div>
    </div>
  </div></div></div>
  <!-- Content -->
  <div class="container-fluid">
    <div class="content_container loader-parent">
      
      <div class="admin_table table-responsive">
        <table class="table">
          <thead class="thead-white">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Paid status</th>
              <th>Payment Method</th>
              <th>Delivery Address</th>
              <th>Status</th>
              <th onclick="sortByColumnName(this);" data-sorting_order="ASC" data-column_name="created_at"><span id="created_at">&nbsp;<i class="fa fa-sort" aria-hidden="true"></i></span>&nbsp;Add Date</th>
              <th>Action</th>
            </tr>
          </thead>
          
          <tbody class="container">
            
          </tbody>
          <div class="loader-bx lodding">
            <img src="<?php echo site_url(); ?>assets/lodder.gif" alt="loader" class="loadder-img" >
          </div>
        </table>
        <div class="paging">
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
      $("#"+column_name).html('<i class="fas fa-sort-up"></i>');
      } else {
      $($this).attr('data-sorting_order','ASC');
      $("#"+column_name).html('<i class="fas fa-sort-down"></i>');
      }
      var keyword = $('#keyword').val();
      var page_limit = $('#page_limit').val();
      var surl = site_url+'admin/deliveredorders/get_ajax_list?keyword='+keyword+'&page_limit='+page_limit+'&sorting_order='+sorting_order+'&column_name='+column_name;
      getAjaxSearchData(surl);
}
function searchRecords()
{
    var keyword = $('#keyword').val();
    var page_limit = $('#page_limit').val();
    var sorting_order = 'DESC';
    var column_name = 'created_at';
    $(".lodding").css('display','block');
    var selfOrInCricle = $('#selfOrInCricle').val();
    var useradminapprove = $('#useradminapprove').val();
    var surl = site_url+'admin/deliveredorders/get_ajax_list?keyword='+keyword+'&page_limit='+page_limit+'&sorting_order='+sorting_order+'&column_name='+column_name;
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
  $('.paging').html(response.paging);
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
<div class="modal fade" id="cancle" tabindex="-1" role="dialog" aria-hidden="true">
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
      <form role="form" method="post" action="" class="ajax_form" id="cancleUserForm">
        <input type="hidden" class="form-control" name="record_id" value="" id="order_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Cancle Order</button>
      </div>
    </form>
  </div>
</div>
</div>
<script type="text/javascript">
function cancleorder($this) {
$('#cancle').modal('show');
$('#order_id').val($($this).data('id'));
$('#cancleUserForm').attr('action', $($this).data('url'));
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
  $(document).ajaxComplete(function() {
    $("[data-toggle='tooltip']").tooltip();
});
</script>

<script type="text/javascript">
   function showAddress ($this) {
var address = $($this).data('address');
  $.ajax({
    url: site_url + "admin/deliveredorders/get_address?id=" + address,
    type: 'get',
    dataType: 'json',
    beforeSend: function() {
      $('.lodding').css('display', 'block');
    },
    complete: function() {
     $('.lodding').css('display', 'none');
    },
    success: function(json) {
      if(json.success){
        $('#address').modal('show');
        $('.address-containter').html('<tr><th>Receiver Name</th><td>'+json.address.receiver_name+'</td></tr><tr><th>Receiver Mobile</th><td>'+json.address.receiver_mobile+'</td></tr>      <tr><th>Address</th><td>'+json.address.address+'</td></tr><tr><th>Zip</th><td>'+json.address.zip+'</td></tr>')
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
   }
</script>



<!-- Modal -->
<div id="address" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
       <table class="table table-striped">

    <tbody class="address-containter">

    </tbody>
  </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>