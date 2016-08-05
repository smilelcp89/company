<?php

namespace app\modules\admin\controllers;

use app\models\User;
use yii\data\Pagination;

/**
 * 用户控制器
 */
class UserController extends BaseController
{

    public function init()
    {
        parent::init();
    }

    public function actionIndex()
    {
        $query      = User::find();
        $pagination = new Pagination([
            'defaultPageSize' => 1,
            'totalCount'      => $query->count(),
        ]);
        $data = $query->select(['id', 'username', 'mobile', 'email'])
            ->orderBy('id desc')
            ->limit($pagination->limit)
            ->offset($pagination->offset)
            ->asArray()
            ->all();
        //Common::dump($pagination);die;
        return $this->render('index', [
            'data'       => $data,
            'pagination' => $pagination,
        ]);
    }

    public function actionCreate()
    {
        $model = new User();
        if ($this->isPost) {
            $model->attributes = $this->requests->post('User');

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
        $model = new User();
        return $this->render('edit', ['model' => $model]);
    }
}
