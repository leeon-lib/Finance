/**
 * 公共事件处理与交互库
 * @author Liyn
 * @data 2016.05.20
 */

// 全局ajax默认参数设置
var ajaxOptions =
{/*{{{*/
	type: "POST",
	url: "",
	data: null,
	dataType: "JSON",
	beforeSend: null,
success: function (data, textStatus, jqXHR) {},
error: function (jqXHR, textStatus, errorThrown) {},
complete: function (jqXHR, textStatus) {}
};/*}}}*/

function checkNum(obj)
{/*{{{*/
	var precision = arguments[1];
	if (precision != 0 && ! precision) {
		precision = 2;
	}
	if (isNaN(obj.value)) {
		obj.value = "";
	}
	if (obj != null) {
		if (obj.value.toString().split(".").length > 1 && obj.value.toString().split(".")[1].length > precision) {
			var num = obj.value.toString().split(".")[0] + '.' + obj.value.toString().split(".")[1].substring(0, precision);
			obj.value = num;
		}
	}
}/*}}}*/

// 获取自定义长度的随机字符串
function getRandomStr(len)
{/*{{{*/
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for( var i=0; i < len; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
}/*}}}*/

// 获取加载状态的img的HTML元素
function getLoadingHtml(type, width, height)
{/*{{{*/
	var type = arguments[0] || 5;
	var width = arguments[1] || "20px";
	var height = arguments[2] || "20px";
	var uri = '/images/loaders/loader' + type + '.gif';
	var html = '<div style="text-align: center;"><img alt="loading" width="'+width+'" height="'+height+'" src="'+uri+'"></div>';
	return html;
}/*}}}*/

// 去除文本两侧的中括号
function removeBracket(text)
{/*{{{*/
	if('' == text) {
		return text;
	} else {
		var reg = /[\\[0-9+\]\s]+/;
		return $.trim(text).replace(reg, '');
	}
}/*}}}*/

// 按钮开关
function turnButton(obj, w, h)
{/*{{{*/
	var button = $(obj);
	if (button.attr('disabled')) {
		button.removeAttr('disabled').html(button.attr('text-data'));
	} else {
		button.attr('text-data', button.html());
		button.attr('disabled', true).html(getLoadingHtml(5, w, h));
	}
}/*}}}*/

/**
 * 错误提示处理
 * @param    string    错误提示内容
 * @param    int	   显示时间(毫秒)
 * @return   boolean   false
 */
function showErrorMsg(msg, ms)
{/*{{{*/
	var ms = arguments[1] || 2000;

	var documentWidth = $(document.body).width();
	var divWidth = documentWidth / 4;
	var leftPrecent = (documentWidth - divWidth) / 2 / documentWidth * 100;

	var html = '<div class="alert alert-danger showErrorBox" \
			style="display:none; \
			width: '+ documentWidth/4 +'px; \
			word-break:break-all; \
			text-align:center; \
			position:fixed; \
			top:20px; \
			z-index:10000; \
			left: '+ leftPrecent +'%;">';
		html += '<span>' + msg + '</span></div>';

	if ($('.showErrorBox').length == 0) {

		$('body').prepend(html);

		$('.showErrorBox').fadeIn(500);

		setTimeout(function() {
			$('.showErrorBox').fadeOut(500);
			setTimeout(function() {
				$('.showErrorBox').remove();
			}, 500);
		}, ms);
	}

	return false;
}/*}}}*/

/**
 * 处理成功消息提示
 * @param    string    提示内容
 * @param    int	   显示时间(毫秒)
 * @return   boolean   true
 */
function showSuccessMsg(msg, ms)
{/*{{{*/
	var ms = arguments[1] || 3000;

	var documentWidth = $(document.body).width();
	var divWidth = documentWidth / 4;
	var leftPrecent = (documentWidth - divWidth) / 2 / documentWidth * 100;

	var html = '<div class="alert alert-success showSuccessBox" \
	style="display:none; \
	width: '+ documentWidth/4 +'px; \
	word-break:break-all; \
	text-align:center; \
	position:fixed; \
	top:20px; \
	z-index:10001; \
	left: '+ leftPrecent +'%;">';
	html += '<span>' + msg + '</span></div>';

	if ($('.showSuccessBox').length == 0) {

		$('body').prepend(html);

		$('.showSuccessBox').fadeIn(500);

		setTimeout(function() {
			$('.showSuccessBox').fadeOut(500);
			setTimeout(function() {
				$('.showSuccessBox').remove();
			}, 500);
		}, ms);
	}

	return false;
}/*}}}*/
