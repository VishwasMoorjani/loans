 <footer class="main-footer">

    <!-- Default to the left -->

    <strong>Copyright &copy; 2020 <a href=""> Yuvaan micro</a>.</strong> All rights reserved.

  </footer>

<!-- REQUIRED JS SCRIPTS -->



<!-- jQuery 3 -->

<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/daterangepicker.min.js"></script>

<script type="text/javascript">
  // $(document).ready(function(){
            var start = moment().subtract(10, 'days');
            var end = moment().add(2,'days');
            // var datdtable =  dataTable.draw();
            function Callback(start, end) {
            $('#hidden_start_date').val(start.format('Y-M-D'));
            $('#hidden_end_date').val(end.format('Y-M-D'));
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            //dataTable.draw();
                  
          var sagent = $('#sagent').val();



          var cagent = $('#cagent').val();



          var status = $('#status').val();



          var account = $('#account').val();



          var name = $('#name').val();



          var mobile = $('#mobile').val();



          var aadhar = $('#aadhar').val();



          $.ajax({



            url: "<?php echo base_url(); ?>main/getFilteredClient?start="+start.format('Y-M-D')+"&end="+end.format('Y-M-D'),



            type: "POST",



            beforeSend: function() {



              $('#loading-image').show();



            },



            complete: function() {



              $('#loading-image').hide();



            },



            data: {

              sagent: sagent,

              cagent: cagent,

              status: status,

              account: account,

              name: name,

              mobile: mobile,

              aadhar: aadhar,

              loginUserId: '<?php echo  $this->session->userdata('user_id');  ?>',

              loginUserType: '<?php echo  $this->session->userdata('user_type'); ?>',

            },



            success: function(data) {



              $(".tbodys").html(data);



            }







          })
            }
            $('#reportrange').daterangepicker({
           // maxDate: new Date(),
            startDate: start,
            endDate: end,
            ranges: {
            'This Year': [moment().startOf('year'), moment()],
            'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
            'Last 2 Years': [moment().subtract(2, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
            }, Callback);
            Callback(start, end);

            <?php if(isset($_GET['start_date']) && isset($_GET['end_date'])){ ?>
              var start = moment(<?="'".date('Ymd',strtotime($_GET['start_date']))."'"?>);
              var end = moment(<?="'".date('Ymd',strtotime($_GET['end_date']))."'"?>);
            <?php } 
            else{ ?>
              var start = moment().subtract(10, 'days');
              var end = moment().add(2,'days');
            <?php } ?>
            // var datdtable =  dataTable.draw();

            console.log('hi');
            function Interestreport(start, end) {
            $('#hidden_start_date').val(start.format('Y-M-D'));
            $('#hidden_end_date').val(end.format('Y-M-D'));
            $('#interest').html(start.format('MMMM D, YYYY') + '-' + end.format('MMMM D, YYYY'));
            // console.log(start.format('Y-M-D'));
            // console.log(end.format('Y-M-D'));
            }
            
            $('#interestreport').daterangepicker({
           // maxDate: new Date(),
            startDate: start,
            endDate: end,
            ranges: {
            'This Year': [moment().startOf('year'), moment()],
            'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
            'Last 2 Years': [moment().subtract(2, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
            }, Interestreport);
            Interestreport(start, end);

            //$('.btnrefresh').trigger("click");
  // })
</script>

<!-- Bootstrap 3.3.7 -->

<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->

<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>

</body>

</html>