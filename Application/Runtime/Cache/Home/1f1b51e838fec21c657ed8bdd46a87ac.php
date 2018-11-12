<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo ($goods["goods_name"]); ?>-<?php echo ($tpshop_config['shop_info_store_title']); ?></title>
  <meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
  <meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="shortcut icon"  href="/Template/pc/soubao/Static/images/favicon.ico" />
  <meta name="applicable-device" content="pc">
  <meta name="mobile-agent" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=8">
  <!--<link rel="stylesheet" href="/Template/pc/soubao/Static/css/common.css?v=1459218814">-->
  <style>
    #collectLink img{
      width: 12px;
      height: 12px;
      padding-top: 6px;
      padding-right: 2px;
    }
    .htt{
      display: none;
    }
  </style>
</head>
<style>
  #see_and_see li{
    /*padding: 10px;*/
    text-align: center;
  }
  .side-public ul li{
    text-align: center;
  }
  .Obtain{
    color: #da3a4c;
    font-weight: bold;
    margin-right: 5px;
    padding-bottom: 10px;

  }
  .Obtain:hover{
    color: #da3a4c;
  }
</style>
<body class="detailfont">
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
<link rel="stylesheet" type="text/css" href="/Template/pc/soubao/Static/css/detail.css">
<link rel="stylesheet" type="text/css" href="/Template/pc/soubao/Static/css/jquery.jqzoom.css">
<link rel="stylesheet" href="/Template/pc/soubao/Static/css/location.css" type="text/css"><!-- 收货地址，物流运费 -->
<div class="container" id="tracker_item">
  <!-- 在线客服-->
  <!-- 在线客服-->
  <!-- 面包屑导航 -->
  <div class="breadcrumb"> <strong><a href="/">首页</a></strong>
    <span>
  	<?php if(is_array($navigate_goods)): foreach($navigate_goods as $k=>$v): ?>&nbsp;<i>></i>&nbsp;<a href="<?php echo U('/Home/Goods/goodsList',array('id'=>$k));?>"><?php echo ($v); ?></a><?php endforeach; endif; ?>
  </span>&nbsp;<i>></i>&nbsp;<em><?php echo ($goods["goods_name"]); ?></em>
  </div>
  <!-- 面包屑导航 end ]] -->
  <!-- 商品内容部分头部 start [[-->
  <div class="product-main fn-clear">
    <div class="product-info">
      <div class="product-info-title">
        <h1 class="superboler"> <?php echo ($goods["goods_name"]); ?></h1>
        <p>
          <?php if($flash_sale['description'] != ''): echo ($flash_sale['description']); ?>
            <?php else: ?>
            <?php echo ($goods["goods_remark"]); endif; ?>
        </p>
      </div>
      <!-- 价格、尺寸&评价 start [[-->
      <div class="product-info-mian fn-clear">
        <!-- 价格、尺寸 start [[-->
        <form id="buy_goods_form" name="buy_goods_form" method="post" >
          <div class="product-value">
            <div class="product-value-area">
              <ul class="product-value-anything product-value-price hide" style="display: block;">
                <li class="refer fn-clear">
                  <!-- <em class="send">送积分&nbsp;<span id="point">49</span>
                  <a href="" target="_blank" class="help_center_url">详</a></em>-->
                  <span class="attr">参&nbsp;考&nbsp;价</span>
                  <del> <q class="fn-rmb">¥</q><strong class="fn-rmb-num" id="proposed_price"><?php echo ($goods["market_price"]); ?></strong> </del> </li>
                <li class="nett fn-clear">
                  <?php if($goods['promoting'] == 1): ?><span class="attr ssm-price-label">优&nbsp;惠&nbsp;价</span>
                    <?php else: ?>
                    <span class="attr fn-price-label">商&nbsp;城&nbsp;价</span><?php endif; ?>
                  <div class="nett-box fn-clear" id="J_product_value">
                    <div class="nett-box-value"> <q class="fn-rmb">¥</q>
                      <?php if($goods['prom_type'] == 1): ?><strong class="fn-rmb-num qh"  id="goods_price"> <?php echo ($goods['flash_sale']['price']); ?> </strong>
                        <i class="onlylost">仅剩<em><strong id="countdown" style="color:#db384c">
                          <script type="text/javascript">
                              function GetRTime2(){
                                  $("#countdown").text(GetRTime('<?php echo (date("Y/m/d H:i:s",$goods['flash_sale']['end_time'])); ?>'));
                              }
                              setInterval(GetRTime2,999);
                          </script>
                        </strong></em></i>
                        <i class="two hide" id="saleCountTime" data-time="23600">仅剩
                          <strong id="time">0</strong>时
                          <strong id="minute">0</strong>分
                          <strong id="second">0</strong>秒
                        </i>
                        <?php else: ?>
                        <strong class="fn-rmb-num" id="goods_price"> <?php echo ($goods["shop_price"]); ?> </strong>
                        <i class="login-get-price">（<a href="<?php echo U('Home/user/login');?>" class="Obtain">登录获取最新价格</a>）</i><?php endif; ?>

                    </div>
                  </div>
                </li>
                <?php if(($goods['shop_price'] >= ($goods['exchange_integral']/$point_rate)) AND $goods['exchange_integral'] > 0): ?><li class="nett cx-info fn-clear">
                    <span class="attr">促销信息</span>
                    <q class="fn-rmb">¥</q><strong class="fn-rmb-num"><?php echo ($goods['shop_price']-$goods['exchange_integral']/$point_rate); ?>+<?php echo ($goods['exchange_integral']); ?>积分</strong>
                  </li><?php endif; ?>
                <li class="nett freight fn-clear">
                  <span class="attr">运&nbsp;&nbsp;&nbsp;费</span>
                  <strong class="fn-rmb-num">符合<a href="/index.php/Home/Article/detail/article_id/9.html">《绿海专送》</a>免运费</strong>
                </li>
                <li class="nett fn-clear">
                  <span class="attr">配&nbsp;送&nbsp;至</span>
                  <!-- 收货地址，物流运费 -start-->
                  <ul class="list1">
                    <li class="summary-stock">
                      <div class="dd">
                        <!--<div class="addrID"><div></div><b></b></div>-->
                        <div class="store-selector">
                          <div class="text" style="width: 150px;"><div></div><b></b></div>
                          <div onclick="$(this).parent().removeClass('hover')" class="close"></div>
                        </div>
                        <span id="dispatching_msg" style="display: none;">有货</span>
                        <select id="dispatching_select" style="display: none;">
                        </select>
                      </div>
                    </li>
                  </ul>
                  <!-- 收货地址，物流运费 -end-->
                </li>
              </ul>
            </div>
            <div class="product-norm" id="productNorm">
              <div class="product-minheight">
                <div id="J_color_format">
                  <!-- 颜色 start [[-->
                  <?php if(is_array($filter_spec)): foreach($filter_spec as $k=>$v): if($v[0][src] != ''): ?><dl class="product-color product-select public-pl67 fn-clear marginFR25">
                        <dt class="attr"><?php echo ($k); ?></dt>
                        <dd class="product-color-info">
                          <ul class="selectCtrl matchProduct fn-clear J_color " data-v="color_select">
                            <?php if(is_array($v)): foreach($v as $k2=>$v2): ?><li <?php if($k2 == 0 ): ?>class="select"<?php endif; ?>>
                              <input type="radio" style="display:none;" rel="<?php echo ($v2[item]); ?>" name="goods_spec[<?php echo ($k); ?>]" value="<?php echo ($v2[item_id]); ?>"  <?php if($k2 == 0 ): ?>checked="checked"<?php endif; ?>/>
                              <span data-spec="" data-id="<?php echo ($v2[item_id]); ?>" title="<?php echo ($v2[item]); ?>"><img src="<?php echo ($v2['src']); ?>" width="auto" height="auto"></span>
                              <b class="ok"></b> <i></i>
                              </li><?php endforeach; endif; ?>
                          </ul>
                        </dd>
                      </dl>
                      <!-- 颜色 end ]]-->
                      <?php else: ?>
                      <!-- 规格 start [[-->
                      <dl class="product-format product-select public-pl67 fn-clear marginFR25">
                        <dt class="attr"><?php echo ($k); ?></dt>
                        <dd class="product-format-info fn-clear">
                          <ul class="selectCtrl matchProduct fn-clear J_etalon " data-v="size_select">
                            <?php if(is_array($v)): foreach($v as $k2=>$v2): ?><li <?php if($k2 == 0 ): ?>class="select"<?php endif; ?>>
                              <input type="radio" style="display:none;" rel="<?php echo ($v2[item]); ?>" name="goods_spec[<?php echo ($k); ?>]" value="<?php echo ($v2[item_id]); ?>" <?php if($k2 == 0 ): ?>checked="checked"<?php endif; ?>/>
                              <span data-spec="35" data-id="<?php echo ($v2[item_id]); ?>" title="<?php echo ($v2[item]); ?>"><?php echo ($v2[item]); ?></span>
                              <b class="ok"></b> </li><?php endforeach; endif; ?>
                          </ul>
                        </dd>
                      </dl><?php endif; endforeach; endif; ?>
                </div>
                <?php if(!empty($filter_spec)): ?><div id="J_showhide_spec">
                    <dl class="marginFR25 product-opt public-pl67 fn-clear">
                      <dt class="attr">已&nbsp;选&nbsp;择</dt>
                      <dd class="product-opt-info">
                        <p></p>
                      </dd>
                    </dl>
                  </div><?php endif; ?>

                <!-- 预约 start ]]-->
                <div id="J_reservation"> </div>
                <!-- 预约 end ]]-->
                <!-- 预售 start ]]-->
                <div id="J_pre_sale"> </div>
                <!-- 预售 end [[-->
                <!-- 数量 start [[-->
                <dl class="product-number public-pl67 fn-clear hide marginFR25" style="display: block;">
                  <dt class="attr">购买数量</dt>
                  <dd class="product-number-select">
                    <ul>
                      <li class="number fn-clear" data-type="match"> <a href="javascript:void(0);" class="mins no-mins" data-carnum="-1">−</a>
                        <input type="string" value="<?php echo ($goods["quantity"]); ?>" class="buyNum tbuyNum" name="goods_num" autocomplete="off" onkeyup="value=value.replace(/[^\d]/g,'')">
                        <a href="javascript:void(0)" class="add" data-carnum="1">+</a> </li>
                      <li id="pre_label">库存<span id="numLast" data-maxnum=""><?php echo ($goods["store_count"]); ?></span>件 &nbsp &nbsp起订数量<span id="numMin"><?php echo ($goods["quantity"]); ?></span>件</li>
                      <li id="ssm_limit_label" style="display:none">限购<strong id="ssm_limit">99</strong>件
                        <span style="display:none" id="over_limit_label">，超过以购物车结算为准 </span>
                      </li>
                      <li id="ssm_label" style="display:none">促销库存<strong id="ssm_qt
                    y">99</strong>件
                        <span style="display:none" id="over_qty_label">，超过以购物车结算为准 </span>
                      </li>
                    </ul>
                  </dd>
                </dl>
                <!-- 数量 end ]]-->
                <dl class="product-number public-pl67 fn-clear hide marginFR25" style="display: block;">
                  <dt class="attr">优惠活动</dt>
                  <p style="padding-top: 3px;"><?php
 foreach ($discount as $key => $value) { echo $value['nummin']; echo '-'; echo $value['nummax']; echo '件'; echo $value['discount']/10; echo '折；  '; } ?></p >
                </dl>
                <dl class="product-number public-pl67 fn-clear hide marginFR25" style="display: block;">
                  <dt class="attr">特别提示</dt>
                  <p style="padding-top: 3px;">当天下单，次日配送 。<br>拼单和一件代发商品，可以快递全国，只要快递能到达的。 </p >

                </dl>

                <!-- 提交按钮 start [[-->
                <div class="product-button public-pl67 fn-clear marginFR25">
                  <p class="beforebuy-txt create-txt"></p>
                  <div class="btn-con">
                    <input type="hidden" name="goods_id" value="<?php echo ($goods["goods_id"]); ?>" />
                    <a id="btnAddCart" href="javascript:;" onclick="javascript:AjaxAddCart(<?php echo ($goods["goods_id"]); ?>,1,0,<?php echo ($goods["is_collage"]); ?>);" class="btn btn-ent flyShop"><i class="iconlvhai icon icon-add-to-cart"></i>加入购物车</a>
                    <a id="addCart_f" href="javascript:;" onclick="javascript:AjaxAddCart(<?php echo ($goods["goods_id"]); ?>,1,1,<?php echo ($goods["is_collage"]); ?>);" class="btn btn-fastpay" style="margin-left: 10px;">立即购买</a>
                    <a id="btnAvailableInform" href="javascript:void(0)" class="btn hide">到货通知</a> </div>
                </div>
                <!-- 提交按钮 end ]]-->
              </div>
              <!-- 温馨提示 start -->
              <dl class="warm public-pl67 marginFR25 hide">
                <dt class="attr hide">温馨提示</dt>
              </dl>
              <!-- 温馨提示 end ]]-->
              <!-- 服务承诺 start [[-->
              <dl class="sevice public-pl67 marginFR25">
                <dt class="attr">服务承诺</dt>
                <dd> <a><i class="iconlvhai icon icon3"></i>
                  <span>支持现场验货货到付款</span>
                </a> <a><i class="fn-icon"></i>
                  <span>正品保证</span>
                </a> <a><i class="fn-icon"></i>
                  <span>假一赔三</span>
                </a> </dd>
              </dl>
              <!-- 服务承诺 end ]]-->
            </div>
          </div>
          <!-- 价格、尺寸 end ]]-->
        </form>
        <!-- 店铺信息&评价 start [[-->
        <div class="product-evaluate">
          <!-- 看了又看 start [[-->
          <div class="side-public side-look item-cf">
            <div class="side-title fn-clear">
              <span class="title">看了又看</span>
              <div class="side-barter"> <a href="javascript:;" class="renovate"></a>
                <a href="javascript:;" class="barter" onclick="replace_look()">换一批</a> </div>
            </div>
            <ul id="see_and_see">

            </ul>
          </div>
          <!-- 看了又看 end ]]-->
        </div>
        <!-- 店铺信息&评价  end ]]-->
      </div>
      <!-- 价格、尺寸&评价 end ]]-->
    </div>
    <!-- 商品大图&小图展示  start [[-->
    <div class="product-gallery">
      <div class="product-photo" id="photoBody">
        <!-- 商品大图介绍 start [[-->
        <div class="product-img jqzoom">
          <img  width="auto" height="auto"id="zoomimg" src="<?php echo (goods_thum_images($goods["goods_id"],400,400)); ?>" jqimg="<?php echo (goods_thum_images($goods["goods_id"],800,800)); ?>">
        </div>
        <!-- 商品大图介绍 end ]]-->
        <!-- 商品小图介绍 start [[-->
        <div class="product-small-img fn-clear"> <a href="javascript:;" class="next-left next-btn fl disabled"></a>
          <div class="pic-hide-box fl">
            <ul class="small-pic" style="left:0;">
              <?php if(is_array($goods_images_list)): foreach($goods_images_list as $k=>$v): ?><li class="small-pic-li <?php if($k == 0): ?>active<?php endif; ?>">
                <a href="javascript:;"><img  width="auto" height="auto" src="<?php echo (get_sub_images($v,$v[goods_id],60,60)); ?>" data-img="<?php echo (get_sub_images($v,$v[goods_id],400,400)); ?>" data-big="<?php echo (get_sub_images($v,$v[goods_id],800,800)); ?>"> <i></i></a>
                </li><?php endforeach; endif; ?>
            </ul>
          </div>
          <a href="javascript:;" class="next-right next-btn fl"></a> </div>
        <!-- 商品小图介绍 end ]]-->
        <!-- 商品放大镜经过图 start [[-->
        <div class="big-pic"> <img  class="postion_img" src="http://img01.fn-mart.com/C/item/2015/0425/201504C250000054/201504C250000116_032572112_800x800_w1.jpg" alt=""  width="800" height="800"> </div>
        <!-- 商品放大镜经过图 end ]]-->
      </div>
      <!-- 收藏商品 start [[-->
      <div class="collect">
        <a href="javascript:void(0);" id="collectLink">
          <i class="collect-ico collect-ico-null"></i>
          <span class="collect-text">收藏商品</span>
          <em class="J_FavCount"></em></a>
        <!-- <a href="javascript:void(0);" id="collectLink"><i class="collect-ico collect-ico-ok"></i>已收藏<em class="J_FavCount">(20)</em></a> -->
      </div>
      <div class="collect" style="float: right" onclick="Birth($(this))" data-id="<?php echo ($goods["goods_id"]); ?>">
        <a href="javascript:void(0);" id="collectLink">
          <img width="auto" height="auto" src="/Template/pc/soubao/Static/images/fen.png" alt="">
        <span class="collect-text">分享商品</span>
        <em class="J_FavCount"></em></a>
      <!-- <a href="javascript:void(0);" id="collectLink"><i class="collect-ico collect-ico-ok"></i>已收藏<em class="J_FavCount">(20)</em></a> -->
    </div>
    </div>
    <!-- 商品大图&小图展示  end ]]-->
  </div>
  <!-- 商品内容部分头部 end ]]-->
  <!-- 商品内容部分左侧侧边栏 start [[-->
  <div class="product-about fn-clear">
    <!-- 商品内容部分左侧侧边栏 相关分类&同类其他品牌&看了又看&picadd start [[-->
    <div class="product-side fl">
      <!-- 相关分类 start [[-->
      <div class="side-related side-public">
        <h2 class="title">相关分类</h2>
        <div class="side-related-inner fn-clear ">
          <?php if(is_array($siblings_cate)): foreach($siblings_cate as $key=>$cat): ?><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$cat[id]));?>" target="_blank"><?php echo ($cat["name"]); ?></a><?php endforeach; endif; ?>
        </div>
      </div>
      <!-- 销量排行榜 start [[-->
      <div class="side-public side-look sale-top">
        <h2 class="title">销量排行榜</h2>
        <ul>
          <?php
 $md5_key = md5("select * from `__PREFIX__goods` where is_recommend = 1 and cat_id=$goods[cat_id] order by goods_id desc limit 6"); $result_name = $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("select * from `__PREFIX__goods` where is_recommend = 1 and cat_id=$goods[cat_id] order by goods_id desc limit 6"); S("sql_".$md5_key,$sql_result_v,31104000); } foreach($sql_result_v as $k=>$v): ?><li>
              <a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$v[goods_id]));?>" class="look-img" target="_blank">
                <img src="<?php echo (goods_thum_images($v["goods_id"],200,200)); ?>" alt=""></a>
              <h4 class="look-title"><a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$v[goods_id]));?>" target="_blank"><?php echo ($v["goods_name"]); ?></a></h4>
              <p class="look-price"><del><q class="fn-rmb">¥</q><strong class="fn-rmb-num"><?php echo ($v["market_price"]); ?></strong>
              </del>
                <q class="fn-rmb">¥</q> <strong class="fn-rmb-num"><?php echo ($v["shop_price"]); ?></strong></p>
              <a href="<?php echo U('Home/user/login');?>" class="Obtain">登录获取最新价格</a>
              <a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$v[goods_id]));?>" class="look-bottom" target="_blank">查看详情</a>
            </li><?php endforeach; ?>
        </ul>
      </div>
      <!-- 销量排行榜 end ]]-->
    </div>
    <!-- 商品内容部分左侧侧边栏 相关分类&同类其他品牌&看了又看&picadd end ]]-->
    <!-- 商品内容主题部分 start [[-->
    <div class="product-detail fl">
      <!-- 优惠套餐&任意搭配 start [[-->
      <div class="detail-package detail-tabcont">
        <div id="J_package_list"> </div>
        <!-- 优惠套餐&任意搭配 end ]]-->
        <!-- 商品介绍&规格包装&评价&售后服务 start [[-->
        <div class="product-article detail-tabcont fn-clear">
          <!-- tab切换 start [[-->
          <div class="detail-tab">
            <ul class="tab fn-clear J_tabFixed">
              <li class="tab-bottn"> <a href="javascript:;"></a> </li>
              <li class="tab-inner" id="tabInner">
                <a href="javascript:void(0);" class="tab-toggle  tab-cur">商品介绍</a>
                <a href="javascript:void(0);" class="tab-toggle">属性参数</a>
                <a href="javascript:void(0);" class="tab-toggle">评价（<em class="total_comment"><?php echo ($commentStatistics['c0']); ?></em>）</a>
                <a href="javascript:void(0);" class="tab-toggle">售后服务</a>
                <div class="addshop-tab" id="J_addshop_tab">
                </div>
              </li>
            </ul>
          </div>
          <!-- tab切换 end ]]-->
          <!-- 商品介绍&规格包装&评价&售后服务 内容部分 start [[-->
          <div class="detail-public" id="detailTop">

            <!-- 商品介绍 start [[-->
            <div class="detail-depict detail-box fn-clear show">
              <!-- 商品介绍内容部分 start [[-->
              <div class="depict-left fl">
                <!-- 商品介绍内容部分__规格参数 start [[ -->
                <div class="depict-text">
                  <p><strong>所有商品属于生鲜类商品，我们严格把关筛选，请用户根据商品所列属性含糖度谨慎选择。</strong></p>
                  <p class="depict-text-title" id="p1">商品名称：<?php echo ($goods["goods_name"]); ?></p>
                  <ul class="depict-list fn-clear">
                    <li>
                      <span>品牌：</span>
                      <span><a href="" title=""><?php echo ($goods['brand_name']); ?></a></span>
                    </li>
                    <li>
                      <span>货号：</span>
                      <span><?php echo ($goods["goods_sn"]); ?></span>
                    </li>
                    <?php if(is_array($goods_attr_list)): foreach($goods_attr_list as $k=>$v): ?><li>
                        <span><?php echo ($goods_attribute[$v[attr_id]]); ?>：</span>
                        <span title="<?php echo ($v[attr_value]); ?>"><?php echo ($v[attr_value]); ?></span>
                      </li><?php endforeach; endif; ?>
                  </ul>
                </div>
                <div class="u-rmd-slide slide hide" id="todayRec"></div>
                <?php echo (htmlspecialchars_decode($goods["goods_content"])); ?>
                <!--  商品介绍内容部分__规格参数 end ]] -->
              </div>
              <!-- 商品介绍内容部分__右导航部分 end ]]-->
              <div class="depict-right fr">
                <div class="depict-aside">
                  <ul class="aside-list J_tabFixed">
                    <li class="aside-cur"> <a href="javascript:;" data-id="product_information"><i class="round-icon"></i>商品描述</a> </li>
                  </ul>
                </div>
              </div>
              <!-- 商品介绍内容部分 end ]]-->
            </div>
            <!-- 商品介绍 end ]]-->
            <!-- 规格包装 start [[-->
            <div class="detail-norm detail-box hide">
              <table class="norm-table">
                <tbody>
                <tr class="title">
                  <th colspan="2">属性</th>
                </tr>
                <?php if(is_array($goods_attr_list)): foreach($goods_attr_list as $k=>$v): ?><tr>
                    <td><?php echo ($goods_attribute[$v[attr_id]]); ?></td>
                    <td><?php echo ($v[attr_value]); ?></td>
                  </tr><?php endforeach; endif; ?>
                </tbody>
              </table>
            </div>
            <!-- 规格包装 end ]]-->
            <!-- 评价 start [[-->
            <div class="detail-assess detail-box hide">
              <div class="fn-comment" id="comment" style="">
                <div class="fn-comment-title">
                  <div class="fn-mt">
                    <h3 class="fl">商品评价</h3>
                    <span class="c-01">（共
        <span class="highlight">
        <span data-user-count="1"><?php echo ($commentStatistics['c0']); ?></span>位</span>参加本商品评论）</span>
                    <span class="fn-mt-a">所有评论均来自已购买本商品会员</span>
                  </div>
                  <div class="fn-mc fix">
                    <div class="fn-mc-lt">
                      <div class="c-01"> <strong>
                        <span data-good-comment-pre="1"><?php echo ($commentStatistics['rate1']); ?></span>
                        <b>%</b></strong>
                        <p>好评率</p>
                      </div>
                      <dl>
                        <dd>好评(
                          <span data-good-comment-pre="1"><?php echo ($commentStatistics['rate1']); ?></span>%)</dd>
                        <dt>
                          <div data-good-bar="1" style="width: <?php echo ($commentStatistics['rate1']); ?>px;"></div>
                        </dt>
                        <dd>中评(
                          <span data-middle-comment-pre="1"><?php echo ($commentStatistics['rate2']); ?></span>%)</dd>
                        <dt>
                          <div data-middle-bar="1" style="width: <?php echo ($commentStatistics['rate2']); ?>px;"></div>
                        </dt>
                        <dd>差评(
                          <span data-low-comment-pre="1"><?php echo ($commentStatistics['rate3']); ?></span>%)</dd>
                        <dt>
                          <div data-low-bar="1" style="width: <?php echo ($commentStatistics['rate3']); ?>px;"></div>
                        </dt>
                      </dl>
                    </div>
                    <div class="fn-mc-ce">
                      <p>评价事项：</p>
                      <ul>
                        <li>买家评论事项：购买后有什么问题, 满意, 或者不满, 都可以在这里评论出来, 这里评论全部源于真实的评论.</li>
                      </ul>
                    </div>
                    <div class="fn-mc-rt">
                      <a href="<?php echo U('Home/User/comment');?>"><button class="btn">发表评价</button></a>
                      <p class="double_points">
                        <span>发表评价可让购买者放心购买哦~ <br> 加精置顶还可获得人气<br></span>
                      </p>
                    </div>
                  </div>
                  <!-- /.fn-mc -->
                </div>
                <div class="fn-comment-list">
                  <div class="fn-mt fix">
                    <ul id="fy-comment-list">
                      <li data-t='1' class="on">全部评论(<span data-totel-comment="1"><?php echo ($commentStatistics['c0']); ?></span>)</li>
                      <li data-t='2'>好评(<span data-good-comment="1"><?php echo ($commentStatistics['c1']); ?></span>)</li>
                      <li data-t='3'>中评(<span data-middle-comment="1"><?php echo ($commentStatistics['c2']); ?></span>)</li>
                      <li data-t='4'>差评(<span data-low-comment="1"><?php echo ($commentStatistics['c3']); ?></span>)</li>
                      <!--<li data-t='5'>晒单(<span data-image-comment="1"><?php echo ($commentStatistics['c4']); ?></span>)</li>-->
                    </ul>
                    <div class="fn-mt-bor" style="left: 0px;"></div>
                  </div>
                  <div class="fn-comment-not" style="display: none;"> 暂无商品评价！只有购买过该商品的用户才能进行评价哦！ </div>
                  <div id="ajax_comment_return"> </div>
                </div>
              </div>
              <div class="loading_box" id="loadingBox" style="display: none;">
    <span class="loading_text"> <i class="loading_icon"></i>
    <span>载入中，请稍等...</span>
    </span>
              </div>
            </div>
            <!-- 评价 end ]]-->
            <!-- 售后服务 start [[-->
            <div class="detail-service detail-box hide">
              <!--转单非生鲜-->
              <p style="font-weight: bold;padding: 20px 0 0 30px;">本商品由绿海网入驻商家提供配送服务，购买前请仔细阅读以下退货说明</p>
              <dl>
                <dt class="highlight">退换货业务受理范围</dt>
                <dd>
                  <ol>
                    <li>鲜果类（水果、水果冷制品、水果组合等）商品自客户签收订单24小时内，如是绿海国际的原因或商品质量问题，我们将及时为您进行退货；</li>
                    <li>非鲜果类（果干，速食包装，水果工具、包装用品等）自客户签收订单七天内，可享受“无理由退货”政策。</li>
                  </ol>
                </dd>
                <dt class="highlight">退换必备条件</dt>
                <dd>
                  <ol>
                    <li>问题货品，请确保商品包装无破损；商品、赠品（如购买时有赠品）、说明书、发票、均齐全；</li>
                    <li>如申请退货的商品为成套商品中的一个商品如礼盒、礼包，则需退此整套商品。</li>
                  </ol>
                </dd>
                <dt class="highlight">注意事项</dt>
                <dd>
                  <ol>
                    <li>为保障客户权益，请客户签收前与配送人员当面核对货品（含赠品）是否与订单一致，确认无误后再签收；</li>
                    <li>如申请退货的商品为成套商品中的一个商品如礼盒、礼包，则需退此整套商品；</li>
                    <li>鲜果类及非鲜果类货品均在规定时间内受理退换货要求，若超过相关时限，我们将不再受理；</li>
                    <li>图片及信息仅供参照，商品将以实物为准。因拍摄灯光及不同显示器色差等问题可能造成商品图片与实物有一定色差，不属质量问题；</li>
                    <li>代金券及积分不可折现，不找零，若您在使用后发生整体退货，所使用代金券不予退还，只退还实际支付金额；</li>
                    <li>通常一张订单只能进行一次退换货操作，为了确保您的权益，请全部检验完毕后与我们联系。</li>
                  </ol>
                </dd>
                <dt class="highlight">若属于下列情形，本公司不承担退换货责任</dt>
                <dd>
                  <ol>
                    <li>如因客户个人原因或保管不当造成质量问题的商品，不予退换；</li>
                    <li>误用或不正确的储存、使用等方法所造成的质量问题，或撕毁、涂改标贴、防伪标记的商品，不予退换货；</li>
                    <li>所有赠品不予退换；</li>
                    <li>对于货品数量不足、错货或无货的情况，司机可受理当场提出的退换货要求，即货物送达后，收货人员当场清点货品数量，如有疑义，当场即时提出，一旦签收，我们将不再受理此类退换货。</li>
                  </ol>
                </dd>
              </dl>
            </div>
            <!-- 售后服务 end ]]-->
          </div>
          <!-- 商品介绍&规格包装&评价&售后服务 内容部分 end ]]-->
        </div>
        <!-- 商品介绍&规格包装&评价&售后服务 end ]]-->
      </div>
      <!-- 商品内容主题部分 end ]]-->
    </div>
    <!-- 商品内容部分左侧侧边栏 end ]]-->
  </div>
</div>

<!-- 弹层内容块 start [[-->
<!-- 看了又看 -->
<div style="display:none">
  <ul id="look_see">
    <?php if(is_array($look_see)): foreach($look_see as $key=>$look): ?><li>
        <a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$look[goods_id]));?>" class="look-img" target="_blank"> <img width="auto" height="auto" src="<?php echo (goods_thum_images($look["goods_id"],200,200)); ?>" alt=""></a>
        <h4 class="look-title">
          <a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$look[goods_id]));?>"><?php echo (getSubstr($look["goods_name"],0,30)); ?></a>
        </h4>
        <p class="look-price">
          <del><q class="fn-rmb">¥</q><strong class="fn-rmb-num"><?php echo ($look["market_price"]); ?></strong></del>
          <q class="fn-rmb">¥</q> <strong class="fn-rmb-num"><?php echo ($look["shop_price"]); ?></strong>
        </p>
        <a href="/index.php/Home/user/login.html" class="Obtain">登录获取最新价格</a>
      </li><?php endforeach; endif; ?>
  </ul>
</div>
<div class="htt" style="float: right" >  http://www.lvhai.shop/index.php/Mobile/Goods/goodsInfo/id/<?php echo ($goods["goods_id"]); ?></div>

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
<script>
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
    var addCart_f=document.querySelector("#addCart_f")
    var price=document.querySelectorAll(".look-price")
    var Obtain=document.querySelectorAll(".Obtain")
    if(name==""){
        for(var i=0;i<price.length;i++){
            price[i].style="display:none"
        }
        addCart_f.setAttribute("href","/index.php/Home/User/login.html")
    }else {
        for(var i=0;i<price.length;i++){
            price[i].style="display:block"
        }
        for(var q=0;q<price.length;q++){
            Obtain[q].style="display:none"
        }
        Obtain.style="display:none"
        addCart_f.setAttribute("href","javascript:;")
    }
    var numMin = parseInt($("#numMin").text());
    $(".tbuyNum").blur(function() {
        var $this = $(this);
        var tbuyNum = parseInt($this.val());
        if(tbuyNum < numMin){
            $this.val(numMin);
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        /*商品缩略图放大镜*/
        $(".jqzoom").jqueryzoom({
            xzoom: 500,
            yzoom: 500,
            offset: 1,
            position: "right",
            preload:1,
            lens:1
        });
        get_goods_price();
        replace_look();
        commentType = 1; // 评论类型
        ajaxComment(1,1);// ajax 加载评价列表
    });

    var store_count = <?php echo ($goods["store_count"]); ?>; // 商品起始库存
    var quantity = <?php echo ($goods["quantity"]); ?>;  //取起订数量
    //缩略图切换
    $('.small-pic-li').each(function(i,o){
        var lilength = $('.small-pic-li').length;
        $(o).hover(function(){
            $(o).siblings().removeClass('active');
            $(o).addClass('active');
            $('#zoomimg').attr('src',$(o).find('img').attr('data-img'));
            $('#zoomimg').attr('jqimg',$(o).find('img').attr('data-big'));

            $('.next-btn').removeClass('disabled');
            if(i==0){
                $('.next-left').addClass('disabled');
            }
            if(i+1==lilength){
                $('.next-right').addClass('disabled');
            }
        });
    })

    //前一张缩略图
    $('.next-left').click(function(){
        var newselect = $('.small-pic>.active').prev();
        $('.small-pic>.active').removeClass('active');
        $(newselect).addClass('active');
        $('#zoomimg').attr('src',$(newselect).find('img').attr('data-img'));
        $('#zoomimg').attr('jqimg',$(newselect).find('img').attr('data-big'));
        var index = $('.small-pic>li').index(newselect);
        if(index==0){
            $('.next-left').addClass('disabled');
        }
        $('.next-right').removeClass('disabled');
    })

    //后前一张缩略图
    $('.next-right').click(function(){
        var newselect = $('.small-pic>.active').next();
        $('.small-pic>.active').removeClass('active');
        $(newselect).addClass('active');
        $('#zoomimg').attr('src',$(newselect).find('img').attr('data-img'));
        $('#zoomimg').attr('jqimg',$(newselect).find('img').attr('data-big'));
        var index = $('.small-pic>li').index(newselect);
        if(index+1 == $('.small-pic>li').length){
            $('.next-right').addClass('disabled');
        }
        $('.next-left').removeClass('disabled');
    })

    //商品介绍、规格、评论、售后切换
    $('#tabInner .tab-toggle').each(function(i,o){
        $(o).click(function(){
            $(o).addClass('tab-cur');
            $(o).siblings().removeClass('tab-cur');
            $('#detailTop .detail-box').hide();
            $('#detailTop .detail-box').eq(i).show();
        })
    });

    //购买数量+1
    $('.mins').click(function(){
        var buynum = parseInt($('.buyNum').val());
        if(buynum>quantity){
            $('.buyNum').val(buynum-1);
        }
        if(buynum-1 ==quantity){
            $('.mins').addClass('no-mins');
        }
        $('.add').removeClass('no-mins');
        return false;
    });

    //购买数量-1
    $('.add').click(function(){
        var buynum = parseInt($('.buyNum').val());
        if(buynum<store_count){
            $('.buyNum').val(buynum+1);
        }
        if(buynum+1 == store_count){
            $('.add').addClass('no-mins');
        }
        $('.mins').removeClass('no-mins');
        return false;
    });
    //

    //选择规格属性
    $('.selectCtrl>li').each(function(){
        if(!$(this).hasClass('nosold')){
            $(this).click(function(){
                $(this).siblings().removeClass('select');
                $(this).siblings().children('input').prop('checked',false);
                $(this).children('input').prop('checked',true);
                $(this).addClass('select');
                get_goods_price();
            })
        }
    })

    /*** 查询商品价格*/
    function get_goods_price()
    {

        var goods_price = <?php echo ($goods["shop_price"]); ?>; // 商品起始价
        var spec_goods_price = <?php echo ($spec_goods_price); ?>;  // 规格 对应 价格 库存表   //alert(spec_goods_price['28_100']['price']);
        // 如果有属性选择项
        console.log(spec_goods_price)
        if(spec_goods_price != null)
        {
            var goods_spec_arr = [];
            var select_str = '';
            $("input[name^='goods_spec']:checked").each(function(){
                goods_spec_arr.push($(this).val());
                select_str += '<span>"'+$(this).attr('rel')+'"</span>';
            });
            $('.product-opt-info').children().empty().html(select_str);
            var spec_key = goods_spec_arr.sort(sortNumber).join('_');  //排序后组合成 key
            var goods_price = spec_goods_price[spec_key]['price']; // 找到对应规格的价格
            var store_count = spec_goods_price[spec_key]['store_count']; // 找到对应规格的库存
            var proposed_price = spec_goods_price[spec_key]['proposed_price']; // 找到对应规格的库存

        }
        var flash_sale_price = parseFloat("<?php echo ($goods['flash_sale']['price']); ?>");
        (flash_sale_price > 0) && (goods_price = flash_sale_price);

        $("#goods_price").html(goods_price); // 变动价格显示
        $("#proposed_price").html(proposed_price); // 变动价格显示

    }

    //用作 sort 排序用
    function sortNumber(a,b)
    {
        return a - b;
    }

    // 好评差评 切换
    $("#fy-comment-list").children().each(function(i,o){
        $(o).click(function(){
            $(o).siblings().removeClass('on');
            $(o).addClass('on');
            commentType = $(o).data('t');// 评价类型   好评 中评  差评
            $('.fn-mt-bor').css('left',(commentType-1)*115);
            ajaxComment(commentType,1);
        });
    });

    // 用ajax分页显示评论
    function ajaxComment(commentType,page){
        $.ajax({
            type : "GET",
            url:"/index.php?m=Home&c=goods&a=ajaxComment&goods_id=<?php echo ($goods['goods_id']); ?>&commentType="+commentType+"&p="+page,//+tab,
            success: function(data){
                $("#ajax_comment_return").html('');
                $("#ajax_comment_return").append(data);
            }
        });
    }

    //看了又看切换
    var tmpindex = 0;
    var look_see_length = $('#look_see').children().length;
    function replace_look(){
        var listr='';
        if(tmpindex*3>=look_see_length) tmpindex = 0;
        //console.log(look_see_length);
        $('#look_see').children().each(function(i,o){
            if((i>=tmpindex*3) && (i<(tmpindex+1)*3)){
                listr += '<li>'+$(o).html()+'</li>';
            }
        });
        tmpindex++;
        $('#see_and_see').empty().append(listr);
    }

    $('#collectLink').click(function(){
        if(getCookie('user_id') == ''){
            layer.open({
                type: 2,
                title: '<b>登陆绿海网</b>',
                skin: 'layui-layer-rim',
                shadeClose: true,
                shade: 0.5,
                area: ['490px', '460px'],
                content: "<?php echo U('Home/User/pop_login');?>",
            });
        }else{
            $.ajax({
                type:'post',
                dataType:'json',
                data:{goods_id:$('input[name="goods_id"]').val()},
                url:"<?php echo U('Home/Goods/collect_goods');?>",
                success:function(res){
                    if(res.status == 1){
                        layer.msg('成功添加至收藏夹', {icon: 1});
                    }else{
                        layer.msg(res.msg, {icon: 3});
                    }
                }
            });
        }
    })
</script>
<!--------收货地址，物流运费-开始-------------->
<script src="/Template/pc/soubao/Static/js/location.js"></script>
<!--------收货地址，物流运费--结束-------------->
<script src="/Public/js/jqueryUrlGet.js"></script><!--获取get参数插件-->
<script src="/Public/js/qrcode.js"></script><!--获取get参数插件-->
<script> set_first_leader(); //设置推荐人
 var url = window.location.href;
 var u=url.replace(/Home/g,"Mobile")
function Birth($ele) {
    var id= $ele.attr("data-id");
    console.log(id)
    layer.open({
        title: '分享到—微信',
        type: 1,
        skin: 'layui-layer-rim', //加上边框
        area: ['240px', '300px'], //宽高
        content:
        '\t\t\t\t<br />\n' +
        '\t\t\t\t<br />\n' +
        '\t\t\t\t<div id="qrcode" style="margin-left:30px;">\n' +
        '\t\t\t\t</div>\n' +
        '\t\t\t\t<br />\n'
    });
    var lv=document.querySelector('.htt').innerHTML
    console.log(lv)
// 设置参数方式
    var qrcode = new QRCode('qrcode', {
        width: 180,
        height: 180,
        colorDark : '#000000',
        colorLight : '#ffffff',
    });
// 使用 API
    qrcode.makeCode(u);
}


</script>
</body>
</html>