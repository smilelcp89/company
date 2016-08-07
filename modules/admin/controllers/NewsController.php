<?php

namespace app\modules\admin\controllers;

use app\models\News;
use Yii;
use yii\helpers\Html;
use yii\data\Pagination;

/**
 * 新闻控制器
 */
class NewsController extends BaseController
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
        $query = News::find();
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
        ]);
    }

    public function actionCreate()
    {
        $model = new News();
        if ($this->isPost) {
            $model->attributes = $this->requests->post('News');

            if ($model->validate()) {
                echo 'okok';
            } else {
                return $this->render('edit', ['model' => $model]);
            }
        } else {
            return $this->render('edit', ['model' => $model]);
        }
    }

    public function actionUpdate()
    {
        $model = new News();
        return $this->render('edit', ['model' => $model]);
    }
}
