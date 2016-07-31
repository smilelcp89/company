<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?=Yii::$app->params['imgHost'];?>backend/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="<?=Yii::$app->params['imgHost'];?>backend/js/jquery.js"></script>

<script type="text/javascript">
$(function(){	
	//导航切换
	$(".menuson li").click(function(){
		$(".menuson li.active").removeClass("active")
		$(this).addClass("active");
	});
	
	$('.title').click(function(){
		var $ul = $(this).next('ul');
		$('dd').find('ul').slideUp();
		if($ul.is(':visible')){
			$(this).next('ul').slideUp();
		}else{
			$(this).next('ul').slideDown();
		}
	});
})	
</script>
</head>

<body style="background:#f0f9fd;">
	<div class="lefttop"><span></span>功能模块</div>
    <dl class="leftmenu">  
    <dd>
    <div class="title">
    <span><img src="<?=Yii::$app->params['imgHost'];?>backend/images/leftico01.png" /></span>管理信息
    </div>
    	<ul class="menuson">
        <li class="active"><cite></cite><a href="/admin/default/right" target="rightFrame">首页模版</a><i></i></li>
        <li><cite></cite><a href="/admin/default/list" target="rightFrame">数据列表</a><i></i></li>
        <li><cite></cite><a href="/admin/default/list2" target="rightFrame">图片数据表</a><i></i></li>
        <li><cite></cite><a href="/admin/default/edit" target="rightFrame">添加编辑</a><i></i></li>
        <li><cite></cite><a href="/admin/default/tab" target="rightFrame">Tab页</a><i></i></li>
        <li><cite></cite><a href="/admin/common/error" target="rightFrame">404页面</a><i></i></li>
        </ul>    
    </dd>
        
    
    <dd><div class="title"><span><img src="<?=Yii::$app->params['imgHost'];?>backend/images/leftico01.png" /></span>网站设置</div>
    <ul class="menuson">
        <li><cite></cite><a href="/admin/config/index" target="rightFrame">设置列表</a><i></i></li>
        <li><cite></cite><a href="/admin/config/create" target="rightFrame">添加设置</a><i></i></li>
    </ul>    
    </dd>   
    
    
    <dd><div class="title"><span><img src="<?=Yii::$app->params['imgHost'];?>backend/images/leftico01.png" /></span>用户管理</div>
    <ul class="menuson">
        <li><cite></cite><a href="/admin/user/index" target="rightFrame">用户列表</a><i></i></li>
        <li><cite></cite><a href="/admin/user/create" target="rightFrame">添加用户</a><i></i></li>
    </ul>    
    </dd>  

    <dd><div class="title"><span><img src="<?=Yii::$app->params['imgHost'];?>backend/images/leftico01.png" /></span>产品管理</div>
    <ul class="menuson">
        <li><cite></cite><a href="/admin/product/index" target="rightFrame">产品列表</a><i></i></li>
        <li><cite></cite><a href="/admin/product/create" target="rightFrame">发布产品</a><i></i></li>
    </ul>    
    </dd>

    <dd><div class="title"><span><img src="<?=Yii::$app->params['imgHost'];?>backend/images/leftico01.png" /></span>新闻管理</div>
    <ul class="menuson">
        <li><cite></cite><a href="/admin/news/index" target="rightFrame">新闻列表</a><i></i></li>
        <li><cite></cite><a href="/admin/news/create" target="rightFrame">发布新闻</a><i></i></li>
    </ul>    
    </dd>

    <dd><div class="title"><span><img src="<?=Yii::$app->params['imgHost'];?>backend/images/leftico01.png" /></span>友情链接管理</div>
    <ul class="menuson">
        <li><cite></cite><a href="/admin/friendlink/index" target="rightFrame">友情链接列表</a><i></i></li>
        <li><cite></cite><a href="/admin/friendlink/create" target="rightFrame">添加友情链接</a><i></i></li>
    </ul>    
    </dd>

    <dd><div class="title"><span><img src="<?=Yii::$app->params['imgHost'];?>backend/images/leftico01.png" /></span>客服管理</div>
    <ul class="menuson">
        <li><cite></cite><a href="/admin/customer/index" target="rightFrame">客服列表</a><i></i></li>
        <li><cite></cite><a href="/admin/customer/create" target="rightFrame">添加客服</a><i></i></li>
    </ul>    
    </dd>


    <dd><div class="title"><span><img src="<?=Yii::$app->params['imgHost'];?>backend/images/leftico01.png" /></span>留言管理</div>
    <ul class="menuson">
        <li><cite></cite><a href="/admin/guestbook/index" target="rightFrame">留言列表</a><i></i></li>
    </ul>    
    </dd>

    
    </dl>
    
</body>
</html>
