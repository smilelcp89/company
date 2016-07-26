<?php

namespace app\controllers;

class NewsController extends FrontBaseController
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //echo Url::to(['product/detail', 'id' => 123]);die;
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionDetail()
    {
        //echo \Yii::$app->request->get('id');die;
        return $this->render('detail');
    }
}
