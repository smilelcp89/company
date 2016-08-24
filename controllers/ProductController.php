<?php

namespace app\controllers;

use app\models\Product;
use app\services\CacheService;
use app\services\ProductService;
use Yii;
use yii\helpers\Html;

class ProductController extends FrontBaseController
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $title     = trim(Html::encode(Yii::$app->request->get('keywords')));
        $cateId    = (int) Yii::$app->request->get('cateId', 0);
        $pageIndex = (int) Yii::$app->request->get('page', 1);
        $where[]   = 'status = 1 and is_delete = 0';
        $params    = [];
        if ($title) {
            $where[]          = 'title like ":title%"';
            $params[':title'] = $title;
        }
        if ($cateId) {
            $where[]           = 'cate_id = :cateId';
            $params[':cateId'] = $cateId;
        }
        $result = ProductService::getProductsByCondition(implode(' and ', $where), $params, 'id,title,logo,images_list,sale_price', $pageIndex, 6, null, 'is_recommend asc,id desc');

        //将变量传到layout中
        $view                           = Yii::$app->view;
        $view->params['searchKeywords'] = $title;
        //获取产品分类
        $productCategoryList = CacheService::getProductCategorysFromCache('id');
        //当前搜索分类名
        $cateName = !empty($cateId) ? $productCategoryList[$cateId]['title'] : '';
        return $this->render('index', [
            'data'                => $result['data'],
            'pagination'          => $result['pages'],
            'productCategoryList' => $productCategoryList,
            'cateName'            => $cateName,
            'params'              => Yii::$app->request->get(),
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionDetail()
    {
        //获取产品详情
        $id = (int) Yii::$app->request->get('id', 0);
        if (empty($id)) {
            $this->redirect(['public/error']);
        }
        $product = Product::find()
            ->select('id,title,cate_id,logo,images_list,sale_price,intro,is_recommend,seo_title,seo_keywords,seo_descpition,create_time')
            ->where(['=', 'id', $id])
            ->andWhere(['=', 'is_delete', 0])
            ->andWhere(['=', 'status', 1])
            ->asArray()
            ->one();
        if (empty($product)) {
            $this->redirect(['public/error']);
        }
        //图片使用懒加载
        $product['intro']       = !empty($product['intro']) ? str_replace('src=', 'class="lazy" data-original=', $product['intro']) : '';
        $product['images_list'] = isset($product['images_list']) && $product['images_list'] ? explode(',', str_replace('_middle', '_big', $product['images_list'])) : [];
        //获取产品分类
        $productCategoryList = CacheService::getProductCategorysFromCache('id');
        //将变量传到layout中
        $view                           = Yii::$app->view;
        $view->params['seo_title']      = $product['seo_title'];
        $view->params['seo_keywords']   = $product['seo_keywords'];
        $view->params['seo_descpition'] = $product['seo_descpition'];
        return $this->render('detail', [
            'productCategoryList' => $productCategoryList,
            'product'             => $product,
        ]);
    }
}
