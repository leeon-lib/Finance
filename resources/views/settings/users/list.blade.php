@extends('layout')
@section('content')

@include('_left_pannel', ['action' => '/settings/users'])
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
    @include('_breadcrumb', ['description' => '添加、操作、查看用户', 'items' => ['设置', '用户', '列表']])

    <div class="contentpanel panel-email">
        <div class="col-sm-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="frm_search" class="form-horizontal" method="post" action="/delivery_route">
                        <div class="form-group col-sm-4">
                            <label class="col-sm-4 control-label">模块</label>
                            <div class="col-sm-8">
                                <select class="form-control input-sm mb15 chosen-select" id="delivery_route_id" name="delivery_route_id">
                                    <option value="">不限</option>
                                    @foreach($userList as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
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

                    @if(empty($userList))
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
                                <th width="12%">邮箱</th>
                                <th width="25%">创建时间</th>
                                @if($hasEdit)
                                <th width="11%">操作</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="list">
                              @foreach ($userList as $user)
                                <tr id="{{$user->id}}">
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at}}</td>
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
