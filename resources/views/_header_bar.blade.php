<div class="headerbar">
  
  <a class="menutoggle"><i class="fa fa-bars"></i></a>
  <form class="searchform" action="/orders/search" method="GET">
     <input type="text" class="form-control" name="string" placeholder="anything...">
  </form>

  <div class="header-right">
    <ul class="headermenu">
      <li>
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" id="btn_center" data-toggle="dropdown">
            <img src="/images/loggeduser.png" alt="" />
                {{ $currentAdmin }}
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
            <li><a href="admin/profile.json" target="_blank"><i class="glyphicon glyphicon-cog"></i> 账号设置</a></li>
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
        <form class="signout" action="/signout" method="POST"></form>
      </li>
    </ul>
  </div>
</div><!-- headerbar -->
