<?php

namespace app\modules\admin\controllers;

use app\components\Common;
use Yii;
use yii\base\Exception;
use yii\imagine\Image;
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
        $type = Yii::$app->request->get('type', 'product');
        if (!in_array($type, ['ad', 'product'])) {
            Common::echoJson(1001, '参数type类型值不正确');
        }
        if ($_FILES['imgFile']['error'] > 0) {
            Common::echoJson(1002, '上传的图片无效');
        }
        $file          = $_FILES['imgFile']['tmp_name'];
        $fileSize      = filesize($file) / 1024 / 1024;
        $postMaxSize   = ini_get('post_max_size');
        $uploadMaxSize = ini_get('upload_max_filesize');
        $maxSize       = $postMaxSize > $uploadMaxSize ? $postMaxSize : $uploadMaxSize;
        if ($fileSize > $maxSize) {
            Common::echoJson(1003, '上传图片不能超过' . $fileSize . 'M');
        }
        try {
            $subDir       = $type . DIRECTORY_SEPARATOR . date('Ym') . DIRECTORY_SEPARATOR;
            $domainPrefix = Yii::$app->params['imgHost'] . 'uploads' . DIRECTORY_SEPARATOR . $subDir;
            $dir          = UPLOAD_PATH . $subDir;
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            $ext      = substr($_FILES['imgFile']['name'], strrpos($_FILES['imgFile']['name'], '.'));
            $fileName = uniqid() . rand(10000, 99999);
            //上传图片需要缩略的大小
            $thumbArr = [
                'ad'      => [
                    ['width' => '900', 'height' => '300', 'size' => 'big'],
                    ['width' => '384', 'height' => '120', 'size' => 'middle'],
                    ['width' => '192', 'height' => '60', 'size' => 'small'],
                ],
                'product' => [
                    ['width' => '400', 'height' => '400', 'size' => 'big'],
                    ['width' => '250', 'height' => '250', 'size' => 'middle'],
                    ['width' => '80', 'height' => '80', 'size' => 'small'],
                ],
            ];
            if ($thumbArr[$type]) {
                foreach ($thumbArr[$type] as $arr) {
                    Image::thumbnail($file, $arr['width'], $arr['height'])->save($dir . $fileName . "_" . $arr['size'] . $ext);
                }
            }
            Common::echoJson(1000, '上传成功', ['url' => $domainPrefix . $fileName . "_middle" . $ext]);
        } catch (Exception $e) {
            Common::echoJson(1004, $e->getMessage());
        }
    }

}
