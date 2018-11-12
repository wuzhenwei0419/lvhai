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
 * 专题管理
 * Date: 2016-03-09
 */

namespace Admin\Controller;

use Think\AjaxPage;
use Think\Model;
use Think\Page;

class MarketController extends BaseController {

    public function index(){
       // $list =  M()->query('select * from tp_hq as a,tp_hq_ads as b where a.hq_ads= b.id '); 
        //  $ads=M('hq_ads')->select();

        //  $hq =  M('hq'); 
        // //  $where = "1=1";
        // // if(I('hq_ads')){
        // //   $where = "hq_ads=".I('hq_ads');
        // //   $this->assign('hq_ads',I('hq_ads'));
        // // }
        // // $keywords = I('keywords',false);
        // // if($keywords){
        // //   $where = "hq_name like '%$keywords%'";
        // // }
        // $count = $hq->where($where)->count();// 查询满足要求的总记录数
        // $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        // $list = $hq->where($where)->order('hq_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
      
        //   $this->assign('list',$list);// 赋值数据集 
        //   $show = $Page->show();// 分页显示输出
        //   $this->assign('Page',$show);// 赋值分页输出
        //   $this->assign('ads',$ads);  
          $this->display();   

    }
     public function ajax_index(){
        //$MarketLogic = new MarketLogic();
       // $list=$MarketLogic->getMarketList();
        $hqads=M('hq_ads')->select();    
        $where = ' 1 ';
        if(!empty($_REQUEST['keywords']))
      {
        $this->assign('keywords',I('keywords'));
        $where = "$where and (title like '%".I('keywords')."%' or content like '%".I('keywords')."%')" ;
      }
       if(!empty($_REQUEST['ads']))
       {
        $this->assign('ads',I('ads'));
        // $res=M('hq_ads')->where(array('id'=>I('ads')))->getField('name');
        // $where .= " and hq_ads = ".$res;
        
       $where .= " and ads_id =  ".I('ads');
       }
      $count = M('hq_article')->where($where)->count();
      $Page  = new AjaxPage($count,10);
      $marketList = M('hq_article')->where($where)->order('article_id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
      $show = $Page->show();//分页显示输出
      $this->assign('page',$show);//赋值分页输出
      $this->assign('marketList',$marketList);
      $this->assign('hqads',$hqads); 
      //$this->assign('list',$list); 
      $this->display();

    }

    
       
	
   public function details(){
     $article_id = $_GET['id'];
     $ads_id=M('hq_article')->where("article_id=".$article_id)->getField('ads_id');
     $time=M('hq_article')->where("article_id=".$article_id)->getField('publish_time');
   
      
      $market=M('hq_ads')->select();
      $list=M('hq')->where(array('hq_ads_id'=>$ads_id,'time'=>$time))->select();
      if(!$list){
       
        $ads=M('hq_article')->where("article_id=".$article_id)->getField('ads');
        M('hq')->query("insert into tp_hq(hq_ads,hq_ads_id,time) values ('".$ads."','".$ads_id."','".$time."')");
        $list=M('hq')->where(array('hq_ads_id'=>$ads_id,'time'=>$time))->select();
      }
      // $id=M('hq_article')->where("article_id=".$article_id)->select();
      $type=M('goods_type')->select();
      $this->assign('type',$type);
      $this->assign('market',$market);
      //$this->assign('info',$info);
      $this->assign('list',$list);
      $this->assign('article_id',$article_id);
      $this->display();
       // dump($list);
    }


   
 public function addlist(){
    $data=array();
    $article_id =$_POST['id'];
    //var_dump(print_r($article_id));die;
    $hq_id=array();
    $hq_id=$_POST['hq_id'];
    foreach ($hq_id as $key => $value) {
      $data[$key]['hq_id']=$value;
    }
    $hq_name_id=array();
    $hq_name_id=$_POST['hq_name'];
    foreach ($hq_name_id as $key => $value) {
      $data[$key]['hq_name']=M('goods_type')->where(array('id'=>$value))->getField('name');
      $data[$key]['hq_name_id']=$value;
    }
    $hq_variety=array();
    $hq_variety=$_POST['hq_variety'];
    foreach ($hq_variety as $key => $value) {
      $data[$key]['hq_variety']=$value;
    }
    $hq_address=array();
    $hq_address=$_POST['hq_address'];
    foreach ($hq_address as $key => $value) {
      $data[$key]['hq_address']=$value;
    }
    $hq_ads_id=array();
    $hq_ads_id=$_POST['hq_ads'];
    foreach ($hq_ads_id as $key => $value) {
      $data[$key]['hq_ads_id']=$value;
      $data[$key]['hq_ads']=M('hq_ads')->where(array('id'=>$value))->getField('name');
      $data[$key]['time']=M('hq_article')->where("article_id=".$article_id)->getField('publish_time');
    }
    $hq_spec=array();
    $hq_spec=$_POST['spec'];
    foreach ($hq_spec as $key => $value) {
      $data[$key]['spec']=$value;
    }
    $hq_unit=array();
    $hq_unit=$_POST['hq_unit'];
    foreach ($hq_unit as $key => $value) {
      $data[$key]['hq_unit']=$value;
    }
    $hq_hprice=array();
    $hq_hprice=$_POST['hprice'];
    foreach ($hq_hprice as $key => $value) {
      $data[$key]['hprice']=$value;
    }
    $hq_lprice=array();
    $hq_lprice=$_POST['lprice'];
    foreach ($hq_lprice as $key => $value) {
      $data[$key]['lprice']=$value;
    }
    $hq_eprice=array();
    $hq_eprice=$_POST['eprice'];
    foreach ($hq_eprice as $key => $value) {
      $data[$key]['eprice']=$value;
    }
    $suttle=array();
    $suttle=$_POST['suttle'];
    foreach ($suttle as $key => $value) {
      $data[$key]['suttle']=$value;
    }
    $gross=array();
    $gross=$_POST['gross'];
    foreach ($gross as $key => $value) {
      $data[$key]['gross']=$value;
    }
    
   
    $newdata=array();
    foreach ($data as $key => $value) {
      $newdata = $value;
      $eprice=M('hq')->where(array('hq_variety'=>$newdata['hq_variety'],'hq_address'=>$newdata['hq_address'],'hq_ads_id'=>$newdata['hq_ads_id'],'time'=>($newdata['time']-86400)))->getField('eprice');
      if($eprice==0){
        $newdata['hq_up']=0;
      }else{
        $newdata['hq_up']=$newdata['eprice']-$eprice;
      }
      

              if($newdata['hq_name']==''){
                    $return_arr = array(
                        'status' => -1,
                        'msg'   => '品种必填!',
                        'data'  => M('hq')->getError(),
                    );
                    $this->ajaxReturn(json_encode($return_arr));

                  }

        
      if($newdata['hq_id'] == ''){
          $r = M('hq')->add($newdata);

        }else{
          $r = M('hq')->where("hq_id=".$newdata['hq_id'])->save($newdata);
        }
    }
    $return_arr = array(
                         'status' => 1,
                        'msg'   => '操作成功',                          
                        'data'  => array('url'=>U('Admin/Market/index')),
                    );
                    $this->ajaxReturn(json_encode($return_arr)); 

 }


  public function article(){
        $article_id = $_GET['id'];
        

         $market=M('hq_ads')->select(); 
         $this->assign('market',$market);
         $article=M('hq_article')->where(array('article_id'=>$article_id))->select();
         $this->assign('article',$article);  
         // print_r($article);
         $this->display();

    }

   public function addarticle(){

         $model=D('hq_article'); 
         $type = $_POST['id'] > 0 ? 2 : 1; 
         $_POST['ads_id']=$_POST['hq_ads'];
         $_POST['ads']=M('hq_ads')->where(array('id'=>$_POST['hq_ads']))->getField('name');
         $_POST['publish_time']=strtotime($_POST['publish_time']);
         
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
                   // C('TOKEN_ON',true); //  form表单提交

                   if($_POST['title']==''){
                    $return_arr = array(
                        'status' => -1,
                        'msg'   => '标题必填!',
                        'data'  => $model->getError(),
                    );
                    $this->ajaxReturn(json_encode($return_arr));

                  }
                 

                  
                   if($_POST['ads']==''){
                    $return_arr = array(
                        'status' => -1,
                        'msg'   => '市场必选!',
                        'data'  => $model->getError(),
                    );
                    $this->ajaxReturn(json_encode($return_arr));

                  }
                  
                   if($_POST['publish_time']==''){
                    $return_arr = array(
                        'status' => -1,
                        'msg'   => '发布时间必填!',
                        'data'  => $model->getError(),
                    );
                    $this->ajaxReturn(json_encode($return_arr));

                  }


                    if ($type == 2)
                    {
                        $model->where(array('article_id'=>$_POST['id']))->save(); // 写入数据到数据库                        
                    }
                    else
                    {   
                        $insert_id = $model->add(); // 写入数据到数据库                        
                    }
          
                    $return_arr = array(
                         'status' => 1,
                        'msg'   => '操作成功',                          
                        'data'  => array('url'=>U('Admin/Market/index')),
                    );
                    $this->ajaxReturn(json_encode($return_arr));
                   
                }  
            }

              $this->display();
          
     }

  
   public function issue(){
    $data=array();
    $hq_id=array();
    $hq_id=$_POST['hq_id'];
    foreach ($hq_id as $key => $value) {
      $data=$value;
     //var_dump(print_r($data));die;
      M('hq')->query("update tp_hq set issue = 1 where hq_id =".$data);
    }
     $return_arr = array(
                         'status' => 1,
                        'msg'   => '操作成功',                          
                        'data'  => array('url'=>U('Admin/Market/index')),
                    );
                    $this->ajaxReturn(json_encode($return_arr));

   }


 

  public function del()
    {
        $article_id = $_GET['id'];
        
         
        M("hq_article")->where('article_id ='.$article_id)->delete();  
            
                     
        $this->success("操作成功!!!",U('Admin/Market/index'));
    }



  public function dellist()
    {
        $hq_id = $_GET['id'];
        
         
        M("hq")->where('hq_id ='.$hq_id)->delete();  
            
                     
        $this->success("操作成功!!!");
    }




    public function importExcel(){
        header("Content-type: text/html; charset=utf-8");
            $article_id=$_GET['id'];
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
                  
                    $data['hq_name'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
                    $data['hq_name_id']= M('goods_type')->where(array('name'=>$data['hq_name']))->getField('id');
                    $data['hq_variety']= $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
                    $data['hq_address']= $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
                    $data['hq_ads_id']= M('hq_article')->where(array('article_id'=>$article_id))->getField('ads_id');
                    $data['hq_ads']= M('hq_article')->where(array('article_id'=>$article_id))->getField('ads');
                    $data['spec']= $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
                    $data['hq_unit']= $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
                    $data['lprice']= $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
                    $data['hprice']= $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
                    $data['eprice']= $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
                    $data['time']= M('hq_article')->where(array('article_id'=>$article_id))->getField('publish_time');
                    $eprice=M('hq')->where(array('hq_variety'=>$data['hq_variety'],'hq_address'=>$data['hq_address'],'hq_ads_id'=>$data['hq_ads_id'],'time'=>($data['time']-86400)))->getField('eprice');
                    if($eprice>0){
                      $data['hq_up']= $data['eprice']-$eprice;
                    }else{
                      $data['hq_up']=0;
                    }
                    
                    $data['suttle']= $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue();
                    $data['gross']= $objPHPExcel->getActiveSheet()->getCell("J".$i)->getValue();
                    $data['issue']= 0;
                    $add=M('hq')->add($data);
                }
                 $list=M('hq')->where(array('hq_name'=>''))->delete();
            // dump($data);die;
                if ($add) {
                    
                    $this->success('导入成功！',U('Admin/Market/details',array('id'=>$article_id)));
                }else{
                    $this->error('导入失败，可能是Excel格式问题');
                }
            }
      }

      public function Exceltest(){

        $file='./Public/upload/excel.xlsx';
        //输出文件
        header("Content-type: application/octet-stream");
        header('Content-Disposition: attachment; filename="'.basename($file) .'"');
        header("Content-Length: ".filesize($file));
        //输出缓冲区
        readfile($file);
     }
         
}


    
             