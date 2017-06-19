<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\assets\PizzaAsset;

$image = \Yii::getAlias('@storageUrl') . "/web/img/";
$images = \Yii::getAlias('@storageUrl') . "/web/images/";
PizzaAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>
    </head>

    <body>
<?php $this->beginBody() ?>
        <div class="loader-overlay" style="display:none;"><div><img src="<?= $image?>/loader.gif"></div></div>

        <!-- TOP USER BAR -->
        <div class="userbar">
            <div class="container">
                <div class="user-control">
                    <ul>
                        <li><a href="/Account/Signup">ลูกค้าใหม่</a></li>
                        <li><a data-toggle="toggle-login-form" href="javascript:void(0)">เข้าสู่ระบบ</a></li>
                    </ul>
                    <div class="lang">
                        <a href="/Home/ChangeLanguage/1">English</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- TOP USER BAR END -->
        <!-- HEADER -->
        <div class="header">
            <div class="container">
                <!-- LOGO -->
                <div class="top-logos" style="display: inline-block;
                                                vertical-align: middle;
                                                width: 141px;
                                                height: 90px;
                                                /* background: url(../img/tpc-logo.svg) no-repeat center center; */
                                                background-size: 100%;">
                    
                    Khongchum
                    <a href="/"></a>
                </div>
                <!-- MAIN NAV -->
                <div class="mobileNavToggle">
                    <a class="openMobileNav" href="javascript:void(0)"><i class="material-icons">menu</i></a>
                    <a class="closeMobileNav hide" href="javascript:void(0)"><i class="material-icons">close</i></a>
                </div>
                <ul class="main-nav">              
                    <li class="mobile-user-menu">
                        <div class="mobile-select-lang">
                            <a class="active" href="/Home/ChangeLanguage/0">ภาษาไทย</a>
                            <a href="/Home/ChangeLanguage/1">English</a>
                        </div>
                        <!-- MOBILE USER MENU -->
                        <div class="left">
                            <a class="btn signup" href="/Account/Signup">ลูกค้าใหม่</a>
                        </div>
                        <div class="right">
                            <a class="btn login" data-toggle="toggle-login-form" href="javascript:void(0)">เข้าสู่ระบบ</a>
                        </div>
                        <!-- END OF MOBILE USER MENU -->
                        <div class="clear"></div>
                    </li>

                    <li><a href="/Home/Contact">ติดต่อเรา</a></li>
                    <li><a href="/Home/FAQ/Register">คำถามที่พบบ่อย</a></li>
                    <li><a href="/Home/Store">ค้นหาร้าน</a></li>


                    <li><a data-toggle="toggle-login-form" href="javascript:void(0)">ตรวจสอบสถานะการส่ง</a></li>


                    <li>
                        <a href="javascript:void(0)" data-toggle="toggle-upsell" class=""><i class="material-icons" style="vertical-align: middle;">shopping_cart</i> <span class="desktop-cart-btn">0 <small>บาท</small></span></a>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
        <!-- HEADER END -->
        <!-- MOBILE CART BUTTON -->
        <a href="javascript:void(0)" class="mobile-cart-btn">
            <i class="material-icons">shopping_basket</i>
            <span class="mobile-cart-price" id="mobileprice">
                0 บาท
            </span>
        </a>
        <!-- MOBILE CART BUTTON END-->
        <!-- NEW NAVIGATION-->
        <div class="body-nav-main">
            <div class="body-nav">
                <div class="container">
                    <div class="body-nav-container">
                        <a href="/Promotion"><img src="<?= $image ?>/promotion.png">โปรโมชั่น</a>
                        <a href="<?= \yii\helpers\Url::to(['product'])?>"><img src="<?= $image ?>/pizza.png">พิซซ่า</a>
                        <a href="/Product/Puff"><img src="<?= $image ?>/puff.png">พิซซ่า พัฟ</a>
                        <a href="/Product/Pasta"><img src="<?= $image ?>/pasta.png">พาสต้า</a>
                        <a href="/Product/Chicken"><img src="<?= $image ?>/chicken.png"> จานหลักและไก่</a>
                        <a href="/Product/Appetizer"><img src="<?= $image ?>/appetizer.png">อาหารรองท้อง</a>
                    </div>
                </div>            
            </div>
        </div>
        <!-- NEW NAVIGATION END -->
        <!-- PAGE CONTENT -->
<!--        <div class="main-cta">
            <div class="container">

                <a class="main-cta-btn" href="/Product/Pizza?link=on"><span class="lead">หิวแล้วใช่ไหม ?</span> <span class="cap">สั่งพิซซ่าหน้าโปรดของคุณ พร้อมเมนูแสนอร่อยอื่นๆได้เลย</span> <b>สั่งเลย</b></a>

            </div>
        </div>-->
        <!-- SLIDESHOW -->
        <?= $content; ?>
        <div class="clear"></div>
        <!-- SLIDESHOW END -->
        <!-- SIDEBAR CART -->
        <div id="summary">
            <div class="cart">
                <div class="sticky" id="cartcontrol">
                    <div class="hideSidebarCart">


                        <div class="cart-container">
                            <h2>รายการสั่งซื้อ</h2>
                            <div class="empty-cart">
                                <img src="<?= $image?>/basket-01.png">
                                <h2>คุณยังไม่มีรายการสั่งซื้อ</h2>
                                <p>สั่งอาหารได้โดยการกด <b>เพิ่ม</b> จากเมนูด้านซ้าย</p>
                            </div>
                        </div>
                        <?php
                            $this->registerJs("
                                
                                $('#mobileprice').html('0 บาท');
                                $('.mobile-cart-price').html('0 บาท');
                                $('.desktop-cart-btn').html('0 <small>บาท</small>');

                                $('.remove-cart').click(function (event) {
                                    var id = $(this).data('id');

                                    $.ajax({
                                        url: '/Order/RemoveCart',
                                        type: 'POST',
                                        data: {Id: id}
                                    })
                                            .done(function (partialViewResult) {
                                                $('#cartcontrol').html(partialViewResult);
                                    });
                                });

                                $('.side-checkout').on('click', function (event) {
                                    location.href = '/Order/Review';
                                });
                            ");
                        ?>
                    </div>
                </div>
            </div>

        </div>
        <!-- SIDEBAR CART END -->
        <!-- SPLASH SCREEN -->

        <!-- SPLASH SCREEN END -->
        <?php $this->registerJS("
            $('a').click(function (event) {
                var length = $(this).data('assigned-id');
                if (length < 2) {
                    event.preventDefault();
                    return false;
                } else {
                    return true;
                }
            });



            $('body').addClass(\"home\");
        ")?>

        <!-- PAGE CONTENT END -->
        <!-- FOOTER -->
        <div class="footer">
            <!-- FOOTER NAV -->
            <ul class="footer-nav">
                <li><a href="/Home/Contact">ติดต่อเรา</a></li>
                <li><a href="/Home/FAQ/Register">คำถามที่พบบ่อย</a></li>
                <li><a href="/TakeawayCard" target="_blank">บัตรซื้อ 1 แถม 1</a></li>
                <li><a href="/Home/Store">ค้นหาร้าน</a></li>
                <li><a href="/Home/Aboutus">เกี่ยวกับเรา</a></li>
                <li><a href="/Home/Privacy">นโยบายข้อมูลส่วนตัว</a></li>
            </ul>
        </div>
        <!-- FOOTER END -->
        <span id="homepage-flag" style="display: none"></span>
        <!-- OVERLAY -->
        <div class="overlay inactive">
            <!-- AJAX LOAD HERE -->
        </div>    


        <div class="chatbutton">
            <a href="javascript:void(0);"><i class="fa fa-commenting"></i> แชทกับเรา</a>
            <span class="notification"></span>
        </div>
        <div class="chatinvite">
            <h1>สวัสดีค่ะ</h1>
            <p>กำลังติดปัญหาอะไรอยู่รึเปล่า ให้เราช่วยนะคะ</p>
            <a href="javascript:void(0);">Reply</a>
            <span class="closeInvite">
                <i class="fa fa-close"></i>
            </span>
        </div>
        <div class="chat-container">
            <div class="chat-header">
                <div class="chat-header-title">
                    <img src="<?= $image?>/tpc-logo.svg" />
                    <span>Live Chat - The Pizza Company</span>
                </div>
                <!--<div class="chat-window-control">
                        <a href="javascript:void(0);" class="closeChat"><i class="fa fa-close"></i></a>
                </div>-->
            </div>
            <div class="chat-body">
                <div class="chat-status-bar">
                    <span style="display: block; text-align: center;">กำลังเชื่อมต่อ...,</span>
                </div>
                <div class="chat-body-content">
                    <div class="sent-chat-box">

                    </div>
                </div>
                <div class="chat-connecting" style="text-align: center; color: #7A7A7A; position:absolute; top: 50%; width: 100%; margin-top: -155px;">
                    <span class="chat-icon" style="font-size: 128px; display: block; color: #5DA176;"><i class="fa fa-comments"></i></span>
                    <span class="loader" style="display: block;"><img width="40px;" src="<?= $images?>/ellipsis.svg"></span>

                    <span style="font-size: 18px; line-height: 1.2em;">กรุณารอสักครู่<br> เรากำลังเชื่อมต่อคุณไปยังเจ้าหน้าที่...</span>

                </div>
                <div class="chat-no-agent" style="display: none;text-align: center; color: #7A7A7A; position:absolute; top: 50%; width: 100%; margin-top: -135px;">
                    <span class="chat-icon" style="font-size: 84px; display: block; color: rgb(232, 90, 90);"><i class="fa fa-user-times"></i></span>

                    <h1 style="font-size: 36px; font-weight: bold; margin-top: 10px; margin-bottom: 5px;">ขออภัย!</h1>
                    <span style="font-size: 18px; line-height: 1.2em;">เจ้าหน้าที่ของเรากำลังให้บริการลูกค้าท่านอื่นอยู่,<br> กรุณาลองใหม่อีกครั้งค่ะ</span>

                </div>
            </div>
            <div class="typingIndicator">
                กำลังพิมพ์...
            </div>
            <div class="chat-input">
                <div class="chat-input-container">
                    <input id="chatInput" placeholder="Type something..." type="text" disabled />
                </div>
                <button id="sendChatBtn" disabled>Send <i class="fa fa-paper-plane"></i></button>
            </div>
        </div>


        <?php 
            $this->registerJs("
              $(document).on('click', '.loaderButton', function (e) {
                    $('.loaderButton,#placeOrderBtn').html('<img src=\'".$image.'/loader.gif'."\'> <span>กรุณารอสักครู่ ระบบกำลังทำงาน...</span>').css({'font-size': '18px', 'line-height': '18px', 'transition': 'none', 'background': '#999'});
                    $('.loaderButton,#placeOrderBtn').prop('disabled', true);
                    $('.loaderButton').closest('form').submit();
                });  
             var langjs = 'th';
             var visitorName = '';
            ");
            
        ?>
       
<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage(); ?>