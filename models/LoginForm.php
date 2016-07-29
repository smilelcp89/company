<?php

namespace app\models;

use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['verifyCode', 'required'],
            ['verifyCode', 'captcha', 'captchaAction' => '/admin/public/captcha', 'message' => '验证码错误'],
            // username and password are both required
            [['username', 'password'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {

            if ($this->password != '123456') {
                $this->addError($attribute, '账号或密码错误');
            }
            /*if (!$user || !$user->validatePassword($this->password)) {
        $this->addError($attribute, 'Incorrect username or password.');
        }*/
        }
    }
}
