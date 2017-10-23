<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php echo ($usertitle); ?></title>
		<link rel="stylesheet" href="/dist/css/swiper.min.css">
        <link rel="stylesheet" href="/css/style.css"> 
        <script src="http://www.caibaohezi.com/Public/home/js/share.js"></script>
		<link rel="stylesheet" href="/css/share_style1_32.css">
	</head>
	<body>
	  <!-- Swiper -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="/wap_img/banner-1.png"></div>
            <div class="swiper-slide"><img src="/wap_img/banner-2.png"></div>
            <div class="swiper-slide"><img src="/wap_img/banner-3.png"></div>
            <div class="swiper-slide"><img src="/wap_img/banner-4.png"></div>
        </div>
        <div class="btn_box">
        	<a href="<?php echo U('Login/login');?>" style="border-right:1px solid #feb300">登录</a>
        	<a href="<?php echo U('Login/register');?>">注册</a>
        </div> 
    </div>
    <ul class="index_nav">
    	<li><a href="<?php echo U('/Home/Index/home');?>"><i><img src="/wap_img/icon1.png"></i><span>首页</span></a></li>
    	<li><a href="<?php echo U('Home/Other/system');?>"><i><img src="/wap_img/icon2.png"></i><span>平台制度</span></a></li>
    	<li><a href="<?php echo U('Home/Other/guide');?>"><i><img src="/wap_img/icon3.png"></i><span>新手指南</span></a></li>
    	<li><a href=""><i><img src="/wap_img/icon4.png"></i><span>联系客服</span></a></li>
    	<li><a href="<?php echo U('Login/login');?>"><i><img src="/wap_img/icon5.png"></i><span>幸运抽奖</span></a></li>
    	<li><a href="<?php echo U('Login/login');?>"><i><img src="/wap_img/icon6.png"></i><span>每日签到</span></a></li>
    	<li><a href="<?php echo U('Login/login');?>"><i><img src="/wap_img/icon7.png"></i><span>在线商城</span></a></li>
    	<li><a href="<?php echo U('Login/login');?>"><i><img src="/wap_img/icon8.png"></i><span>游戏互动</span></a></li>
    </ul>
    <div class="area_list">
    	<div class="area_li">
    		<div class="title"><i><img src="/wap_img/h3_bg.png"></i><h3>体验区</h3></div>
    		<ul>
    			<li class="earnings"><p class="earnings_num"><?php echo ($settings["ty_jt_li"]); ?>%</p><p class="earnings_money">轮化收益</p></li>
    			<li class="details"><p class="details_date"><i><img src="/wap_img/date.png"></i><span>1-12天</span></p>
    				<p class="details_money"><i><img src="/wap_img/money.png"></i><span><?php echo ($settings["ty_tz_min"]); ?>元</span></p>
    			</li>
    			<li class="buy"><a href="<?php echo U('Login/login');?>">买入</a></li>
    		</ul>
    	</div>
    	<div class="area_li">
    		<div class="title"><i><img src="/wap_img/h3_bg.png"></i><h3>白银区</h3></div>
    		<ul>
    			<li class="earnings"><p class="earnings_num"><?php echo ($settings['baiyin_jt_li']); ?>%</p><p class="earnings_money">轮化收益</p></li>
    			<li class="details"><p class="details_date"><i><img src="/wap_img/date.png"></i><span>1-12天</span></p>
    				<p class="details_money"><i><img src="/wap_img/money.png"></i><span><?php echo ($settings["baiyin_tz_min"]); ?>元<em style="color:#333;font-style: normal;">~<?php echo ($settings["baiyin_tz_max"]); ?>元</em></span></p>
    			</li>
    			<li class="buy"><a href="<?php echo U('Login/login');?>">买入</a></li>
    		</ul>
    	</div>
    	<div class="area_li">
    		<div class="title"><i><img src="/wap_img/h3_bg.png"></i><h3>黄金区</h3></div>
    		<ul>
    			<li class="earnings"><p class="earnings_num"><?php echo ($settings['huangjin_jt_li']); ?>%</p><p class="earnings_money">轮化收益</p></li>
    			<li class="details"><p class="details_date"><i><img src="/wap_img/date.png"></i><span>1-12天</span></p>
    				<p class="details_money"><i><img src="/wap_img/money.png"></i><span><?php echo ($settings["huangjin_tz_min"]); ?>元~<em style="color:#333;font-style: normal;"><?php echo ($settings["huangjin_tz_max"]); ?>元</span></p>
    			</li>
    			<li class="buy"><a href="<?php echo U('Login/login');?>">买入</a></li>
    		</ul>
    	</div>
    	<div class="area_li">
    		<div class="title"><i><img src="/wap_img/h3_bg.png"></i><h3>钻石区</h3></div>
    		<ul>
    			<li class="earnings"><p class="earnings_num"><?php echo ($settings['zuanshi_jt_li']); ?>%</p><p class="earnings_money">轮化收益</p></li>
    			<li class="details"><p class="details_date"><i><img src="/wap_img/date.png"></i><span>1-12天</span></p>
    				<p class="details_money"><i><img src="/wap_img/money.png"></i><span><?php echo ($settings["zuanshi_tz_min"]); ?>元<em style="color:#333;font-style: normal;">~<?php echo ($settings["zuanshi_tz_max"]); ?>元</em></span></p>
    			</li>
    			<li class="buy"><a href="<?php echo U('Login/login');?>">买入</a></li>
    		</ul>
    	</div>
    </div>
    <div class="bottom_box">
    	<div class="sharecon">
			<div class="bdsharebuttonbox bdshare-button-style1-32" data-bd-bind="1499151023586">
				<a href="index.html#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
				<a href="index.html#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
				<a href="index.html#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
				<a href="index.html#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>
				<a href="index.html#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
			</div>
			<script>
				window._bd_share_config = {
					"common": {
						"bdSnsKey": {},
						"bdText": "",
						"bdMini": "2",
						"bdMiniList": false,
						"bdPic": "",
						"bdStyle": "1",
						"bdSize": "32"
					},
					"share": {}
				};
				with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
			</script> 
		</div>
    	<div class="link_con">
    		<a href="#">手机版</a>
    		<a href="#">电脑版</a>
    	</div>
    	<div class="rights"><p>Copyright  2017 V3财富 All Rights Reserved </p>
<p>京ICP备16039333号-6</p></div>
    </div>
    <style>
 
    </style> 
    
    
    
    
    <script src="../dist/js/swiper.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper('.swiper-container', {
       
        paginationClickable: true,
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: 2500,
        autoplayDisableOnInteraction: false
    });
    </script>
	</body>
</html>