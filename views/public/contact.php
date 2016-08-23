<div class="banner" style="background-image:url(<?=Yii::$app->params['imgHost'];?>front/images/auto_1140.jpg)"></div>
<div class="main clearfix">
	<div class="left">
		<?=\app\widgets\ContactWidget::widget()?>
	</div>
	<div class="right">
		<div class="pfw">
			<div class="title">
				<h3>联系我们</h3>
				<span class="breadcrumbs">
					您现在的位置：
					<a href="/" title="首页">首页</a>
					<span class="arrow">&gt;</span> 联系我们
				</span>
			</div>
			<div class="detail">
				<div class="content" style="margin:0;">
				<p id="map" style="width:720px;height:360px;"></p>
				<p>
					<strong><span style="font-size: 16px;"><?=\app\services\CacheService::getConfigsFromCache('company_name')?></span></strong>
					<br>
				</p>
				<p><br></p>
				<p>联系人：<?=\app\services\CacheService::getConfigsFromCache('contact_name')?></p>
				<p>电　话：<?=\app\services\CacheService::getConfigsFromCache('contact_mobile')?></p>
				<p>邮　箱：<?=\app\services\CacheService::getConfigsFromCache('contact_email')?></p>
				<p><br></p>
			</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=rgWwVOtOxc9X9IfkrcI7QQ5wg5RbcGsQ"></script>
<script type="text/javascript">
	// 百度地图API功能
	var map = new BMap.Map("map");    // 创建Map实例
	map.centerAndZoom(new BMap.Point(113.128018,23.027732), 16);  // 初始化地图,设置中心点坐标和地图级别
	map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
	map.setCurrentCity("佛山");          // 设置地图显示的城市 此项是必须设置的
	map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
</script>