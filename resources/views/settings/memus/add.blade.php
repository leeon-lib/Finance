@extends('layout')
@section('content')
@include('_left_pannel', ['action' => '/delivery_route'])

<?php
    $hasEdit = false;
    $flag = 'scm/delivery_route';
    $permissions = unserialize($currentAdmin->admins->permissions);
    if($currentAdmin->admins->is_super =='1' || (array_key_exists($flag, $permissions) && $permissions[$flag]=='40')){
        $hasEdit = true;
    }
?>

<style>
    .row {
        padding-bottom: 10px;
    }
    th, td {
		text-align: center;
	}
</style>

<div class="mainpanel">

    @include('_header_bar', ['admin' => $currentAdmin])
    @include('_breadcrumb', ['description' => '添加线路', 'items' => ['线路', '添加']])

    <div class="contentpanel" >
        <form id="form-add" class="form-horizontal form-bordered" action="/delivery_route/add" method="POST">
            <div class="panel panel-default" style="margin-bottom: 10px">
                @if ($errorMsg)
                    <div class="alert alert-warning" style="text-align:center;margin-bottom: 0px;">
                        <span>{{ $errorMsg }}</span>
                    </div>
                @endif
                <div class="panel-body" style="padding-bottom: 0">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-4 control-label">线路</label>
                                <div class="col-sm-4">
									<input type="text" class="form-control" id="delivery_route_name" name="delivery_route_name" placeholder="请输入线路名称">
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 control-label">店铺</label>
                                <div class="col-sm-4">
                                    <select class="form-control chosen-select" id="store" name="store_id" data-placeholder="选择店铺添加至列表">
                                    	<option value=""></option>
										@foreach ($storeList as $store)
											<option value="{{$store->id}}"
												province="{{$store->regionalProvince->regional_name}}"
												city="{{$store->regionalCity->regional_name}}"
												area="{{$store->parent_area_name}}"
												store_status="{{ $store->status == 'OPENING' ? '营业中' : '已关店' }}">
												[{{$store->id}}]{{$store->name}}
											</option>
										@endforeach
									</select>
                                </div>
                                <button class="btn btn-primary btn-add-store" type="button" style="margin-top: 3px;">
                                    <i class="glyphicon glyphicon-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group" style="padding: 0px;">
                            <div class="table-responsive">
                                <table class="table table-primary">
                                    <thead>
                                    <tr>
                                        <th>省</th>
                                        <th>市</th>
                                        <th>区(县)</th>
                                        <th>店铺</th>
										<th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer" style="padding: 10px 5px 10px;display: none;">
                <div class="row save-btn-row">
                    <div style="text-align: center;margin-bottom: 10px;">
                        <button class="btn btn-default" onclick="return !! history.go(-1) && false;">取消</button>
                        <button class="btn btn-primary save-btn" type="button">保存</button>
                    </div>
                </div>
                <div class="alert alert-danger errorMsg-box" style="clear:both;text-align: center;height:0px;padding:0px;margin:0px;border:0">
                    <span id="errorMsg" style="color:red;"></span>
                </div>
            </div>
        </form>
    </div>
</div>

@stop
<script type="text/javascript">
    @section('script')
</script>

{{HTML::script('/js/services/common.js');}}
{{HTML::script('/js/services/dialogModal.js');}}

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

    // 删除店铺
    $('.btn-delete-store').live('click', function() {
        var tr = $(this).parents('tr');
		var store_id = tr.find('#store_id').val();
		var province = $.trim(tr.find('#province').text());
		var city = $.trim(tr.find('#city').text());
		var area = $.trim(tr.find('#area').text());
		var name = $.trim(tr.find('#name').text());
		var store_status = $.trim(tr.find('#store_status').text());

		tr.remove();
		var option = '<option value="'+store_id+'" ';
		option += 'province="'+province+'" city="'+city+'" area="'+area+'"' + 'store_status="'+ store_status +'">';
		option += '['+store_id+']'+name;
		option += '</option>';
		$('#store').prepend(option);
		$('#store').trigger("chosen:updated");

        var trs = $('.list tr');
        if (0 == trs.length) {
            $('.save-btn-row').hide();
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

