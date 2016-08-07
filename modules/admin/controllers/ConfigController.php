<?php

namespace app\modules\admin\controllers;

use app\components\Common;
use app\models\Config;
use Yii;
use yii\helpers\Html;
use yii\data\Pagination;

/**
 * 网站配置控制器
 */
class ConfigController extends BaseController
{

    public function init()
    {
        parent::init();
    }

    public function actionIndex()
    {
        $intro = trim(Html::encode($this->requests->get('intro')));
        $flag = trim(Html::encode($this->requests->get('flag')));

        $pageSize = 10;
        $query = Config::find();
        if($intro){
            $query->andWhere(['like','intro',$intro]);
        }
        if($flag){
            $query->andWhere(['like','intro',$flag]);
        }
        //分页
        $pagination = new Pagination([
            'defaultPageSize' => $pageSize,
            'totalCount' => $query->count(),
        ]);
        $data = $query->select('*')
            ->orderBy('id desc')
            ->limit($pagination->limit)
            ->offset($pagination->offset)
            ->asArray()
            ->all();
        return $this->render('index', [
            'data' => $data,
            'pagination' => $pagination,
            'pageIndex' => $pagination->getPage() + 1,
            'pageSize' => $pageSize,
            'params' => Yii::$app->request->get()
        ]);
    }

    public function actionCreate()
    {
        $model = new Config();
        if ($this->isPost) {
            $model->scenario = 'create';
            $model->attributes = $this->requests->post('Config');
            //Common::dump($this->requests->post('Config'));die;
            if ($model->validate()) {
                if ($model->save()) {
                    Common::message('success', '保存成功');
                } else {
                    Common::message('error', '保存失败');
                }
            } else {
                return $this->render('edit', ['model' => $model]);
            }
        } else {
            return $this->render('edit', ['model' => $model]);
        }
    }

    /*
      * 更新用户
      */
    public function actionEdit()
    {
        $configId = (int)$this->requests->get('id');
        if ($configId <= 0) {
            Common::message('', '无效配置ID');
        }
        $model = new Config();
        if ($this->isPost) {
            $form = $this->requests->post('Config');
            $config = $model->findOne(['id' => $configId]);
            $config->content = $form['content'];
            $config->intro = $form['intro'];
            $config->scenario = 'update';
            if ($config->validate()) {
                if ($config->save()) {
                    Common::message('success', '修改成功');
                } else {
                    Common::message('error', '修改失败');
                }
            } else {
                return $this->render('edit', ['model' => $config]);
            }
        } else {
            $data = $model->findOne(['id' => $configId]);
            if (empty($data)) {
                Common::message('error', '配置不存在');
            }
            return $this->render('edit', ['data' => $data, 'model' => $model]);
        }
    }
}
