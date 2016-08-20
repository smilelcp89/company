<?php

namespace app\modules\admin\controllers;

use app\components\Common;
use app\models\Ad;
use Yii;
use yii\data\Pagination;
use yii\helpers\Html;

/**
 * 广告控制器
 */
class AdController extends BaseController
{

    public function init()
    {
        parent::init();
    }

    /*
     * 列表
     */
    public function actionIndex()
    {
        $pageSize = 10;
        $query    = Ad::find();
        $query->where(['=', 'is_delete', 0]);
        $title = trim(Html::encode($this->requests->get('title')));
        if ($title) {
            $query->andWhere(['like', 'title', $title]);
        }
        $status = $this->requests->get('status', 0);
        if ($status) {
            $query->andWhere(['=', 'status', $status]);
        }
        //分页
        $pagination = new Pagination([
            'defaultPageSize' => $pageSize,
            'totalCount'      => $query->count(),
        ]);
        $data = $query->select('id,title,logo,url,status,create_user,create_time')
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
     * 添加广告
     */
    public function actionCreate()
    {
        $model = new Ad();
        if ($this->isPost) {
            $model->attributes = $this->requests->post('Ad');
            if (empty($model->attributes['logo'])) {
                Common::message('error', '必须要上传广告图片');
            }
            if ($model->validate()) {
                if ($model->save()) {
                    Common::message('success', '保存成功', '/admin/ad/index');
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
     * 更新广告
     */
    public function actionEdit()
    {
        $id = (int) $this->requests->get('id');
        if ($id <= 0) {
            Common::message('', '无效ID');
        }
        $model = new Ad();
        if ($this->isPost) {
            $form           = $this->requests->post('Ad');
            $ad             = $model->findOne(['id' => $id]);
            $ad->attributes = $form;
            if ($ad->validate()) {
                if ($ad->save()) {
                    Common::message('success', '修改成功', '/admin/ad/index');
                } else {
                    Common::message('error', '修改失败');
                }
            } else {
                return $this->render('edit', ['model' => $ad]);
            }
        } else {
            $data = $model->findOne(['id' => $id]);
            if (empty($data) || $data['is_delete'] == 1) {
                Common::message('error', '记录不存在');
            }
            return $this->render('edit', ['data' => $data, 'model' => $model]);
        }
    }

    /*
     * 删除广告
     */
    public function actionDelete()
    {
        $ids = $this->requests->post('ids');
        if (empty($ids)) {
            Common::echoJson(1001, '无效参数');
        }
        //更新的数据
        $data = ['is_delete' => 1];
        if (Ad::updateAll($data, 'id in (' . $ids . ')') !== false) {
            Common::echoJson(1000, '删除成功');
        } else {
            Common::echoJson(1002, '删除失败');
        }
    }

    /*
     * 改变状态
     */
    public function actionChangestatus()
    {
        $ids    = $this->requests->post('ids');
        $status = (int) $this->requests->post('status');
        if (empty($ids) || !in_array($status, [1, 2])) {
            Common::echoJson(1001, '无效参数');
        }
        //更新的数据
        $data = ['status' => $status];
        if (Ad::updateAll($data, 'id in (' . $ids . ')') !== false) {
            Common::echoJson(1000, '操作成功');
        } else {
            Common::echoJson(1002, '操作失败');
        }
    }
}
