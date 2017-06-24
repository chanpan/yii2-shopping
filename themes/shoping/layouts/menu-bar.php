<?php 
    $user_id = 1;//Yii::$app->user->identity->id;
    $cart=0;
    if(!empty($user_id)){
        $model = \common\models\Carts::find()->where(["user_id"=>$user_id])->one();
        if(!empty($model)){
            $cart = $model->product_item;
        }
    }
    $images = \Yii::getAlias('@storageUrl') . "/web/image/";
?>
<div id="navbar" class="navbar-static-top">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-6">
                    <div id="logo">
                        <a href="<?= yii\helpers\Url::to(['/site/index'])?>"><img src="<?= $image?>logo.png" title="Shopkit-04" alt="Shopkit-04" class="img-responsive center-block" /></a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 user-cart">
                    <ul class="list-inline list-unstyled" >
<!--                        <li class="dropdown account"><a href="" title="Sign In" class="dropdown-toggle" data-toggle="dropdown"><span>Sign In</span> <img src="<?= $image?>user.png" alt="user"> </a>
                            <ul class="dropdown-menu dropdown-menu-right wrc-acl">
                                <li><a href="<?= yii\helpers\Url::to(['/user/sign-in/signup'])?>">Register</a></li>
                                <li><a href="<?= yii\helpers\Url::to(['/user/sign-in/login'])?>">Login</a></li>
                            </ul>
                        </li>-->
                        <li>
                            <div id="cart" class="btn-group btn-block">
                                <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="btn btn-block btn-lg dropdown-toggle">
                                    <span class="text-cart"> my cart</span> <img src="<?= $image?>cart.png" alt="cart"> 
                                    <span id="cart-total" class= "cart-items cart-digit1 img img-circle">
                                        <?= $cart;?>   </span>
                                    
                                    <?php 
                                        $this->registerJS("
                                            
                                        ");
                                    ?>
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
                            <div class="all-categors">
                                
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
                <div class="navbar-header" data-toggle="collapse" data-target=".navbar-ex1-collapse"><span id="category" class="visible-sm visible-xs"></span>
                    <button type="button" class="btn btn-navbar  navbar-toggle"><i class="fa fa-bars"></i></button>
                </div>

                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="<?= yii\helpers\Url::to(['/site/index'])?>" class="dropdown-toggle main-menu">
                                <i class="glyphicon glyphicon-home"></i> หน้าหลัก</a>
                        </li>
                        <li>
                            <a href="<?= yii\helpers\Url::to(['/products/promotion/index'])?>" class="dropdown-toggle main-menu">
                                <i class="fa fa-user"></i> โปรโมชั่น</a>
                        </li>
                        <li><a href="<?= yii\helpers\Url::to(['/products/prod'])?>"><i class="fa fa-product-hunt" aria-hidden="true"></i> รายการสินค้า</a></li>
                         
                        <li>
                            <a href="<?= yii\helpers\Url::to(['/informations/new'])?>"><i class="fa fa-comments-o"></i> ข่าวสาร</a>
                        </li>
                        <?php if(!empty(Yii::$app->user->identity)):?>
                            <li><a href="<?= yii\helpers\Url::to(['/user/default/index'])?>">โปรไฟล์</a></li>
                            <li>
                                <?= yii\helpers\Html::a('ออกจากระบบ', yii\helpers\Url::to(['/user/sign-in/logout']), ['data-method' => 'POST']) ?>
                            </li>
                        <?php else:?>
                             <li>
                                <a href="<?= yii\helpers\Url::to(['/user/sign-in/login'])?>">
                                <i class="fa fa-sign-in"></i> ลงชื่อเข้าใช้งาน</a>
                            </li>
                            <li><a href="<?= yii\helpers\Url::to(['/user/sign-in/signup'])?>">สมัครสมาชิก</a></li>
                        <?php endif; ?>
                                 
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>

<?=  common\lib\sdii\widgets\SDModalForm::widget([
        'id' => 'modal-login',
        'size' => 'modal-lg',
        'tabindexEnable' => false,
        'clientOptions'=>['backdrop'=>'static'],
	 'options'=>['style'=>'overflow-y:scroll;']
    ]);  
 
?>
<style>
    
    .user-cart, .user-cart ul {
       
        z-index:100000;
    }
    #btn-search-category{
        float:left;
            margin-bottom: 10px;
    }
    #text-search{
        width:80%;
    }
    @media (max-width: 991px){
        #menu .navbar-collapse {
            background: #ffffff none repeat scroll 0 0;
            left: 0;
            right: 0;
            position: absolute;
            z-index: 99;
            margin: 0;
            border: 1px solid #d5d5d5;
            top: 100%;
            width: 300px;
        }
    }
    @media (max-width: 500px){
        #text-search {
            width: 75%;
        }
    }
    /* ----------- iPhone 4 and 4S ----------- */

    /* Portrait and Landscape */
    @media only screen 
      and (min-device-width: 320px) 
      and (max-device-width: 480px)
      and (-webkit-min-device-pixel-ratio: 2) {
          .affix .menu-bg{
                position: absolute;
                left: 0;
                top: 57px;
           }

    }

    /* Portrait */
    @media only screen 
      and (min-device-width: 320px) 
      and (max-device-width: 480px)
      and (-webkit-min-device-pixel-ratio: 2)
      and (orientation: portrait) {
    }

    /* Landscape */
    @media only screen 
      and (min-device-width: 320px) 
      and (max-device-width: 480px)
      and (-webkit-min-device-pixel-ratio: 2)
      and (orientation: landscape) {

    }
</style>

<?php
$this->registerJS("
    $('#btnLogin').click(function(){
        $('#modal-login .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');    
        $.ajax({
            url:'".\yii\helpers\Url::to(['/user/sign-in/login'])."',
            success:function(data){
             $('#modal-login').modal('show');
            // console.log(data);
             $('#modal-login .modal-content').html(data);
            },error:function(err){
                $('#modal-login .modal-content').html(err);
            }
        });
    });
    ///user/sign-in/signup
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
