<?php
    $rstd = false;
        if (!empty($regionStoreTypeDisable)) {
            $rstd = true;
        }
?>
<div class="headerbar">
  
  <a class="menutoggle"><i class="fa fa-bars"></i></a>
    <?php if ($admin->admins->is_super == '1' || array_key_exists('oper/orders', unserialize($admin->admins->permissions))) {
    ?>
  <form class="searchform" action="/orders/search" method="GET">
     <input type="text" class="form-control" name="string" placeholder="订单号/手机号/小麦XM号...">
  </form>
    <?php 
}?>

  <div class="header-right">
    <ul class="headermenu">
      <li>
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" id="btn_center" data-toggle="dropdown">
            <img src="/images/photos/loggeduser.png" alt="" />
                {{ $admin->name }}
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
            <li><a href="{{ $admin->rbacUrl }}admin/password.json" target="_blank"><i class="glyphicon glyphicon-cog"></i> 账号设置</a></li>
            <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> 帮助</a></li>
            <li><a href="/logout"><i class="glyphicon glyphicon-log-out"></i> 登出</a></li>
          </ul>
        </div>
        <form class="signout" action="/signout" method="POST"></form>
      </li>
    </ul>
  </div><!-- header-right -->
  <div>

      <ul class="headermenu" style="margin-bottom:0px;">
      <li>
          <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle"  id="btn_region" data-toggle="dropdown">
                {{ value($currentRegional) }}
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu dropdown-menu-usermenu pull-right region" @if($rstd) style="display: none" @endif>

            @foreach ($regionalList as $key => $value)
              <li><a href="/?regional={{$key}}"><i class="">{{$value}}</i></a></li>
            @endforeach

          </ul>
        </div>
        <form class="signout" action="/signout" method="POST"></form>
      </li>
    </ul>
  </div>
</div><!-- headerbar -->
