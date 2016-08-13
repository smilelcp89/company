<?php

namespace app\modules\admin\controllers;

use app\components\Common;
use app\models\User;
use yii\data\Pagination;
use Yii;
use yii\helpers\Html;

/**
 * 用户控制器
 */
class UserController extends BaseController
{

    public function init()
    {
        parent::init();
    }

    /*
     * 用户列表
     */
    public function actionIndex()
    {
        $username = trim(Html::encode($this->requests->get('username')));
        $email = trim(Html::encode($this->requests->get('email')));
        $mobile = trim(Html::encode($this->requests->get('mobile')));
        $status = intval($this->requests->get('status',0));

        $pageSize = 10;
        $query = User::find();
        $query->where(['=','is_delete',0]);
        if($username){
            $query->andWhere(['like','username',$username]);
        }
        if($email){
            $query->andWhere(['=','email',$email]);
        }
        if($mobile){
            $query->andWhere(['=','mobile',$mobile]);
        }
        if($status){
            $query->andWhere(['=','status',$status]);
        }
        //分页
        $pagination = new Pagination([
            'defaultPageSize' => $pageSize,
            'totalCount' => $query->count(),
        ]);
        $data = $query->select('id,username,mobile,email,status,last_login_ip,last_login_time')
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

    /*
     * 添加用户
     */
    public function actionCreate()
    {
        $model = new User();
        if ($this->isPost) {
            $model->scenario = 'create';
            $model->attributes = $this->requests->post('User');
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
        $userId = (int)$this->requests->get('id');
        if($userId <= 0){
            Common::message('', '无效用户ID');
        }
        $model = new User();
        if ($this->isPost) {
            $form = $this->requests->post('User');
            $user = $model->findOne(['id' => $userId ]);
          if(!empty($form['password'])){
                $user->password = $form['password'];
            }
            $user->email = $form['email'];
            $user->mobile = $form['mobile'];
            $user->status = $form['status'];
            $user->scenario = 'update';
            if ($user->validate()) {
                if ($user->save()) {
                    Common::message('success', '修改成功');
                } else {
                    Common::message('error', '修改失败');
                }
            } else {
                return $this->render('edit', ['model' => $user]);
            }
        } else {
            $data = $model->findOne(['id' => $userId ]);
            if(empty($data) || $data['is_delete'] == 1){
                Common::message('error', '用户不存在');
            }
            return $this->render('edit', ['data' => $data,'model' => $model]);
        }
    }

    /*
     * 删除用户
     */
    public function actionDelete()
    {
        $userIds = $this->requests->post('ids');
        if(empty($userIds)){
            Common::echoJson(1001,'无效参数');
        }
        //更新的数据
        $data = [ 'is_delete' => 1, 'status' => User::FORBIDDEN_STATUS ];
        if (User::updateAll($data,'id in ('.$userIds.')') !== false) {
            Common::echoJson(1000,'删除成功');
        } else {
            Common::echoJson(1002,'删除失败');
        }
    }

    /*
     * 改变用户状态
     */
    public function actionChangestatus()
    {
        $userIds = $this->requests->post('ids');
        $status = (int)$this->requests->post('status');
        if(empty($userIds) || !in_array($status,[User::FORBIDDEN_STATUS,User::NORMAL_STATUS])){
            Common::echoJson(1001,'无效参数');
        }
        //更新的数据
        $data = [ 'status' => $status ];
        if (User::updateAll($data,'id in ('.$userIds.')') !== false) {
            Common::echoJson(1000,'操作成功');
        } else {
            Common::echoJson(1002,'操作失败');
        }
    }
}
