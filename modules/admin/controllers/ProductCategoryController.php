<?php

namespace app\modules\admin\controllers;

use app\components\Common;
use app\constants\CacheConst;
use app\models\ProductCategory;
use Yii;
use yii\data\Pagination;
use yii\helpers\Html;

/**
 * 产品分类控制器
 */
class ProductCategoryController extends BaseController
{

    public function init()
    {
        parent::init();
    }

    /*
     * 产品分类列表
     */
    public function actionIndex()
    {
        $title = trim(Html::encode($this->requests->get('title')));

        $pageSize = 10;
        $query    = ProductCategory::find();
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
     * 添加产品分类
     */
    public function actionCreate()
    {
        $model = new ProductCategory();
        if ($this->isPost) {
            $model->attributes          = $this->requests->post('ProductCategory');
            $model->attributes['title'] = trim($model->attributes['title']);
            if ($model->validate()) {
                if ($model->save()) {
                    //删除缓存
                    $this->cache->delete(CacheConst::PRODUCT_CATEGORY_CACHE);
                    Common::message('success', '保存成功', '/admin/product-category/index');
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
     * 更新产品分类
     */
    public function actionEdit()
    {
        $id = (int) $this->requests->get('id');
        if ($id <= 0) {
            Common::message('', '无效产品分类ID');
        }
        $model = new ProductCategory();
        if ($this->isPost) {
            $form                = $this->requests->post('ProductCategory');
            $product             = $model->findOne(['id' => $id]);
            $product->attributes = $form;
            if ($product->validate()) {
                if ($product->save()) {
                    //删除缓存
                    $this->cache->delete(CacheConst::PRODUCT_CATEGORY_CACHE);
                    Common::message('success', '修改成功', '/admin/product-category/index');
                } else {
                    Common::message('error', '修改失败');
                }
            } else {
                return $this->render('edit', ['model' => $product]);
            }
        } else {
            $data = $model->findOne(['id' => $id]);
            if (empty($data) || $data['is_delete'] == 1) {
                Common::message('error', '产品分类不存在');
            }
            return $this->render('edit', ['data' => $data, 'model' => $model]);
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
        $data = ['is_delete' => 1];
        if (ProductCategory::updateAll($data, 'id in (' . $ids . ')') !== false) {
            //删除缓存
            $this->cache->delete(CacheConst::PRODUCT_CATEGORY_CACHE);
            Common::echoJson(1000, '删除成功');
        } else {
            Common::echoJson(1002, '删除失败');
        }
    }
}
