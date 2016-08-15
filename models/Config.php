<?php

namespace app\models;

use app\components\Common;
use Yii;

/**
 * This is the model class for table "{{%config}}".
 *
 * @property integer $id
 * @property string $flag
 * @property string $content
 * @property string $intro
 * @property string $create_user
 * @property string $create_time
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['flag', 'required','on'=>'create','message' => '标识符不能为空'],
            ['flag', 'unique','on'=>'create','message' => '该标识符已存在'],
            ['flag', 'string', 'max' => 64, 'tooLong' => '标识符不能超过64个字符'],
            ['content', 'required','on'=>['create','update'],'message' => '配置内容不能为空'],
            ['intro', 'string', 'max' => 255, 'tooLong' => '配置描述不能超过255个字符'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'flag' => 'Flag',
            'content' => 'Content',
            'intro' => 'Intro',
            'is_delete' => 'Is Delete',
            'create_user' => 'Create User',
            'create_time' => 'Create Time',
        ];
    }

    public function scenarios()
    {
        return [
            'create' => ['flag', 'content','intro'],
            'update' => ['content'],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord) {
                $this->create_time = time();
                $this->create_user = Common::getLoginUserInfo('username');
            }
            return true;
        } else {
            return false;
        }
    }
}
