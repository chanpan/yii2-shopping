<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_profile".
 *
 * @property integer $user_id
 * @property integer $locale
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $picture
 * @property string $avatar
 * @property string $avatar_path
 * @property string $avatar_base_url
 * @property integer $gender
 *
 * @property User $user
 */
class UserProfile extends ActiveRecord
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    /**
     * @var
     */
    public $picture;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'picture' => [
                'class' => UploadBehavior::className(),
                'attribute' => 'picture',
                'pathAttribute' => 'avatar_path',
                'baseUrlAttribute' => 'avatar_base_url'
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * @inheritdoc
     *///department_id subject_id
    public function rules()
    {
        return [
            [['user_id','student_id','department_id','subject_id','tel', 'address', 'distric', 'amphur', 'province','zipcode'], 'required'],
            [['user_id', 'gender'], 'integer'],
            [['student_id'],'unique','message'=>'รหัสนักศึกษาซ้ำกัน'],
            [['gender'], 'in', 'range' => [NULL, self::GENDER_FEMALE, self::GENDER_MALE]],
            [['firstname', 'middlename', 'lastname', 'avatar_path', 'avatar_base_url'], 'string', 'max' => 255],
            ['locale', 'default', 'value' => Yii::$app->language],
            ['locale', 'in', 'range' => array_keys(Yii::$app->params['availableLocales'])],
            ['picture', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('common', 'User ID'),
            'firstname' => Yii::t('common', 'ชื่อ'),
            'middlename' => Yii::t('common', 'ชื่อเล่น'),
            'lastname' => Yii::t('common', 'นามสกุล'),
            'locale' => Yii::t('common', 'ตำแหน่ง'),
            'picture' => Yii::t('common', 'รูปภาพประจำตัว'),
            'gender' => Yii::t('common', 'เพศ'),
            'student_id'=>'รหัสนักศึกษา',
            'department_id'=>'คณะ',
            'subject_id'=>'สาขาวิชา',
             'tel' => 'เบอร์ที่สามารถติดต่อได้',
            'address' => 'ที่อยู่',
            'distric' => 'ตำบล',
            'amphur' => 'อำเภอ',
            'province' => 'จังหวัด',
            'zipcode'=>'รหัสไปรษณีย์'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return null|string
     */
    public function getFullName()
    {
        if ($this->firstname || $this->lastname) {
            return implode(' ', [$this->firstname, $this->lastname]);
        }
        return null;
    }

    /**
     * @param null $default
     * @return bool|null|string
     */
    public function getAvatar($default = null)
    {
        return $this->avatar_path
            ? Yii::getAlias($this->avatar_base_url . '/' . $this->avatar_path)
            : $default;
    }
    public function getProvinces(){
       return $this->hasOne(Province::className(), ['PROVINCE_ID' => 'province']);
    }
     public function getAmphurs(){
       return $this->hasOne(Amphur::className(), ['AMPHUR_ID' => 'amphur']);
    }
     public function getDistrics(){
       return $this->hasOne(District::className(), ['DISTRICT_ID' => 'distric']);
    }
}
