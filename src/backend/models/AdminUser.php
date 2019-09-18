<?php

namespace modules\commerce\backend\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use modules\commerce\common\interfaces\ModelStatus;
use modules\commerce\common\traits\ModelStatusTrait;

/**
 * @property integer $id
 * @property integer $status
 * @property string $login
 * @property string $password
 * @property string $authKey
 * @property string $authKeyExpireAt
 * @property string $loginAt
 * @property string $createdAt
 * @property string $updatedAt
 */
class AdminUser extends \yii\db\ActiveRecord implements ModelStatus, IdentityInterface
{
    use ModelStatusTrait;

	public static function tableName()
	{
		return '{{%admin_users}}';
	}

    /**
     * @return object|\yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public static function find()
    {
        return Yii::createObject(AdminUserQuery::class, [get_called_class()]);
    }

    /**
     * @param int|string $id
     * @return AdminUser|IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return static::findOne([
            'id' => $id,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * @param mixed $token
     * @param null $type
     * @return AdminUser|null
     * @throws \yii\base\InvalidConfigException
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        return static::find()
            ->where([
                'AND',
                ['status' => self::STATUS_ACTIVE],
                ['authKey' => $token],
                ['>=', 'authKeyExpireAt', new Expression("NOW()")]
            ])
            ->one();
    }

    public function rules()
    {
        return [
            ['status', 'in', 'range' => $this->statusesOptions()],

            ['login', 'filter', 'filter' => 'trim'],
            ['login', 'string', 'max' => 255],
            ['login', 'unique'],

            ['password', 'string', 'max' => 255],

            ['authKey', 'string', 'max' => 255],
            ['authKeyExpireAt', 'safe'],

            ['loginAt', 'safe'],

            [['createdAt', 'updatedAt'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(),  [
            'Timestamp' => [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
            ]
        ]);
    }

    /**
     * @return int|mixed|string
     */
	public function getId()
	{
		return $this->getPrimaryKey();
	}

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @param int $day
     * @throws \yii\base\Exception
     */
    public function generateAuthKey(int $day = 30)
    {
        $this->authKey = Yii::$app->security->generateRandomString();
        $this->authKeyExpireAt = new Expression("NOW() + INTERVAL $day DAY");
    }

    public function releaseAuthKey()
    {
        $this->authKey = null;
        $this->authKeyExpireAt = null;
    }

    /**
     * Generates password hash from password and sets it to the model
     * @param string $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Validates password
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setLoginAt()
    {
        $this->loginAt = new Expression("NOW()");
    }
}
