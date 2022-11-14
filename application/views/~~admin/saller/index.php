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
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dasbhaord">
          <div class="display">
            <div class="number">
              <h3 class="font-purple-soft">7</h3>
              <a class="hd_title" href="javascript:">Total Users</a>
            </div>
            <div class="icon">
              <i class="fa fa-users" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dasbhaord">
          <div class="display">
            <div class="number">
              <h3 class="font-purple-soft">6</h3>
              <a class="hd_title" href="javascript:">Total Appointment</a>
            </div>
            <div class="icon">
              <i class="fas fa-book-open"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dasbhaord">
          <div class="display">
            <div class="number">
              <h3 class="font-purple-soft">5</h3>
              <a class="hd_title" href="javascript:" title="Click here to see details">Total Servicers</a>
            </div>
            <div class="icon">
              <i class="fas fa-stethoscope"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dasbhaord">
          <div class="display">
            <div class="number">
              <h3 class="font-purple-soft">5</h3>
              <a class="hd_title" href="javascript:">Total Subscribers</a>
            </div>
            <div class="icon">
              <i class="far fa-envelope-open"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
            <div class="container-fluid">
        <div class="content_container">
       <div id="month" class="row" style=""></div></div></div>
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
                  <th>Item</th>
                  <th>Status</th>
                  <th>Popularity</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><a href="javascript:">OR9842</a></td>
                  <td>Call of Duty IV</td>
                  <td><span class="badge badge-success">Shipped</span></td>
                  <td>
                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                  </td>
                </tr>
                <tr>
                  <td><a href="javascript:">OR1848</a></td>
                  <td>Samsung Smart TV</td>
                  <td><span class="badge badge-warning">Pending</span></td>
                  <td>
                    <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                  </td>
                </tr>
                <tr>
                  <td><a href="javascript:">OR7429</a></td>
                  <td>iPhone 6 Plus</td>
                  <td><span class="badge badge-danger">Delivered</span></td>
                  <td>
                    <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                  </td>
                </tr>
                <tr>
                  <td><a href="javascript:">OR7429</a></td>
                  <td>Samsung Smart TV</td>
                  <td><span class="badge badge-info">Processing</span></td>
                  <td>
                    <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                  </td>
                </tr>
                <tr>
                  <td><a href="javascript:">OR1848</a></td>
                  <td>Samsung Smart TV</td>
                  <td><span class="badge badge-warning">Pending</span></td>
                  <td>
                    <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                  </td>
                </tr>
                <tr>
                  <td><a href="javascript:">OR7429</a></td>
                  <td>iPhone 6 Plus</td>
                  <td><span class="badge badge-danger">Delivered</span></td>
                  <td>
                    <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                  </td>
                </tr>
                <tr>
                  <td><a href="javascript:">OR9842</a></td>
                  <td>Call of Duty IV</td>
                  <td><span class="badge badge-success">Shipped</span></td>
                  <td>
                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                  </td>
                </tr>
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
      
    </div></div>
     <script type="text/javascript">
  var d = new Date(new Date().getFullYear(), 0, 1);
  
  var pointStart = d.getTime();
  Highcharts.chart('month', {
      credits: {
          enabled: false
      },
      title: {
          text: 'Monthly Orders , 2020'
      },
      subtitle: {
          text: 'Source: almostnear.com'
      },
      yAxis: {
          title: {
              text: 'Amount of orders'
          }
      },
      xAxis: {
          min: Date.UTC(2020, 0, 0),
          max: Date.UTC(2020, 11, 1),
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
              data: [100,200,300],
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