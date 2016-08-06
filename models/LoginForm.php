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
    public $loginUserInfo;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['verifyCode', 'required'],
            ['verifyCode', 'captcha', 'captchaAction' => '/admin/public/captcha', 'message' => '验证码错误'],
            // username and password are both required
            [['username', 'password'], 'required','message' => '用户名或密码不能为空'],
            ['username', 'validateUser'],
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
            if (md5($this->password) != $this->loginUserInfo['password']) {
                $this->addError($attribute, '用户名或密码错误');
            }
        }
    }

    /**
     * Validates the user is exists.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateUser($attribute, $params)
    {
        if (!$this->hasErrors()) {

            $userInfo = \app\models\User::find(['username' => $this->username])->select('id,username,password,email,mobile,status')->asArray()->one();
            if (empty($userInfo)) {
                $this->addError($attribute, '用户名不存在');
            }else if($userInfo['status'] == '2'){
                $this->addError($attribute, '该用户已被禁用');
            }else{
                $this->loginUserInfo = $userInfo;
            }
        }
    }
    
}
