@extends('layout')
@section('content')

@include('_left_pannel', ['action' => '/settings/memus'])
<?php
    $hasEdit = false;
    $flag = 'scm/delivery_route';
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
    @include('_breadcrumb', ['description' => '添加、操作、查看功能菜单', 'items' => ['设置', '功能菜单', '列表']])

    <div class="contentpanel panel-email">
        <div class="col-sm-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="frm_search" class="form-horizontal" method="post" action="/delivery_route">
						<div class="form-group col-sm-4">
							<label class="col-sm-4 control-label">模块</label>
							<div class="col-sm-8">
								<select class="form-control input-sm mb15 chosen-select" id="memu_id" name="memu_id">
									<option value="">不限</option>
                                    @foreach($baseMemuList as $baseMemu)
                                        @if (is_object($currentMemu) && $currentMemu->id == $baseMemu->id)
                                        <option value="{{ $baseMemu->id }}" selected>{{ $baseMemu->name }}</option>
                                        @else
                                        <option value="{{ $baseMemu->id }}">{{ $baseMemu->name }}</option>
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
								<a class="btn btn-white tooltips" href="/settings/memus/add" title="添加" style="margin-left:10px;">
									<i class="glyphicon glyphicon-plus" style="line-height:1.5;margin-top:0px;"></i>
								</a>
							</div>
						</div>
                    </form>

                    <div class="clearfix" id="before-alert-warning"></div>

                    @if(empty($memuList))
                    <div class="alert alert-warning" style="clear: both;text-align: center;margin-top:30px;">
                        暂无符合当前条件的数据
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-primary mb30">
                            <thead>
                            <tr>
                                <th width="12%">ID</th>
                                <th width="12%">名称</th>
                                <th width="12%">标识</th>
                                <th width="25%">URL</th>
                                <th width="15%">icon</th>
                                @if($hasEdit)
                                <th width="11%">操作</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="list">
                              @foreach ($memuList as $memu)
                                <tr id="{{$memu->id}}">
                                    <td>{{$memu->id}}</td>
                                    <td>{{$memu->name}}</td>
                                    <td>{{$memu->flag}}</td>
                                    <td>{{$memu->url}}</td>
                                    <td>{{ $memu->icon }}</td>
                                </tr>
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


<script type="text/javascript">
$(".chosen-select").chosen({'width': '100%', 'white-space': 'nowrap'});

$(document).ready(function() {
	var error = $('#return-error').text();
	if ($.trim(error)) {
		showErrorMsg(error);
	}
});

$('#memu_id').on('change', function() {
    var memu_id = $('#memu_id').val();

    window.location.href = '/settings/memus/' + memu_id;
});

@stop
</script>
