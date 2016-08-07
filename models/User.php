<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    //用户状态
    const NORMAL_STATUS = 1; //正常
    const FORBIDDEN_STATUS = 2; //禁用

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
            ['username', 'required', 'message' => '用户名必须填写','on' => 'create'],
            ['password', 'required', 'message' => '密码必须填写','on' => 'create'],
            ['username', 'string', 'min' => 6, 'max' => 20, 'tooLong' => '用户名请输入长度为6-20个字符', 'tooShort' => '用户名请输入长度为6-20个字符','on' => 'create'],
            ['username', 'unique', 'message' => '用户名已存在','on' => 'create'],
            ['email', 'email', 'message' => '邮箱格式错误'],
            ['mobile', 'match', 'pattern' => '/^1\d{10}$/', 'message' => '手机号码格式错误'],
            ['mobile', 'unique', 'message' => '手机号码已存在'],
            ['status', 'in', 'range' => [1, 2], 'message' => '状态值错误'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password' => '密码',
            'mobile' => '手机号码',
            'email' => '邮箱',
            'status' => '用户状态',
            'is_delete' => '是否删除',
            'last_login_time' => '最后登录时间',
            'last_login_ip' => '最后登录IP',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
        ];
    }

    public function scenarios()
    {
        return [
            'create' => ['username', 'password'],
            'update' => [],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $now = time();
            if($this->isNewRecord) {
                $this->password = md5($this->password);
                $this->create_time = $now;
            } else {
                if(!empty($this->password)){
                    $this->password = md5($this->password);
                }
            }
            $this->update_time = $now;
            return true;
        } else {
            return false;
        }
    }
}
