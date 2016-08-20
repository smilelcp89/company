<?php

namespace app\modules\admin\controllers;

use app\components\Common;
use app\models\Guestbook;
use Yii;
use yii\data\Pagination;
use yii\helpers\Html;

/**
 * 留言控制器
 */
class GuestbookController extends BaseController
{

    public function init()
    {
        parent::init();
    }

    /**
     * 列表
     */
    public function actionIndex()
    {
        $title   = trim(Html::encode($this->requests->get('title')));
        $isRead  = (int) $this->requests->get('isRead');
        $isReply = (int) $this->requests->get('isReply');

        $pageSize = 10;
        $query    = Guestbook::find();
        if ($title) {
            $query->andWhere(['like', 'title', $title]);
        }

        if ($isRead) {
            $query->andWhere(['=', 'is_read', $isRead]);
        }

        if ($isReply) {
            $query->andWhere(['=', 'is_reply', $isReply]);
        }
        //分页
        $pagination = new Pagination([
            'defaultPageSize' => $pageSize,
            'totalCount'      => $query->count(),
        ]);
        $data = $query->select('id,username,mobile,email,title,content,is_read,is_reply,create_time')
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
     * 添加产品分类
     */
    public function actionCreate()
    {
        $model = new Guestbook();
        if ($this->isPost) {
            $model->attributes = $this->requests->post('Guestbook');
            if ($model->validate()) {
                if ($model->save()) {
                    Common::message('success', '保存成功', '/admin/guestbook/index');
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
     * 更新产品分类
     */
    public function actionEdit()
    {
        $id = (int) $this->requests->get('id');
        if ($id <= 0) {
            Common::message('', '无效产品分类ID');
        }
        $model = new Guestbook();
        if ($this->isPost) {
            $form                  = $this->requests->post('Guestbook');
            $guestbook             = $model->findOne(['id' => $id]);
            $guestbook->attributes = $form;
            if ($guestbook->validate()) {
                if ($guestbook->save()) {
                    Common::message('success', '修改成功', '/admin/guestbook/index');
                } else {
                    Common::message('error', '修改失败');
                }
            } else {
                return $this->render('edit', ['model' => $guestbook]);
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
     * 删除产品
     */
    public function actionDelete()
    {
        $ids = $this->requests->post('ids');
        if (empty($ids)) {
            Common::echoJson(1001, '无效参数');
        }
        //更新的数据
        $data = ['is_delete' => 1];
        if (Guestbook::updateAll($data, 'id in (' . $ids . ')') !== false) {
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
        $ids  = $this->requests->post('ids');
        $type = $this->requests->post('type');
        if (empty($ids) || !in_array($type, ['read', 'reply'])) {
            Common::echoJson(1001, '无效参数');
        }
        $fields = [
            'read'  => 'is_read',
            'reply' => 'is_reply',
        ];
        //更新的数据
        $data = [$fields[$type] => 2];
        if (Guestbook::updateAll($data, 'id in (' . $ids . ')') !== false) {
            Common::echoJson(1000, '操作成功');
        } else {
            Common::echoJson(1002, '操作失败');
        }
    }
}
