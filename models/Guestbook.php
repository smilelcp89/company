<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%guestbook}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $mobile
 * @property string $email
 * @property string $title
 * @property string $content
 * @property integer $is_read
 * @property integer $is_reply
 * @property integer $create_time
 */
class Guestbook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%guestbook}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['content'], 'string'],
            [['is_read', 'is_reply', 'create_time'], 'integer'],
            [['username'], 'string', 'max' => 255],
            [['mobile'], 'string', 'max' => 16],
            [['email'], 'string', 'max' => 64],
            [['title'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'title' => 'Title',
            'content' => 'Content',
            'is_read' => 'Is Read',
            'is_reply' => 'Is Reply',
            'create_time' => 'Create Time',
        ];
    }
}
