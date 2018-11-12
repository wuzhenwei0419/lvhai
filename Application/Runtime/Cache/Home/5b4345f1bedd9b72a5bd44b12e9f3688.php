<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>登录-<?php echo ($tpshop_config['shop_info_store_title']); ?></title>
<meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
<meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
<link rel="stylesheet" type="text/css" href="/Template/pc/soubao/Static/css/login.css">
<link rel="stylesheet" type="text/css" href="/Template/pc/soubao/Static/css/common.min.css">
<link rel="stylesheet" type="text/css" href="/Template/pc/soubao/Static/css/lvhai.css">
<link rel="shortcut icon"  href="/Template/pc/soubao/Static/images/favicon.ico" />
<script type="text/javascript" src="/Public/js/jquery-1.10.2.min.js"></script>
</head>
<body class="page-login">
<div class="header area">
  <a href="/index.php" class="logo_s" title="首页" style="margin: 10px 0;height: 59px; "><img width="auto" height="auto" style="margin-top: 10px;" src="<?php echo ($tpshop_config['shop_info_store_logo']); ?>"/></a>
  <img src="/Template/pc/soubao/Static/images/title.png" class="login-title">
</div>
<div class="m-login" id="divMLogin">
  <div class="login-wrap clearfix">
    <div class="login-form">
      <div class="title oh">
        <h1 class="fl">欢迎登录</h1>
      </div>
      <div class="u-msg-wrap">
        <div class="msg msg-warn" style="display:none;"> <i></i>
          <span>公共场所不建议自动登录，以防帐号丢失</span>
        </div>
        <div class="msg msg-err" style="display:none;"> <i></i>
          <span class="J-errorMsg"></span>
        </div>
      </div>
      <form id="login-form" method="post">
        <div class="u-input mb20">
          <label class="u-label u-name"></label>
          <input type="text" class="u-txt J-input-txt" value="" placeholder="手机号/邮箱" name="username" id="username" autocomplete="off">
        </div>
        <div class="u-input mb15">
          <label class="u-label u-pwd"></label>
          <input type="password" class="u-txt J-input-txt" placeholder="密码"  name="password" id="password" autocomplete="off">
        </div>
        <div class="u-input mb15">
			<input type="text" placeholder="不区分大小写" name="verify_code" id="verify_code" class="u-txt J-input-txt" style="width:50%; padding:10px;"/>
            <img    onclick="verify(this);" width="140" height="42" src="/index.php/Home/User/verify.html" id="verify_code_img" class="po-ab to0">
            <a><img width="auto" height="auto" onclick="verify(this);" src="/Template/pc/soubao/Static/images/chg_image.png" class="ma-le-142 po-ab to18"></a>
        </div>        
        <div class="u-safe">
          <span class="auto">
          <label>
          	<input type="hidden" name="referurl" id="referurl" value="<?php echo ($referurl); ?>">
            <input type="checkbox" class="u-ckb J-auto-rmb"  name="remember">自动登录</label>
          </span>
          <span class="forget"><a href="<?php echo U('Home/User/forget_pwd');?>">忘记密码？</a></span>
        </div>         
        <div class="u-btn mb20 mt20"> <a href="javascript:void(0);" onClick="checkSubmit();" class="J-login-submit" name="sbtbutton">登&nbsp;&nbsp;&nbsp;&nbsp;录</a> </div>
      </form>
      <dl class="account" style="display: none;">
        <dd><a href="<?php echo U('LoginApi/login',array('oauth'=>'qq'));?>" class="qq" title="QQ">QQ登录</a></dd>
        <dd><a href="<?php echo U('LoginApi/login',array('oauth'=>'weixin'));?>" class="wechat">微信登录</a></dd>
        <dd><a href="<?php echo U('LoginApi/login',array('oauth'=>'alipay'));?>" class="alipay" title="支付宝">支付宝登录</a></dd>
      </dl>
      <div class="regist-link fr">没有账号？<a href="<?php echo U('Home/User/reg');?>">免费注册</a> </div>
    </div>
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
 <script>
	function checkSubmit()
	{
		$('.msg-err').hide();
		$('.J-errorMsg').empty();
		var username = $.trim($('#username').val());
		var password = $.trim($('#password').val());
		var referurl = $('#referurl').val();
		var verify_code = $.trim($('#verify_code').val());
		if(username == ''){
			showErrorMsg('用户名不能为空!');
			return false;
		}
		if(!checkMobile(username) && !checkEmail(username)){
			showErrorMsg('账号格式不匹配!');
			return false;
		}
		if(password == ''){
			showErrorMsg('密码不能为空!');
			return false;
		}
		if(verify_code == ''){
			showErrorMsg('验证码不能为空!');
			return false;
		}
		//$('#login-form').submit();
		$.ajax({
			type : 'post',
			url : '/index.php?m=Home&c=User&a=do_login&t='+Math.random(),
			data : {username:username,password:password,referurl:referurl,verify_code:verify_code},	
			dataType : 'json',
			success : function(res){
				if(res.status == 1){
					window.location.href = res.url;
				}else{
					showErrorMsg(res.msg);
					verify();
				}
			},
			error : function(XMLHttpRequest, textStatus, errorThrown) {
				showErrorMsg('网络失败，请刷新页面后重试');
			}
		})
		
	}
	
    function checkMobile(tel) {
        var reg = /(^1[3|4|5|7|8][0-9]{9}$)/;
        if (reg.test(tel)) {
            return true;
        }else{
            return false;
        };
    }
    
    function checkEmail(str){
        var reg = /^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        if(reg.test(str)){
            return true;
        }else{
            return false;
        }
    }
    
    function showErrorMsg(msg){
    	$('.msg-err').show();
    	$('.J-errorMsg').html(msg);
    }
    
    function verify(){
        $('#verify_code_img').attr('src','/index.php?m=Home&c=User&a=verify&r='+Math.random());
     }
</script>
</body>
</html>