<?php

namespace app\constants;

class Acl
{
    //权限控制配置项
    public static $aclConfig = [

        '账户管理' => [
            'url'    => '',
            'action' => [
                [
                    'name' => '用户管理',
                    'url'  => '',
                    'acl'  => [
                        '查看' => 'user_index',
                        '添加' => 'user_create',
                        '编辑' => 'user_update',
                        '删除' => 'user_delete',
                    ],
                ],
                [
                    'name' => '角色管理',
                    'url'  => '',
                    'acl'  => [
                        '查看' => 'role_index',
                        '添加' => 'role_create',
                        '编辑' => 'role_update',
                        '删除' => 'role_delete',
                    ],
                ],
            ],
        ],
    ];
}
