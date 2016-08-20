<?php

namespace app\models;

use app\components\Common;
use Yii;

/**
 * This is the model class for table "{{%news_category}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $pid
 * @property string $path
 * @property string $create_user
 * @property integer $create_time
 */
class NewsCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['title', 'required', 'message' => '必须填写'],
            ['title', 'unique', 'message' => '该分类名已经存在'],
            ['title', 'string', 'max' => 255, 'message' => '输入不能超过255个字符'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'title'       => 'Title',
            'pid'         => 'Pid',
            'path'        => 'Path',
            'create_user' => 'Create User',
            'create_time' => 'Create Time',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->create_user = Common::getLoginUserInfo('username');
                $this->create_time = time();
            }
            return true;
        } else {
            return false;
        }
    }
}
