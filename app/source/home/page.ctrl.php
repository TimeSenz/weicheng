<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.goupu.org/ for more details.
 */
defined('IN_IA') or exit('Access Denied');
$dos = array('getnum', 'addnum', 'index');
$do = in_array($do, $dos) ? $do : 'index';
$id = intval($_GPC['id']);
if($do == 'getnum'){
	$goodnum = pdo_get('site_page', array('id' => $id), array('goodnum'));
	message(error('0', array('goodnum' => $goodnum['goodnum'])), '', 'ajax');
} elseif($do == 'addnum'){
	if(!isset($_GPC['__havegood'])) {
		$goodnum = pdo_get('site_page', array('id' => $id), array('goodnum'));
		if(!empty($goodnum)){
			$updatesql = pdo_update('site_page', array('goodnum' => $goodnum['goodnum'] + 1), array('id' => $id));
			if(!empty($updatesql)) {
				isetcookie('__havegood', 1, 86400);
				message(error('0', ''), '', 'ajax');
			}else { 
				message(error('1', ''), '', 'ajax');
			}
		}		
	}
} else {
	template_page($id);
}
