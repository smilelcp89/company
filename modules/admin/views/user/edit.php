<?php
use \yii\helpers\Html;
use \yii\widgets\ActiveForm;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加用户</title>
<link href="<?=Yii::$app->params['imgHost'];?>admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::$app->params['imgHost'];?>admin/css/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=Yii::$app->params['imgHost'];?>admin/js/jquery.js"></script>
<script type="text/javascript" src="<?=Yii::$app->params['imgHost'];?>admin/js/select-ui.min.js"></script>
</head>

<body>
	<div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="/admin">首页</a></li>
            <li><a href="javascript:void(0);">添加用户</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle"><span>用户信息</span></div>
        <?php $form = ActiveForm::begin(['id' => 'user-form', 'options' => ['method' => 'post']]);?>
        <ul class="forminfo">
            <li><label>用户名：</label><?=$form->field($model, 'username')->textInput(['class' => 'dfinput'])->label(false);?><!--<i>不能修改</i>--></li>
            <li><label>密　码：</label><?=$form->field($model, 'password')->passwordInput(['class' => 'dfinput'])->label(false);?></li>
            <li><label>邮　箱：</label><?=$form->field($model, 'email')->textInput(['class' => 'dfinput'])->label(false);?></li>
            <li><label>手机号：</label><?=$form->field($model, 'mobile')->textInput(['class' => 'dfinput'])->label(false);?></li>
            <li>
                <label>状　态：</label>
                <div class="vocation">
					<?=$form->field($model, 'status')->dropDownList(['1' => '正常', '2' => '禁用'], ['class' => 'select1'])->label(false);?>
                </div>
            </li>
            <li><label>&nbsp;</label><?=Html::submitButton('保存', ['class' => 'btn', 'name' => 'submit-button']);?></li>
        </ul>
        <?php ActiveForm::end();?>
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function(e) {
        $(".select1").uedSelect({
            width : 100
        });
    });
</script>
</html>
