<?php

namespace app\modules\admin\controllers;

use app\models\LoginForm;
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
        echo '<pre>';
        session_start();
        print_r($_SESSION);die;
        if ($this->isPost) {
            $username = Html::encode($this->requests->post('username', ''));
            $password = Html::encode($this->requests->post('password', ''));
        } else {
            $model = new LoginForm();
            return $this->render('login', ['model' => $model]);
        }
    }
}
