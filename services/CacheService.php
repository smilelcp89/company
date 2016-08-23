<?php
/**
 * 缓存服务类
 * User: liangchupeng
 * Date: 2016-08-21
 * Time: 11:00
 */
namespace app\services;

use app\constants\CacheConst;
use app\models\Config;
use app\models\Friendlink;
use app\models\ProductCategory;
use Yii;

class CacheService
{
    const CACHE_VALID_TIME = 3600; //缓存有效时间

    //从缓存中获取配置列表
    public static function getConfigsFromCache($field = '')
    {
        $data = Yii::$app->cache->get(CacheConst::WEBSITE_CONFIG);
        if (empty($data)) {
            $data = Config::find()->where(['=', 'is_delete', 0])->select('flag,content,intro')->asArray()->indexBy('flag')->all();
            Yii::$app->cache->set(CacheConst::WEBSITE_CONFIG, $data, self::CACHE_VALID_TIME);
        }
        if (!empty($field)) {
            return isset($field) ? $data[$field]['content'] : null;
        }
        return $data;
    }

    //从缓存中获取友情链接列表
    public static function getFriendlinksFromCache()
    {
        $data = Yii::$app->cache->get(CacheConst::FRIENDLINK_CACHE);
        if (empty($data)) {
            $data = Friendlink::find()->where(['=', 'is_delete', 0])->andWhere(['=', 'status', 1])->select('title,logo,url')->asArray()->all();
            Yii::$app->cache->set(CacheConst::FRIENDLINK_CACHE, $data, self::CACHE_VALID_TIME);
        }
        return $data;
    }

    //从缓存中获取产品分类列表
    public static function getProductCategorysFromCache($indexBy = '')
    {
        $data = Yii::$app->cache->get(CacheConst::PRODUCT_CATEGORY_CACHE);
        if (empty($data)) {
            $data = ProductCategory::find()->where(['=', 'is_delete', 0])->select('id,title,pid,path')->asArray()->all();
            Yii::$app->cache->set(CacheConst::PRODUCT_CATEGORY_CACHE, $data, self::CACHE_VALID_TIME);
        }
        if (!empty($data) && !empty($indexBy)) {
            return array_column($data, null, $indexBy);
        }
        return $data;
    }
}
