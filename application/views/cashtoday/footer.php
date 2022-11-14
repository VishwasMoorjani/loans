 <footer class="main-footer">
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 <a href=""> Bhawani Sharma</a>.</strong> All rights reserved.
  </footer>
<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url();?>assets/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/daterangepicker.min.js"></script>

<script type="text/javascript">
  // $(document).ready(function(){
              var start = moment().subtract(0, 'days');
            var end = moment().add(0,'days');
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

            //$('.btnrefresh').trigger("click");
  // })
</script>
</body>
</html>