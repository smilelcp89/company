<script type="text/javascript">
$(function(){
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
		updateByIds('/admin/product-category/delete',{ids: data.join(","),status: status},'确定要删除已选择的项吗');
    });
    $('.tablelist tbody tr:odd').addClass('odd');
});
</script>

	<div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="/admin">首页</a></li>
            <li><a href="/admin/product-category">产品分类管理</a></li>
            <li><a href="javascript:;">产品分类列表</a></li>
        </ul>
    </div>

    <div class="rightinfo">
	<form>
    <ul class="seachform">
        <li><label>产品分类名：</label><input name="title" value="<?=$params['title']?>" type="text" class="scinput" /></li>
        <li><label>&nbsp;</label><input type="submit" class="scbtn" value="查询"/></li>
    </ul>
	</form>
	<div class="tools">
    	<ul class="toolbar">
			<li class="click delete"><span></span>删除</li>
        </ul>
    </div>
    <table class="tablelist">
    	<thead>
    	<tr>
            <th><input onclick="selectAll(this,'checkbox_opt');" type="checkbox"/></th>
            <th>序号<!--<i class="sort"><img src="<?=Yii::$app->params['imgHost'];?>backend/images/px.gif" /></i>--></th>
			<th>分类名称</th>
            <th>创建者</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($data)):?>
        <?php foreach($data as $key => $row):?>
        <tr>
            <td><input class="checkbox_opt" name="data[]" type="checkbox" value="<?=$row['id'];?>" /></td>
            <td><?=($pageSize*($pageIndex-1)+$key+1)?></td>
            <td><?=$row['title'];?></td>
            <td><?=$row['create_user'];?></td>
            <td><?=date('Y-m-d H:i:s',$row['create_time']);?></td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['product-category/edit?id='.$row['id']])?>" class="tablelink">编辑</a>
				<a href="javascript:;" class="tablelink" onclick="updateByIds('/admin/product-category/delete',{ids:<?=$row['id']?>},'确定删除【<?=$row['title'];?>】吗？')">　删除</a>
            </td>
        </tr>
        <?php endforeach;?>
        <?php else:?>
        <tr><td colspan="6">数据为空</td></tr>
        <?php endif;?>
        </tbody>
    </table>
    <?=\app\widgets\BackendLinkPager::widget(['pagination' => $pagination]) ?>
	<br/>
	<br/>