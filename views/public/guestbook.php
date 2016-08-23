<div class="banner" style="background-image:url(<?=Yii::$app->params['imgHost'];?>front/images/auto_1139.jpg)"></div>
<?php
use \yii\helpers\Html;
use \yii\widgets\ActiveForm;
?>
<style>
	.help-block{color:red;}
</style>
<div class="main clearfix">
	<div class="left">
		<?=\app\widgets\ContactWidget::widget();?>
	</div>
	<div class="right">
		<div class="pfw">
			<div class="title">
				<h3>留言反馈</h3>
				<span class="breadcrumbs">
					您现在的位置：
					<a href="/" title="首页">首页</a>
					<span class="arrow">&gt;</span> 留言反馈
				</span>
			</div>
			<div class="message_post">
				<?php $form = ActiveForm::begin(['id' => 'form', 'options' => ['method' => 'post', 'class' => 'form']]);?>
					<input type="hidden" name="id" value="message">
					<div class="table clearfix" id="form_title">
						<div class="l"><label style="color:red;">*</label> 留言主题：</div>
						<div class="r"><?=$form->field($model, 'title')->textInput(['class' => 'inp inp_title', 'placeholder' => '不能超过30个字符长度'])->label(false);?>
						</div>
					</div>
					<div class="table clearfix" id="form_fullname">
						<div class="l"><label style="color:red;">*</label> 姓名：</div>
						<div class="r"><?=$form->field($model, 'username')->textInput(['class' => 'inp inp_title', 'placeholder' => '不能超过5个字符长度'])->label(false);?>
						</div>
					</div>
					<div class="table clearfix" id="form_mobile">
						<div class="l"><label style="color:red;">*</label> 手机号：</div>
						<div class="r"><?=$form->field($model, 'mobile')->textInput(['class' => 'inp inp_title', 'placeholder' => '必须填写11位手机号码'])->label(false);?>
						</div>
					</div>
					<div class="table clearfix" id="form_email">
						<div class="l"><label style="color:red;">*</label> 邮箱：</div>
						<div class="r"><?=$form->field($model, 'email')->textInput(['class' => 'inp inp_title', 'placeholder' => '必须为邮箱格式'])->label(false);?>
						</div>
					</div>
					<div class="table clearfix" id="form_content">
						<div class="l"><label style="color:red;">*</label> 内容：</div>
						<div class="r">
							<?=$form->field($model, 'content')->textarea(['style' => 'width:400px;height:100px;'])->label(false);?>
						</div>
					</div>
					<div class="table clearfix">
						<div class="l"><label style="color:red;">*</label> 验证码：</div>
						<div class="r">
							<?=$form->field($model, 'captcha')->widget(yii\captcha\Captcha::className()
    , ['captchaAction' => 'public/captcha',
        'imageOptions'     => ['alt' => '点击换图', 'title' => '点击换图', 'style' => 'cursor:pointer;vertical-align:bottom;', 'onclick' => "this.src=this.src+'?'+Math.random();"]])->label(false);?>
							<!--<img src="/public/captcha" border="0" align="absmiddle" class="hand" id="vcode" style='width:100px;' title='点击切换验证码' onclick="this.src=this.src+'?'+Math.random();"/>
							<input class="vcode" type="text" name="verifyCode" id="verifyCode">-->
						</div>
					</div>

					<div class="table clearfix">
						<div class="l">&nbsp;</div>
						<div class="r">
							<?=Html::submitButton('保存', ['class' => 'large button blue', 'name' => 'submit-button']);?>
						</div>
					</div>
				<?php ActiveForm::end();?>
			</div>
		</div>
	</div>
</div>