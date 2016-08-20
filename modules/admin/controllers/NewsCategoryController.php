<?php

namespace app\modules\admin\controllers;

use app\components\Common;
use app\models\NewsCategory;
use Yii;
use yii\data\Pagination;
use yii\helpers\Html;

/**
 * 新闻分类控制器
 */
class NewsCategoryController extends BaseController
{

    public function init()
    {
        parent::init();
    }

    /*
     * 新闻分类列表
     */
    public function actionIndex()
    {
        $title = trim(Html::encode($this->requests->get('title')));

        $pageSize = 10;
        $query    = NewsCategory::find();
        $query->where(['=', 'is_delete', 0]);
        if ($title) {
            $query->andWhere(['like', 'title', $title]);
        }
        //分页
        $pagination = new Pagination([
            'defaultPageSize' => $pageSize,
            'totalCount'      => $query->count(),
        ]);
        $data = $query->select('id,title,create_user,create_time')
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
     * 添加新闻分类
     */
    public function actionCreate()
    {
        $model = new NewsCategory();
        if ($this->isPost) {
            $model->attributes          = $this->requests->post('NewsCategory');
            $model->attributes['title'] = trim($model->attributes['title']);
            if ($model->validate()) {
                if ($model->save()) {
                    Common::message('success', '保存成功', '/admin/news-category/index');
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
     * 更新新闻分类
     */
    public function actionEdit()
    {
        $id = (int) $this->requests->get('id');
        if ($id <= 0) {
            Common::message('', '无效新闻分类ID');
        }
        $model = new NewsCategory();
        if ($this->isPost) {
            $form                = $this->requests->post('NewsCategory');
            $product             = $model->findOne(['id' => $id]);
            $product->attributes = $form;
            if ($product->validate()) {
                if ($product->save()) {
                    Common::message('success', '修改成功', '/admin/news-category/index');
                } else {
                    Common::message('error', '修改失败');
                }
            } else {
                return $this->render('edit', ['model' => $product]);
            }
        } else {
            $data = $model->findOne(['id' => $id]);
            if (empty($data) || $data['is_delete'] == 1) {
                Common::message('error', '新闻分类不存在');
            }
            return $this->render('edit', ['data' => $data, 'model' => $model]);
        }
    }

    /*
     * 删除新闻
     */
    public function actionDelete()
    {
        $ids = $this->requests->post('ids');
        if (empty($ids)) {
            Common::echoJson(1001, '无效参数');
        }
        //更新的数据
        $data = ['is_delete' => 1];
        if (NewsCategory::updateAll($data, 'id in (' . $ids . ')') !== false) {
            Common::echoJson(1000, '删除成功');
        } else {
            Common::echoJson(1002, '删除失败');
        }
    }
}
