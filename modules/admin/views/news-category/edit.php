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
    });
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
        <li><a href="/admin/news">新闻管理</a></li>
        <li><a href="javascript:void(0);"><?=$data['id'] ? '编辑' : '添加';?>新闻分类</a></li>
    </ul>
</div>

<div class="formbody">
<div id="usual1" class="usual">
<div class="itab">
  	<ul> 
        <li><a href="#tab1" class="selected"><?=$data['id'] ? '编辑' : '添加';?>新闻分类</a></a></li> 
  	</ul>
</div> 
<div id="tab1" class="tabson">
	<?php $form = ActiveForm::begin(['id' => 'news-form', 'options' => ['method' => 'post']]);?>
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
