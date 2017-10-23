<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link href="/css/mui.min.css" rel="stylesheet" />
		<link href="/css/style.css" rel="stylesheet" />	 
		<title>V3财富</title>
		<style>
.top_list{display:none;background:#4096ee;min-height:200px;width:150px;z-index:99;border-radius:0;position:fixed;top:45px;right:1px} 
.menu_active{display:block;}
.mui-table-view-cell{text-align: center;color:#fff;}
 .pin_li{padding:11px 15px;height:auto;overflow:hidden;background: #EEEEEE;border-top:1px solid #ddd;
margin:0px;border-bottom:1px solid #ddd;margin-bottom: 2px;margin-top: 10px;}
.pin_li li{color:#8f8f94;font-size: 14px;line-height: 24px;padding-left: 10px;margin:0px;}
.pin_li li span{padding-left: 10px;}



		</style>
	</head>
	<body style="background: #fff;">
		<header class="mui-bar mui-bar-nav" style="background: #4096ee;">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#fff;"></a>
			<h1 class="mui-title" style="color:#fff;">激活码转让记录</h1>
			<a id="menu" class="mui-action-menu mui-icon mui-icon-bars mui-pull-right menu" style="color:#fff;font-weight: bold;"></a>
		</header>
		<!--右上角弹出菜单-->
		<div id="topPopover" class="top_list" >			 
			 
					<ul class="mui-table-view" style="background: none;">
						<li class="mui-table-view-cell">
							<a href="#">交易记录</a>
						</li>
						<li class="mui-table-view-cell">
							<a href="#">游戏互动</a>
						</li>
						<li class="mui-table-view-cell">
							<a href="#">交易记录</a>
						</li>
						<li class="mui-table-view-cell">
							<a href="#">游戏互动</a>
						</li>
						<li class="mui-table-view-cell">
							<a href="#">游戏互动</a>
						</li>	 
					</ul>
				 
		</div> 
 	     
 	    <div class="content_con" style="padding:0px;padding-top: 44px;">
			 <?php if(is_array($list)): foreach($list as $key=>$vo): ?><ul class="pin_li">
				<li>单号:<span><?php echo ($vo['ug_id']); ?></span></li>
				<li>用户:<span><?php echo ($vo["ug_account"]); ?></span></li>
				<li>转账账户:<span><?php echo ($vo["ug_othraccount"]); ?></span></li>
				<li>转账前:<span><?php echo ($vo["ug_allget"]); ?></span></li>
				<li>转账数量:<span><?php echo ($vo["ug_money"]); ?></span></li>
				<li>转账后:<span><?php echo ($vo["ug_balance"]); ?></span></li>
				<li>时间:<span><?php echo ($vo["ug_gettime"]); ?></span></li>
			</ul><?php endforeach; endif; ?>
		</div>
		 
		<nav class="mui-bar mui-bar-tab" style="border:none;">
			<a class="mui-tab-item" href="<?php echo U('Home/Index/index');?>" style="padding:0px;margin: 0px;">
				<span class="mui-icon home_icon"><img src="/wap_img/home.png"></span>
				<span class="mui-tab-label" style="font-size:14px;line-height: 20px;">首页</span>
			</a>
			<a class="mui-tab-item" href="<?php echo U('/Home/Index/news');?>" style="padding:0px;margin: 0px;">
				<span class="mui-icon home_icon"><img src="/wap_img/news.png"></span>
				<span class="mui-tab-label" style="font-size:14px;line-height: 20px;">公告</span>
			</a> 
			<a class="mui-tab-item" href="<?php echo U('Myuser/Index');?>" style="padding:0px;margin: 0px;">
				<span class="mui-icon home_icon"><img src="/wap_img/mine.png"></span>
				<span class="mui-tab-label" style="font-size:14px;line-height: 20px;">我的</span>
			</a>
			<a class="mui-tab-item" href="<?php echo U('Login/logout');?>" style="padding:0px;margin: 0px;">
				<span class="mui-icon home_icon"><img src="/wap_img/exit.png"></span>
				<span class="mui-tab-label" style="font-size:14px;line-height: 20px;">退出</span>
			</a>
			 
		</nav>
		<script src="/js/mui.js"></script>
	<script src="/js/jquery-1.11.3.min.js"></script>
	<script>
			$(".menu").click(function(){
				 
				$(".top_list").toggleClass("menu_active");
				 
			});
			 
		</script>
	</body>
</html>