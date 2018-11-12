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
 * $Author: IT宇宙人 2015-08-10 $
 */ 
namespace Mobile\Controller;
use Think\Page;
use Think\Ajaxpage;

class MarketsController extends MobileBaseController {
    
    public function index(){
        // $article = M('hq_article')->order('article_id desc')->select();
        // $this->assign('article',$article);

        $articlelist = M('hq_article')->order('article_id desc')->limit(10)->select();
        $this->assign('articlelist',$articlelist);

         $count = M('hq_article')->count();// 查询满足要求的总记录数
         // $Page = new \Think\Page($count,1);// 实例化分页类 传入总记录数和每页显示的记录数
          $page = new Page($count,10);
          $article = M('hq_article')->order('article_id desc')->limit($page->firstRow.','.$page->listRows)->select();

         
      
          $this->assign('article',$article);// 赋值数据集 
         
          $this->assign('page',$page);// 赋值分页输出
          C('TOKEN_ON',false);
           if($_GET['is_ajax'])
            $this->display('ajaxArticleList');
        else
            $this->display();
           
    }

    public function ajaxArticleList() {
         $where= 'where 1';

        // $cat_id  = I("id",0); // 所选择的商品分类id
        // if($cat_id > 0)
        // {
        //     $grandson_ids = getCatGrandson($cat_id);
        //     $where .= " WHERE cat_id in(".  implode(',', $grandson_ids).") "; // 初始化搜索条件
        // }

        $Model  = new \Think\Model();
        $result = $Model->query("select count(1) as count from __PREFIX__hq_artcile $where ");
        $count = $result[0]['count'];
        $page = new AjaxPage($count,10);

        $order = " order by article_id desc"; // 排序
        $limit = " limit ".$page->firstRow.','.$page->listRows;
        $article = $Model->query("select *  from __PREFIX__hq_article $where $order $limit");

        $this->assign('article',$article);
        $html = $this->fetch('ajaxArticleList'); //$this->display('ajax_goods_list');
       exit($html);
    }

     public function details(){
        $article_id = $_GET['id'];
        $ads_id=M('hq_article')->where("article_id=".$article_id)->getField('ads_id');
        $time=M('hq_article')->where("article_id=".$article_id)->getField('publish_time');
        $market =M('hq')->where(array('hq_ads_id'=>$ads_id,'time'=>$time,'issue'=>1))->select();
        $articlelist = M('hq_article')->order('article_id desc')->limit(10)->select();
        $article=M('hq_article')->where("article_id=".$article_id)->select();

         $maxid=M()->query("select max(article_id) from tp_hq_article");
         $minid=M()->query("select min(article_id) from tp_hq_article");
         foreach ($maxid as $key => $value) {
            $max=$value;
         }
         foreach ($minid as $key => $value) {
            $min=$value;
         }

          
        $articleup=$min['min(article_id)'];
        for($i=$article_id+1;$i<=$max['max(article_id)'];$i++){
           
           $title=M('hq_article')->where("article_id=".$i)->getField('title');
           if(!$title==''){
            $articleup=$i;
            break;
           }
          

        } 
        $this->assign('articleup',$articleup);
        
        $articledown=$max['max(article_id)'];
        for($i=$article_id-1;$i>=$min['min(article_id)'];$i--){
           
           $title=M('hq_article')->where("article_id=".$i)->getField('title');
           if(!$title==''){
            $articledown=$i;
            break;
           }
          
        }
        $this->assign('articledown',$articledown);


        $this->assign('article',$article);
        $this->assign('articlelist',$articlelist);
        $this->assign('market',$market);
       $this->display();
    }
}