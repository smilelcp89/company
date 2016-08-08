<?php

namespace app\modules\admin\controllers;

use app\components\Common;
use app\models\Product;
use Yii;
use yii\data\Pagination;
use yii\helpers\Html;

/**
 * 产品控制器
 */
class ProductController extends BaseController
{

    public function init()
    {
        parent::init();
    }

    /*
     * 产品列表
     */
    public function actionIndex()
    {
        $username = trim(Html::encode($this->requests->get('username')));
        $email    = trim(Html::encode($this->requests->get('email')));
        $mobile   = trim(Html::encode($this->requests->get('mobile')));
        $status   = intval($this->requests->get('status', 0));

        $pageSize = 10;
        $query    = Product::find();
        $query->where(['=', 'is_delete', 0]);
        if ($username) {
            $query->andWhere(['like', 'username', $username]);
        }
        if ($email) {
            $query->andWhere(['=', 'email', $email]);
        }
        if ($mobile) {
            $query->andWhere(['=', 'mobile', $mobile]);
        }
        if ($status) {
            $query->andWhere(['=', 'status', $status]);
        }
        //分页
        $pagination = new Pagination([
            'defaultPageSize' => $pageSize,
            'totalCount'      => $query->count(),
        ]);
        $data = $query->select('id,username,mobile,email,status,last_login_ip,last_login_time')
            ->orderBy('id desc')
            ->limit($pagination->limit)
            ->offset($pagination->offset)
            ->asArray()
            ->all();
        return $this->render('index', [
            'data'       => $data,
            'pagination' => $pagination,
            'pageIndex'  => $pagination->getPage() + 1,
            'pageSize'   => $pageSize,
            'params'     => Yii::$app->request->get(),
        ]);
    }

    /*
     * 添加产品
     */
    public function actionCreate()
    {
        $model = new Product();
        if ($this->isPost) {
            $model->scenario   = 'create';
            $model->attributes = $this->requests->post('Product');
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
     * 更新产品
     */
    public function actionEdit()
    {
        $userId = (int) $this->requests->get('id');
        if ($userId <= 0) {
            Common::message('', '无效产品ID');
        }
        $model = new Product();
        if ($this->isPost) {
            $form = $this->requests->post('Product');
            $user = $model->findOne(['id' => $userId]);
            if (!empty($form['password'])) {
                $user->password = $form['password'];
            }
            $user->email    = $form['email'];
            $user->mobile   = $form['mobile'];
            $user->status   = $form['status'];
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
            $data = $model->findOne(['id' => $userId]);
            if (empty($data)) {
                Common::message('error', '产品不存在');
            }
            return $this->render('edit', ['data' => $data, 'model' => $model]);
        }
    }

    /*
     * 删除产品
     */
    public function actionDelete()
    {
        $userIds = $this->requests->post('ids');
        if (empty($userIds)) {
            Common::echoJson(1001, '无效参数');
        }
        //更新的数据
        $data = ['is_delete' => 1, 'status' => Product::FORBIDDEN_STATUS];
        if (Product::updateAll($data, 'id in (' . $userIds . ')') != false) {
            Common::echoJson(1000, '删除成功');
        } else {
            Common::echoJson(1002, '删除失败');
        }
    }

    /*
     * 改变产品状态
     */
    public function actionChangestatus()
    {
        $userIds = $this->requests->post('ids');
        $status  = (int) $this->requests->post('status');
        if (empty($userIds) || !in_array($status, [Product::FORBIDDEN_STATUS, Product::NORMAL_STATUS])) {
            Common::echoJson(1001, '无效参数');
        }
        //更新的数据
        $data = ['status' => $status];
        if (Product::updateAll($data, 'id in (' . $userIds . ')') != false) {
            Common::echoJson(1000, '操作成功');
        } else {
            Common::echoJson(1002, '操作失败');
        }
    }
}
