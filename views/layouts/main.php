<?php use yii\helpers\Url; ?>
<?php $imgHost = Yii::$app->params['imgHost']; ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-control" content="no-cache,no-store,must-revalidate,max-age=3">
	<meta name="keywords" content="<?=\app\services\CacheService::getConfigsFromCache('seo_keywords');?>">
	<meta name="description" content="<?=\app\services\CacheService::getConfigsFromCache('seo_description');?>">
	<title><?=\app\services\CacheService::getConfigsFromCache('seo_title');?></title>
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
	<div class="logo"><a href="/" title="网站首页"><img src="<?=Yii::$app->params['domain'];?>front/images/128631859541c31c.png" alt="网站首页"></a></div>
	<div class="right">
		<nav class="top">
			<a href="/" title="网站首页">网站首页</a> | 
			<a href="javascript:add_fav('网站名称','<?=Yii::$app->params['domain'];?>');void(0);">收藏本页</a> | 
			<a href="<?=Url::to(['public/guestbook']);?>">留言反馈</a>
		</nav>
		<form method="post" class="search" action="<?=Url::to(['product/product']);?>" onsubmit="return top_search();">
			<input name="keywords" value="" id="top_keywords" type="text" class="topsearch" placeholder="请输入产品名字" />
			<input type="submit" class="submit" value="" />
		</form>
	</div>
</header>
<nav class="menu">
	<ul>
		<li style="margin-left:4px;" <?=empty(Yii::$app->controller->id) || (Yii::$app->controller->id == 'index' && Yii::$app->controller->action->id == 'index') ? 'class="current"' : '' ?>><a href="/" title="首页">首　页</a></li>
		<li <?=(Yii::$app->controller->id == 'product') ? 'class="current"' : '' ?>><a href="<?=Url::to(['product/index']);?>" title="产品展示">产品展示</a></li>
		<li <?=(Yii::$app->controller->id == 'news') ? 'class="current"' : '' ?>><a href="<?=Url::to(['news/index']);?>" title="新闻中心">新闻中心</a></li>
		<li <?=(Yii::$app->controller->id == 'public' && Yii::$app->controller->action->id == 'guestbook') ? 'class="current"' : '' ?>><a href="<?=Url::to(['public/guestbook']);?>" title="留言反馈">留言反馈</a></li>
		<li <?=(Yii::$app->controller->id == 'public' && Yii::$app->controller->action->id == 'about') ? 'class="current"' : '' ?>><a href="<?=Url::to(['public/about']);?>" title="关于我们">关于我们</a></li>
		<li <?=(Yii::$app->controller->id == 'public' && Yii::$app->controller->action->id == 'contact') ? 'class="current"' : '' ?>><a href="<?=Url::to(['public/contact']);?>" title="联系我们">联系我们</a></li>
	</ul>
</nav>
<?= $content ?>
<div class="link">
	<ul class="clearfix">
		<li class="title">友情链接：</li>
		<?php $friendlinkArr = \app\services\CacheService::getFriendlinksFromCache();?>
		<?php if(!empty($friendlinkArr)):?>
			<?php foreach($friendlinkArr as $item):?>
			<li><a href="<?=$item['url']?>" target="_blank" title="<?=$item['title']?>"><?=$item['title']?></a></li>
			<?php endforeach;?>
		<?php endif?>
	</ul>
</div>
<div class="foot">
	<div class="copyright"><?=\app\services\CacheService::getConfigsFromCache('copy_right');?></div>
	<div id="right-float-box" class="im_floatonline">
		<div class="float-box-content">
			<div class="toptitle">在线客服</div>
			<div class="addlist">
				<ul>
					<li>小小鸟<br><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1032775291&site=qq&menu=yes"><img border="0" src="<?=$imgHost;?>front/images/pa" alt="点击这里给我发消息" title="点击这里给我发消息"></a></li>
					<li>小桥流水客服<br><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1032775291&site=qq&menu=yes"><img border="0" src="<?=$imgHost;?>front/images/pa" alt="点击这里给我发消息" title="点击这里给我发消息"></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
</body>
</html>