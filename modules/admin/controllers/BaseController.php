<?php

namespace app\modules\admin\controllers;

use app\constants\Code;
use app\constants\Session as SessionConst;
//use app\filters\AclFilter;
use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
    public $layout = 'backend';
    protected $requests;
    protected $isAjax;
    protected $isPost;
    protected $cache;
    protected $session;
    protected $cookies;
    protected $loginUserName;
    protected $loginUserId;
    protected $loginUserStatus;
    protected $loginUserInfo;

    public function init()
    {
        $loginUserInfo = Yii::$app->session->get(SessionConst::LOGIN_USER_INFO);
        //判断用户是否登录
        if (empty($loginUserInfo)) {
            //根据是否为ajax，返回错误提示信息
            if (Yii::$app->request->isAjax) {
                die(json_encode([
                    'code'    => Code::NOT_LOGINED,
                    'message' => Code::$messages[Code::NOT_LOGINED],
                ]));
            } else {
                $this->redirect('public/login');
            }
        }
        $this->loginUserInfo = $loginUserInfo;
        $this->initVars();
        parent::init();
    }

    //简化变量
    private function initVars()
    {
        $this->requests        = Yii::$app->request;
        $this->isAjax          = Yii::$app->request->isAjax;
        $this->isPost          = Yii::$app->request->isPost;
        $this->cache           = Yii::$app->cache;
        $this->session         = Yii::$app->session;
        $this->cookies         = Yii::$app->request->cookies;
        $this->loginUserId     = $this->loginUserInfo['id'];
        $this->loginUserName   = $this->loginUserInfo['username'];
        $this->loginUserStatus = $this->loginUserInfo['status'];
    }

    /**
     * 行为
     */
    /*
public function behaviors()
{
return [
//访问权限过滤
'access' => [
'class' => AclFilter::className(),
],
];
} */
}
