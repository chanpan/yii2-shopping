<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "credits".
 *
 * @property integer $credit_id
 * @property string $user_id
 * @property integer $credit_status
 * @property string $create_date
 * @property string $update_date
 * @property string $user_create
 * @property string $user_update
 */
class Credits extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'credits';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['credit_id', 'user_id'], 'required'],
            [['credit_id', 'credit_status'], 'integer'],
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
            'credit_id' => 'Credit ID',
            'user_id' => 'รหัสนักศึกษา',
            'credit_status' => 'สถานะเครดิต',
            'create_date' => 'วันที่สร้าง',
            'update_date' => 'วันที่แก้ไข',
            'user_create' => 'User Create',
            'user_update' => 'User Update',
        ];
    }
}
