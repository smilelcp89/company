<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>">
<title>后台管理</title>
<link href="<?=Yii::$app->params['imgHost'];?>backend/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::$app->params['imgHost'];?>backend/css/select.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::$app->params['imgHost'];?>backend/css/artdialog.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=Yii::$app->params['imgHost'];?>backend/js/jquery.js"></script>
<script type="text/javascript" src="<?=Yii::$app->params['imgHost'];?>backend/js/select-ui.min.js"></script>
<script type="text/javascript" src="<?=Yii::$app->params['imgHost'];?>backend/js/jquery.artdialog.js"></script>
<script type="text/javascript" src="<?=Yii::$app->params['imgHost'];?>backend/js/public.js"></script>
<script type="text/javascript">
	var csrfToken = "<?= Yii::$app->request->csrfToken ?>";
</script>
</head>
<body>
<?= $content ?>
</body>
</html>