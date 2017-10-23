<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
 
<link rel="stylesheet" href="/assets/vendor/bootstrap/dist/css/bootstrap.css">
 
<link href="/css/mui.min.css" rel="stylesheet" />
<link href="/css/style.css" rel="stylesheet" />
<script src="/cssmmm/jquery.min.js"></script>
  
<script src="/cssmmm/bootstrap.min.js"></script>

		<title>V3财富</title>
		<style>
.top_list{display:none;background:#4096ee;min-height:200px;width:150px;z-index:99;border-radius:0;position:fixed;top:45px;right:1px} 
.menu_active{display:block;}
.mui-table-view-cell{text-align: center;color:#fff;}
.sell_list {
			padding: 11px 15px;
			height: auto;
			overflow: hidden;
			background: #eee;
			border-top: 1px solid #ddd;
			margin: 0px;
			border-bottom: 1px solid #ddd;
			margin-bottom: 2px;
			margin-top: 10px;
		}
		
		.sell_list li {
			color: #8f8f94;
			font-size: 14px;
			line-height: 24px;
			padding-left: 10px;
			margin: 0px;
			overflow: hidden;
			height: auto;
		}
		
		.sell_list li i {
			width: 25%;
			float: left;
			font-style: normal;
		}
		
		.sell_list li span {
			padding-left: 10px;
			/*width: 72%;*/
			float: left;
			/*display: block;*/
		}	
		.btn-xs {
    border-radius: 3px;
    font-size: 11px;
    line-height: 1.5;
    padding: 1px 7px;
}	</style>
	</head>
	<body style="background: #fff;">
		<header class="mui-bar mui-bar-nav" style="background: #4096ee;">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#fff;"></a>
			<h1 class="mui-title" style="color:#fff;">接受帮助匹配记录</h1>
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
			 			 <?php if(is_array($list3)): foreach($list3 as $key=>$v3): ?><ul class="sell_list">
					<li><i>订单编号：</i><span>R<?php echo ($v3["id"]); ?></span></li>
					<li><i>匹配状态：</i><span> <?php if($v3["zt"] == 0): ?>待付款<?php endif; ?>
                                            <?php if($v3["zt"] == 1): ?>已付款<?php endif; ?>
                                            <?php if($v3["zt"] == 2): ?>交易成功<?php endif; ?></span></li>
					<li><i>交易时间：</i>
						<span><small>配对时间：<?php echo ($a1=$v3["date"]); ?><br><div style="display: none"><?php echo ($aab=$v3["p_user"]); ?></div></small>
                                      <?php if($v3["zt"] == 0): ?><small>到期打款时间：<?php echo (datedqsj($a1,$aa1)); ?><br>
                                      <div style="display: none"><?php echo ($aab=$v3["p_user"]); ?></div></small>
                                      <small> <span>倒计时：</span>
                                        <span id="t_d<?php echo ($v3["id"]); ?>">00天</span>
                                        <span id="t_h<?php echo ($v3["id"]); ?>">00时</span>
                                        <span id="t_m<?php echo ($v3["id"]); ?>">00分</span>
                                        <span id="t_s<?php echo ($v3["id"]); ?>">00秒</span>
                                    </small><br>
                                    <script>
                                        $(function(){
                                           // GetRTime(<?php echo ($v3["id"]); ?>,'<?php echo (datedqsj_2($aa1,$aaa1)); ?>');
                                            
                                            setInterval("GetRTime('<?php echo ($v3["id"]); ?>','<?php echo (datedqsj($a1,$aa1)); ?>')",1000);
                                        });
                                    </script><?php endif; ?>

                                      <?php if($v3["zt"] == 1): ?><small> 汇款时间：<?php echo ($aa1=$v3["date_hk"]); ?><div style="display: none"><?php echo ($aab=$v3["p_user"]); ?></div></small>
                                      <br><small> 到期确认时间：<?php echo (datedqsj($aa1,$aaa1)); ?><div style="display: none"><?php echo ($aab=$v3["p_user"]); ?></div></small>
                                      <br>
                                      <small><!-- <i class="fa fa-clock-o"></i> --> 倒计时：
                                        <b id="t_d<?php echo ($v3["id"]); ?>">00天</b>
                                        <b id="t_h<?php echo ($v3["id"]); ?>">00时</b>
                                        <b id="t_m<?php echo ($v3["id"]); ?>">00分</b>
                                        <b id="t_s<?php echo ($v3["id"]); ?>">00秒</b>
                                      </small>
                                    <script>
                                        $(function(){
                                            
                                            setInterval("GetRTime('<?php echo ($v3["id"]); ?>','<?php echo (datedqsj_2($aa1,$aaa1)); ?>')",1000);
                                        });
                                    </script><?php endif; ?></span></li>
					<li><i>打款人：</i><span><?php echo ($v3["p_user"]); ?></span></li>
					<li><i>支付方式：</i><span><?php if($v3["zffs1"] == 1): ?>银行<?php endif; ?>
                                           <?php if($v3["zffs2"] == 1): ?>支付宝<?php endif; ?>
                                          <?php if($v3["zffs3"] == 1): ?>微信<?php endif; ?></span></li>
					<li><i>收款人：</i><span>YOU</span></li>
					<li><i>金额：</i><span><?php echo ($v3["jb"]); ?>人民币
						<a href="/<?php echo ($v3["pic"]); ?>" target="_blank" style="float:right;color:#fff;background:#0261aa;border:1px solid #ddd;padding-left:10px;padding-right: 10px;">
						</a></span></li>
					<li><i>操作：</i><span style="width:70%;float: left;">
					  <input style="width:80px;height:24px;line-height: 24px;padding:0px;margin:0px;background:#3498db;color:#fff;" name="btn1" id="btn3<?php echo ($v3["id"]); ?>" type="button" value=" 留言 "   data-toggle="modal" data-id="8802104" data-target="#myModal7">
                                        <input style="width:80px;height:24px;line-height: 24px;padding:0px;margin:0px;background: #3498db;color:#fff;" name="btn1" id="btn4<?php echo ($v3["id"]); ?>" type="button" value="详细资料" data-toggle="modal" id="btn12" data-target="#myModal5" >
<?php if(($v3["zt"]) == "1"): if(($v3["ts_zt"]) == "3"): ?><!-- 12小时未确认收款,<br/>
    已被投诉,请联系对<br/>
    方取消投诉! -->
    <!-- 未按时收款 -->
     <input style="width:80px;height:24px;line-height: 24px;padding:0px;margin:0px;background:#3498db;color:#fff;" type="button" value=" 未按时收款 "><br>
    <?php else: ?>
    <input style="width:80px;height:24px;line-height: 24px;padding:0px;margin:0px;background:#3498db;color:#fff;" name="btn23" id="btn23<?php echo ($v3["id"]); ?>" type="button" value="确认收款" class="btn_detail btn-primary btn-xs" data-toggle="modal"  data-target="#myModa23">
    <!-- <input style="width:80px;" name="btn23" id="btn23<?php echo ($v3["id"]); ?>" type="button" value="确认收款" class="btn_detail btn-primary btn-xs" data-toggle=""  data-target=""> --><?php endif; ?>
</div>
<script>
$(function(){
$('#btn23<?php echo ($v3["id"]); ?>').click(function(){
 $("#mainframe188",parent.document.body).attr("src","/Home/Index/home_ddxx_gcz/id/<?php echo ($v3["id"]); ?>/") 
$("#mainframe188").reload(); 
	/* if(confirm("请您确认已经收款！")){
        $.post('/Home/Index/home_ddxx_gcz_cl/',{
        id:'<?php echo ($v3["id"]); ?>'
        },
        function(data){
            alert(data);
            window.location.reload();
        }
        );} */
})
})
</script><?php endif; ?>
 




                                       

						</span>
					</li>
					
					 <script>
$(function(){



$('#btn4<?php echo ($v3["id"]); ?>').click(function(){
$("#mainframe11",parent.document.body).attr("src","/Home/Index/home_ddxx/id/<?php echo ($v3["id"]); ?>/") 
$("#mainframe11").reload();
})


$('#btn3<?php echo ($v3["id"]); ?>').click(function(){
$("#mainframe12",parent.document.body).attr("src","/Home/Index/home_ddxx_ly/id/<?php echo ($v3["id"]); ?>/") 
$("#mainframe12").reload();
})
})


</script>
      <script>
                                                        function GetRTime(id, date) {
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
				</ul><?php endforeach; endif; ?>
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

		<div class="modal fade" id="myModal7" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="color-line"></div>
					<div class="modal-header">
						<h5 class="modal-title" id="title2">留言信息</h5>
						<small class="font-bold"></small>
					</div>
					<div class="modal-body" style="height:300px; overflow:auto">
						<iframe src='' id="mainframe12" width="100%;" height="350px;"></iframe>
		
					</div>
					<div class="modal-footer">
						<button type="button" class="btn-default" data-dismiss="modal">关闭</button>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-hidden="true">
		    <div class="modal-dialog modal-lg">
		        <div class="modal-content">
		            <div class="color-line"></div>
		            <div class="modal-header">
		                <h5 class="modal-title" id="title">匹配订单详细信息</h5>
		                <small class="font-bold"></small>
		            </div>
		            <div class="modal-body" style="height:400px; overflow:auto">
		              <iframe src='' id="mainframe11" width="830px;" height="350px;" ></iframe>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn-default" data-dismiss="modal">关闭</button>
		            </div>
		        </div>
		    </div>
		</div>
		<div class="modal fade" id="myModa23" tabindex="-1" role="dialog" aria-hidden="true">
		    <div class="modal-dialog modal-lg">
		        <div class="modal-content">
		
		            <div class="color-line"></div>
		            <div class="modal-header">
		                <h5 class="modal-title" id="title23">请选择</h5>
		                <small class="font-bold"></small>
		            </div>
		            <div class="modal-body" style="height:400px; overflow:auto">
		              <iframe src='' id="mainframe188" width="830px;" height="350px;" ></iframe>
		            </div>
		            <div class="modal-footer">
		                
		                  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		                <!--  
		                <button type="button" class="btn-primary" data-dismiss="modal" id="select_fanshi">确认</button>-->
		            </div>
		
		
		
		        </div>
		    </div>
		</div>
	</body>
	
</html>