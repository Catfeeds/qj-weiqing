<?php
global $_GPC, $_W;
// $action = 'ad';
// $title = $this->actions_titles[$action];
$GLOBALS['frames'] = $this->getMainMenu2();
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
    //获取商家总金额
 //订单销售金额
$sql5=" select  sum(a.money) as ordermoney from (select  a.id,a.money,FROM_UNIXTIME(a.time) as time  from".tablename('zhtc_order'). " a"  . " left join " . tablename("zhtc_store") . " b on a.store_id=b.id  where a.uniacid={$_W['uniacid']} and a.state in (2,3,4,5,7) and b.cityname='{$_COOKIE['cityname']}') a   ";
$ordermoney=pdo_fetch($sql5);
//商家入驻的钱
$sql6="select sum(a.money) as storemoney from".tablename('zhtc_storepaylog'). " a"  . " left join " . tablename("zhtc_store") . " b on a.store_id=b.id where a.uniacid={$_W['uniacid']} and b.cityname='{$_COOKIE['cityname']}'  ";
$storemoney=pdo_fetch($sql6);  
//帖子入驻加置顶
$sql7=" select sum(a.money) as tzmoney from".tablename('zhtc_tzpaylog'). " a"  . " left join " . tablename("zhtc_information") . " b on a.tz_id=b.id  where a.uniacid={$_W['uniacid']} and b.cityname='{$_COOKIE['cityname']}'  ";
$tzmoney=pdo_fetch($sql7); 
//拼车发布的钱
$sql8=" select sum(a.money) as pcmoney from".tablename('zhtc_carpaylog'). " a"  . " left join " . tablename("zhtc_car") . " b on a.car_id=b.id  where a.uniacid={$_W['uniacid']} and b.cityname='{$_COOKIE['cityname']}'";
$pcmoney=pdo_fetch($sql8); 
//114入驻的钱
$sql9=" select sum(a.money) as hymoney from".tablename('zhtc_yellowpaylog'). " a"  . " left join " . tablename("zhtc_yellowstore") . " b on a.hy_id=b.id  where a.uniacid={$_W['uniacid']} and b.cityname='{$_COOKIE['cityname']}' ";
$hymoney=pdo_fetch($sql9); 

//活动的钱
$sql10=" select sum(a.money) as actmoney from".tablename('zhtc_joinlist'). " a"  . " left join " . tablename("zhtc_activity") . " b on a.act_id=b.id  where a.uniacid={$_W['uniacid']} and b.cityname='{$_COOKIE['cityname']}' ";
$actmoney=pdo_fetch($sql10); 
//总金额
$bytmoney=$ordermoney['ordermoney']+$storemoney['storemoney']+$tzmoney['tzmoney']+$pcmoney['pcmoney']+$hymoney['hymoney']+$actmoney['actmoney'];
//本月可获得佣金
$yjtype=pdo_get('zhtc_yjset',array('uniacid'=>$_W['uniacid']));
if($yjtype['type']==1){
  $kdyj=$bytmoney*$yjtype['typer']/100;
}
if($yjtype['type']==2){
  $kdyj=(($ordermoney['ordermoney']+$storemoney['storemoney'])*$yjtype['sjper']+$tzmoney['tzmoney']*$yjtype['tzper']+$pcmoney['pcmoney']*$yjtype['pcper']+$hymoney['hymoney']*$yjtype['pcper'])/100;
}
$kdyj=number_format($kdyj, 2);

   //商户已提现金额
   $ytxcost=pdo_get('zhtc_yjtx', array('account_id'=>$_COOKIE['account_id'],'status'=>2), array('sum(tx_cost) as ytxcost'));
   //商户申请提现金额
  $stxcost=pdo_get('zhtc_yjtx', array('account_id'=>$_COOKIE['account_id'],'status'=>1), array('sum(tx_cost) as stxcost'));
   //可提现金额
   $ktxcost= $kdyj-$ytxcost['ytxcost']-$stxcost['stxcost'];
    if(checksubmit('submit')){
      if(empty($_GPC['tx_cost'])){
        message('提现金额不能为空','','error');
      }
    
      if($_GPC['tx_cost']> $ktxcost){
        message('输入金额大于可提现金额','','error');
      }
        $data['tx_type']=$_GPC['tx_type'];
        $data['tx_cost']=$_GPC['tx_cost'];
        $data['sj_cost']=$_GPC['tx_cost']-($_GPC['tx_cost']* $tx_info['tx_sxf']);
        //$data['sx_cost']=($_GPC['tx_cost']* $tx_info['tx_sxf']);
        $data['account']=$_GPC['account'];
        $data['name']=$_GPC['name'];
        $data['status']=1;
        $data['cerated_time']=date('Y-m-d H:i:s');
        $data['uniacid']=$_W['uniacid'];
        $data['account_id']=$_COOKIE['account_id'];      
        $res=pdo_insert('zhtc_yjtx',$data);
        if($res){
            message('添加成功',$this->createWebUrl('txdetails',array()),'success');
        }else{
            message('添加失败','','error');
        }
    }          


include $this->template('web/txapply');