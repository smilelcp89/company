<?php

namespace app\models;

use app\components\Common;
use Yii;

/**
 * This is the model class for table "{{%ad}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $logo
 * @property string $url
 * @property integer $sort
 * @property integer $status
 * @property integer $is_del
 * @property string $create_user
 * @property integer $create_time
 */
class Ad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ad}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url'], 'required', 'message' => '必须填写'],
            [['title'], 'string', 'max' => 50, 'message' => '不能超过50个字符长度'],
            [['logo'], 'string', 'max' => 200, 'message' => '不能超过200个字符长度'],
            [['logo'], 'required', 'message' => '必须要有广告图片'],
            [['url'], 'string', 'max' => 300, 'message' => '不能超过300个字符长度'],
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
            'logo'        => 'Logo',
            'url'         => 'Url',
            'sort'        => 'Sort',
            'status'      => 'Status',
            'is_delete'   => 'Is Delete',
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
