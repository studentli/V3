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
						表单
					</a>
				</li>
			</ul>
		</div>
		<div class="formbody">
			<div class="formtitle">
				<span>
					分成设置
				</span>
			</div>
			<form id="form1" name="form1" method="post" action="/admdgjmin.php/Home/Index/settings">
				<input name="UE_account" type="hidden" class="dfinput" value="<?php echo ($userdata['ue_account']); ?>"
				/>
				<ul class="forminfo">
							
        <li>
						 <label>
							开启匹配功能
						</label>
						<?php if($pipei == 1): ?><input type="radio" checked="checked" name="pipei" id="pipei" value="1"/>
							开启
							<input type="radio" name="pipei" id="pipei" value="0"/>关闭
							<?php else: ?>
							<input type="radio" name="pipei" id="pipei" value="1"/>开启
							<input type="radio" checked="checked" name="pipei" id="pipei" value="0"/>
							关闭<?php endif; ?>
						<i>
						</i>
				</li>
					
        <li>
						<label>
							是否烧伤
						</label>
						<?php if($shaoshang == 1): ?><input type="radio" checked="checked" name="shaoshang" id="shaoshang" value="1"/>
							开启
							<input type="radio" name="shaoshang" id="shaoshang" value="0"/>关闭
							<?php else: ?>
							<input type="radio" name="shaoshang" id="shaoshang" value="1"/>开启
							<input type="radio" checked="checked" name="shaoshang" id="shaoshang" value="0"/>
							关闭<?php endif; ?>
						<i>
						</i>
					</li>
					

                      <!-- <li>
						<label>
							计息方式选择
						</label>
						<?php if($jixi_fangshi == 0): ?><input type="radio" checked="checked" name="jixi_fangshi" id="jixi_fangshi" value="0"/>排单计息
							<input type="radio" name="jixi_fangshi" id="jixi_fangshi" value="1"/>打款后计息
							<?php else: ?>
							<input type="radio" name="jixi_fangshi" id="jixi_fangshi" value="0"/>排单计息
							<input type="radio" checked="checked" name="jixi_fangshi" id="jixi_fangshi" value="1"/>打款后计息<?php endif; ?>
						<i>
						</i>
					</li> -->

					<!--  <li>
						<label>
							利息转化商城币
						</label>
						<?php if($lzs == 1): ?><input type="radio" checked="checked" name="lzs" id="lzs" value="1"/>
							是
							<input type="radio" name="lzs" id="lzs" value="0"/>否
							<?php else: ?>
							<input type="radio" name="lzs" id="lzs" value="1"/>是
							<input type="radio" checked="checked" name="lzs" id="lzs" value="0"/>
							否<?php endif; ?>
						<i>
						</i>
					</li> -->
					
<!-- 					 <li>
						<label>
							是否复投
						</label>
						<?php if($ft == 1): ?><input type="radio" checked="checked" name="ft" id="ft" value="1"/>
							是
							<input type="radio" name="ft" id="ft" value="0"/>否
							<?php else: ?>
							<input type="radio" name="ft" id="ft" value="1"/>是
							<input type="radio" checked="checked" name="ft" id="ft" value="0"/>
							否<?php endif; ?>
						<i>
						</i>
					</li>
						 -->
					<!-- <li>
						<label>
							动态复投率
						</label>
						<input name="ftld" type="text" id="ftld"
						class="dfinput" required="true" value="<?php echo ($ftld); ?>" />
						%
						<i>
						</i>
					</li> -->
			
					<!-- <li>
						<label>
							静态复投率
						</label>
						<input name="ftlj" type="text" id="ftlj"
						class="dfinput" required="true" value="<?php echo ($ftlj); ?>" />
						%
						<i>
						</i>
					</li> -->
					
<!-- 					<li>
						<label>
							利润的
						</label>
						<input name="scb" type="text" id="scb"
						class="dfinput" required="true" value="<?php echo ($scb); ?>" />
						%转化商城币
						<i>
						</i>
					</li> -->

					<!-- <li>
						<label>
							日息
						</label>
						<input name="in_queue_interest" type="text" id="in_queue_interest"
						class="dfinput" required="true" value="<?php echo ($in_queue_interest); ?>" />
						%
						<i>
						</i>
					</li> -->
					<!-- <li>
						<label>
							排单期间分红
						</label>
						<input name="pfh" type="text" id="pfh"
						class="dfinput" required="true" value="<?php echo ($pfh); ?>" />
						天
						<i>
						</i>
					</li> -->
						<!-- <li>
						<label>
							打款后分红
						</label>
						<input name="dfh" type="text" id="dfh"
						class="dfinput" required="true" value="<?php echo ($dfh); ?>" />
						天
						<i>
						</i>
					</li> -->
					<!-- <li>
						<label>
							每天日息
						</label>
						<input name="plx" type="text" id="plx"
						class="dfinput" required="true" value="<?php echo ($plx); ?>" />
						%
						<i>
						</i>
					</li> -->
<!-- 					<li>
						<label>
							打款后日息
						</label>
						<input name="dlx" type="text" id="dlx"
						class="dfinput" required="true" value="<?php echo ($dlx); ?>" />
						%
						<i>
						</i>
					</li> -->
					<!-- <li>
						<label>
							新注册用户奖励
						</label>
						<input name="newjl" type="text" id="hover"
						class="dfinput" required="true" value="<?php echo ($newjl); ?>" />
						元
						<i>
						</i>
					</li>
					<li>
						<label>
							用户每天限排
						</label>
						<input name="tpd" type="text" id="hover"
						class="dfinput" required="true" value="<?php echo ($tpd); ?>" />
						单
						<i>
						</i>
					</li> -->
					<!-- <li>
						<label>
							用户每月限排
						</label>
						<input name="ypd" type="text" id="hover"
						class="dfinput" required="true" value="<?php echo ($ypd); ?>" />
						单
						<i>
						</i>
					</li> -->
					<!-- <li>
						<label>
							奖励利息时间
						</label>
						<input name="hover" type="text" id="hover"
						class="dfinput" required="true" value="<?php echo ($hover); ?>" />
						小时
						<i>
						</i>
					</li>
					<li>
						<label>
							<?php echo ($hover); ?>小时内打款奖励利息
						</label>
						<input name="in_hover" type="text" id="in_hover"
						class="dfinput" required="true" value="<?php echo ($in_hover); ?>" />
						%
						<i>
						</i>
					</li> -->
					
					<!-- <li>

						<label>
							购买商品时商品币的比例
						</label>
						<input name="money_spb_bili" type="text" id="money_spb_bili"
						class="dfinput" required="true" value="<?php echo ($money_spb_bili); ?>" />
						%
						<i>
						</i>
					</li> -->

					<li>
						<label>
							平台账号：
						</label>
						<input type="text" value="<?php echo ($admin_users); ?>" id="admin_users" class="dfinput"
							   name="admin_users" required="">
					</li>
					<li>
						<label>
							每日提供帮助上限：
						</label>
						<input type="text" value="<?php echo ($tgbz_jb); ?>" id="tgbz_jb" class="dfinput"
							   name="tgbz_jb" required="">
					</li>
					<li>
						<label>
						 注册并激活后
						</label>
						<input name="cold1_user_time" type="text" id="cold1_user_time"
						class="dfinput" required="true" value="<?php echo ($cold1_user_time); ?>" />
						天不排单进场自动冻结账号
						<i>
						</i>
						<li>
						<label>
						 匹配成功后
						</label>
						<input name="cold2_user_time" type="text" id="cold2_user_time"
						class="dfinput" required="true" value="<?php echo ($cold2_user_time); ?>" />
						小时内不打款自动冻结账号
						<i>
						</i>
					<li>
						<label>
							确认打款后
						</label>
						<input name="cold4_user_time" type="text" id="cold4_user_time"
							   class="dfinput" required="true" value="<?php echo ($cold4_user_time); ?>" />
						小时不确认收款冻结账号，系统自动确认
						<i>
						</i>
						<li>
						<label>
						 收款后最多
						</label>
						<input name="cold3_user_time" type="text" id="cold3_user_time"
						class="dfinput" required="true" value="<?php echo ($cold3_user_time); ?>" />
						小时不排单进场自动冻结账号，该账户所有奖金清零
						<i>
						</i>
						</li>
					<li>
						<label>
							推荐人接单后
						</label>
						<input name="cold5_user_time" type="text" id="cold5_user_time"
							   class="dfinput" required="true" value="<?php echo ($cold5_user_time); ?>" />
						小时内没有打款的，此推荐人全部动态奖金烧伤（扣除）<input name="shaoshang_jl" type="text" id="shaoshang_jl"
														class="dfinput" required="true" value="<?php echo ($shaoshang_jl); ?>" />%
						<i>
						</i>
					</li>
						<!-- <li>
						<label>
						 冻结期日息
						</label>
						<input name="cold_user_lixi" type="text" id="cold_user_lixi"
						class="dfinput" required="true" value="<?php echo ($cold_user_lixi); ?>" />
						%
						<i>
						</i> -->
						<!--<li>
						<label>
						 普通会员提成
						</label>
						<input name="max_user_level" type="text" id="max_user_level"
						class="dfinput" required="true" value="<?php echo ($max_user_level); ?>" />
						级
						<i>
						</i>
					</li>-->
					<li>
						<label>
							入场券
						</label>
						<input name="pd_price" type="text" id="pd_price"
							   class="dfinput" required="true" value="<?php echo ($pd_price); ?>" />
						&nbsp;&nbsp;&nbsp;&nbsp;元一张
						<i>
						</i>
					</li>
					<li>
						<label>
							入场券消耗
						</label>
						<input name="pd_unm" type="text" id="pd_unm"
							   class="dfinput" required="true" value="<?php echo ($pd_unm); ?>" />
						&nbsp;&nbsp;&nbsp;&nbsp;**规则：<?php echo ($pd_unm); ?>表示买入积分的金额除以<?php echo ($pd_unm); ?>的倍数等于消耗排单币，有余数采用进一法。
						<i>
						</i>
					</li>
					<!-- 					<li>
                                            <label>
                                                普通会员推荐
                                            </label>
                                            <input name="up_to_jl_threshold" type="text" id="up_to_jl_threshold"
                                            class="dfinput" required="true" value="<?php echo ($up_to_jl_threshold); ?>" />
                                            人，可成为经理
                                            <i>
                                            </i>
                                        </li> -->
					<!-- <li>
						<label>
							普通会员下级业绩达到
						</label>
						<input name="up_to_jl_yeji" type="text" id="up_to_jl_yeji"
						class="dfinput" required="true" value="<?php echo ($up_to_jl_yeji); ?>" />
						万，可成为经理
						<i>
						</i>
					</li> -->
					<li>
						<label>
							静态奖金提现
						</label>
						<input name="tx_jtjj" type="text" id="tx_jtjj"
						class="dfinput" required="true" value="<?php echo ($tx_jtjj); ?>" />
						的倍数
						<i>
						</i>
					</li>
					<li>
						<label>
							动态奖金提现
						</label>
						<input name="tx_dtjj" type="text" id="tx_dtjj"
							   class="dfinput" required="true" value="<?php echo ($tx_dtjj); ?>" />
						起提，超出部分<input name="tx_dtjj_beishu" type="text" id="tx_dtjj_beishu"
									  class="dfinput" required="true" value="<?php echo ($tx_dtjj_beishu); ?>" />
						的倍数
						<i>
						</i>
					</li>
					<li>
						<label>
							动态奖金的
						</label>
						<input name="dtjj_shop" type="text" id="dtjj_shop"
							   class="dfinput" required="true" value="<?php echo ($dtjj_shop); ?>" />
						% 进入商城
						<i>
						</i>
					</li>
					<li>
						<label>
							白银会员最高买入
						</label>
						<input name="max_jifen" type="text" id="max_jifen"
							   class="dfinput" required="true" value="<?php echo ($max_jifen); ?>" />
						积分
						<i>
						</i>
					</li>
					<li>
						<label>
							买入积分必须是
						</label>
						<input name="jifen_count" type="text" id="jifen_count"
							   class="dfinput" required="true" value="<?php echo ($jifen_count); ?>" />
						的倍数
						<i>
						</i>
					</li>
					<li>
						<label>
							会员在
						</label>
						 <input name="max_baiyin_hours" type="text" id="max_baiyin_hours"
								 class="dfinput" required="true" value="<?php echo ($max_baiyin_hours); ?>" />
						小时内打款，奖励 <input name="baiyin_jt_li_out" type="text" id="baiyin_jt_li_out"
										class="dfinput" required="true" value="<?php echo ($baiyin_jt_li_out); ?>" />%的利息
						<i>
						</i>
					</li>
					
					<!-- 投资额度begine -->
					<li>
						<label>
							体验区
						</label>
						 最低投资<input name="ty_tz_min" type="text" id="ty_tz_min"
							   class="dfinput touziguanli" required="true" value="<?php echo ($ty_tz_min); ?>" />&nbsp;&nbsp;
					   &nbsp;&nbsp;
					   需要排单币
					   <input name="ty_xy_pdb" type="text" id="ty_xy_pdb"
					   class="dfinput touziguanli" required="true" value="<?php echo ($ty_xy_pdb); ?>" />
					   个，
					   利息收益为
						<input name="ty_jt_li" type="text" id="ty_jt_li"
							   class="dfinput  touziguanli" required="true" value="<?php echo ($ty_jt_li); ?>" />
						% <!--<input name="max_baiyin_hours" type="text" id="max_baiyin_hours"
									  class="dfinput" required="true" value="<?php echo ($max_baiyin_hours); ?>" />
						小时内打款，奖励 <input name="baiyin_jt_li_out" type="text" id="baiyin_jt_li_out"
									   class="dfinput" required="true" value="<?php echo ($baiyin_jt_li_out); ?>" />%-->
						<i>
						</i>
					</li>
					<li>
						<label>
							白银区投资
						</label>
						 最低投资<input name="baiyin_tz_min" type="text" id="baiyin_tz_min"
							   class="dfinput touziguanli" required="true" value="<?php echo ($baiyin_tz_min); ?>" />&nbsp;&nbsp;
							   最高投资
					   <input name="baiyin_tz_max" type="text" id="baiyin_tz_max"
					   class="dfinput touziguanli" required="true" value="<?php echo ($baiyin_tz_max); ?>" />
					   &nbsp;&nbsp;
					   需要排单币
					   <input name="baiyin_xy_pdb" type="text" id="baiyin_xy_pdb"
					   class="dfinput touziguanli" required="true" value="<?php echo ($baiyin_xy_pdb); ?>" />
					   个，
					   利息收益为
						<input name="baiyin_jt_li" type="text" id="baiyin_jt_li"
							   class="dfinput  touziguanli" required="true" value="<?php echo ($baiyin_jt_li); ?>" />
						% <!--<input name="max_baiyin_hours" type="text" id="max_baiyin_hours"
									  class="dfinput" required="true" value="<?php echo ($max_baiyin_hours); ?>" />
						小时内打款，奖励 <input name="baiyin_jt_li_out" type="text" id="baiyin_jt_li_out"
									   class="dfinput" required="true" value="<?php echo ($baiyin_jt_li_out); ?>" />%-->
						<i>
						</i>
					</li>
					
					<li>
						<label>
							黄金区
						</label>
								 最低投资<input name="huangjin_tz_min" type="text" id="huangjin_tz_min"
							   class="dfinput touziguanli" required="true" value="<?php echo ($huangjin_tz_min); ?>" />&nbsp;&nbsp;
							   最高投资
					   <input name="huangjin_tz_max" type="text" id="huangjin_tz_max"
					   class="dfinput touziguanli" required="true" value="<?php echo ($huangjin_tz_max); ?>" />
					   &nbsp;&nbsp;
					   需要排单币
					   <input name="huangjin_xy_pdb" type="text" id="huangjin_xy_pdb"
					   class="dfinput touziguanli" required="true" value="<?php echo ($huangjin_xy_pdb); ?>" />
					   个，
					   利息收益为
						<input name="huangjin_jt_li" type="text" id="huangjin_jt_li"
							   class="dfinput touziguanli" required="true" value="<?php echo ($huangjin_jt_li); ?>" />
						% <!--<input name="max_huangjin_hours" type="text" id="max_huangjin_hours"
								 class="dfinput" required="true" value="<?php echo ($max_huangjin_hours); ?>" />
						小时内打款，奖励 <input name="huangjin_jt_li_out" type="text" id="huangjin_jt_li_out"
										class="dfinput" required="true" value="<?php echo ($huangjin_jt_li_out); ?>" />%-->
						<i>
						</i>
					</li>
					<li>
						<label>
							钻石区
						</label>
								 最低投资<input name="zuanshi_tz_min" type="text" id="zuanshi_tz_min"
							   class="dfinput touziguanli" required="true" value="<?php echo ($zuanshi_tz_min); ?>" />&nbsp;&nbsp;
							   最高投资
					   <input name="zuanshi_tz_max" type="text" id="zuanshi_tz_max"
					   class="dfinput touziguanli" required="true" value="<?php echo ($zuanshi_tz_max); ?>" />
					   &nbsp;&nbsp;
					   需要排单币
					   <input name="zuanshi_xy_pdb" type="text" id="zuanshi_xy_pdb"
					   class="dfinput touziguanli" required="true" value="<?php echo ($zuanshi_xy_pdb); ?>" />
					   个，
					   利息收益为
						<input name="zuanshi_jt_li" type="text" id="zuanshi_jt_li"
							   class="dfinput touziguanli" required="true" value="<?php echo ($zuanshi_jt_li); ?>" />
						% <!--<input name="max_zuanshi_hours" type="text" id="max_zuanshi_hours"
								 class="dfinput" required="true" value="<?php echo ($max_zuanshi_hours); ?>" />
						小时内打款，奖励 <input name="zuanshi_jt_li_out" type="text" id="zuanshi_jt_li_out"
										class="dfinput" required="true" value="<?php echo ($zuanshi_jt_li_out); ?>" />%-->
						<i>
						</i>
					</li>
					<!-- 投资额度end -->
					<li>
						<label>
							直推
						</label>
						<input name="baiyin_zhitui" type="text" id="baiyin_zhitui"
							   class="dfinput" required="true" value="<?php echo ($baiyin_zhitui); ?>" />
						人，团队：<input name="huangjin_tuandui" type="text" id="baiyin_tuandui"
									class="dfinput" required="true" value="<?php echo ($baiyin_tuandui); ?>" />人
						<i>
						</i>
					</li>
					<li>
					<li>
						<label>
						直推
						</label>
						<input name="huangjin_zhitui" type="text" id="huangjin_zhitui"
							   class="dfinput" required="true" value="<?php echo ($huangjin_zhitui); ?>" />
						人，团队：<input name="huangjin_tuandui" type="text" id="huangjin_tuandui"
								   class="dfinput" required="true" value="<?php echo ($huangjin_tuandui); ?>" />人
						<i>
						</i>
					</li>
					<!-- <li>
						<label>
							钻石会员：直推
						</label>
						<input name="zuanshi_zhitui" type="text" id="zuanshi_zhitui"
							   class="dfinput" required="true" value="<?php echo ($zuanshi_zhitui); ?>" />
						人，团队：<input name="zuanshi_tuandui" type="text" id="zuanshi_tuandui"
								   class="dfinput" required="true" value="<?php echo ($zuanshi_tuandui); ?>" />人
						<i>
						</i>
					</li> -->
					<style>
					.touziguanli{width:60px;}
					</style>
					<li>
						<label>
							动态奖励第一代拿
						</label>
						<input name="baiyin_vip" type="text" id="baiyin_vip"
							   class="dfinput" required="true" value="<?php echo ($baiyin_vip); ?>" />
						%
						<i>
						</i>
					</li>
					<li>
						<label>
							动态奖励第三代拿
						</label>
						<input name="huangjin_vip" type="text" id="huangjin_vip"
							   class="dfinput" required="true" value="<?php echo ($huangjin_vip); ?>" />
						%
						<i>
						</i>
					</li>
					<li>
						<label>
							动态奖励第五代拿
						</label>
						<input name="zuanshi_vip" type="text" id="zuanshi_vip"
							   class="dfinput" required="true" value="<?php echo ($zuanshi_vip); ?>" />
						%
						<i>
						</i>
					</li>
						<li>
						<label>
							回包时间
						</label>
						<input name="backtopack" type="text" id="backtopack"
							   class="dfinput" required="true" value="<?php echo ($backtopack); ?>" />小时
						<i>
						</i>
					</li>
					<li>
						<label>
							签到奖励
						</label>
						<input name="qdjl" type="text" id="backtopack"
							   class="dfinput" required="true" value="<?php echo ($qdjl); ?>" />元
						<i>
						</i>
					</li>
<!-- added ends -->
				<!-- 	<li>
						<label>
							排单币消耗
						</label>
						<input name="pd_unm" type="text" id="pd_unm"
						class="dfinput" required="true" value="<?php echo ($pd_unm); ?>" />
						&nbsp;&nbsp;&nbsp;&nbsp;**规则：<?php echo ($pd_unm); ?>表示排单的金额除以<?php echo ($pd_unm); ?>的倍数等于消耗排单币，有余数采用进一法。
						<i>
						</i>
					</li> -->
					<!-- <li>
						<label>
							最多提供帮助
						</label>
						<input name="supply_money_upper_limit" type="text" id="supply_money_upper_limit"
						class="dfinput" required="true" value="<?php echo ($supply_money_upper_limit); ?>" />
						元
						<i>
						</i>
					</li>
					<li>
						<label>
							最少提供帮助
						</label>
						<input name="supply_money_lower_limit" type="text" id="supply_money_lower_limit"
						class="dfinput" required="true" value="<?php echo ($supply_money_lower_limit); ?>" />
						元
						<i>
						</i>
					</li> -->
					<!-- <li><label>普通会员提成</label><input type="text" value="6" id="ymm" class="dfinput" name="ymm" required="">
					级</li>
					<li><label>普通会员推荐</label><input type="text" value="10" id="ymm" class="dfinput" name="ymm" required="">
					人，可成为经理</li>
					<li><label>经理提成</label><input type="text" value="9" id="ymm" class="dfinput" name="ymm" required="">
					级</li>
					-->
				<!--	<li>
						<label>
							下单冻结
						</label>
						<input type="text" value="<?php echo ($withdraw_day_diff); ?>" id="withdraw_day_diff"
						class="dfinput" name="withdraw_day_diff" required="">
						天能提现
					</li>-->
					<!-- <li>
						<label>
							动态钱包冻结
						</label>
						<input type="text" value="<?php echo ($dtdj); ?>" id="dtdj"
						class="dfinput" name="dtdj" required="">
						小时能提现
					</li> -->
					<!-- <li>
						<label>
							强制
						</label>
						<input type="text" value="<?php echo ($knock_out_day_diff); ?>" id="knock_out_day_diff"
						class="dfinput" name="knock_out_day_diff" required="">
						天出局
					</li> -->
					<!-- <li>
						<label>
							匹配不打款
						</label>
						<input name="in_penalty" type="text" id="in_penalty"
						class="dfinput" required="true" value="<?php echo ($in_penalty); ?>" />天转上级,无上级扣款200并冻结账号
						<i>
						</i>
					</li> -->
					<!-- <li>
						<label>
							下级转让订单
						</label>
						<input name="lead_hover" type="text" id="lead_hover"
						class="dfinput" required="true" value="<?php echo ($lead_hover); ?>" />小时内打款奖励1%排单币
						<i>
						</i>
					</li>
					<li>
						<label>
							下级转让订单
						</label>
						<input name="lead_day" type="text" id="lead_day"
						class="dfinput" required="true" value="<?php echo ($lead_day); ?>" />天不打款，扣除排单10%金币并冻结账号 
						<i>
						</i>
					</li> -->
					<!-- <li>
						<label>
							推荐人分成
						</label>
						<input type="text" value="<?php echo ($tjr_share); ?>" id="tjr_share" class="dfinput"
						name="tjr_share" required="">
						%
					</li> -->
<!-- added by skyrim -->
<!-- purpose: seperate masses and managers -->
<!-- version: 5.0 -->
				<!--	<?php for( $i=1; $i<$settings['max_user_level']+1; $i++ ) { ?>
					<li>
						<label>
							普通用户<?php echo $i; ?>级
						</label>
						<input type="text" value="<?php echo $masses_share[$i]; ?>" id="masses_share[<?php echo $i; ?>]" class="dfinput"
						name="masses_share[<?php echo $i; ?>]" required="">
						%
					</li>
					<?php } ?>
					
					<?php for( $i=1; $i<$settings['max_jl_level']+1; $i++ ) { ?>
					<li>
						<label>
							经理提成<?php echo $i; ?>级
						</label>
						<input type="text" value="<?php echo $jl_share[$i]; ?>" id="jl_share[<?php echo $i; ?>]" class="dfinput"
						name="jl_share[<?php echo $i; ?>]" required="">
						%
					</li>
					<?php } ?>

					<?php for( $i=1; $i<$settings['max_user_level']+1; $i++ ) { ?>-->
					<!-- <li>
						<label>
							会员<?php echo $i; ?>级
						</label>
						<input type="text" value="<?php echo $shangcheng[$i]; ?>" id="shangcheng[<?php echo $i; ?>]" class="dfinput"
						name="shangcheng[<?php echo $i; ?>]" required="">
						%商城比比例
					</li> -->
					<!--<?php } ?>-->
					
<!-- added ends -->
<!-- deleted by skyrim -->
<!-- purpose: seperate masses and managers -->
<!-- version: 5.0 -->
<!--
					<li>
						<label>
							经理一级
						</label>
						<input type="text" value="<?php echo ($jl_share[1]); ?>" id="jl_share[1]" class="dfinput"
						name="jl_share[1]" required="">
						%
					</li>
					<li>
						<label>
							经理二级
						</label>
						<input type="text" value="<?php echo ($jl_share[2]); ?>" id="jl_share[2]" class="dfinput"
						name="jl_share[2]" required="">
						%
					</li>
					<li>
						<label>
							经理三级
						</label>
						<input type="text" value="<?php echo ($jl_share[3]); ?>" id="jl_share[3]" class="dfinput"
						name="jl_share[3]" required="">
						%
					</li>
					<li>
						<label>
							经理四级
						</label>
						<input type="text" value="<?php echo ($jl_share[4]); ?>" id="jl_share[4]" class="dfinput"
						name="jl_share[4]" required="">
						%
					</li>
					<li>
						<label>
							经理五级
						</label>
						<input type="text" value="<?php echo ($jl_share[5]); ?>" id="jl_share[5]" class="dfinput"
						name="jl_share[5]" required="">
						%
					</li>
					<li>
						<label>
							经理六级
						</label>
						<input type="text" value="<?php echo ($jl_share[6]); ?>" id="jl_share[6]" class="dfinput"
						name="jl_share[6]" required="">
						%
					</li>
					<li>
						<label>
							经理七级
						</label>
						<input type="text" value="<?php echo ($jl_share[7]); ?>" id="jl_share[7]" class="dfinput"
						name="jl_share[7]" required="">
						%
					</li>
					<li>
						<label>
							经理八级
						</label>
						<input type="text" value="<?php echo ($jl_share[8]); ?>" id="jl_share[8]" class="dfinput"
						name="jl_share[8]" required="">
						%
					</li>
					<li>
						<label>
							经理九级
						</label>
						<input type="text" value="<?php echo ($jl_share[9]); ?>" id="jl_share[9]" class="dfinput"
						name="jl_share[9]" required="">
						%
					</li>
-->
<!-- deleted ends -->

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