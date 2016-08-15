<?php

namespace app\modules\admin\controllers;

use app\components\Common;
use app\models\Config;
use Yii;
use yii\data\Pagination;
use yii\helpers\Html;

/**
 * 网站配置控制器
 */
class ConfigController extends BaseController
{

    public function init()
    {
        parent::init();
    }

    /*
     * 列表
     */
    public function actionIndex()
    {
        $pageSize = 10;
        $query    = Config::find();
        $query->where(['=', 'is_delete', 0]);
        $flag = trim(Html::encode($this->requests->get('flag')));
        if ($flag) {
            $query->andWhere(['like', 'flag', $flag]);
        }
        $intro = trim(Html::encode($this->requests->get('intro')));
        if ($intro) {
            $query->andWhere(['like', 'intro', $intro]);
        }
        //分页
        $pagination = new Pagination([
            'defaultPageSize' => $pageSize,
            'totalCount'      => $query->count(),
        ]);
        $data = $query->select('*')
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
     * 添加配置
     */
    public function actionCreate()
    {
        $model = new Config();
        if ($this->isPost) {
            $model->scenario = 'create';
            $model->attributes = $this->requests->post('Config');
            if ($model->validate()) {
                if ($model->save()) {
                    Common::message('success', '保存成功');
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
     * 更新配置
     */
    public function actionEdit()
    {
        $id = (int) $this->requests->get('id');
        if ($id <= 0) {
            Common::message('', '无效ID');
        }
        $model = new Config();
        if ($this->isPost) {
            $form = $this->requests->post('Config');
            $product = $model->findOne(['id' => $id]);
            $product->scenario = 'update';
            $product->attributes = $form;
            if ($product->validate()) {
                if ($product->save()) {
                    Common::message('success', '修改成功');
                } else {
                    Common::message('error', '修改失败');
                }
            } else {
                return $this->render('edit', ['model' => $product]);
            }
        } else {
            $data = $model->findOne(['id' => $id]);
            if (empty($data) || $data['is_delete'] == 1) {
                Common::message('error', '记录不存在');
            }
            return $this->render('edit', ['data' => $data, 'model' => $model]);
        }
    }

    /*
     * 删除配置
     */
    public function actionDelete()
    {
        $ids = $this->requests->post('ids');
        if (empty($ids)) {
            Common::echoJson(1001, '无效参数');
        }
        //更新的数据
        $data = ['is_delete' => 1];
        if (Config::updateAll($data, 'id in (' . $ids . ')') !== false) {
            Common::echoJson(1000, '删除成功');
        } else {
            Common::echoJson(1002, '删除失败');
        }
    }
}
