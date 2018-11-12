<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="content-language" content="utf-8" />
  <meta name="renderer" content="webkit|ie-comp|ie-stand" />
  <meta http-equiv="Cache-control" content="public" max-age="no-cache" />
  <link rel="shortcut icon"  href="/Template/pc/soubao/Static/images/favicon.ico" />
  <link rel="apple-touch-icon" sizes="114x114" href="http://static02.fn-mart.com/images/touch-icon-iphone-136.png" />
  <link rel="alternate" media="only screen and (max-width:640px)" href="http://m.tp-shop.cn/category/C18973">
  <meta name="applicable-device" content="pc">
  <meta name="mobile-agent" content="format=html5;url=http://m.tp-shop.cn/category/C18973">
  <title>商品列表-<?php echo ($tpshop_config['shop_info_store_title']); ?></title>
  <meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
  <meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
  <!--[if lte IE 9]>
  <script src="http://static02.fn-mart.com/js/html5.js"></script>
  <script src="http://static02.fn-mart.com/js/IE9.js"></script>
  <link rel="stylesheet" type="text/css" href="http://static02.fn-mart.com/css/ie.css"/>
  <![endif]-->
  <link rel="stylesheet" href="/Template/pc/soubao/Static/css/category.css">
  <style type="text/css">
    .num{bottom: 0 !important;}
  </style>
</head>
<body>
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?af368e0870c7f5f00417375a861e2ea9";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
<script type="text/javascript" src="/Public/js/jquery-1.10.2.min.js"></script>
<script src="/Public/js/global.js"></script>
<script src="/Public/js/layer/layer.js"></script>
<link rel="stylesheet" type="text/css" href="/Template/pc/soubao/Static/css/common.min.css">
<link rel="stylesheet" type="text/css" href="/Template/pc/soubao/Static/css/main.min.css">
<link rel="stylesheet" type="text/css" href="/Template/pc/soubao/Static/css/lvhai.css">
<style>.fn-clear .words{ line-height:1.5}.m-top-nav a{color:#000;}</style>
<div class="fn-cms-top">
    <?php $pid =1;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->getField("position_id,position_name,ad_width,ad_height");$result = D("ad")->where("pid=$pid  and enabled = 1 and start_time < 1541235600 and end_time > 1541235600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select(); if(!in_array($pid,array_keys($ad_position)) && $pid) { M("ad_position")->add(array( "position_id"=>$pid, "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ", "is_open"=>1, "position_desc"=>CONTROLLER_NAME."页面", )); delFile(RUNTIME_PATH); } $c = 1- count($result); if($c > 0 && $_GET[edit_ad]) { for($i = 0; $i < $c; $i++) { $result[] = array( "ad_code" => "/Public/images/not_adv.jpg", "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid", "title" =>"暂无广告图片", "not_adv" => 1, "target" => 0, ); } } foreach($result as $key=>$v): $v[position] = $ad_position[$v[pid]]; if($_GET[edit_ad] && $v[not_adv] == 0 ) { $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]"; $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name]; $v[target] = 0; } ?><div fnp="m-top-banner" style="background:<?php echo ($v["bgcolor"]); ?>;" class="m-top-banner rel editable" moduleId="2010053" style="position:relative;min-height:35px;">
            <div class="bar container">
                <a class="img-small" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?> href="<?php echo ($v["ad_link"]); ?>"> <img width="auto" height="auto" class="img100" src="<?php echo ($v[ad_code]); ?>"  title="<?php echo ($v[title]); ?>" style="<?php echo ($v[style]); ?>"/></a>
            </div>
            <i data-role="close" class="icon icon-close"></i>
        </div><?php endforeach; ?>
    <div class="m-top-bar editable" moduleId="1539923" style="position:relative;min-height:25px;">
        <div class="container">
            <ul class="fl">
                <li class="fl">服务热线：<?php echo ($tpshop_config['shop_info_phone']); ?></li>
                <li class="fl dropdown mobile-feiniu"><a class="menu-item" href=""><i class="fl ico"></i>
                    <span class="fl">手机逛商城</span>
                    <i class="dd"></i></a>
                    <div class="sub-panel m-lst">
                        <p>扫一扫，手机逛商城</p>
                        <dl>
                            <dt class="fl mr10"><a target="_blank" href=""><img height="80" width="80" src="/Template/pc/soubao/Static/images/qrcode_vmall_app01.png"></a></dt>
                            <dd class="fl mb10"><i class="andr"></i> Andiord</dd>
                            <dd class="fl"><i class="iph"></i> iPhone</dd>
                        </dl>
                    </div>
                </li>
                <li class="fl" style="color:red;">友情提醒：绿海商城目前测试阶段，请勿购买！</li>
                <!--
                <li class="fl select-city dropdown">
                  <span class="menu-item">
                  <span>送货至：</span>
                  <a title="" alt="" href="" class="J_cur_place"></a><i class="dd"></i></span>
                </li>-->
            </ul>
            <ul class="fr bar-right">
                <li class="fl J_login_status dn nologin">
                    <a class="menu-item fl J_do_login J_chgurl" href="<?php echo U('Home/user/login');?>">
                        <span>您好, 请登录</span> </a><a class="menu-item fl ht" href="<?php echo U('Home/user/reg');?>">免费注册</a>
                </li>
                <li class="fl J_login_status dn islogin"><a href="<?php echo U('Home/user/index');?>" class="userinfo" title="" target="_self"></a>
                    <a href="<?php echo U('Home/user/logout');?>" style="margin:0 10px;" title="退出" target="_self">退出</a></li>
                <li class="fl sep"></li>
                <li class="fl dropdown my-feiniu"><a class="menu-item" target="_blank" href="<?php echo U('/Home/User/index');?>">
                    <span>我的商城</span>
                    <i class="dd"></i></a>
                    <ul class="sub-panel">
                        <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/User/order_list');?>">我的订单</a></li>
                        <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/User/account');?>">我的积分</a></li>
                        <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/User/coupon');?>">我的优惠券</a></li>
                        <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/User/goods_collect');?>">我的收藏夹</a></li>
                        <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/User/comment');?>">我的评论</a></li>
                    </ul>
                </li>
                <li class="fl sep"></li>
                <li class="fl"><a class="menu-item" href="<?php echo U('Home/Article/detail',array('article_id'=>17));?>" target="_blank">
                    <span>帮助中心</span></a></li>
                <li class="fl sep"></li>
                <li class="fl about-us"><a class="txt fl" style="line-height:unset;" href="">关注我们：</a></li>
                <li class="fl dropdown weixin"><a href="" class="fl ico"></a>
                    <div class="sub-panel wx-box">
                        <span class="arrow-b">◆</span>
                        <span class="arrow-a">◆</span>
                        <p class="n"> 扫描二维码 <br>  关注lvhai.shop官方微信 </p>
                        <img width="auto" height="auto" src="/Template/pc/soubao/Static/images/qrcode_vmall_app01.png"></div>
                </li>
            </ul>
        </div>
    </div>
    <div class="m-top-sidebar m-sdb-sale J-sdb " moduleId="2026855" style="z-index:401;" fnp="m-top-sidebar">
        <div class="t-pic"><a href="" target="_blank" class="img-small"><img width="auto" height="auto" class="img100" src="/Template/pc/soubao/Static/images/csmrrvbluacaoflbaacb1akwoks248.jpg"></a><a href="" target="_blank" class="img-big"><img width="auto" height="auto" class="img100" src="/Template/pc/soubao/Static/images/csmrsfbluaoaejs7aacni7xvdgs548.jpg"></a></div>
        <div class="t-main"><a href="" class="bg-floor"></a>
            <div class="tb-tabs">
                <div class="tb-tabs-up">
                    <a href="<?php echo U('Home/Cart/cart');?>" class="i-cart" data-role="ico-cart"><i></i>
                        <span class="text">购物车</span><span id ="miniCartRightQty" class="num">0</span></a>
                    <a href="<?php echo U('/Home/User/order_list');?>" target="_blank" class="i-ico i-ico-order" data-role="ico-btn">
                        <span>我的订单</span><i class="demo-icon">&#xe807;</i></a>
                    <a href="<?php echo U('/Home/User/coupon');?>" target="_blank" class="i-ico i-ico-coupon" data-role="ico-btn">
                        <span>我的优惠券</span><i class="demo-icon">&#xe80f;</i></a>
                    <a href="<?php echo U('/Home/User/goods_collect');?>" target="_blank" class="i-ico i-ico-fav" data-role="ico-btn">
                        <span>我的收藏</span><i class="demo-icon">&#xe808;</i></a>
                    <a href="<?php echo U('/Home/User/comment');?>" target="_blank" class="i-ico i-ico-foot" data-role="ico-btn">
                        <span>我的评论</span><i class="demo-icon">&#xe805;</i></a>
                </div>
                <div class="tb-tabs-down">
                    <div class="rel" style="display: none;" id="cms_share">
                        <div data-tag="share_1" class="bdsharebuttonbox"><a data-cmd="more" class="bds_more" href=""></a></div>
                        <a class="i-ico i-ico-share" href="">
                            <span>分享</span>
                            <i></i></a></div>
                    <a href="" target="_blank" class="i-ico i-ico-ur" data-role="ico-btn">
                        <span>意见反馈</span>
                        <i></i></a><a href="" class="i-ico i-ico-gotop" data-role="ico-gotop"><em></em>
                    <span>返回顶部</span>
                    <i></i></a></div>
                <div class="my-cart-shim"></div>
            </div>
            <div class="my-cart">
                <div class="mn-c-top" ><a href="">我的购物车</a><i data-role="cart-close-btn"></i></div>
                <div class="sub-panel u-fn-cart u-mn-cart">
                    <div id="miniCartRight"></div>
                    <div class="empty-c fn-hide">
                        <span class="ma"><i class="c-i oh"></i>购物车中没有绿海商品哟！</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-top-search editable" moduleId="1539927" style="position:relative;min-height:35px;">
        <div class="container">
            <div class="logo fl">
                <a href="/" target="_blank" class="item fl">
                    <img height="60" width="160" src="<?php echo ($tpshop_config['shop_info_store_logo']); ?>"></a>
                <!-- <a href="" target="_blank" class="item fl"><img height="60" width="140" src="/Template/pc/soubao/Static/images/csmrrvbluvoamtx8aaeoswlm7gg007.gif"></a>--
                <a href="http://beauty.tp-shop.cn" target="_blank" class="item fl">
                    <img height="60" width="140" src="http://img14.fn-mart.com/group1/M00/DC/08/CsnBP1Y691GAZQRtAAAGc8GxEf8284.png">
                </a>-->
            </div>
            <div fnp="m-top-search-form" class="m-top-search-form fl">
                <form name="sourch_form" id="sourch_form" method="post" action="<?php echo U("/Home/Goods/search");?>">
                <div data-role="form-inner" class="s-form"><i class="s-ico"></i>
                    <input type="text" data-role="input-search" autocomplete="off" class="fl s-input" name="q" id="q" value="<?php echo I('q'); ?>" placeholder="搜索关键字"/>
                    <a data-role="btn" href="javascript:void(0);" class="s-btn fl" onclick="if($.trim($('#q').val()) != '') $('#sourch_form').submit();">搜索</a>
                </div>
                <div class="s-hotword">
                    <?php if(is_array($tpshop_config["hot_keywords"])): foreach($tpshop_config["hot_keywords"] as $k=>$wd): ?><a href="<?php echo U('Home/Goods/search',array('q'=>$wd));?>" <?php if($wd == I('q')): ?>class="ht"<?php endif; ?>><?php echo ($wd); ?></a><?php endforeach; endif; ?>
                </div>
                <ul data-role="tip-list" class="s-tip-list">
                </ul>
                </form>
            </div>
            <div class="my-cart fr" id="hd-my-cart">
                <p class="c-n fl"><img src="/Template/pc/soubao/Static/images/cart.png" alt="我的购物车" width="auto" height="auto"></p>
                <p class="c-num fl quantity"><span class="count cart_quantity" id="cart_quantity"></span></p>
                <div id="show_minicart" class="sub-panel u-fn-cart u-mn-cart">
                    <div id="minicart" class="minicartContent">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div fnp="m-top-search-fixed" class="m-top-search-fixed"><i class="s-bg"></i>
        <div class="fix-bar">
            <div class="container">
                <div class="u-g-logo fl"><a target="_blank" class="fl logo" href=""><img height="40" width="100" src="/Template/pc/soubao/Static/images/logo3.png"></a></div>
                <div fnp="m-top-search-form" class="m-top-search-form fl">
                    <form data-role="form" action="http://search.tp-shop.cn">
                        <div data-role="form-inner" class="s-form"><i class="s-ico"></i>
                            <input type="text" data-role="input-search" autocomplete="off" class="fl s-input" name="q">
                            <input type="hidden" data-role="input-c" name="cpseq" disabled="disabled">
                            <a data-role="btn" href="" class="s-btn fl">搜索</a></div>
                        <ul data-role="tip-list" class="s-tip-list">
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="m-top-nav editable" moduleId="1539926" style="position:relative;min-height:35px;">
        <div class="main-container new-year">
            <div class="main-title-wrap">
                <a href="javascript:" target="_blank" class="main-title">
      		<span class="ico"><i class="il il-lt"></i><i class="il il-lc"></i><i class="il il-lb"></i>
      		<i class="il il-rt"></i><i class="il il-rc"></i><i class="il il-rb"></i></span>
                    商城商品分类
                </a>
                <div class="main-slider" style ="display:none;position: absolute;top: 40px;">
                    <div fnp="nav-list" class="nav-list eidtModule" moduleId="nav">
                        <ul class="nav-list-warpper">
                            <?php if(is_array($goods_category_tree)): foreach($goods_category_tree as $k=>$vo): ?><li data-role="nav-item" class="nav-item" index="<?php echo ($vo["id"]); ?>">
                  <span class="nav-menu-item">
                    <i class="iconlvhai icon icon-f<?php echo ($vo["id"]); ?>"></i>
                    <span class="title"><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$vo[id]));?>" target="_blank"><?php echo ($vo["name"]); ?></a></span>
                  </span>
                                    <div class="submenu column-item">
                                        <?php if(is_array($vo["tmenu"])): foreach($vo["tmenu"] as $k2=>$v2): if($k2 < 12): ?><span class="name"><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v2[id]));?>" target="_blank"><?php echo ($v2["name"]); ?></a></span><?php endif; endforeach; endif; ?>
                                    </div>
                                </li><?php endforeach; endif; ?>
                        </ul>
                        <?php if(is_array($goods_category_tree)): foreach($goods_category_tree as $k=>$vo): ?><div data-role="menu-sub" class="menu-sub" index ="<?php echo ($k); ?>" style="height:440px">
                                <div class="sub-columns">
                                    <?php if(is_array($vo["tmenu"])): foreach($vo["tmenu"] as $k2=>$v2): if($k2%3 == 0): ?><div class="fn-clear column-item">
                                                <div class="tlt">
                                                    <span class="name"><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v2[id]));?>" target="_blank"><?php echo ($v2["name"]); ?></a></span>
                                                </div>
                                                <div class="words">
                                                    <?php if(is_array($v2["sub_menu"])): foreach($v2["sub_menu"] as $key=>$v3): ?><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v3[id]));?>" <?php if($v3[is_hot] == 1): ?>class="lh"<?php endif; ?> target="_blank"><?php echo ($v3["name"]); ?></a><?php endforeach; endif; ?>
                                                </div>
                                            </div><?php endif; endforeach; endif; ?>
                                </div>

                                <div class="sub-columns">
                                    <?php if(is_array($vo["tmenu"])): foreach($vo["tmenu"] as $k2=>$v2): if($k2%3 == 1): ?><div class="fn-clear column-item">
                                                <div class="tlt">
                                                    <span class="name"><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v2[id]));?>" target="_blank"><?php echo ($v2["name"]); ?></a></span>
                                                </div>
                                                <div class="words">
                                                    <?php if(is_array($v2["sub_menu"])): foreach($v2["sub_menu"] as $key=>$v3): ?><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v3[id]));?>" <?php if($v3[is_hot] == 1): ?>class="lh"<?php endif; ?> target="_blank"><?php echo ($v3["name"]); ?></a><?php endforeach; endif; ?>
                                                </div>
                                            </div><?php endif; endforeach; endif; ?>
                                </div>
                                <div class="sub-columns">
                                    <?php if(is_array($vo["tmenu"])): foreach($vo["tmenu"] as $k2=>$v2): if($k2%3 == 2): ?><div class="fn-clear column-item">
                                                <div class="tlt">
                                                    <span class="name"><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v2[id]));?>" target="_blank"><?php echo ($v2["name"]); ?></a></span>
                                                </div>
                                                <div class="words">
                                                    <?php if(is_array($v2["sub_menu"])): foreach($v2["sub_menu"] as $key=>$v3): ?><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v3[id]));?>" <?php if($v3[is_hot] == 1): ?>class="lh"<?php endif; ?> target="_blank"><?php echo ($v3["name"]); ?></a><?php endforeach; endif; ?>
                                                </div>
                                            </div><?php endif; endforeach; endif; ?>
                                </div>
                                <div class="right-wrap">
                                    <ul class="li-item">
                                        <?php if(is_array($vo["brand"])): $i = 0; $__LIST__ = $vo["brand"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$br): $mod = ($i % 2 );++$i;?><li class="item" <?php if(($mod) == "1"): ?>even<?php endif; ?>>
                                            <a href="<?php echo U('Goods/goodsList',array('brand_id'=>$br[id]));?>" target="_blank">
                                                <img width="auto" height="auto" class="nav-prod" src="/Template/pc/soubao/Static/images/loading.gif" alt="" data-images="<?php echo ($br["logo"]); ?>"></a>
                                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                        <li class="item"><a href="" target="_blank"><img width="auto" height="auto" class="nav-prod" src="/Template/pc/soubao/Static/images/loading.gif" alt="" data-images=""></a></li>
                                        <li class="item even"><a href="" target="_blank"><img width="auto" height="auto"class="nav-prod" src="/Template/pc/soubao/Static/images/loading.gif" alt="" data-images=""></a></li>
                                    </ul>
                                    <?php $pid =80+$k;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->getField("position_id,position_name,ad_width,ad_height");$result = D("ad")->where("pid=$pid  and enabled = 1 and start_time < 1541235600 and end_time > 1541235600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select(); if(!in_array($pid,array_keys($ad_position)) && $pid) { M("ad_position")->add(array( "position_id"=>$pid, "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ", "is_open"=>1, "position_desc"=>CONTROLLER_NAME."页面", )); delFile(RUNTIME_PATH); } $c = 1- count($result); if($c > 0 && $_GET[edit_ad]) { for($i = 0; $i < $c; $i++) { $result[] = array( "ad_code" => "/Public/images/not_adv.jpg", "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid", "title" =>"暂无广告图片", "not_adv" => 1, "target" => 0, ); } } foreach($result as $key=>$vv): $vv[position] = $ad_position[$vv[pid]]; if($_GET[edit_ad] && $vv[not_adv] == 0 ) { $vv[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; $vv[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$vv[ad_id]"; $vv[title] = $ad_position[$vv[pid]][position_name]."===".$vv[ad_name]; $vv[target] = 0; } ?><a href="<?php echo ($vv["ad_link"]); ?>" target="_blank">
                                            <img width="auto" height="auto" title="<?php echo ($vv[title]); ?>" style="<?php echo ($vv[style]); ?>" data-images="<?php echo ($vv[ad_code]); ?>" class="right-img nav-prod" src="/Template/pc/soubao/Static/images/loading.gif">
                                        </a><?php endforeach; ?>
                                </div>
                            </div><?php endforeach; endif; ?>
                    </div>
                </div>
            </div>
            <ul class="main-nav">
                <li class="nav-item"><a class="menu-item <?php if( CONTROLLER_NAME == 'Index' ): ?>menu-item-active"<?php endif; ?> target="_blank" href="/" style="overflow: visible;">首页 </a></li>
                <?php
 $md5_key = md5("SELECT * FROM `__PREFIX__navigation` where is_show = 1 ORDER BY `sort` DESC"); $result_name = $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("SELECT * FROM `__PREFIX__navigation` where is_show = 1 ORDER BY `sort` DESC"); S("sql_".$md5_key,$sql_result_v,31104000); } foreach($sql_result_v as $k=>$v): ?><li class="nav-item"><a  style="overflow: visible;"   href="<?php echo ($v[url]); ?>"
                        <?php  if(strpos(($_SERVER['REQUEST_URI']. '/'), (str_replace('&amp;','&',$v[url]). '/')) !== false){ echo "class='menu-item menu-item-active'";} else{ echo "class='menu-item'"; } ?>> <?php echo ($v[name]); ?> </a></li><?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div>
        <div class="J_side_nav_trigger"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.main-title').hover(function(){
            $('.main-slider').show();
        }, function(){
            $('.main-slider').hide();
        });

        $('.nav-list-warpper').hover(function(){
            $('.main-slider').show();
        }, function(){
            $('.main-slider').hide();
        });

        get_cart_num();
        var uname= getCookie('uname');
        if(uname == ''){
            $('.islogin').remove();
            $('.nologin').show();
            $('body').addClass('not-login');
        }else{
            $('.islogin').show();
            $('.nologin').remove();
            $('.userinfo').html(decodeURIComponent(decodeURIComponent(uname)));
            $('body').addClass('login');
        }
    });


    function get_cart_num(){
        var cart_cn = getCookie('cn');
        if(cart_cn == ''){
            $.ajax({
                type : "GET",
                url:"/index.php?m=Home&c=Cart&a=header_cart_list",//+tab,
                success: function(data){
                    cart_cn = getCookie('cn');
                }
            });
        }
        $('#cart_quantity').html(cart_cn);
        $('#miniCartRightQty').html(cart_cn);
    }
</script>
<script type="text/javascript" src="/Template/pc/soubao/Static/js/jquery.jqzoom.js"></script>
<script src="/Public/js/pc_common.js"></script>
<div id="global-nav" class="clearfix">
  <div class="m-nav-content">
    <div class="m-nav-category"></div>
    <div class="m-nav-search u-g-search"></div>
    <div class="m-nav-cart"></div>
  </div>
</div>
<!-- warpper-->
<div id="warpper" class="clearfix">
  <div id="path-new" class="clearfix colaaa text13">
    <div class="item fl">
      <div class="fl">
        <span class="u-nav-title">
          <?php if($goodsCate['parent_id'] == 0): ?><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$goodsCate['id']));?>"><?php echo ($goodsCate["parent_name"]); ?></a>
            <?php else: ?>
            <a href="<?php echo U('Home/Goods/goodsList',array('id'=>$goodsCate['parent_id']));?>"><?php echo ($goodsCate["parent_name"]); ?></a><?php endif; ?>
        </span>
      </div>
      <div class="fl" id="m-selected-cery">
        <div class="u-left-icon"><i class="z-arrow"></i></div>

        <!--如果当前分类是三级分类 则二级也要显示-->
        <?php if($goodsCate[level] == 3): ?><div class="u-nav-attr"> <a href="javascript:;"><?php echo ($goods_category[$goodsCate[parent_id]][name]); ?><i></i></a>
            <span class="z-blank-bar"></span>
            <ul class="u-attr-list">
              <?php if(is_array($goods_category)): foreach($goods_category as $k=>$v): if(($v[parent_id] == $goods_category[$goodsCate[parent_id]][parent_id])): ?><li><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v['id']));?>"><?php echo ($v[name]); ?></a></li><?php endif; endforeach; endif; ?>
            </ul>
          </div><?php endif; ?>
        <!--当前分类-->
        <?php if($goodsCate[level] == 2): ?><div class="u-nav-attr"> <a href="<?php echo U('Home/Goods/goodsList',array('id'=>$goodsCate['parent_id']));?>"><?php echo ($goodsCate["name"]); ?><i></i></a>
            <span class="z-blank-bar"></span>
            <ul class="u-attr-list">
              <?php if(is_array($goods_category)): foreach($goods_category as $k=>$v): if(($v[parent_id] == $goodsCate[parent_id])): ?><li><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v['id']));?>"><?php echo ($v[name]); ?></a></li><?php endif; endforeach; endif; ?>
            </ul>
          </div><?php endif; ?>
        <?php if($goodsCate[level] == 1): ?><div class="u-nav-attr">
            <a href="<?php echo U('Home/Goods/goodsList',array('id'=>$goodsCate['id']));?>"><?php echo ($goodsCate["name"]); ?><i></i></a>
            <span class="z-blank-bar"></span>
            <ul class="u-attr-list">
              <?php if(is_array($cateArr)): foreach($cateArr as $k=>$v): ?><li><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v['id']));?>"><?php echo ($v[name]); ?></a></li><?php endforeach; endif; ?>
            </ul>
          </div><?php endif; ?>

      </div>
    </div>
    <div class="u-left-icon"><i class="z-arrow"></i></div>
    <?php if(is_array($filter_menu)): foreach($filter_menu as $k=>$v): ?><a title="<?php echo ($v['text']); ?>" href="<?php echo ($v['href']); ?>" class="u-av-label"><?php echo ($v['text']); ?><i></i></a><?php endforeach; endif; ?>


  </div>
  <div class="cata_cart_left">
    <div class="m-cart">
      <p class="title">
        <?php if($goodsCate['parent_id'] == 0): ?><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$goodsCate['id']));?>"><?php echo ($goodsCate["parent_name"]); ?></a>
          <?php else: ?>
          <a href="<?php echo U('Home/Goods/goodsList',array('id'=>$goodsCate['parent_id']));?>"><?php echo ($goodsCate["parent_name"]); ?></a><?php endif; ?>
      </p>
      <!--search/?q=-->
      <div id="cata_list">
        <!-- 分类树 -->
        <ul class="menu_3">
          <?php if(is_array($cateArr)): foreach($cateArr as $k=>$v): ?><li class="menu_two">
              <?php if($v['id'] == $goodsCate['open_id']): ?><span name="submenuicon" class="menuminus"></span>
                <?php else: ?>
                <span name="submenuicon" class="menuplus"></span><?php endif; ?>
              <a  href="<?php echo U('Home/Goods/goodsList',array('id'=>$v['id']));?>" class="menu3_title"><?php echo ($v["name"]); ?></a>
              <div class="second_div">
                <span class="second_span"></span>
                <ul
                <?php if($v['id'] == $goodsCate['open_id']): ?>style="display: block;"
                  <?php else: ?>
                  style="display: none;"<?php endif; ?>>
                <?php if(is_array($v["sub_menu"])): foreach($v["sub_menu"] as $key=>$vv): ?><li><a  href="<?php echo U('Home/Goods/goodsList',array('id'=>$vv['id']));?>"
              <?php if($vv['id'] == $goodsCate['select_id']): ?>class="selected"<?php endif; ?>><?php echo ($vv["name"]); ?></a></li><?php endforeach; endif; ?>
        </ul>
      </div>
      </li><?php endforeach; endif; ?>
      </ul>
      <!-- 分类树 -->
    </div>
  </div>
  <!-- 推荐热卖-->
  <div class="m-rehotbox mt10" style='display:block;'>
    <h2 class="rehottit">推荐热卖</h2>
    <div class="rehotcon" id="rehotcon">

      <?php
 $md5_key = md5("select * from `__PREFIX__goods` where  is_recommend = 1 limit 5"); $result_name = $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("select * from `__PREFIX__goods` where  is_recommend = 1 limit 5"); S("sql_".$md5_key,$sql_result_v,31104000); } foreach($sql_result_v as $k=>$v): ?><div class="hotitem">
          <div class="itemin">
            <a class="proname"  href="<?php echo U('/Home/Goods/goodsInfo',array('id'=>$v[goods_id]));?>">
              <img width="auto" height="auto" src="<?php echo (goods_thum_images($v["goods_id"],200,200)); ?>">
              <span><?php echo ($v[goods_name]); ?></span>
            </a>
            <p class="itemprice">
              <span class="new" rehot="90101748934_201480" style="display: block; float: left;"><i class="fn-rmb">¥</i><?php echo ($v[market_price]); ?></span>
              <a href="<?php echo U('Home/user/login');?>" class="Obtain">登录获取最新价格</a>
              <span class="old"><i class="fn-rmb">¥</i><?php echo ($v[shop_price]); ?></span>
            </p>
          </div>
        </div><?php endforeach; ?>
    </div>
  </div>
</div>
<div class="cata_shop_right" id="tracker_category">
  <style>
    .Obtain{
      color: #da3a4c;
      margin-right: 5px;
      font-size: 14px;
    }
  </style>
  <!-- 商品列表 -->
  <div class="searchbox">
    <div class="list clearfix">
      <ul class="left text12" id="order_ul">
        <!--        <li><a class="col7ac " href1="&sort=recommand&asc=0" style="cursor:pointer;">综合</a></li>-->
        <li> <a class="col7ac <?php if($_GET[sort] == ''): ?>main<?php endif; ?>" href="<?php echo urldecode(U("/Home/Goods/goodsList",$filter_param,''));?>" style="cursor:pointer;"> 默认 </a> </li>
        <li> <a class="col7ac <?php if($_GET[sort] == 'sales_sum'): ?>main<?php endif; ?>" href="<?php echo urldecode(U("/Home/Goods/goodsList",array_merge($filter_param,array('sort'=>'sales_sum','sort_asc'=>'desc')),''));?>" style="cursor:pointer;"> 销量 </a> </li>

        <?php if($_GET['sort_asc'] == 'desc'): ?><li><a class="col7ac  <?php if($_GET[sort] == 'shop_price'): ?>main<?php endif; ?>" href="<?php echo urldecode(U("/Home/Goods/goodsList",array_merge($filter_param,array('sort'=>'shop_price','sort_asc'=>'asc')),''));?>" style="cursor:pointer;">价格<span class="icon_s "></span></a></li>
        <?php else: ?>
        <li><a class="col7ac  <?php if($_GET[sort] == 'shop_price'): ?>main<?php endif; ?>" href="<?php echo urldecode(U("/Home/Goods/goodsList",array_merge($filter_param,array('sort'=>'shop_price','sort_asc'=>'desc')),''));?>" style="cursor:pointer;">价格<span class="icon_s "></span></a></li><?php endif; ?>

        <li><a class="col7ac <?php if($_GET[sort] == 'comment_count'): ?>main<?php endif; ?>" href="<?php echo urldecode(U("/Home/Goods/goodsList",array_merge($filter_param,array('sort'=>'comment_count','sort_asc'=>'desc')),''));?>" style="cursor:pointer;">评论</a></li>
        <li><a class="col7ac <?php if($_GET[sort] == 'is_new'): ?>main<?php endif; ?>"  href="<?php echo urldecode(U("/Home/Goods/goodsList",array_merge($filter_param,array('sort'=>'is_new')),''));?>" style="cursor:pointer;">新品</a></li>
      </ul>
      <!-- Page -->
      <div class="right text12" id="pagenavi">
        <div class="all-number">
          <span>共<?php echo ($page->totalRows); ?>个商品</span>
        </div>
        <p class="pageArea" data-countPage="1">
          <!--<a class="bg_img1"></a>-->
          <span class="colf22e01 fontT"><?php echo ($page->nowPage); ?></span>
          /
          <span class="page_count fontT"><?php echo ($page->totalPages); ?></span>
          <!--<a href="" class="bg_img2"></a> </p>-->
      </div>
      <!-- Page End-->
    </div>
    <!-- list -->
  </div>
  <!-- searchbox -->

  <ul id="cata_choose_product" class="cart_containt clearfix listContainer">
    <?php if(is_array($goods_list)): foreach($goods_list as $k=>$v): ?><li>
        <div class="listbox clearfix">
          <!-- 圖片 -->
          <div class="listPic">
            <a target="_blank" href="<?php echo U('/Home/Goods/goodsInfo',array('id'=>$v[goods_id]));?>" style="width:220px;height:220px;">
              <img width="220" height="220" style="display: block;" data-original="<?php echo (goods_thum_images($v["goods_id"],220,220)); ?>" src="/Template/pc/soubao/Static/images/lazy_loading.jpg" class="fn_img_lazy">
            </a>
          </div>
          <div class="list-scroll J_scrollBox clearfix"> <a href="javascript:void(0);" class="list-scroll-left cbtn"></a>
            <div class="list-scroll-warp J_hideBox">
              <dl class="J_mBox clearfix">
                <?php if(is_array($goods_images)): foreach($goods_images as $k2=>$v2): if($v2[goods_id] == $v[goods_id]): ?><dd>
                      <a href="javascript:void(0);">
                        <img width="30"  height="30" data-img="<?php echo (get_sub_images($v2,$v2[goods_id],220,220)); ?>" src="<?php echo (get_sub_images($v2,$v2[goods_id],30,30)); ?>" style="display: block;">
                      </a>
                    </dd><?php endif; endforeach; endif; ?>
              </dl>
            </div>
            <a href="javascript:void(0);" class="list-scroll-right cbtn"></a> </div>

          <!-- 价格 -->
          <div class="discountPrice">
            <div class="price-cash">
              <span class="text13 colf22e01">¥</span>
              <span class="text18 colf22e01 fontT" id="itemPrice_201510CM130003397"><?php echo ($v[shop_price]); ?></span>
              <del></del>
              <span class="text12" style="float: right;color: gray;position: relative;top:3px"><?php echo ($v[sales_sum]); ?>人付款</span>
            </div>
          </div>
          <!-- 价格 end-->
          <!-- 品名 -->
          <div class="listDescript"> <a target="_blank" href="<?php echo U('/Home/Goods/goodsInfo',array('id'=>$v[goods_id]));?>" class="text13"><?php echo ($v[goods_name]); ?></a><br>
            <span><?php
 $goodsattr=D()->query("select attr_name ,attr_value from tp_goods_attr as a,tp_goods_attribute as b where a.goods_id=$v[goods_id] and a.attr_id=b.attr_id and attr_name='含糖量'"); echo $goodsattr[0]['attr_name']; echo "："; echo $goodsattr[0]['attr_value']; ?></span>
          </div>

          <!-- 價格及字樣 -->
          <div class="itemPrice" >
            <div class="cart_wrapper" > <a class="cartlimit" href="javascript:void(0);" onclick="javascript:AjaxAddCart(<?php echo ($v[goods_id]); ?>,1,0);" ><i class="iconlvhai icon icon-add-cart"></i>加入购物车</a></div>
          </div>
        </div>
      </li><?php endforeach; endif; ?>
    <?php if(empty($goods_list)): ?>暂无商品！<?php endif; ?>
  </ul>

  <!-- Page -->
  <div class="fn-page-css-1 pagintion fix" style="display: block;">
    <div class="pagenavi text12"><?php echo ($page->show()); ?></div>
  </div>
  <!-- 商品列表 -->
</div>
</div>


<div class="fn-cms-footer">
  <div class="m-footer-g">
    <div class="footer-map" >
      <ul class="fn-clear">
        <li class="map"><i class="iconlvhai icon icon-menu"></i><strong class="tit">品类丰富</strong><br/>
          <span class="desc">近万种商品 一站式购买</span>
        </li>
        <li class="map"><i class="iconlvhai icon icon-truck"></i><strong class="tit">送货上门</strong><br/>
          <span class="desc">专职配送 准时送达</span>
        </li>
        <li class="map"><i class="iconlvhai icon icon-location"></i><strong class="tit">源头直采</strong><br/>
          <span class="desc">坚守源头 严格优选</span>
        </li>
        <li class="map"><i class="iconlvhai icon icon-cart"></i><strong class="tit">新鲜低价</strong><br/>
          <span class="desc">新鲜品质 每天节省36%</span>
        </li>
      </ul>
    </div>
    <div class="server-list">
      <ul class="fn-clear">
	    <?php
 $md5_key = md5("select * from `__PREFIX__article_cat` where cat_id in(1,2,3,4,7)"); $result_name = $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("select * from `__PREFIX__article_cat` where cat_id in(1,2,3,4,7)"); S("sql_".$md5_key,$sql_result_v,31104000); } foreach($sql_result_v as $k=>$v): ?><li><i class="iconlvhai icon icon<?php echo ($k+1); ?>"></i>
          <dl class="list-item">
            <dt><?php echo ($v[cat_name]); ?></dt>
            <?php
 $md5_key = md5("select * from `__PREFIX__article` where cat_id = $v[cat_id]  and is_open=1"); $result_name = $sql_result_v2 = S("sql_".$md5_key); if(empty($sql_result_v2)) { $Model = new \Think\Model(); $result_name = $sql_result_v2 = $Model->query("select * from `__PREFIX__article` where cat_id = $v[cat_id]  and is_open=1"); S("sql_".$md5_key,$sql_result_v2,31104000); } foreach($sql_result_v2 as $k2=>$v2): ?><dd><a href="<?php echo U('Home/Article/detail',array('article_id'=>$v2[article_id]));?>"><?php echo ($v2[title]); ?></a></dd><?php endforeach; ?>
          </dl>
        </li><?php endforeach; ?>
      </ul>
    </div>
    <div class="site-info">
      <div class="foot-nav">
	      <a href="http://lvhailife.com/partner.html" target="_blank">城市合伙人</a>| 
	      <a href="http://lvhailife.com/supplier.html" target="_blank">供应商合作</a>| 
	      <a href="http://lvhailife.com/company.html" target="_blank">企业介绍</a>| 
	      <a href="http://lvhailife.com/news.html" target="_blank">新闻资讯</a>| 
	      <a href="http://lvhailife.com/recruit.html" target="_blank">绿海招聘</a>|
	      <a href="" style="cursor:default;text-decoration:none;">客服热线 <?php echo ($tpshop_config['shop_info_phone']); ?></a>
	  </div>
      <div class="link">
        <p>
        Copyright © 2018-2020 <?php echo ($tpshop_config['shop_info_store_name']); ?>  版权所有 保留一切权利 备案号:<?php echo ($tpshop_config['shop_info_record_no']); ?> 
        </p>        
      </div>
      <div class="inline-box logowall"><a href="" class="item shgs" target="_blank"></a><a href="" class="item shwl" target="_blank"></a><a href="" class="item cxwz" target="_blank"></a><a href="" class="item kxwz" target="_blank"></a><a href="" class="item hyyz" target="_blank"></a></div>
    </div>
  </div>
</div>
<div class="kf">
  <div class="kf-header"></div>
  <div class="kf-content">
    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=3135142870&amp;Site=绿海生活&amp;Menu=yes"><img src="/Template/pc/soubao/Static/images/lvhai/2.gif" width="auto" height="auto"><span>客服橙子</span></a>
    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=3135142870&amp;Site=绿海生活&amp;Menu=yes"><img src="/Template/pc/soubao/Static/images/lvhai/2.gif" width="auto" height="auto"><span>客服香梨</span></a>
    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=3135142870&amp;Site=绿海生活&amp;Menu=yes"><img src="/Template/pc/soubao/Static/images/lvhai/2.gif" width="auto" height="auto"><span>客服提子</span></a>
    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=3135142870&amp;Site=绿海生活&amp;Menu=yes"><img src="/Template/pc/soubao/Static/images/lvhai/2.gif" width="auto" height="auto"><span>客服榴莲</span></a>
    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=3135142870&amp;Site=绿海生活&amp;Menu=yes"><img src="/Template/pc/soubao/Static/images/lvhai/2.gif" width="auto" height="auto"><span>客服山竹</span></a>
  </div>
</div>
<script type="text/javascript" src="/Template/pc/soubao/Static/js/jquery.lazyload.js"></script>
<script type="text/javascript" src="/Template/pc/soubao/Static/js/common.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.kf-header').click(function() {
      $(this).parent().hide();
    });
  });
  if(isMobileBrowser()) {
    var url = window.location.pathname;
    if (url.indexOf('/Home') >= 0) {
      url = url.replace('/Home', '/Mobile');
      location.href = url;
    }
    else if (url.indexOf('m=Home') >= 0) {
      url = url.replace('m=Home', 'm=Mobile');
      location.href = url;
    }
    else {
      location.href = '/index.php/Mobile/Index/index.html';
    }
  }
</script>
<script type="text/javascript">

    function getCookie(cookieName) {
        var strCookie = document.cookie;
        var arrCookie = strCookie.split("; ");
        for(var i = 0; i < arrCookie.length; i++){
            var arr = arrCookie[i].split("=");
            if(cookieName == arr[0]){
                return arr[1];
            }
        }
        return "";
    }
    var name = getCookie("uname");
    var a=document.querySelectorAll(".new")
    var Obtain=document.querySelectorAll(".Obtain")
    console.log(Obtain)

    if(name==""){
        for(var i=0;i<a.length;i++) {
            a[i].style.display="none"
        }
    }else {
        for(var i=0;i<a.length;i++) {
            a[i].style.display="block"
            Obtain[i].innerHTML = "";
        }
    }



    //############   分类导航折叠        ############
    $('span[name="submenuicon"]').each(function(){
        $(this).click(function(){
            if($(this).hasClass('menuplus')){
                $(this).removeClass('menuplus').addClass('menuminus');
                $(this).siblings('.second_div').find('ul').show();
            }else{
                $(this).removeClass('menuminus').addClass('menuplus');
                $(this).siblings('.second_div').find('ul').hide();
            }
        });
    })

    //############   更多类别属性筛选       ###########
    $('.f-out-more').click(function(){
        $('.m-tr').each(function(i,o){
            if(i >  7){
                var attrdisplay = $(o).css('display');
                if(attrdisplay == 'none'){
                    $(o).css('display','block');
                }
                if(attrdisplay == 'block'){
                    $(o).css('display','none');
                }
            }
        });
        if($(this).hasClass('checked')){
            $(this).removeClass('checked tex-center').html('收起<i class="checked"></i>');
        }else{
            $(this).addClass('checked tex-center').html('更多选项');
        }
    })
    $('.f-out-more').trigger('click').html('更多选项'); //  默认点击一下

    //############   更多条件选择        ###########
    $('.f-more').click(function(){
        if($(this).hasClass('checked')){
            $(this).parent().siblings('ul').removeClass('z-show-more');
            $(this).removeClass('checked').html('更多<i></i>');
        }else{
            $(this).parent().siblings('ul').addClass('z-show-more');
            $(this).addClass('checked').html('收起<i class="checked"></i>');
        }
    })

    var cancelBtn = null;
    //############   多选框        ###########
    $('.f-check').click(function(){
        var _this = this;
        var st = 0;
        //关闭前一个多选框
        if(cancelBtn != null){
            $(cancelBtn).parent().siblings('ul').removeClass('z-show-more');
            $(cancelBtn).parent().siblings('ul').find('li >a').each(function(i,o){
                $(o).removeClass('select selected');
                $(o).attr('href',$(o).data('href'));
                $(o).children('i').removeClass('selected').css('display','');
                $(o).unbind('click');
            });
            $(cancelBtn).parent().siblings('.f-ext').show().children('a').removeClass('checked');
            $(cancelBtn).parent().hide();
            $(cancelBtn).siblings().removeClass('u-confirm01');
        }
        cancelBtn = $(_this).parent().siblings('div').find('.u-cancel');

        //打开多选框
        $(_this).addClass('checked');
        $(_this).siblings().addClass('checked');
        $(_this).parent().siblings('.g-btns').show();
        $(_this).parent().siblings('ul').addClass('z-show-more');
        $(_this).parent().siblings('ul').find('li>a').each(function(i,o){
            $(o).addClass('select');
            $(o).children('i').css('display','inline');
            $(o).attr('href','javascript:;');
            $(o).bind('click',function(){
                if($(o).hasClass('selected')){
                    $(o).removeClass('selected');
                    $(o).children('i').removeClass('selected');
                    st--;
                }else{
                    $(o).addClass('selected');
                    $(o).children('i').addClass('selected');
                    $(_this).parent().siblings('.g-btns').children('.u-confirm').addClass('u-confirm01');
                    st++;
                }
                //如果没有选中项,确定按钮点不了
                if(st==0){
                    $(_this).parent().siblings('.g-btns').children('.u-confirm').removeClass('u-confirm01');
                }
            });
        });
        $(_this).parent().hide();
    })


    //############   取消多选        ###########
    $('.g-btns .u-cancel').each(function(){
        $(this).click(function(){
            $(this).parent().siblings('ul').removeClass('z-show-more');
            $(this).parent().siblings('ul').find('li >a').each(function(i,o){
                $(o).removeClass('select selected');
                $(o).attr('href',$(o).data('href'));
                $(o).children('i').removeClass('selected').css('display','');
                $(o).unbind('click');
            });
            $(this).parent().siblings('.f-ext').show().children('a').removeClass('checked');
            $(this).parent().hide();
            $(this).siblings().removeClass('u-confirm01');
        });
    })

    //############   产品图片切换        ###########

    $('.list-scroll-warp').each(function(){
        var _this = this;

        $(_this).children().children().each(function(i,o){
            $(o).mouseover(function(){
                $(o).siblings().removeClass('cur');
                $(o).addClass('cur');
                var img_src = $(o).children().children().attr('data-img');
                $(_this).parent().siblings('.listPic').find('a').children().attr('src',img_src);
            })
        })
    })

    //############   点击多选确定按钮      ############
    // t 为类型  是品牌 还是 规格 还是 属性
    // btn 是点击的确定按钮用于找位置
    get_parment = <?php echo json_encode($_GET); ?>;
    function submitMoreFilter(t,btn)
    {
        // 没有被勾选的时候
        if(!$(btn).hasClass("u-confirm01"))
            return false;

        // 获取现有的get参数
        var key = ''; // 请求的 参数名称
        var val = new Array(); // 请求的参数值
        $(btn).parent().siblings(".f-list").find("li > a.selected").each(function(){
            key = $(this).data('key');
            val.push($(this).data('val'));
        });
        //parment = key+'_'+val.join('_');

        // 品牌
        if(t == 'brand')
        {
            get_parment.brand_id = val.join('_');
        }
        // 规格
        if(t == 'spec')
        {
            if(get_parment.hasOwnProperty('spec'))
            {
                get_parment.spec += '@'+key+'_'+val.join('_');
            }
            else
            {
                get_parment.spec = key+'_'+val.join('_');
            }
        }
        // 属性
        if(t == 'attr')
        {
            if(get_parment.hasOwnProperty('attr'))
            {
                get_parment.attr += '@'+key+'_'+val.join('_');
            }
            else
            {
                get_parment.attr = key+'_'+val.join('_');
            }
        }
        // 组装请求的url
        var url = '';
        for ( var k in get_parment )
        {
            url += "&"+k+'='+get_parment[k];
        }

        //console.log('get_parment',get_parment);
        location.href ="/index.php?m=Home&c=Goods&a=goodsList"+url;
    }

</script>

</body>
</html>