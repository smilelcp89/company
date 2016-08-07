<?php
use \yii\helpers\Html;
use \yii\widgets\ActiveForm;
?>
<div class="place">
	<span>位置：</span>
	<ul class="placeul">
		<li><a href="/admin">首页</a></li>
		<li><a href="/admin/config">网站配置</a></li>
		<li><a href="javascript:void(0);"><?=$data['id'] ? '编辑' : '添加';?>配置</a></li>
	</ul>
</div>
<div class="formbody">
	<div class="formtitle"><span>配置信息</span></div>
	<?php $form = ActiveForm::begin(['id' => 'user-form', 'options' => ['method' => 'post']]);?>
	<ul class="forminfo">
		<li><label>标识符：</label><?=$form->field($model, 'flag')->textInput(['class' => 'dfinput','value'=>$data['flag'],'disabled' => (isset($data['id']) ? true : false)])->label(false);?></li>

		<li><label>内　容：</label><?=$form->field($model, 'content')->textInput(['class' => 'dfinput','placeholder'=>$placeholder,'value'=>$data['content']])->label(false);?></li>
		<li><label>描　述：</label><?=$form->field($model, 'intro')->textInput(['class' => 'dfinput','value'=>$data['intro']])->label(false);?></li>
		<?=$form->field($model, 'id')->hiddenInput(['value'=>$data['id']])->label(false);?>
		<li><label>&nbsp;</label><?=Html::submitButton('保存', ['class' => 'btn', 'name' => 'submit-button']);?></li>
	</ul>
	<?php ActiveForm::end();?>
</div>
