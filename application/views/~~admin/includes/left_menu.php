<aside id="left-panel" class="left-panel leftmenu-scroll">

    <nav class="navbar navbar-expand navbar-default">

        <div id="main-menu" class="main-menu collapse navbar-collapse">

            <ul class="nav navbar-nav">

                <li class="left_part_profile">

                    <a href="<?php echo site_url() ?>admin/admin" class="d-flex align-items-center">

                        <img class="user-avatar rounded-circle" src="<?php echo $this->config->item('admin_assets'); ?>images/dr_image.png" alt="User Avatar" />

                        <span style="line-height: 1.3;"><?php $record=get_admin_details(); echo  $record->full_name?> </br><small><i class="fa fa-circle text-success"></i> Online</small> </span>

                    </a>

                </li>

                <li><a href="<?php echo site_url() ?>admin/admin"><i class="fas fa-tachometer-alt menu-icon leftmenu"></i>Dashboard</a></li>

           

 <li class="menu-item-has-children dropdown <?php if($main_section=="category"){echo "show";} ?>"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fab fa-pagelines menu-icon leftmenu"></i>Category </a>

            <ul class="sub-menu children dropdown-menu <?php if($main_section=="category"){echo "show";} ?>">

                <li><a href="<?php echo site_url() ?>admin/category"><i class="fas fa-baby-carriage menu-icon leftmenu"></i>Main category</a></li>

                <li><a href="<?php echo site_url() ?>admin/sub_category"><i class="fas fa-baby-carriage menu-icon leftmenu"></i>Sub category</a></li><!-- 

                <li><a href="<?php echo site_url() ?>admin/sub_sub_category"><i class="fas fa-baby-carriage menu-icon leftmenu"></i>Child category</a></li> -->

                <li><a href="<?php echo site_url() ?>admin/brand"><i class="fab fa-buy-n-large menu-icon leftmenu"></i>Brand</a></li>

            </ul>

        </li>

                <li class="menu-item-has-children dropdown <?php if($main_section=="product_module"){echo "show";} ?>"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-poll-h menu-icon leftmenu"></i>Product Managnment</a>

                <ul class="sub-menu children dropdown-menu <?php if($main_section=="product_module"){echo "show";} ?>">

                    <li><a href="<?php echo site_url() ?>admin/grocery_product"><i class="fas fa-list menu-icon leftmenu"></i>Show  Product</a></li>

                    <li><a href="<?php echo site_url() ?>admin/grocery_product/add"><i class="fas fa-plus menu-icon leftmenu"></i>Add  Product</a></li>
                      <li><a href="<?php echo site_url() ?>admin/deal_product"><i class="fab fa-ideal menu-icon leftmenu"></i>Deal Product</a></li>
                    <li><a href="<?php echo site_url() ?>admin/taxes"><i class="fas fa-percentage menu-icon leftmenu"></i>Taxes</a></li>
                    <li><a href="<?php echo site_url() ?>admin/stock"><i class="fas fa-cubes menu-icon leftmenu"></i>Stock</a></li>

                  

               

                    

                </ul>

            </li>

          <li><a href="<?php echo site_url() ?>/admin/vendor"><i class="fas fa-user-tag menu-icon leftmenu"></i>Vendor Section</a></li>

        <li class="menu-item-has-children dropdown <?php if($main_section=="order_product_module"){echo "show";} ?>"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-share-square  menu-icon leftmenu"></i>Orders Managment </a>

        <ul class="sub-menu children dropdown-menu <?php if($main_section=="order_product_module"){echo "show";} ?>">

            <li><a href="<?php echo site_url() ?>admin/orders"><i class="fas fa-list menu-icon leftmenu"></i>New  Orders</a>

            <li><a href="<?php echo site_url() ?>admin/cancleorders"><i class="fas fa-list menu-icon leftmenu"></i> Cancel Orders </a>

            <li><a href="<?php echo site_url() ?>admin/deliveredorders"><i class="fas fa-list menu-icon leftmenu"></i> Deliverd Orders</a>

                      <li><a href="<?php echo site_url() ?>admin/custom_order"><i class="fas fa-list menu-icon leftmenu"></i> Offline Orders</a>

        </ul>

    </li>



   <li><a href="<?php echo site_url() ?>admin/users"><i class="fab fa-android menu-icon leftmenu"></i>Registerd users</a></li>

               
                 

<!-- <li><a href="<?php// echo site_url() ?>admin/stock"><i class="fas fa-database menu-icon leftmenu"></i>Stock Management</a></li> -->









   

   

    

    

    <li><a href="<?php echo site_url() ?>admin/pushnotification"><i class="fas fa-bell menu-icon leftmenu"></i>Push Notification</a></li>

    



    <li class="menu-item-has-children dropdown <?php if($main_section=="location"){echo "show";} ?>"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-search-location menu-icon leftmenu"></i>Location</a>

    <ul class="sub-menu children dropdown-menu <?php if($main_section=="location"){echo "show";} ?>">

        <li> <a href="<?php echo site_url() ?>admin/country"><i class="fas fa-angle-double-right"></i> Country</a> </li>

        <li class=""> <a href="<?php echo site_url() ?>admin/state"><i class="fas fa-angle-double-right"></i> State</a> </li>

        <li class=""> <a href="<?php echo site_url() ?>admin/city"><i class="fas fa-angle-double-right"></i> City</a> </li>

        <li><a href="<?php echo site_url() ?>admin/pincode"><i class="fas fa-map-pin menu-icon leftmenu"></i>Pin code</a></li>

    </ul>

</li>

<!-- <li><a href="<?php //echo site_url() ?>admin/delivery_boy"><i class="fas fa-truck menu-icon leftmenu"></i>Delivery boy Management</a></li> -->




<!-- <li class="menu-item-has-children dropdown <?php if($main_section=="other"){echo "show";} ?>"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-igloo menu-icon leftmenu"></i>Message Setting</a> -->

<!-- <ul class="sub-menu children dropdown-menu <?php if($main_section=="other"){echo "show";} ?>">

 

 


 

</ul> -->

</li>

 <!-- <li><a href="<?php// echo site_url() ?>admin/media"><i class="far fa-images menu-icon leftmenu"></i>Image Media</a></li> -->

<li class="menu-item-has-children dropdown <?php if($main_section=="other"){echo "show";} ?>"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-igloo menu-icon leftmenu"></i>General Setting</a>

<ul class="sub-menu children dropdown-menu <?php if($main_section=="other"){echo "show";} ?>">

 

    <li><a href="<?php echo site_url() ?>admin/slider"><i class="far fa-images menu-icon leftmenu"></i>Slider  for app and web</a></li>
    <li><a href="<?php echo site_url() ?>admin/discount"><i class="far fa-images menu-icon leftmenu"></i>Discount</a></li>
    <li><a href="<?php echo site_url() ?>admin/Closeing_hour"><i class="far fa-clock menu-icon leftmenu"></i>Time</a></li>
<!--     <li><a href="<?php //echo site_url() ?>admin/home_middle_section"><i class="far fa-images menu-icon leftmenu"></i>Middle Section</a></li>

   <li><a href="<?php //echo site_url() ?>admin/deal_product"><i class="fab fa-ideal menu-icon leftmenu"></i>Deals Product</a></li> -->

 



</ul>

</li>








</ul>

</div>

<!-- /.navbar-collapse -->

</nav>

</aside>