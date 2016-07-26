<?php

namespace app\controllers;

class PublicController extends FrontBaseController
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionContact()
    {
        return $this->render('contact');
    }

    public function actionGuestbook()
    {
        return $this->render('guestbook');
    }

    public function actionError()
    {
        return $this->render('error');
    }
}
