<?php

namespace app\controllers;

use app\controllers\FrontBaseController;

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
        //$this->layout = false;
        //echo file_get_contents('http://yii2-local.yaochufa.com/site/about');die;
        return $this->render('index');
    }

}
