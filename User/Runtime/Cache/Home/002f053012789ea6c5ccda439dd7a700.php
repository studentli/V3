<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link href="/css/mui.min.css" rel="stylesheet" />
		<link href="/css/style.css" rel="stylesheet" />
		<link rel="stylesheet" href="/dist/css/swiper.min.css">
		<link href="/js/layer/skin/layer.css">
 
		<title>V3财富</title>
		<style>
			.top_list{display:none;background:#4096ee;min-height:200px;width:150px;z-index:99;border-radius:0;position:fixed;top:45px;right:1px} 
			.menu_active{display:block;}
			.mui-table-view-cell{text-align: center;color:#fff;}
		</style>
	</head>
	<body style="background: #fff;">
		<header class="mui-bar mui-bar-nav" style="background: #4096ee;">
			<h1 class="mui-title" style="color:#fff;">V3财富</h1>
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
		<!-- Swiper -->
		 <div class="swiper-container" style="padding-top: 45px;width:100%;height: auto;overflow: hidden;">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="/wap_img/home_banner1.png"></div>
            <div class="swiper-slide"><img src="/wap_img/home_banner2.png"></div>
            <div class="swiper-slide"><img src="/wap_img/home_banner3.png"></div>
             
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination" style="text-align: right;"></div>
    </div>

    <!-- Swiper JS -->
    <script src="../dist/js/swiper.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true
    });
    </script>
<div class="earnings_box">
	<ul>
		<li><i><img src="/wap_img/earning01.png"></i><div class="earnings_txt"><span style="color:#ff5757">静态收益</span><em><?php echo ($userData['ue_money']); ?></em></div></li>
		<li><i><img src="/wap_img/earning02.png"></i><div class="earnings_txt"><span style="color:#a97aff">管理收益</span><em>0.00</em></div></li>
		<li class="line" style="width:100%;height:3px;background: #eee;"></li>
		<li><i><img src="/wap_img/earning03.png"></i><div class="earnings_txt"><span style="color:#35b178">动态收益</span><em><?php echo ($userData['tj_he']); ?></em></div></li>
		<li><i><img src="/wap_img/earning04.png"></i><div class="earnings_txt"><span style="color:#eea640">余额钱包</span><em><?php echo ($userData['ue_money']+$userData['tj_he']); ?></em></div></li>
	</ul>
</div>	
		<div class="mui-content" style="height:auto;margin-bottom:60px;padding-top: 0px;border-top:5px #eee solid;border-bottom:10px solid #eee;">
		        <ul class="mui-table-view mui-grid-view mui-grid-12" style="margin:0px;padding:0px;padding-bottom: 12px;">
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="<?php echo U('Index/tgbzcl');?>">
		                    <span class="mui-icon icon_img"><img src="/wap_img/home_icon1.png"><span class="mui-badge"><?php echo ($tgbzCount); ?></span></span>
		                    <div class="mui-media-body">申请帮助</div></a></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="<?php echo U('Index/jsbzcl');?>">
		                    <span class="mui-icon icon_img"><img src="/wap_img/home_icon2.png"><span class="mui-badge"><?php echo ($jsbzCount); ?></span></span>
		                    <div class="mui-media-body">接受帮助</div></a></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="<?php echo U('/Home/Turn/index');?>">
		                    <span class="mui-icon icon_img"><img src="/wap_img/home_icon3.png"></span>
		                    <div class="mui-media-body">幸运抽奖</div></a></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="<?php echo U('/Home/Info/cwmx');?>">
		                    <span class="mui-icon icon_img"><img src="/wap_img/home_icon4.png"></span>
		                    <div class="mui-media-body">财务管理</div></a></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="<?php echo U('/Home/Myuser/link');?>">
		                    <span class="mui-icon icon_img"><img src="/wap_img/home_icon5.png"></span>
		                    <div class="mui-media-body">推广链接</div></a></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="<?php echo U('Home/Index/qiandao');?>">
		                    <span class="mui-icon icon_img"><img src="/wap_img/home_icon6.png"></span>
		                    <div class="mui-media-body">每日签到</div></a></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="<?php echo U('/Home/Myuser/lxwmcl');?>">
		                    <span class="mui-icon icon_img"><img src="/wap_img/home_icon7.png"></span>
		                    <div class="mui-media-body">留言回复</div></a></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="<?php echo U("/Shop/Index/index");?>">
		                    <span class="mui-icon icon_img"><img src="/wap_img/home_icon8.png"></span>
		                    <div class="mui-media-body">在线商城</div></a></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="<?php echo U('/Home/Info/pin');?>">
		                    <span class="mui-icon icon_img"><img src="/wap_img/home_icon9.png"><span class="mui-badge"><?php echo ($userData['pinCount']); ?></span></span>
		                    <div class="mui-media-body">激活码</div></a></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="<?php echo U('/Home/Reghub/pdb');?>">
		                    <span class="mui-icon icon_img"><img src="/wap_img/home_icon10.png"><span class="mui-badge"><?php echo ($userData['ue_pdb']); ?></span></span>
		                    <div class="mui-media-body">排单币</div></a></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="<?php echo U('/Home/Myuser/team');?>">
		                    <span class="mui-icon icon_img"><img src="/wap_img/home_icon11.png"><span class="mui-badge"><?php echo ($tdrenshu); ?></span></span>
		                    <div class="mui-media-body">我的团队</div></a></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3"><a href="<?php echo U('/Home/Reghub/censor');?>">
		                    <span class="mui-icon icon_img"><img src="/wap_img/home_icon12.png"><span class="mui-badge"><?php echo ($waitactCount); ?></span></span>
		                    <div class="mui-media-body">下级会员</div></a></li>
		            
		        </ul> 
		         
		        
		</div>
		
			<nav class="mui-bar mui-bar-tab" style="border:none;">
			<a class="mui-tab-item" href="<?php echo U('/Home/Index/index');?>" style="padding:0px;margin: 0px;">
				<span class="mui-icon home_icon"><img src="/wap_img/home.png"></span>
				<span class="mui-tab-label" style="font-size:14px;line-height: 20px;">首页</span>
			</a>
			<a class="mui-tab-item" href="<?php echo U('/Home/Index/news');?>" style="padding:0px;margin: 0px;">
				<span class="mui-icon home_icon"><img src="/wap_img/news.png"></span>
				<span class="mui-tab-label" style="font-size:14px;line-height: 20px;">公告</span>
			</a> 
			<a class="mui-tab-item" href="<?php echo U('/Home/Myuser/Index');?>" style="padding:0px;margin: 0px;">
				<span class="mui-icon home_icon"><img src="/wap_img/mine.png"></span>
				<span class="mui-tab-label" style="font-size:14px;line-height: 20px;">我的</span>
			</a>
			<a class="mui-tab-item" href="<?php echo U('/Home/Login/logout');?>" style="padding:0px;margin: 0px;">
				<span class="mui-icon home_icon"><img src="/wap_img/exit.png"></span>
				<span class="mui-tab-label" style="font-size:14px;line-height: 20px;">退出</span>
			</a>
			 
		</nav>
	 
	<script src="/js/jquery-1.11.3.min.js"></script>
	<script>
		$(".menu").click(function(){
			 
			$(".top_list").toggleClass("menu_active");
			 
		});
		 
	</script>
	<script type="text/javascript" src="/js/layer/layer.js"></script>
	<script>
	if(<?php echo ($wszl); ?>){
		window.onload=function(){ 
            layer.confirm('欢迎加入，请完善个人资料 ！', {
  btn: ['是','否'] //按钮
}, function(){
  window.location.href="<?php echo U("Myuser/index");?>"; 
});
	}

        } 
	</script>
	</body>
</html>