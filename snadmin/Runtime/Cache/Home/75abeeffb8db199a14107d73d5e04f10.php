<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
			无标题文档
		</title>
		<link href="/sncss/css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="place">
			<span>
				位置：
			</span>
			<ul class="placeul">
				<li>
					<a href="#">
						首页
					</a>
				</li>
				<li>
					<a href="#">
						活动
					</a>
				</li>
			</ul>
		</div>
		<div class="formbody">
			<div class="formtitle">
				<span>
					大转盘
				</span>
			</div>
			<form id="form1" name="form1" method="post" action="/admdgjmin.php/Home/active/turn">
				<ul class="forminfo">
					<i>
					</i>
					</li>
					<li>
						<label>
							单次抽奖消耗：
						</label>
						<input name="consume" type="text" id="consume"
						class="dfinput" required="true" value="<?php echo ((isset($result['consume']) && ($result['consume'] !== ""))?($result['consume']):0); ?>" />
						金币
						<i>
						</i>
					</li>
					<li>
						<label>
							抽奖开关
						</label>
						<label><input name="switch" type="radio" id="switch" class="input-10" <?php if(($result["switch"]) == "1"): ?>checked<?php endif; ?> required="true" value="1" />开</label>
						<label><input name="switch" type="radio" id="switch" class="input-10" <?php if(($result["switch"]) == "0"): ?>checked<?php endif; ?> required="true" value="0" />关</label>
						<i>
						</i>
					</li>
					<style>
						.input-10{width:40px;}
            .dfinput{width:60px;text-align:center;}
					</style>
					<li>
						<label>
							一等奖
						</label>
						金额/奖品：<input name="turn_num[0]" type="text" id="turn_num" class="dfinput input-10" required="true" value="<?php echo ((isset($result['turn_num'][0]) && ($result['turn_num'][0] !== ""))?($result['turn_num'][0]):0); ?>" />
						概率：<input name="turn_v[0]" type="text" id="turn_v" class="dfinput input-10" required="true" value="<?php echo ((isset($result['turn_v'][0]) && ($result['turn_v'][0] !== ""))?($result['turn_v'][0]):0); ?>" />
						
						<i>
						</i>
					</li>
					<li>
						<label>
							二等奖
						</label>
						金额/奖品：<input name="turn_num[1]" type="text" id="turn_num" class="dfinput input-10" required="true" value="<?php echo ((isset($result['turn_num'][1]) && ($result['turn_num'][1] !== ""))?($result['turn_num'][1]):0); ?>" />
						概率：<input name="turn_v[1]" type="text" id="turn_v" class="dfinput input-10" required="true" value="<?php echo ((isset($result['turn_v'][1]) && ($result['turn_v'][1] !== ""))?($result['turn_v'][1]):0); ?>" />
						
						<i>
						</i>
					</li>
					<li>
						<label>
							三等奖
						</label>
						金额/奖品：<input name="turn_num[2]" type="text" id="turn_num" class="dfinput input-10" required="true" value="<?php echo ((isset($result['turn_num'][2]) && ($result['turn_num'][2] !== ""))?($result['turn_num'][2]):0); ?>" />
						概率：<input name="turn_v[2]" type="text" id="turn_v" class="dfinput input-10" required="true" value="<?php echo ((isset($result['turn_v'][2]) && ($result['turn_v'][2] !== ""))?($result['turn_v'][2]):0); ?>" />
						<i>
						</i>
					</li>
					<li>
						<label>
							四等奖
						</label>
						金额/奖品：<input name="turn_num[3]" type="text" id="turn_num" class="dfinput input-10" required="true" value="<?php echo ((isset($result['turn_num'][3]) && ($result['turn_num'][3] !== ""))?($result['turn_num'][3]):0); ?>" />
						概率：<input name="turn_v[3]" type="text" id="turn_v" class="dfinput input-10" required="true" value="<?php echo ((isset($result['turn_v'][3]) && ($result['turn_v'][3] !== ""))?($result['turn_v'][3]):0); ?>" />
						
						<i>
						</i>
					</li>
<!-- added ends -->
					<li>
						<label>
							五等奖
						</label>
						金额/奖品：<input name="turn_num[4]" type="text" id="turn_num" class="dfinput input-10" required="true" value="<?php echo ((isset($result['turn_num'][4]) && ($result['turn_num'][4] !== ""))?($result['turn_num'][4]):0); ?>" />
						概率：<input name="turn_v[4]" type="text" id="turn_v" class="dfinput input-10" required="true" value="<?php echo ((isset($result['turn_v'][4]) && ($result['turn_v'][4] !== ""))?($result['turn_v'][4]):0); ?>" />
						
						<i>
						</i>
					</li>
					 <li>
						<label>
							谢谢参与
						</label>
						金额/奖品：<input name="turn_num[5]" type="text" id="turn_num" class="dfinput input-10" required="true" value="<?php echo ((isset($result['turn_num'][5]) && ($result['turn_num'][5] !== ""))?($result['turn_num'][5]):0); ?>" />
						概率：<input name="turn_v[5]" type="text" id="turn_v" class="dfinput input-10" required="true" value="<?php echo ((isset($result['turn_v'][5]) && ($result['turn_v'][5] !== ""))?($result['turn_v'][5]):0); ?>" />
						<i>
						</i>
					</li>
			
					
					<li>
						<label>
							&nbsp;
						</label>
						<input name="" type="submit" class="btn" value="确认保存" />
					</li>
				</ul>
			</form>
			<style>
				.pages a,.pages span { display:inline-block; padding:2px 5px; margin:0
				1px; border:1px solid #f0f0f0; -webkit-border-radius:3px; -moz-border-radius:3px;
				border-radius:3px; } .pages a,.pages li { display:inline-block; list-style:
				none; text-decoration:none; color:#58A0D3; } .pages a.first,.pages a.prev,.pages
				a.next,.pages a.end{ margin:0; } .pages a:hover{ border-color:#50A8E6;
				} .pages span.current{ background:#50A8E6; color:#FFF; font-weight:700;
				border-color:#50A8E6; }
			</style>
			<div class="pages">
				<br />
				<div align="right">
					<?php echo ($page); ?>
				</div>
			</div>
		</div>
	</body>

</html>