<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/sncss/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="/sncss/js/jquery.js"></script>

<script type="text/javascript">
$(function(){	
	//导航切换
	$(".menuson li").click(function(){
		$(".menuson li.active").removeClass("active")
		$(this).addClass("active");
	});
	
	$('.title').click(function(){
		var $ul = $(this).next('ul');
		$('dd').find('ul').slideUp();
		if($ul.is(':visible')){
			$(this).next('ul').slideUp();
		}else{
			$(this).next('ul').slideDown();
		}
	});
})	
</script>


</head>

<body style="background:#f0f9fd;">
	<div class="lefttop"><span></span>功能欄</div>
    
    <dl class="leftmenu">
        
    <dd>
    <div class="title">
    <span><img src="/sncss/images/leftico01.png" /></span>会员管理
    </div>
    	<ul class="menuson">
        <li><cite></cite><a href="/admdgjmin.php/home/index/userlist" target="rightFrame">所有会员</a><i></i></li>
       <li><cite></cite><a href="/admdgjmin.php/home/index/counts" target="rightFrame">信息统计</a><i></i></li>
       <!-- <li><cite></cite><a href="/admdgjmin.php/home/index/bigz" target="rightFrame">大转盘记录</a><i></i></li> -->
        <li><cite></cite><a href="/admdgjmin.php/home/index/jbzs" target="rightFrame">积分赠送</a><i></i></li>
        <!-- <li><cite></cite><a href="/admdgjmin.php/home/index/djye" target="rightFrame">冻结余额</a><i></i></li> -->

        <li><cite></cite><a href="/admdgjmin.php/home/index/team" target="rightFrame">会员关系图</a><i></i></li>
		
        </ul>    
    </dd>
        
    
<!--     <dd>
<div class="title">
<span><img src="/sncss/images/leftico02.png" /></span>商城管理
</div>
<ul class="menuson">
    <li><cite></cite><a href="#">新增产品</a><i></i></li>
    <li><cite></cite><a href="#">修改产品</a><i></i></li>
		<li><cite></cite><a href="#">新增产品分类</a><i></i></li>
		<li><cite></cite><a href="#">修改产品分类</a><i></i></li>
		<li><cite></cite><a href="#">产品列表5</a><i></i></li>
    </ul>     
</dd>  -->
    <dd><div class="title"><span><img src="/sncss/images/leftico03.png" /></span>文章管理</div>
    <ul class="menuson">

		<li><cite></cite><a href="/admdgjmin.php/Home/Shop/zsbyg_list" target="rightFrame">新闻公告</a><i></i></li>
		<li><cite></cite><a href="/admdgjmin.php/Home/Shop/zsbyg_list_xg" target="rightFrame">添加内容</a><i></i></li>
    </ul>    
    </dd>  
    
	
	 <dd><div class="title"><span><img src="/sncss/images/leftico03.png" /></span>留言管理</div>
    <ul class="menuson">

		<li><cite></cite><a href="/admdgjmin.php/Home/Shop/ly_list/type/0/" target="rightFrame">未处理留言</a><i></i></li>
		<li><cite></cite><a href="/admdgjmin.php/Home/Shop/ly_list/type/1/" target="rightFrame">已处理留言</a><i></i></li>
    </ul>    
    </dd>  
    
  <dd><div class="title"><span><img src="/sncss/images/leftico04.png" /></span>激活码管理</div>
    <ul class="menuson">
        <li><cite></cite><a href="/admdgjmin.php/home/index/pin_add" target="rightFrame">生成激活码</a><i></i></li>
		<li><cite></cite><a href="/admdgjmin.php/home/index/pin_list" target="rightFrame">PIN管理</a><i></i></li>
    </ul>
    
    </dd>
	
	
	
	
	
	
	  <dd><div class="title"><span><img src="/sncss/images/leftico04.png" /></span>匹配系统</div>
    <ul class="menuson">
        <li><cite></cite><a href="/admdgjmin.php/home/index/tgbz_list" target="rightFrame">提供帮助</a><i></i></li>
		<li><cite></cite><a href="/admdgjmin.php/home/index/jsbz_list" target="rightFrame">接受帮助</a><i></i></li>
		<li><cite></cite><a href="/admdgjmin.php/home/index/ppdd_list" target="rightFrame">交易中的订单</a><i></i></li>
		<li><cite></cite><a href="/admdgjmin.php/home/index/ppdd_list/cz/1/" target="rightFrame">成功交易订单</a><i></i></li>
		<li><cite></cite><a href="/admdgjmin.php/home/index/ts1_list" target="rightFrame">超时未打款</a><i></i></li>
		<li><cite></cite><a href="/admdgjmin.php/home/index/ts3_list" target="rightFrame">未收到款</a><i></i></li>
			 <li><cite></cite><a href="/admdgjmin.php/home/index/tgbz_list_cf" target="rightFrame">提供拆分</a><i></i></li>
		<li><cite></cite><a href="/admdgjmin.php/home/index/jsbz_list_cf" target="rightFrame">接受拆分</a><i></i></li>
		<li><cite></cite><a href="/admdgjmin.php/home/index/pdb" target="rightFrame">入场券</a><i></i></li>
		<!-- added by skyrim -->
		<!-- purpose: custom settings -->
		<!-- version: 4.0 -->
		<li><cite></cite><a href="/admdgjmin.php/home/index/onekey_match" target="rightFrame">自动匹配管理</a><i></i></li>
		<li><cite></cite><a href="/admdgjmin.php/home/index/settings" target="rightFrame">分成管理</a><i></i></li>
		
		<!-- added ends -->
		<!-- added by skyrim -->
		<!-- purpose: custom inqueue-share waiting-for-deposit-share -->
		<!-- version: 5.0 -->
		<!--<li><cite></cite><a href="/admdgjmin.php/home/index/pre_deposit" target="rightFrame">收款前利息管理</a><i></i></li>-->
		<!-- added ends -->

		<!--<li><cite></cite><a href="/admdgjmin.php/home/index/pin_list" target="rightFrame">PIN管理</a><i></i></li>-->
		<!--<li><cite></cite><a href="/admdgjmin.php/Home/Shop/zsbyg_list" target="rightFrame">钻石币云购管理</a><i></i></li>
        <li><cite></cite><a href="#">正能量文章</a><i></i></li>
        <li><cite></cite><a href="#">首頁公告</a><i></i></li>-->
    </ul>
    
    </dd>
	<dd><div class="title"><span><img src="/sncss/images/leftico04.png" /></span>系统设置</div>
    <ul class="menuson">
        <!-- <li><cite></cite><a href="/admdgjmin.php/home/index/font_mess" target="rightFrame">前台显示</a><i></i></li> -->
        <li><cite></cite><a href="/admdgjmin.php/home/index/my_initialize" target="rightFrame">初始化</a><i></i></li>
		<li><cite></cite><a href="/admdgjmin.php/home/Db/index" target="rightFrame">数据备份</a><i></i></li>
    </ul>
    
    </dd>   
	<!-- <dd><div class="title"><span><img src="/sncss/images/leftico04.png" /></span>活动列表</div>
    <ul class="menuson">
        <li><cite></cite><a href="/admdgjmin.php/Home/active/turn" target="rightFrame">大转盘设置</a><i></i></li>
		
    </ul>
    
    </dd> -->
	<dd><div class="title"><span><img src="/sncss/images/leftico04.png" /></span>商城管理</div>
    <ul class="menuson">
        <li><cite></cite><a href="/admdgjmin.php/Shop/index/index" target="rightFrame">产品分类</a><i></i></li>
		<li><cite></cite><a href="/admdgjmin.php/Shop/Project/addProject" target="rightFrame">产品添加</a><i></i></li>
		<li><cite></cite><a href="/admdgjmin.php/Shop/Project/listProject" target="rightFrame">产品列表</a><i></i></li>
        <li><cite></cite><a href="/admdgjmin.php/Shop/index/listOrderform" target="rightFrame">订单列表</a><i></i></li>
    </ul>
    
    </dd>   
	
	<!-- <dd><div class="title"><span><img src="/sncss/images/leftico04.png" /></span>任务管理</div>
    <ul class="menuson">
        <li><cite></cite><a href="/admdgjmin.php/home/renwu/index" target="rightFrame">任务添加</a><i></i></li>
        <li><cite></cite><a href="/admdgjmin.php/home/renwu/renwuList" target="rightFrame">任务列表</a><i></i></li>
		<li><cite></cite><a href="/admdgjmin.php/Home/Renwu/renwu_list/type/0/" target="rightFrame">未处理任务</a><i></i></li>
		<li><cite></cite><a href="/admdgjmin.php/Home/Renwu/renwu_list/type/1/" target="rightFrame">已处理任务</a><i></i></li>
    </dd>    -->

	
	
	
	
	  <!--
	<dd><div class="title"><span><img src="/sncss/images/leftico04.png" /></span>留言管理</div>
    <ul class="menuson">
        <li><cite></cite><a href="#">所有留言</a><i></i></li>
    </ul>
    
    </dd>  -->
	
    
    </dl>
    
</body>
</html>