<script type="text/javascript">
$(function(){
    $(".changeStatus").click(function(){
		var status = parseInt($(this).attr("data-status"));
		if(status != 1 && status != 2){
			$.dialog.alert("无效状态属性值");return;
		}
		var message = status == 1 ? '启用' : '禁用';
		var length = $(".checkbox_opt:checked").length;
		if(length <= 0){
			$.dialog.alert("请选择要"+message+"的项");return;
		}
		//获取值
		var data = [];
		$(".checkbox_opt:checked").each(function(){
			data.push($(this).val());
		});		
		updateByIds(url,{ids: data.join(","),status: status},'确定要'+message+'已选择的项吗');
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
            <li><a href="/admin/config">网站配置</a></li>
            <li><a href="javascript:;">配置列表</a></li>
        </ul>
    </div>

    <div class="rightinfo">
	<form>
    <ul class="seachform">
        <li><label>标识符</label><input name="flag" value="<?=$params['flag']?>" type="text" class="scinput" /></li>
        <li><label>配置描述</label><input name="intro" value="<?=$params['intro']?>" type="text" class="scinput" /></li>
        <li><label>&nbsp;</label><input type="submit" class="scbtn" value="查询"/></li>
    </ul>
	</form>
    <table class="tablelist">
    	<thead>
    	<tr>
            <!--<th><input onclick="selectAll(this,'checkbox_opt');" type="checkbox"/></th>-->
            <th>序号<!--<i class="sort"><img src="<?=Yii::$app->params['imgHost'];?>backend/images/px.gif" /></i>--></th>
            <th>标识符</th>
            <th>内容</th>
            <th>配置描述</th>
            <th>创建人</th>
            <th>创建时间</th>
			<th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($data)):?>
        <?php foreach($data as $key => $row):?>
        <tr>
            <!--<td><input class="checkbox_opt" name="data[]" type="checkbox" value="<?=$row['id'];?>" /></td>-->
            <td><?=($pageSize*($pageIndex-1)+$key+1)?></td>
            <td><?=$row['flag'];?></td>
            <td><?=$row['content'];?></td>
            <td><?=$row['intro'];?></td>
            <td><?=$row['create_time'] ? date('Y-m-d H:i:s',$row['create_time']) : '暂无';?></td>
            <td><?=$row['create_user'];?></td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['config/edit?id='.$row['id']])?>" class="tablelink">编辑</a>
            </td>
        </tr>
        <?php endforeach;?>
        <?php else:?>
        <tr><td colspan="7">数据为空</td></tr>
        <?php endif;?>
        </tbody>
    </table>
    <?=\app\widgets\BackendLinkPager::widget(['pagination' => $pagination]) ?>