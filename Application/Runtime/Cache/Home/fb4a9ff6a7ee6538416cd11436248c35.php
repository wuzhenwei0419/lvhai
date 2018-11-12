<?php if (!defined('THINK_PATH')) exit(); if(count($cartList) == 0): ?><div class="empty-c">
      <span class="ma"><i class="c-i oh"></i>购物车中没有商品哟！</span>
    </div>
<?php else: ?>

<div class="mn-c-m oh">
    <!-- 购物车商品列表-->
    <div class="mn-c-box J-sdb-cb js_cart_top">
        <!-- 商家列表-->
        <dl class="c-store mb15">
            <dt class="c-store-tt fixed">
                <a href="#" class="n fl" alt="" title="">自营</a>
            </dt>
            <dd class="c-list">
                <!-- 商品列表-->
                <!-- 商品列表+促销活动-->
                <?php if(is_array($cartList)): foreach($cartList as $k=>$v): ?><div class="c-prod">
                    <div class="c-item fixed  js_cart_pro_list" cart_id="99583">
                        <a class="del js_delete" onclick="header_cart_del(<?php echo ($v["id"]); ?>);" href="javascript:void(0);"></a>
                        <p class="i fl mr5">
                            <a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$v[goods_id]));?>" alt="" title="">
                                <img src="<?php echo (goods_thum_images($v["goods_id"],60,60)); ?>" height="50" width="50" alt="" title="">
                            </a>
                        </p>
                        <p class="n fl">
                            <a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$v[goods_id]));?>" class="" alt="" title="">
                                	<?php echo ($v[goods_name]); ?>
                            </a>
                        </p>
                        <p class="  fl js_mini_num"> * <?php echo ($v[goods_num]); ?> 件 </p>
                        <p class="p fr mt5">
                            <em>￥</em><span class="give"><?php echo ($v[member_goods_price]); ?></span>
                        </p>
                    </div>
                </div><?php endforeach; endif; ?>
            </dd>
        </dl>
        <!-- 商家列表-->
    </div>
    <!-- 购物车结算-->
    <div class="mn-c-total">
        <div class="c-t fixed">
            <p class="t-n fl">
                <span id="total_qty"><?php echo ($cart_total_price[num]); ?></span>件
            </p>
            <p class="t-p fr">
                <em>￥</em>
                <span id="total_pay"><?php echo ($cart_total_price[total_fee]); ?></span>
            </p>
        </div>
        <div class="c-btn">
            <a href="<?php echo U('Home/Cart/cart');?>" alt="" title="" class="go">去购物车结算 &gt;&gt;</a>
        </div>
    </div>
</div><?php endif; ?>
<script>
   $(".cart_quantity").text('<?php echo ($cart_total_price[anum]); ?>'); // 购物车的总数量
    var total=document.querySelector("#total_pay")
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
    var mt5=document.querySelectorAll(".give")
   console.log(mt5)
   var go=document.querySelector(".go")
   console.log(go)
if(name==""){
    total.innerHTML=""
    for ( let i=0;i<mt5.length;i++){
        mt5[i].innerHTML=""
    }
    go .setAttribute("href","<?php echo U('Home/user/login');?>")
}else {
    total.innerHTML="<?php echo ($cart_total_price[total_fee]); ?>"
    for ( let i=0;i<mt5.length;i++){
        mt5.innerHTML="<?php echo ($v[member_goods_price]); ?>"
    }
    go .setAttribute("href","<?php echo U('Home/Cart/cart');?>")
}
</script>