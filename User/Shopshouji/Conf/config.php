﻿<?php
return array(
'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'v3', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'root', // 密码
'DB_PORT'   => 3306, // 端口
'DB_PREFIX' => 'ot_', // 数据库表前缀 
'DB_CHARSET'=> 'utf8', // 字符集
'DEFAULT_THEME'    =>    'default',// 设置默认的模板主题
//'SHOW_PAGE_TRACE'=>true,
'SHOW_ERROR_MSG' =>  false,
'TOKEN_ON'      =>    false,
'DEFAULT_FILTER' => 'strip_tags,htmlspecialchars',
'URL_MODEL'          => '2',
'LANG_SWITCH_ON' => true,
//'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
'DEFAULT_LANG' => 'zh-tw',
//'LANG_LIST'        => 'zh-tw', // 允许切换的语言列表 用逗号分隔
'VAR_LANGUAGE'     => 'l', // 默认语言切换变量
//'LAYOUT_ON'=>true,

// added by skyrim
// purpose: password retrieval
// version: v1.0
// -========= 邮箱配置 =========-
'mail_setting'     => array(
	// SMTP 服务器地址
	'smtp_server' => 'smtp.163.com',
	// SMTP 服务器端口
	'smtp_server_port' => 25,
	// SMTP 用户名
	'smtp_user' => 'wy160104@163.com',
	// SMTP 密码
	'smtp_pass' => 'nnowwxdgdcrkctxg',
	// 邮件发送人
	'mail_from' => 'wy160104@163.com',
),
// -============================-
// added ends

);