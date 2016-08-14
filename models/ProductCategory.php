<?php

namespace app\models;

use app\components\Common;
use Yii;

/**
 * This is the model class for table "{{%product_category}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $pid
 * @property string $path
 * @property integer $is_delete
 * @property string $create_user
 * @property string $create_time
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['title', 'required','message' => '必须填写'],
            ['title', 'unique','message' => '该分类名已经存在'],
            ['title', 'string', 'max' => 255,'message' => '输入不能超过255个字符'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'pid' => 'Pid',
            'path' => 'Path',
            'is_delete' => 'Is Delete',
            'create_user' => 'Create User',
            'create_time' => 'Create Time',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord) {
                $this->path = $this->id.'-';
                $this->create_user = Common::getLoginUserInfo('username');
                $this->create_time = time();
            }
            return true;
        } else {
            return false;
        }
    }
}
