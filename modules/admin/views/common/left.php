<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?=Yii::$app->params['imgHost'];?>admin/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="<?=Yii::$app->params['imgHost'];?>admin/js/jquery.js"></script>

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
    <span><img src="<?=Yii::$app->params['imgHost'];?>admin/images/leftico01.png" /></span>管理信息
    </div>
    	<ul class="menuson">
        <li class="active"><cite></cite><a href="/admin/default/index" target="rightFrame">首页模版</a><i></i></li>
        <li><cite></cite><a href="/admin/default/list" target="rightFrame">数据列表</a><i></i></li>
        <li><cite></cite><a href="/admin/default/list2" target="rightFrame">图片数据表</a><i></i></li>
        <li><cite></cite><a href="/admin/default/edit" target="rightFrame">添加编辑</a><i></i></li>
        <li><cite></cite><a href="/admin/default/tab" target="rightFrame">Tab页</a><i></i></li>
        <li><cite></cite><a href="/admin/common/error" target="rightFrame">404页面</a><i></i></li>
        </ul>    
    </dd>
        
    
    <dd>
    <div class="title">
    <span><img src="<?=Yii::$app->params['imgHost'];?>admin/images/leftico02.png" /></span>网站设置
    </div>
    <ul class="menuson">
        <li><cite></cite><a href="#" target="rightFrame">编辑内容</a><i></i></li>
        <li><cite></cite><a href="#" target="rightFrame">发布信息</a><i></i></li>
        <li><cite></cite><a href="#" target="rightFrame">档案列表显示</a><i></i></li>
        </ul>     
    </dd> 
    
    
    <dd><div class="title"><span><img src="<?=Yii::$app->params['imgHost'];?>admin/images/leftico03.png" /></span>用户管理</div>
    <ul class="menuson">
        <li><cite></cite><a href="#" target="rightFrame">用户列表</a><i></i></li>
        <li><cite></cite><a href="/admin/user/add" target="rightFrame">添加用户</a><i></i></li>
    </ul>    
    </dd>  
    
    
    <dd><div class="title"><span><img src="<?=Yii::$app->params['imgHost'];?>admin/images/leftico04.png" /></span>日期管理</div>
    <ul class="menuson">
        <li><cite></cite><a href="#" target="rightFrame">自定义</a><i></i></li>
        <li><cite></cite><a href="#" target="rightFrame">常用资料</a><i></i></li>
        <li><cite></cite><a href="#" target="rightFrame">信息列表</a><i></i></li>
        <li><cite></cite><a href="#" target="rightFrame">其他</a><i></i></li>
    </ul>
    
    </dd>   
    
    </dl>
    
</body>
</html>
