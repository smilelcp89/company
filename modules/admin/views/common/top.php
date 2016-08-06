<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?=Yii::$app->params['imgHost'];?>backend/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="<?=Yii::$app->params['imgHost'];?>backend/js/jquery.js"></script>
<script type="text/javascript">
$(function(){	
	//顶部导航切换
	$(".nav li a").click(function(){
		$(".nav li a.selected").removeClass("selected")
		$(this).addClass("selected");
	})	
})	
</script>


</head>

<body style="background:url(<?=Yii::$app->params['imgHost'];?>backend/images/topbg.gif) repeat-x;">

    <div class="topleft">
    <a href="/admin" target="_parent"><img src="<?=Yii::$app->params['imgHost'];?>backend/images/logo.png" title="系统首页" /></a>
    </div>
        
    <ul class="nav">
    <li><a href="/admin/default" target="rightFrame" class="selected"><img src="<?=Yii::$app->params['imgHost'];?>backend/images/icon01.png" title="后台首页" /><h2>后台首页</h2></a></li>
    </ul>
            
    <div class="topright">    
    <ul>
        <li><a href="javascript:;" onclick="window.parent['rightFrame'].location.reload()">刷新</a></li>
        <li><a href="javascript:;"></a></li>
        <li><a href="/admin/public/logout" target="_parent">退出</a></li>
    </ul>
    
    <!-- 
    <div class="user">
        <span>admin</span>
        <i>消息</i>
        <b>5</b>
    </div>
    -->
    </div>

</body>
</html>
