<script type="text/javascript">
$(function(){
	$(".changeStatus").click(function(){
		var type = $(this).attr("data-type");
		var message = (type == 'read') ? '已阅读' : '已回复';
		var length = $(".checkbox_opt:checked").length;
		if(length <= 0){
			$.dialog.alert("请选择要"+message+"的项");return;
		}
		//获取值
		var data = [];
		$(".checkbox_opt:checked").each(function(){
			data.push($(this).val());
		});		
		updateByIds('/admin/guestbook/changestatus',{ids: data.join(","),type: type},'确定要将已选择的项改为“'+message+'”状态吗');
    });
    $('.tablelist tbody tr:odd').addClass('odd');
	$(".uedselect").uedSelect({
        width : 150
    });
});
</script>

	<div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="/admin">首页</a></li>
            <li><a href="/admin/guestbook">留言管理</a></li>
            <li><a href="javascript:;">留言列表</a></li>
        </ul>
    </div>

    <div class="rightinfo">
	<form>
    <ul class="seachform">
        <li><label>标题：</label><input name="title" value="<?=isset($params['title']) ? $params['title'] : ''?>" type="text" class="scinput" /></li>
		<li>
            <label>阅读状态</label>
            <div class="vocation">
                <select class="uedselect" name="isRead">
                    <option value='0'>全部</option>
                    <option value="1" <?php if(isset($params['isRead']) && $params['isRead'] == 1) echo "selected";?>>未阅读</option>
                    <option value="2"  <?php if(isset($params['isRead']) && $params['isRead'] == 2) echo "selected";?>>已阅读</option>
                </select>
            </div>
        </li>
		<li>
            <label>回复状态</label>
            <div class="vocation">
                <select class="uedselect" name="isReply">
                    <option value='0'>全部</option>
                    <option value="1" <?php if(isset($params['isReply']) && $params['isReply'] == 1) echo "selected";?>>未回复</option>
                    <option value="2" <?php if(isset($params['isReply']) && $params['isReply'] == 2) echo "selected";?>>已回复</option>
                </select>
            </div>
        </li>
        <li><label>&nbsp;</label><input type="submit" class="scbtn" value="查询"/></li>
    </ul>
	</form>
	<div class="tools">
    	<ul class="toolbar">
			<li class="click changeStatus" data-type="read"><span></span>已阅读</li>
			<li class="click changeStatus" data-type="reply"><span></span>已回复</li>
        </ul>
    </div>
    <table class="tablelist">
    	<thead>
    	<tr>
            <th><input onclick="selectAll(this,'checkbox_opt');" type="checkbox"/></th>
            <th>序号<!--<i class="sort"><img src="<?=Yii::$app->params['imgHost'];?>backend/images/px.gif" /></i>--></th>
			<th>留言人</th>
			<th>标题</th>
			<th>留言内容</th>
			<th>联系手机</th>
			<th>联系邮箱</th>
            <th>阅读状态</th>
            <th>回复状态</th>
            <th>留言时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($data)):?>
        <?php foreach($data as $key => $row):?>
        <tr>
            <td><input class="checkbox_opt" name="data[]" type="checkbox" value="<?=$row['id'];?>" /></td>
            <td><?=($pageSize*($pageIndex-1)+$key+1)?></td>
            <td><?=$row['username'] ? $row['username'] : '匿名';?></td>
            <td><?=$row['title'];?></td>
            <td><?=$row['content'];?></td>
            <td><?=$row['mobile'];?></td>
            <td><?=$row['email'];?></td>
            <td><?=$row['is_read'] == 1 ? '未阅读' : '<font color="red">已阅读</font>';?></td>
            <td><?=$row['is_reply'] == 1 ? '未回复' : '<font color="green">已回复</font>';?></td>
            <td><?=date('Y-m-d H:i:s',$row['create_time']);?></td>
            <td>
				<?php if($row['is_read'] == '1'):?>
				<a href="javascript:;" class="tablelink" onclick="updateByIds('/admin/guestbook/changestatus',{ids:'<?=$row['id']?>',type:'read'},'确定更新为已阅读状态吗')">已阅读</a>　
				<?php endif;?>

				<?php if($row['is_reply'] == '1'):?>
				<a href="javascript:;" class="tablelink" onclick="updateByIds('/admin/guestbook/changestatus',{ids:'<?=$row['id']?>',type:'reply'},'确定更新为已回复状态吗')">已回复</a>
				<?php endif;?>
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