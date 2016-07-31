<?php

namespace app\modules\admin\controllers;

use app\models\User;

/**
 * 友情链接控制器
 */
class FriendlinkController extends BaseController
{

    public function init()
    {
        parent::init();
    }

    public function actionIndex()
    {
        return $this->render('index');
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
