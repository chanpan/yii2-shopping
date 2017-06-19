<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_type".
 *
 * @property integer $product_type_id
 * @property string $product_type_name
 *
 * @property Product[] $products
 */
class ProductType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_type_name'], 'required'],
            [['product_type_name'], 'string', 'max' => 255],
            [['product_type_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_type_id' => Yii::t('app', 'Product Type ID'),
            'product_type_name' => Yii::t('app', 'ประเภทสินค้า'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['product_type_id' => 'product_type_id']);
    }
}
