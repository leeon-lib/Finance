<div class="leftpanel">
    <div class="logopanel">
        <h1><span>[</span> 物流管理 <span>]</span></h1>
    </div><!-- logopanel -->
    <div class="leftpanelinner">
        <h5 class="sidebartitle">功能栏</h5>
        <ul class="nav nav-pills nav-stacked nav-bracket">
            <li class="li-home {{ $action == '/'? 'active': '' }}"><a href="/"><i class="fa fa-home"></i> <span>仪表盘</span></a></li>
            <?php
            $html = '';
            foreach ($memus as $memu) {
                $baseMemu = $memu['base'];
                $html .= $html === '' ? '' : '</ul></li>';
                $html .=  '<li  class="nav-parent" ><a href="#"><i class="'.$baseMemu['icon'].'"></i> <span>'.$baseMemu['name'].'</span></a><ul class="children">';
                foreach ($memu['items'] as $subMemu) {
                    $class = $action === $subMemu['url'] ?  'active' : '';
                    $html .= '<li class="'.$class.'"><a href="'.$subMemu['url'].'"><i class="'.$subMemu['icon'].'"></i>'.$subMemu['name'].'</a></li>';
                }
            }
            $html .= '</ul></li>';
            echo $html;
            ?>
        </ul>
    </div>
</div>
