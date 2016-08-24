<?php

namespace app\modules\admin\controllers;

use app\components\Common;
use app\constants\Session as SessionConst;
use app\models\LoginForm;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;

/**
 * Public controller for the `admin` module
 */
class PublicController extends Controller
{
    public $layout = false;

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class'     => 'yii\captcha\CaptchaAction',
                'maxLength' => 4,
                'minLength' => 4,
                'width'     => 100,
                'height'    => 50,
            ],
        ];
    }

    /**
     * 登录
     */
    public function actionLogin()
    {
        if (Yii::$app->request->isPost) {
            $username   = Html::encode(Yii::$app->request->post('username', ''));
            $password   = Html::encode(Yii::$app->request->post('password', ''));
            $verifyCode = Html::encode(Yii::$app->request->post('verifyCode', ''));
            //校验数据
            $loginForm             = new LoginForm();
            $loginForm->username   = $username;
            $loginForm->password   = $password;
            $loginForm->verifyCode = $verifyCode;
            if (!$loginForm->validate()) {
                foreach ($loginForm->errors as $error) {
                    Common::message('error', $error[0]);
                }
            } else {
                //更新登陆的ip地址和时间
                $user       = new \app\models\User();
                $updateData = ['last_login_ip' => Yii::$app->request->userIP, 'last_login_time' => time()];
                $user::updateAll($updateData, ['id' => $loginForm->loginUserInfo['id']]);
                //登陆成功，设置会话信息
                Yii::$app->session->set(SessionConst::LOGIN_USER_INFO, array_merge($loginForm->loginUserInfo, $updateData));
                $this->redirect(['default/index']);
            }

        } else {

            if (Common::isLogin()) {
                $this->redirect(['default/index']);
            }
            return $this->render('login');
        }
    }

    /**
     * 退出登录
     */
    public function actionLogout()
    {
        Yii::$app->session->removeAll();
        $this->redirect('login');
    }

}
