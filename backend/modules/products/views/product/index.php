<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
 
$this->title = Yii::t('backend', 'Products');
$this->params['breadcrumbs'][] = $this->title;
$img = \Yii::$app->request->baseUrl . "/../frontend/web/img/";

//echo Yii::$app->user->can('administrator ');
\Yii::$app->language;
?>
<div class="product-index">
 
    <h1 class="title pull-left">
        สินค้า

        <span>
            <span id="btn-grid" style="">
                <img src="<?= $img . "tablemode.png" ?>" alt="" title="โหมดตารางสินค้า" height="30" style="margin-top: -6px;">
                <a href="#" id="listView"><img src="<?= $img . "picturemode.png" ?>" alt="" title="โหมดรูปสินค้า" height="30" style="opacity:0.4;filter:alpha(opacity=40);margin-top: -6px;"></a>
            </span>
            <span id="btn-list" style="display:none;">
                <a href="#" id="gridView"><img src="<?= $img . "tablemode.png" ?>" alt="" title="โหมดตารางสินค้า" height="30" style="opacity:0.4;filter:alpha(opacity=40);margin-top: -6px;"></a>
                <img src="<?= $img . "picturemode.png" ?>" alt="" title="โหมดรูปสินค้า" height="30" style="margin-top: -6px;">
            </span>
        </span>
    </h1>

 
    <div class="clearfix"></div>
    <div class="search">
        <div class="form-inline pull-left">
            <div class="search-text">
                <i class="fa fa-search" aria-hidden="true"></i>
                <label class="sr-only" for="search">ค้นหา</label>
                <input type="text" class="form-control form-text" id="quicksearchtext" placeholder="พิมพ์คำค้นหา" maxlength="128" onkeypress="searchKeyPress(event);">
            </div>
        </div>   
    </div>
    <div class="clearfix"></div>
    
    <?php yii\widgets\Pjax::begin(['id' => 'grid', 'timeout' => 5000]) ?> 
    <div id="contents"></div>
    <?php
    $this->registerJs("
                listView();
                $('#listView').click(function(){
                    listView();
                    $('#btn-grid').fadeOut();
                    $('#btn-list').fadeIn();
                });
                $('#gridView').click(function(){
                     gridView();
                     $('#btn-grid').fadeIn();
                    $('#btn-list').fadeOut();
                });
                
                
                function listView(){
                   $.ajax({
                     url:'" . Url::to(['custom-grid']) . "',
                     type:'POST',
                     data:{options:1},
                     success:function(res){
                        $('#contents').html(res);
                     }
                   });
                }
                
                function gridView(){
                   $.ajax({
                     url:'" . Url::to(['custom-grid']) . "',
                     type:'POST',
                     data:{options:0},
                     success:function(res){
                        $('#contents').html(res);
                     }
                   });
                }
            ");
    ?>
   <div id="modal-product" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static" >
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    <?php yii\widgets\Pjax::end() ?>
</div>
<?php $this->registerCss("
    .summary{
        float:right;
        clear:both;
    }
")?>
<?php  $this->registerJs("
    $('#btnAddProduct').on('click', function(e){
        modalProduct($(this).attr('data-url'), 'เพิ่มสินค้าใหม่');
        //alert('Test');
        return false;
    });
    function modalProduct(url,title) { 
     $('#modal-product .modal-header').html('<b>'+title+'</b><button class=\"close\" data-dismiss=\"modal\">&times;</button>');
     $('#modal-product .modal-body').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>'); 
     $('#modal-product').modal('show') 
     .find('.modal-body') 
        .load(url); 
     } 
   $('.close').on('click',function(e){
        console.log('Close');
        ///// location.reload();
         $.pjax.reload({container:'#grid'}); //refresh the grid 
        });
    function Update(url){
        modalProduct(url, 'แก้ไขสินค้า');
        return false;
    }
   
")?>

