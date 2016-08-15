<?php

namespace app\models;

use app\components\Common;
use Yii;

/**
 * This is the model class for table "{{%friendlink}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $logo
 * @property string $url
 * @property integer $status
 * @property integer $is_delete
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
 */
class Friendlink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%friendlink}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'is_delete', 'create_time', 'update_time'], 'integer'],
            [['title', 'logo'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 1024],
            [['create_user', 'update_user'], 'string', 'max' => 64],
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
            'logo' => 'Logo',
            'url' => 'Url',
            'status' => 'Status',
            'is_delete' => 'Is Delete',
            'create_user' => 'Create User',
            'create_time' => 'Create Time',
            'update_user' => 'Update User',
            'update_time' => 'Update Time',
        ];
    }

    public function beforeSave($insert)
    {
        $now = time();
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord) {
                $this->create_user = Common::getLoginUserInfo('username');
                $this->create_time = $now;
            }else{
                $this->update_user = Common::getLoginUserInfo('username');
                $this->update_time = $now;
            }
            return true;
        } else {
            return false;
        }
    }
}
