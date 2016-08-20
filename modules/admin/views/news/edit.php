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
        <li><a href="javascript:void(0);"><?=$data['id'] ? '编辑' : '添加';?>新闻</a></li>
    </ul>
</div>

<div class="formbody">
<div id="usual1" class="usual">
<div class="itab">
  	<ul> 
        <li><a href="#tab1" class="selected"><?=$data['id'] ? '编辑' : '添加';?>新闻</a></a></li> 
  	</ul>
</div> 
<div id="tab1" class="tabson">
    <div class="formtext">新闻信息</div>
	<?php $form = ActiveForm::begin(['id' => 'news-form', 'options' => ['method' => 'post']]);?>
    <ul class="forminfo">
		<li>
			<label>新闻名称：<b>*</b></label>
			<?=$form->field($model, 'title')->textInput(['class' => 'dfinput','value'=>$data['title']])->label(false);?>
		</li>
		<li>
			<label>新闻分类：<b>*</b></label>
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
			<label>新闻状态：<b>*</b></label>
			<div class="vocation">
				<?=$form->field($model, 'status')->dropDownList(['1' => '发布', '2' => '不发布'], ['class' => 'select1', 'options' => [$data['status'] => ['selected' => 'selected']]])->label(false);?>
			</div>
		</li>
        <li>
            <label>新闻内容：<b>*</b></label>
			<?=$form->field($model, 'content')->textarea(['id' => 'content' ,'class' => 'content','value'=>Html::decode($data['content'])])->label(false);?>
        </li>
        <li>
            <?=$form->field($model, 'id')->hiddenInput(['value'=>$data['id']])->label(false);?>
            <label>&nbsp;</label><?=Html::submitButton('保存发布', ['class' => 'btn', 'name' => 'submit-button']);?>
		</li>
    </ul>
	<?php ActiveForm::end();?>
    </div> 
</div> 
