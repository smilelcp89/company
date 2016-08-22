<?php
/**
 * 网站配置服务类
 * User: liangchupeng
 * Date: 2016-08-21
 * Time: 11:00
 */
use app\models\Config;

class ConfigService{

    //获取配置列表
    public static function getConfigList($where = null,$params = null,$fields='*',$pageIndex = null,$pageSize = null){
        $command = Config::find();
        if($where){
            $command->where($where,$params);
        }
        if($fields){
            $command->select($fields);
        }
        if($pageIndex && $pageSize){
            $command->limit($pageSize);
            $command->offset(($pageIndex-1)*$pageSize);
        }
        return $command->asArray()->all();
    }
}