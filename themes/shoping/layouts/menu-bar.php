<div id="navbar" class="navbar-static-top">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-6">
                    <div id="logo">
                        <a href="<?= yii\helpers\Url::to(['site/index'])?>"><img src="<?= $image?>logo.png" title="Shopkit-04" alt="Shopkit-04" class="img-responsive center-block" /></a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 user-cart">
                    <ul class="list-inline list-unstyled">
                        <li class="dropdown account"><a href="" title="Sign In" class="dropdown-toggle" data-toggle="dropdown"><span>Sign In</span> <img src="<?= $image?>user.png" alt="user"> </a>
                            <ul class="dropdown-menu dropdown-menu-right wrc-acl">
                                <li><a href="">Register</a></li>
                                <li><a href="">Login</a></li>
                            </ul>
                        </li>
                        <li>
                            <div id="cart" class="btn-group btn-block">
                                <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="btn btn-block btn-lg dropdown-toggle">
                                    <span class="text-cart"> my cart</span> <img src="<?= $image?>cart.png" alt="cart"> 
                                    <span id="cart-total" class= "cart-items cart-digit1 img img-circle">
                                        0   </span>
                                </button>
                                <ul class="dropdown-menu pull-right hr-ct-tlg">
                                    <li>
                                        <p class="text-center">Your shopping cart is empty!</p>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-7 col-sm-12">
                    <div id="search-by-category">
                        <div class="search-container">
                            <?php 
                                $cate = \common\models\ProductType::find()->orderBy(['product_type_name'=>SORT_DESC])->all();
                            ?>
                            <input type="text" name="searchs" id="text-search" value="" placeholder="ค้นหาสินค้า" class="" />
                            <div class="all-category">
                                <p><span class="category-select" data-value="0">ค้นหาจากหมวดหมู่</span></p>
                                <ul class="category-item">
                                    <li class="cat-i" data-value="0">All Categories</li>
                                    <?php foreach($cate as $c): ?>
                                        <li data-value="<?= $c->product_type_id?>" class="cat-i"><?= $c->product_type_name?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div id="sp-btn-search" class="">
                            <button type="button" id="btn-search-category" class="btn btn-default btn-lg">
                                <span class="search-s"><i class="fa fa-search"></i></span>
                            </button>
                        </div>
                        <div class="search-ajax">
                            <div class="ajax-loader-container" style="display: none; right: 0;">
                                <img src="<?= $image?>loader.gif" class="ajax-load-img center-block" width="80" height="80" alt="plazathemes.com" />
                            </div>
                            <div class="ajax-result-container">
                                <!-- Content of search results -->
                            </div>
                        </div>
                        <input type="hidden" id="ajax-search-enable" value="1" />
                    </div>


                </div>
            </div>
        </div>
    </header>

    <div class="menu-bg">
        <div class="container">
            <nav id="menu" class="navbar">
                <div class="navbar-header" data-toggle="collapse" data-target=".navbar-ex1-collapse"><span id="category" class="visible-sm visible-xs">Categories</span>
                    <button type="button" class="btn btn-navbar  navbar-toggle"><i class="fa fa-bars"></i></button>
                </div>

                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle main-menu">Desktops<i class="fa fa-angle-down down-arrow" aria-hidden="true"></i></a>
                            <div class="dropdown-menu">
                                <div class="dropdown-inner">
                                    <div class="col-sm-8 col-xs-12">
                                        <!-- <div class="col-sm-8">-->

                                        <ul class="list-unstyled">
                                            <!--3rd level-->
                                            <li class="dropdown-submenu">
                                                <a href=" ">
                                                    <h4 class="dropdown-toggle">
                                                        PC (6) </h4>
                                                </a>
                                                <ul class="list-unstyled grand-child">
                                                    <li>
                                                        <a href=" ">
                                                            Tablets (1)                                                    </a>
                                                    </li>
                                                    <li>
                                                        <a href=" ">
                                                            Software (1)                                                    </a>
                                                    </li>
                                                    <li>
                                                        <a href=" ">
                                                            Phones &amp; PDAs (4)                                                    </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <!--3rd level over-->
                                        </ul>


                                        <ul class="list-unstyled">
                                            <!--3rd level-->
                                            <li class="dropdown-submenu">
                                                <a href=" ">
                                                    <h4 class="dropdown-toggle">
                                                        Mac (5) </h4>
                                                </a>
                                                <ul class="list-unstyled grand-child">
                                                    <li>
                                                        <a href=" ">
                                                            test 25 (1)                                                    </a>
                                                    </li>
                                                    <li>
                                                        <a href=" ">
                                                            test 7 (4)                                                    </a>
                                                    </li>
                                                    <li>
                                                        <a href=" ">
                                                            test 9 (0)                                                    </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <!--3rd level over-->
                                        </ul>

                                    </div>
                                    <div class="col-sm-4 col-xs-12 cat-img-block">
                                        <img class="img img-responsive center-block" src="<?= $image?>1-200x300.jpg" alt="category" />
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown">
                            <a href=" " class="dropdown-toggle main-menu">Laptops<i class="fa fa-angle-down down-arrow" aria-hidden="true"></i></a>
                            <div class="dropdown-menu">
                                <div class="dropdown-inner">
                                    <div class="col-sm-8 col-xs-12">
                                        <!-- <div class="col-sm-8">-->

                                        <ul class="list-unstyled">
                                            <!--3rd level-->
                                            <li class="dropdown-submenu">
                                                <a href=" ">
                                                    <h4 class="dropdown-toggle">
                                                        Macs (4) </h4>
                                                </a>
                                                <ul class="list-unstyled grand-child">
                                                    <li>
                                                        <a href=" ">
                                                            test 16 (0)                                                    </a>
                                                    </li>
                                                    <li>
                                                        <a href=" ">
                                                            Components (4)                                                    </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <!--3rd level over-->
                                        </ul>


                                        <ul class="list-unstyled">
                                            <!--3rd level-->
                                            <li class="dropdown-submenu">
                                                <a href=" ">
                                                    <h4 class="dropdown-toggle">
                                                        Windows (0) </h4>
                                                </a>
                                            </li>
                                            <!--3rd level over-->
                                        </ul>

                                    </div>
                                    <div class="col-sm-4 col-xs-12 cat-img-block">
                                        <img class="img img-responsive center-block" src="<?= $image?>3-200x300.jpg" alt="category" />
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li><a href=" ">Cameras</a></li>
                        <li class="dropdown">
                            <a href=" " class="dropdown-toggle main-menu">MP3 Players<i class="fa fa-angle-down down-arrow" aria-hidden="true"></i></a>
                            <div class="dropdown-menu">
                                <div class="dropdown-inner">
                                    <div class="col-sm-8 col-xs-12">
                                        <!-- <div class="col-sm-8">-->

                                        <ul class="list-unstyled">
                                            <!--3rd level-->
                                            <li class="dropdown-submenu">
                                                <a href=" ">
                                                    <h4 class="dropdown-toggle">
                                                        test 11 (0) </h4>
                                                </a>
                                                <ul class="list-unstyled grand-child">
                                                    <li>
                                                        <a href=" ">
                                                            test 17 (0)                                                    </a>
                                                    </li>
                                                    <li>
                                                        <a href=" ">
                                                            test 18 (0)                                                    </a>
                                                    </li>
                                                    <li>
                                                        <a href=" ">
                                                            test 19 (0)                                                    </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <!--3rd level over-->
                                        </ul>


                                        <ul class="list-unstyled">
                                            <!--3rd level-->
                                            <li class="dropdown-submenu">
                                                <a href=" ">
                                                    <h4 class="dropdown-toggle">
                                                        test 12 (0) </h4>
                                                </a>
                                                <ul class="list-unstyled grand-child">
                                                    <li>
                                                        <a href="">
                                                            test 20 (0)                                                    </a>
                                                    </li>
                                                    <li>
                                                        <a href=" ">
                                                            test 21 (0)                                                    </a>
                                                    </li>
                                                    <li>
                                                        <a href=" ">
                                                            test 22 (0)                                                    </a>
                                                    </li>
                                                    <li>
                                                        <a href=" ">
                                                            test 23 (0)                                                    </a>
                                                    </li>
                                                    <li>
                                                        <a href=" ">
                                                            test 8 (0)                                                    </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <!--3rd level over-->
                                        </ul>


                                        <ul class="list-unstyled">
                                            <!--3rd level-->
                                            <li class="dropdown-submenu">
                                                <a href=" ">
                                                    <h4 class="dropdown-toggle">
                                                        test 15 (0) </h4>
                                                </a>
                                                <ul class="list-unstyled grand-child">
                                                    <li>
                                                        <a href=" ">
                                                            test 24 (0)                                                    </a>
                                                    </li>
                                                    <li>
                                                        <a href=" ">
                                                            test 4 (0)                                                    </a>
                                                    </li>
                                                    <li>
                                                        <a href=" ">
                                                            test 5 (0)                                                    </a>
                                                    </li>
                                                    <li>
                                                        <a href=" ">
                                                            test 6 (0)                                                    </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <!--3rd level over-->
                                        </ul>

                                    </div>
                                    <div class="col-sm-4 col-xs-12 cat-img-block">
                                        <img class="img img-responsive center-block" src="<?= $image?>2-200x300.jpg" alt="category" />
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
<?php
$this->registerJS("
    function headermenu() {
      if (jQuery(window).width() < 992) {
        jQuery('ul.nav li.dropdown a.main-menu').attr(\"data-toggle\", \"dropdown\");
      }
      else {
        jQuery('ul.nav li.dropdown a.main-menu').attr(\"data-toggle\", \"\");
      }
    }
    $(document).ready(function () { headermenu(); });
    jQuery(window).resize(function () { headermenu(); });
    jQuery(window).scroll(function () { headermenu(); });
 
    $(document).ready(function () {
      if (jQuery(window).width() > 1200) {
        $('#navbar').affix({
          offset: {
            top: $('header').height()
          }
        });
      }
    });   
    
");
?>
