<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "carts".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $product_id
 * @property integer $product_item
 * @property integer $product_price
 * @property integer $cookie_date
 */
class Carts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'product_item', 'product_price', 'cookie_date'], 'integer'],
            [['product_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'product_item' => Yii::t('app', 'Product Item'),
            'product_price' => Yii::t('app', 'Product Price'),
            'cookie_date' => Yii::t('app', 'Cookie Date'),
        ];
    }
}
