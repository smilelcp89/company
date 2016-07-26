<?php

namespace app\controllers;

class ProductController extends FrontBaseController
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionDetail()
    {
        return $this->render('detail');
    }
}
