<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html><head><meta charset="utf-8" />
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
.contentBox{width:96%;margin:0 auto; height: auto;overflow: hidden;}
/* .small_box{width:86%; border:#eee 1px solid;margin:0 auto;margin-bottom:20px; height: 320px;}
.small_box a{ width: 100%; height: auto;overflow: hidden;}
.small_box a img{ width:250px; height: 250px; margin:0 auto;margin-top:10px;margin-bottom: 10px;}
.small_box dd,.small_box dt{font-size:12px; line-height: 20px; width: 100%; text-align:right;}
.small_box dd{color:#F00;}
.small_box dt{color:#666;}
.small_box a span{background-color:#FFF;width:90%;padding-left: 10px;padding-right: 10px;}
.hBox dl{padding:0;margin:0;}
.hBox dt{padding:0;margin:0;font-size:10px;margin-left:9px;} */

.bigBox{ width: 100%; margin-top: 20px;height: auto;overflow: hidden;}
.smallBox{ width: 302px; margin:0 auto; height: auto;overflow: hidden;}
.smallBox .small_box{ width: 100%;margin:0px; padding:0px;margin-bottom:20px;height:auto;overflow: hidden;}
.smallBox .small_box a{ width:300px; height: 300px; float: left; display: block;border:1px solid #ccc;}
.smallBox .small_box a img{ width: 100%; height: 100%; float: left;}
.smallBox .small_box dt{ width: 120px; float: left; height: 30px; line-height: 30px; font-size: 14px; text-align: left;}
.smallBox .small_box dd{ width: 120px; float: right; height: 30px; line-height: 30px; font-size: 14px; text-align: right;}
</style>
 
 
</head>
<body>
<header class="mui-bar mui-bar-nav" style="background: #4096ee;">
	<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#fff;"></a>
	<h1 class="mui-title" style="color:#fff;">公司商城</h1>
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
<div class="contentBox" style="height:auto;overflow: hidden;">

                <div class="hBox">
                    <dl>商家推荐</dl>
                    <dt>以真心换真心，给您最正确的选择！</dt>
            
                    <div class="clearfix"></div>
                </div>
                
                <div class="bigBox">
        <div class="smallBox">
                    <?php if(empty($shop_hot)): ?><div style="width:100%;padding:50px;text-align:center;font-size:16px;color:#DDD">暂无数据</div>
                    <?php else: ?>
                    <?php if(is_array($shop_hot)): foreach($shop_hot as $key=>$value): ?><div class="small_box">
                            <a href="/Shop/Index/project?id=<?php echo ($value["id"]); ?>"><img width="300" height="200" src="<?php echo ($value["imagepath"]); ?>">
                            </a>
                             <dt style="margin-left:4px"><?php echo ($value["name"]); ?></dt>
                                <dd style="margin-right:4px"><strong>￥:<?php echo ($value["price"]); ?>元</strong></dd>
                        </div><?php endforeach; endif; endif; ?>
                            <div class="clearfix"></div>
                    
                        
                      </div>
                  </div>
                  <div class="pages" style="margin:20px 0 ;text-align: center;"><?php echo ($show); ?></div>




 
<script src="/js/mui.js"></script>
	<script src="/js/jquery-1.11.3.min.js"></script>
	<script>
			$(".menu").click(function(){
				 
				$(".top_list").toggleClass("menu_active");
				 
			});
			 
		</script>
	</body>
</html>