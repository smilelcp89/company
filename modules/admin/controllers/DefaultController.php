<?php

namespace app\modules\admin\controllers;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionMain()
    {
        return $this->render('main');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRight()
    {
        return $this->render('right');
    }
}
