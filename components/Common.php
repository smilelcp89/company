<?php

namespace app\components;

//公共方法类
class Common
{
    /**
     * 提示信息
     */
    public static function message($type, $content, $url = '')
    {
        $html = <<<EOT
			<!DOCTYPE html>
			<html lang="zh-hans">
			<head>
				<meta charset="UTF-8">
				<meta name="renderer" content="webkit">
				<meta http-equiv="X-UA-Compatible" content="IE=Edge">
				<title>提示信息页面</title>
				</head>
				<style>
					.success h1{color: #74CC00;}
					.error h1{color: red;}
				</style>
			<body>
			<div class="container">
				<div class="wrapper">
					<div style="padding:30px 15px;text-align:center;" class="cloum mb0 $type">
						<!--<div class="cloum-title"><h3>提示信息：</h3></div>-->
						<h1 style="padding: 0 0 10px;font-size: 20px;" class="block">$content</h1>
						<p>系统自动跳转在  <span class="time" id="time">3</span>  秒后，如果不想等待，<a style="color:#29a2da;text-decoration:none;" href="$url">点击这里跳转</a></p>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				function delayURL(url) {
					var delay = document.getElementById("time").innerHTML;
					if(delay > 0){
						delay--;
						document.getElementById("time").innerHTML = delay;
					} else {
						if(!url){
							history.back();
						}
						window.location.href = url;
					}
					setTimeout("delayURL(\'" + url + "\')", 1000);
				}
				delayURL("$url");
			</script>
			</body>
			</html>
EOT;
        echo $html;

    }
}
