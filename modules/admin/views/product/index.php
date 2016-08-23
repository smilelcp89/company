<script type="text/javascript">
$(function(){
    $(".changeStatus").click(function(){
		var status = parseInt($(this).attr("data-status"));
		if(status != 1 && status != 2){
			$.dialog.alert("无效状态属性值");return;
		}
		var message = status == 1 ? '上架' : '下架';
		var length = $(".checkbox_opt:checked").length;
		if(length <= 0){
			$.dialog.alert("请选择要"+message+"的项");return;
		}
		//获取值
		var data = [];
		$(".checkbox_opt:checked").each(function(){
			data.push($(this).val());
		});		
		updateByIds('/admin/product/changestatus',{ids: data.join(","),status: status},'确定要'+message+'已选择的项吗');
    });

	$(".isRecommend").click(function(){
		var status = parseInt($(this).attr("data-status"));
		if(status != 1 && status != 2){
			$.dialog.alert("无效属性值");return;
		}
		var message = status == 1 ? '推荐' : '取消推荐';
		var length = $(".checkbox_opt:checked").length;
		if(length <= 0){
			$.dialog.alert("请选择要"+message+"的项");return;
		}
		//获取值
		var data = [];
		$(".checkbox_opt:checked").each(function(){
			data.push($(this).val());
		});		
		updateByIds('/admin/product/isrecommend',{ids: data.join(","),isRecommend: status},'确定要'+message+'已选择的项吗');
    });

	$(".delete").click(function(){
		var length = $(".checkbox_opt:checked").length;
		if(length <= 0){
			$.dialog.alert("请选择要删除的项");return;
		}
		//获取值
		var data = [];
		$(".checkbox_opt:checked").each(function(){
			data.push($(this).val());
		});		
		updateByIds('/admin/user/delete',{ids: data.join(","),status: status},'确定要删除已选择的项吗');
    });

    $(".uedselect").uedSelect({
        width : 150
    });
    $('.tablelist tbody tr:odd').addClass('odd');
});
</script>

	<div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="/admin">首页</a></li>
            <li><a href="/admin/product">产品管理</a></li>
            <li><a href="javascript:;">产品列表</a></li>
        </ul>
    </div>

    <div class="rightinfo">
	<form>
    <ul class="seachform">
        <li><label>产品名</label><input name="title" value="<?=$params['title']?>" type="text" class="scinput" /></li>
		<li>
            <label>是否下架</label>
            <div class="vocation">
                <select class="uedselect" name="status">
                    <option value='0'>全部</option>
                    <option value="1" <?php if($params['status'] == 1) echo "selected";?>>上架</option>
                    <option value="2"  <?php if($params['status'] == 2) echo "selected";?>>下架</option>
                </select>
            </div>
        </li>
		<li>
            <label>是否推荐</label>
            <div class="vocation">
                <select class="uedselect" name="isRecommend">
                    <option value='0'>全部</option>
                    <option value="1" <?php if($params['isRecommend'] == 1) echo "selected";?>>是</option>
                    <option value="2"  <?php if($params['isRecommend'] == 2) echo "selected";?>>否</option>
                </select>
            </div>
        </li>
        <li>
            <label>产品分类</label>
            <div class="vocation">
                <select class="uedselect" name="cateId">
                    <option>全部</option>
					<?php if(!empty($cateList)):?>
					<?php foreach($cateList as $cate):?>
						<option value="<?=$cate['id']?>" <?php if($params['cateId'] == $cate['id']) echo "selected";?>><?=$cate['title']?></option>
					<?php endforeach;?>
					<?php endif;?>
                </select>
            </div>
        </li>
        <li><label>&nbsp;</label><input type="submit" class="scbtn" value="查询"/></li>
    </ul>
	</form>
	<div class="tools">
    	<ul class="toolbar">
            <li class="click changeStatus" data-status="1"><span></span>上架</li>
			<li class="click changeStatus" data-status="2"><span></span>下架</li>
			<li class="click isRecommend" data-status="1"><span></span>推荐</li>
			<li class="click isRecommend" data-status="2"><span></span>取消推荐</li>
			<li class="click delete"><span></span>删除</li>
        </ul>
    </div>
    <table class="tablelist">
    	<thead>
    	<tr>
            <th><input onclick="selectAll(this,'checkbox_opt');" type="checkbox"/></th>
            <th>序号<!--<i class="sort"><img src="<?=Yii::$app->params['imgHost'];?>backend/images/px.gif" /></i>--></th>
			<th>产品logo</th>
            <th>产品名称</th>
            <th>产品价格</th>
            <th>产品分类</th>
            <th>是否上架</th>
            <th>是否推荐</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($data)):?>
        <?php foreach($data as $key => $row):?>
        <tr>
            <td><input class="checkbox_opt" name="data[]" type="checkbox" value="<?=$row['id'];?>" /></td>
            <td><?=($pageSize*($pageIndex-1)+$key+1)?></td>
            <td><img style='margin:5px;' src="<?=str_replace('_middle','_small',$row['logo']);?>" width="50" height="50"/></td>
            <td><?=$row['title'];?></td>
            <td>￥<?=$row['sale_price'];?></td>
            <td><?=$cateList[$row['cate_id']]['title'];?></td>
            <td><?=($row['status']==1 ? '上架' : '下架');?></td>
            <td><?=($row['is_recommend']==1 ? '是' : '否');?></td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['product/edit?id='.$row['id']])?>" class="tablelink">编辑</a>
				<?php if($row['status'] == 1):?>
				<a href="javascript:;" class="tablelink" onclick="updateByIds('/admin/product/changestatus',{status:2,ids:<?=$row['id']?>},'确定下架【<?=$row['title'];?>】吗？')">　下架</a>
				<?php else:?>
				<a href="javascript:;" class="tablelink" onclick="updateByIds('/admin/product/changestatus',{status:1,ids:<?=$row['id']?>},'确定上架【<?=$row['title'];?>】吗？')">　上架</a>
				<?php endif;?>	

				<?php if($row['is_recommend'] == 1):?>
				<a href="javascript:;" class="tablelink" onclick="updateByIds('/admin/product/isrecommend',{isRecommend:2,ids:<?=$row['id']?>},'确定取消推荐【<?=$row['title'];?>】吗？')">　取消推荐</a>
				<?php else:?>
				<a href="javascript:;" class="tablelink" onclick="updateByIds('/admin/product/isrecommend',{isRecommend:1,ids:<?=$row['id']?>},'确定推荐【<?=$row['title'];?>】吗？')">　推荐</a>
				<?php endif;?>	

				<a href="javascript:;" class="tablelink" onclick="updateByIds('/admin/product/delete',{ids:<?=$row['id']?>},'确定删除【<?=$row['title'];?>】吗？')">　删除</a>
            </td>
        </tr>
        <?php endforeach;?>
        <?php else:?>
        <tr><td colspan="9">数据为空</td></tr>
        <?php endif;?>
        </tbody>
    </table>
    <?=\app\widgets\BackendLinkPager::widget(['pagination' => $pagination]) ?>
	<br/>
	<br/>