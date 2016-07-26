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

    public function actionList()
    {
        return $this->render('list');
    }

    public function actionList2()
    {
        return $this->render('list2');
    }

    public function actionEdit()
    {
        return $this->render('edit');
    }

    public function actionTab()
    {
        return $this->render('tab');
    }
}
