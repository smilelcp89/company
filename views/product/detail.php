<script type="text/javascript">
function order_create()
{
	$.dialog({
		'title':"订购咨询服务",
		'lock':true,
		'drag':false,
		'content':document.getElementById('zxform'),
		'fixed':true
	});
}
$(document).ready(function(){
	$("#furl").val('http://company.local.com/1474.html');
	$("#form_furl").hide();
	$("#postform").submit(function(){
		if(!$("#fullname").val()){
			$.dialog.alert('请填写您的姓名');
			return false;
		}
		if(!$("#mobile").val()){
			$.dialog.alert('请留下您的手机号');
			return false;
		}
		if(!$("#note").val()){
			$.dialog.alert('请填写您要咨询的内容');
			return false;
		}
		$(this).ajaxSubmit({
			'url':api_url('post','save'),
			'type':'post',
			'dataType':'json',
			'success':function(rs){
				if(rs.status == 'ok'){
					$.dialog.alert('感觉您提交的咨询服务，我们客服会尽快与您取得联系',function(){
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
<div class="banner" style="background-image:url(<?=Yii::$app->params['imgHost'];?>front/images/auto_1136.jpg)"></div>
<div id="zxform" style="display:none;">
	<form method="post" class="form" id="postform">
	<input type="hidden" name="id" value="zxservice">
		<div class="table">
		<div class="l">产品名称：</div>
		<div class="r"><input type="text" name="title" id="title" value="华为 Ascend P7 (P7-L05/L07) 白 移动4G手机" class="input noborder red" readonly=""></div>
	</div>
		<div class="table" id="form_fullname">
		<div class="l">姓名：</div>
		<div class="r"><input type="text" id="fullname" class="inp inp_fullname" name="fullname" style="width:300px" value="" placeholder="">
</div>
	</div>
		<div class="table" id="form_mobile">
		<div class="l">手机号：</div>
		<div class="r"><input type="text" id="mobile" class="inp inp_mobile" name="mobile" style="width:300px" value="" placeholder="">
</div>
	</div>
		<div class="table" id="form_note">
		<div class="l">咨询内容：</div>
		<div class="r"><table style="border:0;margin:0;padding:0" cellpadding="0" cellspacing="0"><tbody><tr><td><textarea name="note" id="note" phpok_id="textarea" style=";width:300px;height:80px" placeholder="请填写要咨询的内容"></textarea></td></tr></tbody></table></div>
	</div>
		<div class="table" id="form_furl" style="display: none;">
		<div class="l">产品网址：</div>
		<div class="r"><input type="text" id="furl" class="inp inp_furl" name="furl" style="width:300px" value="" placeholder="">
</div>
	</div>
			<div class="table" id="form_furl">
		<div class="l">验证码：</div>
		<div class="r">
			<input class="vcode" type="text" name="_chkcode" id="_chkcode">
			<img src="" border="0" alt="验证码图片" align="absmiddle" id="vcode" class="hand">
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#vcode").phpok_vcode();
		$("#vcode").click(function(){
			$(this).phpok_vcode();
		});
	});
	</script>
		<div class="table">
		<div class="l">&nbsp;</div>
		<div class="r"><input type="submit" value="提交" class="large button blue"></div>
	</div>
	</form>
</div>
<div class="main clearfix">
	<div class="left">
		<div class="pfw">
	<div class="title"><h3>产品展示</h3></div>
	<ul class="artlist">
						<li class="current"><a href="http://company.local.com/product/cpfly.html" title="产品分类一">产品分类一</a></li>
				<li><a href="http://company.local.com/product/cpfle.html" title="产品分类二">产品分类二</a></li>
				<li><a href="http://company.local.com/product/cpfls.html" title="产品分类三">产品分类三</a></li>
			</ul>
</div>		<div class="pfw">
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
				<h3>产品分类一</h3>
				<span class="breadcrumbs">
					您现在的位置：
					<a href="http://company.local.com/" title="第一">首页</a>
					<span class="arrow">&gt;</span> <a href="http://company.local.com/product.html" title="产品展示">产品展示</a>
										<span class="arrow">&gt;</span> <a href="http://company.local.com/product/cpfly.html" title="产品分类一">产品分类一</a>
									</span>
			</div>
			<div class="product clearfix">
				<div class="img" id="product_img">
					<ul class="list" style="position: relative; width: 400px; height: 400px;">
												<li style="position: absolute; width: 400px; left: 0px; top: 0px; display: list-item;"><img src="<?=Yii::$app->params['domain'];?>front/images/auto_1125.jpg" border="0" alt="华为 Ascend P7 (P7-L05/L07) 白 移动4G手机"></li>
												<li style="position: absolute; width: 400px; left: 0px; top: 0px; display: none;"><img src="<?=Yii::$app->params['domain'];?>front/images/auto_1126.jpg" border="0" alt="华为 Ascend P7 (P7-L05/L07) 白 移动4G手机"></li>
											</ul>
					<ul class="thumb_list">
												<li class="on"><img src="<?=Yii::$app->params['domain'];?>front/images/thumb_1125.jpg" border="0" alt="001"></li>
												<li class=""><img src="<?=Yii::$app->params['domain'];?>front/images/thumb_1126.jpg" border="0" alt="002"></li>
											</ul>
				</div>
				<script type="text/javascript">
				$(document).ready(function(){
					$("#product_img").slide({
						'titCell':'ul.thumb_list li',
						'mainCell':'ul.list',
						'autoPlay':true,
						'switchLoad':"_src",
						'effect':"fold"
					});
				});
				</script>
				<div class="info">
					<h1>华为 Ascend P7 (P7-L05/L07) 白 移动4G手机</h1>
					<p>查看：90</p>
					<p>时间：2015-12-14</p>
										<p>型号：P7</p>
										<p>大小：139.8mm（长）×68.8 mm（宽）×6.5 mm（厚）</p>
										<p>外观：白色</p>
										<p>重量：124g</p>
															<p><span>价格：</span><span class="price">1299.00 元</span></p>
										<p style="padding-top:10px;">
						<input type="button" value="立即咨询" onclick="order_create()" class="large red button">
					</p>
				</div>
			</div>

			<div class="detail product_info">
				<div class="content"><p>2014年5月7日，华为在巴黎发布了2014旗舰机型P7。P7配置5英寸1080P全高清屏幕，采用金属+双玻璃结构，机身厚度仅6.5mm，支持CAT4&nbsp;LTE网络，五月起在中国大陆等30多个国家及地区开售，全球售价449欧元，中国大陆售价为人民币2888元。</p><p>华为P7正面采用5寸1080p屏，有着6.5mm的极致超薄机身，拍照方面有着前置800万+后置1300万摄像头组合，内置1.8GHz海思Kirin910T四核处理器，有着2GBRAM+16GBROM机身存储，后置不可拆卸的2500mAh电池，支持CAT4LTE4G网络。华为Ascend P7分辨率为1920X1080像素的FHD级别，显示效果非常细腻。核心方面内置一颗主频1.8GHz海思Kirin 910T四核芯处理器，以及2GB RAM+16GB ROM的内存组合，流畅运行基于Android 4.4系统的Emotion UI 2.3用户界面。</p><p>华为P7共有黑色，白色，粉色三种配色可选，已于2014年5月在中国开售。华为商城、京东、天猫华为旗舰店、苏宁易购、国美在线、1号店、亚马逊七大电商平台同步启动预售。</p><p>配置：</p><blockquote><p>华为Emotion系统2.3（兼容Android4.4）</p><p>1.8GHz四核处理器</p><p>5.0英寸Incell屏幕</p><p>2500mAh大容量电池（典型值：2530mAh，最小值：2460mAh）</p><p>MicroSIM+NanoSIM双卡</p><p>16GBROM+2GBRAM</p><p>LTE高速网络，支持CAT4150Mbps</p><p>WLAN802.11b/g/n，支持便携式WLAN热点</p><p>1300万像素主摄像头+800万像素副摄像头，独立专业图像处理芯片</p><p><br></p><p><br></p><p>合并图册&nbsp;(2张)</p><p>DTS音效</p><p><br></p><p>DLNA</p><p>BT4.0，支持BT4.0BLE</p><p>十级美肤自拍</p><p>全景自拍</p><p>水印照片</p><p>极速抓拍</p><p>简易桌面（SimpleUI）</p><p>杂志锁屏</p><p>语音查找联系人</p><p>极限省电模式</p><p><br></p></blockquote></div>
				<div class="np">
					<p>上一主题：
																		<a href="http://company.local.com/1473.html" title="魅族 MX4 16GB 灰色 移动4G手机">魅族 MX4 16GB 灰色 移动4G手机</a>
											</p>
					<p>下一主题：
																		没有了
											</p>
				</div>
					      
				</div>
			</div>
		</div>
	</div>
</div>