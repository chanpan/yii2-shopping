<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "interest".
 *
 * @property integer $id
 * @property string $price
 * @property integer $create_by
 * @property string $create_at
 * @property integer $update_by
 * @property string $update_at
 */
class Interest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'interest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['create_by', 'update_by'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'price' => Yii::t('backend', 'ดอกเบี้ย'),
            'create_by' => Yii::t('backend', 'สร้างโดย'),
            'create_at' => Yii::t('backend', 'สร้างวันที่'),
            'update_by' => Yii::t('backend', 'แก้ไขโดย'),
            'update_at' => Yii::t('backend', 'แก้ไขเมื่อ'),
        ];
    }
}
