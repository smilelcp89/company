<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎登录后台管理系统</title>
<link href="<?=Yii::$app->params['imgHost'];?>backend/css/style.css" rel="stylesheet" type="text/css" />
<script src="<?=Yii::$app->params['imgHost'];?>backend/js/jquery.js" type="text/javascript"></script>

<script language="javascript">
$(function(){
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
	$(window).resize(function(){  
		$('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
    });  
	$("#verifyCode").attr("src","/admin/public/captcha");
});  
</script> 
</head>
<body style="background-color:#1c77ac; background-image:url(<?=Yii::$app->params['imgHost'];?>backend/images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">
    <div id="mainBody">
      <div id="cloud1" class="cloud"></div>
      <div id="cloud2" class="cloud"></div>
    </div>  
    <div class="logintop">    
        <span>欢迎登录管理后台</span>    
        <ul>
            <li><a href="/">网站首页</a></li>
        </ul>    
    </div>
    <div class="loginbody">
        <span class="systemlogo"></span> 
        <div class="loginbox">
            <form action="/admin/public/login" method="post">
            <ul>
                <li><input name="username" type="text" class="loginuser" placeholder="用户名"/></li>
                <li><input name="password" type="password" class="loginpwd" placeholder="密码"/></li>
				<li>
					<input name="verifyCode" type="text" style='width:100px;border:2px solid #BAC7D2;height:40px;padding-left:10px;float:left;' placeholder="验证码"/>
					<img id="verifyCode" src='' style='width:100px;height:40x;float:left;' title='点击切换验证码' onclick="this.src=this.src+'?'+Math.random();"/>
					<div style='clear:both;'></div>
				</li>
                <li>
                	<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                    <input type="submit" class="loginbtn" value="登录"  />
                    <input type="reset" class="loginbtn" value="重置" />
                    <!--<label><input name="" type="checkbox" value="" checked="checked" />记住密码</label><label><a href="#">忘记密码？</a></label>-->
                </li>
            </ul>    
            </form>
        </div>
    </div>
    <div class="loginbm"></div> 
</body>
</html>
