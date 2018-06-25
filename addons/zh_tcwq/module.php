<?php

/**

 * 志汇-同城微圈小程序模块定义

 *

 * @author 淘宝大众乐科技 https://shop504817250.taobao.com

 * @url 

 */

defined('IN_IA') or exit('Access Denied');



class Zh_tcwqModule extends WeModule {





	public function welcomeDisplay()

    {   
    	global $_GPC, $_W;

        $url = $this->createWebUrl('index');
        if ($_W['role'] == 'operator') {
        	$url = $this->createWebUrl('account');
        }

        Header("Location: " . $url);

    }

}