<style type="text/css">
.loader-parent{position: relative;}
.loader-bx{    position: absolute;
left: 12px;
top: 51%;
width: 100%;
height: 47%;
background: rgba(255,255,255,0.7);}
.loader-bx>img{max-width: 63px;filter: brightness(0);-webkit-filter: brightness(0);transform: translate(-50%,-50%);-webkit-transform: translate(-50%,-50%);position: absolute;left: 50%;top: 50%;}
</style>
<div class="portlet light" style="height:45px">
  <div class="row">
    <ul class="page-breadcrumb breadcrumb">
      <li>
        <i class="icon-home"></i>
        <a href="<?php echo site_url('admin')?>" class="tooltips" data-original-title="Home" data-placement="top" data-container="body">Home</a>
        <i class="fa fa-arrow-right"></i>
      </li>
      <li>
        <a href="<?php echo site_url('admin/users')?>" class="tooltips" data-original-title="List of users" data-placement="top" data-container="body"> List of  users</a>
        <i class="fa fa-arrow-right"></i>
      </li>
      <li style="float:right;">
        <a class="btn red tooltips" href="<?php echo base_url('admin/users'); ?>" style="float:right;margin-right:3px;margin-top: -7px;" data-original-title="Go Back" data-placement="top" data-container="body">Go Back<i class="m-icon-swapleft m-icon-white"></i>
        </a>
      </li>
    </ul>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="portlet light">
      <div class="portlet-title">
        <div class="row">
          <div class="col-md-6">
            <div class="caption font-red-sunglo">
              <i class="icon-globe"></i>
              <span class="caption-subject bold uppercase"><?php echo $page_title; ?></span>
            </div>
          </div>
        </div>
      </div>
      <div class="portlet-body form">
        <div class="form-body">
          <div class="form-body">
            <div class="portlet portlet-sortable box green-haze">
              <div class="portlet-title">
                <div class="caption">
                  <span>Basic Details</span>
                </div>
                <div class="tools">
                  <a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
                </div>
              </div>
              <div class="portlet-body portlet-empty">
                <section style="margin-top: 20px; background-color: white; ">
                  <table class="table table-bordered table-condensed">
                    <tr>
                      <th>Name</th>
                      <td style="word-break: break-all;"><?php echo $user->first_name; ?> <?php echo $user->last_name; ?></td>
                    </tr>
                    
                    <tr>
                      <th>Email</th>
                      <td style="word-break: break-all;"><?php echo $user->email; ?></td>
                    </tr>
                    <tr>
                      <th>Referral code</th>
                      <td style="word-break: break-all;">#<?php echo $user->code; ?></td>
                    </tr>
                    <tr>
                      <th>Rank</th>
                      <td style="word-break: break-all;">#<?php echo $rankrecord->rank; ?></td>
                    </tr>
                    <tr>
                      <th>Admin Access</th>
                      <td style="word-break: break-all;">
                        <?php if($user->is_admin == "Yes") { ?>
                        <label class="label label-success"><?php echo $user->is_admin_approve; ?></label>
                        <?php } else { ?>
                        <label class="label label-danger"><?php echo $user->is_admin_approve; ?></label>
                        <?php } ?>
                      </td>
                    </tr>
                    <tr>
                      <th>Add Date</th>
                      <td style="word-break: break-all;"><?php echo date('F d, Y',strtotime(getGMTDateToLocalDate($user->add_date)));?></td>
                    </tr>
                    <tr>
                      <th> Parent / influencer</th>
                      <td style="word-break: break-all;"><?php  if($parent) { echo $parent->first_name.' '.$parent->last_name;  ?>  |  <a href="javascript:" class="btn btn-danger btn-sm" onclick="removeParent(this)" data-url="<?php echo site_url(); ?>admin/users/remove_parent" data-user_id="<?php echo $user->id; ?>" ><i class="fa fa-close"></i></a> <?php }else{ ?>
                      <select name="user_id" class="form-control select2 user"  id="user" >
                        <option value=""></option>
                      </select>
                      <a href="javascript:" class="btn btn-success" onclick="assignParent(this)" data-url="<?php echo site_url(); ?>admin/users/add_parent" data-user_id="<?php echo $user->id; ?>" >Assign Parent</a>
                    <?php  } ?></td>
                  </tr>
                  <?php if($user->card_object){ ?>
                  <tr>
                    <th>Remove Card</th>
                    <td style="word-break: break-all;"><a href="javascript:" class="btn btn-danger" onclick="removeCard(this)" data-url="<?php echo site_url(); ?>admin/users/remove_card" data-user_id="<?php echo $user->id; ?>" >Remove Card</a></td>
                  </tr>
                  <?php } ?>
                </table>
              </section>
            </div>
          </div>
        </div>
        <div class="portlet portlet-sortable box green-haze">
          <div class="portlet-title">
            <div class="caption">
              <span>Verification Details</span>
            </div>
            <div class="tools">
              <a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
            </div>
          </div>
          <div class="portlet-body portlet-empty">
            
            <section style="margin-top: 20px; background-color: white; ">
              <table class="table table-bordered table-condensed">
                <?php if($verification_record){  ?>
                <tr>
                  <th> Parent / influencer</th>
                  <td style="word-break: break-all;"><?php  if($parent) { echo $parent->first_name.' '.$parent->last_name; } ?> </td>
                </tr>
                
                <tr>
                  <th>Reletion</th>
                  <td style="word-break: break-all;"><?php echo $verification_record->reletion; ?></td>
                </tr>
                <tr>
                  <th>Image</th>
                  <td style="word-break: break-all;">
                    
                    <?php  if($verification_record->image){ ?>
                    <a href="<?php echo site_url()."uploads/user_verify/".$verification_record->image; ?>" target="_blank">
                    <img src="<?php echo site_url().image('uploads/user_verify/'.$verification_record->image, array(200, 200)) ?>" alt="card type" height="200"> <?php  } else {  echo  "No Image Found!!"; } ?></a>
                  </td>
                </tr>
                 <tr>
                   <td align="center" colspan="2">
                     <?php if ($user->is_influencer_verified == "Admin_verified") {?>
                      <span class="label label-success"><i class="fa fa-check" aria-hidden="true"></i> Verified</span>
                    <?php } else  if ($user->is_influencer_verified == "influencer_verified") { ?>  
                    <a data-id="<?php echo  $user->id ?>" data-url="https://backend.clearunited.com/admin/users/verify_user" data-status="Admin_verified" onclick="informationVerified(this)" class="btn btn-success">Click here to Verify</a>
                  <?php } else { ?>
                        <span class="label label-danger"><i class="fa fa-ban" aria-hidden="true"></i> Pending</span> 
                   <?php  } ?> 
                  </td>
                </tr>
                <?php  } else{ ?>
                <tr><td colspan="3" align="center">No Records Found!!</td></tr>
                <?php   } ?>
              </table>
            </section>
          </div>
        </div>
        <div class="portlet portlet-sortable box green-haze">
          <div class="portlet-title">
            <div class="caption">
              <span>Save Your Card </span>
            </div>
            <div class="tools">
              <a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
            </div>
          </div>
          <div class="portlet-body portlet-empty">
            
            <section style="margin-top: 20px; background-color: white; ">
              <form class="ajax_form" action="<?php echo site_url(); ?>admin/users/save_card_details/<?php echo $user->id; ?>" method="post" id="stripe_form">
                <input type="hidden" name="order_id" value="23">
                <div class="card-payment-bx">
                  <div class="card-type-img"><img src="<?php echo site_url(); ?>assets/front/images/card-type.png" alt="card type"></div>
                  <div class="row">
                    <div class="col-lg-8">
                      <div class="form-group">
                        <label class="form-label" for="cc_number"><sup class="text-danger">*</sup>Card Number</label>
                        <input type="text" name="cc_number" size="20" autocomplete="off" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-label" for="cc_expiry"><sup class="text-danger">*</sup>Expires (MM/YYYY)</label>
                        <input type="text" name="cc_expiry" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-8">
                      <div class="form-group">
                        <label class="form-label" for="cc_holder_name"><sup class="text-danger">*</sup>Card Holder Name</label>
                        <input type="text" name="cc_holder_name" size="20" autocomplete="off" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-label" for="cc_cvc"><sup class="text-danger">*</sup>CVV/CVC <a href="#" data-toggle="tooltip" title="" data-original-title="Your CVV/CVC number can be located by looking on your credit or debit card!"><i class="fas fa-info-circle"></i></a></label>
                        <input type="text" name="cc_cvc" size="4" autocomplete="off" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </section>
          </div>
        </div>
        <div class="portlet portlet-sortable box green-haze">
          <div class="portlet-title">
            <div class="caption">
              <span>Referrals</span>
            </div>
            <div class="tools">
              <a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
            </div>
          </div>
          <div class="portlet-body portlet-empty">
            
            <section style="margin-top: 20px; background-color: white; ">
              <div class="box grey-cascade" >
                <div class="portlet-body">
                  <div class="table-toolbar">
                    <div class="row">
                      <div class="col-md-1 col-sm-12">
                        <div class="form-group">
                          <select name="page_limit" class="form-control input-xsmall input-inline select2" id="page_limit" onchange="searchRecords(this)">
                            <option value="5">5</option>
                            <option value="15" selected>15</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="300">300</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-12 pull-right">
                        <div class="">
                          <input class="form-control " placeholder="Search by name" type="text" id="keyword" name="keyword" value="" onchange="searchRecords(this)" >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
           
              <table class="table table-hover loader-parent" >
                <thead>
                  <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Rank</th>
                    <th>Referrals</th>
                    <th>Add Date</th>
                  </tr>
                </thead>
                <tbody class="ajax_content">
                  
                </tbody>
              </table>
              <div class="loader-bx lodding">
                <img src="<?php echo site_url(); ?>assets/wait.gif" alt="loader">
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="paging_div pull-right">
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function removeCard($this) {
  $('#removeCardModal').modal('show');
  $('#cardUserId').val($($this).data('user_id'));
  $('#removeCardDeleteForm').attr('action', $($this).data('url'));
  
}
</script>
<script type="text/javascript">
function removeParent($this) {
  $('#removeParentModal').modal('show');
  $('#UserId').val($($this).data('user_id'));
  $('#removeParentDeleteForm').attr('action', $($this).data('url'));
  
}
</script>
<div class="modal fade bs-modal-sm" id="removeCardModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form role="form" method="post" action="" class="ajax_form" id="removeCardDeleteForm">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">Remove Card</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" name="record_id" value="" id="cardUserId">
          Are You Sure! You want to delete?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn red">Remove</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade bs-modal-sm" id="removeParentModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form role="form" method="post" action="" class="ajax_form" id="removeParentDeleteForm">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">Remove Card</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" name="record_id" value="" id="UserId">
          Are You Sure! You want to Remove?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn red">Remove</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
var user_id = '<?php echo $user->id ?>';

function sortByColumnName($this) {
  $("#add_date").html('<i class="fa fa-sort" aria-hidden="true"></i>');
  $("#is_admin_approve").html('<i class="fa fa-sort" aria-hidden="true"></i>');
  $("#email").html('<i class="fa fa-sort" aria-hidden="true"></i>');
  $("#first_name").html('<i class="fa fa-sort" aria-hidden="true"></i>');
  $("#shopify_customer_id").html('<i class="fa fa-sort" aria-hidden="true"></i>');

  var column_name = $($this).attr('data-column_name');
  var sorting_order = $($this).attr('data-sorting_order');
  if (sorting_order == "ASC") {
    $($this).attr('data-sorting_order', 'DESC');
    $("#" + column_name).html('<i class="fa fa-sort-asc" aria-hidden="true"></i>');
  } else {
    $($this).attr('data-sorting_order', 'ASC');
    $("#" + column_name).html('<i class="fa fa-sort-desc" aria-hidden="true"></i>');
  }
  var keyword = $('#keyword').val();
  var page_limit = $('#page_limit').val();
  // var status = $('#userstatus').val();
  var useradminapprove = $('#useradminapprove').val();


  var surl = siteurl + 'admin/users/get_ajax_list_for_referral_for_referral?keyword=' + keyword + '&page_limit=' + page_limit + '&sorting_order=' + sorting_order + '&column_name=' + column_name + '&user_id=' + user_id;
  getAjaxSearchData(surl);
}

function searchRecords() {
  var keyword = $('#keyword').val();
  var page_limit = $('#page_limit').val();
  var sorting_order = 'DESC';
  var column_name = 'add_date';
  $(".lodding").css('display', 'block');
  var surl = siteurl + 'admin/users/get_ajax_list_for_referral?keyword=' + keyword + '&page_limit=' + page_limit + '&sorting_order=' + sorting_order + '&column_name=' + column_name + '&user_id=' + user_id;
  var user_data = getAjaxSearchData(surl);
  //kill the request
  if (keyword.length > 0) {
    user_data.abort()
  }
}

function getAjaxSearchData(surl) {
  $(".lodding").css('display', 'block');

  $.getJSON(surl, function (response) {

    if (response.success) {

      $('.ajax_content').html(response.html);
      $('.paging_div').html(response.paging);
      $(".lodding").css('display', 'none');
    }
  });
}
$(document).ready(function () {
  searchRecords();
  $(document).on('click', '.pagination a', function (e) {
    e.preventDefault();
    if ($(this).hasClass('active'))
      return false;
    if ($(this).attr('href')) {
      getAjaxSearchData($(this).attr('href'));
    }
    return false;
  })
});

$(document).ready(function () {
  $('.user').select2({
    placeholder: 'Select Users',
    ajax: {
      url: siteurl + 'admin/users/get_all_users',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results: data
        };
      },
      cache: true
    }
  })
});

function assignParent($this)
{
  var user_id = $($this).data('user_id');
  var user = $('#user').val();
  var url = $($this).data('url');
  var surl=url+"?referral_user_id="+user+"&user_id="+user_id;
  if (user) {
    $.getJSON(surl, function (response) {
      if (response.success) {
       toastr.success("Assign Parent successfully");
      location.reload();
      }
    });
  } else {
    toastr.error("Select Parent First");
  }
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
function informationVerified($this) {
  
    $('#VerifyUser').modal('show');
    $('#user_id').val($($this).data('id'));
    $('#VerifyUserForm').attr('action', $($this).data('url'));
  }
</script>