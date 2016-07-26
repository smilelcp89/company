<?php use yii\helpers\Url; ?>
<?php $imgHost = Yii::$app->params['imgHost']; ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-control" content="no-cache,no-store,must-revalidate,max-age=3">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<title>yii2测试</title>
	<link rel="icon" href="/favicon.ico">
	<link rel="stylesheet" type="text/css" href="<?=$imgHost;?>front/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?=$imgHost;?>front/css/artdialog.css">
	<script type="text/javascript" src="<?=$imgHost;?>front/js/public.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?=$imgHost;?>front/js/global.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?=$imgHost;?>front/js/jquery.artdialog.js" charset="utf-8"></script>
	<!--[if IE]>
	<script type="text/javascript" src="<?=$imgHost;?>front/js/html5.js" charset="utf-8"></script>
	<![endif]-->
	
</head>
<body>
<header class="clearfix">
	<div class="logo"><a href="http://company.local.com/" title="第一"><img src="<?=Yii::$app->params['domain'];?>front/images/128631859541c31c.png" alt="第一"></a></div>
	<div class="right">
		<nav class="top">
			<a href="/" title="第一">网站首页</a> | 
			<a href="javascript:add_fav('网站名称','<?=Yii::$app->params['imgHost'];?>');void(0);">收藏本页</a> | 
			<a href="<?=Url::to(['public/guestbook']);?>">留言反馈</a>
		</nav>
		<form method="post" class="search" action="/product/search" onsubmit="return top_search();">
			<input name="keywords" value="" id="top_keywords" type="text" class="topsearch" placeholder="请输入关键字" />
			<input type="submit" class="submit" value="" />
		</form>
	</div>
</header>
<nav class="menu">
	<ul>
		<li style="margin-left:4px;"><a href="/" title="首页" target="_self">首　页</a></li>
		<li><a href="<?=Url::to(['product/index']);?>" title="产品展示" target="_self">产品展示</a></li>
		<li><a href="<?=Url::to(['news/index']);?>" title="新闻中心" target="_self">新闻中心</a></li>
		<li class="current"><a href="<?=Url::to(['public/guestbook']);?>" title="留言反馈" target="_self">留言反馈</a></li>
		<li><a href="<?=Url::to(['public/about']);?>" title="关于我们" target="_self">关于我们</a></li>
		<li><a href="<?=Url::to(['public/contact']);?>" title="联系我们" target="_self">联系我们</a></li>
	</ul>
</nav>
<?= $content ?>
<div class="link">
	<ul class="clearfix">
		<li class="title">友情链接：</li>
		<li><a href="http://company.local.com/1470.html" target="_blank" title="启邦互动">启邦互动</a></li>
		<li><a href="http://company.local.com/1469.html" target="_blank" title="梦幻网络">梦幻网络</a></li>
		<li><a href="http://company.local.com/1468.html" target="_blank" title="中国站长站">中国站长站</a></li>
		<li><a href="http://company.local.com/1467.html" target="_blank" title="PHPOK企业站">PHPOK企业站</a></li>
	</ul>
</div>
<div class="foot">
	<div class="copyright">Powered By phpok.com 版权所有 © 2004-2014, All right reserved.</div>
	<div id="right-float-box" class="im_floatonline">
		<div class="float-box-content">
			<div class="toptitle">在线客服</div>
			<div class="addlist">
				<ul>
					<li>客服2<br><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=150467466&site=qq&menu=yes"><img border="0" src="<?=$imgHost;?>front/images/pa" alt="点击这里给我发消息" title="点击这里给我发消息"></a></li>
					<li>客服1<br><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=40782502&site=qq&menu=yes"><img border="0" src="<?=$imgHost;?>front/images/pa" alt="点击这里给我发消息" title="点击这里给我发消息"></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
</body>
</html>