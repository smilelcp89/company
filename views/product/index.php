<?php use yii\helpers\Url;?>
<div class="banner" style="background-image:url(<?=Yii::$app->params['imgHost'];?>front/images/auto_1136.jpg)"></div>
<div class="main clearfix">
	<div class="left">
		<div class="pfw">
		<div class="title"><h3>产品展示</h3></div>
			<ul class="artlist">
				<?php if(!empty($productCategoryList)):?>
				<?php foreach($productCategoryList as $row):?>
				<li><a href="<?=Url::to(['product/index','cateId'=>$row['id']])?>"><?=$row['title']?></a></li>
				<?php endforeach;?>
				<?php endif;?>
			</ul>
		</div>		
		<?=\app\widgets\ContactWidget::widget()?>
	</div>
	<div class="right">
		<div class="pfw">
			<div class="title">
				<h3>产品展示</h3>
				<span class="breadcrumbs">
					您现在的位置：<a href="/" title="首页">首页</a>
					<span class="arrow">&gt;</span> 产品展示
					<?php if(isset($params['cateId']) && !empty($cateName)):?>
					<span class="arrow">&gt;</span> <?=$cateName?>
					<?php endif;?>
				</span>
			</div>
			<ul class="product clearfix" style="padding-left:7px;">
				<?php if(!empty($data)):?>
				<?php foreach($data as $item):?>
				<li>
					<div class="img">
						<a href="<?=Url::to(['product/detail','id'=>$item['id']])?>" title="<?=$item['title']?>"><img src="<?=isset($item['images_list'][0]) ? $item['images_list'][0] : $item['logo']?>" border="0" id="product_<?=$item['id']?>"></a>
					</div>
					<div class="imglist clearfix">
						<?php if(!empty($item['images_list'])):?>
						<?php foreach($item['images_list'] as $key => $img):?>
							<div class="thumb <?=$key==0 ? 'hover' : ''?>" data="<?=$img?>" data-id="<?=$item['id']?>"><img src="<?=str_replace('_middle','_small',$img)?>" border="0"></div>
						<?php endforeach;?>
						<?php endif;?>
					</div>
					<h4><a href="<?=Url::to(['product/detail','id'=>$item['id']])?>" title="<?=$item['title']?>"><?=$item['title']?></a></h4>
				</li>	
				<?php endforeach;?>
				<?php endif;?>
			</ul>
		</div>
		<?=\app\widgets\FrontendLinkPager::widget(['pagination' => $pagination]) ?>
	</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(".thumb").mouseover(function(){
			var pid = $(this).attr('data-id');
			var thumb = $(this).attr('data');
			$("#product_"+pid).attr("src",thumb);
			$(".thumb[data-id="+pid+"]").removeClass("hover");
			$(this).addClass('hover');
		});
	});
</script>