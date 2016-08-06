<script type="text/javascript">
$(function(){
    $(".click").click(function(){
        //$(".tip").fadeIn(200);
		location.href = '/admin/user/create';
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
            <li><a href="javascript;">用户列表</a></li>
        </ul>
    </div>

    <div class="rightinfo">

    <div class="tools">

    	<ul class="toolbar">
            <li class="click"><span><img src="<?=Yii::$app->params['imgHost'];?>backend/images/t01.png" /></span>添加用户</li>
        </ul>
    </div>

	<form>
    <ul class="seachform">
        <li><label>用户名</label><input name="username" type="text" class="scinput" /></li>
        <li><label>手机号码</label><input name="mobile" type="text" class="scinput" /></li>
        <li><label>邮箱</label><input name="email" type="text" class="scinput" /></li>
        <li>
            <label>用户状态</label>
            <div class="vocation">
                <select class="uedselect" name="status">
                    <option>全部</option>
                    <option value="1">正常</option>
                    <option value="2">禁用</option>
                </select>
            </div>
        </li>
        <li><label>&nbsp;</label><input type="submit" class="scbtn" value="查询"/></li>
    </ul>
	</form>
    <table class="tablelist">
    	<thead>
    	<tr>
            <th><input name="" type="checkbox" value="" checked="checked"/></th>
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
            <td><input name="" type="checkbox" value="" /></td>
            <td><?=($pageSize*($pageIndex-1)+$key+1)?></td>
            <td><?=$row['username'];?></td>
            <td><?=$row['mobile'];?></td>
            <td><?=$row['email'];?></td>
            <td><?=($row['status']==\app\models\User::NORMAL_STATUS ? '正常' : '禁用');?></td>
            <td><?=$row['last_login_time'] ? date('Y-m-d H:i:s',$row['last_login_time']) : '暂无';?></td>
            <td><?=$row['last_login_ip'];?></td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['user/edit?id='.$row['id']])?>" class="tablelink">编辑</a>
                <a href="javascript;" class="tablelink"> 删除</a>
            </td>
        </tr>
        <?php endforeach;?>
        <?php else:?>
        <tr><td colspan="9">数据为空</td></tr>
        <?php endif;?>
        </tbody>
    </table>
    <?=\app\widgets\BackendLinkPager::widget(['pagination' => $pagination]) ?>

    <div class="tip">
    	<div class="tiptop"><span>提示信息</span><a></a></div>

      <div class="tipinfo">
        <span><img src="<?=Yii::$app->params['imgHost'];?>backend/images/ticon.png" /></span>
        <div class="tipright">
        <p>是否确认对信息的修改 ？</p>
        <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
        </div>
        </div>

        <div class="tipbtn">
        <input name="" type="button"  class="sure" value="确定" />&nbsp;
        <input name="" type="button"  class="cancel" value="取消" />
        </div>

    </div>
    </div>