<?php $loginUserInfo = Yii::$app->session->get(\app\constants\Session::LOGIN_USER_INFO);?>
<div class="place">
	<span>位置：</span>
	<ul class="placeul">
		<li><a href="javascript;">首页</a></li>
	</ul>
</div>

<div class="mainindex">
<div class="welinfo">
	<span><img src="<?=Yii::$app->params['imgHost'];?>backend/images/sun.png" alt="天气" /></span>
	<b style="color:red;"><?=$loginUserInfo['username'];?></b> <label>您好，欢迎使用后台管理系统</label>
	<a href="/admin/user/edit?id=<?=$loginUserInfo['id'];?>">帐号设置</a>
</div>

<div class="welinfo">
<span><img src="<?=Yii::$app->params['imgHost'];?>backend/images/time.png" alt="时间" /></span>
<i>登录时间：<?=date('Y-m-d H:i:s', $loginUserInfo['last_login_time']);?></i> <i>登录IP：<?=$loginUserInfo['last_login_ip'];?></i>
</div>
<div class="xline"></div>
<div class="box"></div>
<div class="welinfo">
	<span><img src="<?=Yii::$app->params['imgHost'];?>backend/images/dp.png" alt="提醒" /></span>
	<b>快速使用功能</b>
</div>
<ul class="infolist">
	<li><span>快速进行新闻发布管理</span><a href="/admin/product" class="ibtn">新闻管理</a></li>
	<li><span>快速进行发布产品管理</span><a href="/admin/news" class="ibtn">产品管理</a></li>
	<li><span>快速进行账户设置管理</span><a href="/admin/user" class="ibtn">账户管理</a></li>
</ul>
<!--<div class="xline"></div>-->
<!--<div class="uimakerinfo"><b>如果修改了网站首页里面的内容信息，请重新生成首页（网站首页现为静态页面，加快页面加载速度）</b></div>-->
<!--<ul class="infolist">-->
<!--	<li><a href="javascript:;" class="ibtn">生成静态首页</a></li>-->
<!--</ul>-->
</div>