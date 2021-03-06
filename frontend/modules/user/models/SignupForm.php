<?php
namespace frontend\modules\user\models;

use cheatsheet\Time;
use common\commands\SendEmailCommand;
use common\models\User;
use common\models\UserToken;
use frontend\modules\user\Module;
use yii\base\Exception;
use yii\base\Model;
use Yii;
use yii\helpers\Url;

/**
 * Signup form
 */
class SignupForm extends Model
{
    /**
     * @var
     */
    public $username;
    /**
     * @var
     */
    public $email;
    /**
     * @var
     */
    public $password;
    public $confirmpassword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique',
                'targetClass'=>'\common\models\User',
                'message' => Yii::t('frontend', 'ชื่อผู้ใช้นี้ถูกนำมาใช้แล้ว')
            ],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass'=> '\common\models\User',
                'message' => Yii::t('frontend', 'ที่อยู่อีเมลนี้ถูกนำมาใช้แล้ว')
            ],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['confirmpassword','required']
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username'=>Yii::t('frontend', 'ชื่อผู้ใช้งาน'),
            'email'=>Yii::t('frontend', 'E-mail '),
            'password'=>Yii::t('frontend', 'รหัสผ่าน'),
            'confirmpassword'=>'ยืนยันหัสผ่าน'
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $shouldBeActivated = $this->shouldBeActivated();
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = $shouldBeActivated ? User::STATUS_NOT_ACTIVE : User::STATUS_ACTIVE;
            $user->setPassword($this->password);
            if(!$user->save()) {
                throw new Exception("User couldn't be  saved ");
               
            };
//            try{
//                 $sql="INSERT INTO tbl_user_profile(user_id,firstname,lastname,locale) VALUES(:user_id,:fname,:lname,:locale)";
//                Yii::$app->db->createCommand($sql,[
//                    ":user_id"=>$user->id,
//                    ":fname"=>$user->username,
//                    ":lname"=>$user->username,
//                    ":locale"=>"en-US"
//                ])->execute();
//            } catch (\yii\db\Exception $ex) {
//
//            }
            $user->afterSignup();
            if ($shouldBeActivated) {
                $token = UserToken::create(
                    $user->id,
                    UserToken::TYPE_ACTIVATION,
                    Time::SECONDS_IN_A_DAY
                );
                Yii::$app->commandBus->handle(new SendEmailCommand([
                    'subject' => Yii::t('frontend', 'อีเมลเปิดใช้งาน'),
                    'view' => 'activation',
                    'to' => $this->email,
                    'params' => [
                        'url' => Url::to(['/user/sign-in/activation', 'token' => $token->token], true)
                    ]
                ]));
            }
            return $user;
        }

        return null;
    }

    /**
     * @return bool
     */
    public function shouldBeActivated()
    {
        /** @var Module $userModule */
        $userModule = Yii::$app->getModule('user');
        if (!$userModule) {
            return false;
        } elseif ($userModule->shouldBeActivated) {
            return true;
        } else {
            return false;
        }
    }
}
