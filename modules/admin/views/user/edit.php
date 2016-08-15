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
		<li><a href="/admin/user">用户管理</a></li>
		<li><a href="javascript:void(0);"><?=$data['id'] ? '编辑' : '添加';?>用户</a></li>
	</ul>
</div>
<div class="formbody">
	<div class="formtitle"><span>用户信息</span></div>
	<?php $form = ActiveForm::begin(['id' => 'user-form', 'options' => ['method' => 'post']]);?>
	<ul class="forminfo">
		<li><label>用户名：</label><?=$form->field($model, 'username')->textInput(['class' => 'dfinput','value'=>$data['username'],'disabled' => (isset($data['id']) ? true : false)])->label(false);?></li>

		<?php $placeholder = isset($data['id']) ? '密码留空不做修改' : '';?>
		<li><label>密　码：</label><?=$form->field($model, 'password')->passwordInput(['class' => 'dfinput','placeholder'=>$placeholder])->label(false);?></li>
		<li><label>邮　箱：</label><?=$form->field($model, 'email')->textInput(['class' => 'dfinput','value'=>$data['email']])->label(false);?></li>
		<li><label>手机号：</label><?=$form->field($model, 'mobile')->textInput(['class' => 'dfinput','value'=>$data['mobile']])->label(false);?></li>
		<li>
			<label>状　态：</label>
			<div class="vocation">
				<?=$form->field($model, 'status')->dropDownList(['1' => '正常', '2' => '禁用'], ['class' => 'select1','options' => [$data['status'] => ['selected' => 'selected']]])->label(false);?>
			</div>
		</li>
		<?=$form->field($model, 'id')->hiddenInput(['value'=>$data['id']])->label(false);?>
		<li><label>&nbsp;</label><?=Html::submitButton('保存', ['class' => 'btn', 'name' => 'submit-button']);?></li>
	</ul>
	<?php ActiveForm::end();?>
</div>