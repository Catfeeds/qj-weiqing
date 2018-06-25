<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<style type="text/css">
    .code-loading {
        height: 130px;
        width: 130px;
        line-height: 130px;
        text-align: center;
        display: block;
    }
    .code-input {
        width: 180px;
        border: 1px solid #eee;
        height: 26px;
        padding: 0 6px;
        background: #f4f4f4;
        border-radius: 2px;
    }
    .popover-content {
        padding: 5px !important;
    }
</style>

<div class="page-header">
    当前位置：
    <span class="text-primary">商品二维码</span>
</div>

<div class="page-content">
    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('app/_tab', TEMPLATE_INCLUDEPATH)) : (include template('app/_tab', TEMPLATE_INCLUDEPATH));?>

    <form action="./index.php">
        <input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="ewei_shopv2" />
        <input type="hidden" name="do" value="web" />
        <input type="hidden" name="r" value="app.goods" />

        <div class="page-toolbar">
            <?php if(cv('goods')) { ?>
            <div class="col-sm-4">
                <a class="btn btn-primary btn-sm" href="<?php  echo webUrl('goods')?>"><i class="fa fa-list"></i> 商品管理</a>
            </div>
            <?php  } ?>

            <div class="col-sm-5 pull-right">
                <div class="input-group">
                    <span class="input-group-select">
                        <select name="cate" class="form-control  input-sm select2" style="width:180px;">
                            <option value="" <?php  if(empty($_GPC['cate'])) { ?>selected<?php  } ?> >商品分类</option>
                            <?php  if(is_array($category)) { foreach($category as $c) { ?>
                                <option value="<?php  echo $c['id'];?>" <?php  if($_GPC['cate']==$c['id']) { ?>selected<?php  } ?> ><?php  echo $c['name'];?></option>
                            <?php  } } ?>
                        </select>
                    </span>
                    <input type="text" class="input-sm form-control" name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入商品名称关键字进行搜索">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"> 搜索</button>
                    </span>
                </div>
            </div>
        </div>
    </form>

    <?php  if(empty($list)) { ?>
        <div class="panel panel-default">
            <div class="panel-body empty-data">未查询到任何商品</div>
        </div>
    <?php  } else { ?>
        <table class="table table-responsive">
        <thead class="navbar-inner">
        <tr>
            <th>商品</th>
            <th style="width:200px;">价格</th>
            <th style="width:300px;">创建时间</th>
            <th style="width: 200px">操作(点击获取)</th>
        </tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
                <td>
                    <a <?php if(cv('goods.view|goods.edit')) { ?>href="<?php  echo webUrl('goods/edit', array('id'=>$row['id']))?>" target="_blank"<?php  } ?>>
                        <img src="<?php  echo $row['thumb'];?>" style="width:72px;height:72px;padding:1px;border:1px solid #efefef;margin: 7px 0" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'">
                        <span style="padding-left: 10px;"><?php  echo $row['title'];?></span>
                    </a>
                </td>
                <td>&yen;<?php  echo $row['marketprice'];?></td>
                <td><?php echo empty($row['createtime'])? '-': date('Y-m-d H:i:s', $row['createtime'])?></td>
                <td>
                    <a class="text-primary goods-code popo" href="javascript:;"
                       <?php  if($showcode) { ?>
                       data-id="<?php  echo $row['id'];?>"
                       data-placement="left"
                       data-toggle="popover"
                       data-trigger="click"
                       data-html="true"
                       data-content="<span class='code-loading'>loading</span>"<?php  } ?>>小程序码</a>
                    |
                    <a class="text-primary popo" href="javascript:;"
                       data-placement="left"
                       data-toggle="popover"
                       data-trigger="click"
                       data-html="true"
                       data-content="<input class='code-input' readonly value='/pages/goods/detail/index?id=<?php  echo $row['id'];?>'>">小程序路径</a>
                </td>
            </tr>
        <?php  } } ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4" style="text-align: right;"><?php  echo $pager;?></td>
        </tr>
        </tfoot>
    </table>
    <?php  } ?>
</div>

<script type="text/javascript">
    $(function () {
        <?php  if($showcode) { ?>

            $('.goods-code').on('shown.bs.popover	', function () {
                var _this = $(this);
                var elmid = _this.attr('aria-describedby');
                var gid = _this.data('id');
                var url = biz.url('app/goods/get_code', {id: gid});
                var loaded = _this.attr('loaded');
                if(loaded){
                    $('#'+elmid).find('.popover-content').html(loaded);
                    return;
                }
                $.get(url, function (e) {
                    if(e.status==0){
                        _this.attr('data-content', '加载失败<br>请刷新重试');
                        return;
                    }
                    var html = '<img src="'+ url+ '&img=1" width="130" height="130" />';
                    $('#'+elmid).find('.popover-content').html(html);
                    _this.attr('loaded', html)
                }, 'json')
                $('.goods-code').not(this).popover('hide');
            });

        <?php  } else { ?>

            $('.goods-code').click(function () {
                tip.msgbox.err('小程序审核发布后才可以获取商品码')
            });

        <?php  } ?>


        $('.popo').on('shown.bs.popover', function () {
            $('.popo').not(this).popover('hide');
        });

    });
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
<!--青岛易联互动网络科技有限公司-->