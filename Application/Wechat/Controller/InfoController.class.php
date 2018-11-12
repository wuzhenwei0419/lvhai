<?php
/**
 * tpshop
 * ============================================================================
 * * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: 当燃   2016-05-10
 */ 
namespace Wechat\Controller;
use Think\Controller\RestController;

Class InfoController extends RestController {
    protected $allowMethod    = array('get','post','put'); // REST允许的请求类型列表
    protected $allowType      = array('html','xml','json'); // REST允许请求的资源类型列表

    public function index(){
    	echo "w";
    	//return json();
    }
    public function test(){
    	$r=M('admin')->where(array('admin_id'=>1))->select();
    	//echo json_encode($r);
    	$data=$r;
        echo json_encode($data);
    	//return json_encode($data);
        //$data=['name'=>'sss'];
        
    }
}
    
  
