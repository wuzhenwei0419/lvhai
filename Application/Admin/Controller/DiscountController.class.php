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
 * Date: 2015-12-11
 */
namespace Admin\Controller;
use Think\AjaxPage;

class DiscountController extends BaseController {
    


    public function index(){

    	$discountlist=M('discount')->select();
        $this->assign('discountlist',$discountlist);
        $this->display();
    	
    }

    public function discount(){
    	 $dis_id = $_GET['id'];
         $discountlist=M('discount')->where(array('dis_id'=>$dis_id))->select();
         $this->assign('discountlist',$discountlist);  
         
         $this->display();



    }

    public function add_discount(){
    	$model=D('discount'); 
         $type = $_POST['id'] > 0 ? 2 : 1;   
         $min=$_POST['nummin'];
         $max=$_POST['nummax'];

        //   var_dump(print_r($image);die;
       if(($_GET['is_ajax'] == 1) && IS_POST)//ajax提交验证
            {                
                C('TOKEN_ON',false);
                if(!$model->create(NULL,$type))// 根据表单提交的POST数据创建数据对象                 
                {
                    //  编辑
                    $return_arr = array(
                        'status' => -1,
                        'msg'   => '提交不成功!',
                        'data'  => $model->getError(),
                    );
                    $this->ajaxReturn(json_encode($return_arr));
                }else {                   
                   // C('TOKEN_ON',true); //  form表单提
                if($min<$max){
                    if ($type == 2)
                    {
                        $model->where(array('dis_id'=>$_POST['id']))->save(); // 写入数据到数据库                        
                    }
                    else
                    {   
                        $insert_id = $model->add(); // 写入数据到数据库                        
                    }

          
                    $return_arr = array(
                         'status' => 1,
                        'msg'   => '操作成功',                          
                        'data'  => array('url'=>U('Admin/Discount/index')),
                    );
                    $this->ajaxReturn(json_encode($return_arr));
                    
                   }else{
                     $return_arr = array(
                        'status' => -1,
                        'msg'   => '填写区间不正确！',
                        'data'  => $model->getError(),
                    );
                    $this->ajaxReturn(json_encode($return_arr));

                   }

                }  
            }

              $this->display();

    }

    public function del(){
    	 $dis_id = $_GET['id'];
        
         
        M("discount")->where('dis_id ='.$dis_id)->delete();  
            
                     
        $this->success("操作成功!!!",U('Admin/Discount/index'));
    }

    
   
}