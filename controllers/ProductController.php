<?php

namespace app\controllers;

use app\models\Product;
use app\services\CacheService;
use Yii;
use yii\data\Pagination;
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
        $title  = trim(Html::encode(Yii::$app->request->get('keywords')));
        $cateId = (int) Yii::$app->request->get('cateId', 0);

        $pageSize = 6;
        $query    = Product::find();
        $query->where(['=', 'is_delete', 0]);
        $query->andWhere(['=', 'status', 1]);
        if ($title) {
            $query->andWhere(['like', 'title', $title]);
        }
        if ($cateId) {
            $query->andWhere(['=', 'cate_id', $cateId]);
        }
        $data  = $pagination  = null;
        $count = $query->count();
        if ($count > 0) {
            //分页
            $pagination = new Pagination([
                'defaultPageSize' => $pageSize,
                'totalCount'      => $query->count(),
            ]);
            //获取产品
            $data = $query->select('id,title,logo,images_list,sale_price')
                ->orderBy('is_recommend asc,id desc')
                ->limit($pagination->limit)
                ->offset($pagination->offset)
                ->asArray()
                ->all();
            if (!empty($data)) {
                foreach ($data as $key => $row) {
                    $data[$key]['images_list'] = !empty($row['images_list']) ? explode(',', $row['images_list']) : [];
                }
            }
        }
        //将变量传到layout中
        $view                           = Yii::$app->view;
        $view->params['searchKeywords'] = $title;
        //获取产品分类
        $productCategoryList = CacheService::getProductCategorysFromCache('id');
        //当前搜索分类名
        $cateName = !empty($cateId) ? $productCategoryList[$cateId]['title'] : '';
        return $this->render('index', [
            'data'                => $data,
            'pagination'          => $pagination,
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
