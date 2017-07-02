<div class="leftpanel">
    <div class="logopanel">
        <h1><span>[</span> 运营 <span>]</span></h1>
    </div><!-- logopanel -->
    <div class="leftpanelinner">
        <h5 class="sidebartitle">功能栏</h5>
        <ul class="nav nav-pills nav-stacked nav-bracket">
            <li class="li-home {{ $action == '/'? 'active': '' }}"><a href="/"><i class="fa fa-home"></i> <span>仪表盘</span></a></li>

            <?php
            $menuArr = array(
                'oper/menu-regionals' => array('url' => '#', 'name' => '区域管理', 'id' => 'regionals', 'icon' => 'glyphicon glyphicon-globe', 'level' => '1'),
                'oper/regionals' => array('url' => '/regionals', 'name' => '列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-stores' => array('url' => '#', 'name' => '店铺', 'id' => 'dianpu', 'icon' => 'fa fa-th-large', 'level' => '1'),
                'oper/stores/base' => array('url' => '/stores/base', 'name' => '渠道基础店铺', 'icon' => 'fa fa-caret-right', 'level' => '2'),
            );
            $html = '';
            foreach ($menuArr as $key => $val) {
                if ($val['level'] === '1') {
                    $html .= $html === '' ? '' : '</ul></li>';
                    $html .=  '<li  class="nav-parent" ><a href="#" id="'.$val['id'].'" ><i class="'.$val['icon'].'"></i> <span>'.$val['name'].'</span></a><ul class="children">';
                } else {
                    $class = $action === $val['url'] ?  'active' : '';
                    $target = $key == 'oper/log' ? ' target="_blank"' : '';
                    $html .= '<li class="'.$class.'"><a href="'.$val['url'].'" '.$target.'><i class="'.$val['icon'].'"></i>'.$val['name'].'</a></li>';
                }
            }
            $html .= '</ul></li>';
            echo $html;
?>
        </ul>

    </div>

</div>
