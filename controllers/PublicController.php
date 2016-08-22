<?php

namespace app\controllers;

use app\components\Common;
use app\models\Guestbook;
use app\models\GuestbookForm;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class PublicController extends FrontBaseController
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class'     => 'yii\captcha\CaptchaAction',
                'maxLength' => 4,
                'minLength' => 4,
                'width'     => 100,
                'height'    => 50,
            ],
        ];
    }

    /**
     * 关于我们
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * 联系我们
     */
    public function actionContact()
    {
        return $this->render('contact');
    }

    /**
     * 在线留言
     */
    public function actionGuestbook()
    {
        $model = new GuestbookForm();
        if (Yii::$app->request->isPost) {
            $model->attributes = Yii::$app->request->post('GuestbookForm');
            if ($model->validate()) {
                $data['username']      = Html::encode($model->attributes['username']);
                $data['title']         = Html::encode($model->attributes['title']);
                $data['content']       = Html::encode($model->attributes['content']);
                $data['mobile']        = Html::encode($model->attributes['mobile']);
                $data['email']         = Html::encode($model->attributes['email']);
                $data['create_time']   = time();
                $guestbook             = new Guestbook();
                $guestbook->attributes = $data;
                if ($guestbook->save()) {
                    Common::message('success', '提交留言成功', Url::to(['public/guestbook']));
                } else {
                    Common::message('error', '提交留言失败');
                }
            } else {
                return $this->render('guestbook', ['model' => $model]);
            }
        } else {
            return $this->render('guestbook', ['model' => $model]);
        }
    }

    /**
     * 错误404
     */
    public function actionError()
    {
        $this->layout = false;
        return $this->render('error');
    }
}
