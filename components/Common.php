<?php

namespace app\components;

//公共方法类
use app\constants\Session;

class Common
{
    /**
     * 提示信息
     */
    public static function message($type, $content, $url = '')
    {
        $referer = \Yii::$app->request->getReferrer();
        $click   = $url ? $url : ($referer ? $referer : 'javascript:history.back()');
        $html    = <<<EOT
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
						<p>系统自动跳转，如果不想等待，<a style="color:#29a2da;text-decoration:none;" href="$click">点击这里跳转</a></p>
					</div>
				</div>
			</div>
			<script type="text/javascript">

			    var url = "$url";
			    setTimeout(function(){
			        if(url){
			            window.location.href = url;
			        }else{
			            history.back();
			        }
			    }, 2000);

			</script>
			</body>
			</html>
EOT;
        echo $html;
        exit();

    }

    //打印信息
    public static function dump($var, $echo = true, $label = null, $strict = true)
    {
        $label = ($label === null) ? '' : rtrim($label) . ' ';
        if (!$strict) {
            if (ini_get('html_errors')) {
                $output = print_r($var, true);
                $output = "<pre>" . $label . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
            } else {
                $output = $label . print_r($var, true);
            }
        } else {
            ob_start();
            var_dump($var);
            $output = ob_get_clean();
            if (!extension_loaded('xdebug')) {
                $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            }
        }
        if ($echo) {
            echo $output;
            return null;
        } else {
            return $output;
        }
    }

    //打印信息
    public static function p($var)
    {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }

    //是否登陆，如果是返回登陆信息
    public static function isLogin()
    {
        $loginUserInfo = \Yii::$app->session->get(Session::LOGIN_USER_INFO);
        if (empty($loginUserInfo)) {
            return false;
        }
        return $loginUserInfo;
    }

    //获取登陆用户信息
    public static function getLoginUserInfo($field = '')
    {
        $loginUserInfo = \Yii::$app->session->get(Session::LOGIN_USER_INFO);
        if ($field && isset($loginUserInfo[$field])) {
            return $loginUserInfo[$field];
        }
        return $loginUserInfo;
    }

    //输入json
    public static function echoJson($code, $message, $content = [], $return = false)
    {
        $result = json_encode([
            'code'    => $code,
            'message' => $message,
            'content' => $content,
        ]);
        if ($return) {
            return $result;
        }
        exit($result);
    }

    //截取字符串
    public static function truncate($string, $length, $etc = '...')
    {
        $result = '';
        $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
        $strlen = strlen($string);
        for ($i = 0; (($i < $strlen) && ($length > 0)); $i++)
        {
            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0'))
            {
                if ($length < 1.0)
                {
                    break;
                }
                $result .= substr($string, $i, $number);
                $length -= 1.0;
                $i += $number - 1;
            }
            else
            {
                $result .= substr($string, $i, 1);
                $length -= 0.5;
            }
        }
        $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
        if ($i < $strlen)
        {
            $result .= $etc;
        }
        return $result;
    }
}
