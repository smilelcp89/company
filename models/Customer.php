<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%customer}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $qq
 * @property integer $status
 * @property string $create_user
 * @property string $create_time
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'create_time'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['qq'], 'string', 'max' => 16],
            [['create_user'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'qq' => 'Qq',
            'status' => 'Status',
            'create_user' => 'Create User',
            'create_time' => 'Create Time',
        ];
    }
}
