<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link href="/css/mui.min.css" rel="stylesheet" />
		<link href="/css/style.css" rel="stylesheet" />	 
		<script src="/js/mui.js"></script>
	<script src="/js/jquery-1.11.3.min.js"></script>
		<title>V3财富</title>
		<style>
.top_list{display:none;background:#4096ee;min-height:200px;width:150px;z-index:99;border-radius:0;position:fixed;top:45px;right:1px} 
.menu_active{display:block;}
.mui-table-view-cell{text-align: center;color:#fff;}
.money_list{padding:11px 15px;height:auto;overflow:hidden;background: #fff;border-top:1px solid #ddd;
margin:0px;border-bottom:1px solid #ddd;margin-bottom: 2px;}
.money_list li{color:#8f8f94;font-size: 14px;line-height: 24px;padding-left: 10px;margin:0px;}
#scroll1,#scroll2{min-height:800px;padding-bottom:50px}
		</style>
	</head>
	<body style="background: #fff;">
		<header class="mui-bar mui-bar-nav" style="background: #4096ee;">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#fff;"></a>
			<h1 class="mui-title" style="color:#fff;">财务管理</h1>
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
			<div id="slider" class="mui-slider">
				<div id="sliderSegmentedControl" class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
					<a class="mui-control-item" href="#item1mobile">
						静态钱包（<?php echo ($userData['ue_money']); ?>）
					</a>
					<a class="mui-control-item" href="#item2mobile">
						动态钱包（<?php echo ($userData['tj_he']); ?>）
					</a>
							 
				</div>
				<div id="sliderProgressBar" class="mui-slider-progress-bar mui-col-xs-6"></div>
				<div class="mui-slider-group">
					<div id="item1mobile" class="mui-slider-item mui-control-content mui-active" style="min-height:800px;">
						<div id="scroll1" class="mui-scroll-wrapper">
							<div class="mui-scroll">
								 <h3 style="color:#333;font-size:14px;padding-left:15px;line-height: 30px;font-weight: normal;">静态钱包交易记录：</h3>
								<?php if(is_array($list)): foreach($list as $key=>$v): ?><ul class="money_list">
								 	<li>记录编号：<span>G<?php echo ($v["ug_id"]); ?></span></li>
								 	<li>日期：<span><?php echo ($v["ug_gettime"]); ?></span></li>
								 		<?php if(($v["status"]) == "1"): ?><li>说明：<span><?php echo ($v["ug_note"]); ?></span></li>
								 	<li>原余额：<span><?php echo ($v["ug_allget"]); ?></span></li>
								 	<li>收入/支出：<span><?php echo ($v["ug_money"]); ?></span></li>
								 	<li>新余额：<span><?php echo ($v["ug_balance"]); ?></span></li>
								 	<?php else: ?>
								 	<li>说明：<span>投资及收益</span></li>
								 	<li>利息：<span><?php echo ($v["ug_money"]); ?></span></li>
								 	<li>本金：<span><?php echo ($v["benjin"]); ?></span></li>
								 	<li><span style="float: left;">操作：</span><span id="t_d<?php echo ($v["ug_id"]); ?>">00天</span>
				            <span id="t_h<?php echo ($v["ug_id"]); ?>">00时</span>
				            <span id="t_m<?php echo ($v["ug_id"]); ?>">00分</span>
				            <span id="t_s<?php echo ($v["ug_id"]); ?>">00秒</span>
								 		<a href="javascript:;" id="back<?php echo ($v["ug_id"]); ?>"  style="width:100px;height: 24px;line-height:24px;float: left;margin-left: 15px;background: #eee;text-align:center;color:#333">一键回包</a></li><?php endif; ?>	
								 </ul>
								   <script>
                 $(function(){
                     //GetRTime(<?php echo ($v3["id"]); ?>,'<?php echo (datedqsj_2($aa1,$aaa1)); ?>');  
                     setInterval("GetRTime('<?php echo ($v["ug_id"]); ?>','<?php echo ($v["backtime"]); ?>','back<?php echo ($v["ug_id"]); ?>')",1000);
                                                       });
             </script><?php endforeach; endif; ?>
							</div>
						</div>
					</div>
					<div id="item2mobile" class="mui-slider-item mui-control-content" style="min-height:800px;">
						<div id="scroll2" class="mui-scroll-wrapper">
							<div class="mui-scroll">
								<h3 style="color:#333;font-size:14px;padding-left:15px;line-height: 30px;font-weight: normal;">动态钱包交易记录：</h3>
								<?php if(is_array($list2)): foreach($list2 as $key=>$v2): ?><ul class="money_list">
								 	<li>记录编号：<span>G<?php echo ($v2["ug_id"]); ?></span></li>
								 	<li>日期：<span><?php echo ($v2["ug_gettime"]); ?></span></li>
								 	<li>说明：<span><?php echo ($v2["ug_note"]); ?></span></li>
								 	<li>原余额：<span><?php echo ($v2["ug_allget"]); ?></span></li>
								 	<li>收入/支出：<span><?php echo ($v2["ug_money"]); ?></span></li>
								 	<li>新余额：<span><?php echo ($v2["ug_balance"]); ?></span></li>
								 </ul><?php endforeach; endif; ?>
							</div>
						</div>

					</div>
					 
				</div>
			</div>
 

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
		<script src="/js/mui.js"></script>
	<script src="/js/jquery-1.11.3.min.js"></script>
	<script>
			$(".menu").click(function(){
				 
				$(".top_list").toggleClass("menu_active");
				 
			});
			 
		</script>
		<script>
            mui.init({
                swipeBack: true //启用右滑关闭功能
            });
            (function($) {
                $('#scroll1').scroll({
                    indicators: true //是否显示滚动条
                });
                $('#scroll2').scroll({
                    indicators: true //是否显示滚动条
                });
                 
            })(mui);
        </script>
		 <script>
     function GetRTime(id, date,back) {
         var EndTime = new Date(date);
         var NowTime = new Date();
         var t = EndTime.getTime() - NowTime.getTime();
         var d = 0;
         var h = 0;
         var m = 0;
         var s = 0;
         if (t >= 0) {
             d = Math.floor(t / 1000 / 60 / 60 / 24);
             h = Math.floor(t / 1000 / 60 / 60 % 24);
             m = Math.floor(t / 1000 / 60 % 60);
             s = Math.floor(t / 1000 % 60);
         }


         document.getElementById("t_d" + id).innerHTML = d + "天";
         document.getElementById("t_h" + id).innerHTML = h + "时";
         document.getElementById("t_m" + id).innerHTML = m + "分";
         document.getElementById("t_s" + id).innerHTML = s + "秒";
     if(t<=0){
    	 $("#back"+id).attr('href','<?php echo U('Home/Info/backtopack');?>?id='+id);
    	 $("#back"+id).css('background','#4096ee')
     }
     }

     function GetATime(id, date) {


         l = Math.floor(date / 24 / 3600);

         c = new Date();
         var p = c.getTime();
         p = Math.floor(p / 1000 / 24 / 3600);
         t = p - l;

         var d = 0;
         if (t >= 0) {

             d = t + 1;
         }

         document.getElementById("c_d" + id).innerHTML = d + "天";
     }

     function GetBTime(id, date) {
         l = Math.floor(date / 24 / 3600);

         c = new Date();
         var p = c.getTime();
         p = Math.floor(p / 1000 / 24 / 3600);
         t = p - l;

         var d = 0;
         if (t >= 0) {

             d = t + 1;
         }

         document.getElementById("p_d" + id).innerHTML = d + "天";
     }
</script>
	</body>
</html>