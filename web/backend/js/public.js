/*
	公共方法集合
*/


//选中所有或反选
function selectAll(obj,className){
	if($(obj).is(":checked")){
		$("."+className).attr("checked",true);
	}else{
		$("."+className).attr("checked",false);
	}
}

//删除或更新
function updateByIds(url,params,message){
	params._csrf = csrfToken;
	$.dialog({
		content: message,
		ok: function () {
			$.ajax({
				 type: "post",
				 url: url,
				 data: params,
				 dataType: "json",
				 success: function(data){
					$.dialog.alert(data.message);
					if(data.code == '1000'){
						location.reload();
					}
				 }
			});
			//return false;
		},
		cancelVal: '关闭',
		cancel: true, //为true等价于function(){}
		lock: true
	});
}