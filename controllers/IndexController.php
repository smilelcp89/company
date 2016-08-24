<?php

namespace app\controllers;

use app\services\CacheService;
use app\services\NewsService;
use app\services\ProductService;

class IndexController extends FrontBaseController
{

    public function init()
    {
        parent::init();
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        echo 123;die;
        //获取推荐6个产品
        $recommendResult = ProductService::getProductsByCondition('status=1 and is_delete=0 and is_recommend=1', [], 'id,title,logo,images_list,sale_price', 1, 6);
        //获取最新8个产品
        $productResult = ProductService::getProductsByCondition('status=1 and is_delete=0', [], 'id,title,logo,images_list,sale_price', 1, 8);
        //获取广告列表
        $adsList = CacheService::getAdsFromCache();
        //获取新闻10条
        $newsResult = NewsService::getNewsByCondition('status=1 and is_delete=0', [], 'id,title,is_recommend', 1, 10, null, 'is_recommend asc,id desc');
        return $this->render('index', [
            'adsList'           => $adsList,
            'recommendProducts' => $recommendResult['data'],
            'productList'       => $productResult['data'],
            'newsList'          => $newsResult['data'],
        ]);
    }

}
