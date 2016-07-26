<?php

namespace app\controllers;

class IndexController extends FrontBaseController
{

    public function init()
    {
        parent::init();
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

}
