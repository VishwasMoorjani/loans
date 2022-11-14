<link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>dropzone/css/dropzone.css" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
<!-- Jquery Min -->
<script src="<?php echo $this->config->item('admin_assets'); ?>dropzone/dropzone.js" type="text/javascript"></script>

<!-- path -->
<div class="container-fluid">
  <div class="path">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        
        <li class="breadcrumb-item" aria-current="page"> <?php echo $page_title; ?></li>
      </ol>
    </nav>
  </div>
</div>
<!-- #path -->
<!-- Content -->
<div class="container-fluid">
  <div class="content_container">
    <h2>Add Images</h2>
    <div class="form_container">
      <form action="<?php echo site_url();?>/saller/product/productimages/<?php echo $id?>" class="dropzone" id="myDropzone">
        

      </form>
    </div>
  </div>
  <div class="row">
    <?php if($events){
      foreach ($events as $key => $value) {  ?>
        
    
    <div class="col-md-3 mt-3"><button  class="btn btn-danger closed " data-id="<?php echo $value->id ?>"><i class="fas fa-times"></i></button><img src="<?php echo site_url() ?>assets/admin/product/<?php echo $value->images ?>" height="150" /></div>

  <?php } }else{ ?>
    <div class="col-md-12"><div class="alert alert-warning">
No Records Found!!
</div></div>
  <?php } ?>  
  </div>
</div>
<script type="text/javascript">

$( ".closed" ).click(function() {
        var id = $(this).data('id');
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
            $.get(site_url + "saller/product/deleteproductsImage/" + id, function(data, status) {
            if (status) {

              location.reload();
            }
            });
          }
        })
    
});
</script>