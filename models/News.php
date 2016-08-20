<?php

namespace app\models;

use app\components\Common;
use Yii;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $cate_id
 * @property string $content
 * @property integer $status
 * @property integer $is_recommend
 * @property integer $is_delete
 * @property string $create_user
 * @property integer $create_time
 * @property string $update_user
 * @property integer $update_time
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required', 'message' => '必须填写'],
            [['title'], 'string', 'max' => 255, 'message' => '输入不能超过255个字符'],
            [['status', 'cate_id', 'is_recommend'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => 'ID',
            'title'        => 'Title',
            'cate_id'      => 'Cate ID',
            'content'      => 'Content',
            'status'       => 'Status',
            'is_recommend' => 'Is Recommend',
            'is_delete'    => 'Is Delete',
            'create_user'  => 'Create User',
            'create_time'  => 'Create Time',
            'update_user'  => 'Update User',
            'update_time'  => 'Update Time',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $now = time();
            if ($this->isNewRecord) {
                $this->create_user = Common::getLoginUserInfo('username');
                $this->create_time = $now;
            }
            $this->update_user = Common::getLoginUserInfo('username');
            $this->update_time = $now;
            return true;
        } else {
            return false;
        }
    }
}
