<?php
use \yii\helpers\Html;
use \yii\widgets\ActiveForm;
?>
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
		<li><a href="/admin/config">设置管理</a></li>
		<li><a href="javascript:void(0);"><?=$data['id'] ? '编辑' : '添加';?>设置</a></li>
	</ul>
</div>
<div class="formbody">
	<div class="formtitle"><span>设置信息</span></div>
	<?php $form = ActiveForm::begin(['id' => 'config-form', 'options' => ['method' => 'post']]);?>
	<ul class="forminfo">
		<li><label>设置标识：<b>*</b></label><?=$form->field($model, 'flag')->textInput(['class' => 'dfinput','value'=>$data['flag'],'disabled' => (isset($data['id']) ? true : false)])->label(false);?></li>
		
		<li>
            <label>设置内容：<b>*</b></label>
			<?=$form->field($model, 'content')->textarea(['class' => 'textinput','value'=>Html::decode($data['content'])])->label(false);?>
        </li>
		<li><label>设置描述：</label><?=$form->field($model, 'intro')->textInput(['class' => 'dfinput','value'=>$data['intro']])->label(false);?></li>
		<?=$form->field($model, 'id')->hiddenInput(['value'=>$data['id']])->label(false);?>
		<li><label>&nbsp;</label><?=Html::submitButton('保存', ['class' => 'btn', 'name' => 'submit-button']);?></li>
	</ul>
	<?php ActiveForm::end();?>
</div>