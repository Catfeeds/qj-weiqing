<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/zh_tcwq/template/public/ygcsslist.css">
<ul class="nav nav-tabs">
    <span class="ygxian"></span>
    <div class="ygdangq">当前位置:</div>    
    <li class="active"><a href="<?php  echo $this->createWebUrl('videotype')?>">分类管理</a></li>
    <li><a href="<?php  echo $this->createWebUrl('addvideotype')?>">添加分类</a></li>
</ul>
<div class="main">
  <!--   <div class="panel panel-default">
      <div class="panel-body ygbtn">
          <div class="btn ygshouqian2" id="allselect">批量删除</div>
          <div class="btn ygyouhui2" id="allpass">批量启用</div>
          <div class="btn storegrey2" id="allrefuse">批量禁用</div>
      </div> -->
        
    </div>
    <!-- 门店列表部分开始 -->
        <div class="panel panel-default">
            <div class="panel-heading">
                信息分类管理
            </div>
            <div class="panel-body" style="padding: 0px 15px;">
                <div class="row">
                    <table class="yg5_tabel col-md-12">
                        <tr class="yg5_tr1">
                            <!-- <td class="store_td1 col-md-1" style="text-align: center;">
                              <input type="checkbox" class="allcheck" />
                              <span class="store_inp">全选</span>                      
                            </td> -->
                            <td class="store_td1 col-md-1">顺序</td>
                            <td class="col-md-2">图标</td>
                            <td class="col-md-2">信息分类名称</td>
                           
                            <td class="col-md-2">状态</td>
                            <td class="col-md-2">操作</td>
                        </tr>
                        <?php  if(is_array($list)) { foreach($list as $row) { ?>
                        <tr class="yg5_tr2">
                            <!-- <td>
                              <input type="checkbox" name="test" value="<?php  echo $row['id'];?>">
                            </td> -->
                            <td class="num<?php  echo $row['id'];?>">
                            	<span class="numspan<?php  echo $row['id'];?>"><?php  echo $row['num'];?></span>
                        		<input style="display: none;width: 100%;" type="number" name="num<?php  echo $row['id'];?>" class="numinp<?php  echo $row['id'];?>" value="<?php  echo $row['num'];?>" />
                            
                            </td>
                            <td>
                                <img class="store_list_img" src="<?php  echo tomedia($row['img']);?>" alt=""/>
                            </td>
                            <td><?php  echo $row['type_name'];?></td>
                            <td><?php  if($row['state']==1) { ?> <span class="label storeblue">  <a href="<?php  echo $this->createWebUrl('videotype', array('id' => $row['id'],'op'=>change,'state'=>2))?>"   >启用</a></span><?php  } else if($row['state']==2) { ?> <span class="label storegrey"><a href="<?php  echo $this->createWebUrl('videotype', array('id' => $row['id'],'op'=>change,'state'=>1))?>">禁用</a></span><?php  } ?></td>
                            <td>
                                <a href="<?php  echo $this->createWebUrl('addvideotype', array('id' => $row['id']))?>" class="storespan btn btn-xs">
                                    <span class="fa fa-pencil"></span>
                                    <span class="bianji">编辑
                                        <span class="arrowdown"></span>
                                    </span>                            
                                </a>
                                <a href="javascript:void(0);" class="storespan btn btn-xs" data-toggle="modal" data-target="#myModal<?php  echo $row['id'];?>">
                                    <span class="fa fa-trash-o"></span>
                                    <span class="bianji">删除
                                        <span class="arrowdown"></span>
                                    </span>
                                </a>
                            <!-- <a class="btn btn-warning btn-xs" href="<?php  echo $this->createWebUrl('addtype', array('id' => $row['id']))?>" title="编辑">改</a>&nbsp;&nbsp;
                           <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php  echo $row['id'];?>">删</button> -->
                            </td>
                        </tr>
                         <div class="modal fade" id="myModal<?php  echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                            <a href="<?php  echo $this->createWebUrl('videotype', array('id' => $row['id'],'op'=>'delete'))?>" type="button" class="btn btn-info" >确定</a>
                        </div>
                    </div>
                </div>
            </div>
                        <?php  } } ?>
                       
                    </table>
                </div>
            </div>
        </div>
    <?php  echo $pager;?>
</div>
<script type="text/javascript">
    $(function(){
        $("#frame-18").show();
        $("#yframe-18").addClass("wyactive");

        // ———————————————批量删除———————————————
        $("#allselect").on('click',function(){
            var check = $("input[type=checkbox][class!=allcheck]:checked");
            if(check.length < 1){
                alert('请选择要删除的分类!');
                return false;
            }else if(confirm("确认要删除此分类?")){
                var id = new Array();
                check.each(function(i){
                    id[i] = $(this).val();
                });
                console.log(id)
                $.ajax({
                    type:"post",
                    url:"<?php  echo $_W['siteroot'];?>/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=DeleteType&m=zh_tcwq",
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
                alert('请选择要启用的分类!');
                return false;
            }else if(confirm("确认要启用此分类?")){
                var id = new Array();
                check.each(function(i){
                    id[i] = $(this).val();
                });
                console.log(id)
                $.ajax({
                    type:"post",
                    url:"<?php  echo $_W['siteroot'];?>/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=QyType&m=zh_tcwq",
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
                alert('请选择要禁用的分类!');
                return false;
            }else if(confirm("确认要禁用此分类?")){
                var id = new Array();
                check.each(function(i){
                    id[i] = $(this).val();
                });                
                console.log(id)
                $.ajax({
                    type:"post",
                    url:"<?php  echo $_W['siteroot'];?>/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=JyType&m=zh_tcwq",
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