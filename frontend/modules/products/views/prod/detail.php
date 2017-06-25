<?php 
    use yii\helpers\Url;
    use yii\helpers\Html;
    $img = \Yii::getAlias('@storageUrl') . "/web/img/";
    $image = \Yii::getAlias('@storageUrl') . "/web/image/";
    use common\lib\sdii\widgets\SDModalForm;
    $this->title = "รายละเอียดสินค้า ".$model->product_name;
    $this->params['breadcrumbs'][] = ['label' => 'รายการสินค้า', 'url' => ['/products/prod']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="container product-inner">
    <div class="row">
        <div id="content" class="col-sm-12" >
            <div class="row firdtpart">
                <div class="col-lg-5 col-md-5 col-sm-6 full-width col-xs-12 " style="padding:15px;">
                    <ul class="thumbnails col-sm-12" >
                        <li>
                             
                               <img style="margin: 0 auto;" src="<?= $img.$model->product_image;?>" id="zoom_03" class="img-responsive" alt="thumb-img">
                           
                        </li>
                    </ul>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12 product-inner-content full-width top-space" style="padding:15px;">
                    <h1><?= $model->product_name; ?></h1>
                    <hr class="black-hr">
                    <ul class="list-unstyled">
                        <li>
                           <?= $model->product_detail;?>  
                        <li>
                        
                    </ul>
                    <hr class="black-hr">


                    <ul class="list-unstyled list-inline">
                        <li>
                            <h2 class="price">ราคา <?= number_format($model->product_price, 2)?> บาท</h2>
                        </li>
                        
                         
                    </ul>
                    <hr class="black-hr">
                    <div id="product">
                       <div class="form-group required">

                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-1 col-sm-1 col-xs-1 op-box ">
                                    <label class="control-label" for="input-quantity">จำนวน</label>
                                </div>
                                <div class=" col-md-5 col-sm-11 col-xs-11 op-box qty-plus-minus">
                                    <button type="button" id="minusbutton" class="form-control pull-left btn-number"  data-type="minus" data-field="quantity">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                    <input id="input-quantity" type="text" name="quantity" value="0" size="2" class="form-control pull-left input-number" />
                                    <input type="hidden" name="product_id" value="42" />
                                    <button type="button" id="plusbutton" class="form-control pull-left btn-number" data-type="plus" data-field="quantity">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>

                                </div>

                            </div>
                            <hr class="black-hr">
                        </div>
                        <!--Quantity option over-->


                        <button type="button" id="button-cart" data-url="<?= Url::to(['prod/cart','id'=>$model->product_id])?>"  class=" add-to-cart" data-loading-text="Loading...">
                            <img src="<?= $image;?>product-cart.png" alt="cart"><span  class="addtocart-text">ใส่ตะกร้า</span></button>
                        <hr class="black-hr">


                    </div>



                    <div class="rating">
                        <p>
                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <span class="pipe1"></span>
                            <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">
                           		<span class="review">1 reviews</span>
                           </a>
                            

 

                    </div>

                    </div>
                </div>

                <hr>
                <div class="row row-mar">
                    <div class="col-sm-12 product-tab">
                        <ul class="nav nav-tabs specification">
                            <li class="active"><a href="#tab-description" data-toggle="tab">รายละเอียด</a></li>
                            <li><a href="#tab-review" data-toggle="tab">Reviews (1)</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-description">
                                <p><?= $model->product_detail;?></p>
                            </div>
                            
                            <div class="tab-pane" id="tab-review">
                                <p>Reviews</p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<?=  SDModalForm::widget([
        'id' => 'modal-cart',
        'size' => 'modal-lg',
        'tabindexEnable' => false,
        'clientOptions'=>['backdrop'=>'static'],
	 'options'=>['style'=>'overflow-y:scroll;']
    ]);  
 
?>
<?= $this->registerJSFile(yii\helpers\Url::to('@web/frontend/web/noty/noty.min.js'))?>
<?= $this->registerJSFile(yii\helpers\Url::to('@web/frontend/web/noty/notylib.js'))?>
<?php 
   $this->registerJS("
    var input_quantity = parseInt($('#input-quantity').val()); 
    
   /* เพิ่มจำนวนสินค้า */
    $('#plusbutton').click(function(){
       input_quantity += 1;
       $('#input-quantity').val(input_quantity); 
    });   
    
    /* ลดจำนวนสินค้า */
    $('#minusbutton').click(function(){
        if(input_quantity > 0){
            input_quantity -= 1;
        }
        $('#input-quantity').val(input_quantity);
    });
    /*เช็ค cookie*/
    
    /* ใส่ตระกร้า */
    $('#button-cart').click(function(){
        if($('#input-quantity').val() == '' || $('#input-quantity').val()==0){
             
            noty(type='warning', layout='bottomRight', message='กรุณาเลือกจำนวนสินค้า');
            return false;
        } 
        var pid = btoa('".$model->product_id."');
        var items = $('#input-quantity').val();
        //var chcooke = getCookie('cart');
        //setCookie('cart',btoa(JSON.stringify(carts)), 7);    
        $.ajax({
            url:'".Url::to(['prod/add-carts'])."',
            method:'POST',
            data:{
                product_id:pid,
                items:items
            },
            dataType:'JSON',
            success:function(data){
               $('#cart-total').html(data.product_item);
            }
        });
        //  $('#cart-total').html(1);
        var url = $(this).attr('data-url');
        modalCart(url);
    });
    function modalCart(url) {
        $('#modal-cart .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
        $('#modal-cart').modal('show')
        .find('.modal-content')
        .load(url);
    }
");
?>



                 