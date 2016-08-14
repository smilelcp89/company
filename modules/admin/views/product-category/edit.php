<?php
use \yii\helpers\Html;
use \yii\widgets\ActiveForm;
?>
<link href="<?=Yii::$app->params['imgHost'];?>backend/kindeditor/themes/default/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=Yii::$app->params['imgHost'];?>backend/kindeditor/kindeditor-min.js"></script>
<script type="text/javascript" src="<?=Yii::$app->params['imgHost'];?>backend/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
    var editor;
	var uploadUrl = '<?=Yii::$app->params['domain'];?>backend/kindeditor/php/upload_json.php';
    KindEditor.ready(function(K) {
        editor = K.create('#content', {
            allowFileManager : true,
            uploadJson : uploadUrl,
            fileManagerJson : '<?=Yii::$app->params['domain'];?>backend/kindeditor/php/file_manager_json.php',
        });

		var uploadbutton = K.uploadbutton({
			button : K('#file_upload')[0],
			fieldName : 'imgFile',
			url : uploadUrl,
			afterUpload : function(data) {
				if (data.error === 0) {
					var imgContent = '<p><img src="'+data.url+'" width="150" height="150"/><input type="hidden" value="'+data.url+'" name="productImgs[]" /><input type="button" class="ibtn" value="删除" onclick="deleteImg(this)" /></p>';
					$(".upload-pic").append(imgContent);
				} else {
					$.dialog.alert(data.message);
				}
			}
		});
		uploadbutton.fileBox.change(function(e) {
			uploadbutton.submit();
		});
    });
</script>
  
<script type="text/javascript">
$(function(e) {
    $(".select1").uedSelect({
		width : 150			  
	});
});
function deleteImg(obj){
	$(obj).parent().remove();
}
</script>

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
	.price{
		width:150px;
	}
	.intro{
		width:700px;height:250px;visibility:hidden;
	}
</style>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/admin">首页</a></li>
        <li><a href="/admin/product">产品管理</a></li>
        <li><a href="javascript:void(0);"><?=$data['id'] ? '编辑' : '添加';?>产品分类</a></li>
    </ul>
</div>

<div class="formbody">
<div id="usual1" class="usual">
<div class="itab">
  	<ul> 
        <li><a href="#tab1" class="selected"><?=$data['id'] ? '编辑' : '添加';?>产品分类</a></a></li> 
  	</ul>
</div> 
<div id="tab1" class="tabson">
	<?php $form = ActiveForm::begin(['id' => 'product-form', 'options' => ['method' => 'post']]);?>
    <ul class="forminfo">
		<li>
			<label>分类名称：<b>*</b></label>
			<?=$form->field($model, 'title')->textInput(['class' => 'dfinput','value'=>$data['title'],'maxlength' => 255])->label(false);?>
		</li>
        <li>
            <?=$form->field($model, 'id')->hiddenInput(['value'=>$data['id']])->label(false);?>
            <label>&nbsp;</label><?=Html::submitButton('保存', ['class' => 'btn', 'name' => 'submit-button']);?>
		</li>
    </ul>
	<?php ActiveForm::end();?>
    </div> 
</div> 
