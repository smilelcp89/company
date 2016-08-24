<?php use yii\helpers\Url;?>
<div class="banner" style="background-image:url(<?=Yii::$app->params['imgHost'];?>front/images/auto_1136.jpg)"></div>
<div class="main clearfix">
	<div class="left">
		<div class="pfw">
		<div class="title"><h3>产品类别</h3></div>
			<ul class="artlist">
				<li><a href="<?=Url::to(['product/index'])?>">全部</a></li>
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
				<span class="breadcrumbs">您现在的位置：<a href="/" title="首页">首页</a>
					<span class="arrow">&gt;</span> <a href="<?=Url::to(['product/index'])?>" title="产品展示">产品展示</a>
					<span class="arrow">&gt;</span> <?=\app\components\Common::truncate($product['title'],10)?>
				</span>
			</div>
			<div class="product clearfix">
				<div class="img" id="product_img">
					<ul class="list" style="position: relative; width: 400px; height: 400px;">
						<?php if(!empty($product['images_list'])):?>
						<?php foreach($product['images_list'] as $key => $img):?>
							<li style="position: absolute; width: 400px; left: 0px; top: 0px; display: list-item;"><img class="lazy" data-original="<?=$img?>" border="0" alt="<?=$product['title']?>"></li>
						<?php endforeach;?>
						<?php endif;?>
					</ul>
					<ul class="thumb_list">
						<?php if(!empty($product['images_list'])):?>
						<?php foreach($product['images_list'] as $key => $img):?>
							<li class="<?=$key==0 ? 'on' : ''?>"><img class="lazy" data-original="<?=str_replace('_big','_small',$img)?>" border="0"></li>
						<?php endforeach;?>
						<?php endif;?>
					</ul>
				</div>
				
				<div class="info">
					<h1><?=$product['title']?></h1>
					<p>发布时间：<?=date('Y-m-d',$product['create_time'])?></p>
					<p>产品分类：<?=$productCategoryList[$product['cate_id']]['title']?></p>
					<?php if($product['is_recommend'] == '1'):?>
					<p>推　　荐：站长推荐</p>
					<?php endif;?>
					<p><span>产品价格：</span><span class="price"><?=$product['sale_price']?> 元</span></p>
					
				</div>
			</div>

			<div class="detail product_info">
				<div class="content">
					<?=\yii\helpers\Html::decode($product['intro'])?>
				</div>
				<div class="np">
					<p><a href="javascript:;" onclick="history.back();"><span class="arrow">&lt;</span> 返回上级页面</a></p>
				</div>      
			</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?=Yii::$app->params['imgHost'];?>static/js/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="<?=Yii::$app->params['imgHost'];?>front/js/slide.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#product_img").slide({
			'titCell':'ul.thumb_list li',
			'mainCell':'ul.list',
			'autoPlay':true,
			'switchLoad':"_src",
			'effect':"fold"
		});
		//懒加载图片
		$("img.lazy").lazyload({
			effect : "fadeIn"
		});
	});
</script>