<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html >
<html>
<head>
    <meta name="Generator" content="TPshop v1.1" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>首页-<?php echo ($tpshop_config['shop_info_store_title']); ?></title>
    <meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
    <meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <link rel="stylesheet" type="text/css" href="/Template/mobile/new/Static/css/public.css"/>
    <link rel="stylesheet" type="text/css" href="/Template/mobile/new/Static/css/index.css"/>
    <link rel="stylesheet" href="/Template/mobile/new/Static/css/lvhai.css">
    <link rel="stylesheet" href="/Template/mobile/new/Static/css/new-index.css">
    <script type="text/javascript" src="/Template/mobile/new/Static/js/jquery.js"></script>
    <script type="text/javascript" src="/Template/mobile/new/Static/js/TouchSlide.1.1.js"></script>
    <script type="text/javascript" src="/Template/mobile/new/Static/js/jquery.json.js"></script>
    <script type="text/javascript" src="/Template/mobile/new/Static/js/touchslider.dev.js"></script>
    <script type="text/javascript" src="/Template/mobile/new/Static/js/layer.js" ></script>
    <script src="/Public/js/global.js"></script>
    <script src="/Public/js/mobile_common.js"></script>
    <meta name="baidu-site-verification" content="3HwKFSIamS" />
</head>
<body class="front" >
<div id="page" class="showpage">
    <div style="background:white ">
        <header id="header" style="background-color: white">
            <div id="fake-search" class="index_search">
                <div class="index_search_mid" style="border-radius: 20px; height: auto;width: 100%">
                    <i class="iconlvhai icon icon-search"></i>
                    <input  type="text" id="search_text" class="search_text" value="请输入您所搜索的商品" style="border-radius: 20px;border: 1px solid #666666"/>
                </div>
            </div>
        </header>
        <div id="scrollimg" class="scrollimg" style="width: 100%;padding-left: 0;padding-top: 0;">
            <div class="bd">
                <ul>
                    <?php $pid =2;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->getField("position_id,position_name,ad_width,ad_height");$result = D("ad")->where("pid=$pid  and enabled = 1 and start_time < 1541469600 and end_time > 1541469600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("5")->select(); if(!in_array($pid,array_keys($ad_position)) && $pid) { M("ad_position")->add(array( "position_id"=>$pid, "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ", "is_open"=>1, "position_desc"=>CONTROLLER_NAME."页面", )); delFile(RUNTIME_PATH); } $c = 5- count($result); if($c > 0 && $_GET[edit_ad]) { for($i = 0; $i < $c; $i++) { $result[] = array( "ad_code" => "/Public/images/not_adv.jpg", "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid", "title" =>"暂无广告图片", "not_adv" => 1, "target" => 0, ); } } foreach($result as $key=>$v): $v[position] = $ad_position[$v[pid]]; if($_GET[edit_ad] && $v[not_adv] == 0 ) { $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]"; $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name]; $v[target] = 0; } ?><li><a href="<?php echo ($v["ad_link"]); ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?> ><img width="auto" height="auto"src="<?php echo ($v[ad_code]); ?>" title="<?php echo ($v[title]); ?>"width="100%" style="<?php echo ($v[style]); ?>"/></a></li><?php endforeach; ?>
                </ul>
            </div>
            <div class="hd">
                <ul></ul>
            </div>
        </div>
        <script type="text/javascript">
            TouchSlide({
                slideCell:"#scrollimg",
                titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
                mainCell:".bd ul",
                effect:"leftLoop",
                autoPage:true,//自动分页
                autoPlay:true, //自动播放
                interTime:5000
            });
        </script>
        <!-- <div class="entry-list clearfix">
            <nav>
                <ul>
                    <li>
                        <a href="/index.php/Mobile/Goods/goodsList/id/859.html">
                            <i class="iconlvhai icon icon-fruit"></i>
                            <span>一件代发</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('Activity/group_list');?>">
                            <i class="iconlvhai icon icon-strawberry"></i>
                            <span>拼单</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('Markets/index');?>">
                            <i class="iconlvhai icon icon-market"></i>
                            <span>水果行情</span>
                        </a>
                    </li>
                    <li>
                        <a href="/index.php/Mobile/Index/promoteList.html">
                            <i class="iconlvhai icon icon-shopping"></i>
                            <span>抢货</span>
                        </a>
                    </li>
                    <li>
                        <a href="/index.php/Mobile/Goods/integralMall.html">
                            <i class="iconlvhai icon icon-integral"></i>
                            <span>积分商城</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div> -->
        <section class="index_floor">
            <div class="floor_body">
                <div class="jing">精品推荐
                    <div class="lvhai">LVHAI</div>
                </div>
                <div class=""></div>
                <div id="scroll_best" class="scroll_hot">
                    <div class="bd">
                        <ul>
                            <?php $fl = '1'; ?>
                            <?php
 $md5_key = md5("select * from __PREFIX__goods where is_recommend=1 order by sort limit 9"); $result_name = $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("select * from __PREFIX__goods where is_recommend=1 order by sort limit 9"); S("sql_".$md5_key,$sql_result_v,31104000); } foreach($sql_result_v as $k=>$v): ?><li>
                                    <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id]));?>" title="<?php echo ($v["goods_name"]); ?>">
                                        <div class="index_pro">
                                            <div class="products_kuang">
                                                <img  width="auto" height="auto"src="<?php echo (goods_thum_images($v["goods_id"],400,400)); ?>"></div>
                                            <div class="goods_name"><?php echo ($v["goods_name"]); ?></div>
                                            <div class="price">
                                                <!--<a href="javascript:AjaxAddCart(<?php echo ($v[goods_id]); ?>,1,0);" class="btns">+</a>-->
                                                <span href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id]));?>" class="price_pro price_pro_login">￥<?php echo ($v["shop_price"]); ?>元</span><a href="/index.php/Mobile/User/index.html" class="nologin">登录查看价格</a>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <?php if(($fl++%3 == 0) && ($fl < 9)): ?></ul><ul><?php endif; endforeach; ?>
                    </ul>
                    </div>
                    <div class="hd">
                        <ul></ul>
                    </div>
                </div>
            </div>
        </section>
        <script type="text/javascript">
            TouchSlide({
                slideCell:"#scroll_best",
                titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
                effect:"leftLoop",
                autoPage:true, //自动分页
                //switchLoad:"_src" //切换加载，真实图片路径为"_src"
            });
        </script>
        <section class="index_floor">
            <div class="floor_body" >
                <div class="jing">新品上市
                    <div class="lvhai">LVHAI</div>
                </div>
                <div id="scroll_new" class="scroll_hot">
                    <div class="bd">
                        <ul>
                            <?php $fl = '1'; ?>
                            <?php
 $md5_key = md5("select * from __PREFIX__goods where is_new=1 order by sort limit 9"); $result_name = $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("select * from __PREFIX__goods where is_new=1 order by sort limit 9"); S("sql_".$md5_key,$sql_result_v,31104000); } foreach($sql_result_v as $k=>$v): ?><li>
                                    <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id]));?>" title="<?php echo ($v["goods_name"]); ?>">
                                        <div class="index_pro">
                                            <div class="products_kuang">
                                                <img width="auto" height="auto" src="<?php echo (goods_thum_images($v["goods_id"],400,400)); ?>"></div>
                                            <div class="goods_name"><?php echo ($v["goods_name"]); ?></div>
                                            <div class="price">
                                                <!--<a href="javascript:AjaxAddCart(<?php echo ($v[goods_id]); ?>,1,0);" class="btns">+</a>-->
                                                <span href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id]));?>" class="price_pro price_pro_login">￥<?php echo ($v["shop_price"]); ?>元</span><a href="/index.php/Mobile/User/index.html" class="nologin">登录查看价格</a>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <?php if(($fl++%3 == 0) && ($fl < 9)): ?></ul><ul><?php endif; endforeach; ?></ul>
                    </div>
                    <div class="hd">
                        <ul></ul>
                    </div>
                </div>
            </div>
        </section>
        <script type="text/javascript">
            TouchSlide({
                slideCell:"#scroll_new",
                titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
                effect:"leftLoop",
                autoPage:true, //自动分页
                //switchLoad:"_src" //切换加载，真实图片路径为"_src"
            });
        </script>
        <section class="index_floor">
            <div class="floor_body" >
                <div class="jing">热销商品
                    <div class="lvhai">LVHAI</div>
                </div>
                <div id="scroll_hot" class="scroll_hot">
                    <div class="bd">
                        <ul>
                            <?php $fl = '1'; ?>
                            <?php
 $md5_key = md5("select * from __PREFIX__goods where is_hot=1 order by sort limit 9"); $result_name = $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("select * from __PREFIX__goods where is_hot=1 order by sort limit 9"); S("sql_".$md5_key,$sql_result_v,31104000); } foreach($sql_result_v as $k=>$v): ?><li>
                                    <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id]));?>" title="<?php echo ($v["goods_name"]); ?>">
                                        <div class="index_pro">
                                            <div class="products_kuang">
                                                <img width="auto" height="auto" src="<?php echo (goods_thum_images($v["goods_id"],400,400)); ?>"></div>
                                            <div class="goods_name"><?php echo ($v["goods_name"]); ?></div>
                                            <div class="price">
                                                <!--<a href="javascript:AjaxAddCart(<?php echo ($v[goods_id]); ?>,1,0);" class="btns">+</a>-->
                                                <span href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id]));?>" class="price_pro price_pro_login">￥<?php echo ($v["shop_price"]); ?>元</span><a href="/index.php/Mobile/User/index.html" class="nologin">登录查看价格</a>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <?php if(($fl++%3 == 0) && ($fl < 9)): ?></ul><ul><?php endif; endforeach; ?></ul>
                    </div>
                    <div class="hd">
                        <ul></ul>
                    </div>
                </div>
            </div>
        </section>
        <script type="text/javascript">
            TouchSlide({
                slideCell:"#scroll_hot",
                titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
                effect:"leftLoop",
                autoPage:true, //自动分页
                //switchLoad:"_src" //切换加载，真实图片路径为"_src"
            });
        </script>

        <script type="text/javascript">
            var url = "index.php?m=Mobile&c=Index&a=ajaxGetMore";


            var page = 1;
        </script>
        <!--<div class="floor_body2" >-->
            <!--<h2>————&nbsp;<i class="iconlvhai icon icon-about"></i>猜你喜欢&nbsp;————</h2>-->
            <!--<div id="J_ItemList">-->
                <!--<ul class="product single_item info">-->
                <!--</ul>-->
                <!--<a href="javascript:;" class="get_more" style="text-align:center; display:block;"></a>-->
            <!--</div>-->
            <!--<div id="getmore" style="font-size:.24rem;text-align: center;color:#888;padding:.25rem .24rem .4rem;">-->

            <!--</div>-->
        <!--</div>-->
        <!--
<div class="footer" >
	      <div class="links"  id="TP_MEMBERZONE"> 
	      		<?php if($user_id > 0): ?><a href="<?php echo U('User/index');?>"><span><?php echo ($user["nickname"]); ?></span></a><a href="<?php echo U('User/logout');?>"><span>退出</span></a>
	      		<?php else: ?>
	      		<a href="<?php echo U('User/login');?>"><span>登录</span></a><a href="<?php echo U('User/reg');?>"><span>注册</span></a><?php endif; ?>
	      		<a href="#"><span>反馈</span></a><a href="javascript:window.scrollTo(0,0);"><span>回顶部</span></a>
		  </div>
	      <ul class="linkss" >
		      <li>
		        <a href="#">
		        <i class="footerimg_1"></i>
		        <span>客户端</span></a></li>
		      <li>
		      <a href="javascript:;"><i class="footerimg_2"></i><span class="gl">触屏版</span></a></li>
		      <li><a href="<?php echo U('Home/Index/index');?>" class="goDesktop"><i class="footerimg_3"></i><span>电脑版</span></a></li>
	      </ul>
	  	 <p class="mf_o4">备案号:<?php echo ($tpshop_config['shop_info_record_no']); ?><br/>&copy; 2005-2016 TPshop多商户V1.2 版权所有，并保留所有权利。</p>
</div>
-->
        <script>
            function goTop(){
                $('html,body').animate({'scrollTop':0},600);
            }
        </script>
        <a href="javascript:goTop();" class="gotop"><img width="auto" height="auto" src="/Template/mobile/new/Static/images/topup.png"></a>
    </div>
    <div id="J_demo" style="display:none"></div>
    <div id="search_hide" class="search_hide">
        <div id="mallSearch" class="search_mid">
            <div class="searchdotm">
                <form class="set_ip"name="sourch_form" id="sourch_form" method="post" action="<?php echo U('Goods/search');?>">
                    <div class="mallSearch-input">
                        <div id="s-combobox-135">
                            <input class="s-combobox-input" name="q" id="q"  placeholder="请输入关键词"  type="text" value="<?php echo I('q'); ?>" />
                        </div>
                        <input type="button" value="" class="button"  onclick="if($.trim($('#q').val()) != '') $('#sourch_form').submit();" />
                    </div>
                </form>
                <span class="close">取消</span>
            </div>
        </div>
        <section class="mix_recently_search"><h3>热门搜索</h3>
            <ul>
                <?php if(is_array($tpshop_config["hot_keywords"])): foreach($tpshop_config["hot_keywords"] as $k=>$wd): ?><li><a href="<?php echo U('Goods/search',array('q'=>$wd));?>" <?php if($k == 0): ?>class="ht"<?php endif; ?>><?php echo ($wd); ?></a></li><?php endforeach; endif; ?>
            </ul>
        </section>
    </div>

</div>
<div style="height:50px; line-height:50px; clear:both;"></div>
<div class="v_nav">
	<div class="vf_nav">
		<ul>
			<li> <a href="<?php echo U('Index/index');?>">
			    <i class="iconlvhai icon icon-home"></i>
			    <span>首页</span></a></li>
			<li><a href="tel:<?php echo ($tpshop_config['shop_info_phone']); ?>">
			    <i class="iconlvhai icon icon-chat"></i>
			    <span>客服</span></a></li>
			<li><a href="<?php echo U('Goods/categoryList');?>">
			    <i class="iconlvhai icon icon-options"></i>
			    <span>分类</span></a></li>
			<li>
			<a href="<?php echo U('Cart/cart');?>"  class="Transposition">
			   <em class="global-nav__nav-shop-cart-num" id="cart_quantity" style="right:9px;"></em>
			   <i class="iconlvhai icon icon-cart"></i>
			   <span>购物车</span>
			   </a>
			</li>
			<li><a href="<?php echo U('User/index');?>">
			    <i class="iconlvhai icon icon-avatar"></i>
			    <span>我的</span></a>
			</li>
		</ul>
	</div>
</div>
<script>
    //购物车
    //购物车
    var id=getCookie("id")
    var li= document.querySelector(".Transposition")
	console.log(li)
    if(id==""){
        li.setAttribute("href","<?php echo U('User/index');?>")
    }else {
        li.setAttribute("href","<?php echo U('Cart/cart');?>")
    }
</script>
<script type="text/javascript">
$(document).ready(function(){
	  var cart_cn = getCookie('cn');
	  var uname= getCookie('user_id');
	  if(uname == ''){
	  	$('.islogin').remove();
	  	$('body').addClass('not-login');
	  }else{
	  	$('body').addClass('login');
	  }
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
});
</script>
<!-- 微信浏览器 调用微信 分享js-->
<?php if($signPackage != null): ?><script type="text/javascript" src="/Template/mobile/new/Static/js/jquery.js"></script>
<script src="/Public/js/global.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">

<?php if(ACTION_NAME == 'goodsInfo'): ?>var ShareLink = "http://<?php echo ($_SERVER[HTTP_HOST]); ?>/index.php?m=Mobile&c=Goods&a=goodsInfo&id=<?php echo ($goods[goods_id]); ?>"; //默认分享链接
   var ShareImgUrl = "http://<?php echo ($_SERVER[HTTP_HOST]); echo (goods_thum_images($goods[goods_id],400,400)); ?>"; // 分享图标
<?php else: ?>
   var ShareLink = "http://<?php echo ($_SERVER[HTTP_HOST]); ?>/index.php?m=Mobile&c=Index&a=index"; //默认分享链接
   var ShareImgUrl = "http://<?php echo ($_SERVER[HTTP_HOST]); echo ($tpshop_config['shop_info_store_logo']); ?>"; // 分享图标<?php endif; ?>

var is_distribut = getCookie('is_distribut'); // 是否分销代理
var user_id = getCookie('user_id'); // 当前用户id
//alert(is_distribut+'=='+user_id);

// 如果已经登录了, 并且是分销商
if(parseInt(is_distribut) == 1 && parseInt(user_id) > 0)
{									
	ShareLink = ShareLink + "&first_leader="+user_id;									
}										


// 微信配置
wx.config({
    debug: false, 
    appId: "<?php echo ($signPackage['appId']); ?>", 
    timestamp: '<?php echo ($signPackage["timestamp"]); ?>', 
    nonceStr: '<?php echo ($signPackage["nonceStr"]); ?>', 
    signature: '<?php echo ($signPackage["signature"]); ?>',
    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage','onMenuShareQQ','onMenuShareQZone','hideOptionMenu'] // 功能列表，我们要使用JS-SDK的什么功能
});

// config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在 页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready 函数中。
wx.ready(function(){
    // 获取"分享到朋友圈"按钮点击状态及自定义分享内容接口
    wx.onMenuShareTimeline({
        title: "<?php echo ($tpshop_config['shop_info_store_title']); ?>", // 分享标题
        link:ShareLink,
        imgUrl:ShareImgUrl // 分享图标
    });

    // 获取"分享给朋友"按钮点击状态及自定义分享内容接口
    wx.onMenuShareAppMessage({
        title: "<?php echo ($tpshop_config['shop_info_store_title']); ?>", // 分享标题
        desc: "<?php echo ($tpshop_config['shop_info_store_desc']); ?>", // 分享描述
        link:ShareLink,
        imgUrl:ShareImgUrl // 分享图标
    });
	// 分享到QQ
	wx.onMenuShareQQ({
        title: "<?php echo ($tpshop_config['shop_info_store_title']); ?>", // 分享标题
        desc: "<?php echo ($tpshop_config['shop_info_store_desc']); ?>", // 分享描述
        link:ShareLink,
        imgUrl:ShareImgUrl // 分享图标
	});	
	// 分享到QQ空间
	wx.onMenuShareQZone({
        title: "<?php echo ($tpshop_config['shop_info_store_title']); ?>", // 分享标题
        desc: "<?php echo ($tpshop_config['shop_info_store_desc']); ?>", // 分享描述
        link:ShareLink,
        imgUrl:ShareImgUrl // 分享图标
	});

   <?php if(CONTROLLER_NAME == 'User'): ?>wx.hideOptionMenu();  // 用户中心 隐藏微信菜单<?php endif; ?>
	
});
</script>


<!--微信关注提醒 start-->
<?php if($_SESSION['subscribe']== 0): ?><button class="guide" onclick="follow_wx()">关注公众号</button>
<style type="text/css">
.guide{width:20px;height:100px;text-align: center;border-radius: 8px ;font-size:12px;padding:8px 0;border:1px solid #adadab;color:#000000;background-color: #fff;position: fixed;right: 6px;bottom: 200px;}
#cover{display:none;position:absolute;left:0;top:0;z-index:18888;background-color:#000000;opacity:0.7;}
#guide{display:none;position:absolute;top:5px;z-index:19999;}
#guide img{width: 70%;height: auto;display: block;margin: 0 auto;margin-top: 10px;}
</style>
<script type="text/javascript" src="/Template/mobile/new/Static/js/layer.js" ></script>
<script type="text/javascript">

  // 关注微信公众号二维码	 
function follow_wx()
{
	layer.open({
		type : 1,  
		title: '关注公众号',
		content: '<img src="<?php echo ($wechat_config['qr']); ?>" width="200">',
		style: ''
	});
}
 
</script><?php endif; ?>
<!--微信关注提醒  end--><?php endif; ?>
<!-- 微信浏览器 调用微信 分享js  end-->

<script type="text/javascript">
    $(function() {
        $('#search_text').click(function(){
            $(".showpage").children('div').hide();
            $("#search_hide").css('position','relative').css('top','0px').css('width','100%').css('z-index','999').show();
        })
        $('#get_search_box').click(function(){
            $(".showpage").children('div').hide();
            $("#search_hide").css('position','relative').css('top','0px').css('width','100%').css('z-index','999').show();
        })
        $("#search_hide .close").click(function(){
            $(".showpage").children('div').show();
            $("#search_hide").hide();
        })
    });
    //下拉加载
    //获取滚动条当前的位置
    function getScrollTop() {
        var scrollTop = 0;
        if(document.documentElement && document.documentElement.scrollTop) {
            scrollTop = document.documentElement.scrollTop;
        } else if(document.body) {
            scrollTop = document.body.scrollTop;
        }
        return scrollTop;
    }
    //获取当前可视范围的高度
    function getClientHeight() {
        var innerHeight =  window.innerHeight; //window的高度，即手机的高度
        return innerHeight
    }
    //获取文档完整的高度
    function getScrollHeight() {
        return $("body").height()
    }
    //滚动事件触发
    window.onscroll = function() {

        if(getScrollTop() + getClientHeight() ===getScrollHeight()) {
            $.ajax({
                type : "get",
                url:"/index.php?m=Mobile&c=Index&a=ajaxGetMore&p=" +page,
                dataType:'html',
                success: function(data)
                {
                    if(data){
                        $("#J_ItemList>ul").append(data);
                        page++
                        $('.get_more').hide();
                    }else{
                        $('.get_more').hide();
                        $('#getmore').remove();
                    }
                }
            });


        }
    }
    var wrapTop =document.getElementById('scrollWrap')
</script>
<script>
    $('.search-type li').click(function() {
        $(this).addClass('cur').siblings().removeClass('cur');
        $('#searchtype').val($(this).attr('num'));
    });
    $('#searchtype').val($(this).attr('0'));
</script>
<script src="/Public/js/jqueryUrlGet.js"></script><!--获取get参数插件-->
<script> set_first_leader(); //设置推荐人 </script>
</body>
</html>