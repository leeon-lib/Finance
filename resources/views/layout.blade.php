<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="/images/favicon.png" type="image/png">

  <title><?php echo Config::get('app.app_name'); ?>运营管理系统</title>

  <link href="/css/style.default.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>
<?php
$menutoggle = isset($_COOKIE['menutoggle']) ? $_COOKIE['menutoggle'] : '';
if ($menutoggle == 'block') {
    $bodyhtml = "<body class='leftpanel-collapsed'>";
} else {
    $bodyhtml = '<body>';
}
echo $bodyhtml;
?>


<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
@yield('content')
</section>

<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/custom.js"></script>
<script src="/js/toggles.min.js"></script>
<script src="/js/jquery.cookies.js"></script>
<script src="/js/chosen.jquery.min.js"></script>
<script src="/js/jquery.sparkline.min.js"></script>

<script type="text/javascript">
@section('script')
@show
</script>
<script type="text/javascript">
    $().ready(function(){
        //隐藏没有子菜单的主菜单
        $('.leftpanelinner .nav>li').each(function(){
            var $currentLi = $(this);
            if($currentLi.find('ul.children li').length==0 && !$currentLi.hasClass('li-home')){
                $currentLi.hide();
            }
        });
        var menutoggle= $.cookie("menutoggle");
        if(menutoggle!='block') {
            $('.leftpanelinner .nav>li').each(function () {
                var $currentLi = $(this);
                if ($currentLi.find('ul.children li').hasClass('active')) {
                    $currentLi.find('ul').show();
                }
            });
        }

    });
</script>
</body>
</html>
