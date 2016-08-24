<?php

namespace app\controllers;

use app\models\News;
use app\services\CacheService;
use app\services\NewsService;
use Yii;

class NewsController extends FrontBaseController
{

    /**
     * 新闻列表
     */
    public function actionIndex()
    {
        $cateId    = (int) Yii::$app->request->get('cateId', 0);
        $pageIndex = (int) Yii::$app->request->get('page', 1);
        $where[]   = 'status = 1 and is_delete = 0';
        $params    = [];
        if ($cateId) {
            $where[]           = 'cate_id = :cateId';
            $params[':cateId'] = $cateId;
        }
        $result = NewsService::getNewsByCondition(implode(' and ', $where), $params, 'id,title,cate_id,content,create_time', $pageIndex, 10, null, 'is_recommend asc,id desc');

        //获取广告分类
        $newsCategoryList = CacheService::getNewsCategorysFromCache('id');
        //当前搜索分类名
        $cateName = !empty($cateId) ? $newsCategoryList[$cateId]['title'] : '';
        return $this->render('index', [
            'data'             => $result['data'],
            'pagination'       => $result['pages'],
            'newsCategoryList' => $newsCategoryList,
            'cateName'         => $cateName,
            'params'           => Yii::$app->request->get(),
        ]);
    }

    /**
     * 新闻详情
     */
    public function actionDetail()
    {
        //获取新闻详情
        $id = (int) Yii::$app->request->get('id', 0);
        if (empty($id)) {
            $this->redirect(['public/error']);
        }
        $news = News::find()
            ->select('id,title,cate_id,content,create_time')
            ->where(['=', 'id', $id])
            ->andWhere(['=', 'is_delete', 0])
            ->andWhere(['=', 'status', 1])
            ->asArray()
            ->one();
        if (empty($news)) {
            $this->redirect(['public/error']);
        }
        //图片使用懒加载
        $news['content'] = !empty($news['content']) ? str_replace('src=', 'class="lazy" data-original=', $news['content']) : '';
        //获取新闻分类
        $newsCategoryList = CacheService::getNewsCategorysFromCache('id');
        return $this->render('detail', [
            'newsCategoryList' => $newsCategoryList,
            'news'             => $news,
        ]);
    }
}
