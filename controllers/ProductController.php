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
        $where[]   = 'is_delete = 0 and status = 1';
        if ($title) {
            $where[] = 'title like "$title%"';
        }
        if ($cateId) {
            $where[] = 'cate_id = ' . $cateId;
        }
        $result = ProductService::getProductsByCondition(implode(',', $where), [], 'id,title,logo,images_list,sale_price', 'is_recommend asc,id desc', $pageIndex, 6);

        //将变量传到layout中
        $view                           = Yii::$app->view;
        $view->params['searchKeywords'] = $title;
        //获取产品分类
        $productCategoryList = CacheService::getProductCategorysFromCache('id');
        //当前搜索分类名
        $cateName = !empty($cateId) ? $productCategoryList[$cateId]['title'] : '';
        return $this->render('index', [
            'data'                => $result['data'],
            'pagination'          => $result['pagination'],
            'productCategoryList' => $productCategoryList,
            'params'              => Yii::$app->request->get(),
            'cateName'            => $cateName,
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
            ->from(Product::tableName() . ' p')
            ->select('p.id,p.title,p.logo,p.images_list,p.sale_price,p.intro,p.is_recommend,p.seo_title,p.seo_keywords,p.seo_descpition,p.create_time,c.title cate_name')
            ->leftJoin('cy_product_category c', 'p.cate_id=c.id')
            ->where(['=', 'p.is_delete', 0])
            ->andWhere(['=', 'p.status', 1])
            ->andWhere(['=', 'c.is_delete', 0])
            ->asArray()
            ->one();
        $product['images_list'] = isset($product['images_list']) && $product['images_list'] ? explode(',', str_replace('_middle', '_big', $product['images_list'])) : [];
        //获取产品分类
        $productCategoryList = CacheService::getProductCategorysFromCache();
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
