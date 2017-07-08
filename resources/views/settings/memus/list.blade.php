@extends('layout')
@section('content')

@include('_left_pannel', ['action' => '/delivery_route'])
<?php
    $hasEdit = false;
    $flag = 'scm/delivery_route';
    $permissions = unserialize($currentAdmin->admins->permissions);
    if ($currentAdmin->admins->is_super == '1' || (array_key_exists($flag, $permissions) && $permissions[$flag] == '40')) {
        $hasEdit = true;
    }
?>
<style type="text/css">
	th, td {
		text-align: center;
	}
	.table>tbody>tr>td {
		padding : 7px;
		vertical-align: middle;
	}
</style>
<div class="mainpanel">
    @include('_header_bar', ['admin' => $currentAdmin])
    @include('_breadcrumb', ['description' => '添加、操作、查看线路', 'items' => ['线路', '线路列表']])

    <div class="contentpanel panel-email">
        <div class="col-sm-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="frm_search" class="form-horizontal" method="post" action="/delivery_route">
						<div class="form-group col-sm-4">
							<label class="col-sm-4 control-label">线路</label>
							<div class="col-sm-8">
								<select class="form-control input-sm mb15 chosen-select" id="delivery_route_id" name="delivery_route_id">
									<option value="">不限</option>
									@foreach ($deliveryRouteList as $deliveryRoute)
										@if ($deliveryRoute->id == $searchCondition['delivery_route_id'])
										<option value="{{$deliveryRoute->id}}" selected="selected">[{{$deliveryRoute->id}}]{{$deliveryRoute->name}}</option>
										@else
										<option value="{{$deliveryRoute->id}}">[{{$deliveryRoute->id}}]{{$deliveryRoute->name}}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group col-sm-4">
							<label class="col-sm-4 control-label">店铺</label>
							<div class="col-sm-8">
								<select class="form-control input-sm mb15 chosen-select" id="store_id" name="store_id">
									<option value="">不限</option>
									@foreach ($storeList as $store)
										@if ($store->id == $searchCondition['store_id'])
										<option value="{{$store->id}}" selected="selected">[{{$store->id}}]{{$store->name}}</option>
										@else
										<option value="{{$store->id}}">[{{$store->id}}]{{$store->name}}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group col-sm-3">
							<label class="col-sm-5 control-label"></label>
							<div class="col-sm-7" style="text-align:right;">
								<button id="btn_search" class="btn btn-white tooltips" title="搜索">
									<i class="glyphicon glyphicon-search" style="line-height:1.5;margin-top:0px;"></i>
								</button>
								@if ($hasEdit)
								<a class="btn btn-white tooltips" href="/delivery_route/add" title="添加" style="margin-left:10px;">
									<i class="glyphicon glyphicon-plus" style="line-height:1.5;margin-top:0px;"></i>
								</a>
								@endif
							</div>
						</div>
                    </form>

                    <div class="clearfix" id="before-alert-warning"></div>

                    @if(empty($list))
                    <div class="alert alert-warning" style="clear: both;text-align: center;margin-top:30px;">
                        暂无符合当前条件的数据
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-primary mb30">
                            <thead>
                            <tr>
                                <th width="12%">省</th>
                                <th width="12%">市</th>
                                <th width="12%">区(县)</th>
                                <th width="25%">店铺</th>
                                <th width="15%">状态</th>
                                <th>线路</th>
                                @if($hasEdit)
                                <th width="11%">操作</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="list">
                              @foreach ($list as $value)
                                @foreach ($value as $store)
                                <tr id="{{$store->id}}">
                                    <td>{{$store->regionalProvince->regional_name}}</td>
                                    <td>{{$store->regionalCity->regional_name}}</td>
                                    <td>{{$store->parent_area_name}}</td>
                                    <td>{{$store->name}}</td>
                                    <td>{{ $store->status == 'OPENING' ? '营业中' : '已关店' }}</td>
                  									<td>
                  									@if(is_object($store->deliveryRoute))
                  										<a href="/delivery_route/{{$store->deliveryRoute->id}}"> {{ $store->deliveryRoute->name }} </a>
                  									@endif
                  									</td>
                                    @if ($hasEdit)
                                    <td class="table-action">
                    										@if(is_object($store->deliveryRoute))
                    										<button class="btn btn-xs btn-danger btn-delete" delivery_route_id="{{$store->deliveryRoute->id}}">删除</button>
                    										@endif
										                </td>
                                    @endif
                                </tr>
                                @endforeach
              								@endforeach
                            </tbody>
                        </table>
                    </div><!-- table-responsive -->
                    @endif
                </div><!-- panel-body -->
            </div><!-- panel-panel-default -->
        </div>
    </div><!-- contentpanel -->
</div><!-- mainpanel -->

@stop
<script type="text/javascript">
    @section('script')
</script>

{{HTML::script('/js/services/common.js');}}
{{HTML::script('/js/services/dialogModal.js');}}

<script type="text/javascript">
$(".chosen-select").chosen({'width': '100%', 'white-space': 'nowrap'});

$(document).ready(function() {
	var error = $('#return-error').text();
	if ($.trim(error)) {
		showErrorMsg(error);
	}
});

$('.btn-delete').on('click', function() {
	var button = $(this);
	var delivery_route_id = button.attr('delivery_route_id');

	var is_confirm = confirm('注意，此删除将清空该线路已设置的所有店铺，确定删除吗？');
	if (! is_confirm) {
		return false;
	}

	$.post('/delivery_route/delete/' + delivery_route_id, {}, function(data) {
		if (data.error_no) {
			showErrorMsg(data.error_msg);
		} else {
			showSuccessMsg(data.error_msg);
			location.href = '/delivery_route';
		}
	});
});

@stop
</script>
