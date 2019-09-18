<?php

namespace modules\commerce\backend\forms;

use yii\base\Model;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use modules\commerce\backend\models\AdminUser;

/**
 * @property string $login
 * @property string $poassword
 *
 * @property $user AdminUser
 */
class LoginForm extends Model
{
    /**
     * @var string
     */
    public $login;

    /**
     * @var string
     */
    public $password;

    /**
     * @var null|AdminUser
     */
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['login', 'filter', 'filter' => 'trim'],
            ['login', 'required'],
            ['login', 'string', 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'max' => 255],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }

    /**
     * @inheritDoc
     */
    public function fields()
    {
        return [
            'login'
        ];
    }

    /**
     * @param $attribute
     * @param $params
     * @return bool
     * @throws InvalidConfigException
     */
    public function validatePassword($attribute, $params)
    {
        $user = $this->getUser();

        if (! $user || ! $user->validatePassword($this->password)) {
            $this->addError($attribute, 'Incorrect username or password.');

            return false;
        }

        return true;
    }

    /**
     * @return bool
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function login()
    {
        if (! $this->validate()) {
            return false;
        }

        $user = $this->getUser();
        $user->generateAuthKey();
        $user->setLoginAt();

        return $user->save();
    }

    /**
     * @return AdminUser|null
     * @throws InvalidConfigException
     */
    public function getUser()
    {
        if (! $this->_user) {
            $this->_user = AdminUser::find()
                ->byLogin($this->login)
                ->one();
        }

        return $this->_user;
    }
}
