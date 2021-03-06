<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>V3财富</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link href="/css/mui.min.css" rel="stylesheet" />
		<link href="/css/style.css" rel="stylesheet" />	 
<!-- 		<link rel="stylesheet" href="/css/mui.min.css">
		<link rel="stylesheet" href="/css/resetmui.css">
		<link rel="stylesheet" href="/css/app.css"> -->
		
		<style>
			.mui-table-view .mui-media-object{width:30px;height: 30px;}
			#item1,#item2,#item3{height:800px;}
			.mui-table-view-cell>a:not(.mui-btn) {
    position: relative;
    display: block;
    overflow: hidden;
    margin: -11px -15px;
    padding: inherit;
    white-space: nowrap;
    text-overflow: ellipsis;
    color: inherit;
    font-size: 15px;
    padding: 0px;
    line-height: 52px;
}
.top_list{display:none;background:#4096ee;min-height:200px;width:150px;z-index:99;border-radius:0;position:fixed;top:45px;right:1px} 
.menu_active{display:block;}
.mui-table-view-cell{text-align: center;color:#fff;}
.list_header{width:100%;height:auto;overflow: hidden;margin-top: 10px;background: #fff;margin-bottom: 10px;}
.list_header p{color:#0261aa;font-size: 15px;line-height:29px;margin:0px;padding-left: 10px;}
.list_li{padding:11px 15px;height:auto;overflow:hidden;background: #fff;border-top:1px solid #ddd;
margin:0px;border-bottom:1px solid #ddd;margin-bottom: 2px;}
.list_li li{color:#8f8f94;font-size: 14px;line-height: 24px;padding-left: 10px;margin:0px;}
.list_li li span{padding-left: 10px;}
		</style>
	</head>
	<body style="background-color:#fff;">
		<header class="mui-bar mui-bar-nav" style="background: #4096ee;">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#fff;"></a>
			<h1 class="mui-title" style="color:#fff;">接受帮助等待记录</h1>
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
		 <div class="mui-content">
			<div style="padding: 10px 10px;">
				<div id="segmentedControl" class="mui-segmented-control" style="border:none;">
					<a class="mui-control-item mui-active" href="#item1" style="border-left:none;">提供帮助 </a>
					<a class="mui-control-item" href="#item2" style="border-left:none;">接受帮助 </a>
					<!--<a class="mui-control-item" href="#item3" style="border-left:none;">三级团队（99） </a>-->
				</div>
			</div>
			<div style="width:100%;height:10px;background: #eee;"></div>
			<div>
				<form>
					<div id="item1" class="mui-control-content mui-active" >
						<div id="scroll" class="mui-scroll-wrapper">
							<div class="mui-scroll">
							<?php if(is_array($tgbzlist)): foreach($tgbzlist as $key=>$v): ?><ul class="list_li">
										<li>单号:<span>R<?php echo ($v["id"]); ?></span></li>
										<li>金额:<span><?php echo ($v["jb"]); ?></span></li>
										<li>下单时间:<span><?php echo ($v["date"]); ?></span></li>
										<li>状态:<span>
										<?php if($v["zt"] == 0): ?>未匹配
										<?php elseif($v["zt"] == 1 AND $v["qr_zt"] == 0): ?>
										已匹配
										<?php elseif($v["qr_zt"] == 1): ?>
										已完成<?php endif; ?>
										</span></li>
									</ul><?php endforeach; endif; ?>
							</div>
						</div>
					</div>
					<div id="item2" class="mui-control-content">
					<?php if(is_array($jsbzlist)): foreach($jsbzlist as $key=>$v2): ?><ul class="list_li">
								<li>单号:<span>R<?php echo ($v2["id"]); ?></span></li>
								<li>金额:<span><?php echo ($v2["jb"]); ?></span></li>
								<li>下单时间:<span><?php echo ($v2["date"]); ?></span></li>
								<!-- <li>匹配时间:<span>213135131</span></li>
								<li>完成时间:<span>213135131</span></li> -->
								<li>状态:<span>
										<?php if($v2["zt"] == 0): ?>未匹配
										<?php elseif($v2["zt"] == 1 AND $v2["qr_zt"] == 0): ?>
										已匹配
										<?php elseif($v2["qr_zt"] == 1): ?>
										已完成<?php endif; ?></span></li>
							</ul><?php endforeach; endif; ?>
					</div>
					 
				</form>
			</div>
			 
			 
		</div>
     
    <style>
    	.mui-input-row .mui-icon{width:50px;height:25px;
    position: absolute;
    z-index: 1;
    top: 0px;
    right: 0;
    
    text-align: center;
    color: #999;}
    .mui-input-row .mui-icon img{width:100%;height:100%;}
    </style>
    <script src="/js/mui.min.js"></script>
    <script src="/js/jquery.min.js"></script>
   <!--  <script src="/js/mui.js"></script>
	<script src="/js/jquery-1.11.3.min.js"></script> -->
	<script>
			$(".menu").click(function(){
				 
				$(".top_list").toggleClass("menu_active");
				 
			});
			 
		</script>

	</body>
</html>