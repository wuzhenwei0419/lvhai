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

use Think\Page;
use Think\Verify;


class AgentController extends BaseController {


    public function index(){
        $res = $list = array();
        $keywords = I('keywords');
        if(empty($keywords)){
            $res = D()->query("select * from tp_admin WHERE role_id=18");
        }else{
            $res = D()->query("select * from __PREFIX__admin where user_name like '%$keywords%' and role_id=18 order by admin_id");
        }
        $role = D('admin_role')->getField('role_id,role_name');
        if($res && $role){
            foreach ($res as $val){
                $val['role'] =  $role[$val['role_id']];
                $val['add_time'] = date('Y-m-d H:i:s',$val['add_time']);
                $list[] = $val;
            }
        }
        $this->assign('list',$list);
        $this->display();
    }
    
    public function agent_info(){
        $admin_id = I('get.admin_id',0);    
        if($admin_id){
            $info = D('admin')->where("admin_id=$admin_id")->find();
                $info['password'] =  "";
            $this->assign('info',$info);
        }
        if($info['phone_num']){
           $data= M('application')->where(array('phone_num'=>$info['phone_num']))->select();
            $this->assign('data',$data);
        }
        $act = empty($admin_id) ? 'add' : 'edit';
        $this->assign('act',$act);
        $role = D('admin_role')->where(array('role_name'=>'代理商管理'))->select();
        $this->assign('role',$role);
        $this->display();
    }
    
    public function adminHandle(){
        $data = I('post.');
        if(empty($data['password'])){
            unset($data['password']);
        }else{
            $data['password'] = encrypt($data['password']);
        }
         $info['user_name']=$data['name'];
         $info['email']=$data['email'];
         $info['phone_num']=$data['phone_num'];
         $info['address']=$data['address']; 
         $info['pass']=2;
         $info['add_time']=time();
         $info['idcard']=$data['idcard'];
         $info['img1']=$data['img1'];
         $info['img2']=$data['img2'];


        if($data['act'] == 'add'){
            unset($data['admin_id']);           
            $data['add_time'] = time();
            if(D('admin')->where("user_name='".$data['user_name']."'")->count()){
                $this->error("此用户名已被注册，请更换",U('Admin/Agent/agent_info'));
            }else{
                $r = D('admin')->add($data);
                D('application')->add($info);
            }
        }
        
        if($data['act'] == 'edit'){
            $num=D('admin')->where('admin_id='.$data['admin_id'])->getField('phone_num');
            D('application')->where('phone_num='.$num)->save($info);
            $r = D('admin')->where('admin_id='.$data['admin_id'])->save($data);
            
        }
        
        if($data['act'] == 'del' && $data['admin_id']>1){
            $phone = M('admin')->where('admin_id='.$data['admin_id'])->getField('phone_num');
            D('application_buy')->where('user_phone='.$phone)->delete();
            D('application')->where('phone_num='.$phone)->delete(); 
            $r = D('admin')->where('admin_id='.$data['admin_id'])->delete();
            exit(json_encode(1));
        }
        
        if($r){
            $this->success("操作成功",U('Admin/Agent/index'));
        }else{
            $this->error("操作失败",U('Admin/Agent/index'));
        }
    }
   //申请代理商列表
    public function applicationlist(){
        $model=M('application');
        $list=$model->where(array('pass'=>1))->select();
        $count = $model->where(array('pass'=>1))->count();       
        $Page  = new Page($count,25);
        $show  = $Page->show();
        $this->assign('list',$list);
        $this->assign('show',$show);
        $this->display();
    }
    //申请详情
    public function applicationdetail(){
        $id=$_GET['user_id'];
        $list=M('application')->where(array('user_id'=>$id,'pass'=>1))->select();
        //var_dump(print_r($list));
        $this->assign('list',$list);
        $this->display();
    }
  //审核通过
    public function add_application(){
        $id=$_GET['user_id'];
        M()->execute("update tp_application set pass = 2 where user_id=".$id);
        $user=M('application')->where(array('user_id'=>$id))->select();
        $data['user_name']=$user[0]['phone_num'];
        $data['email']=$user[0]['email'];
        $data['password']=encrypt('123456');
        $data['add_time']=time();
        $data['role_id']=18;
        $data['address']=$user[0]['address'];
        $data['phone_num']=$user[0]['phone_num'];
        $data['name']=$user[0]['user_name'];
        M('admin')->add($data);
        $this->success('操作成功！',U('Admin/Agent/applicationlist'));



    }
  //审核不通过
    public function del_application(){
        $id=$_GET['user_id'];
        M()->execute("update tp_application set pass = 3 where user_id = ".$id);
        $this->success('操作成功！',U('Admin/Agent/applicationlist'));
        // $return_arr = array(
        //                  'status' => 1,
        //                 'msg'   => '操作成功',                          
        //                 'data'  => array('url'=>U('Admin/Agent/applicationlist')),
        //             );
        //             $this->ajaxReturn(json_encode($return_arr)); 

    }
    //删除
    public function del(){
        $id=$_GET['user_id'];
        M('application')->where(array('user_id'=>$id))->delete();
        $this->success('操作成功！',U('Admin/Agent/applicationlist'));
        // $return_arr = array(
        //                  'status' => 1,
        //                 'msg'   => '操作成功',                          
        //                 'data'  => array('url'=>U('Admin/Agent/applicationlist')),
        //             );
        //             $this->ajaxReturn(json_encode($return_arr)); 

    }

    public function pass_img1(){
        $imgname = time().'-1.png';
        $tmp = $_FILES['img1']['tmp_name'];
        $filepath = 'Public/upload/idcard/';
        if(move_uploaded_file($tmp,$filepath.$imgname)){
            $this->ajaxReturn($filepath.$imgname);
        }else{
            echo "上传失败";
        }
    }
    public function pass_img2(){
        $imgname = time().'-2.png';
        $tmp = $_FILES['img2']['tmp_name'];
        $filepath = 'Public/upload/idcard/';
        if(move_uploaded_file($tmp,$filepath.$imgname)){
            $this->ajaxReturn($filepath.$imgname);
        }else{
            echo "上传失败";
        }
    }

    /**
     * 供应商列表
     */
    public function supplier()
    {
        $supplier_model = M('');
        $db_prefix = C('DB_PREFIX');
        $supplier_count = $supplier_model->table($db_prefix.'suppliers')->where('')->count();
        $page = new Page($supplier_count, 10);
        $show = $page->show();
        $supplier_list = $supplier_model
                ->field('s.*,a.admin_id,a.user_name')
                ->table($db_prefix.'suppliers s')
                ->join('LEFT JOIN '.$db_prefix.'admin AS a ON a.suppliers_id = s.suppliers_id')
                ->where('')
                ->limit($page->firstRow, $page->listRows)
                ->select();
        $this->assign('list', $supplier_list);
        $this->assign('page', $show);
        $this->display();
    }

    public function supplier_lists(){
        $lists=M('suppliers')->where('is_check = 1')->select();
        $count = M('suppliers')->where(array('is_check'=>1))->count();       
        $Page  = new Page($count,25);
        $show  = $Page->show();
        $this->assign('lists',$lists);
        $this->assign('show',$show);
        $this->display();
    }
    //申请详情
    public function supplier_detail(){
        $id=$_GET['suppliers_id'];
        $lists=M('suppliers')->where(array('suppliers_id'=>$id,'is_check'=>1))->find();
        $this->assign('lists',$lists);
        $this->display();
    }
     public function del_supplier(){
    $id=$_GET['suppliers_id'];
    M('suppliers')->where('suppliers_id = '.$id)->delete();
    $this->success('操作成功',U('Agent/supplier_lists'));
   }
    public function supplier_pass(){
        $id=$_GET['suppliers_id'];
        M()->execute("update tp_suppliers set is_check = 2 where suppliers_id = ".$id);
        $this->success('操作成功',U('Agent/supplier_lists'));
    }
    public function supplier_out(){
        $id=$_GET['suppliers_id'];
        M()->execute("update tp_suppliers set is_check = 3 where suppliers_id = ".$id);
        $this->success('操作成功',U('Agent/supplier_lists'));
    }

    /**
     * 供应商资料
     */
    public function supplier_info()
    {
        $suppliers_id = I('get.suppliers_id', 0);
        if ($suppliers_id) {
            $db_prefix = C('DB_PREFIX');
            $suppliers_model = M('suppliers');
            $info = $suppliers_model
                    ->field('s.*,a.admin_id,a.user_name')
                    ->table($db_prefix.'suppliers s')
                    ->join('LEFT JOIN '.$db_prefix.'admin AS a ON a.suppliers_id = s.suppliers_id')
                    ->where(array('s.suppliers_id' => $suppliers_id))
                    ->find();
            $this->assign('info', $info);
        }
        $act = empty($suppliers_id) ? 'add' : 'edit';
        $this->assign('act', $act);
        // $admin = M('admin')->field('admin_id,user_name')->where('role_id<>18')->select();
        // $this->assign('admin', $admin);
        $this->display();
    }

    /**
     * 供应商增删改
     */
    public function supplierHandle()
    {
        $data = I('post.');
        $suppliers_model = M('suppliers');
        //增
        if ($data['act'] == 'add') {
            unset($data['suppliers_id']);
            if($data['nature_id']==0){
                $data['nature']='植户(个体)';
                }else{
                $data['nature']='贸易商(企业)';
                }
                $data['is_check']= 2 ;
            $count = $suppliers_model->where("suppliers_name='" . $data['suppliers_name'] . "'")->count();
            if ($count) {
                $this->error("此供应商名称已被注册，请更换", U('Admin/Agent/supplier_info'));
            } else {
                $r = $suppliers_model->add($data);
                // if (!empty($data['admin_id'])) {
                //     $admin_data['suppliers_id'] = $suppliers_model->getLastInsID();
                //     M('admin')->where(array('suppliers_id' => $admin_data['suppliers_id']))->save(array('suppliers_id' => 0));
                //     M('admin')->where(array('admin_id' => $data['admin_id']))->save($admin_data);
                // }
            }
        }
        //改
        if ($data['act'] == 'edit' && $data['suppliers_id'] > 0) {
            if($data['nature_id']==0){
                $data['nature']='植户(个体)';
            }else{
                $data['nature']='贸易商(企业)';
            }
             $data['is_check']= 2 ;
            $r = $suppliers_model->where('suppliers_id=' . $data['suppliers_id'])->save($data);
            // if (!empty($data['admin_id'])) {
            //     $admin_data['suppliers_id'] = $data['suppliers_id'];
            //     M('admin')->where(array('suppliers_id' => $admin_data['suppliers_id']))->save(array('suppliers_id' => 0));
            //     M('admin')->where(array('admin_id' => $data['admin_id']))->save($admin_data);
            // }
        }
        //删
        if ($data['act'] == 'del' && $data['suppliers_id'] > 0) {
            $r = $suppliers_model->where('suppliers_id=' . $data['suppliers_id'])->delete();
            // M('admin')->where(array('suppliers_id' => $data['suppliers_id']))->save(array('suppliers_id' => 0));
        }

        if ($r !== false) {
            $this->success("操作成功", U('Admin/Agent/supplier'));
        } else {
            $this->error("操作失败", U('Admin/Agent/supplier'));
        }
    }

     public function suppliers_img1(){
        $imgname = time().'-1.png';
        $tmp = $_FILES['idcard_img1']['tmp_name'];
        $filepath = 'Public/upload/suppliers';
        if(move_uploaded_file($tmp,$filepath.$imgname)){
            $this->ajaxReturn($filepath.$imgname);
        }else{
            echo "上传失败";
        }
    }
    public function suppliers_img2(){
        $imgname = time().'-2.png';
        $tmp = $_FILES['idcard_img2']['tmp_name'];
        $filepath = 'Public/upload/suppliers';
        if(move_uploaded_file($tmp,$filepath.$imgname)){
            $this->ajaxReturn($filepath.$imgname);
        }else{
            echo "上传失败";
        }
    }
    public function suppliers_img3(){
        $imgname = time().'-3.png';
        $tmp = $_FILES['business_licence']['tmp_name'];
        $filepath = 'Public/upload/suppliers';
        if(move_uploaded_file($tmp,$filepath.$imgname)){
            $this->ajaxReturn($filepath.$imgname);
        }else{
            echo "上传失败";
        }
    }

   
}