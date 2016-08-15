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
		<li><a href="/admin/friendlink">友情链接管理</a></li>
		<li><a href="javascript:void(0);"><?=$data['id'] ? '编辑' : '添加';?>友情链接</a></li>
	</ul>
</div>
<div class="formbody">
	<div class="formtitle"><span>友情链接信息</span></div>
	<?php $form = ActiveForm::begin(['id' => 'friendlink-form', 'options' => ['method' => 'post']]);?>
	<ul class="forminfo">
		<li><label>链接名：</label><?=$form->field($model, 'title')->textInput(['class' => 'dfinput','value'=>$data['title'],'disabled' => (isset($data['id']) ? true : false)])->label(false);?></li>

		<li><label>链接地址：</label><?=$form->field($model, 'url')->textInput(['class' => 'dfinput','value'=>$data['url']])->label(false);?></li>
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