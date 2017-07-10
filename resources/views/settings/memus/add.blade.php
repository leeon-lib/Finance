@extends('layout')
@section('content')
@include('_left_pannel', ['action' => '/settings/memus'])

@php
    $hasEdit = false;
    $flag = 'scm/delivery_route';
@endphp

<div class="mainpanel">

    @include('_header_bar', ['admin' => $currentAdmin])
    @include('_breadcrumb', ['description' => '添加菜单', 'items' => ['设置', '功能菜单', '添加']])

    <div class="contentpanel" >
        <form id="form-add" class="form-horizontal form-bordered" action="/settings/memus/add" method="POST">
            <div class="panel panel-default" style="margin-bottom: 10px">
                <div class="panel-body" style="padding-bottom: 0">
                    @if (!empty($errorMsg))
                    <div class="alert alert-danger" style="text-align:center;margin-top: 10px;">
                        <span>{{ $errorMsg }}</span>
                    </div>
                    @endif
                    <div class="row">
                        <label class="col-sm-4 control-label">名称</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="name" name="name" placeholder="请输入菜单名称">
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 control-label">模块</label>
                        <div class="col-sm-4">
                            <select class="form-control chosen-select" id="parent_id" name="parent_id" data-placeholder="请选择所属模块">
                                <option value=""></option>
                                <option value="0">新模块</option>
                                @foreach ($baseMemuList as $memu)
                                    <option value="{{ $memu->id }}">{{ $memu->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 control-label">标识</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="flag" name="flag" placeholder="请输入权限标识">
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 control-label">URL</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="url" name="url" placeholder="请输入系统路径">
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 control-label">图标</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="请输入系统图标">
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <div style="width: 20%; margin:0 auto;">
                        <button class="btn btn-primary btn-block" id="btn-save">保存</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

@stop
<script type="text/javascript">
    @section('script')
</script>

<script src="/js/common.js"></script>

<script type="text/javascript">
    $(".chosen-select").chosen({'width':'100%','white-space':'nowrap'});

    // 添加店铺
    $('.btn-add-store').on('click', function() {
        var store_id = $('#store').val();
        if (0 == store_id) {
            return showErrorMsg('请选择店铺！');
        } else {
            $('.panel-footer, .save-btn-row').show();
            var this_store = $('#store option[value="'+store_id+'"]');
            var store_name = $.trim(this_store.text()).replace(/[\\[0-9\]]+/, '');
			var store_status = this_store.attr('store_status');
            var tr = '<tr>';
			tr += '<input type="hidden" id="store_id" name="store_ids[]" value="'+store_id+'" />';
            tr += '<td id="province">'+this_store.attr('province')+'</td>';
            tr += '<td id="city">'+this_store.attr('city')+'</td>';
            tr += '<td id="area">'+this_store.attr('area')+'</td>';
            tr += '<td id="name">'+store_name+'</td>';
			tr += '<td id="store_status">'+store_status+'</td>';
            tr += '<td><a class="btn btn-sm btn-danger btn-delete-store"><i class="glyphicon glyphicon-minus"</i></a></td>'
            $('.list').append(tr);

            // 耗用选择列表除去该条
            this_store.remove();
            $('#store').trigger("chosen:updated");
        }
    });

	// 提交保存
	$('.save-btn').on('click', function() {
		var delivery_route_name = $.trim($('#delivery_route_name').val());
		if ('' == delivery_route_name) {
			return showErrorMsg('请填写线路名称');
		}
		var trs = $('.list tr');
		if (0 == trs.length) {
			return  showErrorMsg('请为该线路至少添加一个店铺');
		}

		$(this).attr('disabled', true);
		if (confirm('确定保存吗？')) {
			$('#form-add').submit();
		} else {
            $(this).attr('disabled', false);
        }

		return false;
	});

    @stop
</script>

