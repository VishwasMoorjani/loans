<script src="<?php echo $this->config->item('admin_assets') ?>js/highcharts.js"></script>

<div class="container-fluid">

  <div class="path">

    <nav aria-label="breadcrumb">

      <ol class="breadcrumb">

        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>

        <li class="breadcrumb-item active" aria-current="page"> Dashboard  </li>

      </ol>

    </nav>

  </div>

</div>

<div class="container-fluid">

  <div class="content_container">

    <h2>Dashboard</h2>

    <div class="row">

      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

        <div class="dasbhaord">

          <div class="display">

            <div class="icon bg-info">

              <i class="fa fa-users" aria-hidden="true"></i>

            </div>

            <div class="number">

              <h3 class="font-purple-soft"><?php  echo count($customer); ?></h3>

              <a class="hd_title" href="javascript:">Total Customer</a>

            </div>

            

          </div>

        </div>

      </div>

<!--       <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

        <div class="dasbhaord">

          <div class="display">

            <div class="icon bg-danger">

              <i class="fas fa-book-open"></i>

            </div>

            <div class="number">

              <h3 class="font-purple-soft"><?php// echo count($vendor); ?></h3>

              <a class="hd_title" href="javascript:">Total Vendor</a>

            </div>

            

          </div>

        </div>

      </div> -->

      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

        <div class="dasbhaord">

          <div class="display">

            <div class="icon bg-success">

              <i class="fas fa-stethoscope"></i>

            </div>

            <div class="number">

              <h3 class="font-purple-soft"><?php echo count($product); ?></h3>

              <a class="hd_title" href="javascript:" title="Click here to see details">Total Product</a>

            </div>

            

          </div>

        </div>

      </div>

      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

        <div class="dasbhaord">

          <div class="display">

            <div class="icon bg-warning">

              <i class="far fa-envelope-open"></i>

            </div>

            <div class="number">

              <h3 class="font-purple-soft"><?php echo count($category) ?></h3>

              <a class="hd_title" href="javascript:">Total Category</a>

            </div>

            

          </div>

        </div>

      </div>

    </div>

    <div class="row">

      <div class="container-fluid">

        <div class="content_container">

          <div id="month" class="" style=""></div></div></div>

        </div>

        <div class="row">

          <!-- Content -->

          <div class="container-fluid">

            <div class="content_container">

              <h2 class="text-center">Latest 10 Orders </h2>

              <div class="admin_table table-responsive loader-parent">

                <table class="table">

                  <thead>

                    <tr>

                      <th>Order ID</th>

                      <th>Status</th>

                      <th>Amount</th>

                      <th>Action</th>

                    </tr>

                  </thead>

                  <tbody>

                    <?php if($order) { 

                        foreach($order as $value) { //pr($value);

                     ?>

                    <tr>

                      <td>OR<?php echo $value->id; ?></td>

                      <td><span class="badge badge-success"><?php echo strtoupper($value->order_status); ?></span></td>

                      <td><?php echo $value->amount ?></td>

                                            <td>

                        <ul class="list-unstyled d-flex mb-0">

                          <li> <a href="<?php site_url() ?>orders/view/<?php echo $value->id ?>" class="view_btn" title="View"><i class="fas fa-eye"></i></a> </li>

                        </ul>

                      </td>

                    </tr>

                  <?php } } ?>

                  

                  </tbody>

                  

                </table>

                <div class="loader-bx users-loding" style="display: none;">

                  <img src="http://www.physiobestathome.com/backend/images/lodder.gif" alt="loader" style="height: 50px;

                  margin-left: 50%;

                  margin-top: 10%;">

                </div>

              </div>

            </div>

          </div>

        </div>

        <div class="row">

          <!-- Content -->



          

        </div>    <div class="row">

        <!-- Content -->

        <div class="container-fluid">

          <div class="content_container">

            <h2 class="text-center">Latest 10 Customer Registrations </h2>

            <div class="admin_table table-responsive loader-parent">

              <table class="table">

                <thead class="thead-white">

                  <tr>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Phone</th>

                    <th>Add Date</th>

                    <th>Option</th>

                  </tr>

                </thead>

                                  <tbody id="latest-users">

                    <?php if($customerlimit){

                      foreach ($customerlimit as $key => $value) {//pr($value);  ?>

                       

                  

                    <tr>

                      

                      <td><?php echo $value->full_name ?></td>

                      

                      <td><?php echo $value->email ?></td>

                      <td><?php echo $value->mobile_number ?></td>

                      <td><?php echo date("d-m-Y",strtotime($value->add_date)); ?></td>

                      <td>

                        <ul class="list-unstyled d-flex mb-0">

                          <li> <a href="<?php echo site_url() ?>/admin/users" class="view_btn" title="View"><i class="fas fa-eye"></i></a> </li>

                        </ul>

                      </td>

                    </tr>

                    <?php   } } else { ?>

                      <tr><td colspan="5" align="center">No Records Found !!</td></tr>

                    <?php } ?>  

                  </tbody>

                  

                </table>

                <div class="loader-bx users-loding" style="display: none;">

                  <img src="<?php echo site_url()?>assets/lodder.gif" alt="loader" style="height: 50px;

                  margin-left: 50%;

                  margin-top: 10%;">

                </div>

              </div>

            </div>

          </div>

          

        </div>

      </div></div>

      <script type="text/javascript">

      var d = new Date(new Date().getFullYear(), 0, 1);

      

      var pointStart = d.getTime();

      Highcharts.chart('month', {

      credits: {

      enabled: false

      },

      title: {

      text: 'Monthly Orders , 2021'

      },

      subtitle: {

      text: ''

      },

      yAxis: {

      title: {

      text: 'Amount of orders'

      }

      },

      xAxis: {

      min: Date.UTC(2021, 0, 0),

      max: Date.UTC(2021, 11, 1),

      allowDecimals: false,

      type: 'datetime',

      tickInterval: 2591100000, //one day

      labels: {

      rotation: 0

      }

      },

      legend: {

      layout: 'vertical',

      align: 'right',

      verticalAlign: 'middle'

      },

      plotOptions: {

      series: {

      pointStart: pointStart,

      pointInterval: 2591100000

      }

      },

      series: [{

      name: 'Orders',

      data: [<?php echo $graph ?>],

      },

      // {

      //   name: 'New York',

      //   data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3],

      //   pointStart: Date.UTC(2020, 3, 1),

      //   pointInterval: 7 * 24 * 3600 * 1000 // interval of 1 day

      // }

      ],

      responsive: {

      rules: [{

      condition: {

      maxWidth: 500

      },

      chartOptions: {

      legend: {

      layout: 'horizontal',

      align: 'center',

      verticalAlign: 'bottom'

      }

      }

      }]

      }

      });

      </script>