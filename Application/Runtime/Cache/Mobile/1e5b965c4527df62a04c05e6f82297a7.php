<?php if (!defined('THINK_PATH')) exit(); if(is_array($favourite_goods)): foreach($favourite_goods as $k=>$v): ?><li>
		<a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id]));?>" title="<?php echo ($v["goods_name"]); ?>">
			<div class="index_pro">
				<div class="products_kuang">
					<img width="auto" height="auto" src="<?php echo (goods_thum_images($v["goods_id"],400,400)); ?>"></div>
				<div class="goods_name"><?php echo ($v["goods_name"]); ?></div>
				<div class="price">
					<a href="javascript:AjaxAddCart(<?php echo ($v[goods_id]); ?>,1,0);" class="btns">+</a>
		</a>
		<span href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id]));?>" class="price_pro price_pro_login">￥<?php echo ($v["shop_price"]); ?></span><a href="/index.php/Mobile/User/index.html" class="nologin">登录查看价格</a>
		</div>
		</div>
		</a>
	</li><?php endforeach; endif; ?>