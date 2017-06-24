<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "carts".
 *
 * @property integer $user_id
 * @property string $product_id
 * @property integer $product_item
 * @property integer $product_price
 * @property string $cookie_date
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
            [['user_id', 'product_item', 'product_price'], 'integer'],
            [['cookie_date'], 'safe'],
            [['product_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'product_item' => Yii::t('app', 'Product Item'),
            'product_price' => Yii::t('app', 'Product Price'),
            'cookie_date' => Yii::t('app', 'Cookie Date'),
        ];
    }
}
