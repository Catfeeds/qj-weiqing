<?php
	//店铺管理 所有分类
	global $_GPC, $_W;
	$DBUtil = new DBUtil();
	$myfun =new MyFun();//$myfun->randombylength(8)
	$setting = $this->module['config'];//$setting['qq_map_key']
	//表名
	$tb='wys_tongcheng_store_mtype';
	$op=$_GPC['op'];
	$id=$_GPC['id'];
	$openid=$_GPC['openid'];
	$unionid=$_GPC['unionid'];

	$order='pxh asc';
	$errno = 0;
	$message = 'dosucc';
	$data = array('doaction'=>$op);
	if($op=='list'){
	$list_all=$DBUtil->getMany($tb,'uniacid=:uniacid and enable=:enable and attr=:attr and is_parent_open=:is_parent_open',array(':uniacid'=>$_W['uniacid'],':enable'=>1,':attr'=>0,':is_parent_open'=>1),$order);
	$main_arr=array();
	$main_arr_id=array();
	$main_parr_all=array();	
	$main_parr_all_id=array();
	$main_parr_all_isopen_yyzz=array();
	foreach ($list_all as $key_all => &$it) {
		array_push($main_arr, $it['tname']);
		array_push($main_arr_id, $it['id']);
		$p_list=$DBUtil->getMany($tb,'uniacid=:uniacid and enable=:enable and attr=:attr',array(':uniacid'=>$_W['uniacid'],':enable'=>1,':attr'=>$it['id']),$order);
		$main_parr=array();
		$main_parr_id=array();
		$main_parr_isopen_yyzz=array();
		foreach ($p_list as $key_p => $pit) {
			array_push($main_parr, $pit['tname']);
			array_push($main_parr_id, $pit['id']);
			array_push($main_parr_isopen_yyzz, $pit['isopen_yyzz']);
		}
		array_push($main_parr_all, $main_parr);
		array_push($main_parr_all_id, $main_parr_id);
		array_push($main_parr_all_isopen_yyzz, $main_parr_isopen_yyzz);
	}
	$data['main_arr']=$main_arr;
	$data['main_parr_all']=$main_parr_all;
	$data['main_arr_id']=$main_arr_id;
	$data['main_parr_all_id']=$main_parr_all_id;
	$data['main_parr_all_isopen_yyzz']=$main_parr_all_isopen_yyzz;
	$data['pay_money_ruzhu']=$setting['pay_money_ruzhu'];
	$data['last_time_str']=date('Y年m月d日',$myfun->doDate('year','+',1));
	$data['store_imgs_cnt']=$setting['store_imgs_cnt'];
	//load()->func('communication');
	// $cachekey = "accesstoken:{$this->account['key']}";
	// $cache = cache_load($cachekey);
	// $record['token'] ='ccc';
	// // $this->account['access_token'] = $record;
	// // cache_write($cachekey, $record);
	//$data['token']=$myfun->getAccessToken($_W['account']['key'],$_W['account']['secret']);
	}else if($op=='list_select'){
	$list_all=$DBUtil->getMany($tb,'uniacid=:uniacid and enable=:enable and attr=:attr and is_parent_open=:is_parent_open',array(':uniacid'=>$_W['uniacid'],':enable'=>1,':attr'=>0,':is_parent_open'=>1),$order);
	$main_arr=array();
	$main_arr_id=array();
	$main_parr_all=array();	
	$main_parr_all_id=array();
	$main_parr_all_isopen_yyzz=array();

	array_push($main_arr,'全部品类');
	array_push($main_arr_id,0);
	foreach ($list_all as $key_all => &$it) {
		array_push($main_arr, $it['tname']);
		array_push($main_arr_id, $it['id']);
		$p_list=$DBUtil->getMany($tb,'uniacid=:uniacid and enable=:enable and attr=:attr',array(':uniacid'=>$_W['uniacid'],':enable'=>1,':attr'=>$it['id']),$order);
		$main_parr=array();
		$main_parr_id=array();
		$main_parr_isopen_yyzz=array();
		array_push($main_parr,'所有子品类');
		array_push($main_parr_id,'0');
		foreach ($p_list as $key_p => $pit) {
			array_push($main_parr, $pit['tname']);
			array_push($main_parr_id, $pit['id']);
			array_push($main_parr_isopen_yyzz, $pit['isopen_yyzz']);
		}
		array_push($main_parr_all, $main_parr);
		array_push($main_parr_all_id, $main_parr_id);
		array_push($main_parr_all_isopen_yyzz, $main_parr_isopen_yyzz);
	}
	$data['main_arr']=$main_arr;
	$data['main_parr_all']=$main_parr_all;
	$data['main_arr_id']=$main_arr_id;
	$data['main_parr_all_id']=$main_parr_all_id;	
	}


	//返回信息
	return $this->result($errno, $message, $data);
?>