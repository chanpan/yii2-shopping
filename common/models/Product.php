<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_product".
 *
 * @property string $product_id
 * @property string $product_name
 * @property string $product_detail
 * @property integer $product_cost
 * @property integer $product_price
 * @property integer $product_price_pro
 * @property string $product_image
 * @property integer $product_num_all
 * @property integer $product_num
 * @property integer $create_by
 * @property string $create_at
 * @property integer $update_by
 * @property string $tbl_productcol
 * @property integer $product_type_id
 *
 * @property ProductType $productType
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product';
    }

  

    public function rules()
    {
        return [
            [['product_id', 'product_name', 'product_cost', 'product_price', 'product_num_all', 'product_type_id','product_unit'], 'required','message'=>'กรุณาระบุ'],
            [['product_detail', 'product_image'], 'string'],
            [['product_cost', 'product_price', 'product_price_pro', 'product_num_all', 'product_num', 'create_by', 'update_by', 'product_type_id'], 'integer'],
            [['create_at', 'tbl_productcol'], 'safe'],
            [['product_id'], 'string', 'max' => 20],
            [['product_name'], 'string', 'max' => 255],
            [['product_id'],'unique','message'=>'มีการใช้รหัสสินค้านี้แล้ว'],
             
            [['product_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['product_type_id' => 'product_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('app', 'รหัสสินค้า'),
            'product_name' => Yii::t('app', 'ชื่อสินค้า'),
            'product_detail' => Yii::t('app', 'รายละเอียดสินค้า'),
            'product_cost' => Yii::t('app', 'ราคาซื้อ'),
            'product_price' => Yii::t('app', 'ราคาขาย'),
            'product_price_pro' => Yii::t('app', 'ราคาโปรโมชั่น'),
            'product_image' => Yii::t('app', 'รูปภาพสินค้า'),
            'product_num_all' => Yii::t('app', 'สินค้าทั้งหมด'),
            'product_num' => Yii::t('app', 'สินค้าคงเหลือ'),
            'create_by' => Yii::t('app', 'สร้างโดย'),
            'create_at' => Yii::t('app', 'สร้างเมื่อ'),
            'update_by' => Yii::t('app', 'แก้ไขโดย'),
            'tbl_productcol' => Yii::t('app', 'แก้ไขเมื่อ'),
            'product_type_id' => Yii::t('app', 'ประเภทสินค้า'),
            'product_unit'=>'หน่วย'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductType()
    {
        return $this->hasOne(ProductType::className(), ['product_type_id' => 'product_type_id']);
    }
}
