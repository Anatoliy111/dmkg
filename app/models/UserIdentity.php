<?php
namespace app\models;

use app\models\UtKart;
use Yii;
use yii\easyii\models\Setting;
use yii\web\IdentityInterface;

class UserIdentity extends UtKart implements IdentityInterface
{
//    static $rootUser = [
//        'admin_id' => 0,
//        'username' => 'root',
//        'password' => '',
//        'auth_key' => '',
//        'access_token' => ''
//    ];
//
//
//
//    public function rules()
//    {
//        return [
//            ['username', 'required'],
//            ['username', 'unique'],
//            ['password', 'required', 'on' => 'create'],
//            ['password', 'safe'],
//            ['access_token', 'default', 'value' => null]
//        ];
//    }
//
//    public function attributeLabels()
//    {
//        return [
//            'username' => Yii::t('easyii', 'Username'),
//            'password' => Yii::t('easyii', 'Password'),
//        ];
//    }

//    public function beforeSave($insert)
//    {
//        if (parent::beforeSave($insert)) {
//            if ($this->isNewRecord) {
//                $this->auth_key = $this->generateAuthKey();
//                $this->pass = $this->hashPassword($this->pass);
//            } else {
//                $this->pass = $this->pass != '' ? $this->hashPassword($this->password) : $this->oldAttributes['password'];
//            }
//            return true;
//        } else {
//            return false;
//        }
//    }

    public static function findIdentity($id)
    {
		return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByUsername($username)
    {
        if ($username === self::$rootUser['username']) {
            return static::createRootUser();
        }
        return static::findOne(['username' => $username]);
    }

	public static function findByModels($username)
	{
		if ($username === self::$rootUser['username']) {
			return static::createRootUser();
		}
		return static::findOne(['username' => $username]);
	}

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return $this->password === $this->hashPassword($password);
    }

    private function hashPassword($password)
    {
        return sha1($password . $this->getAuthKey() . Setting::get('password_salt'));
    }

    private function generateAuthKey()
    {
        return Yii::$app->security->generateRandomString();
    }

//    public static function createRootUser()
//    {
//        return new static(array_merge(self::$rootUser, [
//            'password' => Setting::get('root_password'),
//            'auth_key' => Setting::get('root_auth_key')
//        ]));
//    }

//    public function isRoot()
//    {
//        return $this->username === self::$rootUser['username'];
//    }
}
