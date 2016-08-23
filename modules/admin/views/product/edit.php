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
			url : '/admin/upload',
			afterUpload : function(data) {
				if (data.code == 1000) {
					var imgContent = '<p><img src="'+data.content.url+'" width="150" height="150"/><input type="hidden" value="'+data.content.url+'" name="productImgs[]" /><input type="button" class="ibtn" value="删除" onclick="deleteImg(this)" /></p>';
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
        <li><a href="javascript:void(0);"><?=$data['id'] ? '编辑' : '添加';?>产品</a></li>
    </ul>
</div>

<div class="formbody">
<div id="usual1" class="usual">
<div class="itab">
  	<ul> 
        <li><a href="#tab1" class="selected"><?=$data['id'] ? '编辑' : '添加';?>产品</a></a></li> 
  	</ul>
</div> 
<div id="tab1" class="tabson">
    <div class="formtext">产品信息</div>
	<?php $form = ActiveForm::begin(['id' => 'product-form', 'options' => ['method' => 'post']]);?>
    <ul class="forminfo">
		<li>
			<label>产品名称：<b>*</b></label>
			<?=$form->field($model, 'title')->textInput(['class' => 'dfinput','value'=>$data['title']])->label(false);?>
		</li>
        <li style="width:1000px;">
            <label>上传图片：<b>*</b></label>
			<input type="button" name="file_upload" id="file_upload" value="浏览文件" />
			<span style="color:red;margin-top:3px;">请上传大于400*400像素，1:1比例的图片</span>
			<div class="upload-pic">
				<?php if(!empty($data['images_list'])):?>
				<?php foreach($data['images_list'] as $img):?>
				<p>
					<img src="<?=$img?>" width="150" height="150"/>
					<input type="hidden" value="<?=$img?>" name="productImgs[]" />
					<input type="button" class="ibtn" onclick="deleteImg(this)" value="删除" />
				</p>
				<?php endforeach;?>
				<?php endif;?>
			</div>
        </li>
		<li>
			<label>产品价格：<b>*</b></label>
			<?=$form->field($model, 'sale_price')->textInput(['class' => 'dfinput price','value'=>$data['sale_price']])->label(false);?>
		</li>
		<li>
			<label>产品分类：<b>*</b></label>
			<div class="vocation">
				<?=$form->field($model, 'cate_id')->dropDownList($cateArr, ['class' => 'select1','prompt'=> '请选择分类','options' => [$data['cate_id'] => ['selected' => 'selected']]])->label(false);?>
			</div>
		</li>
		<li>
			<label>是否推荐：<b>*</b></label>
			<div class="vocation">
				<?=$form->field($model, 'is_recommend')->dropDownList(['2' => '否', '1' => '是'], ['class' => 'select1','options' => [$data['is_recommend'] => ['selected' => 'selected']]])->label(false);?>
			</div>
		</li>
		<li>
			<label>产品状态：<b>*</b></label>
			<div class="vocation">
				<?=$form->field($model, 'status')->dropDownList(['1' => '上架', '2' => '下架'], ['class' => 'select1','options' => [$data['status'] => ['selected' => 'selected']]])->label(false);?>
			</div>
		</li>
        <li>
            <label>产品描述：<b>*</b></label>
			<?=$form->field($model, 'intro')->textarea(['id' => 'content' ,'class' => 'intro','value'=>Html::decode($data['intro'])])->label(false);?>
        </li>
		<li>
            <label>SEO标题：</label>
            <?=$form->field($model, 'seo_title')->textInput(['class' => 'dfinput','value'=>$data['seo_title']])->label(false);?>
        </li>
		<li>
            <label>SEO关键字：</label>
            <?=$form->field($model, 'seo_keywords')->textInput(['class' => 'dfinput','value'=>$data['seo_keywords']])->label(false);?>
        </li>
		<li>
            <label>SEO描述：</label>
            <?=$form->field($model, 'seo_descpition')->textInput(['class' => 'dfinput','value'=>$data['seo_descpition']])->label(false);?>
        </li>
        <li>
            <?=$form->field($model, 'id')->hiddenInput(['value'=>$data['id']])->label(false);?>
            <label>&nbsp;</label><?=Html::submitButton('保存发布', ['class' => 'btn', 'name' => 'submit-button']);?>
		</li>
    </ul>
	<?php ActiveForm::end();?>
    </div> 
</div> 
