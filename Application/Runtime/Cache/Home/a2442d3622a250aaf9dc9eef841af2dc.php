<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta content="zh-cn" http-equiv="content-language">
    <meta name="renderer" content="webkit|ie-comp|ie-stand" />
    <meta http-equiv="Cache-control" content="public" max-age="no-cache" />
    <link rel="shortcut icon"  href="/Template/pc/soubao/Static/images/favicon.ico" />
    <title>首页-<?php echo ($tpshop_config['shop_info_store_title']); ?></title>
    <meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
    <meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
    <style>
        .s-pg a {
            display: block; width: 24px; height: 62px;line-height: 62px;
            background: #000;opacity: .2; z-index: 1;left: 50%; top: 50%;
            margin-top: -31px;padding-left:10px;color: #fff;position: absolute;
            font-size: 30px;font-weight: 400; font-family: SimSun;filter: alpha(opacity=20);
            -webkit-transition: opacity .2s linear 0s;transition: opacity .2s linear 0s;
        }
        .s-pg a.s-prev {margin-left: -395px;}
        .s-pg a.s-next {margin-left: 357px;}
    </style>
    <meta name="baidu-site-verification" content="3HwKFSIamS" />
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
<div class="fn-cms-top">
<?php $pid =1;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->getField("position_id,position_name,ad_width,ad_height");$result = D("ad")->where("pid=$pid  and enabled = 1 and start_time < 1541253600 and end_time > 1541253600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select(); if(!in_array($pid,array_keys($ad_position)) && $pid) { M("ad_position")->add(array( "position_id"=>$pid, "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ", "is_open"=>1, "position_desc"=>CONTROLLER_NAME."页面", )); delFile(RUNTIME_PATH); } $c = 1- count($result); if($c > 0 && $_GET[edit_ad]) { for($i = 0; $i < $c; $i++) { $result[] = array( "ad_code" => "/Public/images/not_adv.jpg", "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid", "title" =>"暂无广告图片", "not_adv" => 1, "target" => 0, ); } } foreach($result as $key=>$v): $v[position] = $ad_position[$v[pid]]; if($_GET[edit_ad] && $v[not_adv] == 0 ) { $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]"; $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name]; $v[target] = 0; } ?><div fnp="m-top-banner" style="background:<?php echo ($v["bgcolor"]); ?>;" class="m-top-banner rel editable" moduleId="2010053" style="position:relative;min-height:35px;">
	 <div class="bar container">
	 	<a class="img-small" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?> href="<?php echo ($v["ad_link"]); ?>"> <img class="img100" width="auto" height="auto" src="<?php echo ($v[ad_code]); ?>"  title="<?php echo ($v[title]); ?>" style="<?php echo ($v[style]); ?>"/></a>
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
  <div class="t-main">
    <div class="tb-tabs">
      <div class="tb-tabs-up">
      	<a href="<?php echo U('Home/Cart/cart');?>" class="i-cart" data-role="ico-cart">
        <span class="text">购物车</span><span id ="miniCartRightQty" class="num"></span></a>
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
        <a href="" target="_blank" class="i-ico i-ico-ur" data-role="ico-btn">
        <span>意见反馈</span>
        <i></i></a><a href="" class="i-ico i-ico-gotop" data-role="ico-gotop"><em></em>
        <span>返回顶部</span>
        <i></i></a></div>
      <div class="my-cart-shim"></div>
    </div>
    <div class="my-cart">
      <div class="mn-c-top" ><a href="<?php echo U('Home/Cart/cart');?>" style="width: auto;height: auto">我的购物车</a><i data-role="cart-close-btn"></i></div>
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
    	<a href="/" target="_blank" class="item fl"><img height="60" width="160" src="<?php echo ($tpshop_config['shop_info_store_logo']); ?>"></a>
    	<!-- <a href="" target="_blank" class="item fl"><img height="60" width="140" src="/Template/pc/soubao/Static/images/csmrrvbluvoamtx8aaeoswlm7gg007.gif"></a>-->
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

<div class="m-top-nav editable" moduleId="1539926" style="position:relative;min-height:35px;">
  <div class="main-container new-year">
    <div class="main-title-wrap"><a href="" target="_blank" class="main-title">
      <span class="ico"><i class="il il-lt"></i><i class="il il-lc"></i><i class="il il-lb"></i>
      <i class="il il-rt"></i><i class="il il-rc"></i><i class="il il-rb"></i></span>商城商品分类</a>
      <!--  <div class="nav-list" fnp="nav-list">
        <ul class="nav-list-warpper">
        </ul>
      </div>-->
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
	get_cart_num();
	var uname= getCookie('uname');
	if(uname == ''){
		$('.islogin').remove();
		$('.nologin').show();
    $('body').addClass('not-login');
	}else{
    $('.islogin').show();
    $('.nologin').remove();
		$('.userinfo').html(decodeURIComponent(uname));
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
			$('#cart_quantity').html(cart_cn);					
		}
	});	
  }
  $('#cart_quantity').html(cart_cn);
  $('#miniCartRightQty').html(cart_cn);
}
</script>

<div id="pageContent">
    <div class="fn-mall">
        <div class="module">
            <div class="main-slider">
                <div fnp="main-slide" class="ui-switchable eidtModule" moduleId="bannerBig">
                    <ul data-role="content" class="ui-switchable-content">
                        <?php $pid =10;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->getField("position_id,position_name,ad_width,ad_height");$result = D("ad")->where("pid=$pid  and enabled = 1 and start_time < 1541253600 and end_time > 1541253600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("6")->select(); if(!in_array($pid,array_keys($ad_position)) && $pid) { M("ad_position")->add(array( "position_id"=>$pid, "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ", "is_open"=>1, "position_desc"=>CONTROLLER_NAME."页面", )); delFile(RUNTIME_PATH); } $c = 6- count($result); if($c > 0 && $_GET[edit_ad]) { for($i = 0; $i < $c; $i++) { $result[] = array( "ad_code" => "/Public/images/not_adv.jpg", "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid", "title" =>"暂无广告图片", "not_adv" => 1, "target" => 0, ); } } foreach($result as $key=>$v): $v[position] = $ad_position[$v[pid]]; if($_GET[edit_ad] && $v[not_adv] == 0 ) { $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]"; $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name]; $v[target] = 0; } ?><li style="background:<?php echo ($v["bgcolor"]); ?>" class="panel slider-panel"><a href="<?php echo ($v["ad_link"]); ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?> >
                                <img width="auto" height="auto" class="img100 prod"  src="<?php echo ($v[ad_code]); ?>" title="<?php echo ($v[title]); ?>" style="<?php echo ($v[style]); ?>"/></a>
                            </li><?php endforeach; ?>
                    </ul>
                    <div class="ctrl-wrapper">
                        <ul class="ui-switchable-nav" data-role="nav">
                            <?php $pid =10;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->getField("position_id,position_name,ad_width,ad_height");$result = D("ad")->where("pid=$pid  and enabled = 1 and start_time < 1541253600 and end_time > 1541253600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("6")->select(); if(!in_array($pid,array_keys($ad_position)) && $pid) { M("ad_position")->add(array( "position_id"=>$pid, "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ", "is_open"=>1, "position_desc"=>CONTROLLER_NAME."页面", )); delFile(RUNTIME_PATH); } $c = 6- count($result); if($c > 0 && $_GET[edit_ad]) { for($i = 0; $i < $c; $i++) { $result[] = array( "ad_code" => "/Public/images/not_adv.jpg", "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid", "title" =>"暂无广告图片", "not_adv" => 1, "target" => 0, ); } } foreach($result as $k=>$v): $v[position] = $ad_position[$v[pid]]; if($_GET[edit_ad] && $v[not_adv] == 0 ) { $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]"; $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name]; $v[target] = 0; } ?><li class="ui-switchable-trigger slider-item"><span><?php echo ($k); ?></span></li><?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="s-pg J_page_box" style="display:block;">
                        <a href="javascript:;" class="s-prev slider-prev" style="color: white;    font-family: SimSun;">&lt;</a>
                        <a href="javascript:;" class="s-next slider-next" style="color: white;    font-family: SimSun;">&gt;</a>
                    </div>
                </div>
                <div class="container rel">
                    <div class="popup imgbox eidtModule" moduleId="bannerright">
                        <?php $pid =15;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->getField("position_id,position_name,ad_width,ad_height");$result = D("ad")->where("pid=$pid  and enabled = 1 and start_time < 1541253600 and end_time > 1541253600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("2")->select(); if(!in_array($pid,array_keys($ad_position)) && $pid) { M("ad_position")->add(array( "position_id"=>$pid, "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ", "is_open"=>1, "position_desc"=>CONTROLLER_NAME."页面", )); delFile(RUNTIME_PATH); } $c = 2- count($result); if($c > 0 && $_GET[edit_ad]) { for($i = 0; $i < $c; $i++) { $result[] = array( "ad_code" => "/Public/images/not_adv.jpg", "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid", "title" =>"暂无广告图片", "not_adv" => 1, "target" => 0, ); } } foreach($result as $k=>$v): $v[position] = $ad_position[$v[pid]]; if($_GET[edit_ad] && $v[not_adv] == 0 ) { $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]"; $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name]; $v[target] = 0; } ?><a class="item item-02" href="<?php echo ($v["ad_link"]); ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?>>
                            <img width="auto" height="auto"class="img100 prod" src="<?php echo ($v[ad_code]); ?>" title="<?php echo ($v[title]); ?>" style="<?php echo ($v[style]); ?>">
                            </a><?php endforeach; ?>
                    </div>
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
                        <?php if(is_array($goods_category_tree)): foreach($goods_category_tree as $k=>$vo): ?><div data-role="menu-sub" class="menu-sub" index ="<?php echo ($k); ?>">
                                <div class="sub-columns">
                                    <?php if(is_array($vo["tmenu"])): foreach($vo["tmenu"] as $k2=>$v2): if($k2%3 == 0): ?><div class="fn-clear column-item">
                                                <div class="tlt">
                                                    <span class="name"><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v2[id]));?>" target="_blank"><?php echo ($v2["name"]); ?></a></span>
                                                </div>
                                                <div class="words">
                                                    <?php if(is_array($v2["sub_menu"])): foreach($v2["sub_menu"] as $key=>$v3): ?><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v3[id]));?>" <?php if($v3[is_hot] == 1): ?>class="lh"<?php endif; ?> target="_blank"><?php echo ($v3["name"]); ?></a>
                                                        asdasdsa<?php endforeach; endif; ?>
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
                                        <?php if(is_array($brand_list)): $i = 0; $__LIST__ = $brand_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i; if(($v2[parent_cat_id] == $vo[id]) AND ($v2[is_hot] == 1)): ?><li class="item <?php if(($mod) == "1"): ?>even<?php endif; ?>">
                                                <a href="<?php echo U('Goods/goodsList',array('brand_id'=>$v2[id]));?>" target="_blank">
                                                    <img width="auto" height="auto" class="nav-prod" src="/Template/pc/soubao/Static/images/loading.gif" alt="" data-images="<?php echo ($v2["logo"]); ?>"></a>
                                                </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                    <?php $pid =80+$k;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->getField("position_id,position_name,ad_width,ad_height");$result = D("ad")->where("pid=$pid  and enabled = 1 and start_time < 1541253600 and end_time > 1541253600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select(); if(!in_array($pid,array_keys($ad_position)) && $pid) { M("ad_position")->add(array( "position_id"=>$pid, "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ", "is_open"=>1, "position_desc"=>CONTROLLER_NAME."页面", )); delFile(RUNTIME_PATH); } $c = 1- count($result); if($c > 0 && $_GET[edit_ad]) { for($i = 0; $i < $c; $i++) { $result[] = array( "ad_code" => "/Public/images/not_adv.jpg", "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid", "title" =>"暂无广告图片", "not_adv" => 1, "target" => 0, ); } } foreach($result as $key=>$vv): $vv[position] = $ad_position[$vv[pid]]; if($_GET[edit_ad] && $vv[not_adv] == 0 ) { $vv[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; $vv[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$vv[ad_id]"; $vv[title] = $ad_position[$vv[pid]][position_name]."===".$vv[ad_name]; $vv[target] = 0; } ?><a href="<?php echo ($vv["ad_link"]); ?>" <?php if($vv['target'] == 1): ?>target="_blank"<?php endif; ?>>
                                        <img width="auto" height="auto"title="<?php echo ($vv[title]); ?>" style="<?php echo ($vv[style]); ?>" data-images="<?php echo ($vv[ad_code]); ?>" class="right-img nav-prod" src="/Template/pc/soubao/Static/images/loading.gif">
                                        </a><?php endforeach; ?>
                                </div>
                            </div><?php endforeach; endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="J_side_nav_trigger"></div>
        <div class="home-market container clearfix">
            <div class="inner clearfix">
                <div class="block-title">
                    <img src="/Template/pc/soubao/Static/images/lvhai/home-hq.png" width="auto" height="auto">
                </div>
                <div class="block-content">
                    <ul>
                        <?php if(is_array($article)): $i = 0; $__LIST__ = $article;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i;?><li class="clearfix">
                                <a href="<?php echo U('Home/Markets/details',array('id'=>$vl['article_id']));?>" class="img"><img width="auto" height="auto" src="<?php echo (hqarticle_thum_images($vl["article_id"],260,130)); ?>"></a>
                                <h3><a href="<?php echo U('Home/Markets/details',array('id'=>$vl['article_id']));?>"><?php echo ($vl["title"]); ?></a></h3>
                                <p><?php echo ($vl["content"]); ?></p>
                                <a href="<?php echo U('Home/Markets/index');?>" class="more">更多 <span>>></span></a>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="module eidtModule" moduleId="1081037_main" parentModuleId ="1081037" moduleCode="cms-index-cchannel">
            <div class="layout container mt30">
                <div class="feture-cates">
                    <ul class="cates-timing clearfix">
                        <li class="item item-title">
                            <h3>限时抢购</h3>
                            <i class="iconlvhai icon icon-lightning"></i>
                            <p>本场距结束还剩</p>
                            <div class="time-item">
                                <strong id="hour_show" class="hour-show"></strong>
                                <span>:</span>
                                <strong id="minute_show" class="minute-show"></strong>
                                <span>:</span>
                                <strong id="second_show" class="second-show"></strong>
                            </div>
                        </li>
                        <?php $pid =50;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->getField("position_id,position_name,ad_width,ad_height");$result = D("ad")->where("pid=$pid  and enabled = 1 and start_time < 1541253600 and end_time > 1541253600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select(); if(!in_array($pid,array_keys($ad_position)) && $pid) { M("ad_position")->add(array( "position_id"=>$pid, "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ", "is_open"=>1, "position_desc"=>CONTROLLER_NAME."页面", )); delFile(RUNTIME_PATH); } $c = 1- count($result); if($c > 0 && $_GET[edit_ad]) { for($i = 0; $i < $c; $i++) { $result[] = array( "ad_code" => "/Public/images/not_adv.jpg", "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid", "title" =>"暂无广告图片", "not_adv" => 1, "target" => 0, ); } } foreach($result as $key=>$v): $v[position] = $ad_position[$v[pid]]; if($_GET[edit_ad] && $v[not_adv] == 0 ) { $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]"; $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name]; $v[target] = 0; } ?><li class="item">
                                <a href="<?php echo ($v["ad_link"]); ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?>>
                                <img width="auto" height="auto" title="<?php echo ($v[ad_name]); ?>" style="<?php echo ($v[style]); ?>" data-original="<?php echo ($v[ad_code]); ?>" class="img100 prod" src="/Template/pc/soubao/Static/images/lazy_loading.jpg">
                                <p><?php echo ($v[ad_name]); ?></p>
                                </a>
                            </li><?php endforeach; ?>
                        <?php $pid =51;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->getField("position_id,position_name,ad_width,ad_height");$result = D("ad")->where("pid=$pid  and enabled = 1 and start_time < 1541253600 and end_time > 1541253600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select(); if(!in_array($pid,array_keys($ad_position)) && $pid) { M("ad_position")->add(array( "position_id"=>$pid, "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ", "is_open"=>1, "position_desc"=>CONTROLLER_NAME."页面", )); delFile(RUNTIME_PATH); } $c = 1- count($result); if($c > 0 && $_GET[edit_ad]) { for($i = 0; $i < $c; $i++) { $result[] = array( "ad_code" => "/Public/images/not_adv.jpg", "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid", "title" =>"暂无广告图片", "not_adv" => 1, "target" => 0, ); } } foreach($result as $key=>$v): $v[position] = $ad_position[$v[pid]]; if($_GET[edit_ad] && $v[not_adv] == 0 ) { $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]"; $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name]; $v[target] = 0; } ?><li class="item">
                                <a href="<?php echo ($v["ad_link"]); ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?>>
                                <img title="<?php echo ($v[ad_name]); ?>" style="<?php echo ($v[style]); ?>" data-original="<?php echo ($v[ad_code]); ?>" class="img100 prod" src="/Template/pc/soubao/Static/images/lazy_loading.jpg">
                                <p><?php echo ($v[ad_name]); ?></p>
                                </a>
                            </li><?php endforeach; ?>
                        <?php $pid =52;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->getField("position_id,position_name,ad_width,ad_height");$result = D("ad")->where("pid=$pid  and enabled = 1 and start_time < 1541253600 and end_time > 1541253600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select(); if(!in_array($pid,array_keys($ad_position)) && $pid) { M("ad_position")->add(array( "position_id"=>$pid, "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ", "is_open"=>1, "position_desc"=>CONTROLLER_NAME."页面", )); delFile(RUNTIME_PATH); } $c = 1- count($result); if($c > 0 && $_GET[edit_ad]) { for($i = 0; $i < $c; $i++) { $result[] = array( "ad_code" => "/Public/images/not_adv.jpg", "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid", "title" =>"暂无广告图片", "not_adv" => 1, "target" => 0, ); } } foreach($result as $key=>$v): $v[position] = $ad_position[$v[pid]]; if($_GET[edit_ad] && $v[not_adv] == 0 ) { $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]"; $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name]; $v[target] = 0; } ?><li class="item">
                                <a href="<?php echo ($v["ad_link"]); ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?>>
                                <img title="<?php echo ($v[ad_name]); ?>" style="<?php echo ($v[style]); ?>" data-original="<?php echo ($v[ad_code]); ?>" class="img100 prod" src="/Template/pc/soubao/Static/images/lazy_loading.jpg">
                                <p><?php echo ($v[ad_name]); ?></p>
                                </a>
                            </li><?php endforeach; ?>
                        <?php $pid =53;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->getField("position_id,position_name,ad_width,ad_height");$result = D("ad")->where("pid=$pid  and enabled = 1 and start_time < 1541253600 and end_time > 1541253600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select(); if(!in_array($pid,array_keys($ad_position)) && $pid) { M("ad_position")->add(array( "position_id"=>$pid, "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ", "is_open"=>1, "position_desc"=>CONTROLLER_NAME."页面", )); delFile(RUNTIME_PATH); } $c = 1- count($result); if($c > 0 && $_GET[edit_ad]) { for($i = 0; $i < $c; $i++) { $result[] = array( "ad_code" => "/Public/images/not_adv.jpg", "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid", "title" =>"暂无广告图片", "not_adv" => 1, "target" => 0, ); } } foreach($result as $key=>$v): $v[position] = $ad_position[$v[pid]]; if($_GET[edit_ad] && $v[not_adv] == 0 ) { $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]"; $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name]; $v[target] = 0; } ?><li class="item">
                                <a href="<?php echo ($v["ad_link"]); ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?>>
                                <img title="<?php echo ($v[ad_name]); ?>" style="<?php echo ($v[style]); ?>" data-original="<?php echo ($v[ad_code]); ?>" class="img100 prod" src="/Template/pc/soubao/Static/images/lazy_loading.jpg">
                                <p><?php echo ($v[ad_name]); ?></p>
                                </a>
                            </li><?php endforeach; ?>
                        <?php $pid =54;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->getField("position_id,position_name,ad_width,ad_height");$result = D("ad")->where("pid=$pid  and enabled = 1 and start_time < 1541253600 and end_time > 1541253600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select(); if(!in_array($pid,array_keys($ad_position)) && $pid) { M("ad_position")->add(array( "position_id"=>$pid, "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ", "is_open"=>1, "position_desc"=>CONTROLLER_NAME."页面", )); delFile(RUNTIME_PATH); } $c = 1- count($result); if($c > 0 && $_GET[edit_ad]) { for($i = 0; $i < $c; $i++) { $result[] = array( "ad_code" => "/Public/images/not_adv.jpg", "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid", "title" =>"暂无广告图片", "not_adv" => 1, "target" => 0, ); } } foreach($result as $key=>$v): $v[position] = $ad_position[$v[pid]]; if($_GET[edit_ad] && $v[not_adv] == 0 ) { $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]"; $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name]; $v[target] = 0; } ?><li class="item">
                                <a href="<?php echo ($v["ad_link"]); ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?>>
                                <img title="<?php echo ($v[ad_name]); ?>" style="<?php echo ($v[style]); ?>" data-original="<?php echo ($v[ad_code]); ?>" class="img100 prod" src="/Template/pc/soubao/Static/images/lazy_loading.jpg">
                                <p><?php echo ($v[ad_name]); ?></p>
                                </a>
                            </li><?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <?php if(is_array($cateList)): foreach($cateList as $k=>$vo): ?><div class="module" moduleId="" parentModuleId="">
                <div class="layout floor floor-0<?php echo ($k+1); ?> container mt30" data-floor="<?php echo ($k+1); ?>">
                    <div class="floor-wrapper">
                        <div class="floor-left">
                            <div class="menu-box">
                                <div class="menu-box-hd eidtModule" moduleId="1081777_main">
                                    <i class="iconlvhai icon icon-f<?php echo ($k+1); ?>"></i>
                                    <p><a><?php echo ($vo["mobile_name"]); ?></a></p>
                                </div>
                                <div class="menu-box-bd eidtModule" moduleId="1081777_leftTopClassify">
                                    <ul class="item-list">
                                        <?php if(is_array($vo["tmenu"])): foreach($vo["tmenu"] as $k2=>$v2): if($k2 < 6): ?><li class="item"><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v2[id]));?>" target="_blank"><?php echo ($v2["name"]); ?></a></li><?php endif; endforeach; endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="floor-right" fnp="tab-switch">
                            <div class="layout-bd eidtModule" style="overflow:hidden" data-role="panels">
                                <div class="goods-list eidtModule" style="overflow:hidden" moduleId="1081777_hotCommodity" >
                                    <?php if(is_array($vo["hot_goods"])): foreach($vo["hot_goods"] as $key=>$vg): ?><dl class="item" href="" target ="_blank">
                                            <dt class="pic"><a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$vg[goods_id]));?>" target ="_blank"><img data-original="<?php echo (goods_thum_images($vg["goods_id"],400,400)); ?>" src="/Template/pc/soubao/Static/images/lazy_loading.jpg" class="hide-prod prod"></a></dt>
                                            <dd class="title"><a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$vg[goods_id]));?>" target ="_blank" class="break-word"><?php echo ($vg["goods_name"]); ?></a>
                                                <span class="poij"><?php
 $goodsattr=D()->query("select attr_name ,attr_value from tp_goods_attr as a,tp_goods_attribute as b where a.goods_id=$vg[goods_id] and a.attr_id=b.attr_id and attr_name='含糖量'"); echo $goodsattr[0]['attr_name']; echo "："; echo $goodsattr[0]['attr_value']; ?></span>
                                            </dd>
                                            <dd class="price">
                                                <span class="curr">¥<font class="p_price" id="100826791_-1081777"><?php echo ($vg["shop_price"]); ?></font></span>
                                                <i class="login-get-price"><a href="<?php echo U('Home/user/login');?>">登录获取最新价格</a></i>
                                                <del class="prev">¥<font><?php echo ($vg["market_price"]); ?></font></del></dd>
                                        </dl><?php endforeach; endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if($k == 0): $pid =100+$k;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->getField("position_id,position_name,ad_width,ad_height");$result = D("ad")->where("pid=$pid  and enabled = 1 and start_time < 1541253600 and end_time > 1541253600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select(); if(!in_array($pid,array_keys($ad_position)) && $pid) { M("ad_position")->add(array( "position_id"=>$pid, "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ", "is_open"=>1, "position_desc"=>CONTROLLER_NAME."页面", )); delFile(RUNTIME_PATH); } $c = 1- count($result); if($c > 0 && $_GET[edit_ad]) { for($i = 0; $i < $c; $i++) { $result[] = array( "ad_code" => "/Public/images/not_adv.jpg", "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid", "title" =>"暂无广告图片", "not_adv" => 1, "target" => 0, ); } } foreach($result as $key=>$v): $v[position] = $ad_position[$v[pid]]; if($_GET[edit_ad] && $v[not_adv] == 0 ) { $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]"; $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name]; $v[target] = 0; } ?><div class="module eidtModule" parentModuleId="" moduleId="">
                        <div class="container mt30"><a href="<?php echo ($v["ad_link"]); ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?> class="banner-img-single">
                            <img width="1188" height="80" class="prod" src="<?php echo ($v[ad_code]); ?>" title="<?php echo ($v[title]); ?>" style="<?php echo ($v[style]); ?>" data-original="<?php echo ($v[ad_code]); ?>" alt=""/></a>
                        </div>
                    </div><?php endforeach; endif; endforeach; endif; ?>
        <div class="module eidtModule" moduleId="" parentModuleId ="" moduleCode="cms-index-selection">
            <div class="layout boutique container mt30">
                <div class="layout-hd">
                    <div class="layout-title fl"><i class="iconlvhai icon icon-hot"></i>爆款推荐</div>
                </div>
                <div class="layout-bd">
                    <div class="boutique-left">
                        <?php
 $md5_key = md5("select * from __PREFIX__goods where is_new=1 order by sort limit 7"); $result_name = $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("select * from __PREFIX__goods where is_new=1 order by sort limit 7"); S("sql_".$md5_key,$sql_result_v,31104000); } foreach($sql_result_v as $k=>$v): ?><div class="item <?php if($k == 0): ?>item-big<?php else: ?>item-small<?php endif; ?> ">
                            <div class="pic"><a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$v[goods_id]));?>" target="_blank"><img class="img100 prod" src="/Template/pc/soubao/Static/images/lazy_loading.jpg" data-original="<?php echo (goods_thum_images($v["goods_id"],400,400)); ?>"></a></div>
                            <a class="title" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$v[goods_id]));?>"><?php echo ($v["goods_name"]); ?></a>
                            <p class="num curr" >¥<font class="p_price" id="100395552_-1081039"><?php echo ($v["shop_price"]); ?></font></p>
                            <i class="login-get-price"><a href="<?php echo U('Home/user/login');?>">登录获取最新价格</a></i>
                    </div><?php endforeach; ?>
                </div>
                <div class="boutique-right">
                    <div class="comment-list" fnp="comments">
                        <ul data-role="content">
                            <li class="comment">
                                <div class="pic"><a href="javascript:;"><img data-original="/Template/pc/soubao/Static/images/comment1.png" class="prod selection-prod" src="/Template/pc/soubao/Static/images/lazy_loading.jpg"></a></div>
                                <div class="info">
                                    <p class="author"><img data-original="" class="prod selection-prod" src="/Template/pc/soubao/Static/images/80_80.gif">
                                        <span>匿名用户</span>
                                    </p>
                                    <div class="detail break-word"><a href="javascript:;" target="_blank">正品的，货真价实，包装精美。</a></div>
                                </div>
                            </li>
                            <li class="comment">
                                <div class="pic"><a href="javascript:;"><img data-original="/Template/pc/soubao/Static/images/comment2.png" class="prod selection-prod" src="/Template/pc/soubao/Static/images/lazy_loading.jpg"></a></div>
                                <div class="info">
                                    <p class="author"><img data-original="" class="prod selection-prod" src="/Template/pc/soubao/Static/images/80_80.gif">
                                        <span>匿名用户</span>
                                    </p>
                                    <div class="detail break-word"><a href="javascript:;">物流特别给力，商品还算不错</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="module eidtModule" parentModuleId="" moduleId="" style="min-height: 25px;">
        <div class="m-fn-plink container mt30">
            <ul class="oh clearfix">
                <?php
 $md5_key = md5("select * from __PREFIX__goods_category where is_show=1 and image !='' order by sort_order desc limit 9"); $result_name = $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("select * from __PREFIX__goods_category where is_show=1 and image !='' order by sort_order desc limit 9"); S("sql_".$md5_key,$sql_result_v,31104000); } foreach($sql_result_v as $k=>$v): ?><li>
                        <p class="n"><?php echo ($v["name"]); ?></p>
                        <a href="<?php echo U('Goods/goodsList',array('id'=>$v[id]));?>" target="_blank" class="p"><img src="<?php echo ($v["image"]); ?>" alt="" title="" width="100" height="100"></a>
                    </li><?php endforeach; ?>
            </ul>
        </div>
    </div>
    <!--
	<div class="J_side_nav mall-side-nav mall-side-nav-show" style="display: block; opacity: 0.95;">
		<div class="side-wrapper">
		<a class="item item-tigger" href="javascript:;"><i class="sep"></i><span class="level">1F</span><span class="text text-twoline">服饰<br>内衣</span></a>
		<a class="item item-tigger" href="javascript:;"><i class="sep"></i><span class="level">2F</span><span class="text text-twoline">鞋靴<br>箱包</span></a>
		<a class="item item-tigger" href="javascript:;"><i class="sep"></i><span class="level">3F</span><span class="text text-twoline">个护<br>清洁</span></a>
		<a class="item item-tigger" href="javascript:;"><i class="sep"></i><span class="level">4F</span><span class="text text-twoline">运动<br>户外</span></a>
		<a class="item item-tigger" href="javascript:;"><i class="sep"></i><span class="level">5F</span><span class="text text-twoline">家电<br>汽配</span></a>
		<a class="item item-tigger" href="javascript:;"><i class="sep"></i><span class="level">6F</span><span class="text text-twoline">生活<br>居家</span></a>
		<a class="item item-tigger item-active" href="javascript:;"><i class="sep"></i><span class="level">7F</span><span class="text text-twoline">母婴<br>馆</span></a>
		<a class="item item-tigger" href="javascript:;"><i class="sep"></i><span class="level">8F</span><span class="text text-twoline">美食<br>城</span></a>
		<a class="item item-tigger" href="javascript:;"><i class="sep"></i><span class="level">9F</span><span class="text text-twoline">图书<br>城</span></a>
		<a class="item item-tigger" href="javascript:;"><i class="sep"></i><span class="level">10F</span><span class="text text-twoline">精选<br>大牌</span></a>
		</div>
	</div>-->
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
</body>
<script type="text/javascript">

    function autoScroll(obj){
        $(obj).find("ul").animate({
            marginTop : '-76px'
        }, 300, function(){
            var $this = $(this);
            $this.find("li:first").appendTo($this);
            $this.css({marginTop : 0});
        });
    }
    $(function(){

        var scroll = setTimeout(setInterval("autoScroll('.home-market')", 4000), 1000);
        $(".home-market .block-content").mouseenter(function(){
            clearInterval(scroll);
        }).mouseleave(function(){
            scroll = setInterval("autoScroll('.home-market .block-content')", 4000);
        });
    });
    $(document).ready(function(){
        $(".m-top-sidebar").hide();
        //当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
        $(window).scroll(function() {
            if ($(window).scrollTop() > 100) {
                $(".m-top-sidebar").fadeIn(1500);
            } else {
                $(".m-top-sidebar").fadeOut(1500);
            }
        });
        //当点击跳转链接后，回到页面顶部位置
        $(".i-ico-gotop").click(function() {
            $('body,html').animate({
                scrollTop: 0
            },100);
            return false;
        });

        $('.switch_tab>.tab-nav>.item').click(function(){
            $(this).addClass('item-active');
            $(this).siblings().removeClass('item-active');
            var showdiv = $(this).attr('rel');
            var hotlist = $(this).parent().parent().siblings('.eidtModule').children('.goods-list');
            if(showdiv =='goods-list'){
                $(this).parent().parent().siblings('.eidtModule').children('.pics').hide();
                hotlist.show();
            }else{
                $(this).parent().parent().siblings('.eidtModule').children('.pics').show();
                hotlist.hide();
            }
            $('.pics-01').find('img').each(function(i,o){
                if($(o).hasClass('prod')){
                    $(o).attr('src',$(o).attr('data-original'));
                    $(o).removeClass('prod');
                    $(o).removeAttr('data-original');
                }
            });
        });
    });

    $(document).ready(function() {
        var length,
            currentIndex = 0, interval,
            hasStarted = false, //是否已经开始轮播
            t = 3000; //轮播时间间隔
        length = $('.slider-panel').length;
        //将除了第一张图片隐藏
        $('.slider-panel:not(:first)').hide();
        //将第一个slider-item设为激活状态
        $('.slider-item:first').addClass('ui-switchable-active');
        //隐藏向前、向后翻按钮
        $('.s-pg').hide();
        //鼠标上悬时显示向前、向后翻按钮,停止滑动，鼠标离开时隐藏向前、向后翻按钮，开始滑动
        $('.slider-panel, .slider-prev, .slider-next').hover(function() {
            stop();
            $('.s-pg').show();
        }, function() {
            $('.s-pg').hide();
            start();
        });
        $('.slider-item').hover(function(e) {
            stop();
            var preIndex = $(".slider-item").filter(".ui-switchable-active").index();
            currentIndex = $(this).index();
            play(preIndex, currentIndex);
        }, function() {
            start();
        });

        $('.slider-prev').unbind('click');
        $('.slider-prev').bind('click', function() {
            prev();
        });
        $('.slider-next').unbind('click');
        $('.slider-next').bind('click', function() {
            next();
        });
        /**
         * 向前翻页
         */
        function prev() {
            var preIndex = currentIndex;
            currentIndex = (--currentIndex + length) % length;
            play(preIndex, currentIndex);
        }
        /**
         * 向后翻页
         */
        function next() {
            var preIndex = currentIndex;
            currentIndex = ++currentIndex % length;
            play(preIndex, currentIndex);
        }
        /**
         * 从preIndex页翻到currentIndex页
         * preIndex 整数，翻页的起始页
         * currentIndex 整数，翻到的那页
         */
        function play(preIndex, currentIndex) {
            $('.slider-panel').eq(preIndex).fadeOut(500).removeClass('zoom-out');
            $('.slider-panel').eq(currentIndex).fadeIn(500).addClass('zoom-out');
            $('.slider-item').removeClass('ui-switchable-active');
            $('.slider-item').eq(currentIndex).addClass('ui-switchable-active');
        }
        /**
         * 开始轮播
         */
        function start() {
            if(!hasStarted) {
                hasStarted = true;
                interval = setInterval(next, t);
            }
        }
        /**
         * 停止轮播
         */
        function stop() {
            clearInterval(interval);
            hasStarted = false;
        }
        //开始轮播
        start();
    });
</script>
<script src="/Public/js/jqueryUrlGet.js"></script><!--获取get参数插件-->
<script>
    set_first_leader(); //设置推荐人
    // 如果是手机浏览器跳到手机
</script>
<script type="text/javascript">
    var intDiff;
    var myDate = new Date();
    var myHours = myDate.getHours();
    var myMinutes = myDate.getMinutes();
    var mySeconds = myDate.getSeconds();
    if (myHours >= 10 && myHours < 24) {
        intDiff = (33 - myHours)*60*60 + (59-myMinutes)*60 + (59-mySeconds);
    }
    else {
        intDiff = (9 - myHours)*60*60 + (59-myMinutes)*60 + (59-mySeconds);
    }
    intDiff = parseInt(intDiff);
    function timer(intDiff){
        window.setInterval(function(){
            var hour=0, minute=0, second=0, day=0;
            if(intDiff > 0){
                hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
                minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
                second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
            }
            if (minute <= 9) minute = '0' + minute;
            if (second <= 9) second = '0' + second;
            $('#hour_show').html('<s id="h"></s>'+hour);
            $('#minute_show').html('<s></s>'+minute);
            $('#second_show').html('<s></s>'+second);
            intDiff--;
        }, 1000);
    }
    $(function(){
        timer(intDiff);
    });
</script>
</html>