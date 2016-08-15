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
		updateByIds('/admin/friendlink/changestatus',{ids: data.join(","),status: status},'确定要'+message+'已选择的项吗');
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
		updateByIds('/admin/friendlink/delete',{ids: data.join(","),status: status},'确定要删除已选择的项吗');
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
            <li><a href="/admin/friendlink">友情链接管理</a></li>
            <li><a href="javascript:;">友情链接列表</a></li>
        </ul>
    </div>

    <div class="rightinfo">
	<form>
    <ul class="seachform">
        <li><label>友情链接名</label><input name="title" value="<?=$params['title']?>" type="text" class="scinput" /></li>
        <li>
            <label>是否启用</label>
            <div class="vocation">
                <select class="uedselect" name="status">
                    <option value='0'>全部</option>
                    <option value="1" <?php if($params['status'] == 1) echo "selected";?>>是</option>
                    <option value="2"  <?php if($params['status'] == 2) echo "selected";?>>否</option>
                </select>
            </div>
        </li>
        <li><label>&nbsp;</label><input type="submit" class="scbtn" value="查询"/></li>
    </ul>
	</form>
	<div class="tools">
    	<ul class="toolbar">
            <li class="click changeStatus" data-status="1"><span></span>启用</li>
			<li class="click changeStatus" data-status="2"><span></span>不启用</li>
			<li class="click delete"><span></span>删除</li>
        </ul>
    </div>
    <table class="tablelist">
    	<thead>
    	<tr>
            <th><input onclick="selectAll(this,'checkbox_opt');" type="checkbox"/></th>
            <th>序号<!--<i class="sort"><img src="<?=Yii::$app->params['imgHost'];?>backend/images/px.gif" /></i>--></th>
            <th>友情链接名</th>
            <th>链接地址</th>
            <th>友链状态</th>
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
            <td><?=$row['url'];?></td>
            <td><?=($row['status']==\app\models\User::NORMAL_STATUS ? '启用' : '不启用');?></td>
            <td><?=$row['create_user'];?></td>
            <td><?=$row['create_time'] ? date('Y-m-d H:i:s',$row['create_time']) : '暂无';?></td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['friendlink/edit?id='.$row['id']])?>" class="tablelink">编辑</a>
				<?php if($row['status'] == \app\models\User::NORMAL_STATUS):?>
				<a href="javascript:;" class="tablelink" onclick="updateByIds('/admin/friendlink/changestatus',{status:2,ids:<?=$row['id']?>},'确定不启用【<?=$row['title'];?>】吗？')">　不启用</a>
				<?php else:?>
				<a href="javascript:;" class="tablelink" onclick="updateByIds('/admin/friendlink/changestatus',{status:1,ids:<?=$row['id']?>},'确定启用【<?=$row['title'];?>】吗？')">　启用</a>
				<?php endif;?>	

				<a href="javascript:;" class="tablelink" onclick="updateByIds('/admin/friendlink/delete',{ids:<?=$row['id']?>},'确定删除【<?=$row['title'];?>】吗？')">　删除</a>
            </td>
        </tr>
        <?php endforeach;?>
        <?php else:?>
        <tr><td colspan="8">数据为空</td></tr>
        <?php endif;?>
        </tbody>
    </table>
    <?=\app\widgets\BackendLinkPager::widget(['pagination' => $pagination]) ?>