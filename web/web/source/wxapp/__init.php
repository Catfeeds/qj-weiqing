<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we8.club/ for more details.
 */
defined('IN_IA') or exit('Access Denied');

if (!in_array($action, array('display', 'post'))) {
	checkwxapp();
}

if (($action == 'version' && in_array($do, array('home', 'module_link_uniacid', 'front_download', 'module_entrance_link'))) || ($action == 'payment')) {
	define('FRAME', 'wxapp');
}
