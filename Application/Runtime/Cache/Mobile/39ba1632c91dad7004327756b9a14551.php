<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html >
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <title>所有分类-<?php echo ($tpshop_config['shop_info_store_title']); ?></title>
  <meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
  <meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
  <link rel="stylesheet" type="text/css" href="/Template/mobile/new/Static/css/public.css"/>
  <link rel="stylesheet" type="text/css" href="/Template/mobile/new/Static/css/catalog.css"/>
  <link rel="stylesheet" type="text/css" href="/Template/mobile/new/Static/css/layer.css"/>
  <link rel="stylesheet" href="/Template/mobile/new/Static/css/lvhai.css">
  <script type="text/javascript" src="/Template/mobile/new/Static/js/jquery.js"></script>
  <script type="text/javascript" src="/Template/mobile/new/Static/js/layui.js"></script>
  <script src="/Public/js/global.js"></script>
  <style>

    .left{
      width: 20%;
      height: 91%;
      background:	#F0F0F0;
      float: left;
      position: fixed; //TODO
    }
    .left li{
      width: 100%;
      height: 30px;
      border-bottom:1px solid #BEBEBE ;
      font-size: 16px;
      color: black;
      text-align: center;
      padding-top: 10px;
      padding-bottom: 10px;
    }
    .left ul {
      overflow-y: scroll;
      /*height: 600px;*/
      /*margin-top: 40px;*/
    }
    .left li h5{
      color: #7B7B7B;
      font-weight: 300;
    }
    .right{
      float: right;
      width: 80%;
      height: 100vh;
    }
    .top{
      width: 100%;
      height: 10%;
    }
  </style>
</head>
<body class="page-cate">
<div class="container top">
  <div class="category-box">
    <div class="category1" style="outline: none;" tabindex="5000">
      <ul class="clearfix" >
        <?php $m = '0'; ?>
        <?php if(is_array($goods_category_tree)): foreach($goods_category_tree as $k=>$vo): if($vo[level] == 1): ?><li style=" background:#F0F0F0;
" <?php if($m == 0): ?>class='cur'<?php endif; ?> data-id="<?php echo ($m++); ?>"><?php echo (getSubstr($vo['mobile_name'],0,12)); ?></li><?php endif; endforeach; endif; ?>
      </ul>
    </div>
    <div class="left"  style=" outline: none;" tabindex="5001" >
  <?php $j = '0'; ?>
  <?php if(is_array($goods_category_tree)): foreach($goods_category_tree as $kk=>$vo): ?><ul style="<?php if($j == 0): ?>display:block;<?php else: ?>display:none;<?php endif; ?>" data-id="<?php echo ($j++); ?>">
  <?php if(is_array($vo["tmenu"])): foreach($vo["tmenu"] as $k2=>$v2): ?><li>
  <a data-url="<?php echo U('Mobile/Goods/goodsList',array('id'=>$v2[id]));?>" >
  <h5><?php echo ($v2['name']); ?></h5>
  </a>
  </li><?php endforeach; endif; ?>
  </ul><?php endforeach; endif; ?>
</div>
<div class="right">
  <iframe align="center" id="leftframe" width="100%" height="100%" src="/index.php/Mobile/Goods/goodsList/id/844.html" frameborder="no" border="0" marginwidth="0"
          marginheight="0" scrolling="yes"></iframe>
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
<script>
    $(function () {
        //iframe更换链接
        $(".left a").click(function () {
            var url = $(this).data("url");
            console.log($(this).css)
            $("#leftframe").attr("src", url);
        });
    });
    $(function () {
        //滚动条
        $(".category1,.left").niceScroll({ cursorwidth: 0,cursorborder:0 });
        //点击切换2 3级分类
        var array=new Array();
        $('.category1 li').each(function(){
            array.push($(this).position().top-0);
        });

        $('.category1 li').click(function() {
            var index=$(this).index();
            $('.category1').delay(200).animate({scrollTop:array[index]},300);
            $(this).addClass('cur').siblings().removeClass();
            $('.left ul').eq(index).show().siblings().hide();
            $('.left').scrollTop(0);
        });

    });

</script>
<script src="/Template/mobile/new/Static/js/jquery.nicescroll.min.js"></script>
</body>
</html>