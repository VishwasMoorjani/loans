<aside id="left-panel" class="left-panel leftmenu-scroll">
  <nav class="navbar navbar-expand navbar-default">
    <div id="main-menu" class="main-menu collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="menu-item-has-children dropdown <?php if ($main_section == "category") {
                                                      echo "show";
                                                    } ?>"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fab fa-pagelines menu-icon leftmenu"></i>Category </a>

          <ul class="sub-menu children dropdown-menu <?php if ($main_section == "category") {
                                                        echo "show";
                                                      } ?>">

            <li><a href="<?php echo site_url() ?>saller/category"><i class="fas fa-baby-carriage menu-icon leftmenu"></i>Main category</a></li>

            <li><a href="<?php echo site_url() ?>saller/sub_category"><i class="fas fa-baby-carriage menu-icon leftmenu"></i>Sub category</a></li>
            <!-- 

                <li><a href="<?php echo site_url() ?>admin/sub_sub_category"><i class="fas fa-baby-carriage menu-icon leftmenu"></i>Child category</a></li> -->

            <li><a href="<?php echo site_url() ?>saller/brand"><i class="fab fa-buy-n-large menu-icon leftmenu"></i>Brand</a></li>

          </ul>

        </li>
        <li><a href="<?php echo site_url() ?>saller/orders"><i class="fas fa-share-square menu-icon leftmenu"></i>Orders</a></li>
        <li><a href="<?php echo site_url() ?>saller/grocery_product"><i class="fab fa-product-hunt menu-icon leftmenu"></i>Product</a></li>

      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </nav>
</aside>