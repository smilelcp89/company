<?php

/**
 * Ajax返回code对应错误信息，常量集合（除了通用错误意外，建议针对不同的模块进行划分错误code）
 * @author liangchupeng
 * @since 2016.07.22
 */

namespace app\constants;

class Code
{
    //成功
    const SUCCESS_CODE = 1000;
    //未登录
    const NOT_LOGINED = 2001;
    //访问受限
    const ACCESS_FORBIDDEN = 2002;

    //code=>NOT_LOGINED
    public static $messages = [
        self::SUCCESS_CODE     => '成功',
        self::NOT_LOGINED      => '未登录',
        self::ACCESS_FORBIDDEN => '没有访问权限',
    ];

}
