<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;

class RoleAcl extends ActiveRecord
{
    /**
     * @return string 返回该AR类关联的数据表名
     */
    public static function tableName()
    {
        return '{{%role_acl}}';
    }

    public function addAcl($params)
    {
        return Yii::$app->db->createCommand()->batchInsert('yii_role_acl', ['role_id', 'acl', 'create_name', 'create_time'], array_values($params))->execute();
    }

    public function updateAcl($params)
    {
        try {
            //先获取该角色已经有的权限项
            $oldAclArr = $this->find()->select(['id', 'acl', 'is_active'])->where('role_id = :role_id', [':role_id' => 1])->indexBy('acl')->asArray()->all();
            //转换数组下标
            $params = array_column($params, null, 'acl');

            foreach ($params as $key => $row) {
                if (isset($oldAclArr[$key])) {
                    $item = $oldAclArr[$key];
                    unset($oldAclArr[$key]); //删除后剩下的就是数据表中存在的，但是表单提交中没有的权限项
                    if ($item['is_active'] == '1') {
                        //如果已经存在，并且已经是“启用”状态，跳过
                        continue;
                    } else {
                        //如果存在并且为“不启用”状态，开启
                        Yii::$app->db->createCommand()->update('yii_role_acl', ['is_active' => 1], 'id=:id', [':id' => $item['id']])->execute();
                        unset($oldAclArr[$key]);
                    }

                } else {
                    //不存在，添加
                    Yii::$app->db->createCommand()->insert('yii_role_acl', $row)->execute();
                }
            }
            //如果表单提交的权限中没有数据库已经存在的权限，则将它们更新为“不启用”的状态
            if (count($oldAclArr) > 0) {
                foreach ($oldAclArr as $row) {
                    Yii::$app->db->createCommand()->update('yii_role_acl', ['is_active' => 2], 'id=:id', [':id' => $row['id']])->execute();
                }
            }
            return true;

        } catch (Exception $e) {
            return false;
        }
    }
}
