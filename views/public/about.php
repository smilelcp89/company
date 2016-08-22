<?php use yii\helpers\Url; ?>
<div class="banner" style="background-image:url(<?=Yii::$app->params['imgHost'];?>front/images/auto_1134.jpg)"></div>
<div class="main clearfix">
	<div class="left">
		<div class="pfw">
			<div class="title"><h3>关于我们</h3></div>
			<ul class="artlist">
				<li><a href="<?=Url::to(['public/about']);?>" title="关于公司">关于我们</a></li>
				<li><a href="<?=Url::to(['public/contact']);?>" title="联系我们">联系我们</a></li>
			</ul>
		</div>		
		<?=\app\widgets\ContactWidget::widget()?>
	</div>
	<div class="right">
		<div class="pfw">
			<div class="title">
				<h3>公司简介</h3>
				<span class="breadcrumbs">
					您现在的位置：
					<a href="/" title="首页">首页</a>
					<span class="arrow">&gt;</span> 关于我们
				</span>
			</div>
			<div class="detail">
				<div class="content">
					<?=\app\services\CacheService::getConfigsFromCache('company_intro');?>
				</div>
			</div>
		</div>
	</div>
</div>