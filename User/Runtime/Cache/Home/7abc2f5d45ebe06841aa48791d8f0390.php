<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>幸运大转盘</title>
<style type="text/css">
.demo{ height:320px; position:relative; margin:20px auto}
#disk{width:300px; height:320px; background:url(/wap_img/disk.png) no-repeat;background-size:100% 100%;margin: auto; }
#start{ width:50px;height:70px; margin: auto;position: absolute;top:121px;left:50%;margin-left:-25px;}
#start img{cursor:pointer;width: 100%;height: 100%;}
body{background:#fff!important;width:1440px;margin:0 auto;}
.top_list{display:none;background:#4096ee;min-height:200px;width:150px;z-index:99;border-radius:0;position:fixed;top:45px;right:1px} 
.menu_active{display:block;}
.mui-table-view-cell{text-align: center;color:#fff;}
@meida 
</style>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="/css/mui.min.css" rel="stylesheet" />
		<link href="/css/style.css" rel="stylesheet" />	 
		
		<!-- Page title -->
		<title>
			V3财富
		</title>
 
</head>

<body style="position: relative;min-width: 320px;max-width: 650px;margin: auto; width: 100%;background:#95ceed!important;">
    <header class="mui-bar mui-bar-nav" style="background: #4096ee;">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#fff;"></a>
			<h1 class="mui-title" style="color:#fff;">推荐链接</h1>
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
 

    <!-- Main Wrapper -->

    <div style="padding-top:55px;">
   <div style="width:300px;height: auto;overflow: hidden;margin:0 auto;"><img style="width:100%;height: 100%;" src="/wap_img/turn_logo.png"></div>
   <div class="demo">
        <div id="disk">
        	<div id="start"><img src="/wap_img/start.png" id="startbtn"></div>
        </div>
        
		
   </div>
    <div style='padding: 0 20px 30px 20px;'>
	 <div style="width:300px;height: auto;overflow: hidden;margin:0 auto;">
	   <div class="text_con" style="background:url(/wap_img/tetx.png) no-repeat;background-size: 100% 100%;
    height: 80px;position: relative;width:100%;">
	          <marquee direction="left" behavior="scroll" scrollamount="5" scrolldelay="0" loop="-1"
	           width="100%" height="32" hspace="10" vspace="0" 
	           style=" z-index: 99;font-size: 16px;color: #000;line-height: 32px;position: absolute;
    top: 40px;left:15%;width:70%">
            <span style="margin-left:5px;"><?php echo ($news['if_content']); ?></span></marquee>
	   </div>
	  <img style="width:100%;height: 100%;" src="/wap_img/text.png"> 
	 </div>		 
	</div>
  <!-- <div class="ad_demo"><script src="/js/ad_js/ad_demo.js" type="text/javascript"></script></div><br/>-->
</div>

	<!--<script src="../js/jquery-1.11.3.min.js"></script>-->
	
	<!-- <script type="text/javascript" src="/js/jquery.js"></script> -->
	<script src="/js/mui.js"></script>
			<script type="text/javascript" src="/js/jquery.min.1.12.3.js"></script>
		<script type="text/javascript" src="/js/jQueryRotate.2.2.js"></script>
		<script type="text/javascript" src="/js/jquery.easing.min.js"></script>
<script>
			$(".menu").click(function(){
				 
				$(".top_list").toggleClass("menu_active");
				 
			});
			 
	</script>
		<script type="text/javascript">
var turn = function(){
				
				$("#startbtn").unbind('click',turn).css("cursor","default"); 
				
				$.post('/Home/turn/get_v','',function(data){
					console.log(data);
					if(data['status'] == 0){
						alert(data.info);
						return;
					}
					//var a = Math.floor(Math.random() * 360);
					
					var s = data.switch;
					
					if(parseInt(s)){
						
						var a = data.angle;
						var p = data.prize;
						if(a){
							$("#startbtn").rotate({
								duration:3000,
								angle: 0, 
								animateTo:2880+a,
								easing: $.easing.easeOutSine,
								callback: function(){
									//alert('中奖了！');
									var conString = "";
								if(data['prize'] == '谢谢参与'){
									conString = "谢谢参与\n再来一次？";
								}else{
									conString = "恭喜你中得"+p+"\n再来一次？";
								}
									if(confirm(conString)){
										$(this).bind( 'click',turn).css("cursor","pointer");
										  window.location.reload();
									}
									 
								}
							});
						}
					}else{
						alert('活动已关闭！');
					}
					
					
				},'json');
				
			}
$(function(){
	$("#startbtn").click(turn); 
});
</script>
</body>
</html>