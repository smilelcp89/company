<?php

namespace app\controllers;

use app\services\CacheService;
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
        //获取推荐产品
        $recommend = ProductService::getProductsByCondition('is_delete=0 and status=1 and is_recommend=1', [], 'id,title,logo,images_list,sale_price', 1, 6);
        //获取最新8个产品
        $result = ProductService::getProductsByCondition('is_delete=0 and status=1', [], 'id,title,logo,images_list,sale_price', 1, 8);
        //获取广告列表
        $adsList = CacheService::getAdsFromCache();
        return $this->render('index', ['adsList' => $adsList, 'recommendProducts' => $recommend['data'], 'productList' => $result['data']]);
    }

}
