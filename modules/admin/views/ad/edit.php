<?php
use \yii\helpers\Html;
use \yii\widgets\ActiveForm;
?>
<link href="<?=Yii::$app->params['imgHost'];?>backend/kindeditor/themes/default/default.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.upload-pic{
		margin-left:85px;padding-bottom:10px;width:550px;
	}
	.upload-pic p{
		margin-top:10px;
		margin-bottom:10px;
		margin-right:15px;
		width:160px;
		height:190px;
		float:left;
	}
	.upload-pic p img{
		margin-bottom:5px;
	}
</style>
<script type="text/javascript" src="<?=Yii::$app->params['imgHost'];?>backend/kindeditor/kindeditor-min.js"></script>
<script type="text/javascript" src="<?=Yii::$app->params['imgHost'];?>backend/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
    var editor;
	var uploadUrl = '<?=Yii::$app->params['domain'];?>backend/kindeditor/php/upload_json.php';
    KindEditor.ready(function(K) {
		var uploadbutton = K.uploadbutton({
			button : K('#file_upload')[0],
			fieldName : 'imgFile',
			url : uploadUrl,
			afterUpload : function(data) {
				if (data.error === 0) {
					var imgContent = '<p><img src="'+data.url+'" width="392" height="120"/><input type="hidden" value="'+data.url+'" name="Ad[logo]" /><input type="button" class="ibtn" value="删除" onclick="deleteImg(this)" /></p>';
					$(".upload-pic").html(imgContent);
				} else {
					$.dialog.alert(data.message);
				}
			}
		});
		uploadbutton.fileBox.change(function(e) {
			uploadbutton.submit();
		});
    });
	function deleteImg(obj){
		$(obj).parent().remove();
	}
</script>
<script type="text/javascript">
$(function(e) {
    $(".select1").uedSelect({
		width : 150			  
	});
});
</script>
<div class="place">
	<span>位置：</span>
	<ul class="placeul">
		<li><a href="/admin">首页</a></li>
		<li><a href="/admin/ad">广告管理</a></li>
		<li><a href="javascript:void(0);"><?=$data['id'] ? '编辑' : '添加';?>广告</a></li>
	</ul>
</div>
<div class="formbody">
	<div class="formtitle"><span>广告信息</span></div>
	<?php $form = ActiveForm::begin(['id' => 'ad-form', 'options' => ['method' => 'post']]);?>
	<ul class="forminfo">
		<li><label>广告名：<b>*</b></label><?=$form->field($model, 'title')->textInput(['class' => 'dfinput','value'=>$data['title'],'disabled' => (isset($data['id']) ? true : false)])->label(false);?></li>

		<li>
            <label>广告图片：<b>*</b></label>
			<input type="button" name="file_upload" id="file_upload" value="浏览文件" />
			<span style="color:red;margin-top:3px;">请上传980*300像素大小的图片</span>
			<div class="upload-pic">
				<?php if(isset($data['logo'])):?>
				<p>
					<img src="<?=$data['logo']?>" width="392" height="120"/>
					<input type="hidden" value="<?=$data['logo']?>" name="Ad[logo]" />
					<input type="button" class="ibtn" onclick="deleteImg(this)" value="删除" />
				</p>
				<?php endif;?>
			</div>
        </li>

		<li><label>链接地址：<b>*</b></label><?=$form->field($model, 'url')->textInput(['class' => 'dfinput','value'=>$data['url']])->label(false);?></li>
		<li>
			<label>是否启用：</label>
			<div class="vocation">
				<?=$form->field($model, 'status')->dropDownList(['1' => '是', '2' => '否'], ['class' => 'select1','options' => [$data['status'] => ['selected' => 'selected']]])->label(false);?>
			</div>
		</li>
		<?=$form->field($model, 'id')->hiddenInput(['value'=>$data['id']])->label(false);?>
		<li><label>&nbsp;</label><?=Html::submitButton('保存', ['class' => 'btn', 'name' => 'submit-button']);?></li>
	</ul>
	<?php ActiveForm::end();?>
</div>