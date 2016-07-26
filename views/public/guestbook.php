<div class="banner" style="background-image:url(<?=Yii::$app->params['imgHost'];?>front/images/auto_1139.jpg)"></div>
<script type="text/javascript">
$(document).ready(function(){
	$("#postform").submit(function(){
		if(!$("#title").val()){
			$.dialog.alert('请填写留言主题');
			return false;
		}
		if(!$("#fullname").val()){
			$.dialog.alert('请填写您的姓名');
			return false;
		}
		if(!$("#email").val() && !$("#mobile").val()){
			$.dialog.alert('请留下您的联系方式，邮箱或者手机');
			return false;
		}
		if(!$("#content").val()){
			$.dialog.alert('请填写您要咨询的内容');
			return false;
		}
		$(this).ajaxSubmit({
			'url':api_url('post','save'),
			'type':'post',
			'dataType':'json',
			'success':function(rs){
				if(rs.status == 'ok'){
					$.dialog.alert('感觉您提交的留言，我们会尽快处理您的留言',function(){
						$.phpok.reload();
					},'succeed');
				}else{
					$.dialog.alert(rs.content);
					return false;
				}
			}
		});
		return false;
	});
});
</script>
<div class="main clearfix">
	<div class="left">
		<div class="pfw">
	<div class="title"><h3>联系我们</h3></div>
	<div class="info contact_info">
		<h4>深圳市锟铻科技有限公司</h4>
		<ul>
			<li><i>联系人：</i>苏先生</li>
			<li><i>电　话：</i>15818533971</li>
			<li><i>邮　箱：</i>admin@phpok.com</li>
		</ul>
	</div>
</div>	</div>
	<div class="right">
		<div class="pfw">
			<div class="title">
				<h3>在线留言</h3>
				<span class="breadcrumbs">
					您现在的位置：
					<a href="http://company.local.com/" title="第一">首页</a>
					<span class="arrow">&gt;</span> <a href="http://company.local.com/message.html" title="在线留言">在线留言</a>
				</span>
			</div>
			<div class="message_post">
		<form method="post" class="form" id="postform">
			<input type="hidden" name="id" value="message">
			<div class="table clearfix" id="form_title">
				<div class="l">留言主题：</div>
				<div class="r"><input type="text" id="title" class="inp inp_title" name="title" style="width:300px" value="" placeholder="">
				</div>
			</div>
			<div class="table clearfix" id="form_fullname">
				<div class="l">姓名：</div>
				<div class="r"><input type="text" id="fullname" class="inp inp_fullname" name="fullname" style="width:300px" value="" placeholder="">
				</div>
			</div>
			<div class="table clearfix" id="form_mobile">
				<div class="l">手机号：</div>
				<div class="r"><input type="text" id="mobile" class="inp inp_mobile" name="mobile" style="width:300px" value="" placeholder="">
				</div>
			</div>
			<div class="table clearfix" id="form_email">
				<div class="l">邮箱：</div>
				<div class="r"><input type="text" id="email" class="inp inp_email" name="email" style="width:300px" value="" placeholder="">
				</div>
			</div>
			<div class="table clearfix" id="form_content">
				<div class="l">内容：</div>
				<div class="r"><table style="border:0;margin:0;padding:0" cellpadding="0" cellspacing="0"><tbody><tr><td><textarea name="content" id="content" phpok_id="textarea" style=";width:500px;height:200px" placeholder=""></textarea></td></tr></tbody></table></div>
			</div>
			<div class="table clearfix">
				<div class="l">验证码：</div>
				<div class="r">
					<input class="vcode" type="text" name="_chkcode" id="_chkcode">
					<img src="#" border="0" align="absmiddle" id="vcode" class="hand">
				</div>
			</div>

			<div class="table clearfix">
				<div class="l">&nbsp;</div>
				<div class="r"><input type="submit" value="提交" class="large button blue"></div>
			</div>
		</form>
			</div>
		</div>
				</div>
</div>