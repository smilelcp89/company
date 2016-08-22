<?php
/**
 * 公共联系方式小部件
 */
namespace app\widgets;

use app\services\CacheService;
use yii\base\Widget;

class ContactWidget extends Widget
{
    public function run()
    {
        $configArr = CacheService::getConfigsFromCache();
        return <<<EOT
		<div class="pfw">
			<div class="title"><h3>联系我们</h3></div>
			<div class="info contact_info">
				<h4>{$configArr['company_name']['content']}</h4>
				<ul>
					<li><i>联系人：</i>{$configArr['contact_name']['content']}</li>
					<li><i>电　话：</i>{$configArr['contact_mobile']['content']}</li>
					<li><i>邮　箱：</i>{$configArr['contact_email']['content']}</li>
				</ul>
			</div>
		</div>
EOT;
    }
}
