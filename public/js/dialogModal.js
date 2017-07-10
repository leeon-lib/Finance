/**
 * 公共交互模态框
 * @author Liyn
 * @data 2016.06.03
 */
var dialog = {};
var modal = $('#dialogModal');
var hasModal = modal.length;
var confirmAction = null;

// 设置模态框标题
dialog.setTitle = function(str)
{/*{{{*/
	if (! hasModal) {
		this.setModalHtml();
	}
	$(modal).find('.modal-title').text(str);
}/*}}}*/

// 设置模态框内容，可HTML
dialog.setContent = function(str)
{/*{{{*/
	if (! hasModal) {
		this.setModalHtml();
	}
	$(modal).find('.modal-body').html(str);
}/*}}}*/

// 设置模态框尺寸
dialog.setSize = function(w, h)
{/*{{{*/
	if (! hasModal) {
		this.setModalHtml();
	}

	var width  = arguments[0];
	var height = arguments[1];
	var box = $(modal).find('.modal-dialog');

	if (width) {
		box.css('width', width + 'px');
	}
	if (height) {
		box.css('height', height + 'px');
	}
}/*}}}*/
// 设置模态框css样式
dialog.addClass = function(str)
{
	if (! hasModal) {
		this.setModalHtml();
	}
	var box = $(modal).find('.modal-dialog');

	if (str) {
		box.addClass(str);
	}
}

// 打开模态框[可提供内容参数，如果内容参数为空，则显示模态框footer部分]
dialog.modal = function(content, ms)
{/*{{{*/
	if (! hasModal) {
		this.setModalHtml();
	}

	var content = arguments[0] || '';
	if (content) {

		$(modal).find('.modal-footer').hide();
		this.setContent(content);

		if (Number(ms)) {
			setTimeout(function() {
				$(modal).modal('hide');
			}, ms);
		}
	} else {
		$(modal).find('.modal-footer').show();
	}

	$(modal).modal();
}/*}}}*/

// 关闭模态框
dialog.hide = function(ms)
{/*{{{*/
	var ms = Number(ms) || 0;
	if (ms) {
		ms = ms > 2000 ? 2000 : ms;
		setTimeout(function() {
			$(modal).modal('hide');
		}, ms);
	} else {
		$(modal).modal('hide');
	}
}/*}}}*/

dialog.confirm = function(content)
{/*{{{*/
	if (! hasModal) {
		this.setModalHtml();
	}

	var args = arguments.length;
	if (1 == args) {
		var content = content;
	} else if (2 == args) {
		this.setTitle(arguments[0]);
		var content = arguments[1];
	}

	this.setContent(content);
	$(modal).find('.modal-footer').show();
	$(modal).modal();
}/*}}}*/

// confirm交互的确定操作
dialog.determine = function(callback)
{/*{{{*/
	if (0 == arguments.length && this.confirmAction) {
		this.confirmAction();
		$(modal).modal('hide');
		this.confirmAction = null;
	}

	if (typeof(callback) == 'function') {
		this.confirmAction = callback;
	}
}/*}}}*/

// confirm确定按钮的事件监听
$('body').delegate('.dialog-confirm', 'click', function() {
	dialog.determine();
});

// 设置模态框结构
dialog.setModalHtml = function()
{/*{{{*/
	var modalHtml = ' \
		<div class="modal fade" id="dialogModal" tabindex="-1" role="dialog" aria-labelledby="dialogModalLabel" aria-hidden="true"> \
			<div class="modal-dialog modal-sm"> \
				<div class="modal-content"> \
					<div class="modal-header"> \
						<button type="button" class="close" data-dismiss="modal" aria-label="关闭"> \
							<!--<span aria-hidden="true">&times;</span>--> \
						</button> \
						<h4 class="modal-title" id="dialogModalLabel" style="text-align:center;">提示</h4> \
					</div> \
					<div class="modal-body" style="word-wrap: break-word; text-align:center;"></div> \
					<div class="modal-footer" style="display:none; text-align:center"> \
						<button type="button" class="btn btn-default" data-dismiss="modal" style="width:30%; max-width:80px;">关闭</button> \
						<button type="button" class="btn btn-primary dialog-confirm" style="width:65%; max-width:170px;">确定</button> \
					</div> \
				</div> \
			</div> \
		</div>';
	
	$(document.body).append(modalHtml);

	modal = $('#dialogModal');
	hasModal = modal.length;
}/*}}}*/
