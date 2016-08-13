<?php

namespace app\models;

use app\components\Common;
use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $logo
 * @property string $market_price
 * @property string $sale_price
 * @property integer $cate_id
 * @property string $images_list
 * @property string $intro
 * @property integer $is_recommend
 * @property integer $status
 * @property integer $start_time
 * @property integer $end_time
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_descpition
 * @property string $create_user
 * @property integer $create_time
 * @property string $update_user
 * @property integer $update_time
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','sale_price','intro'], 'required','message' => '必须填写'],
            ['sale_price', 'number','message' => '产品价格必须为数字'],
            [['title', 'logo', 'seo_title', 'seo_keywords', 'seo_descpition'], 'string', 'max' => 255,'message' => '输入不能超过255个字符'],
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
            'market_price' => 'Market Price',
            'sale_price' => 'Sale Price',
            'cate_id' => 'Cate ID',
            'images_list' => 'Images',
            'intro' => 'Intro',
            'is_recommend' => 'Is Recommend',
            'status' => 'Status',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'seo_title' => 'Seo Title',
            'seo_keywords' => 'Seo Keywords',
            'seo_descpition' => 'Seo Descpition',
            'create_user' => 'Create User',
            'create_time' => 'Create Time',
            'update_user' => 'Update User',
            'update_time' => 'Update Time',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $now = time();
            if($this->isNewRecord) {
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
