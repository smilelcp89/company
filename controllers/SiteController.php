<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\LoginForm;
use app\models\RoleAcl;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

//use yii\web\Controller;

class SiteController extends BaseController
{

    //public $layout = false;
    public function actionSet()
    {
        if (Yii::$app->request->isPost) {
            $roleId  = (int) Yii::$app->request->post('role_id', 0);
            $roleAcl = new RoleAcl();
            $aclArr  = Yii::$app->request->post('acl');
            $params  = [];
            $now     = time();
            if ($aclArr) {
                foreach ($aclArr as $key => $acl) {
                    $params[] = ['role_id' => 1, 'acl' => $key, 'desc' => $acl, 'create_name' => 'liang', 'create_time' => $now];
                }
            }
            //开启事务处理
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($roleId) {
                    //更新
                    if ($roleAcl->updateAcl($params)) {
                        echo 'okok';
                    } else {
                        $transaction->rollBack();
                        echo 'error';exit;
                    }

                } else {
                    //添加
                    if ($roleAcl->addAcl($params)) {
                        echo 'okok';
                    } else {
                        $transaction->rollBack();
                        echo 'error';exit;
                    }
                }
                $transaction->commit();

            } catch (Exception $e) {

                $transaction->rollBack();
                echo $e->getMessage();
            }

        } else {
            return $this->render('set');
        }
    }

    /**
     * @inheritdoc
     */
    public function actionAcl()
    {
        $res = (new \yii\db\Query())
            ->select('r.id as role_id,r.name as role_name,ra.acl,ra.desc')
            ->from('yii_user u')
            ->innerJoin('yii_user_role ur', 'u.id=ur.user_id')
            ->innerJoin('yii_role r', 'r.id=ur.role_id')
            ->innerJoin('yii_role_acl ra', 'ra.role_id=r.id')
            ->where('r.is_del=0 AND r.status=1 AND ur.is_del=0 AND ra.is_active=1 AND u.id=1')
            ->all();

        if ($res) {
            $aclArr = [];
            foreach ($res as $row) {
                $aclArr[] = $row['acl'];
            }
            Yii::$app->session->set(\app\constants\Session::USER_ACL, implode('|', array_unique($aclArr)));
        }
        echo 'okok';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //$this->layout = false;
        //echo file_get_contents('http://yii2-local.yaochufa.com/site/about');die;
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        echo '<pre>';
        print_r($_SERVER);die;
        return $this->render('about');
    }

}
