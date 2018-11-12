<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta name="Generator" content="tpshop" />
	<meta charset="utf-8">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="minimal-ui=yes,width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<title>商品列表-<?php echo ($tpshop_config['shop_info_store_title']); ?></title>
	<meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
	<meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
	<link rel="stylesheet" type="text/css" href="/Template/mobile/new/Static/css/public.css"/>
	<link rel="stylesheet" type="text/css" href="/Template/mobile/new/Static/css/category_list.css"/>
	<link rel="stylesheet" href="/Template/mobile/new/Static/css/lvhai.css">
	<script type="text/javascript" src="/Template/mobile/new/Static/js/jquery.js"></script>
	<script type="text/javascript" src="/Template/mobile/new/Static/js/layer.js" ></script>
	<script src="/Public/js/global.js"></script>
	<script src="/Public/js/mobile_common.js"></script>
</head>
<body style="min-width: 0; background: #fff;">
<section class="_pre" >
	<section>
		<div class="touchweb-com_searchListBox openList" id="goods_list">
			<?php if(empty($goods_list)): ?><p class="goods_title">抱歉暂时没有相关结果，换个试试吧</p>
				<?php else: ?>
				<?php if(is_array($goods_list)): foreach($goods_list as $k=>$vo): ?><li>
						<a data-url="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$vo[goods_id]));?>" class="item">
							<div class="pic_box">
								<div class="active_box">
									<span style=" background-position:0px -36px">新品</span>
								</div>
								<img width="auto" height="auto" src="<?php echo (goods_thum_images($vo["goods_id"],400,400)); ?>">
							</div>
							<div class="title_box"><?php echo ($vo["goods_name"]); ?></div>
							<!--<span class="sugar"><?php-->

                 <!--$goodsattr=D()->query("select attr_name ,attr_value from tp_goods_attr as a,tp_goods_attribute as b where a.goods_id=$vo[goods_id] and a.attr_id=b.attr_id and attr_name='含糖量'");-->
                 <!--echo $goodsattr[0]['attr_name'];-->
                 <!--echo "：";-->
                 <!--echo $goodsattr[0]['attr_value'];-->
           <!--?></span>-->
							<div class="price_box islogin">
								<span class="new_price"><i>￥<?php echo ($vo["shop_price"]); ?>元</i></span>
							</div>
							<div class="price_box nologin">
								<span class="new_price"><i>￥<?php echo ($vo["shop_price"]); ?>元</i></span>
							</div>
							<div class="comment_box islogin">已售<?php echo ($vo["sales_sum"]); ?>件</div>
						</a>
						<span class="bug_car" onClick="AjaxAddCart(<?php echo ($vo[goods_id]); ?>,1,0);"><i class="iconlvhai icon icon-cart"></i></span>
					</li><?php endforeach; endif; endif; ?>
		</div>
	</section>
</section>
<script>
    $(function () {
        $(".item").click(function () {
            var url = $(this).data("url");
            window.parent.location.href= url;
        });

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

</script>
</body>
</html>