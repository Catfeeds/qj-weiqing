<?php
//店铺管理
global $_GPC, $_W;
	$DBUtil = new DBUtil();
	$myfun =new MyFun();//$myfun->randombylength(8)
	$setting = $this->module['config'];//$setting['qq_map_key']
	//表名
	$tb='wys_tongcheng_store';
	$op=$_GPC['op'];
	$id=$_GPC['id'];
	$openid=$_GPC['openid'];
	$unionid=$_GPC['unionid'];
	$order='crtime desc';
	$page = max(1, $_GPC['page']);

	$errno = 0;
	$message = 'dosucc';
	$rpdata = array('doaction'=>$op);
	//操作方法
	if($op=='add' || $op=='edit'){
		//
		$data=array(
			'uniacid'=>$_W['uniacid'],
			'openid'=>$openid,
			'unionid'=>$unionid,
			's_name'=>$_GPC['s_name'],
			's_phoneperson'=>$_GPC['s_phoneperson'],
			's_phone'=>$_GPC['s_phone'],
			'ruzzhu_money'=>$setting['pay_money_ruzhu'],//入驻费用	
			'time_start'=>$_GPC['time_start'].'-'.$_GPC['time_end'],
			'rmk_store'=>$_GPC['rmk_store'],
			'rmk_goumai'=>$_GPC['rmk_goumai'],

			'loc_address'=>$_GPC['loc_address'],		
			'loc_lon'=>$_GPC['loc_lon'],
			'loc_lat'=>$_GPC['loc_lat'],
			'loc_nation'=>$_GPC['loc_nation'],
			'loc_province'=>$_GPC['loc_province'],
			'loc_city'=>$_GPC['loc_city'],
			'loc_district'=>$_GPC['loc_district'],
			'loc_city_code'=>$_GPC['loc_city_code'],
			'loc_nation_code'=>$_GPC['loc_nation_code'],

			'store_m_type'=>$_GPC['store_m_type'],
			'store_m_typeid'=>$_GPC['store_m_typeid'],
			'store_p_type'=>$_GPC['store_p_type'],
			'store_p_typeid'=>$_GPC['store_p_typeid'],
			'store_m_typeid_idx'=>$_GPC['store_m_typeid_idx'],
			'store_p_typeid_idx'=>$_GPC['store_p_typeid_idx'],

			'last_time'=>$myfun->doDate('year','+',1)

			);
		if($op=='add'){
			//检查用户是否存在帐户
			$use_det=$DBUtil->getOne('wys_tongcheng_user','u_openid=:u_openid',array(':u_openid'=>$openid));
			if(empty($use_det)){
				$integral_zs=$setting['integral_zs'];
				if(empty($integral_zs) ||$integral_zs==''){
					$integral_zs=0;
				}
				$p_inte=floatval($integral_zs);//赠送的积分
				$user=array(
					'uniacid'=>$_W['uniacid'],
					'u_nickname'=>$myfun->textEncode($_GPC['u_nickname']),
					'u_city'=>$_GPC['u_city'],
					'u_openid'=>$_GPC['u_openid'],
					'u_unionid'=>$_GPC['u_unionid'],
					'u_avatarurl'=>$_GPC['u_avatarurl'],
					'crtime'=>time(),
					'account'=>0,
					'integral'=>$p_inte,
					);
				if(!empty($user['u_openid'])){
				$DBUtil->save('wys_tongcheng_user',$user);
				}
			}


			$data['crtime']=time();
			$oncode=time().$myfun->randombylength(8);
			$data['oncode']=$oncode;
			$DBUtil->save($tb,$data);
			//返回
			$rpdata['oncode']=$oncode;			

		}else if($op=='edit'){			
			$rpdata['oncode']=$_GPC['oncode'];
			$store_info_det=$DBUtil->getOne($tb,'oncode=:oncode',array(':oncode'=>$_GPC['oncode']));
			if($store_info_det['enable']=='2'){
				$data['enable']='0';
			}
			$DBUtil->update($tb,$data,array('id'=>$id));
		}

	}else if($op=='get_one'){
		$rpdata=$DBUtil->getOne($tb,'oncode=:oncode',array(':oncode'=>$_GPC['oncode']));
		$rpdata['imgs_list_arr']=$this->getList_imsg_list($rpdata['imgs_list']);
		$time_yy=explode('-',$rpdata['time_start']);
		$rpdata['time_start']=$time_yy[0];
		$rpdata['time_end']=$time_yy[1];

	}else if($op=='get_one_view'){
		$rpdata=$DBUtil->getOne($tb,'oncode=:oncode',array(':oncode'=>$_GPC['oncode']));
		$rpdata['imgs_list_arr']=$this->getList_imsg_list($rpdata['imgs_list']);
		$goods_list=$DBUtil->getMany('wys_tongcheng_store_goods','s_id=:s_id  and enable=:enable',array(':s_id'=>$rpdata['id'],':enable'=>1));
		foreach ($goods_list as $key => &$it) {
			$it['img_store_mentou']=$this->getList_imsg_one($it['imgs_list']);//current(explode(',', $it['imgs_list']));
		}
		$rpdata['goods_list']=$goods_list;
		//店铺所有评论数
		$rpdata['cnt_comments']=$DBUtil->getCount('wys_tongcheng_store_comments','s_id=:s_id and pl_ctype=:pl_ctype',array(':s_id'=>$rpdata['id'],':pl_ctype'=>'main'));


		$cnt_comment_all=$DBUtil->getMany('wys_tongcheng_store_comments','s_id=:s_id and pl_ctype=:pl_ctype',array(':s_id'=>$rpdata['id'],':pl_ctype'=>'main'),'crtime desc');	

		$cnt_comment_all_five=$DBUtil->getMany('wys_tongcheng_store_comments','s_id=:s_id and pl_ctype=:pl_ctype',array(':s_id'=>$rpdata['id'],':pl_ctype'=>'main'),'crtime desc',1,5);	
		if($cnt_comment_all_five){
			foreach ($cnt_comment_all_five as $key_ct => &$ct) {
			$ct['imgs_list']=$this->getList_imsg_list($ct['imgs_list']);
			$ct['crtime']=$myfun->friendlyDate($ct['crtime'],'ym_time');
			$ct['comments_p']=$DBUtil->getMany('wys_tongcheng_store_comments','attr=:attr',array(':attr'=>$ct['id']));
			}
		}

		if($cnt_comment_all){

			$all_score=0;
		foreach ($cnt_comment_all as $key_ct => &$ct) {
			$ct['imgs_list']=$this->getList_imsg_list($ct['imgs_list']);
			$ct['score_m']=$this->getScore_m(floatval($ct['score']));
			$ct['score_p']=$this->getScore_p(floatval($ct['score']));
			$ct['crtime']=$myfun->friendlyDate($ct['crtime'],'ym_time');
			$all_score+=floatval($ct['score']);
			$ct['comments_p']=$DBUtil->getMany('wys_tongcheng_store_comments','attr=:attr',array(':attr'=>$ct['id']));

		}
		$rpdata['cnt_comment_all']=$cnt_comment_all_five;//$DBUtil->getMany('wys_tongcheng_store_comments','s_id=:s_id and pl_ctype=:pl_ctype',array(':s_id'=>$rpdata['id'],':pl_ctype'=>'main'),'crtime desc',1,5);
		$rpdata['score_all']=round(floatval($all_score/count($cnt_comment_all )),2);
		$rpdata['score_m']=$this->getScore_m(floatval($all_score/count($cnt_comment_all )));
		$rpdata['score_p']=$this->getScore_p(floatval($all_score/count($cnt_comment_all )));

		$DBUtil->update($tb,array('score'=>$rpdata['score_all'],'cnt_comment'=>count($cnt_comment_all)),array('id'=>$rpdata['id']));
		}else{
		$rpdata['cnt_comment_all']=0;
		$rpdata['score_all']=0;//floatval($all_score/count($cnt_comment_all ));
		$rpdata['score_m']=$this->getScore_m(5);
		$rpdata['score_p']='';//$this->getScore_p(floatval($all_score/count($cnt_comment_all )));
		}

		




		$cnt_look=$rpdata['cnt_look']+1;
		$DBUtil->update($tb,array('cnt_look'=>$cnt_look),array('id'=>$rpdata['id']));

	}else if($op=='list_my'){
		//根据用户ID 取店铺列表
		$rpdata=$DBUtil->getMany($tb,'openid=:openid',array(':openid'=>$openid),$order);
	}else if($op=='list_store'){
		//所有店铺
		$list=$DBUtil->getMany($tb,'openid=:openid',array(':openid'=>$openid),$order);
		$main_arr=array();
		$main_arr_id=array();
		foreach ($list as $key => $it) {
		array_push($main_arr, $it['s_name']);
		array_push($main_arr_id, $it['id']);
		}
	$rpdata['main_arr']=$main_arr;
	$rpdata['main_arr_id']=$main_arr_id;
	$rpdata['goods_imgs_cnt']=$setting['goods_imgs_cnt'];


	}else if($op=='list_store_show'){
		//所有店铺 前台显示
		$lon=$_GPC['lon'];
		$lat=$_GPC['lat'];

		$m_type_id=$_GPC['m_type_id'];
		$m_type_txt=$_GPC['m_type_txt'];
		$p_type_id=$_GPC['p_type_id'];
		$p_type_txt=$_GPC['p_type_txt'];
		$s_order=$_GPC['s_order'];

		$sql='uniacid=:uniacid';
		$sql_param=array(':uniacid'=>$_W['uniacid']);
		//审核状态
		$sql.=' and enable=:enable';
		$sql_param[':enable']=1;

		if($m_type_id!=0){
			$sql.=' and store_m_type like :store_m_type';
			$sql_param[':store_m_type']='%'.$m_type_txt.'%';
		}

		if($p_type_id!=0){
			$sql.=' and store_p_type like :store_p_type';
			$sql_param[':store_p_type']='%'.$p_type_txt.'%';
		}

		if(empty($s_order)){
			if(!empty($lon) && !empty($lat)){
				//is_placed_top desc,
			$order= ' SQRT(('.$lon.'-`loc_lon`)*('.$lon.'-`loc_lon`)+('.$lat.'-`loc_lat`)*('.$lat.'-`loc_lat`))  asc';
			}
		}else{

			if($s_order=='距离最近'){
				if(!empty($lon) && !empty($lat)){
				$order= ' SQRT(('.$lon.'-`loc_lon`)*('.$lon.'-`loc_lon`)+('.$lat.'-`loc_lat`)*('.$lat.'-`loc_lat`))  asc';
				}
			}else if($s_order=='最新入驻'){
				$order= ' crtime desc';
			}else if($s_order=='评分最高'){				
				$order= ' score desc';
			}else if($s_order=='人气最高'){				
				$order= ' cnt_look+0 desc';
			}

		}

		$rpdata=$DBUtil->getMany($tb,$sql,$sql_param,$order,$page,10);
		foreach ($rpdata as $key => &$value) {
			if($lon!=''){
			$value['loc_juli']=$myfun->getDistance(floatval($lon),floatval($lat),floatval($value['loc_lon']),floatval($value['loc_lat']),2,2);	
			}
			
			$value['score_m']=$this->getScore_m(floatval($value['score']));
			$value['score_p']=$this->getScore_p(floatval($value['score']));
		}


	// $order_ngoddsid=$DBUtil->getMany('wys_tongcheng_store_order',"goods_id=''",array());
	
	// foreach ($order_ngoddsid as $key_od => $od) {
	// 	$oinfo=$DBUtil->getOne('wys_tongcheng_store_order_info','oncode=:oncode',array(':oncode'=>$od['oncode']));
	// 	if(!empty($oinfo)){
	// 	$DBUtil->update('wys_tongcheng_store_order',array('goods_id'=>$oinfo['goods_id']),array('oncode'=>$od['oncode']));
	// 	}

	// }

	}else if($op=='del_img_list'){
	//删除商品其中一个图片信息
	$goods_det=$DBUtil->getOne($tb,'uniacid=:uniacid and oncode=:oncode',array(':uniacid'=>$_W['uniacid'],':oncode'=>$_GPC['oncode']));
	$del_img=$_GPC['del_img'];

	$imgs=explode(',', $goods_det['imgs_list']);	
	$img_upurlList=array();
	$is_have=false;
	foreach ($imgs as $key => $it) {
		if(!empty($it)){
			if($it==$del_img){
				$is_have=true;
				$temp_mg1=str_replace($_W['attachurl'],'',$del_img);
				if(file_exists(ATTACHMENT_ROOT.$temp_mg1)){unlink(ATTACHMENT_ROOT.$temp_mg1);}			
			}else{
				
				array_push($img_upurlList,$it);
				
			}
		}		
	}
	//$rpdata['del_img']=$del_img;
	$rpdata['is_have']=$is_have;
	//$rpdata['goods_det']=$goods_det;

	$DBUtil->update($tb,array('imgs_list'=>implode(',', $img_upurlList)),array('uniacid'=>$_W['uniacid'],'oncode'=>$_GPC['oncode']));


	}else if($op=='check_store'){
		//检查店铺
		//审核驳回 店铺到期



	}



	//返回信息
	return $this->result($errno, $message, $rpdata);
?>