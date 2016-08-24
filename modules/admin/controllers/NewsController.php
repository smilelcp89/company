<?php

namespace app\modules\admin\controllers;

use app\components\Common;
use app\models\News;
use app\services\CacheService;
use app\services\NewsService;
use Yii;
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
        $status      = intval($this->requests->get('status', 0));
        $pageIndex   = intval($this->requests->get('page', 1));
        $pageSize    = 10;
        $where[]     = 'is_delete = 0';
        $params      = [];
        if ($title) {
            $where[]          = 'title like ":title%"';
            $params[':title'] = $title;
        }
        if ($cateId) {
            $where[]           = 'cate_id = :cateId';
            $params[':cateId'] = $cateId;
        }
        if ($status) {
            $where[]           = 'status = :status';
            $params[':status'] = $status;
        }
        if ($status) {
            $where[]                 = 'is_recommend = :is_recommend';
            $params[':is_recommend'] = $isRecommend;
        }
        $result = NewsService::getNewsByCondition(implode(' and ', $where), $params, 'id,title,cate_id,status,is_recommend,create_user,create_time', $pageIndex, $pageSize, null, 'id desc');
        //获取广告分类
        $cateList = CacheService::getNewsCategorysFromCache('id');
        return $this->render('index', [
            'data'       => $result['data'],
            'pagination' => $result['pages'],
            'pageIndex'  => $pageIndex,
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
            $news              = $this->requests->post('News');
            $model->attributes = $news;
            $model->content    = Html::encode($news['content']);
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
            $cateList = CacheService::getNewsCategorysFromCache('id');
            $cateList = array_column($cateList, 'title', 'id');
            return $this->render('edit', ['model' => $model, 'cateList' => $cateList]);
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
            $form['content']  = Html::encode($form['content']);
            $news             = $model->findOne(['id' => $userId]);
            $news->attributes = $form;
            if ($news->validate()) {
                if ($news->save()) {
                    Common::message('success', '修改成功', '/admin/news/index');
                } else {
                    Common::message('error', '修改失败');
                }
            } else {
                return $this->render('edit', ['model' => $news]);
            }
        } else {
            $data = $model->findOne(['id' => $userId]);
            if (empty($data) || $data['is_delete'] == 1) {
                Common::message('error', '新闻不存在');
            }
            //获取新闻分类
            $cateList = CacheService::getNewsCategorysFromCache('id');
            $cateList = array_column($cateList, 'title', 'id');
            return $this->render('edit', ['data' => $data, 'model' => $model, 'cateList' => $cateList]);
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
