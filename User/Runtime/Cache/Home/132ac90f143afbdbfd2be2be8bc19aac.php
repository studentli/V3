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
.content_con p{padding:11px 15px;font-size: 14px;line-height: 28px;color:#333;background: #fff;margin-top: 10px;}
.jihuo_list{padding:11px 15px;height:auto;overflow:hidden;background: #fff;border-top:1px solid #ddd;
margin:0px;border-bottom:1px solid #ddd;margin-bottom: 2px;}
.jihuo_list li{color:#8f8f94;font-size: 14px;line-height: 24px;padding-left: 10px;margin:0px;}
		</style>
	</head>
	<body style="background: #fff;">
		<header class="mui-bar mui-bar-nav" style="background: #4096ee;">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#fff;"></a>
			<h1 class="mui-title" style="color:#fff;">下级会员激活</h1>
			<a id="menu" class="mui-action-menu mui-icon mui-icon-bars mui-pull-right menu" style="color:#fff;font-weight: bold;"></a>
		</header>
		<!--右上角弹出菜单-->
<div id="topPopover" class="top_list" >
			 
			 
					<ul class="mui-table-view" style="background: none;">
						<li class="mui-table-view-cell">
							<a href="<?php echo U('/Home/Index/jsbzjl');?>">接受帮助匹配记录</a>
						</li>
					
						<li class="mui-table-view-cell">
							<a href="<?php echo U('/Home/Index/sqbzjl');?>">申请帮助匹配记录</a>
						</li>
						<li class="mui-table-view-cell">
							<a href="<?php echo U('/Home/Index/sell_record');?>">接受帮助等待记录</a>
						</li>
						<li class="mui-table-view-cell">
							<a href="<?php echo U('/Home/Index/buy_record');?>">申请帮助等待记录</a>
						</li>
						<li class="mui-table-view-cell">
							<a href="javascript:alert('暂时未开放！')">游戏互动</a>
						</li>
					
					</ul>
				 

		</div>
 	    <div class="content_con">
			 <?php if(is_array($users)): foreach($users as $key=>$v): ?><ul class="jihuo_list">
				<li>用户:<span><?php echo ($v['ue_account']); ?></span></li>
				<li>激活状态:<span style="color:red;"> <?php if($v["ue_status"] == 2): ?>未激活
                <?php else: ?>已激活<a style="color:#4096ee;float:right;margin-left:10px;margin-right:10px" href="<?php echo U('/Home/Myuser/trade_two');?>?id=<?php echo ($v['ue_account']); ?>">查看详情</a><?php endif; ?></span></li>
				<li>注册时间:<span><?php echo ($v["ue_regtime"]); ?></span></li>
				<?php if($v["ue_status"] == 2): ?><li><a href="<?php echo U('/Home/Reghub/activation');?>?id=<?php echo ($v['ue_id']); ?>" style="width:100px;float:right;text-align: center;background:#4096ee;color:#fff;">激活此会员</a></li><?php endif; ?> 
				
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