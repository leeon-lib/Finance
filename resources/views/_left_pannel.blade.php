<div class="leftpanel">
    <div class="logopanel">
        <h1><span>[</span> 运营 <span>]</span></h1>
    </div><!-- logopanel -->
    <div class="leftpanelinner">
        <h5 class="sidebartitle">功能栏</h5>
        <ul class="nav nav-pills nav-stacked nav-bracket">
            <li class="li-home {{ $action == '/'? 'active': '' }}"><a href="/"><i class="fa fa-home"></i> <span>仪表盘</span></a></li>

            <?php
            $admin = Admin::current();
            $permissions = unserialize($admin->admins->permissions);
            $menuArr = array(
                'oper/menu-regionals' => array('url' => '#', 'name' => '区域管理', 'id' => 'regionals', 'icon' => 'glyphicon glyphicon-globe', 'level' => '1'),
                'oper/regionals' => array('url' => '/regionals', 'name' => '列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-stores' => array('url' => '#', 'name' => '店铺', 'id' => 'dianpu', 'icon' => 'fa fa-th-large', 'level' => '1'),
                'oper/stores/base' => array('url' => '/stores/base', 'name' => '渠道基础店铺', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/stores' => array('url' => '/stores', 'name' => '一米鲜APP店铺', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/stores/pagoda' => array('url' => '/stores/pagoda', 'name' => '百果园抛单店铺', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/stores/taobao' => array('url' => '/stores/platform?partner_id='.Partner::PLATFORM_STORE_TAOBAO, 'name' => '淘宝到家店铺', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/stores/tianmao' => array('url' => '/stores/platform?partner_id='.Partner::PLATFORM_STORE_TIANMAO, 'name' => '天猫极速达店铺', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/stores/eleme' => array('url' => '/stores/platform?partner_id='.Partner::PLATFORM_STORE_ELEME, 'name' => '饿了么店铺', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/stores/baidu' => array('url' => '/stores/platform?partner_id='.Partner::PLATFORM_STORE_BAIDU, 'name' => '百度外卖店铺', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/stores/meituan' => array('url' => '/stores/platform?partner_id='.Partner::PLATFORM_STORE_MEITUAN, 'name' => '美团外卖店铺', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/stores/jd' => array('url' => '/stores/platform?partner_id='.Partner::PLATFORM_STORE_JINGDONG, 'name' => '京东到家店铺', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                //'oper/stores/partnerStores' => array('url' => '/stores/partnerStores', 'name' => '三方列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                // 'oper/stores/check' => array('url' => '/stores/check', 'name' => '检查', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/stores/express' => array('url' => '/express', 'name' => '配送公司', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/deliveryMode' => array('url' => '/deliveryMode', 'name' => '配送方式', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/deliveryMode/selectStores' => array('url' => '/deliveryMode/selectStores', 'name' => '配送方式设置', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-orders' => array('url' => '#', 'name' => '订单', 'id' => 'dingdan', 'icon' => 'glyphicon glyphicon-list-alt', 'level' => '1'),
                'oper/orders' => array('url' => '/orders', 'name' => '列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/orders/overzone' => array('url' => '/orders/overzone', 'name' => '超区订单', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/orders/expired' => array('url' => '/orders/expired', 'name' => '过期订单', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/orders/sending' => array('url' => '/orders/sending', 'name' => '配送中订单', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/orders/unfinished' => array('url' => '/orders/unfinished', 'name' => '未送达|拒收', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/orders/batch_reissue' => array('url' => '/orders/batch_reissue', 'name' => '订单批量补发', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/orders/shipping_status' => array('url' => '/orders/shipping_status', 'name' => '订单物流状态', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/orders/sync-info' => array('url' => '/orders/sync-info', 'name' => '手动抛单', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/orders/set_delivery_at' => array('url' => '/orders/set_delivery_at', 'name' => '今日抛单', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/orders/update-tips' => array('url' => '/orders/update-tips', 'name' => '加配送小费', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/orders/import' => array('url' => '/orders/import', 'name' => '导入订单', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/orders/cancel-sync-info' => array('url' => '/orders/cancel-sync-info', 'name' => '取消抛单', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/orders/order_sku' => array('url' => '/orders/order_sku', 'name' => '订单各SKU总数', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/orders/waybill_show' => array('url' => '/waybill/show', 'name' => '运单', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/orders/waybill_simulate' => array('url' => '/waybill/simulated_pile', 'name' => '运单模拟桩', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-buying_groups' => array('url' => '#', 'name' => '团', 'id' => 'buying_group', 'icon' => 'glyphicon glyphicon-th', 'level' => '1'),
                'oper/buying_groups' => array('url' => '/buying_groups', 'name' => '列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/buying_groups/slide' => array('url' => '/buying_groups/slide', 'name' => '团购商品轮播图', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/buying_groups/liangpintuan/slide' => array('url' => '/buying_groups/liangpintuan/slide', 'name' => '良品团商品轮播图', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/buying_groups/reward' => array('url' => '/buying_groups/reward', 'name' => '团购成团奖励', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-products' => array('url' => '#', 'name' => '产品', 'id' => 'chanpin', 'icon' => 'glyphicon glyphicon-gift', 'level' => '1'),
                'oper/products' => array('url' => '/products', 'name' => '列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/products/predict' => array('url' => '/products/predict', 'name' => '预估销量', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/goodItem' => array('url' => '/goodItem', 'name' => '单品', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/goodItem/relation' => array('url' => '/goodItem/relation', 'name' => '单品对应', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/goodPackage' => array('url' => '/goodPackage', 'name' => '商品', 'icon' => 'fa fa-caret-right', 'level' => '2'),
//                'oper/goodPackage/partnerGoods' => array('url' => '/goodPackage/partnerGoods', 'name' => '渠道商品', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/partnerGoods/taobao' => array('url' => '/partnerGoods/goods?partner_id='.Partner::PLATFORM_STORE_TAOBAO, 'name' => '淘宝到家商品', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/partnerGoods/tianmao' => array('url' => '/partnerGoods/goods?partner_id='.Partner::PLATFORM_STORE_TIANMAO, 'name' => '天猫极速达商品', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/partnerGoods/eleme' => array('url' => '/partnerGoods/goods?partner_id='.Partner::PLATFORM_STORE_ELEME, 'name' => '饿了么商品', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/partnerGoods/baidu' => array('url' => '/partnerGoods/goods?partner_id='.Partner::PLATFORM_STORE_BAIDU, 'name' => '百度外卖商品', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/partnerGoods/meituan' => array('url' => '/partnerGoods/goods?partner_id='.Partner::PLATFORM_STORE_MEITUAN, 'name' => '美团外卖商品', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/partnerGoods/jd' => array('url' => '/partnerGoods/goods?partner_id='.Partner::PLATFORM_STORE_JINGDONG, 'name' => '京东到家商品', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/goodPackage/liangpintuan' => array('url' => '/goodPackage/liangpintuan', 'name' => '良品团商品', 'icon' => 'fa fa-caret-right', 'level' => '2'),
//                'oper/eleme/goods' => array('url' => '/eleme/goods', 'name' => '饿了么商品', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-activities' => array('url' => '#', 'name' => '活动', 'id' => 'huodong', 'icon' => 'glyphicon glyphicon-bullhorn', 'level' => '1'),
                'oper/activities' => array('url' => '/activities', 'name' => '列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-good_category' => array('url' => '#', 'name' => '分类', 'id' => 'good_category', 'icon' => 'glyphicon glyphicon-bullhorn', 'level' => '1'),
                'oper/good_category' => array('url' => '/good_category', 'name' => '分类管理', 'icon' => 'fa fa-caret-right', 'level' => '2'),
//                'oper/good_category/platform' => array('url' => '/good_category/platform', 'name' => '设置商品分类', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-credit_goods' => array('url' => '#', 'name' => '积分商品', 'id' => 'credit_goods', 'icon' => 'glyphicon glyphicon-glass', 'level' => '1'),
                'oper/credit_goods' => array('url' => '/creditGoods', 'name' => '列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-bonus' => array('url' => '#', 'name' => '水果券', 'id' => 'shuiguoquan', 'icon' => 'glyphicon glyphicon-credit-card', 'level' => '1'),
                'oper/bonus/config' => array('url' => '/bonus/config', 'name' => '水果券列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/bonus' => array('url' => '/bonus', 'name' => '已发放水果券', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/bonus_task' => array('url' => '/bonus/bonus_task', 'name' => '待发放水果券任务列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/bonus/bonus_card' => array('url' => '/bonus/bonus_card', 'name' => '水果券兑换券<br>(单次使用)', 'icon' => 'fa fa-caret-right', 'level' => '2'), // 暂时使用配置权限
                'oper/bonus/bonus_cdkeys' => array('url' => '/bonus/bonus_cdkeys', 'name' => '水果券兑换码<br>(可重复使用)', 'icon' => 'fa fa-caret-right', 'level' => '2'), // 暂时使用配置权限
                'oper/bonus/new_guest' => array('url' => '/bonus/new_guest', 'name' => '新客券', 'icon' => 'fa fa-caret-right', 'level' => '2'),

                'oper/menu-tmp_msg' => array('url' => '#', 'name' => '模板消息', 'id' => 'moban', 'icon' => 'glyphicon glyphicon-envelope', 'level' => '1'),
                'oper/tmp_msg' => array('url' => '/tmp_msg', 'name' => '消息列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-recharge' => array('url' => '#', 'name' => '充值卡', 'id' => 'chongzhi', 'icon' => 'glyphicon glyphicon-tasks', 'level' => '1'),
                'oper/recharge' => array('url' => '/recharge', 'name' => '列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-configs' => array('url' => '#', 'name' => '全局配置', 'id' => 'configs', 'icon' => 'glyphicon glyphicon-cog', 'level' => '1'),
                'oper/invitation/config' => array('url' => '/configs/invitation', 'name' => '邀请激励', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/images/group' => array('url' => '/images/group', 'name' => '图库', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                //'oper/share/config' => array('url'=>'/configs/share', 'name'=>'分享红包','icon'=>'fa fa-caret-right','level'=>'2'),
                'oper/configs/notice' => array('url' => '/configs/notice', 'name' => '后台系统通知', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-member' => array('url' => '#', 'name' => '会员体系', 'id' => 'member', 'icon' => 'glyphicon glyphicon-user', 'level' => '1'),
                'oper/member/level_config' => array('url' => '/member/level_config', 'name' => '会员等级配置', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/member/credit_multiple' => array('url' => '/member/credit_multiple', 'name' => '积分倍数配置', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/member/credit_log_list' => array('url' => '/member/credit_log_list', 'name' => '积分操作', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-wechat' => array('url' => '#', 'name' => '微信扩展', 'id' => 'wechat', 'icon' => 'glyphicon glyphicon-cloud', 'level' => '1'),
                'oper/wechat/school_qrcode' => array('url' => '/wechat/school_qrcode', 'name' => '校园二维码', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/wechat/life_qrcode' => array('url' => '/wechat/life_qrcode', 'name' => '商圈二维码', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/wechat/add_card' => array('url' => '/wechat/add_card', 'name' => '添加微信卡券', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-logistics' => array('url' => '#', 'name' => '自建物流', 'id' => 'logistics', 'icon' => 'glyphicon glyphicon-compressed', 'level' => '1'),
                'oper/logistics/staffs' => array('url' => '/logistics/staffs', 'name' => '配送员信息', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/logistics/assigned' => array('url' => '/logistics/assigned', 'name' => '离店派单', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/logistics/search_orders' => array('url' => '/logistics/search_orders', 'name' => '状态更新', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-blacklists' => array('url' => '#', 'name' => '顾客', 'id' => 'blacklists', 'icon' => 'glyphicon glyphicon-ban-circle', 'level' => '1'),
                'oper/blacklists' => array('url' => '/blacklists', 'name' => '列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-ad_positions' => array('url' => '#', 'name' => 'App配置', 'id' => 'ad_positions', 'icon' => 'glyphicon glyphicon-phone', 'level' => '1'),
                'oper/pull_message' => array('url' => '/pull_message', 'name' => '消息发布', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/ad_positions/head_line' => array('url' => '/ad_positions/head_line', 'name' => '一米快报', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/app_guide' => array('url' => '/app_guide', 'name' => '启动页', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/configs' => array('url' => '/configs', 'name' => '搜索', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/ad_positions1' => array('url' => '/ad_positions', 'name' => '首页', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/ad_positions2' => array('url' => '/ad_positions?type='.AdPosition::AD_POSITION_TYPE_WINDOW, 'name' => '启动弹窗', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/ad_positions3' => array('url' => '/ad_positions?type='.AdPosition::AD_POSITION_TYPE_LOGIN, 'name' => '登录页Banner', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-commodity_comment' => array('url' => '#', 'name' => '评论', 'id' => 'commodity_comment', 'icon' => 'glyphicon glyphicon-qrcode', 'level' => '1'),
                'oper/commodity/comments' => array('url' => '/commodity/comments', 'name' => '商品评论', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/orders/comment' => array('url' => '/orders/comment', 'name' => '订单评论', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-partner' => array('url' => '#', 'name' => '第三方平台', 'id' => 'partner', 'icon' => 'glyphicon glyphicon-user', 'level' => '1'),
                'oper/partner' => array('url' => '/partner', 'name' => '平台列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/partner/refund' => array('url' => '/partner/refund', 'name' => '订单退款', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/platform/order_list' => array('url' => '/platform/order_list', 'name' => '订单列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/partner/activity_goods' => array('url' => '/partner/activity_goods', 'name' => '活动商品', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/partner/export_goods' => array('url' => '/partnerGoods/export_goods', 'name' => '导出商品', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/platform/process_log_list' => array('url' => '/platform/process_log_list', 'name' => '日志查询', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/partner/push_order' => array('url' => '/partner/push_order', 'name' => 'ERP订单状态同步', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/partner/get_order' => array('url' => '/partner/get_order', 'name' => '平台补单', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-pop_admins' => array('url' => '#', 'name' => '合伙人管理', 'id' => 'pop_admins', 'icon' => 'glyphicon glyphicon-user', 'level' => '1'),
                'oper/pop_admins' => array('url' => '/pop_admins', 'name' => '列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-log' => array('url' => '#', 'name' => '操作日志', 'id' => 'rizhi', 'icon' => 'glyphicon glyphicon-list', 'level' => '1'),
                'oper/log' => array('url' => $admin->rbacUrl.'log?system=operating', 'name' => '列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/configs/notice' => array('url' => '/configs/notice', 'name' => '后台系统通知', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-member' => array('url' => '#', 'name' => '会员体系', 'id' => 'member', 'icon' => 'glyphicon glyphicon-user', 'level' => '1'),
                'oper/member/level_config' => array('url' => '/member/level_config', 'name' => '会员等级配置', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/member/credit_multiple' => array('url' => '/member/credit_multiple', 'name' => '积分倍数配置', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/member/credit_log_list' => array('url' => '/member/credit_log_list', 'name' => '积分操作', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-wechat' => array('url' => '#', 'name' => '微信扩展', 'id' => 'wechat', 'icon' => 'glyphicon glyphicon-cloud', 'level' => '1'),
                'oper/wechat/school_qrcode' => array('url' => '/wechat/school_qrcode', 'name' => '校园二维码', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/wechat/life_qrcode' => array('url' => '/wechat/life_qrcode', 'name' => '商圈二维码', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-logistics' => array('url' => '#', 'name' => '自建物流', 'id' => 'logistics', 'icon' => 'glyphicon glyphicon-compressed', 'level' => '1'),
                'oper/logistics/staffs' => array('url' => '/logistics/staffs', 'name' => '配送员信息', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/logistics/assigned' => array('url' => '/logistics/assigned', 'name' => '离店派单', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/logistics/search_orders' => array('url' => '/logistics/search_orders', 'name' => '状态更新', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-blacklists' => array('url' => '#', 'name' => '顾客', 'id' => 'blacklists', 'icon' => 'glyphicon glyphicon-ban-circle', 'level' => '1'),
                'oper/blacklists' => array('url' => '/blacklists', 'name' => '列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-ad_positions' => array('url' => '#', 'name' => 'App配置', 'id' => 'ad_positions', 'icon' => 'glyphicon glyphicon-phone', 'level' => '1'),
                'oper/pull_message' => array('url' => '/pull_message', 'name' => '消息发布', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/ad_positions/head_line' => array('url' => '/ad_positions/head_line', 'name' => '一米快报', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/app_guide' => array('url' => '/app_guide', 'name' => '启动页', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/configs' => array('url' => '/configs', 'name' => '搜索', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/ad_positions1' => array('url' => '/ad_positions', 'name' => '首页', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/ad_positions2' => array('url' => '/ad_positions?type='.AdPosition::AD_POSITION_TYPE_WINDOW, 'name' => '启动弹窗', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/ad_positions3' => array('url' => '/ad_positions?type='.AdPosition::AD_POSITION_TYPE_LOGIN, 'name' => '登录页Banner', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-commodity_comment' => array('url' => '#', 'name' => '评论', 'id' => 'commodity_comment', 'icon' => 'glyphicon glyphicon-qrcode', 'level' => '1'),
                'oper/commodity/comments' => array('url' => '/commodity/comments', 'name' => '商品评论', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/orders/comment' => array('url' => '/orders/comment', 'name' => '订单评论', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-pop_admins' => array('url' => '#', 'name' => '合伙人管理', 'id' => 'pop_admins', 'icon' => 'glyphicon glyphicon-user', 'level' => '1'),
                'oper/pop_admins' => array('url' => '/pop_admins', 'name' => '列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
                'oper/menu-log' => array('url' => '#', 'name' => '操作日志', 'id' => 'rizhi', 'icon' => 'glyphicon glyphicon-list', 'level' => '1'),
                'oper/log' => array('url' => $admin->rbacUrl.'log?system=operating', 'name' => '列表', 'icon' => 'fa fa-caret-right', 'level' => '2'),
            );
            $html = '';
            foreach ($menuArr as $key => $val) {
                if ($val['level'] == '2' && $admin->admins->is_super != '1' && !array_key_exists($key, $permissions)) {
                    $menuCombineOrder = array(
                        'oper/orders',
                        'oper/orders/overzone',
                        'oper/orders/expired',
                        'oper/orders/sending',
                        'oper/orders/unfinished',
                    );
                    $menuCombineStore = array(
                        'oper/stores',
                        'oper/stores/check',
                    );
                    //当前菜单在订单菜单组中
                    if (in_array($key, $menuCombineOrder)) {
                        //有订单权限
                        if (array_key_exists('oper/orders', $permissions)) {
                            if ($key == 'oper/orders/overzone') {
                                continue;
                            }
                        } else {
                            //无订单权限
                            continue;
                        }
                    } elseif (in_array($key, $menuCombineStore)) {
                        //当前菜单在店铺菜单组中
                        if (!array_key_exists('oper/stores', $permissions)) {
                            //无店铺权限
                            continue;
                        }
                    } else {
                        continue;
                    }
                }
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
