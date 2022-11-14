<!-- Home slider -->
<section class="p-0">
    <div class="slide-1 home-slider">
        <?php
       
         if (isset($slider)) {
            foreach ($slider as $pic ) {
                
                ?>
                <div>
                    <div class="home  text-center">
                        <img src="<?php echo 'http://softwaresvalley.com/assets/'; ?>admin/slider/<?php echo $pic['image'];?>" alt="" class="bg-img blur-up lazyload">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="slider-contain">
                                    <!-- <div>
                                        <h4>welcome to fashion</h4>
                                        <h1>men fashion</h1>
                                        <a href="#" class="btn btn-solid">shop now</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } }?>
        <div>
        <!--    <div class="home text-center">-->
        <!--        <img src="<?php echo assets_panel; ?>images/home-banner/2.jpg" alt="" class="bg-img blur-up lazyload">-->
        <!--        <div class="container">-->
        <!--            <div class="row">-->
        <!--                <div class="col">-->
        <!--                    <div class="slider-contain">-->
        <!--                        <div>-->
        <!--                            <h4>welcome to fashion</h4>-->
        <!--                            <h1>women fashion</h1>-->
        <!--                            <a href="#" class="btn btn-solid">shop now</a>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
    </div>
</section>
    <!-- Home slider end -->