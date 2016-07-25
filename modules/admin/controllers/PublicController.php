<?php

namespace app\modules\admin\controllers;

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
     * 登录
     */
    public function actionLogin()
    {
        //echo \Yii::$app->params['domain'];die;
        return $this->render('login');
    }
}
