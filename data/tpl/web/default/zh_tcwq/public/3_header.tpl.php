<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header-base', TEMPLATE_INCLUDEPATH)) : (include template('public/header-base', TEMPLATE_INCLUDEPATH));?>
<!-- 同城 -->
<style>
	body{background-color: #F5F7F9;}
	.nav.nav-tabs{border-color:#20a0ff;}
	.nav-tabs>li>a:hover{border-color:#eee #eee #20a0ff #eee;}
	.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus{background-color:#20a0ff; border-color:#20a0ff;}
	.nav-tabs>li>a {border-radius: 0 0 0 0;}
	.nav{background-color: white;}
	.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
		color: #FFF;
		background-color: #20a0ff;
		border-color: #20a0ff;
	}
	.list-group-item.active, .list-group-item.active:hover, .list-group-item.active:focus{
		color: #24303C;
	}
	.list-group-item.active{
		background-color: #edf6ff;
		border:none;
		color: #00aeff;
	}
	.navbar-inverse {
		background-color: #fff;
		border-color: #20a0ff
	}
	.block {
		display: block;
	}
	.clear {
		display: block;
		overflow: hidden;
	}
	.navbar-nav > li > a {
		padding-top: 10px;
		padding-bottom: 10px;
		line-height: 40px
	}
	.navbar-inverse .navbar-nav>li>a:hover, .navbar-inverse .navbar-nav>li>a:focus{
		color: #777;
		background-color: #eee;
	}
	.big-menu{
		background-color: #24303C;
		padding-right: 0px;
		padding-left: 0px;
		padding-top: 10px;
		height: 95%;
		width: 150px;
		position: fixed;
		left: 0px;
		top: 50px;
		z-index: 88;
		overflow-y: scroll;
	}
	.navback{
		background-color: white;
		width: 110px;
		height: 100%;
		position: fixed;
		left: 150px;
		top: 50px;
		z-index: 80;
		color: #666;
		line-height: 50px;
		border-right: 1px solid #eee;
	}
	.therji{
		background-color: white;
		width: 109px;
		position: fixed;
		left: 150px;
		top: 50px;
		z-index: 89;
		color: #666;
		line-height: 50px;
		display: none;
	}
	.therji:nth-child(1){display: block;}
	.therji>li:nth-child(1){
		margin-top: 20px;
	}
	.big-menu .panel .list-group-item{
		border:none;overflow:hidden; white-space:normal; text-overflow:clip;
		font-size: 13px;		
		height: 50px;		
		padding: 0px 15px;
	}
	.panel>.list-group .list-group-item{padding-left: 34px;}
	.big-menu .panel .list-group-item:hover{
		background-color: #edf6ff;
		color:#00aeff;
	}
	.btn-primary {
		color: #fff;
		background-color: #0066cd;
		border-color: #0066cd;
	}
	.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active,
	.open > .dropdown-toggle.btn-primary {
		color: #fff;
		background-color: #0066cd;
		border-color: #0066cd;
	}
	.open{position: relative;}
	.big-menu .panel .panel-heading .panel-title{
		width: 100px;
		float: left;
		font-size: 14px;
	}
	.dropdown-menu{left:32px;}
	.big-menu .panel .panel-heading .panel-title .fa{font-size: 16px;}
	.navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.active>a:hover, .navbar-inverse
	.navbar-nav>.active>a:focus{
		color: #f60;
		background-color: #e7e7e7;
		border-bottom: 2px solid transparent;
		border-color: #f60;
	}
	button{outline: none;}
	.left{float: left;}
	.right{float: right;}
	a{text-decoration: none;}
	a:hover{text-decoration: none;}
	ul,li{list-style: none;}
	ul{margin-bottom: 0px;}
	body{font-size: 14px;font-family: "微软雅黑";}
	.clearfix{clear:both;}
	.header{
	    background-color: #fff;
	    color: #666;
	    height: 50px;
	    position: fixed;
	    top: 0px;
	    left: 0px;
	    z-index: 90;
	    width: 100%;
	    border-bottom:1px solid #eee;
	}
	.header_left{
	    height: 50px;
	    padding-top: 10px;
	    float: left;
	}
	.wheaderbox{
		color: #666;
		padding: 10px 5px 0px 20px;
		float: left;
	}
	.header_logo{
	    width: 34px;
	    height: 34px;
	    border-radius: 50%;
	    background-color: #009B4D;
	    margin-right: 10px;
	}
	.header_title{
	    font-size: 14px;
	    text-align: center;
	    margin-top: 15px;
	}
	.header_right{
	    height: 50px;
	    padding: 8px 0px;
	    float: right;
	    margin-right: 54px;
	    width: 400px;
	}
	.header_right>li>a:hover{color: #666;}
	.header_right>li{
	    float: left;
	    padding: 0px 20px;
	    border-right: 1px solid #eee;
	    line-height: 33px;
	}
	.ymargin{
		float: right;
		width: 30px;
		height: 30px;
		margin-top: 5px;
	}
	.yg_back{
		margin-left: 260px;
		margin-top: 50px;
	}
	.yyhome{font-size: 26px;position: relative;}
	.yyhome:hover .fanhuihome{display: block;}
	.fanhuihome{position: absolute;top: 40px;left: 0px;font-size: 14px;width: 100px;display: none;}
	.wyactive{background-color: #39485D;border-left: 3px solid #44ABF7;}
	.panel-default>.navtitle{background-color: #24303C;color: white;border:none;}
	.big-menu .panel .panel-heading .wytitle{height: 50px;padding: 15px 15px;width: 130px;}
	.navtitle{padding: 0px;}
	.panel,.panel-heading{border-radius: 0px;}
	.list-group-item:last-child,.list-group-item:first-child{border-radius: 0px;}
	.yg_login{height: auto;background-color: #24303C;padding: 10px 10px 15px;text-align: center;color: white;font-size: 14px;}
	.yg_login>img{margin: 0px auto;width: 60px;height: 60px;background-color: #5CB85C;border-radius: 50%;border: none;margin-bottom: 10px;}
	.header_btn{text-align: center;float: left;margin-left: 10px;width: 100px;border-right: 1px solid #fff;border-right: 1px solid #eee;height: 30px;line-height: 30px;}
	.wytitle:hover{color: white;}

	.fa-database,.fa-map-marker,.fa-book,.fa-bars,.fa-info-circle,.fa-cart-plus,.fa-desktop,.fa-product-hunt,.fa-life-ring,.fa-bars,.fa-recycle,.fa-cog,.fa-gift,.fa-binoculars,.fa-trophy,.fa-key,.fa-star-half-o{margin-right: 14px;}
	.fa-bell,.fa-user{margin-right: 15px;}
	.fa-compass{margin-right: 17px;}
	.fa-money,.fa-car,.fa-cubes{margin-right: 10px;}
	.fa-newspaper-o,.fa-book{margin-right: 12px;}
	.fa-comment-o{margin-right: 12px;}
	.fa-university{margin-right: 12px;}
	.fa-graduation-cap{margin-right: 5px;}
</style>

<?php  $res=pdo_get('zhtc_system',array('uniacid'=>$_W['uniacid']))?>
<div class="header">
    <div class="wheaderbox">
        <img class="header_logo" src="<?php  if($res['link_logo']) { ?><?php  echo tomedia($res['link_logo'])?><?php  } else { ?>../addons/zh_tcwq/template/images/bac.png<?php  } ?>" alt=""/>
    	<span class="header_title">
    		<?php  if($res['link_name']) { ?><?php  echo $res['link_name'];?><?php  } else { ?>智慧微圈同城管理系统<?php  } ?>
		</span>    	
    </div>
    <?php  if($_W['role'] == 'founder') { ?>
    <div class="header_left">
    	<a href="<?php  echo $this->createWebUrl('account')?>"><div class="header_btn">返回首页</div></a>
    </div>
    <?php  } ?>
    <ul class="header_right">
        <li>
			<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" style="display:block; max-width:185px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "><i class="fa fa-user"></i><?php  echo $_W['user']['username'];?> (<?php  if($_W['role'] == 'founder') { ?>系统管理员<?php  } else if($_W['role'] == 'manager') { ?>小程序管理员<?php  } else { ?>小程序操作员<?php  } ?>) <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<?php  if($_W['role'] != 'operator') { ?>
				<li><a href="<?php  echo url('user/profile/profile');?>" target="_blank"><i class="fa fa-weixin fa-fw"></i> 我的账号</a></li>
				<li class="divider"></li>
				<li><a href="<?php  echo url('home/welcome/system');?>" target="_blank"><i class="fa fa-sitemap fa-fw"></i> 系统选项</a></li>
				<li><a href="<?php  echo url('cloud/upgrade');?>" target="_blank"><i class="fa fa-cloud-download fa-fw"></i> 自动更新</a></li>
				<li><a href="<?php  echo url('system/updatecache');?>" target="_blank"><i class="fa fa-refresh fa-fw"></i> 更新缓存</a></li>
				<li class="divider"></li>
				<?php  } ?>
			</ul>
			<?php  if($_W['role'] == 'founder') { ?>
		</li>
        <li>
            <a href="index.php?c=wxapp&a=version&do=home&version_id=<?php  echo $_GPC['version_id'];?>" class="yyhome">
            	<span class="fa fa-home"></span>
            	<div class="fanhuihome">返回系统</div>
            </a>
        </li> 
        <?php  } ?>       
        <!-- <li>
            <img src="../addons/zh_tcwq/template/images/tongzhi.png" width="15px" height="18px" alt=""/>
        </li> -->
        <li>
            <a href="<?php  echo url('user/logout');?>" class="yyhome">
            	<span class="fa fa-power-off"></span>
            	<div class="fanhuihome">退出系统</div>
            </a>
        </li>
    </ul>
</div>
<div class="container-fluid col-md-12 col-xs-12 col-sm-12">
	<?php  if(defined('IN_MESSAGE')) { ?>
	<div class="jumbotron clearfix alert alert-<?php  echo $label;?>">
		<div class="row">
			<div class="col-xs-12 col-sm-3 col-lg-2">
				<i class="fa fa-5x fa-<?php  if($label=='success') { ?>check-circle<?php  } ?><?php  if($label=='danger') { ?>times-circle<?php  } ?><?php  if($label=='info') { ?>info-circle<?php  } ?><?php  if($label=='warning') { ?>exclamation-triangle<?php  } ?>"></i>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
				<?php  if(is_array($msg)) { ?>
				<h2>MYSQL 错误：</h2>
				<p><?php  echo cutstr($msg['sql'], 300, 1);?></p>
				<p><b><?php  echo $msg['error']['0'];?> <?php  echo $msg['error']['1'];?>：</b><?php  echo $msg['error']['2'];?></p>
				<?php  } else { ?>
				<h2><?php  echo $caption;?></h2>
				<p><?php  echo $msg;?></p>
				<?php  } ?>
				<?php  if($redirect) { ?>
				<p><a href="<?php  echo $redirect;?>">如果你的浏览器没有自动跳转，请点击此链接</a></p>
				<script type="text/javascript">
					setTimeout(function () {
						location.href = "<?php  echo $redirect;?>";
					}, 3000);
				</script>
				<?php  } else { ?>
				<p>[<a href="javascript:history.go(-1);">点击这里返回上一页</a>] &nbsp; [<a href="./?refresh">首页</a>]</p>
				<?php  } ?>
			</div>
			<?php  } else { ?>
			<div class="row yg_top">
				<?php $frames = empty($frames) ? $GLOBALS['frames'] : $frames; _calc_current_frames($frames);?>
				<?php  if(!empty($frames)) { ?>
				<div class="big-menu">
					<div class="navback"></div>
					<?php  if($cur_store) { ?>
					<div class="yg_login">
						<img src="<?php  echo tomedia($cur_store['md_logo'])?>">
						<div><?php  echo $cur_store['md_name'];?></div>
					</div>
					<!-- <div class="panel panel-default" style="padding-bottom: 10px;padding-top: 5px;">
						<span style="width:13.3333337%; height:160px;display: table-cell; line-height:160px; vertical-align:middle;text-align: center;padding-top: 5px;">
							<img style="display: inline-block;width: 160px;height: 160px;
box-sizing: border-box;margin-top:10px;padding: 10px;border: 1px solid #f2f2f2;box-sizing: border-box;max-width: 100%;" alt="image" src="<?php  echo tomedia($cur_store['md_logo'])?>" onerror="this.src='../addons/zh_tcwq/template/images/logo.png';"/>
						</span>
						<a href="#" >
							<span style="text-align:center;margin-top: 8px;" class="block m-t-xs"><strong class="font-bold"><?php  echo $cur_store['md_name'];?></strong></span>
							<span style="text-align:center;" class="text-muted text-xs block"><strong class="font-bold"><?php  echo $_W['user']['username'];?></strong>(<?php  if($_W['role'] == 'founder') { ?>系统管理员<?php  } else if($_W['role'] == 'manager') { ?>公众号管理员<?php  } else { ?>门店管理员<?php  } ?>)</span>
						</a>
					</div> -->
					<?php  } ?>
					<?php  if(is_array($frames)) { foreach($frames as $k => $frame) { ?>
					<div class="panel panel-default" style="border:none;margin-bottom: 0px;">
						<div class="panel-heading navtitle" style="cursor: pointer;height: 50px;">
							<?php  echo $frame['title'];?>
							<ul class="therji" id="frame-<?php  echo $k;?>">
								<?php  if(is_array($frame['items'])) { foreach($frame['items'] as $link) { ?>
								<?php  if(!empty($link['append'])) { ?>
								<li class="list-group-item<?php  echo $link['active'];?>" onclick="window.location.href = '<?php  echo $link['url'];?>';" style="cursor:pointer;" kw="<?php  echo $link['title'];?>">
									<?php  echo $link['title'];?>
									<a class="pull-right" href="<?php  echo $link['append']['url'];?>"><?php  echo $link['append']['title'];?></a>
								</li>
								<?php  } else { ?>
								<a class="list-group-item<?php  echo $link['active'];?>" href="<?php  echo $link['url'];?>" kw="<?php  echo $link['title'];?>" style="padding-left: 40px;"><?php  echo $link['title'];?></a>
								<?php  } ?>
								<?php  } } ?>
							</ul>
						</div>
					</div>
					<?php  } } ?>
					<script type="text/javascript">						
						require(['bootstrap'], function(){
							$('#search-menu input').keyup(function() {
								var a = $(this).val();
								$('.big-menu .list-group-item, .big-menu .panel-heading').hide();
								$('.big-menu .list-group-item').each(function() {
									$(this).css('border-left', '0');
									if(a.length > 0 && $(this).attr('kw').indexOf(a) >= 0) {
										$(this).parents(".panel").find('.panel-heading').show();
										$(this).show().css('border-left', '3px #428bca double');
									}
								});
								if(a.length == 0) {
									$('.big-menu .list-group-item, .big-menu .panel-heading').show();
								}
							});
						});
					</script>
				</div>

				<div class="col-lg-10 col-md-10 col-xs-10 col-sm-10 yg_back">
					<style>.topNav{border-bottom-color: rgb(0, 0, 0);border-bottom-width: 0.1em;border-bottom-style: inset;}</style>
					<?php  if(CRUMBS_NAV == 1) { ?>
					<?php  global $module_types;global $module;global $ptr_title;?>
					<?php $frames = empty($frames) ? $GLOBALS['frames'] : $frames; _calc_current_frames($frames);?>
					<script language='javascript'>
						$(function(){
							$(".breadcrumb").remove();
						})
					</script>
					<?php  } else if(CRUMBS_NAV == 2) { ?>
					<?php  global $module_types;global $module;global $ptr_title; global $site_urls; $m = $_GPC['m'];?>
					<ul class="nav nav-tabs">
						<li><a href="<?php  echo url('platform/reply', array('m' => $m));?>">管理<?php  echo $module['title'];?></a></li>
						<li><a href="<?php  echo url('platform/reply/post', array('m' => $m));?>"><i class="fa fa-plus"></i> 添加<?php  echo $module['title'];?></a></li>
						<?php  if(!empty($site_urls)) { ?>
						<?php  if(is_array($site_urls)) { foreach($site_urls as $site_url) { ?>
						<li <?php  if($_GPC['do'] == $site_url['do']) { ?> class="active"<?php  } ?>><a href="<?php  echo $site_url['url'];?>"> <?php  echo $site_url['title'];?></a></li>
						<?php  } } ?>
						<?php  } ?>
					</ul>
					<?php  } ?>
					<?php  } else { ?>
					<div>
					<?php  } ?>
					<?php  } ?>

