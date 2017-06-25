<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
    use kartik\grid\GridView;
    $this->title = "หน้าหลัก";
?>
 
<div class="box">
    <div class="box-body"> 
        <div class="col-md-6 col-xs-6">
            <div class="simple grid vertical blue">
                <div class="tiles white add-margin">
                    <div class="row b-grey b-b xs-p-b-20">
                        <div class="col-md-5 col-md-offset-1">
                            <h4 class="text-black semi-bold">ยอดขายวันนี้</h4>
                            <h4 class="text-primary semi-bold">0.00 ฿</h4>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <h4 class="text-black semi-bold">ยอดขายเดือนนี้</h4>
                                <h4 class="text-primary semi-bold">0.00 ฿</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-6">
            <div class="simple grid vertical green">
                <div class="tiles white add-margin">
                    <div class="row b-grey b-b xs-p-b-20">
                        <div class="col-md-5 col-md-offset-1">
                            <h4 class="text-black semi-bold">ลูกค้าในระบบทั้งหมด</h4>
                            <h4 class="text-primary semi-bold"><i class="fa fa-users"></i> <?= count($user);?> คน</h4>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <h4 class="text-black semi-bold">จำนวนสินค้าทั้งหมด</h4>
                                <h4 class="text-primary semi-bold"><i class="fa fa-product-hunt"></i> <?= count($product);?> รายการ</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div><hr>
        <div class="col-md-6 col-xs-6">
            <div class="simple grid vertical red">
                <div class="tiles white add-margin">
                    <div class="row b-grey b-b xs-p-b-20">
                        <div class="col-md-12">
                            <h4 class="text-black semi-bold text-center"><b>ทอป 10 สินค้า</b></h4>
                            <h4 class="text-primary semi-bold"> 
                                 <?= GridView::widget([
                                    'dataProvider'=>$dataProvider,
                                    'tableOptions'=>[
                                        'class'=>'table table-responsive'
                                    ],
                                     'summary' => false,
                                    'columns'=>[
                                        [
                                            'label'=>'ชื่อสินค้า',
                                            'value'=>'product_name'
                                        ],
                                        
                                    ]
                                ]);?>
                            </h4>
                        </div>
                        
                    </div>
                </div>
            </div>
         
    
    
    
</div>
</div>
<?= $this->registerCSS("
 #user-count{
 
    text-align: center;
    background: #00a65a;
    color: white;
    border: 3px solid #d2d6de;
    padding: 10px;
    margin-right:3px;
}   
#product-count{
    text-align: center;
    background: #3c8dbc;
    color: white;
    border: 3px solid #d2d6de;
    padding: 10px;
    margin-right:3px;
}
#sum-prict-day {
    text-align: center;
    background: #f39c12;
    color: white;
    border: 3px solid #d2d6de;
    padding: 10px;
    margin-right: 3px;
}
#top-ten{
    background: #f1f1f1;
    color: #000;
}
.table thead tr th{
    background:#ffffff;color: #000;
}
.table tbody tr td{
    background:#ffffff;color: #000;
}
.grid.simple.vertical.blue {
    border-left: 4px solid #0090d9;
    border-top: none !important;
    background: #ecf0f5;
}
.grid.simple.vertical.green {
    border-left: 4px solid #0aa699;
    border-top: none !important;
    background:#ecf0f5
}
.grid.simple.vertical.red {
    border-left: 4px solid #dd4b39;
    border-top: none !important;
    background:#ecf0f5
}
")?>