<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>

<style type="text/css">
  .yg14{margin-top: 30px;}
  .addtabel1{margin-left: 20px;}
  .addtabel2{height: 34px;border: 1px solid #e5e5e5;}
  .quan1{background-color: #F8F8F8;padding: 15px;height: 85px;border-radius: 6px;margin-right: 20px;}
  .quan1:hover{background-color: #E8E8E8;}
  .quan1_img{
  	width: 55px;
  	height: 55px;
  	background-color: #FF6600;
  	border-radius: 6px;
  	font-size: 24px;
  	color: white;
  	line-height: 26px;
  	float: left;
  	overflow: hidden;
  }
  .quan1_img>img{width: 55px;height: 55px;}
  .quan_title{
  	border-left: 3px solid #44ABF7;
  	margin-bottom: 15px;
  	font-weight: bold;
  	font-size: 15px;
  }
  .quan1_text{margin-left: 10px;float: left;}
  .quan1_text>p:nth-child(1){font-size: 14px;font-weight: bold;}
  .quan1_text>p:nth-child(2){font-size: 12px;color: #999;}
  .quan_mar{margin-top: 20px;}
  a:hover{color: #333;}
  .quanyg{padding: 0px;margin-bottom: 20px;}
</style>

  <div class="panel panel-default yg14">

    	<div class="panel-heading">营销插件</div>

        <div class="panel-body">

			<form class="form-horizontal" action="" method="POST">
				
				<div class="col-md-12 quan_title">营销类</div>
				<div class="col-md-12">
					<a href="<?php  echo $this->createWebUrl('storerz')?>">
						<div class="col-md-3 quanyg">
							<div class="quan1">
								<div class="quan1_img">
									<img src="../addons/zh_tcwq/template/images/seller.png">
								</div>
								<div class="quan1_text">
									<p>商家入驻</p>
									<p>商家入驻</p>
								</div>
							</div>
						</div>
					</a>
					<a href="<?php  echo $this->createWebUrl('caropen')?>">
						<div class="col-md-3 quanyg">
							<div class="quan1">
								<div class="quan1_img">
									<img src="../addons/zh_tcwq/template/images/pc.png">
								</div>
								<div class="quan1_text">
									<p>拼车</p>
									<p>拼车</p>
								</div>
							</div>
						</div>
					</a>
					<a href="<?php  echo $this->createWebUrl('tzopen')?>">
						<div class="col-md-3 quanyg">
							<div class="quan1">
								<div class="quan1_img">
									<img src="../addons/zh_tcwq/template/images/tz.png">
								</div>
								<div class="quan1_text">
									<p>发帖子</p>
									<p>发帖子</p>
								</div>
							</div>
						</div>
					</a>
					<a href="<?php  echo $this->createWebUrl('hyopen')?>">
						<div class="col-md-3 quanyg">
							<div class="quan1">
								<div class="quan1_img">
									<img src="../addons/zh_tcwq/template/images/hy.png">
								</div>
								<div class="quan1_text">
									<p>黄页114</p>
									<p>黄页114</p>
								</div>
							</div>
						</div>
					</a>		
				</div>

				<div class="col-md-12 quan_title quan_mar">辅助类</div>
				<div class="col-md-12">
					<a href="<?php  echo $this->createWebUrl('hbopen')?>">
						<div class="col-md-3 quanyg">
							<div class="quan1">
								<div class="quan1_img">
									<img src="../addons/zh_tcwq/template/images/hb.png">
								</div>
								<div class="quan1_text">
									<p>红包福利</p>
									<p>红包福利</p>
								</div>
							</div>
						</div>
					</a>
					<a href="<?php  echo $this->createWebUrl('hhropen')?>">
						<div class="col-md-3 quanyg">
							<div class="quan1">
								<div class="quan1_img">
									<img src="../addons/zh_tcwq/template/images/hhr.png">
								</div>
								<div class="quan1_text">
									<p>加入合伙人</p>
									<p>加入合伙人</p>
								</div>
							</div>
						</div>
					</a>
					<a href="<?php  echo $this->createWebUrl('manycity')?>">
						<div class="col-md-3 quanyg">
							<div class="quan1">
								<div class="quan1_img">
									<img src="../addons/zh_tcwq/template/images/city.png">
								</div>
								<div class="quan1_text">
									<p>开通多城市</p>
									<p>开通多城市</p>
								</div>
							</div>
						</div>
					</a>
					<a href="<?php  echo $this->createWebUrl('jfsz')?>">
						<div class="col-md-3 quanyg">
							<div class="quan1">
								<div class="quan1_img">
									<img src="../addons/zh_tcwq/template/images/city.png">
								</div>
								<div class="quan1_text">
									<p>积分功能</p>
									<p>积分功能</p>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-12"><br/><br/><br/><br/><br/><br/></div>

			</form>

		</div>

	</div>
<script type="text/javascript">
    $(function(){
        $("#frame-9").show();
        $("#yframe-9").addClass("wyactive");
    })
</script>