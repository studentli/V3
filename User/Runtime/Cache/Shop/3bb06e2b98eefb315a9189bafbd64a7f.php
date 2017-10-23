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
.contentBox{width:96%;margin:0 auto;}
.small_box{width:48%;float:left;border:#000 1px solid;margin:0 1px;margin-bottom:2px;}

.small_box dd,.small_box dt{font-size:12px;}
.small_box dd{color:#F00;}
.small_box dt{color:#666;}
.small_box span{background-color:#FFF;width:100%;}
.hBox dl{padding:0;margin:0;}
.hBox dt{padding:0;margin:0;font-size:10px;margin-left:9px;}
.towNav h1{font-size:16px;padding:4px 0;}
.towNav h2{font-size:14px;padding:4px 0;}
.weibu{background:#fff;position:fixed;left:0;bottom:0;width:100%;}
.center{width:96%;margin:0 auto;}
.center a{width:20%;float:left; text-align:center;}
.pages{width:100.5%;padding:10px 0px;clear:both;}
.pages li{float:left;margin:0px 5px;} 
.pages a{color:#09f;margin:0px 2px;} 
li{list-style:none;}
.top{box-shadow: 0 1px 6px #ccc;position: fixed;z-index: 10;right: 0;left: 0;height: 44px;padding-right: 10px;
    padding-left: 10px;border-bottom: 0;display:block;}
.top .icon_list{margin-right: -10px;margin-left: -10px;padding-right: 10px;padding-left: 10px;    font-size: 24px;
    position: relative;z-index: 20;padding-top: 10px;padding-bottom: 10px;    display: inline-block;float: right;}
.top .title_con{right: 40px;
    left: 40px;
    display: inline-block;
    overflow: hidden;
    width: auto;
    margin: 0;
    text-overflow: ellipsis;color: #fff;font-size: 17px;
    font-weight: 500;
    line-height: 44px;
    position: absolute;text-align: center;
    white-space: nowrap;}
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
 <div class="bannerBox01" style="width:100%; height:auto;overflow: hidden;padding-top: 50px;">
            <img style="width:300px;height:300px;border:1px solid #666;margin:0 auto;" src="<?php echo ($arr["imagepath"]); ?>">
       
    
</div>    


<style>
  
.contentBox h1{ width: 100%; text-align: left;padding-right: 10px;line-height: 30px; font-size: 16px;}
.contentBox h2{ width: 100%; text-align: left;padding-right: 10px;line-height: 30px; font-size: 14px;}
.contentBox p{ width: 100%;padding:0px;margin:0px; text-align: left;padding-right: 10px;line-height: 30px; font-size: 14px;}
.contentBox span{ width: 30%;display: inline-block;  float: left;}
.content span{ width: 100%;}
</style>
<div class="contentBox" style=" width:90%;margin:0 auto;">
      <div class="towNav">
 
          <h1><?php echo ($arr["name"]); ?></h1>
          
          
                <h2><?php echo ($arr["title"]); ?></h2>
                           
                <p style="color:#333;">价格： <b style="color:red;">￥ <?php echo ($arr["price"]); ?></b></p>
              
                <div class="clearfix"></div>
       
                <div style="width:100%; height:auto;overflow: hidden; float: left;margin-bottom:10px;">
                 <span style="float:left;width:50px;line-height:30px;">数量 :</span>
              <form style="width:100px;height:30px;border:1px solid #888; float:left;">
               <input style="width:100%;border:none;height:28px" id="count" size="1" onchange="countnum()" type="number" class="text" value="1"/> 
        <script>
          function countnum(){
            var val = $("#count").val();
            if(val<=0){
              $("#count").val("1");
            }
          }
        </script>
                <div class="clearfix"></div>
              </form>
          <!-- b</dt> -->
              <span class="duo" style="cursor:pointer;float:right; width:150px; text-align: center;border:1px solid #999;margin-top: 10px;" onclick="confirm()">立即购买</span>
                </div>
             
              <div class="clearfix"></div>
              <!--  <div class="fenjie">
                  <img src="/images/xiabianxian.gif">
                </div>  -->
      </div>
      <div class="tuijian1">
      <?php if(is_array($list)): foreach($list as $key=>$value): ?><a href="shangchengxiangqing.html">
          <img src="<?php echo ($value["imagepath"]); ?>">
            <h2><?php echo ($value["name"]); ?></h2>
            <h2>￥<?php echo ($value["price"]); ?></h2>
      </a><?php endforeach; endif; ?>
    </div>
    <div class="clearfix"></div>
</div>
<div class="contentBox" style="width:90%;margin:0 auto;">
                <div class="hBox" style="text-align: left;">
                    <h1 style="width:100%; height: 30px; text-align: left;">产品详情</h1>          
                </div>
                
    <div class="content" style="width:100%; height:auto;overflow:hidden;padding-bottom: 30px;">
       
          <h3><?php echo ($arr["title"]); ?></h3>
          <p style="width:100%; height:auto;overflow:hidden;line-height: 20px;"><?php echo ($arr["content"]); ?></p>
        
      </div>

  </div>
<script src="/js/mui.js"></script>
	<script src="/js/jquery-1.11.3.min.js"></script>
	<script>
			$(".menu").click(function(){
				 
				$(".top_list").toggleClass("menu_active");
				 
			});
			 
	</script>
</body>
</body>
</html>