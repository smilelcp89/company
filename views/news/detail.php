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
				<span class="breadcrumbs">您现在的位置：<a href="/" title="首页">首页</a>
					<span class="arrow">&gt;</span> <a href="<?=Url::to(['news/index'])?>" title="新闻中心">新闻中心</a>
					<span class="arrow">&gt;</span> <?=\app\components\Common::truncate($news['title'],10)?>
				</span>
			</div>
			<div class="detail">
				<h1><?=$news['title']?></h1>
				<div class="date_hits_tags">
					发布时间：<span><?=date('Y/m/d H:i',$news['create_time'])?></span>&nbsp;&nbsp;&nbsp;
					所属类别：<span class="hits"><?=$newsCategoryList[$news['cate_id']]['title']?></span>
				</div>
				<div class="content">
					<?=\yii\helpers\Html::decode($news['content'])?>
				</div>
				<div class="np">
					<p id="prev_news" style="display:none;"></p>
					<p id="next_news" style="display:none;"></p>
				</div>
			</div>     
			</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?=Yii::$app->params['imgHost'];?>static/js/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="<?=$imgHost;?>front/js/jquery.cookie.js" charset="utf-8"></script>
<script type="text/javascript">
	$(function(){
		var cy_news_context = $.cookie('cy_news_context');
		if(cy_news_context){
			var cy_news_context_arr = cy_news_context.split("###");
			for(var i in cy_news_context_arr){
				var arr = cy_news_context_arr[i].split("|");
				if(arr[0] == "prev"){
					var content = '上一篇：<a href="/news-'+arr[1]+'.html">'+arr[2]+'</a>';
					$("#prev_news").html(content).show();
				}else{
					var content = '下一篇：<a href="/news-'+arr[1]+'.html">'+arr[2]+'</a>';
					$("#next_news").html(content).show();
				}
			}
		}
		//懒加载图片
		$("img.lazy").lazyload({
			effect : "fadeIn"
		});
	});
</script>