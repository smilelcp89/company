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
