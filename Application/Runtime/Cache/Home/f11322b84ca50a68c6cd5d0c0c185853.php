<?php if (!defined('THINK_PATH')) exit(); if(is_array($commentlist)): $i = 0; $__LIST__ = $commentlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="fn-mc-bk">
        <div class="bk-img">
          <div class="avatar_bg"><img width="auto" height="auto"src="<?php echo ((isset($v['head_pic']) && ($v['head_pic'] !== ""))?($v['head_pic']):'/Template/pc/soubao/Static/images/defaultface_user_small.png'); ?>" alt=""></div>
          <h3><?php echo ($v['username']); ?></h3>
        </div>
        <div class="bk-r">
          <div class="ui_poptip_arrow poptip_left"><em></em>
            <span></span>
          </div>
          <div class="bk-title fix">
            <div class="fn-comment-star" data-star="5">&nbsp;&nbsp;卖家服务:&nbsp;&nbsp;<?php  for($i=0;$i<=$v['service_rank'];$i++) { echo '<i class="star-01"></i>'; } for($i=0;$i<5-$v['service_rank'];$i++) { echo '<i class="star-02"></i>'; } ?></div>
            <div class="fn-comment-star" data-star="5">&nbsp;&nbsp;商品质量:&nbsp;&nbsp;<?php  for($i=0;$i<=$v['goods_rank'];$i++) { echo '<i class="star-01"></i>'; } for($i=0;$i<5-$v['goods_rank'];$i++) { echo '<i class="star-02"></i>'; } ?></div>
            <div class="fn-comment-star" data-star="5">&nbsp;&nbsp;物流速度:&nbsp;&nbsp;<?php  for($i=0;$i<=$v['deliver_rank'];$i++) { echo '<i class="star-01"></i>'; } for($i=0;$i<5-$v['deliver_rank'];$i++) { echo '<i class="star-02"></i>'; } ?></div>                        
            <span class="bk-title-time"><?php echo (date("Y-m-d",$v['add_time'])); ?></span>
          </div>
          <div class="bk-mc">
            <dl class="bk-mc-up">              
              <dd>体　　会：</dd>
              <dt class="fix"><?php echo (htmlspecialchars_decode($v['content'])); echo (htmlspecialchars_decode($v['replyList'])); ?> </dt>
              <dd>购买日期：</dd>
              <dt class="fix"><?php echo (date("Y-m-d",$v['add_time'])); ?></dt>
              <dt class="fix">
                    <br/>  <!--晒单-->
                    <?php if(is_array($v['img'])): foreach($v['img'] as $key=>$v2): ?><a href="<?php echo ($v2); ?>" target="_blank"><img alt="" src="<?php echo ($v2); ?>" width="80" height="80" /></a>&nbsp;&nbsp;<?php endforeach; endif; ?>
               </dt> 
               <?php  foreach($replyList as $key => $value){ echo '<dd>回 复：</dd>'; echo '<dt class="fix">'; echo $value['content']; echo '</dt>'; echo '<dd>回复日期：</dd>'; echo '<dt class="fix">'; echo date('Y-m-d',$value['add_time']); echo '</dt>'; } ?>
                           
            </dl>
            
          </div>
        </div>
</div><?php endforeach; endif; else: echo "" ;endif; ?>

    <!-- /.fn-comment-list -->
    <div class="fn-page-css-1" style="display: block;">
      <div class="fn-page-css-1 pagintion fix" style="display: block;">
      	<!--
        <ul>
          <li class="pg-prev pg-off"><a href="javascript:void(0)"><i></i>上一页</a></li>
          <li class="pg-on pg-index" data-page-index="1"><a href="javascript:void(0)" class="on">1</a></li>
          <li pg-index="" data-page-index="2"><a href="javascript:void(0)">2</a></li>
          <li pg-index="" data-page-index="3"><a href="javascript:void(0)">3</a></li>
          <li pg-index="" data-page-index="4"><a href="javascript:void(0)">4</a></li>
          <li pg-index="" data-page-index="5"><a href="javascript:void(0)">5</a></li>
          <li pg-index="" data-page-index="6"><a href="javascript:void(0)">6</a></li>
          <li class="pg-next" data-page-index="2"><a href="javascript:void(0)">下一页</a></li>
          <li class="pg-num-top">到第</li>
          <li class="pg-num">
            <input type="text" class="jump_index">
          </li>
          <li class="pg-num-bot">页</li>
          <li class="pg-btn"><a href="javascript:void(0);" class="btn_jump">确定</a></li>
        </ul>-->
        <?php echo ($page); ?>
      </div>
    </div>
<script>
    // 点击分页触发的事件
    $("#ajax_comment_return .pagination  a").click(function(){
        cur_page = $(this).data('p');
        ajaxComment(commentType,cur_page);
    });
</script>