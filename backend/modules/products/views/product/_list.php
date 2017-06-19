 
<?php
use yii\widgets\ListView;
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => [
        'class' => 'col-sm-2 col-md-2',
        'style' => 'border: 3px solid #ecf0f5;  padding: 17px 13px 13px 13px;margin:3px;'
    ],
    'itemView' => '_items',
    'pager' => [
        'firstPageLabel' => 'ก่อนหน้า',
        'lastPageLabel' => 'ถัดไป',
        'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>',
        'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right"></span>',
    ],
    'layout' => '{summary}{items}{pager}'//{sorter}
])
?>
 