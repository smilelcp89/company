<?php
/**
 * 新闻服务类
 * User: liangchupeng
 * Date: 2016-08-21
 * Time: 11:00
 */
namespace app\services;

use app\models\News;
use yii\data\Pagination;

class NewsService
{

    //从缓存中获取配置列表
    public static function getNewsByCondition($where = null, $params = null, $fields = '*', $pageIndex = null, $pageSize = null, $indexBy = null, $orderBy = null, $groupBy = null)
    {
        $query = News::find();
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
        }
        return [
            'pages' => $pagination,
            'data'  => $data,
        ];
    }
}
