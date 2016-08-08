<?php

namespace app\modules\admin\controllers;

use app\components\Common;
use yii\web\Controller;

/**
 * UploadController
 */
class UploadController extends Controller
{
    public $layout = false;

    public function init()
    {
        $this->enableCsrfValidation = false;
        parent::init();
    }

    /**
     * 上传图片
     */
    public function actionIndex()
    {
        echo '<pre>';
        print_r($_FILES);
        Common::echoJson(1000, '成功');
    }

}
