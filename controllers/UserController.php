<?php

namespace app\controllers;

class UserController extends BaseController
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        echo 'index';
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionCreate()
    {
        echo 'create';
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionUpdate()
    {
        echo 'Update';
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionDelete()
    {
        echo 'Delete';
    }
}
