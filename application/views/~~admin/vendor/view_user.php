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
</div></div>
<!-- Content -->
<div class="container-fluid">
  <div class="content_container loader-parent">
    <?php// pr($vendor); ?>
    <div class="row">
      <div class="col-md-12">
        <div class="portlet light">
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
                        <tbody>
                          <tr>
                            <th>ID</th>
                            <td style="word-break: break-all;"><?php echo $vendor->id; ?></td>
                          </tr>
                          <tr>
                            <th>Name</th>
                            <td style="word-break: break-all;"><?php echo $vendor->full_name; ?></td>
                          </tr>
                          
                          <tr>
                            <th>Email</th>
                            <td style="word-break: break-all;"><?php echo $vendor->email; ?></td>
                          </tr>
                          <tr>
                            <th>Mobile</th>
                            <td style="word-break: break-all;"><?php echo $vendor->mobile_number; ?></td>
                          </tr>
                          <tr>
                            <th>Country</th>
                            <td style="word-break: break-all;"><?php echo $vendor->country; ?></td>
                          </tr>
                          <tr>
                            <th>State</th>
                            <td style="word-break: break-all;">
                              <label class="label label-danger"><?php echo $vendor->state; ?></label>
                            </td>
                          </tr>
                          <tr>
                            <th>City</th>
                            <td style="word-break: break-all;">
                              <label class="label label-danger"><?php echo $vendor->city; ?></label>
                            </td>
                          </tr>
                          <tr>
                            <th>Address</th>
                            <td><?php echo $vendor->address; ?></td>
                          </tr><tr>
                          <th>Shop Name</th>
                          <td><?php echo $vendor->shope_name; ?></td>
                        </tr>
                        <tr>
                          <th>Docunment</th>
                          <td style="word-break: break-all;"><a href="<?php echo site_url() ?>assets/admin/business/<?php echo $vendor->businesp ?>" target="_blank">Docunemnt</a></td>
                        </tr>
                                  <tr>
                          <th>Add date</th>
                          <td style="word-break: break-all;"><?php echo date('d-m-Y',strtotime($vendor->add_date)); ?></td>
                        </tr>
                      </tbody></table>
                    </section>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="paging_div pull-right"></div>
                </div>
              </div>
            </section></div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END CONTENT -->
</div>
</div>
</div>