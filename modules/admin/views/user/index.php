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
		updateByIds('/admin/user/changestatus',{ids: data.join(","),status: status},'确定要'+message+'已选择的项吗');
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
            <li><a href="/admin/user">用户管理</a></li>
            <li><a href="javascript:;">用户列表</a></li>
        </ul>
    </div>

    <div class="rightinfo">
	<form>
    <ul class="seachform">
        <li><label>用户名</label><input name="username" value="<?=$params['username']?>" type="text" class="scinput" /></li>
        <li><label>手机号码</label><input name="mobile" value="<?=$params['mobile']?>" type="text" class="scinput" /></li>
        <li><label>邮箱</label><input name="email" value="<?=$params['email']?>" type="text" class="scinput" /></li>
        <li>
            <label>用户状态</label>
            <div class="vocation">
                <select class="uedselect" name="status">
                    <option value='0'>全部</option>
                    <option value="1" <?php if($params['status'] == 1) echo "selected";?>>正常</option>
                    <option value="2"  <?php if($params['status'] == 2) echo "selected";?>>禁用</option>
                </select>
            </div>
        </li>
        <li><label>&nbsp;</label><input type="submit" class="scbtn" value="查询"/></li>
    </ul>
	</form>
	<div class="tools">
    	<ul class="toolbar">
            <li class="click changeStatus" data-status="1"><span></span>启用</li>
			<li class="click changeStatus" data-status="2"><span></span>禁用</li>
			<li class="click delete"><span></span>删除</li>
        </ul>
    </div>
    <table class="tablelist">
    	<thead>
    	<tr>
            <th><input onclick="selectAll(this,'checkbox_opt');" type="checkbox"/></th>
            <th>序号<!--<i class="sort"><img src="<?=Yii::$app->params['imgHost'];?>backend/images/px.gif" /></i>--></th>
            <th>用户名</th>
            <th>手机号码</th>
            <th>邮箱</th>
            <th>用户状态</th>
            <th>最后登陆时间</th>
            <th>最后登陆IP</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($data)):?>
        <?php foreach($data as $key => $row):?>
        <tr>
            <td><input class="checkbox_opt" name="data[]" type="checkbox" value="<?=$row['id'];?>" /></td>
            <td><?=($pageSize*($pageIndex-1)+$key+1)?></td>
            <td><?=$row['username'];?></td>
            <td><?=$row['mobile'];?></td>
            <td><?=$row['email'];?></td>
            <td><?=($row['status']==\app\models\User::NORMAL_STATUS ? '正常' : '禁用');?></td>
            <td><?=$row['last_login_time'] ? date('Y-m-d H:i:s',$row['last_login_time']) : '暂无';?></td>
            <td><?=$row['last_login_ip'];?></td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['user/edit?id='.$row['id']])?>" class="tablelink">编辑</a>
				<?php if($row['status'] == \app\models\User::NORMAL_STATUS):?>
				<a href="javascript:;" class="tablelink" onclick="updateByIds('/admin/user/changestatus',{status:2,ids:<?=$row['id']?>},'确定禁用该账号吗？')">　禁用</a>
				<?php else:?>
				<a href="javascript:;" class="tablelink" onclick="updateByIds('/admin/user/changestatus',{status:1,ids:<?=$row['id']?>},'确定启用该账号吗？')">　启用</a>
				<?php endif;?>	

				<a href="javascript:;" class="tablelink" onclick="updateByIds('/admin/user/delete',{ids:<?=$row['id']?>},'确定删除该账号吗？')">　删除</a>
            </td>
        </tr>
        <?php endforeach;?>
        <?php else:?>
        <tr><td colspan="9">数据为空</td></tr>
        <?php endif;?>
        </tbody>
    </table>
    <?=\app\widgets\BackendLinkPager::widget(['pagination' => $pagination]) ?>