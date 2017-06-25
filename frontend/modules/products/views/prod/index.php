<?php

use yii\helpers\Url;
use kartik\helpers\Html;

$this->title = "สินค้า";
$image = \Yii::getAlias('@storageUrl') . "/web/img/";
$this->params['breadcrumbs'][] = $this->title;
?>


<!--<div class="container">
     
    <div class="product-container">
        <ul class="product-list">
<?php foreach ($model as $p): ?>
                    <li class="product-block">
                        <div class="product-img">
                            <img src="<?= $image . $p->product_image ?>">
                        </div>
                        <div class="product-det">
                            <h2 class="product-name"><?= $p->product_name ?></h2>
                            <div class="product-overflow">
                                <p class="product-info"><?= $p->product_detail; ?></p>
                            </div>
                            <a href="javascript:void(0)" data-id="102204" class="btn add-to-cart">
                                <span class="price">319 บาท</span>
                                <span class="add"><i class="material-icons">add</i> เพิ่ม</span>
                            </a>
                        </div>
                    </li>
<?php endforeach; ?>
            
        </ul>
    </div>
    
</div>-->



<div class="container" >
    <h1>Product</h1>
    <div class="row cat-row category-page"><div class=""><aside id="column-left" class="col-sm-3 hidden-xs">
                <hr class="catetophr">
                <h4 class="column-left-title">Search</h4>
                <hr class="catetophr">
                <div class="list-group category-left">
                    <h4 data-toggle="collapse" data-target="#demo" class="cat-heading">Categories </h4>
                    <div id="demo" class="collapse in">
                        <a href="http://opencart.webiarch.com/OCSK06/OCSK04/index.php?route=product/category&amp;path=20" class="list-group-item active">Desktops (19)</a>
                        <a href="http://opencart.webiarch.com/OCSK06/OCSK04/index.php?route=product/category&amp;path=20_26" class="list-group-item">&nbsp;&nbsp;&nbsp;- PC (6)</a>
                        <a href="http://opencart.webiarch.com/OCSK06/OCSK04/index.php?route=product/category&amp;path=20_27" class="list-group-item">&nbsp;&nbsp;&nbsp;- Mac (5)</a>
                        <a href="http://opencart.webiarch.com/OCSK06/OCSK04/index.php?route=product/category&amp;path=18" class="list-group-item">Laptops (10)</a>
                        <a href="http://opencart.webiarch.com/OCSK06/OCSK04/index.php?route=product/category&amp;path=33" class="list-group-item">Cameras (4)</a>
                        <a href="http://opencart.webiarch.com/OCSK06/OCSK04/index.php?route=product/category&amp;path=34" class="list-group-item">MP3 Players (5)</a>
                    </div>
                </div>

                
            </aside>
            <div id="content" class="col-sm-9" >    <hr class="catetophr">
                <div id="cat-frist-row" class="row">
                    <div class="col-md-4 col-lg-2 col-sm-3 col-xs-12">
                        <div class="btn-group btn-group-sm ">
                            <button type="button" id="list-view" class="btn listgridbtn" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                            <button type="button" id="grid-view" class="btn listgridbtn" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
                        </div>
                    </div>
                  
                    <div class="col-md-5 col-lg-6 col-sm-5 col-xs-6 catesort">
                        <div class="form-group input-group input-group-sm">
                            <label class="input-group-addon" for="input-sort" >Sort By:</label>
                            <form name="form-sorter" action="<?= Url::to(['/products/prod/index'])?>" method="get" >
                                <select id="input-sort" name="sorter" class="form-control" onchange="this.form.submit()">
                                <option value="" selected="selected">Default</option>
                                <option value="1">Name (A-Z)</option>
                                <option value="2">Name (Z-A)</option>
                            </select>
                            </form>    
                        </div>    
                        </div>
                    
                    <div class="col-md-3 col-lg-4 col-sm-4 col-xs-6 catesort">
                        <div class="form-group input-group input-group-sm">
                            <label class="input-group-addon" for="input-limit">Show:</label>
                            <form name="form-sorter" action="<?= Url::to(['/products/prod/index'])?>" method="get" >
                                <select id="input-limit" name="showpage" class="form-control" onchange="this.form.submit()">
                                <option value="9" selected="selected">9</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="75">75</option>
                                <option value="100">100</option>
                            </select>
                            </form>    
                        </div>
                    </div>
                </div>
                <hr class="catetophr">
                

                <div class="row">
                    <?php foreach($model as $p):?>
                    
                    <div class="product-layout product-list col-xs-12" style="padding:3px;">
                            <div class="item">
                                <a href="<?= Url::to(['prod/detail','product_id'=> base64_encode($p->product_id)])?>">
                                <div class="product-thumb transition" style="height: 400px;overflow: hidden;">
                                    <div class="images" style="margin:3px;">
                                            <img style="padding:5px;" src="<?= $image.$p->product_image;?>" alt="<?= $p->product_name?>" title="<?= $p->product_name?>" class="img-responsive" />
                                            <!-- Webiarch Images Start -->
                                            <img style="padding:5px;" src="<?= $image.$p->product_image;?>" class="img-responsive additional-home3" alt="<?= $p->product_name?>"/>
                                        </a>
                                    </div>

                                    <div class="caption">
                                            <h4 class="product-name"><?= $p->product_name;?></h4>
                                        <p class="price">
                                            <span class="price-new"><?= number_format($p->product_price, 2);?> บาท</span> <span class="price-old"><?= number_format($p->product_price, 2);?></span>
                                        </p>
                                    </div>
<!--                                    <div class="button-group2">
                                        <button type="button" onclick="cart.add('42');" class="addtocart"><i class="fa fa-shopping-bag"></i> <span class="hidden-xs hidden-sm hidden-md"></span></button>
                                        <button type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('42');" class="compare-btn"><i class="fa fa-balance-scale" aria-hidden="true"></i></button>
                                        <button type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('42');" class="wishlist-btn"><i class="fa fa-heart"></i></button>
                                        <button type="button" data-toggle="tooltip" title="Go To Product" onclick="location.href = 'http://opencart.webiarch.com/OCSK06/OCSK04/index.php?route=product/product&amp;path=20&amp;product_id=42';" class="zoom-btn"> <i class="fa fa-search"></i></button> 
                                    </div>-->
                                </div>
                            
                            </div>
                        </div>
                    
                    <?php endforeach; ?>
                </div>

                <div class="row result-pagination">
                    <?php 
                        $count = \common\models\Product::find()->all(); 
                        $count =  count($count);
                    ?>
                    <div class="col-sm-12">
                        <hr class="pagination-top">
                            <?php 
                                
                                echo \yii\widgets\LinkPager::widget([
                                    'pagination' => $pages,
                                ]);
                            ?>
                        <hr class="pagination-bottom">
                    </div>
                    <!--<div class="col-sm-6 text-right">Showing 1 to 9 of 15 (2 Pages)</div>-->
                </div>
                
            </div>
        </div>
    </div>
</div>


<!--content bottom full -->
<!--over-->

