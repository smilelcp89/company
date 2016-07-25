<?php

//存放在session中的key，常量集合

namespace app\constants;

class Session
{
    //所有权限集合名
    const ALL_ACL = 'all_acl';
    //当前登录用户拥有的权限名
    const USER_ACL = 'user_acl';
    //登录用户信息
    const LOGIN_USER_INFO = 'login_user_info';
}
