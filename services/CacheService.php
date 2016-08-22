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
use Yii;

class CacheService
{

    //从缓存中获取配置列表
    public static function getConfigsFromCache($field = '')
    {
        $data = Yii::$app->cache->get(CacheConst::WEBSITE_CONFIG);
        if (empty($data)) {
            $data = Config::find()->where(['=', 'is_delete', 0])->select('flag,content,intro')->asArray()->indexBy('flag')->all();
            Yii::$app->cache->set(CacheConst::WEBSITE_CONFIG, $data, 3600);
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
            Yii::$app->cache->set(CacheConst::FRIENDLINK_CACHE, $data, 3600);
        }
        return $data;
    }
}
