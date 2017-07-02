@extends('layout')
@section('content')

@include('_left_pannel', ['action' => '/'])

  <div class="mainpanel">
    
    @include('_header_bar', ['admin' => '测试'])
    @include('_breadcrumb', ['icon' => 'fa-home', 'description' => '首页', 'items' => ['仪表盘']])
    
    <div class="contentpanel">
        <?php
        if (isset($_GET['no_authority'])) {
            echo '没有权限访问当前页面';
        }
        ?>
    </div><!-- contentpanel -->
    
  </div><!-- mainpanel -->

@stop
