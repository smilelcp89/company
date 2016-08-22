<?php

namespace app\models;

use yii\base\Model;

/**
 */
class GuestbookForm extends Model
{
    public $username;
    public $email;
    public $mobile;
    public $title;
    public $content;
    public $password;
    public $verifyCode;
    public $captcha;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['captcha', 'required', 'message' => '验证不能为空'],
            ['captcha', 'captcha', 'captchaAction' => '/public/captcha', 'message' => '验证码错误'],
            ['username', 'required', 'message' => '留言姓名不能为空'],
            ['username', 'string', 'max' => 5, 'message' => '姓名不能超过5个字符长度'],
            ['title', 'required', 'message' => '留言主题不能为空'],
            ['title', 'string', 'max' => 30, 'message' => '留言主题不能超过30个字符长度'],
            ['content', 'required', 'message' => '留言内容不能为空'],
            ['mobile', 'required', 'message' => '手机号码不能为空'],
            ['mobile', 'match', 'pattern' => '/^1\d{10}$/', 'message' => '手机号码格式错误'],
            ['email', 'required', 'message' => '邮箱不能为空'],
            ['email', 'email', 'message' => '邮箱格式错误'],
            ['email', 'string', 'max' => 30, 'message' => '邮箱不能超过30个字符长度'],
        ];
    }

}
