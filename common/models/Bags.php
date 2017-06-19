<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bags".
 *
 * @property integer $bag_id
 * @property string $user_id
 * @property integer $bag_count
 * @property string $create_date
 * @property string $update_date
 * @property string $user_create
 * @property string $user_update
 */
class Bags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['bag_count'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['user_id', 'user_create', 'user_update'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bag_id' => 'Bag ID',
            'user_id' => 'รหัสนักศึกษา',
            'bag_count' => 'สถานะกระเป๋าเงิน',
            'create_date' => 'วันที่สร้าง',
            'update_date' => 'วันที่แก้ไข',
            'user_create' => 'User Create',
            'user_update' => 'User Update',
        ];
    }
}
