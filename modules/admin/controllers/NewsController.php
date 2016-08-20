<?php

namespace app\modules\admin\controllers;

use app\components\Common;
use app\models\News;
use app\models\NewsCategory;
use Yii;
use yii\data\Pagination;
use yii\helpers\Html;

/**
 * 新闻控制器
 */
class NewsController extends BaseController
{

    public function init()
    {
        parent::init();
    }

    /*
     * 新闻列表
     */
    public function actionIndex()
    {
        $title       = trim(Html::encode($this->requests->get('title')));
        $isRecommend = trim(Html::encode($this->requests->get('isRecommend')));
        $cateId      = intval($this->requests->get('cateId', 0));

        $pageSize = 10;
        $query    = News::find();
        $query->where(['=', 'is_delete', 0]);
        if ($title) {
            $query->andWhere(['like', 'title', $title]);
        }
        if ($isRecommend) {
            $query->andWhere(['=', 'is_recommend', $isRecommend]);
        }
        if ($cateId) {
            $query->andWhere(['=', 'cate_id', $cateId]);
        }
        //分页
        $pagination = new Pagination([
            'defaultPageSize' => $pageSize,
            'totalCount'      => $query->count(),
        ]);
        $data = $query->select('id,title,cate_id,status,is_recommend,create_user,create_time')
            ->orderBy('id desc')
            ->limit($pagination->limit)
            ->offset($pagination->offset)
            ->asArray()
            ->all();
        //获取新闻分类
        $cateList = NewsCategory::find()->where(['is_delete' => 0])->select('id,title')->orderBy('id asc')->indexBy('id')->asArray()->all();
        return $this->render('index', [
            'data'       => $data,
            'pagination' => $pagination,
            'pageIndex'  => $pagination->getPage() + 1,
            'pageSize'   => $pageSize,
            'cateList'   => $cateList,
            'params'     => Yii::$app->request->get(),
        ]);
    }

    /*
     * 添加新闻
     */
    public function actionCreate()
    {
        $model = new News();
        if ($this->isPost) {
            $News              = $this->requests->post('News');
            $model->attributes = $News;
            $model->content    = Html::encode($News['content']);
            if ($model->validate()) {
                if ($model->save()) {
                    Common::message('success', '保存成功', '/admin/news/index');
                } else {
                    Common::message('error', '保存失败');
                }
            } else {
                return $this->render('edit', ['model' => $model]);
            }
        } else {
            //获取新闻分类
            $cateList = NewsCategory::find()->where(['is_delete' => 0])->select('id,title')->orderBy('id asc')->asArray()->all();
            $cateArr  = [];
            if (!empty($cateList)) {
                foreach ($cateList as $cate) {
                    $cateArr[$cate['id']] = $cate['title'];
                }
            }
            return $this->render('edit', ['model' => $model, 'cateArr' => $cateArr]);
        }
    }

    /*
     * 更新新闻
     */
    public function actionEdit()
    {
        $userId = (int) $this->requests->get('id');
        if ($userId <= 0) {
            Common::message('', '无效新闻ID');
        }
        $model = new News();
        if ($this->isPost) {
            $form             = $this->requests->post('News');
            $News             = $model->findOne(['id' => $userId]);
            $News->attributes = $form;
            if ($News->validate()) {
                if ($News->save()) {
                    Common::message('success', '修改成功', '/admin/news/index');
                } else {
                    Common::message('error', '修改失败');
                }
            } else {
                return $this->render('edit', ['model' => $News]);
            }
        } else {
            $data = $model->findOne(['id' => $userId]);
            if (empty($data) || $data['is_delete'] == 1) {
                Common::message('error', '新闻不存在');
            }
            //获取新闻分类
            $cateList = NewsCategory::find()->where(['is_delete' => 0])->select('id,title')->orderBy('id asc')->asArray()->all();
            $cateArr  = [];
            if (!empty($cateList)) {
                foreach ($cateList as $cate) {
                    $cateArr[$cate['id']] = $cate['title'];
                }
            }
            return $this->render('edit', ['data' => $data, 'model' => $model, 'cateArr' => $cateArr]);
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
        $data = ['is_delete' => 1, 'status' => 1];
        if (News::updateAll($data, 'id in (' . $ids . ')') !== false) {
            Common::echoJson(1000, '删除成功');
        } else {
            Common::echoJson(1002, '删除失败');
        }
    }

    /*
     * 改变新闻状态
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
        if (News::updateAll($data, 'id in (' . $ids . ')') !== false) {
            Common::echoJson(1000, '操作成功');
        } else {
            Common::echoJson(1002, '操作失败');
        }
    }

    /*
     * 改变新闻状态
     */
    public function actionIsrecommend()
    {
        $ids         = $this->requests->post('ids');
        $isRecommend = (int) $this->requests->post('isRecommend');
        if (empty($ids) || !in_array($isRecommend, [1, 2])) {
            Common::echoJson(1001, '无效参数');
        }
        //更新的数据
        $data = ['is_recommend' => $isRecommend];
        if (News::updateAll($data, 'id in (' . $ids . ')') !== false) {
            Common::echoJson(1000, '操作成功');
        } else {
            Common::echoJson(1002, '操作失败');
        }
    }
}
