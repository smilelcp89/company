<?php

namespace app\modules\admin\controllers;

use app\models\LoginForm;
use Yii;
use yii\helpers\Html;

/**
 * Public controller for the `admin` module
 */
class PublicController extends BaseController
{
    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class'     => 'yii\captcha\CaptchaAction',
                'maxLength' => 5,
                'minLength' => 5,
                'width'     => 100,
                'height'    => 50,
            ],
        ];
    }

    /**
     * 登录
     */
    public function actionLogin()
    {
        if ($this->isPost) {
            $username   = Html::encode($this->requests->post('username', ''));
            $password   = Html::encode($this->requests->post('password', ''));
            $verifyCode = Html::encode($this->requests->post('verifyCode', ''));
            if (empty($username) || empty($password)) {
                echo 'error';die;
            }
            //校验数据
            $model             = new LoginForm();
            $model->username   = $username;
            $model->password   = $password;
            $model->verifyCode = $verifyCode;
            if (!$model->validate()) {
                foreach ($model->errors as $error) {
                    Yii::$app->getSession()->setFlash('error', $error[0]);
                    return $this->render('tips');
                }
                //echo '<pre>';print_r($model->errors);die;
            } else {
                echo 'success';
            }

        } else {
            return $this->render('login');
        }
    }

    /**
     * 信息提示页
     */
    public function actionMsg()
    {
        \app\components\Common::message('success', '注册成功');
        //return $this->render('msg', ['url' => 'http://company.local.com/', 'content' => '恭喜您注册成功！']);
    }

}
