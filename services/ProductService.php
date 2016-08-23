<?php
/**
 * 产品服务类
 * User: liangchupeng
 * Date: 2016-08-21
 * Time: 11:00
 */
namespace app\services;

use app\models\Product;
use yii\data\Pagination;

class ProductService
{

    //从缓存中获取配置列表
    public static function getProductsByCondition($where = null, $params = null, $fields = '*', $pageIndex = null, $pageSize = null, $indexBy = null, $orderBy = null, $groupBy = null)
    {
        $query = Product::find();
        if ($where) {
            $query->where($where, $params);
        }
        if ($fields) {
            $query->select($fields);
        }
        if ($pageIndex && $pageSize) {
            $query->limit($pageSize)->offset(($pageIndex - 1) * $pageSize);
        }
        if ($orderBy) {
            $query->orderBy($orderBy);
        }
        if ($indexBy) {
            $query->indexBy($indexBy);
        }
        if ($groupBy) {
            $query->groupBy($groupBy);
        }
        $total      = $query->count();
        $pagination = $data = null;
        if ($total > 0) {
            //分页
            $pagination = new Pagination([
                'defaultPageSize' => $pageSize,
                'totalCount'      => $total,
            ]);
            //查询数据
            $data = $query->asArray()->all();
            if (!empty($data)) {
                foreach ($data as $key => $row) {
                    $data[$key]['images_list'] = !empty($row['images_list']) ? explode(',', $row['images_list']) : [];
                }
            }
        }
        return [
            'pages' => $pagination,
            'data'  => $data,
        ];
    }
}
