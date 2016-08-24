<?php

namespace app\modules\admin\controllers;

use app\components\Common;
use app\models\Product;
use app\services\CacheService;
use app\services\ProductService;
use Yii;
use yii\helpers\Html;

/**
 * 产品控制器
 */
class ProductController extends BaseController
{

    public function init()
    {
        parent::init();
    }

    /*
     * 产品列表
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
        $result = ProductService::getProductsByCondition(implode(' and ', $where), $params, 'id,title,logo,sale_price,status,cate_id,is_recommend', $pageIndex, $pageSize, null, 'id desc');
        //获取产品分类
        $cateList = CacheService::getProductCategorysFromCache('id');
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
     * 添加产品
     */
    public function actionCreate()
    {
        $model = new Product();
        if ($this->isPost) {
            $productImgs = $this->requests->post('productImgs');
            if (empty($productImgs)) {
                Common::message('error', '产品图片必须上传');
            }
            $product            = $this->requests->post('Product');
            $model->attributes  = $product;
            $model->images_list = implode(',', $productImgs);
            $model->logo        = $productImgs[0]; //第一张图片作为logo
            $model->intro       = Html::encode($product['intro']);
            if ($model->validate()) {
                if ($model->save()) {
                    Common::message('success', '保存成功', '/admin/product/index');
                } else {
                    Common::message('error', '保存失败');
                }
            } else {
                return $this->render('edit', ['model' => $model]);
            }
        } else {
            //获取产品分类
            $cateList = CacheService::getProductCategorysFromCache('id');
            $cateList = array_column($cateList, 'title', 'id');
            return $this->render('edit', ['model' => $model, 'cateList' => $cateList]);
        }
    }

    /*
     * 更新产品
     */
    public function actionEdit()
    {
        $userId = (int) $this->requests->get('id');
        if ($userId <= 0) {
            Common::message('', '无效产品ID');
        }
        $model = new Product();
        if ($this->isPost) {
            $form                = $this->requests->post('Product');
            $form['intro']       = Html::encode($form['intro']);
            $product             = $model->findOne(['id' => $userId]);
            $product->attributes = $form;
            if ($product->validate()) {
                if ($product->save()) {
                    Common::message('success', '修改成功', '/admin/product/index');
                } else {
                    Common::message('error', '修改失败');
                }
            } else {
                return $this->render('edit', ['model' => $product]);
            }
        } else {
            $data = $model->findOne(['id' => $userId]);
            if (empty($data) || $data['is_delete'] == 1) {
                Common::message('error', '产品不存在');
            }
            if (!empty($data['images_list'])) {
                $data['images_list'] = explode(',', $data['images_list']);
            } else {
                $data['images_list'] = [$data['logo']];
            }
            //获取产品分类
            $cateList = CacheService::getProductCategorysFromCache('id');
            $cateList = array_column($cateList, 'title', 'id');
            return $this->render('edit', ['data' => $data, 'model' => $model, 'cateList' => $cateList]);
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
        $data = ['is_delete' => 1, 'status' => 1];
        if (Product::updateAll($data, 'id in (' . $ids . ')') !== false) {
            Common::echoJson(1000, '删除成功');
        } else {
            Common::echoJson(1002, '删除失败');
        }
    }

    /*
     * 改变产品上下架状态
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
        if (Product::updateAll($data, 'id in (' . $ids . ')') !== false) {
            Common::echoJson(1000, '操作成功');
        } else {
            Common::echoJson(1002, '操作失败');
        }
    }

    /*
     * 改变产品推荐状态
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
        if (Product::updateAll($data, 'id in (' . $ids . ')') !== false) {
            Common::echoJson(1000, '操作成功');
        } else {
            Common::echoJson(1002, '操作失败');
        }
    }
}
