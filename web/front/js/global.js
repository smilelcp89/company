/**************************************************************************************************
	文件： js/global.js
	说明： 公共JS
	版本： 4.0
	网站： www.phpok.com
	作者： qinggan <qinggan@188.com>
	日期： 2015年09月05日 17时14分
***************************************************************************************************/
function top_search()
{
	var keywords = $("#top_keywords").val();
	if(!keywords){
		return false;
	}
	return true;
}

function add_fav()
{
    var url = window.location.href;
    var title = document.title;
    var ua = navigator.userAgent.toLowerCase();
    var msg = "您的浏览器不支持,请按 Ctrl+D 手动收藏!";
    if (ua.indexOf("360se") > -1) {
        alert(msg);
    }
    else if (document.all) {
        try{
            window.external.addFavorite(url, title);
        }catch(e){
            alert(msg);
        }
    }
    else if (window.sidebar) {
        window.sidebar.addPanel(title, url, "");
    }
    else {
        alert(msg);
    }
}