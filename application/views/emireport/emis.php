    <?php include('header.php'); ?>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <?php include('menubar.php'); ?>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Emis
                <!--<small>Optional description</small>-->
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>main/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Emis</li>
            </ol>
        </section>\
        <div class="container-fluid">
            <div class="card search-panel ">
                <div class="card-body">

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
                            <input type="date" class="form-control" placeholder="Search By Name" id="date">
                        </div>
                        <div class="col-lg-2 col-md-4 p-l-0 my-2">
                            <button class="btn btn-danger rounded-0" onclick="searchRecords()">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Details</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="admin_table table-responsive">
                                    <table class="table">
                                        <thead class="thead-white">
                                            <tr>
                                                <th>S.No.</th>
                                                <th>A/C No.</th>
                                                <th>Customer Details</th>
                                                <th>Gaurantor Details</th>
                                                <th>Disbursement Date</th>
                                                <th>Loan Amount</th>
                                                <th>EMI</th>
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <?php include('footer.php'); ?>

    <script type="text/javascript">
        var site_url = '<?php echo site_url(); ?>';

        function sortByColumnName($this) {
            $("#name").html('<i class="fa fa-sort" aria-hidden="true"></i>');
            $("#email").html('<i class="fa fa-sort" aria-hidden="true"></i>');
            $("#phone").html('<i class="fa fa-sort" aria-hidden="true"></i>');
            $("#status").html('<i class="fa fa-sort" aria-hidden="true"></i>');
            $("#add_date").html('<i class="fa fa-sort" aria-hidden="true"></i>');
            var column_name = $($this).attr('data-column_name');
            var sorting_order = $($this).attr('data-sorting_order');
            if (sorting_order == "ASC") {
                $($this).attr('data-sorting_order', 'DESC');
                $("#" + column_name).html('<i class="fa fa-sort-asc" aria-hidden="true"></i>');
            } else {
                $($this).attr('data-sorting_order', 'ASC');
                $("#" + column_name).html('<i class="fa fa-sort-desc" aria-hidden="true"></i>');
            }
            var date = $('#date').val();
            var page_limit = $('#page_limit').val();
            var surl = site_url + '/main/get_emi_ajax_list?date=' + date + '&page_limit=' + page_limit + '&sorting_order=' + sorting_order + '&column_name=' + column_name;
            getAjaxSearchData(surl);
        }

        function searchRecords() {
            var date = $('#date').val();
            var page_limit = $('#page_limit').val();
            var sorting_order = 'DESC';
            var column_name = 'emi_id';
            $(".lodding").css('display', 'block');
            var selfOrInCricle = $('#selfOrInCricle').val();
            var useradminapprove = $('#useradminapprove').val();
            var surl = site_url + '/main/get_emi_ajax_list?date=' + date + '&page_limit=' + page_limit + '&sorting_order=' + sorting_order + '&column_name=' + column_name;
            var user_data = getAjaxSearchData(surl);
            //kill the request
            if (keyword.length > 0) {
                user_data.abort()
            }
        }

        function getAjaxSearchData(surl) {
            $(".lodding").css('display', 'block');
            // $(".ajax_content").html('<div class="loader"></div>');
            $('#ticket-popup-loader').addClass('loadercanvas-visible');
            $.getJSON(surl, function(response) {
                if (response.success) {
                    $('#ticket-popup-loader').removeClass('loadercanvas-visible');
                    $('.container').html(response.html);
                    $('.paging_div').html(response.paging);
                    $(".lodding").css('display', 'none');
                }
            });
        }
        $(document).ready(function() {
            var now = new Date();
            var month = (now.getMonth() + 1);
            var day = now.getDate();
            if (month < 10)
                month = "0" + month;
            if (day < 10)
                day = "0" + day;
            var today = now.getFullYear() + '-' + month + '-' + day;
            $('#date').val(today);
            searchRecords();
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                $(".lodding").css('display', 'block');
                if ($(this).hasClass('active'))
                    return false;
                if ($(this).attr('href')) {
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
        function callBackRefresh() {
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