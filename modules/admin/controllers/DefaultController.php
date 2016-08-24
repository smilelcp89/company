<?php

namespace app\modules\admin\controllers;

use app\components\Common;
use Yii;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends BaseController
{
    public function init()
    {
        parent::init();
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionMain()
    {
        return $this->render('main');
    }

    /*后台首页*/
    public function actionIndex()
    {
        $this->layout = false;
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

    /**
     * 静态化首页
     */
    public function actionCreatehomepage()
    {
        $url = Yii::$app->params['domain'] . 'index/index';
        echo Common::httpGet("http://ticket-local.yaochufa.com/admin/public/login");
    }

}
