<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/zh_tcwq/template/public/ygcsslist.css">
<ul class="nav nav-tabs">
    <span class="ygxian"></span>
    <div class="ygdangq">当前位置:</div>    
    <li class="active"><a href="<?php  echo $this->createWebUrl('activity')?>">活动管理</a></li>
    <li><a href="<?php  echo $this->createWebUrl('addactivity')?>">添加活动</a></li>
</ul>
<div class="row ygrow">
    <div class="col-lg-12">
<!--     <div class="panel panel-default ygbody">
        <div class="panel-body">
            <p class="yangshi">跳转帖子页面地址,id在帖子列表中获取:&nbsp;&nbsp;<a>../infodetial/infodetial?id=1</a></p>
        </div>
    </div> -->
        <form action="" method="get" class="col-md-3">
          <input type="hidden" name="c" value="site" />
          <input type="hidden" name="a" value="entry" />
          <input type="hidden" name="m" value="zh_tcwq" />
          <input type="hidden" name="do" value="activity" />
            <div class="input-group" style="width: 300px">
                <input type="text" name="keywords" class="form-control" value="<?php  echo $_GPC['keywords'];?>" placeholder="请输入活动标题">
                <span class="input-group-btn">
                    <input type="submit" class="btn btn-default" name="submit" value="查找"/>
                </span>
            </div>
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
        </form>
         <form action="" method="get" class="col-md-3">
          <input type="hidden" name="c" value="site" />
          <input type="hidden" name="a" value="entry" />
          <input type="hidden" name="m" value="zh_tcwq" />
          <input type="hidden" name="do" value="activity" />
            <div class="input-group" style="width: 100px">
                <?php  echo tpl_form_field_daterange('time',$_GPC['time']);?>
                <span class="input-group-btn">
                    <input type="submit" class="btn btn-default" name="submit2" value="查找"/>
                     <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                </span>
            </div><!-- /input-group -->
        </form>
        <form action="" method="get" class="col-md-3">
          <input type="hidden" name="c" value="site" />
          <input type="hidden" name="a" value="entry" />
          <input type="hidden" name="m" value="zh_tcwq" />
          <input type="hidden" name="do" value="activity" />
            <div class="input-group" style="width: 100px">
               <div class="col-md-3 yg5_key">
                <div></div>
                <select class="input-group" style="width: 200px" name="type_id">  
                <option value="">不限</option>
                     <?php  if(is_array($type)) { foreach($type as $row) { ?>  
                     <?php  if($_GPC['type_id']==$row['id']) { ?>                            
                    <option value="<?php  echo $row['id'];?>" selected><?php  echo $row['type_name'];?></option>
                    <?php  } else { ?>
                    <option value="<?php  echo $row['id'];?>"><?php  echo $row['type_name'];?></option>
                    <?php  } ?>
                       <?php  } } ?>
                </select>
                </div>
                <span class="input-group-btn">
                    <input type="submit" class="btn btn-default" name="submit2" value="查找"/>
                     <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>

                </span>
            </div><!-- /input-group -->
        </form>
    </div><!-- /.col-lg-6 -->
</div>  
<div class="main">
  <div class="panel panel-default">
        <div class="panel-body ygbtn">
             <div class="btn ygshouqian2" id="allselect">批量删除</div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            活动管理
        </div>
        <div class="panel-body" style="padding: 0px 15px;">
            <div class="row">
                <table class="yg5_tabel col-md-12">
                    <tr class="yg5_tr1">
                       <th class="store_td1 col-md-1" style="text-align: center;">
	                      <input type="checkbox" class="allcheck" />
	                      <span class="store_inp">全选</span>                      
	                  </th>
                        <td class="store_td1 col-md-1">活动id</td>  
                        <td class="col-md-1">所属城市</td>
                        <td class="col-md-1">活动标题</td>
                        <td class="col-md-1">活动logo</td>
                        <td class="col-md-1">联系电话</td>
                        <td class="col-md-1">金额</td>
                        <td class="col-md-1">报名人数</td>
                        <td class="col-md-1">报名通道</td>
                        <td class="col-md-2">操作</td>
                    </tr>
                    <?php  if(is_array($list)) { foreach($list as $key => $item) { ?>
                    <tr class="yg5_tr2">
                       <td>
	                      <input type="checkbox" name="test" value="<?php  echo $item['id'];?>">
	                     </td>
                        <td><?php  echo $item['id'];?></td>
                        <td><?php  if($item['cityname']) { ?><?php  echo $item['cityname'];?><?php  } else { ?>全国版<?php  } ?></td>
                        <td><?php  echo $item['title'];?></td>
                        <td><img height="40" src="<?php  echo tomedia($item['logo']);?>"></td>
                        <td><?php  echo $item['tel'];?></td>
                        <td><?php  echo $item['money'];?></td>
                        <td><?php  echo $item['sign_num'];?></td>
                        <td><?php  if($item['is_bm']==1) { ?> <span class="label storeblue">  <a href="<?php  echo $this->createWebUrl('activity', array('id' => $item['id'],'op'=>change,'is_bm'=>2))?>"   >开启</a></span><?php  } else if($item['is_bm']==2) { ?> <span class="label storegrey"><a href="<?php  echo $this->createWebUrl('activity', array('id' => $item['id'],'op'=>change,'is_bm'=>1))?>">关闭</a></span><?php  } ?></td>
                       <td>
                        <span class="label storeblue">  <a href="<?php  echo $this->createWebUrl('acthx', array('act_id' => $item['id']))?>"   >核销员列表</a></span>
                         <span class="label storeblue">  <a href="<?php  echo $this->createWebUrl('joinlist', array('act_id' => $item['id']))?>"   >报名列表</a></span>
                          <a href="<?php  echo $this->createWebUrl('addactivity',array('id'=>$item['id']));?>" class="storespan btn btn-xs">
                              <span class="fa fa-pencil"></span>
                              <span class="bianji">编辑
                                  <span class="arrowdown"></span>
                              </span>                            
                          </a>
                          <a href="" class="storespan btn btn-xs" data-toggle="modal" data-target="#myModal<?php  echo $item['id'];?>">
                              <span class="fa fa-trash-o"></span>
                              <span class="bianji">删除
                                  <span class="arrowdown"></span>
                              </span>
                          </a>
                       </td>

                   </tr>
                   <div class="modal fade" id="myModal<?php  echo $item['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel" style="font-size: 20px;">提示</h4>
                        </div>
                        <div class="modal-body" style="font-size: 20px">
                            确定删除么？
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <a href="<?php  echo $this->createWebUrl('activity', array('op' => 'delete', 'id' => $item['id']))?>" type="button" class="btn btn-info" >确定</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php  } } ?>
            <?php  if(empty($list)) { ?>
            <tr class="yg5_tr2">
            <td colspan="11">
                  暂无帖子信息
              </td>
          </tr>
          <?php  } ?>
      </table>
  </div>
</div>
</div>
</div>
<div class="text-right we7-margin-top">
   <?php  echo $pager;?>
</div>
<script type="text/javascript">
    $(function(){
        $("#frame-20").show();
        $("#yframe-20").addClass("wyactive");
    	// ———————————————批量删除———————————————
        $("#allselect").on('click',function(){
            var check = $("input[type=checkbox][class!=allcheck]:checked");
            if(check.length < 1){
                alert('请选择要删除的帖子!');
                return false;
            }else if(confirm("确认要删除此帖子?")){
                var id = new Array();
                check.each(function(i){
                    id[i] = $(this).val();
                });
                console.log(id)
                $.ajax({
                    type:"post",
                    url:"<?php  echo $_W['siteroot'];?>/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=alldeleteinfo&m=zh_tcwq",
                    dataType:"text",
                    data:{id:id},
                    success:function(data){
                        console.log(data);      
                       location.reload();
                    }
                })               
            }
        });

        // ———————————————批量通过———————————————
        $("#allpass").on('click',function(){
            var check = $("input[type=checkbox][class!=allcheck]:checked");
            if(check.length < 1){
                alert('请选择要通过的帖子!');
                return false;
            }else if(confirm("确认要通过此帖子?")){
                var id = new Array();
                check.each(function(i){
                    id[i] = $(this).val();
                });
                console.log(id)
                $.ajax({
                    type:"post",
                    url:"<?php  echo $_W['siteroot'];?>/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=AdoptInfo&m=zh_tcwq",
                    dataType:"text",
                    data:{id:id},
                    success:function(data){
                        console.log(data);      
                       location.reload();
                    }
                })               
            }
        });


         // ———————————————批量刷新———————————————
        $("#allshuax").on('click',function(){
            var check = $("input[type=checkbox][class!=allcheck]:checked");
            if(check.length < 1){
                alert('请选择要刷新的帖子!');
                return false;
            }else if(confirm("确认要刷新此帖子?")){
                var id = new Array();
                check.each(function(i){
                    id[i] = $(this).val();
                });
                console.log(id)
                $.ajax({
                    type:"post",
                    url:"<?php  echo $_W['siteroot'];?>/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=Refresh&m=zh_tcwq",
                    dataType:"text",
                    data:{id:id},
                    success:function(data){
                        console.log(data);      
                       location.reload();
                    }
                })               
            }
        });

        // ———————————————批量拒绝———————————————
        $("#allrefuse").on('click',function(){
            var check = $("input[type=checkbox][class!=allcheck]:checked");
            if(check.length < 1){
                alert('请选择要拒绝的帖子!');
                return false;
            }else if(confirm("确认要拒绝此帖子?")){
                var id = new Array();
                check.each(function(i){
                    id[i] = $(this).val();
                });
                console.log(id)
                $.ajax({
                    type:"post",
                    url:"<?php  echo $_W['siteroot'];?>/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=RejectInfo&m=zh_tcwq",
                    dataType:"text",
                    data:{id:id},
                    success:function(data){
                        console.log(data);      
                       location.reload();
                    }
                })               
            }
        });

        $(".allcheck").on('click',function(){
            var checked = $(this).get(0).checked;
            $("input[type=checkbox]").prop("checked",checked);
        });
        
    })
</script>
