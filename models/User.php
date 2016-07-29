<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public $username;
    public $password;
    public $mobile;
    public $email;
    public $status;

    /**
     * @return string 返回该AR类关联的数据表名
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['username', 'required', 'message' => '用户名必须填写'],
            ['password', 'required', 'message' => '密码必须填写'],
            ['username', 'string', 'min' => 6, 'max' => 20, 'tooLong' => '用户名请输入长度为6-20个字符', 'tooShort' => '用户名请输入长度为6-20个字符'],
            ['username', 'unique', 'message' => '用户名已存在'],
            ['email', 'email', 'message' => '邮箱格式错误'],
            ['mobile', 'match', 'pattern' => '/^1+d{10}$/', 'message' => '手机号码格式错误'],
            ['mobile', 'unique', 'message' => '手机号码已存在'],
            ['status', 'in', 'range' => [1, 2], 'message' => '状态值错误'],
        ];
    }
}
