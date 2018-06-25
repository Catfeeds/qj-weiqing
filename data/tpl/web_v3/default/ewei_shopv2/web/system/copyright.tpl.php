<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
    当前位置：<span class="text-primary">手机端底部版权</span>
</div>

    <div class="page-content">
        <form id="dataform" action="" method="post" class="form-horizontal form-validate">

            <div class="form-group">
                <label class="col-lg control-label">选择公众号</label>
                <div class="col-sm-9">
                    <select id='wechatid' name='wechatid' class='form-control select2' onchange="location.href= '<?php  echo webUrl('system/copyright')?>&wechatid=' + $(this).val()" >
                        <option value=''></option>
                        <?php  if(is_array($wechats)) { foreach($wechats as $we) { ?>
                        <option value='<?php  echo $we['uniacid'];?>' <?php  if($_GPC['wechatid']==$we['uniacid']) { ?>selected<?php  } ?>><?php  echo $we['name'] ?></option>
                        <?php  } } ?>
                        <option value='-1' <?php  if($_GPC['wechatid']==-1 || empty($_GPC['wechatid'])) { ?>selected<?php  } ?>>全部公众号</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg control-label">背景颜色</label>
                <div class="col-sm-9">
                    <?php  echo tpl_form_field_color('bgcolor',$copyrights['bgcolor'])?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg control-label">底部版权</label>
                <div class="col-sm-9">
                    <?php  echo tpl_ueditor('copyright',$copyrights['copyright'])?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg control-label"></label>
                <div class="col-sm-9">
                    <input id="btn_submit" type="submit" value="保存" class="btn btn-primary"/>

                </div>
            </div>



        </form>
    </div>

 

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>

<!--6Z2S5bKb5piT6IGU5LqS5Yqo572R57uc56eR5oqA5pyJ6ZmQ5YWs5Y+454mI5p2D5omA5pyJ-->