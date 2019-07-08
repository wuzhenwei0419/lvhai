<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: 当燃
 * Date: 2015-09-09
 */
namespace Admin\Controller;
use Admin\Logic\OrderLogic;
use Think\AjaxPage;

class OrderController extends BaseController {
    public  $order_status;
    public  $pay_status;
    public  $shipping_status;
    /*
     * 初始化操作
     */
    public function _initialize() {
        parent::_initialize();
        C('TOKEN_ON',false); // 关闭表单令牌验证
        $this->order_status = C('ORDER_STATUS');
        $this->pay_status = C('PAY_STATUS');
        $this->shipping_status = C('SHIPPING_STATUS');
        // 订单 支付 发货状态
        $this->assign('order_status',$this->order_status);
        $this->assign('pay_status',$this->pay_status);
        $this->assign('shipping_status',$this->shipping_status);
    }

    /*
     *订单首页
     */
    public function index(){
    	$begin = date('Y/m/d',(time()-30*60*60*24));//30天前
    	$end = date('Y/m/d',strtotime('+1 days')); 	
    	$this->assign('timegap',$begin.'-'.$end);
        $this->display();
    }

    /*
     *Ajax首页
     */
    public function ajaxindex(){
        $orderLogic = new OrderLogic();       
        $timegap = I('timegap');
        if($timegap){
        	$gap = explode('-', $timegap);
        	$begin = strtotime($gap[0]);
        	$end = strtotime($gap[1]);
        }
        if (I('collect') == 1){
            //如果操作时间为0点到4点时 显示前一天的订单
//            if (time() < strtotime(date('Y-m-d').' 04:00:00') ){
//                $begin = strtotime("-1 day", date('Y-m-d'));
//                $end = strtotime("-1 day",date('Y-m-d').' 23:59:59');
//            }else{
//                $begin = strtotime(date('Y-m-d'));
//                $end = strtotime(date('Y-m-d').' 23:59:59');
//            }

            //后台选定日期进行查看该天的用户订单
            $order_time = I('order_time');
            if ($order_time){
                $begin = strtotime($order_time);
                $end = strtotime($order_time.' 23:59:59');
            }else{
                $begin = strtotime(date('Y-m-d'));
                $end = strtotime(date('Y-m-d').' 23:59:59');
            }
        }
        // 搜索条件
        $condition = array();
        I('consignee') ? $condition['consignee'] = trim(I('consignee')) : false;
        if($begin && $end){
        	$condition['add_time'] = array('between',"$begin,$end");
        }
        I('order_sn') ? $condition['order_sn'] = trim(I('order_sn')) : false;
        I('order_status') != '' ? $condition['order_status'] = I('order_status') : false;
        I('pay_status') != '' ? $condition['pay_status'] = I('pay_status') : false;
        I('pay_code') != '' ? $condition['pay_code'] = I('pay_code') : false;
        I('shipping_status') != '' ? $condition['shipping_status'] = I('shipping_status') : false;
        I('user_id') ? $condition['user_id'] = trim(I('user_id')) : false;
        I('address_id') ? $condition['address_id'] = trim(I('address_id')) : false;

        $sort_order = I('order_by','DESC').' '.I('sort');
        $order_triage=I('order_triage');
        $count = M('order')->where($condition)->count();
        $Page  = new AjaxPage($count,20);
        //  搜索条件下 分页赋值
        foreach($condition as $key=>$val) {
            $Page->parameter[$key]   =  urlencode($val);
        }
        $show = $Page->show();
        //获取订单列表
        $orderList = $orderLogic->getOrderList($condition,$sort_order,$Page->firstRow,$Page->listRows,$order_triage);
        $this->assign('orderList',$orderList);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }


    public function userindex(){
        $begin = date('Y/m/d',(time()));
        $end = date('Y/m/d',strtotime('+1 days'));
        $this->assign('timegap',$begin.'-'.$end);
        $this->display();
    }


    public function ajaxuserindex(){
        $orderLogic = new OrderLogic();       
        $timegap = I('timegap');
        // if($timegap){
        //     $gap = explode('-', $timegap);
        //     $begin = strtotime($gap[0]);
        //     $end = strtotime($gap[1]);
        // }
        // 搜索条件
        $condition = array();
        I('consignee') ? $condition['consignee'] = trim(I('consignee')) : false;
        // if($begin && $end){
        //     $condition['add_time'] = array('between',"$begin,$end");
        // }
        //如果操作时间为0点到4点时 显示前一天的订单
//        if (time() < strtotime(date('Y-m-d').' 04:00:00') ){
//            $begin = strtotime("-1 day", date('Y-m-d'));
//            $end = strtotime("-1 day",date('Y-m-d').' 23:59:59');
//        }else{
//            $begin = strtotime(date('Y-m-d'));
//            $end = strtotime(date('Y-m-d').' 23:59:59');
//        }


        //后台选定日期进行查看该天的用户订单
        $order_time = I('order_time');
        if ($order_time){
            $begin = strtotime($order_time);
            $end = strtotime($order_time.' 23:59:59');
        }else{
            $begin = strtotime(date('Y-m-d'));
            $end = strtotime(date('Y-m-d').' 23:59:59');
            $order_time = date('Y-m-d');
        }

        $condition['add_time'] = array('between',"$begin,$end");
        I('order_sn') ? $condition['order_sn'] = trim(I('order_sn')) : false;
        I('order_status') != '' ? $condition['order_status'] = I('order_status') : false;
        I('pay_status') != '' ? $condition['pay_status'] = I('pay_status') : false;
        I('pay_code') != '' ? $condition['pay_code'] = I('pay_code') : false;
        I('shipping_status') != '' ? $condition['shipping_status'] = I('shipping_status') : false;
        I('user_id') ? $condition['user_id'] = trim(I('user_id')) : false;
        // $condition['admin_id'] = $_SESSION['admin_id'];
        //var_dump(print_r($condition['admin_id']));
        $sort_order = I('order_by','DESC').' '.I('sort');
        $count = M('order')->where($condition)->group("user_id")->count();
        $Page  = new AjaxPage($count,1000);
        //  搜索条件下 分页赋值
        foreach($condition as $key=>$val) {
            $Page->parameter[$key]   =  urlencode($val);
        }
        $show = $Page->show();
        //获取订单列表
        // $orderList = $orderLogic->getOrderList($condition,$sort_order,$Page->firstRow,$Page->listRows);

        $orderList = M('order')->field('mobile,order_id,order_sn,user_id,order_status,shipping_status,pay_status,consignee,sum(total_amount) as total_amount,
            sum(goods_price) as goods_price, sum(order_amount) as order_amount, add_time, address_id')->where($condition)->group("user_id, address_id")->order('add_time DESC')->select();

        //统计已审核及未审核的订单数
        $orderAudit = array();
        foreach($orderList as $key=>$val){
            // 未审核的订单数
            $condition = array();
            $condition['user_id'] = $val['user_id'];
            $condition['order_status'] = 0;
//            if (empty($val['address_id'])) continue;
            $condition['address_id'] = $val['address_id'];

//            $begin = strtotime(date('Y-m-d'));
//            $end = strtotime(date('Y-m-d').' 23:59:59');
            $condition['add_time'] = array('between',"$begin,$end");
            $waitAuditCount = M('order')->where($condition)->count();

            $orderAudit[$val['address_id']]['waitAuditCount'] = $waitAuditCount;


            //已审核的订单数
            $condition['user_id'] = $val['user_id'];
            $condition['order_status'] = 1;
            $condition['address_id'] = $val['address_id'];
            $auditedCount = M('order')->where($condition)->count();

            $orderAudit[$val['address_id']]['auditedCount'] = $auditedCount;

            //校验是否已经合并了总订单
            $trueDay = date('Y-m-d', $begin); //实际操作日期
            $where = "where user_id = ". $val['user_id'] ." and address_id =" . $val['address_id']."  and FROM_UNIXTIME(add_time, '%Y-%m-%d') = '".$trueDay."' limit 1";
            $sql = "select * from __PREFIX__total_order $where";
            $totalOrderInfo = D()->query($sql);
            if ($totalOrderInfo) {
                $orderAudit[$val['address_id']]['mergeStatus'] = '已合并';
            } else{
                $orderAudit[$val['address_id']]['mergeStatus'] = '未合并';
            }

        }
        $this->assign('orderAudit',$orderAudit);        
        $this->assign('orderList',$orderList);
        $this->assign('timegap',$timegap);
        $this->assign('order_time',$order_time);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();

    }

    //TODO 合并生成总订单
    public function mergeOrder(){
        $user_id = I('user_id');
        $address_id = I('address_id');
        if(!$user_id || !$address_id){
            $this->error('用户id参数缺失~');
            exit;
        }
//        if (time() < strtotime(date('Y-m-d').' 04:00:00') ){
//            $begin = strtotime("-1 day");
//        }else{
//            $begin = time();
//        }
        //后台选定日期进行查看该天的用户订单
        $order_time = I('order_time');
        if ($order_time){
            $trueDay = $order_time; //实际操作日期
        }else{
            $trueDay = date('Y-m-d'); //实际操作日期
        }


        //校验是否已经合并了总订单

        $where = "where user_id = ". $user_id ." and address_id =" . $address_id." and FROM_UNIXTIME(add_time, '%Y-%m-%d') = '".$trueDay."' limit 1";
        $sql = "select * from __PREFIX__total_order $where";
        $totalOrderInfo = D()->query($sql);
        if ($totalOrderInfo) {
           $this->error('用户今日的订单已经合并~');
            exit;
        }    


        $where = "where user_id = ". $user_id ." and address_id =" . $address_id." and FROM_UNIXTIME(add_time, '%Y-%m-%d') = '".$trueDay."' and order_status = 1 limit 1";
        $sql = "select * from __PREFIX__order $where";
        $orderInfo = D()->query($sql); 

        if ($orderInfo) {
            //对订单的金额进行求和
            $where = "where user_id = ". $user_id ." and address_id =" . $address_id." and FROM_UNIXTIME(add_time, '%Y-%m-%d') = '".$trueDay."' and order_status = 1";
            $sql = "select sum(goods_price) as goods_price, sum(shipping_price) as shipping_price, sum(user_money) as user_money, 
            sum(coupon_price) as coupon_price, sum(integral) as integral
            , sum(integral_money) as integral_money, sum(order_amount) as order_amount, sum(total_amount) as total_amount
            , sum(order_prom_amount) as order_prom_amount, sum(discount) as discount from __PREFIX__order $where";
            $sumOrderInfo = D()->query($sql);



            $orderInfo[0]['goods_price'] = $sumOrderInfo[0]['goods_price']; 
            $orderInfo[0]['shipping_price'] = $sumOrderInfo[0]['shipping_price']; 
            $orderInfo[0]['user_money'] = $sumOrderInfo[0]['user_money']; 
            $orderInfo[0]['coupon_price'] = $sumOrderInfo[0]['coupon_price']; 
            $orderInfo[0]['integral'] = $sumOrderInfo[0]['integral']; 
            $orderInfo[0]['integral_money'] = $sumOrderInfo[0]['integral_money']; 
            $orderInfo[0]['order_amount'] = $sumOrderInfo[0]['order_amount']; 
            $orderInfo[0]['total_amount'] = $sumOrderInfo[0]['total_amount']; 
            $orderInfo[0]['order_prom_amount'] = $sumOrderInfo[0]['order_prom_amount']; 
            $orderInfo[0]['discount'] = $sumOrderInfo[0]['discount'];
            $orderInfo[0]['order_id'] = "";
            $orderInfo[0]['address_id'] = $address_id;
            $orderInfo[0]['order_sn'] = date('YmdHis').mt_rand(1000,9999);


            $total_order_id = M('total_order')->add($orderInfo[0]);//插入订单总表

            //更新子订单相关信息
            $sql = "update __PREFIX__order set total_order_id = ".$total_order_id." where user_id = ".$user_id." and address_id = ".$address_id." and order_status = 1
            and FROM_UNIXTIME(add_time, '%Y-%m-%d') = ".$trueDay;
            $row = D()->query($sql);

            $sql = "update __PREFIX__order_goods set total_order_id = ".$total_order_id." where order_id in (select order_id from __PREFIX__order where user_id = ".$user_id." and address_id = ".$address_id." and order_status = 1 and FROM_UNIXTIME(add_time, '%Y-%m-%d') = '".$trueDay."' ) ";
            $row = D()->query($sql);


        }else{
            $this->error('该用户下没有需要合并的订单~');
            exit;
        }


      $this->display("delivery_list");  
    }

    
    /*
     * ajax 发货订单列表
    */
    public function ajaxdelivery(){
        $orderLogic = new OrderLogic();
        $condition = array();
        I('consignee') ? $condition['consignee'] = trim(I('consignee')) : false;
        I('order_sn') != '' ? $condition['order_sn'] = trim(I('order_sn')) : false;
        $shipping_status = I('shipping_status');
        $condition['shipping_status'] = empty($shipping_status) ? array('neq',1) : $shipping_status;
        $condition['order_status'] = array('in','1,2,4');
        $count = M('total_order')->where($condition)->count();
        $Page  = new AjaxPage($count,10);
        //搜索条件下 分页赋值
        foreach($condition as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show = $Page->show();
        $orderList = M('total_order')->where($condition)->limit($Page->firstRow.','.$Page->listRows)->order('add_time DESC')->select();
        $this->assign('orderList',$orderList);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    
    /**
     * 订单详情
     * @param int $id 订单id
     */
    public function detail($order_id){
        $orderLogic = new OrderLogic();
        $order = $orderLogic->getOrderInfo($order_id);
        $orderGoods = $orderLogic->getOrderGoods($order_id);
        $button = $orderLogic->getOrderButton($order);
        // 获取操作记录
        $action_log = M('order_action')->where(array('order_id'=>$order_id))->order('log_time desc')->select();
        $this->assign('order',$order);
        $this->assign('action_log',$action_log);
        $this->assign('orderGoods',$orderGoods);
        $split = count($orderGoods) >1 ? 1 : 0;
        foreach ($orderGoods as $val){
        	if($val['goods_num']>1){
        		$split = 1;
        	}
        }
        $this->assign('split',$split);
        $this->assign('button',$button);
        $this->display();
    }

    /**
     * 订单详情
     * @param int $id 订单id
     */
    public function total_order_detail($order_id){
        $orderLogic = new OrderLogic();
        $order = $orderLogic->getTotalOrderInfo($order_id);
        $orderGoods = $orderLogic->getTotalOrderGoods($order_id);
        $button = $orderLogic->getOrderButton($order);
        // 获取操作记录
        $action_log = M('total_order_action')->where(array('order_id'=>$order_id))->order('log_time desc')->select();
        $this->assign('order',$order);
        $this->assign('action_log',$action_log);
        $this->assign('orderGoods',$orderGoods);
        $split = count($orderGoods) >1 ? 1 : 0;
        foreach ($orderGoods as $val){
            if($val['goods_num']>1){
                $split = 1;
            }
        }
        $this->assign('split',$split);
        $this->assign('button',$button);
        $this->display("detail");
    }

    //TODO
    /**
     * 总订单编辑
     * @param int $id 订单id
     */
    public function edit_total_order(){
        $order_id = I('order_id');
        $orderLogic = new OrderLogic();
        $order = $orderLogic->getTotalOrderInfo($order_id);
        if($order['shipping_status'] != 0){
            $this->error('已发货订单不允许编辑');
            exit;
        } 
    
        $orderGoods = $orderLogic->getTotalOrderGoods($order_id);
                
        if(IS_POST)
        {
            $order['consignee'] = I('consignee');// 收货人
            $order['province'] = I('province'); // 省份
            $order['city'] = I('city'); // 城市
            $order['district'] = I('district'); // 县
            $order['address'] = I('address'); // 收货地址
            $order['mobile'] = I('mobile'); // 手机           
            $order['invoice_title'] = I('invoice_title');// 发票
            $order['admin_note'] = I('admin_note'); // 管理员备注
            $order['admin_note'] = I('admin_note'); //                  
            $order['shipping_code'] = I('shipping');// 物流方式
            $order['shipping_name'] = M('plugin')->where(array('status'=>1,'type'=>'shipping','code'=>I('shipping')))->getField('name');            
            $order['pay_code'] = I('payment');// 支付方式            
            $order['pay_name'] = M('plugin')->where(array('status'=>1,'type'=>'payment','code'=>I('payment')))->getField('name');                            
            $goods_id_arr = I("goods_id");
            $new_goods = $old_goods_arr = array();
            //################################订单添加商品
            if($goods_id_arr){
                $new_goods = $orderLogic->get_spec_goods($goods_id_arr);
                foreach($new_goods as $key => $val)
                {
                    $val['order_id'] = $order_id;
                    $rec_id = M('order_goods')->add($val);//订单添加商品
                    if(!$rec_id)
                        $this->error('添加失败');
                }
            }
            
            //################################订单修改删除商品
            //TODO 因修改商品数量而影响的子订单
            $subOrderIds = array();

            $old_goods = I('old_goods');

            $old_goods_weight = I('old_goods_weight');
            // echo "<pre>";
            // print_r($orderGoods);
            // die();
            foreach ($orderGoods as $val){
                if(empty($old_goods[$val['rec_id']])){
                    M('order_goods')->where("rec_id=".$val['rec_id'])->delete();//删除商品
                }else{
                    //修改商品数量
                    if($old_goods[$val['rec_id']] != $val['goods_num']){
                        $val['goods_num'] = $old_goods[$val['rec_id']];
                        M('order_goods')->where("rec_id=".$val['rec_id'])->save(array('goods_num'=>$val['goods_num']));

                        //TODO 收集因修改商品数量而影响的子订单
                        if (!$subOrderIds[$val['order_id']]) $subOrderIds[$val['order_id']] = $val['order_id'];
                    }
                    //修改商品重量
                    if($old_goods_weight[$val['rec_id']] != $val['goods_weight']){
                        $val['goods_weight'] = $old_goods_weight[$val['rec_id']];
                        M('order_goods')->where("rec_id=".$val['rec_id'])->save(array('goods_weight'=>$val['goods_weight']));

                        //TODO 收集因修改商品数量而影响的子订单
                        if (!$subOrderIds[$val['order_id']]) $subOrderIds[$val['order_id']] = $val['order_id'];
                    }

                    $old_goods_arr[] = $val;
                }
            }
            
            $goodsArr = array_merge($old_goods_arr,$new_goods);
            // echo "<pre>";
            // print_r($orderGoods);
            // echo "new_goods";
            // print_r($new_goods);

            // echo "goodsArr";
            // print_r($goodsArr);
            // die();

            $result = calculate_price($order['user_id'],$goodsArr,$order['shipping_code'],0,$order['province'],$order['city'],$order['district'],0,0,0,0);
            if($result['status'] < 0)
            {
                $this->error($result['msg']);
            }
       
            //################################修改订单费用
            $order['goods_price']    = $result['result']['goods_price']; // 商品总价
            $order['shipping_price'] = $result['result']['shipping_price'];//物流费
            $order['order_amount']   = $result['result']['order_amount']; // 应付金额
            $order['total_amount']   = $result['result']['total_amount']; // 订单总价           
            $o = M('total_order')->where('order_id='.$order_id)->save($order);


            //TODO 更新因修改商品数量而影响的子订单
            foreach($subOrderIds as $val){
                $infect_goods_id = array();
                $infectOrderGoods = $orderLogic->getOrderGoods($val);
                foreach($infectOrderGoods as $key => $valGoods)
                {
                    $infect_goods_id[] = $valGoods['id'];
                }

                if ($infect_goods_id){
                    $infectOrder = $orderLogic->getOrderInfo($val);
                    $result = calculate_price($infectOrder['user_id'],$infect_goods_id,$infectOrder['shipping_code'],0,$infectOrder['province'],$infectOrder['city'],$infectOrder['district'],0,0,0,0);
                    if($result['status'] >= 0)
                    {
                        //################################修改订单费用
                        $infectOrder['goods_price']    = $result['result']['goods_price']; // 商品总价
                        $infectOrder['shipping_price'] = $result['result']['shipping_price'];//物流费
                        $infectOrder['order_amount']   = $result['result']['order_amount']; // 应付金额
                        $infectOrder['total_amount']   = $result['result']['total_amount']; // 订单总价
                        M('order')->where('order_id='.$order_id)->save($infectOrder);

                        $orderLogic->OrderActionLog($val,'edit','修改订单');//操作日志
                    }

                }


//                $where = "where order_id = ". $val;
//                $sql = "update __PREFIX__order set goods_price = (select sum(if(goods_weight,goods_weight,goods_num) * goods_price) from __PREFIX__order_goods where order_id = ".$val."
//                    ),order_amount = (select sum(if(goods_weight,goods_weight,goods_num) * goods_price) from __PREFIX__order_goods where order_id = ".$val."
//                    ),total_amount = (select sum(if(goods_weight,goods_weight,goods_num) * goods_price) from __PREFIX__order_goods where order_id = ".$val.") $where";
// print_r($sql); die();
//                D()->query($sql);
//                $orderLogic->OrderActionLog($val,'edit','修改订单');//操作日志
            }

            
            $l = $orderLogic->totalOrderActionLog($order_id,'edit','修改订单');//操作日志
            if($o && $l){
                $this->success('修改成功',U('Admin/Order/editprice',array('order_id'=>$order_id)));
            }else{
                $this->success('修改失败',U('Admin/Order/detail',array('order_id'=>$order_id)));
            }
            exit;
        }
        // 获取省份
        $province = M('region')->where(array('parent_id'=>0,'level'=>1))->select();
        //获取订单城市
        $city =  M('region')->where(array('parent_id'=>$order['province'],'level'=>2))->select();
        //获取订单地区
        $area =  M('region')->where(array('parent_id'=>$order['city'],'level'=>3))->select();
        //获取支付方式
        $payment_list = M('plugin')->where(array('status'=>1,'type'=>'payment'))->select();
        //获取配送方式
        $shipping_list = M('plugin')->where(array('status'=>1,'type'=>'shipping'))->select();
        
        $this->assign('order',$order);
        $this->assign('province',$province);
        $this->assign('city',$city);
        $this->assign('area',$area);
        $this->assign('orderGoods',$orderGoods);
        $this->assign('shipping_list',$shipping_list);
        $this->assign('payment_list',$payment_list);
        $this->display("edit_order");
    }

    /**
     * 订单编辑
     * @param int $id 订单id
     */
    public function edit_order(){
    	$order_id = I('order_id');
        $orderLogic = new OrderLogic();
        $order = $orderLogic->getOrderInfo($order_id);
        if($order['shipping_status'] != 0){
            $this->error('已发货订单不允许编辑');
            exit;
        } 
    
        $orderGoods = $orderLogic->getOrderGoods($order_id);
                
       	if(IS_POST)
        {
            $order['consignee'] = I('consignee');// 收货人
            $order['province'] = I('province'); // 省份
            $order['city'] = I('city'); // 城市
            $order['district'] = I('district'); // 县
            $order['address'] = I('address'); // 收货地址
            $order['mobile'] = I('mobile'); // 手机           
            $order['invoice_title'] = I('invoice_title');// 发票
            $order['admin_note'] = I('admin_note'); // 管理员备注
            $order['admin_note'] = I('admin_note'); //                  
            $order['shipping_code'] = I('shipping');// 物流方式
            $order['shipping_name'] = M('plugin')->where(array('status'=>1,'type'=>'shipping','code'=>I('shipping')))->getField('name');            
            $order['pay_code'] = I('payment');// 支付方式            
            $order['pay_name'] = M('plugin')->where(array('status'=>1,'type'=>'payment','code'=>I('payment')))->getField('name');                            
            $goods_id_arr = I("goods_id");
            $new_goods = $old_goods_arr = array();
            //################################订单添加商品
            if($goods_id_arr){
            	$new_goods = $orderLogic->get_spec_goods($goods_id_arr);
            	foreach($new_goods as $key => $val)
            	{
            		$val['order_id'] = $order_id;
            		$rec_id = M('order_goods')->add($val);//订单添加商品
            		if(!$rec_id)
            			$this->error('添加失败');
            	}
            }
            
            //################################订单修改删除商品
            $old_goods = I('old_goods');
            foreach ($orderGoods as $val){
            	if(empty($old_goods[$val['rec_id']])){
            		M('order_goods')->where("rec_id=".$val['rec_id'])->delete();//删除商品
            	}else{
            		//修改商品数量
            		if($old_goods[$val['rec_id']] != $val['goods_num']){
            			$val['goods_num'] = $old_goods[$val['rec_id']];
            			M('order_goods')->where("rec_id=".$val['rec_id'])->save(array('goods_num'=>$val['goods_num']));
            		}
            		$old_goods_arr[] = $val;
            	}
            }
            
            $goodsArr = array_merge($old_goods_arr,$new_goods);
            $result = calculate_price($order['user_id'],$goodsArr,$order['shipping_code'],0,$order['province'],$order['city'],$order['district'],0,0,0,0);
            if($result['status'] < 0)
            {
            	$this->error($result['msg']);
            }
       
            //################################修改订单费用
            $order['goods_price']    = $result['result']['goods_price']; // 商品总价
            $order['shipping_price'] = $result['result']['shipping_price'];//物流费
            $order['order_amount']   = $result['result']['order_amount']; // 应付金额
            $order['total_amount']   = $result['result']['total_amount']; // 订单总价           
            $o = M('order')->where('order_id='.$order_id)->save($order);
            
            $l = $orderLogic->orderActionLog($order_id,'edit','修改订单');//操作日志
            if($o && $l){
            	$this->success('修改成功',U('Admin/Order/editprice',array('order_id'=>$order_id)));
            }else{
            	$this->success('修改失败',U('Admin/Order/detail',array('order_id'=>$order_id)));
            }
            exit;
        }
        // 获取省份
        $province = M('region')->where(array('parent_id'=>0,'level'=>1))->select();
        //获取订单城市
        $city =  M('region')->where(array('parent_id'=>$order['province'],'level'=>2))->select();
        //获取订单地区
        $area =  M('region')->where(array('parent_id'=>$order['city'],'level'=>3))->select();
        //获取支付方式
        $payment_list = M('plugin')->where(array('status'=>1,'type'=>'payment'))->select();
        //获取配送方式
        $shipping_list = M('plugin')->where(array('status'=>1,'type'=>'shipping'))->select();
        
        $this->assign('order',$order);
        $this->assign('province',$province);
        $this->assign('city',$city);
        $this->assign('area',$area);
        $this->assign('orderGoods',$orderGoods);
        $this->assign('shipping_list',$shipping_list);
        $this->assign('payment_list',$payment_list);
        $this->display();
    }
    
    /*
     * 拆分订单
     */
    public function split_order(){
    	$order_id = I('order_id');
    	$orderLogic = new OrderLogic();
    	$order = $orderLogic->getOrderInfo($order_id);
    	if($order['shipping_status'] != 0){
    		$this->error('已发货订单不允许编辑');
    		exit;
    	}
    	$orderGoods = $orderLogic->getOrderGoods($order_id);
    	if(IS_POST){
    		$data = I('post.');
    		//################################先处理原单剩余商品和原订单信息
    		$old_goods = I('old_goods');
    		foreach ($orderGoods as $val){
    			if(empty($old_goods[$val['rec_id']])){
    				M('order_goods')->where("rec_id=".$val['rec_id'])->delete();//删除商品
    			}else{
    				//修改商品数量
    				if($old_goods[$val['rec_id']] != $val['goods_num']){
    					$val['goods_num'] = $old_goods[$val['rec_id']];
    					M('order_goods')->where("rec_id=".$val['rec_id'])->save(array('goods_num'=>$val['goods_num']));
    				}
    				$oldArr[] = $val;//剩余商品
    			}
    			$all_goods[$val['rec_id']] = $val;//所有商品信息
    		}
    		$result = calculate_price($order['user_id'],$oldArr,$order['shipping_code'],0,$order['province'],$order['city'],$order['district'],0,0,0,0);
    		if($result['status'] < 0)
    		{
    			$this->error($result['msg']);
    		}
    		//修改订单费用
    		$res['goods_price']    = $result['result']['goods_price']; // 商品总价
    		$res['order_amount']   = $result['result']['order_amount']; // 应付金额
    		$res['total_amount']   = $result['result']['total_amount']; // 订单总价
    		M('order')->where("order_id=".$order_id)->save($res);
			//################################原单处理结束
			
    		//################################新单处理
    		for($i=1;$i<20;$i++){
    			if(!empty($_POST[$i.'_old_goods'])){
    				$split_goods[] = $_POST[$i.'_old_goods'];
    			}
    		}

    		foreach ($split_goods as $key=>$vrr){
    			foreach ($vrr as $k=>$v){
    				$all_goods[$k]['goods_num'] = $v;
    				$brr[$key][] = $all_goods[$k];
    			}
    		}

    		foreach($brr as $goods){
    			$result = calculate_price($order['user_id'],$goods,$order['shipping_code'],0,$order['province'],$order['city'],$order['district'],0,0,0,0);
    			if($result['status'] < 0)
    			{
    				$this->error($result['msg']);
    			}
    			$new_order = $order;
    			$new_order['order_sn'] = date('YmdHis').mt_rand(1000,9999);
    			$new_order['parent_sn'] = $order['order_sn'];
    			//修改订单费用
    			$new_order['goods_price']    = $result['result']['goods_price']; // 商品总价
    			$new_order['order_amount']   = $result['result']['order_amount']; // 应付金额
    			$new_order['total_amount']   = $result['result']['total_amount']; // 订单总价
    			$new_order['add_time'] = time();
    			unset($new_order['order_id']);
    			$new_order_id = M('order')->add($new_order);//插入订单表
    			foreach ($goods as $vv){
    				$vv['order_id'] = $new_order_id;
    				unset($vv['rec_id']);
    				$nid = M('order_goods')->add($vv);//插入订单商品表
    			}
    		}
    		//################################新单处理结束
    		$this->success('操作成功',U('Admin/Order/detail',array('order_id'=>$order_id)));
            exit;
    	}
    	
    	foreach ($orderGoods as $val){
    		$brr[$val['rec_id']] = array('goods_num'=>$val['goods_num'],'goods_name'=>getSubstr($val['goods_name'], 0, 35).$val['spec_key_name']);
    	}
    	$this->assign('order',$order);
    	$this->assign('goods_num_arr',json_encode($brr));
    	$this->assign('orderGoods',$orderGoods);
    	$this->display();
    }
    
    /*
     * 价钱修改
     */
    public function editprice($order_id){
        $orderLogic = new OrderLogic();
        $order = $orderLogic->getTotalOrderInfo($order_id);
        $this->editable($order);
        if(IS_POST){
            $admin_id = session('admin_id');
            if(empty($admin_id)){
                $this->error('非法操作');
                exit;
            }
            $update['discount'] = I('post.discount');
            $update['shipping_price'] = I('post.shipping_price');
            $update['order_amount'] = $order['goods_price'] + $update['shipping_price'] - $update['discount'] - $order['user_money'] - $order['integral_money'] - $order['coupon_price'];
            $row = M('total_order')->where(array('order_id'=>$order_id))->save($update);
            if(!$row){
                $this->success('没有更新数据',U('Admin/Order/editprice',array('order_id'=>$order_id)));
            }else{
                $this->success('操作成功',U('Admin/Order/total_order_detail',array('order_id'=>$order_id)));
            }
            exit;
        }
        $this->assign('order',$order);
        $this->display();
    }

    /**
     * 订单删除
     * @param int $id 订单id
     */
    public function delete_order($order_id){
    	$orderLogic = new OrderLogic();
    	$del = $orderLogic->delOrder($order_id);
        if($del){
            $this->success('删除订单成功');
        }else{
        	$this->error('订单删除失败');
        }
    }
    
    /**
     * 订单取消付款
     */
    public function pay_cancel($order_id){
    	if(I('remark')){
    		$data = I('post.');
    		$note = array('退款到用户余额','已通过其他方式退款','不处理，误操作项');
    		if($data['refundType'] == 0 && $data['amount']>0){
    			accountLog($data['user_id'], $data['amount'], 0,  '退款到用户余额');
    		}
    		$orderLogic = new OrderLogic();
                $orderLogic->orderProcessHandle($data['order_id'],'pay_cancel');
    		$d = $orderLogic->orderActionLog($data['order_id'],'pay_cancel',$data['remark'].':'.$note[$data['refundType']]);
    		if($d){
    			exit("<script>window.parent.pay_callback(1);</script>");
    		}else{
    			exit("<script>window.parent.pay_callback(0);</script>");
    		}
    	}else{
    		$order = M('order')->where("order_id=$order_id")->find();
    		$this->assign('order',$order);
    		$this->display();
    	}
    }

    /**
     * 订单打印
     * @param int $id 订单id
     */
    public function order_print(){
        $order_id = I('order_id');
        $orderLogic = new OrderLogic();
        $order = $orderLogic->getTotalOrderInfo($order_id);
        $order['province'] = getRegionName($order['province']);
        $order['city'] = getRegionName($order['city']);
        $order['district'] = getRegionName($order['district']);
        $order['full_address'] = $order['province'].' '.$order['city'].' '.$order['district'].' '. $order['address'];
        $orderGoods = $orderLogic->getTotalOrderGoods($order_id);
        $shop = tpCache('shop_info');
        $this->assign('order',$order);
        $this->assign('shop',$shop);
        $this->assign('orderGoods',$orderGoods);
        $template = I('template','print');
        $this->display($template);
    }

    /**
     * 快递单打印
     */
    public function shipping_print(){
        $order_id = I('get.order_id');
        $orderLogic = new OrderLogic();
        $order = $orderLogic->getOrderInfo($order_id);
        //查询是否存在订单及物流
        $shipping = M('plugin')->where(array('code'=>$order['shipping_code'],'type'=>'shipping'))->find();        
        if(!$shipping){
        	$this->error('物流插件不存在');
        }
		if(empty($shipping['config_value'])){
			$this->error('请设置'.$shipping['name'].'打印模板');
		}
        $shop = tpCache('shop_info');//获取网站信息
        $shop['province'] = empty($shop['province']) ? '' : getRegionName($shop['province']);
        $shop['city'] = empty($shop['city']) ? '' : getRegionName($shop['city']);
        $shop['district'] = empty($shop['district']) ? '' : getRegionName($shop['district']);

        $order['province'] = getRegionName($order['province']);
        $order['city'] = getRegionName($order['city']);
        $order['district'] = getRegionName($order['district']);
        if(empty($shipping['config'])){
        	$config = array('width'=>840,'height'=>480,'offset_x'=>0,'offset_y'=>0);
        	$this->assign('config',$config);
        }else{
        	$this->assign('config',unserialize($shipping['config']));
        }
        $template_var = array("发货点-名称", "发货点-联系人", "发货点-电话", "发货点-省份", "发货点-城市",
        		 "发货点-区县", "发货点-手机", "发货点-详细地址", "收件人-姓名", "收件人-手机", "收件人-电话", 
        		"收件人-省份", "收件人-城市", "收件人-区县", "收件人-邮编", "收件人-详细地址", "时间-年", "时间-月", 
        		"时间-日","时间-当前日期","订单-订单号", "订单-备注","订单-配送费用");
        $content_var = array($shop['store_name'],$shop['contact'],$shop['phone'],$shop['province'],$shop['city'],
        	$shop['district'],$shop['phone'],$shop['address'],$order['consignee'],$order['mobile'],$order['phone'],
        	$order['province'],$order['city'],$order['district'],$order['zipcode'],$order['address'],date('Y'),date('M'),
        	date('d'),date('Y-m-d'),$order['order_sn'],$order['admin_note'],$order['shipping_price'],
        );
        $shipping['config_value'] = str_replace($template_var,$content_var, $shipping['config_value']);
        $this->assign('shipping',$shipping);
        $this->display("Plugin/print_express");
    }

    /**
     * 生成发货单
     */
    public function deliveryHandle(){
        $orderLogic = new OrderLogic();
		$data = I('post.');
		$res = $orderLogic->deliveryHandle($data);
		if($res){
			$this->success('操作成功',U('Admin/Order/delivery_info',array('order_id'=>$data['order_id'])));
		}else{
			$this->success('操作失败',U('Admin/Order/delivery_info',array('order_id'=>$data['order_id'])));
		}
    }

    
    public function delivery_info(){
        $order_id = I('order_id');
        $orderLogic = new OrderLogic();
        $order = $orderLogic->getTotalOrderInfo($order_id);
        $orderGoods = $orderLogic->getTotalOrderGoods($order_id);
        $delivery_record = M('delivery_doc')->join('LEFT JOIN __ADMIN__ ON __ADMIN__.admin_id = __DELIVERY_DOC__.admin_id')->where('order_id='.$order_id)->select();
        if($delivery_record){
            $order['invoice_no'] = $delivery_record[count($delivery_record)-1]['invoice_no'];
        }
        $this->assign('order',$order);
        $this->assign('orderGoods',$orderGoods);
        $this->assign('delivery_record',$delivery_record);//发货记录
        $this->display();
    }
    
    /**
     * 发货单列表
     */
    public function delivery_list(){
        $this->display();
    }
	
    /*
     * ajax 退货订单列表
     */
    public function ajax_return_list(){
        // 搜索条件        
        $order_sn =  trim(I('order_sn'));
        $order_by = I('order_by') ? I('order_by') : 'id';
        $sort_order = I('sort_order') ? I('sort_order') : 'desc';
        $status =  I('status');
        
        $where = " 1 = 1 ";
        $order_sn && $where.= " and order_sn like '%$order_sn%' ";
        empty($order_sn) && $where.= " and status = '$status' ";
        $count = M('return_goods')->where($where)->count();
        $Page  = new AjaxPage($count,13);
        $show = $Page->show();
        $list = M('return_goods')->where($where)->order("$order_by $sort_order")->limit("{$Page->firstRow},{$Page->listRows}")->select();        
        $goods_id_arr = get_arr_column($list, 'goods_id');
        if(!empty($goods_id_arr))
            $goods_list = M('goods')->where("goods_id in (".implode(',', $goods_id_arr).")")->getField('goods_id,goods_name');
        $this->assign('goods_list',$goods_list);
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    
    /**
     * 删除某个退换货申请
     */
    public function return_del(){
        $id = I('get.id');
        M('return_goods')->where("id = $id")->delete(); 
        $this->success('成功删除!');
    }
    /**
     * 退换货操作
     */
    public function return_info()
    {
        $id = I('id');
        $return_goods = M('return_goods')->where("id= $id")->find();
        if($return_goods['imgs'])            
             $return_goods['imgs'] = explode(',', $return_goods['imgs']);
        $user = M('users')->where("user_id = {$return_goods[user_id]}")->find();
        $goods = M('goods')->where("goods_id = {$return_goods[goods_id]}")->find();
        $type_msg = array('退换','换货');
        $status_msg = array('未处理','处理中','已完成');
        if(IS_POST)
        {
            $data['type'] = I('type');
            $data['status'] = I('status');
            $data['remark'] = I('remark');                                    
            $note ="退换货:{$type_msg[$data['type']]}, 状态:{$status_msg[$data['status']]},处理备注：{$data['remark']}";
            $result = M('return_goods')->where("id= $id")->save($data);    
            if($result)
            {        
            	$type = empty($data['type']) ? 2 : 3;
            	$where = " order_id = ".$return_goods['order_id']." and goods_id=".$return_goods['goods_id'];
            	M('order_goods')->where($where)->save(array('is_send'=>$type));//更改商品状态        
                $orderLogic = new OrderLogic();
                $log = $orderLogic->orderActionLog($return_goods[order_id],'refund',$note);
                $this->success('修改成功!');            
                exit;
            }  
        }        
        
        $this->assign('id',$id); // 用户
        $this->assign('user',$user); // 用户
        $this->assign('goods',$goods);// 商品
        $this->assign('return_goods',$return_goods);// 退换货               
        $this->display();
    }
    
    /**
     * 管理员生成申请退货单
     */
    public function add_return_goods()
   {                
            $order_id = I('order_id'); 
            $goods_id = I('goods_id');
                
            $return_goods = M('return_goods')->where("order_id = $order_id and goods_id = $goods_id")->find();            
            if(!empty($return_goods))
            {
                $this->error('已经提交过退货申请!',U('Admin/Order/return_list'));
                exit;
            }
            $order = M('order')->where("order_id = $order_id")->find();
            
            $data['order_id'] = $order_id; 
            $data['order_sn'] = $order['order_sn']; 
            $data['goods_id'] = $goods_id; 
            $data['addtime'] = time(); 
            $data['user_id'] = $order[user_id];            
            $data['remark'] = '管理员申请退换货'; // 问题描述            
            M('return_goods')->add($data);            
            $this->success('申请成功,现在去处理退货',U('Admin/Order/return_list'));
            exit;
    }

    /**
     * 订单操作
     * @param $id
     */
    public function order_action(){    	
        $orderLogic = new OrderLogic();
        $action = I('get.type');
        $order_id = I('get.order_id');
        if($action && $order_id){
        	 $a = $orderLogic->orderProcessHandle($order_id,$action);       	
        	 $res = $orderLogic->orderActionLog($order_id,$action,I('note'));
        	 if($res && $a){
        	 	exit(json_encode(array('status' => 1,'msg' => '操作成功')));
        	 }else{
        	 	exit(json_encode(array('status' => 0,'msg' => '操作失败')));
        	 }
        }else{
        	$this->error('参数错误',U('Admin/Order/detail',array('order_id'=>$order_id)));
        }
    }
    
    public function order_log(){
    	$timegap = I('timegap');
    	if($timegap){
    		$gap = explode('-', $timegap);
    		$begin = strtotime($gap[0]);
    		$end = strtotime($gap[1]);
    	}
    	$condition = array();
    	$log =  M('order_action');
    	if($begin && $end){
    		$condition['log_time'] = array('between',"$begin,$end");
    	}
    	$admin_id = I('admin_id');
		if($admin_id >0 ){
			$condition['action_user'] = $admin_id;
		}
    	$count = $log->where($condition)->count();
    	$Page = new \Think\Page($count,20);
    	foreach($condition as $key=>$val) {
    		$Page->parameter[$key] = urlencode($val);
    	}
    	$show = $Page->show();
    	$list = $log->where($condition)->order('action_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
    	$this->assign('list',$list);
    	$this->assign('page',$show);   	
    	$admin = M('admin')->getField('admin_id,user_name');
    	$this->assign('admin',$admin);    	
    	$this->display();
    }

    /**
     * 检测订单是否可以编辑
     * @param $order
     */
    private function editable($order){
        if($order['shipping_status'] != 0){
            $this->error('已发货订单不允许编辑');
            exit;
        }
        return;
    }

    public function export_order()
    {
    	//搜索条件
		$where = 'where 1=1 ';
		$consignee = I('consignee');
		if($consignee){
			$where .= " AND consignee like '%$consignee%' ";
		}
		$order_sn =  I('order_sn');
		if($order_sn){
			$where .= " AND order_sn = '$order_sn' ";
		}
		if(I('order_status')){
			$where .= " AND order_status = ".I('order_status');
		}
		
//		$timegap = I('timegap');
//		if($timegap){
//			$gap = explode('-', $timegap);
//			$begin = strtotime($gap[0]);
//			$end = strtotime($gap[1]);
//			$where .= " AND add_time>$begin and add_time<$end ";
//		}

        $order_time = I('order_time');
        if ($order_time){
            $begin = strtotime($order_time);
            $end = strtotime('+1 days',strtotime($order_time));
        }else{
            $begin = strtotime(date('Y-m-d'));
            $end = strtotime('+1 days',$begin);
            $order_time = date('Y-m-d');
        }
        $where .= " AND add_time>$begin and add_time<$end ";

		$sql = "select *,FROM_UNIXTIME(add_time,'%Y-%m-%d') as create_time from __PREFIX__order $where order by order_id";
    	$orderList = D()->query($sql);
    	$strTable ='<table width="500" border="1">';
    	$strTable .= '<tr>';
    	$strTable .= '<td style="text-align:center;font-size:12px;width:120px;">订单编号</td>';
    	$strTable .= '<td style="text-align:center;font-size:12px;" width="100">日期</td>';
    	$strTable .= '<td style="text-align:center;font-size:12px;" width="*">收货人</td>';
    	$strTable .= '<td style="text-align:center;font-size:12px;" width="*">收货地址</td>';
    	$strTable .= '<td style="text-align:center;font-size:12px;" width="*">电话</td>';
    	$strTable .= '<td style="text-align:center;font-size:12px;" width="*">订单金额</td>';
    	$strTable .= '<td style="text-align:center;font-size:12px;" width="*">实际支付</td>';
    	$strTable .= '<td style="text-align:center;font-size:12px;" width="*">支付方式</td>';
    	$strTable .= '<td style="text-align:center;font-size:12px;" width="*">支付状态</td>';
    	$strTable .= '<td style="text-align:center;font-size:12px;" width="*">发货状态</td>';
    	$strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品信息</td>';
    	$strTable .= '</tr>';
	    if(is_array($orderList)){
	    	$region	= M('region')->getField('id,name');
	    	foreach($orderList as $k=>$val){
	    		$strTable .= '<tr>';
	    		$strTable .= '<td style="text-align:center;font-size:12px;">&nbsp;'.$val['order_sn'].'</td>';
	    		$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['create_time'].' </td>';	    		
	    		$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['consignee'].'</td>';
                        $strTable .= '<td style="text-align:left;font-size:12px;">'."{$region[$val['province']]},{$region[$val['city']]},{$region[$val['district']]},{$region[$val['twon']]}{$val['address']}".' </td>';                        
	    		$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['mobile'].'</td>';
	    		$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['goods_price'].'</td>';
	    		$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['order_amount'].'</td>';
	    		$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['pay_name'].'</td>';
	    		$strTable .= '<td style="text-align:left;font-size:12px;">'.$this->pay_status[$val['pay_status']].'</td>';
	    		$strTable .= '<td style="text-align:left;font-size:12px;">'.$this->shipping_status[$val['shipping_status']].'</td>';
	    		$orderGoods = D('order_goods')->where('order_id='.$val['order_id'])->select();
	    		$strGoods="";
	    		foreach($orderGoods as $goods){
	    			$strGoods .= "商品编号：".$goods['goods_sn']." 商品名称：".$goods['goods_name'];
                    if ($goods['spec_key_name'] != '') $strGoods .= " 规格：".$goods['spec_key_name'];
                    //$strGoods .= " 数量：".$goods['goods_num']." 单价：".$goods['goods_price'];
	    			$strGoods .= "<br />";
	    		}
	    		unset($orderGoods);
	    		$strTable .= '<td style="text-align:left;font-size:12px;">'.$strGoods.' </td>';
	    		$strTable .= '</tr>';
	    	}
	    }
    	$strTable .='</table>';
    	unset($orderList);
        downloadExcelByDate($strTable,'order',$order_time);
    	exit();
    }



    public function export_delivery()
    {
        //搜索条件
        $where = 'where 1=1 ';
        $consignee = I('consignee');
        if($consignee){
            $where .= " AND consignee like '%$consignee%' ";
        }
        $order_sn =  I('order_sn');
        if($order_sn){
            $where .= " AND order_sn = '$order_sn' ";
        }

        $shipping_status =  I('shipping_status');
        if($shipping_status){
            $where .= " AND shipping_status = '$shipping_status' ";
        }else {
            $where .= " AND shipping_status != 1 ";
        }
        $where .= " AND order_status in (1,2,4)";

        
            
        $sql = "select * from __PREFIX__total_order $where order by order_id";
        $orderList = D()->query($sql);
        $strTable ='<table width="500" border="1">';
        $strTable .= '<tr>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">收货人</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">省</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">市</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">区</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">详细地址</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">邮编</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">手机</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">电话</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品1名称：</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品1价格</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品1商家编码</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品1数量</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品2名称：</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品2价格</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品2商家编码</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品2数量</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品3名称：</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品3价格</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品3商家编码</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品3数量</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品4名称：</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品4价格</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品4商家编码</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品4数量</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品5名称：</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品5价格</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品5商家编码</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品5数量</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品6名称：</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品6价格</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品6商家编码</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品6数量</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品7名称：</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品7价格</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品7商家编码</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品7数量</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品8名称：</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品8价格</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品8商家编码</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品8数量</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品9名称：</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品9价格</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品9商家编码</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品9数量</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品10名称：</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品10价格</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品10商家编码</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">商品10数量</td>';
        $strTable .= '</tr>';
        if(is_array($orderList)){
            $region = M('region')->getField('id,name');
            foreach($orderList as $k=>$val){
                $strTable .= '<tr>';              
                $strTable .= '<td style="text-align:left;font-size:12px;">'.$val['consignee'].'</td>';
                $strTable .= '<td style="text-align:left;font-size:12px;">'."{$region[$val['province']]}".'</td>';
                $strTable .= '<td style="text-align:left;font-size:12px;">'."{$region[$val['city']]}".'</td>';
                $strTable .= '<td style="text-align:left;font-size:12px;">'."{$region[$val['district']]}".'</td>';
                $strTable .= '<td style="text-align:left;font-size:12px;">'."{$region[$val['twon']]}{$val['address']}".' </td>';
                $strTable .= '<td style="text-align:left;font-size:12px;">'.''.'</td>';                        
                $strTable .= '<td style="text-align:left;font-size:12px;">'.$val['mobile'].'</td>';
                $strTable .= '<td style="text-align:left;font-size:12px;">'.'0573-86175555'.'</td>';

                $orderGoods = D('order_goods')->where('order_id='.$val['order_id'])->select();
                $strGoods="";
                foreach($orderGoods as $goods){
                    $strGoods .= $goods['goods_name'];
                    if ($goods['spec_key_name'] != '') $strGoods .= $goods['spec_key_name'];
                    $strTable .= '<td style="text-align:left;font-size:12px;">'.$strGoods.' </td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">'.$goods['goods_price'].'</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">'.$goods['goods_sn'].'</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">'.$goods['goods_num'].'</td>';

                }
                 unset($orderGoods);
               
                 $strTable .= '</tr>';
            }
        }
        $strTable .='</table>';
        unset($orderList);
        downloadExcel($strTable,'order');
        exit();
    }

    
    /**
     * 退货单列表
     */
    public function return_list(){
        $this->display();
    }
    
    /**
     * 添加一笔订单
     */
    public function add_order()
    {
        $order = array();
        //  获取省份
        $province = M('region')->where(array('parent_id'=>0,'level'=>1))->select();
        //  获取订单城市
        $city =  M('region')->where(array('parent_id'=>$order['province'],'level'=>2))->select();
        //  获取订单地区
        $area =  M('region')->where(array('parent_id'=>$order['city'],'level'=>3))->select();
        //  获取配送方式
        $shipping_list = M('plugin')->where(array('status'=>1,'type'=>'shipping'))->select();
        //  获取支付方式
        $payment_list = M('plugin')->where(array('status'=>1,'type'=>'payment'))->select();
        if(IS_POST)
        {
            $order['user_id'] = I('user_id');// 用户id 可以为空
            $order['consignee'] = I('consignee');// 收货人
            $order['province'] = I('province'); // 省份
            $order['city'] = I('city'); // 城市
            $order['district'] = I('district'); // 县
            $order['address'] = I('address'); // 收货地址
            $order['mobile'] = I('mobile'); // 手机           
            $order['invoice_title'] = I('invoice_title');// 发票
            $order['admin_note'] = I('admin_note'); // 管理员备注            
            $order['order_sn'] = date('YmdHis').mt_rand(1000,9999); // 订单编号;
            $order['admin_note'] = I('admin_note'); // 
            $order['add_time'] = time(); //                    
            $order['shipping_code'] = I('shipping');// 物流方式  
            $order['shipping_name'] = M('plugin')->where(array('status'=>1,'type'=>'shipping','code'=>I('shipping')))->getField('name');            
            $order['pay_code'] = I('payment');// 支付方式            
            $order['pay_name'] = M('plugin')->where(array('status'=>1,'type'=>'payment','code'=>I('payment')))->getField('name');  
            $order['admin_id'] = $_SESSION['admin_id'];          
                            
            $goods_id_arr = I("goods_id");
            //var_dump(print_r($goods_id_arr));die;
            $orderLogic = new OrderLogic();
            $order_goods = $orderLogic->get_spec_goods($goods_id_arr); 
            // var_dump(print_r($order_goods));die;   
            // var_dump(print_r($order[province]));die;        
            $result = calculate_price($order['user_id'],$order_goods,$order['shipping_code'],0,$order[province],$order[city],$order[district],0,0,0,0);   
             
            if($result['status'] < 0)	
            {
                 $this->error($result['msg']);      
            } 
           
           $order['goods_price']    = $result['result']['goods_price']; // 商品总价
           $order['shipping_price'] = $result['result']['shipping_price']; //物流费
           $order['order_amount']   = $result['result']['order_amount']; // 应付金额
           $order['total_amount']   = $result['result']['total_amount']; // 订单总价
           
            // 添加订单
            $order_id = M('order')->add($order);
            if($order_id)
            {
                foreach($order_goods as $key => $val)
                {
                    $val['order_id'] = $order_id;
                    $rec_id = M('order_goods')->add($val);
                    if(!$rec_id)                 
                        $this->error('添加失败');                                  
                }
                $this->success('添加商品成功',U("Admin/Order/detail",array('order_id'=>$order_id)));
                exit();
            }
            else{
                $this->error('添加失败');
            }                
        }     
        $this->assign('shipping_list',$shipping_list);
        $this->assign('payment_list',$payment_list);
        $this->assign('province',$province);
        $this->assign('city',$city);
        $this->assign('area',$area);        
        $this->display();
    }
    
    /**
     * 选择搜索商品
     */
    public function search_goods()
    {
    	$brandList =  M("brand")->select();
    	$categoryList =  M("goods_category")->select();
    	$this->assign('categoryList',$categoryList);
    	$this->assign('brandList',$brandList);   	
    	$where = ' is_on_sale = 1 ';//搜索条件
    	I('intro')  && $where = "$where and ".I('intro')." = 1";
    	if(I('cat_id')){
    		$this->assign('cat_id',I('cat_id'));    		
            $grandson_ids = getCatGrandson(I('cat_id')); 
            $where = " $where  and cat_id in(".  implode(',', $grandson_ids).") "; // 初始化搜索条件
                
    	}
        if(I('brand_id')){
            $this->assign('brand_id',I('brand_id'));
            $where = "$where and brand_id = ".I('brand_id');
        }
    	if(!empty($_REQUEST['keywords']))
    	{
    		$this->assign('keywords',I('keywords'));
    		$where = "$where and (goods_name like '%".I('keywords')."%' or keywords like '%".I('keywords')."%')" ;
    	}  	
    	$goodsList = M('goods')->where($where)->order('goods_id DESC')->limit(10)->select();
                
        foreach($goodsList as $key => $val)
        {
            $spec_goods = M('spec_goods_price')->where("goods_id = {$val['goods_id']}")->select();
            $goodsList[$key]['spec_goods'] = $spec_goods;            
        }
    	$this->assign('goodsList',$goodsList);
    	$this->display();        
    }
    
    public function ajaxOrderNotice(){
        $order_amount = M('order')->where("order_status=0 and (pay_status=1 or pay_code='cod')")->count();
        echo $order_amount;
    }




     public function importExcel(){
        header("Content-type: text/html; charset=utf-8"); 
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728 ; 
            $upload->exts = array('xls', 'xlsx');
            $upload->rootPath = './Public/upload/Excel/'; 
            
            $upload->replace =true;
            $upload->subName =false;
            $upload->autoSub = false;
            $upload->saveName = array('date','Ymdhms');
            $up->saveExt = array('xls','xlsx');
            $info=$upload->upload();
            if (!$info) {
                $this->error($upload->getError());
            } else {
                vendor("PHPExcel.PHPExcel");
                $file_name=$upload->rootPath.$info['photo']['savepath'].$info['photo']['savename'];
                $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                //var_dump(print_r($extension));die;
                //Vendor("PHPExcel.PHPExcel.Reader.Excel2007");
                if($extension == 'xlsx'){
                $objReader =\PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel =$objReader->load($file_name,$encode = 'utf-8');
              } 
              if($extension == 'xls'){
                 $objReader =\PHPExcel_IOFactory::createReader('Excel5');
                $objPHPExcel =$objReader->load($file_name,$encode = 'utf-8');
              }
                 //var_dump(print_r($objPHPExcel));die;
                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow(); // 取得总行数
                $highestColumn = $sheet->getHighestColumn(); // 取得总列数
                for($i=2;$i<=$highestRow;$i++)
                {   
                    $order['user_id'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
                    $order['consignee'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();// 收货人
                    $provincename=$objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
                    $province = M('region')->where(array('parent_id'=>0,'level'=>1,'name'=>$provincename))->getField('id');
                    $order['province'] = $province; // 省份
                    $cityname=$objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
                    $city = M('region')->where(array('name'=>$cityname,'level'=>2))->getField('id');
                    $order['city'] =$city; // 城市
                    $districtname=$objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
                    $district = M('region')->where(array('name'=>$districtname,'level'=>3))->getField('id');
                    $order['district'] = $district; // 县
                    $order['address'] = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue(); // 收货地址
                    $order['mobile'] = $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue(); // 手机           
                    $order['invoice_title'] = $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();// 发票
                    $order['admin_note'] = $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue(); // 管理员备注            
                    $order['order_sn'] = date('YmdHis').mt_rand(1000,9999); // 订单编号;
                    $order['add_time'] = time(); //
                    $order['shipping_name'] = $objPHPExcel->getActiveSheet()->getCell("J".$i)->getValue();                   
                    $order['shipping_code'] = M('plugin')->where(array('status'=>1,'type'=>'shipping','name'=>$order['shipping_name']))->getField('code');// 物流方式
                    $order['pay_name'] = $objPHPExcel->getActiveSheet()->getCell("K".$i)->getValue();// 支付方式         
                    $order['pay_code'] = M('plugin')->where(array('status'=>1,'type'=>'payment','name'=>$order['pay_name']))->getField('code');         
                    $order['admin_id'] = $_SESSION['admin_id'];    

                   $a=$objPHPExcel->getActiveSheet()->getCell("L".$i)->getValue();
                    $b=explode(",",$a);
                    foreach($b as $key=>$val){
                      $c=$val;
                      $d=explode("*",$c);
               
                       $goods_id_arr[$d[0]]['key']['goods_num']=$d[1];
                        
                     }
                    // var_dump(print_r($goods_id_arr));die;
                    $orderLogic = new OrderLogic();
                    $order_goods = $orderLogic->get_spec_goods($goods_id_arr);  
                      //var_dump(print_r($order[province]));die;         
                    $result = calculate_price($order['user_id'],$order_goods,$order['shipping_code'],0,$order[province],$order[city],$order[district],0,0,0,0);
                     //var_dump(print_r($result));die;      
                    if($result['status'] < 0)   
                    {
                        $this->error($result['msg']);      
                    } 
           
                    $order['goods_price']    = $result['result']['goods_price']; // 商品总价
                    $order['shipping_price'] = $result['result']['shipping_price']; //物流费
                    $order['order_amount']   = $result['result']['order_amount']; // 应付金额
                    $order['total_amount']   = $result['result']['total_amount']; // 订单总价
                    // var_dump(print_r($order));die; 
            // 添加订单
                    $order_id = M('order')->add($order);
                   // var_dump(print_r($order_id));die; 
                    if($order_id)
                    {
                        foreach($order_goods as $key => $val)
                       {
                            $val['order_id'] = $order_id;
                            $rec_id = M('order_goods')->add($val);
                            //var_dump(print_r($rec_id));die; 
                            if(!$rec_id)                 
                               $this->error('导入商品失败');                                  
                       }
                 
                    }  
                     else{
                         $this->error('导入失败');
                     }

                }
                $this->success('导入数据成功！');

            }
 
         }

    public function Exceltest(){

        $file='./Public/upload/exceltest.xlsx';
        //输出文件
        header("Content-type: application/octet-stream");
        header('Content-Disposition: attachment; filename="'.basename($file) .'"');
        header("Content-Length: ".filesize($file));
        //输出缓冲区
        readfile($file);
     }


}
