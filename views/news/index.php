<?php use yii\helpers\Url;?>
<div class="banner" style="background-image:url(<?=Yii::$app->params['imgHost'];?>front/images/auto_1135.jpg)"></div>
<div class="main clearfix">
	<div class="left">
		<div class="pfw">
		<div class="title"><h3>新闻类别</h3></div>
			<ul class="artlist">
				<li><a href="<?=Url::to(['news/index'])?>">全部</a></li>
				<?php if(!empty($newsCategoryList)):?>
				<?php foreach($newsCategoryList as $row):?>
				<li><a href="<?=Url::to(['news/index','cateId'=>$row['id']])?>"><?=$row['title']?></a></li>
				<?php endforeach;?>
				<?php endif;?>
			</ul>
		</div>		
		<?=\app\widgets\ContactWidget::widget()?>
	</div>
	<div class="right">
		<div class="pfw">
			<div class="title">
				<h3>新闻中心</h3>
				<span class="breadcrumbs">
					您现在的位置：<a href="/" title="首页">首页</a>
					<span class="arrow">&gt;</span> 新闻中心
					<?php if(isset($params['cateId']) && !empty($cateName)):?>
					<span class="arrow">&gt;</span> <?=$cateName?>
					<?php endif;?>
				</span>
			</div>
			<ul class="news_list">
				<?php if(!empty($data)):?>
				<?php foreach($data as $item):?>
				<li class="news_item" data-id="<?=$item['id']?>" data-title="<?=$item['title']?>">
					<h3>
						【<?=isset($newsCategoryList[$item['cate_id']]) ? $newsCategoryList[$item['cate_id']]['title'] : '暂无类别'?>】
						<a href="<?=Url::to(['news/detail','id'=>$item['id']])?>" title="<?=$item['title']?>"><?=\app\components\Common::truncate($item['title'],30)?></a>
					</h3>
					<p style="padding-left:8px;">发布时间：<?=date('Y/m/d H:i',$item['create_time'])?></p>
					<div class="n-txt">
						<?=\app\components\Common::truncate(\yii\helpers\Html::decode($item['content']),200)?>
						<span class="more">[<a href="<?=Url::to(['news/detail','id'=>$item['id']])?>">查看更多</a>]</span>
					</div>
				</li>
				<?php endforeach;?>
				<?php else:?>
				<li><h3>抱歉，暂无相关新闻</h3></li>
				<?php endif;?>
			</ul>
			<?=\app\widgets\FrontendLinkPager::widget(['pagination' => $pagination]) ?>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?=$imgHost;?>front/js/jquery.cookie.js" charset="utf-8"></script>
<script type="text/javascript">
	$(function(){
		$(".news_list li a").click(function(){
			var li = $(this).closest('li');
			var data = [];
			if(li.prev("li.news_item").length > 0){
				data.push("prev|"+li.prev("li").attr("data-id")+"|"+li.prev("li").attr("data-title"));
			}
			if(li.next("li.news_item").length > 0){
				data.push("next|"+li.next("li").attr("data-id")+"|"+li.next("li").attr("data-title"));
			}
			if(data.length > 0){
				$.cookie('cy_news_context', data.join("###"));
			}
		});
		
	});
</script>
