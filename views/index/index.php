<?php use yii\helpers\Url;?>
<div class="indexbanner" style="height:300px;">
	<div class="bd">
		<ul>
			<?php if (!empty($adsList)): ?>
			<?php foreach ($adsList as $key => $item): ?>
			<li style="display: <?=$key == 0 ? 'list-item' : 'none';?>;"><a href="<?=$item['url'];?>" target="_blank"><img class="lazy" data-original="<?=str_replace('_middle', '_big', $item['logo']);?>" title="<?=$item['title'];?>" style="width:980px;height:300px;"></a></li>
			<?php endforeach;?>
			<?php endif;?>
		</ul>
	</div>
	<div class="hd">
		<ul>
			<?php if (!empty($adsList)): ?>
			<?php foreach ($adsList as $key => $item): ?>
			<li class="<?=$key == 0 ? 'on' : '';?>"></li>
			<?php endforeach;?>
			<?php endif;?>
		</ul>
	</div>
</div>
<div class="main index clearfix">
	<div class="left">
			<div class="pfw">
			<div class="title"><h3>新闻中心</h3><a class="more" href="<?=Url::to(['news/index']);?>">更多</a></div>
			<ul class="artlist" style="height:295px;">
				<?php if (!empty($newsList)): ?>
				<?php foreach ($newsList as $key => $item): ?>
				<li><a href="<?=Url::to(['news/detail', 'id' => $item['id']]);?>" title="<?=$item['title'];?>"><?=\app\components\Common::truncate($item['title'], 15);?></a><?=$item['is_recommend'] == 1 ? ' <label style="color:red;">[荐]<label>' : '';?></li>
				<?php endforeach;?>
				<?php endif;?>
			</ul>
		</div>
	</div>
	<div class="middle">
		<div class="pfw">
			<div class="title"><h3>推荐产品</h3><a class="more" href="<?=Url::to(['product/index']);?>">更多</a></div>
			<ul class="piclist">
				<?php if (!empty($recommendProducts)): ?>
				<?php foreach ($recommendProducts as $key => $item): ?>
				<li <?=($key % 3 == 2) ? 'class="last"' : '';?>>
					<div class="pic"><img class="lazy" data-original="<?=$item['logo'];?>" width="120"></div>
					<div class="txt"><a href="<?=Url::to(['product/detail', 'id' => $item['id']]);?>" title="<?=$item['title'];?>"><?=\app\components\Common::truncate($item['title'], 30);?></a></div>
				</li>
				<?php endforeach;?>
				<?php endif;?>
			</ul>
		</div>
	</div>
	<div class="right">
		<div class="pfw clearfix">
			<div class="title"><h3>公司简介</h3><a class="more" href="<?=Url::to(['public/about']);?>">更多</a></div>
			<div class="about"><?=\app\components\Common::truncate(\app\services\CacheService::getConfigsFromCache('company_intro', true), 120);?></div>
		</div>
		<?=\app\widgets\ContactWidget::widget();?>
	</div>
	<div class="clear"></div>
		<div class="pfw">
		<div class="title"><h3>产品展示</h3><a class="more" href="<?=Url::to(['product/index']);?>">更多</a></div>
		<ul class="product clearfix">
			<?php if (!empty($productList)): ?>
			<?php foreach ($productList as $item): ?>
			<li>
				<div class="img">
					<a href="<?=Url::to(['product/detail', 'id' => $item['id']]);?>" title="<?=$item['title'];?>"><img class="lazy" data-original="<?=isset($item['images_list'][0]) ? $item['images_list'][0] : $item['logo'];?>" border="0" id="product_<?=$item['id'];?>"></a>
				</div>
				<div class="imglist clearfix">
					<?php if (!empty($item['images_list'])): ?>
					<?php foreach ($item['images_list'] as $key => $img): ?>
						<div class="thumb <?=$key == 0 ? 'hover' : '';?>" data="<?=$img;?>" data-id="<?=$item['id'];?>"><img class="lazy" data-original="<?=str_replace('_middle', '_small', $img);?>" border="0"></div>
					<?php endforeach;?>
					<?php endif;?>
				</div>
				<h4><a href="<?=Url::to(['product/detail', 'id' => $item['id']]);?>" title="<?=\app\components\Common::truncate($item['title'], 30);?>"><?=\app\components\Common::truncate($item['title'], 30);?></a></h4>
			</li>
			<?php endforeach;?>
			<?php endif;?>
		</ul>
	</div>
</div>
<script type="text/javascript" src="<?=Yii::$app->params['imgHost'];?>static/js/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="<?=Yii::$app->params['imgHost'];?>front/js/slide.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".indexbanner").slide({'autoPlay':true,'switchLoad':'_src','mainCell':'.bd ul'});
		$(".thumb").mouseover(function(){
			var pid = $(this).attr('data-id');
			var thumb = $(this).attr('data');
			$("#product_"+pid).attr("src",thumb);
			$(".thumb[data-id="+pid+"]").removeClass("hover");
			$(this).addClass('hover');
		});
		//懒加载图片
		$("img.lazy").lazyload({
			effect : "fadeIn"
		});
	});
</script>