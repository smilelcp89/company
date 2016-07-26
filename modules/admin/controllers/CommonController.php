<?php

namespace app\modules\admin\controllers;

/**
 * Default controller for the `admin` module
 */
class CommonController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionTop()
    {
        return $this->render('top');
    }

    public function actionLeft()
    {
        return $this->render('left');
    }

    public function actionError()
    {
        return $this->render('error');
    }
}
