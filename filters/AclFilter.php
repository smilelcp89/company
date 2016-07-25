<?php

namespace app\filters;

use app\constants\Acl;
use app\constants\Code;
use app\constants\Session as SessConst;
use Yii;
use yii\base\ActionFilter;

/**
 */
class AclFilter extends ActionFilter
{

    //在action之前运行，可用来过滤输入
    public function beforeAction($action)
    {
        $acl = strtolower($action->controller->id) . '_' . strtolower($action->id);
        //判断该访问地址是否在权限列表内
        $allAcl = Yii::$app->session->get(SessConst::ALL_ACL);
        if (empty($allAcl)) {
            $aclConfig = Acl::$aclConfig;
            $aclArr    = [];
            if ($aclConfig) {
                foreach ($aclConfig as $row) {
                    foreach ($row['action'] as $item) {
                        $aclArr = !empty($aclArr) ? array_merge($aclArr, array_values($item['acl'])) : array_values($item['acl']);
                    }
                }
                Yii::$app->session->set(SessConst::ALL_ACL, implode('|', $aclArr));
            }
            $aclConfig = null;
        }
        $aclStr = Yii::$app->session->get(SessConst::USER_ACL);
        //判断是否有权限访问
        if (strpos($allAcl, $acl) !== false && strpos($aclStr, $acl) === false) {
            //根据是否为ajax，返回错误提示信息
            if (Yii::$app->request->isAjax) {
                die(json_encode([
                    'code'    => Code::ACCESS_FORBIDDEN,
                    'message' => Code::$messages[Code::ACCESS_FORBIDDEN],
                ]));
            } else {
                die(Code::$messages[Code::ACCESS_FORBIDDEN]);
            }
        }
        return true; //如果返回值为false,则action不会运行
    }

    //在action之后运行，可用来过滤输出
    public function afterAction($action, $result)
    {

    }

}
