<link href="<?=Yii::$app->params['imgHost'];?>backend/kindeditor/themes/default/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=Yii::$app->params['imgHost'];?>backend/kindeditor/kindeditor-min.js"></script>
<script type="text/javascript" src="<?=Yii::$app->params['imgHost'];?>backend/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
    var editor;
	var uploadUrl = '<?=Yii::$app->params['domain'];?>backend/kindeditor/php/upload_json.php';
    KindEditor.ready(function(K) {
        editor = K.create('#content', {
            allowFileManager : true,
            uploadJson : uploadUrl,
            fileManagerJson : '<?=Yii::$app->params['domain'];?>backend/kindeditor/php/file_manager_json.php',
        });

		var uploadbutton = K.uploadbutton({
			button : K('#file_upload')[0],
			fieldName : 'imgFile',
			url : uploadUrl,
			afterUpload : function(data) {
				if (data.error === 0) {
					alert(data.url);
				} else {
					alert(data.message);
				}
			}
		});
		uploadbutton.fileBox.change(function(e) {
			uploadbutton.submit();
		});
    });
</script>
  
<script type="text/javascript">
$(function(e) {
    $(".select1").uedSelect({
		width : 345			  
	});
	$(".select2").uedSelect({
		width : 167  
	});
	$(".select3").uedSelect({
		width : 100
	});

    
});
</script>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/admin">首页</a></li>
        <li><a href="/admin/product">产品管理</a></li>
        <li><a href="javascript:;">发布产品</a></li>
    </ul>
</div>

<div class="formbody">
<div id="usual1" class="usual">
<div class="itab">
  	<ul> 
        <li><a href="#tab1" class="selected">发布产品</a></li> 
  	</ul>
</div> 
<div id="tab1" class="tabson">
    <div class="formtext">产品信息</div>
    <ul class="forminfo">
        <li>
            <label>产品名称<b>*</b></label>
            </label><input name="" type="text" class="dfinput" value="产品名称"/>
        </li>
        <li>
            <label>上传图片<b>*</b></label>
			<input type="button" name="file_upload" id="file_upload" value="浏览文件" />
        </li>
        <li style="width:600px;">
            <label>薪资待遇<b>*</b></label>
            <div class="vocation">
                <select class="select1">
                    <option>3000-5000</option>
                    <option>5000-8000</option>
                    <option>8000-10000</option>
                    <option>10000-15000</option>
                </select>
            </div>
        </li>
        <li>
            <label>薪资待遇<b>*</b></label>
            <div class="vocation">
                <select class="select1">
                    <option>3000-5000</option>
                    <option>5000-8000</option>
                    <option>8000-10000</option>
                    <option>10000-15000</option>
                </select>
            </div>
        </li>
        <li>
            <label>工作地点<b>*</b></label>
            <div class="usercity">
                <div class="cityleft">
                    <select class="select2">
                        <option>江苏</option>
                        <option>湖南</option>
                        <option>广东</option>
                        <option>北京</option>
                        <option>湖北</option>
                    </select>
                </div>
            
                <div class="cityright">
                    <select class="select2">
                        <option>南京</option>
                        <option>无锡</option>
                        <option>盐城</option>
                        <option>徐州</option>
                        <option>连云港</option>
                    </select>
                </div>
            </div>
        </li>
        <li>
            <label>通知内容<b>*</b></label>
            <textarea id="content" name="content" style="width:700px;height:250px;visibility:hidden;"></textarea>
        </li>
        <li><label>&nbsp;</label><input name="" type="button" class="btn" value="保存发布"/></li>
    </ul>
    </div> 
</div> 
