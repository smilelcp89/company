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
		updateByIds('/admin/config/delete',{ids: data.join(","),status: status},'确定要删除已选择的项吗');
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
            <li><a href="/admin/config">设置管理</a></li>
            <li><a href="javascript:;">设置列表</a></li>
        </ul>
    </div>

    <div class="rightinfo">
	<form>
    <ul class="seachform">
        <li><label>设置标识：</label><input name="flag" value="<?=$params['flag']?>" type="text" class="scinput" /></li>
		<li><label>设置描述：</label><input name="intro" value="<?=$params['intro']?>" type="text" class="scinput" /></li>
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
            <th>设置标识</th>
            <th width="30%">设置内容</th>
            <th>设置描述</th>
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
            <td><?=$row['flag'];?></td>
            <td><?=\app\components\Common::truncate($row['content'],30);?></td>
            <td><?=$row['intro'];?></td>
            <td><?=$row['create_user'];?></td>
            <td><?=$row['create_time'] ? date('Y-m-d H:i:s',$row['create_time']) : '暂无';?></td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['config/edit?id='.$row['id']])?>" class="tablelink">编辑</a>
				<a href="javascript:;" class="tablelink" onclick="updateByIds('/admin/config/delete',{ids:<?=$row['id']?>},'确定删除【<?=$row['flag'];?>】吗？')">　删除</a>
            </td>
        </tr>
        <?php endforeach;?>
        <?php else:?>
        <tr><td colspan="8">数据为空</td></tr>
        <?php endif;?>
        </tbody>
    </table>
    <?=\app\widgets\BackendLinkPager::widget(['pagination' => $pagination]) ?>