<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0022) -->
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="/cssmmm/jquery.min.js"></script>
    <script src="/cssmmm/jquery-ui.min.js"></script>
    <script src="/cssmmm/jquery.slimscroll.min.js"></script>
    <script src="/cssmmm/bootstrap.min.js"></script>
    <script src="/cssmmm/jquery.flot.js"></script>
    <script src="/cssmmm/jquery.flot.resize.js"></script>
    <script src="/cssmmm/jquery.flot.pie.js"></script>
    <script src="/cssmmm/curvedLines.js"></script>
    <script src="/cssmmm/index.js"></script>
    <script src="/cssmmm/metisMenu.min.js"></script>
    <script src="/cssmmm/icheck.min.js"></script>
    <script src="/cssmmm/jquery.peity.min.js"></script>
    <script src="/cssmmm/index(1).js"></script>
    <script src="/cssmmm/sweet-alert.min.js"></script>
    <script src="/cssmmm/toastr.min.js"></script>
    <script src="/cssmmm/jquery.countdown.min.js"></script>
    <!--导航-->
    <!-- <script type="text/javascript" src="/cssmmm/SuperSlide.2.1.js"></script> -->

    <!--客服QQ-->
    <link href="/css/sucaijiayuan.css" rel="stylesheet" type="text/css" />
    <link href="/css/ind.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/js/jquery.hhService.js"></script>
    <script type="text/javascript">
        $(function () { $("#hhService").fix({ float: 'right', minStatue: false, skin: 'green', durationTime: 300 }) });
    </script>


    <!-- App scripts -->
    <script src="/cssmmm/homer.js"></script>
    <script src="/cssmmm/alert.js"></script>
    <script src="/cssmmm/charts.js"></script>
    <script type="text/javascript" src="/cssmmm/socket.io.js"></script>
    <!-- Page title -->
    <title>V3财富</title>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <!-- Vendor styles -->
    <link rel="stylesheet" href="/assets/vendor/fontawesome/css/font-awesome.css">
    <link rel="stylesheet" href="/assets/vendor/metisMenu/dist/metisMenu.css">
    <link rel="stylesheet" href="/assets/vendor/animate.css/animate.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/vendor/sweetalert/lib/sweet-alert.css">
    <link rel="stylesheet" href="/assets/vendor/toastr/build/toastr.min.css">


    <!-- App styles -->
    <!--  <link rel="stylesheet" href="/assets/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="/assets/fonts/pe-icon-7-stroke/css/helper.css"> -->
    <link rel="stylesheet" href="/assets/styles/style.css">
    <script type="text/javascript">
        function ReImgSize() {
            for (j = 0; j < document.images.length; j++) {
                document.images[j].width = (document.images[j].width > 420) ? "420" : document.images[j].width;
            }
        }
    </script>

</head>


<body class="blank" style="position: relative;min-width: 320px;max-width: 650px;margin: auto;">
    <div class="top">
        <div class="top_nav">
            <small class="text-muted">V3财富<span>·</span>惠民商城</small>
            <div class="right_button">
                <h1>
                    <img src="/cssmmm/clo.png" alt="">
                    <input name="" type="button" value="">
                </h1>
                <h6>
                    <img src="/cssmmm/list.png" alt="">
                    <input name="" type="button" value="">
                </h6>
            </div>
            <div class="clr"></div>
        </div>
        <div class="two_nav" style="width:30%;margin-left:70%;display: none;border:none;">
            <div class="two_nav1">
                <div class="tuijian">
                    <a href="/Home/Index/home">
                        <h1>我的首页</h1>
                    </a>
                    <a href="/Home/Info/jifen">
                        <h1>积分互转</h1>
                    </a>
                    <a href="/Home/Reghub/censor">
                        <h1>待审核列表</h1>
                    </a>
                    <a href="/Home/Myuser/xzzh">
                        <h1>我的用户群</h1>
                    </a>
                    <!-- <a href="/Home/Turn/turn">
                        <h1>抽奖</h1>
                    </a> -->
                    <a href="/Home/Index/news">
                        <h1>新闻中心</h1>
                    </a>
                    <a href="/Home/Info/grsz">
                        <h1>个人资料</h1>
                    </a>
                    <a href="/Home/Info/xgmm">
                        <h1>修改密码</h1>
                    </a>
                    <a href="/Home/Info/cwmx">
                        <h1>财务管理</h1>
                    </a>
                    <a href="/Home/Myuser/lxwm">
                        <h1>联系我们</h1>
                    </a>
                    <a href="/Home/Login/logout">
                        <h1>退出</h1>
                    </a>
                </div>
            </div>
        </div>
    </div> 



    <!-- Main Wrapper -->
    <div  style="background-color:#fff;margin-top:66px;">

        <div class="content" style="padding:0 20px;">

            <div class="border_box">
                <div class="center" style="width:100%;">
            <div class="row" id="context" style="border-radius:6px;width:100%;overflow:hidden;margin-bottom:16px;margin:0 auto;">

                <div class="col-md-9" style="width:100%;float:none;padding: 0;">
                    <div class="hpanel">
                        <div class="panel-body list" style="margin-top:16px; border: 1px solid #ccc;padding:0;">
                            <div class="project-list">
                                <div style="width:100%;border-radius:6px 6px 0 0;background:#AC1818;color:#fff;padding-left:10px;line-height:36px;font-size:16px;height:36px;">交易信息</div>
                                <div style="width:100%;overflow-x: scroll;text-align: center;">
<table class="table table-striped" style="width:100%;overflow-x: scroll;">
  <tbody>
    <?php if(is_array($list3)): foreach($list3 as $key=>$v3): ?><!--隐藏交易成功的信息-->
      <?php if($v3['zt'] != 2 ): ?><tr style="background-color: #f2f2f2;">
          <td>
            <div style="width:80px;margin:0;">
              <?php if($v3["zt"] == 0): ?><img src="/cssmmm/zt1.jpg"><?php endif; ?>
              <?php if($v3["zt"] == 1): ?><img src="/cssmmm/zt2.jpg"><?php endif; ?>
              <?php if($v3["zt"] == 2): ?><img src="/cssmmm/zt3.jpg"><?php endif; ?>
            
            <p style="width:80px;margin:0;margin-top: 5px;">
              <strong>R<?php echo ($v3["id"]); ?></strong></p>
              </div>
          </td>
          <td>
           <div style="width:80px;">
                 <p style="margin:0;">匹配状态</p>(
            <?php if($v3["zt"] == 0): ?>待付款<?php endif; ?>
            <?php if($v3["zt"] == 1): ?>已付款<?php endif; ?>
            <?php if($v3["zt"] == 2): ?>交易成功<?php endif; ?>)
            </div>
            </td>
          <td>
              <div style="width:240px;text-align: left;
}">
                 <p style="margin:0;">卖出积分(G<?php echo ($v3["g_id"]); ?>)</p>
            <div>
              配对时间：<?php echo ($a1=$v3["date"]); ?>
              <div style="display: none"><?php echo ($aab=$v3["p_user"]); ?></div>
              </div>
            <?php if($v3["zt"] == 0): ?><div>
                到期打款时间：<?php echo ($aa1); ?>
                <div style="display: none"><?php echo ($aab=$v3["p_user"]); ?></div>
                </div>
              <div>
                倒计时：
                <span id="t_d<?php echo ($v3["id"]); ?>">00天</span>
                <span id="t_h<?php echo ($v3["id"]); ?>">00时</span>
                <span id="t_m<?php echo ($v3["id"]); ?>">00分</span>
                <span id="t_s<?php echo ($v3["id"]); ?>">00秒</span></div>
              <script>$(function() {
                 
                  setInterval("GetRTime('<?php echo ($v3["id"]); ?>','<?php echo (datedqsj_2($a1,$aa1)); ?>')", 1000);
                });</script><?php endif; ?>
            <?php if($v3["zt"] == 1): ?><div>
                汇款时间：<?php echo ($aa1=$v3["date_hk"]); ?>
                <div style="display: none"><?php echo ($aab=$v3["p_user"]); ?></div></div>
              <div>
                到期确认时间：<?php echo (datedqsj_1($aa1,$aaa1)); ?>
                <div style="display: none"><?php echo ($aab=$v3["p_user"]); ?></div></div>
              <div>
                倒计时：
                <span id="t_d<?php echo ($v3["id"]); ?>">00天</span>
                <span id="t_h<?php echo ($v3["id"]); ?>">00时</span>
                <span id="t_m<?php echo ($v3["id"]); ?>">00分</span>
                <span id="t_s<?php echo ($v3["id"]); ?>">00秒</span></div>
              <script>$(function() {
                  setInterval("GetRTime('<?php echo ($v3["id"]); ?>','<?php echo (datedqsj_1_2($a1,$aa1)); ?>')", 1000);
                });</script><?php endif; ?>
            </div>
          </td>
          <td><div style="width:60px;"><?php echo (cx_user($v3["p_user"])); ?></div></td>
          <td>
            <div style="width:80px;">
            <p style="marign:0;"><?php if($v3["zffs1"] == 1): ?>银行<?php endif; ?></p>
            <p style="marign:0;"><?php if($v3["zffs2"] == 1): ?>支付宝<?php endif; ?></p>
            <p style="marign:0;"><?php if($v3["zffs3"] == 1): ?>微信<?php endif; ?></p>
            </div>
          </td>
         
          <td>
          <div style="width:80px;">
             <p><?php echo ($v3["jb"]); ?>人民币</p>        
            <a href="/<?php echo ($v3["pic"]); ?>" target="_blank" style="width: 100%;">
             查看图片</a>
            <a href="/<?php echo ($v3["pic2"]); ?>" target="_blank" style="width: 100%;">
              查看图片</a>
              </div>
          </td>
          <td>
            <input style="width:80px;" name="btn1" id="btn3<?php echo ($v3["id"]); ?>" type="button" value=" 留　言 " class="btn btn-info btn-xs addmsg" data-toggle="modal" data-id="8802104" data-target="#myModal7" style="margin-bottom:5px;">
            
            <input style="width:80px;" name="btn1" id="btn4<?php echo ($v3["id"]); ?>" type="button" value="详细资料" class="btn_detail btn-primary btn-xs" data-toggle="modal" id="btn12" data-target="#myModal5" style="margin-bottom:5px;">
            
            <?php if(($v3["zt"]) == "1"): if(($v3["ts_zt"]) == "3"): ?>12小时未确认收款,
                <br/>已被投诉,请联系对
                <br/>方取消投诉!
                <?php else: ?>
                <input style="width:80px;" name="btn23" id="btn23<?php echo ($v3["id"]); ?>" type="button" value="确认收款" class="btn_detail btn-primary btn-xs" data-toggle="modal" data-target="#myModa23"><?php endif; ?></div>
              <script>$(function() {
                  $('#btn23<?php echo ($v3["id"]); ?>').click(function() {
                    $("#mainframe188", parent.document.body).attr("src", "/Home/Index/home_ddxx_gcz/id/<?php echo ($v3["id"]); ?>/"); 
                    $("#mainframe188").reload();
                  })
                })</script><?php endif; ?>
            <?php if($v3["zt"] == 0): ?><span <?php echo (datedqsj2($a1,$aa2)); ?>>
                <input style="width:120px;" name="btn23" id="btn23<?php echo ($v3["id"]); ?>" type="button" value="36小时未打款投诉" class="btn_detail btn-primary btn-xs" data-toggle="modal" data-target="#myModa23"></span>
              <script>$(function() {
                  $('#btn23<?php echo ($v3["id"]); ?>').click(function() {
                    $("#mainframe188", parent.document.body).attr("src", "/Home/Index/home_ddxx_g_wdk/id/<?php echo ($v3["id"]); ?>/"); 
                    $("#mainframe188").reload();
                  })
                })</script><?php endif; ?>
          </td>
        </tr>
        <script>$(function() {

            $('#btn4<?php echo ($v3["id"]); ?>').click(function() {
              $("#mainframe11", parent.document.body).attr("src", "/Home/Index/home_ddxx/id/<?php echo ($v3["id"]); ?>/"); $("#mainframe11").reload();
            })

            $('#btn3<?php echo ($v3["id"]); ?>').click(function() {
              $("#mainframe12", parent.document.body).attr("src", "/Home/Index/home_ddxx_ly/id/<?php echo ($v3["id"]); ?>/"); 
              $("#mainframe12").reload();
            })
          })</script><?php endif; endforeach; endif; ?>

    <?php if(is_array($list2)): foreach($list2 as $key=>$v2): if($v2['zt'] != 2 ): ?><tr style="background-color: #bfe5ff;">
          <td>
            <div style="width:80px;margin:0;">
              <?php if($v2["zt"] == 0): ?><img src="/cssmmm/zt1.jpg"><?php endif; ?>
              <?php if($v2["zt"] == 1): ?><img src="/cssmmm/zt2.jpg"><?php endif; ?>
              <?php if($v2["zt"] == 2): ?><img src="/cssmmm/zt3.jpg"><?php endif; ?>
            <p style="width:80px;margin:0;margin-top: 5px;">
              <strong>R<?php echo ($v2["id"]); ?></strong></p>
              </div>
            </td>
          <td>
          <div style="width:80px;">
                 <p style="margin:0;">匹配状态</p>
               (
            <?php if($v2["zt"] == 0): ?>待付款<?php endif; ?>
            <?php if($v2["zt"] == 1): ?>已付款<?php endif; ?>
            <?php if($v2["zt"] == 2): ?>交易成功<?php endif; ?>)
           </div>
            </td>
          <td>
           <div style="width:240px;text-align: left;
}">
                 <p style="margin:0;">买入积分：(P<?php echo ($v2["p_id"]); ?>)<p>
            <div>
              配对时间：<?php echo ($a1=$v2["date"]); ?>
              <div style="display: none"><?php echo ($aab=$v2["g_user"]); ?></div></div>
           
            <?php if($v2["zt"] == 0): ?><div>
               到期打款时间：<?php echo (datedqsj($a1,$aa1)); ?>
                <div style="display: none"><?php echo ($aab=$v3["p_user"]); ?></div></div>
              <div>
                倒计时：
                
                <span id="t_d<?php echo ($v2["id"]); ?>s">00天</span>
                <span id="t_h<?php echo ($v2["id"]); ?>s">00时</span>
                <span id="t_m<?php echo ($v2["id"]); ?>s">00分</span>
                <span id="t_s<?php echo ($v2["id"]); ?>s">00秒</span></div>
              <script>$(function() {
                  setInterval("GetRTime('<?php echo ($v2["id"]); ?>s','<?php echo (datedqsj_2($a1,$aa1)); ?>')", 1000);
                });</script><?php endif; ?>
            <?php if($v2["zt"] == 1): ?><div>
                汇款时间：<?php echo ($aa1=$v2["date_hk"]); ?>
                <div style="display: none"><?php echo ($aab=$v2["p_user"]); ?></div></div>
              
              <div>
                到期确认时间<?php echo (datedqsj_1($aa1,$aaa1)); ?>
                <div style="display: none"><?php echo ($aab=$v2["p_user"]); ?></div></div>
              
              <div>
                倒计时：
                
                <span id="t_d<?php echo ($v2["id"]); ?>s">00天</span>
                <span id="t_h<?php echo ($v2["id"]); ?>s">00时</span>
                <span id="t_m<?php echo ($v2["id"]); ?>s">00分</span>
                <span id="t_s<?php echo ($v2["id"]); ?>s">00秒</span></div>
              <script>$(function() {
                
                  setInterval("GetRTime('<?php echo ($v2["id"]); ?>s','<?php echo (datedqsj_1_2($a1,$aa1)); ?>')", 1000);
                });</script><?php endif; ?>
            </div>
          </td>
          <td>
          <div style="width:80px;">
            <p style="marign:0;"><?php if($v2["zffs1"] == 1): ?>银行<?php endif; ?></p>
            <p style="marign:0;"><?php if($v2["zffs2"] == 1): ?>支付宝<?php endif; ?></p>
            <p style="marign:0;"><?php if($v2["zffs3"] == 1): ?>微信<?php endif; ?></p>
            </div>
            </td>
          <td>
          <div style="width:80px;">
          <p><?php echo ($v2["jb"]); ?>人民币</p>          
            <a href="/<?php echo ($v2["pic2"]); ?>" target="_blank" style="width:100%;">
             查看图片</a>
            <a href="/<?php echo ($v2["pic"]); ?>" target="_blank" style="width:100%;">
              查看图片</a>
              </div>
              </td>
          <td><div style="width:60px;"><?php echo (cx_user($v2["g_user"])); ?></div></td>
          <td>
            <input style="width:80px;" name="btn2" id="btn2<?php echo ($v2["id"]); ?>" type="button" value="留　言" class="btn btn-info btn-xs addmsg" data-toggle="modal" data-id="8802104" data-target="#myModal7" style="margin-bottom:5px;">
            
            <input style="width:80px;" name="btn" id="btn<?php echo ($v2["id"]); ?>" type="button" value="详细资料" class="btn_detail btn-primary btn-xs" data-toggle="modal" data-target="#myModal5" style="margin-bottom:5px;">
            
            <?php if($v2["zt"] == '0'): if($v2["ts_zt"] == '1'): ?>12小时未汇款
                <br>请联系对方取
                <br>消投诉!
                <?php else: ?>
                <input style="width:80px;" name="btn3" id="btn33<?php echo ($v2["id"]); ?>" type="button" value="确认已付款" class="btn_detail btn-primary btn-xs" data-toggle="modal" data-target="#myModa24">
                <script>
                $(function() {
                    $('#btn33<?php echo ($v2["id"]); ?>').click(function() {
                      $("#mainframe13", parent.document.body).attr("src", "/Home/Index/home_ddxx_pcz/id/<?php echo ($v2["id"]); ?>/"); $("#mainframe13").reload();
                    })
                  })</script><?php endif; endif; ?>
            <?php if($v2["zt"] == 1): if($v2["ts_zt"] == '2'): ?>你已被对方投诉请与
                <br>对方取得联系!
                <?php else: ?>
                <span <?php echo (datedqsj3($aa1,$aa2)); ?>>
                  <input style="width:120px;" name="btn3" id="btn33<?php echo ($v2["id"]); ?>" type="button" value="480小时未确认投诉" class="btn_detail btn-primary btn-xs" data-toggle="modal" data-target="#myModa24"></span>
                <script>
                  $(function() {
                    $('#btn33<?php echo ($v2["id"]); ?>').click(function() {
                      $("#mainframe13", parent.document.body).attr("src", "/Home/Index/home_ddxx_g_wqr/id/<?php echo ($v2["id"]); ?>/"); $("#mainframe13").reload();
                    })
                  })
                </script><?php endif; endif; ?>
          </td>
        </tr>
        <script>$(function() {

            $('#btn<?php echo ($v2["id"]); ?>').click(function() {
              $("#mainframe11", parent.document.body).attr("src", "/Home/Index/home_ddxx/id/<?php echo ($v2["id"]); ?>/"); $("#mainframe11").reload();
            })

            $('#btn2<?php echo ($v2["id"]); ?>').click(function() {
                console.log(111)
              $("#mainframe12", parent.document.body).attr("src", "/Home/Index/home_ly/id/<?php echo ($v2["id"]); ?>/");
              $("#mainframe12").reload();
            })

          })
        </script><?php endif; endforeach; endif; ?>
</tbody>
</table>
</div>
                        </div>
                    </div>
                </div>
            </div>




                </div>




            </div>

        </div>

        <!--gethelp modal end-->


        <script>
                                                $(function () {

                                                    $('.time_countdown').each(function () {
                                                        var $this = $(this);
                                                        var time = $this.data('time') + '';




                                                        var y = time.split(' ');
                                                        var ys = y[0].split('-');

                                                        var sd = y[1].split(':');

                                                        for (var i = 0; i < sd.length; i++) {
                                                            ys.push(sd[i]);
                                                        };

                                                        console.log(ys);

                                                        var datez = new Date(ys[0], ys[1], ys[2], ys[3], ys[4], ys[5]).getTime();
                                                        //datez = datez+172800000;


                                                        var date = new Date(datez);
                                                        Y = date.getFullYear() + '/';
                                                        M = date.getMonth() + '/';
                                                        D = date.getDate() + ' ';
                                                        h = date.getHours() + ':';
                                                        m = date.getMinutes() + ':';
                                                        s = date.getSeconds();

                                                        dates = Y + M + D + h + m + s;
                                                        console.log(Y + M + D + h + m + s + '.......');

                                                        $this.countdown(dates, function (event) {


                                                            $(this).text(
                                                                event.strftime('%-D 天 %-H 小时 %M 分钟 %S 秒')
                                                            );
                                                        });

                                                        datez = null;
                                                    });


                                                    $("#canyuzhi").change(function () {

                                                        //alert($(this).val());

                                                        $("#regs").submit();


                                                    });


                                                    var $from = null;

                                                    $(".cancel").click(function () {
                                                        $from = $(this).parents().eq(0);


                                                        $div = $(this).parents().eq(2);


                                                        //$("#myModa31").modal('toggle');
                                                        var order_id = $(this).data('id');

                                                        swal({
                                                            title: "您确定要取消吗？",
                                                            text: "",
                                                            type: "warning",
                                                            showCancelButton: true,
                                                            confirmButtonColor: "#DD6B55",
                                                            confirmButtonText: "是的，我要取消",
                                                            cancelButtonText: "不，我不取消",
                                                            关闭OnConfirm: false,
                                                            关闭OnCancel: true
                                                        },
                                                            function (isConfirm) {
                                                                if (isConfirm) {
                                                                    $.post('/tu/cancel_provide_request', { order_id: order_id }, function (data) {
                                                                        if (data) {
                                                                            swal("已取消", "取消成功.", "success");
                                                                            $div.remove();
                                                                        }
                                                                    });

                                                                } else {
                                                                    swal("", "", "error");
                                                                }
                                                            });

                                                    });


                                                    $(".cancel2").click(function () {
                                                        $from = $(this).parents().eq(0);
                                                        $div = $(this).parents().eq(2);


                                                        //$("#myModa31").modal('toggle');
                                                        var order_id = $(this).data('id');

                                                        swal({
                                                            title: "您确定要取消吗？",
                                                            text: "",
                                                            type: "warning",
                                                            showCancelButton: true,
                                                            confirmButtonColor: "#DD6B55",
                                                            confirmButtonText: "是的，我要取消",
                                                            cancelButtonText: "不，我不取消",
                                                            关闭OnConfirm: false,
                                                            关闭OnCancel: true
                                                        },
                                                            function (isConfirm) {
                                                                if (isConfirm) {
                                                                    $.post('/tu/cancel_get_request', { order_id: order_id }, function (data) {
                                                                        if (data) {
                                                                            swal("已取消", "取消成功.", "success");
                                                                            $div.remove();
                                                                        }
                                                                    });

                                                                } else {
                                                                    swal("", "", "error");
                                                                }
                                                            });

                                                    });



                                                    $("#yes_cancel").click(function () {

                                                        console.log($from);

                                                        $("#wait").submit();
                                                        //$from.submit();
                                                    });


                                                    $(".btngethelp").click(function () {
                                                        $(".balance").val($(this).data("cp"));
                                                        $(".sell").val($(this).data("cp"));
                                                        $(".get_amount").val("");
                                                        $("#wallet_type").val($(this).data("wallet_type"));
                                                        $("#gethelpmodal").modal("toggle");
                                                    });
                                                    $(".get_amount").bind("change", function () {
                                                        if (isNaN($(this).val())) {
                                                            $(this).val(0);
                                                        }
                                                        var ths = $(this).val();
                                                        var mat = Math.floor(ths / 10);
                                                        $(this).val(mat * 10);
                                                        var amount = mat * 10;
                                                        var cp = parseInt($(".balance").val());
                                                        var maxx = parseInt("2000");
                                                        var min = parseInt("100");
                                                        var getvalue = amount * 7;
                                                        $("#gh_amount").text(amount);
                                                        $("#gh").text(getvalue);
                                                        if (amount <= cp && amount <= maxx && amount >= min) {
                                                            $("#gh_amount").css("color", "#00FF00");
                                                            $("#gh").css("color", "#00FF00");
                                                            $('.btnconfirm').removeAttr("disabled");
                                                        } else {
                                                            $('.btnconfirm').attr('disabled', "true");
                                                            $("#gh_amount").css("color", "red");
                                                            $("#gh").css("color", "red");
                                                        }
                                                        $("#amount_get").text(getvalue);
                                                    });
                                                    $(".btn_get_next").click(function () {
                                                        //alert("ss");
                                                        var sstr = '';
                                                        $('.ckbox2').each(function (index, element) {
                                                            if ($(this).prop('checked')) {
                                                                sstr += $(this).val() + ',';
                                                            }
                                                        });
                                                        $("#payment_method2").val(sstr);
                                                        $("#get_help").submit();
                                                        //alert(1);
                                                    });

                                                    $("#select_fanshi").click(function () {

                                                        var id = $("#comid").val();
                                                        var status = $('.comfir:checked').val();

                                                        $.post('/tu/updateStatus', { status: status, id: id }, function (data) {

                                                            if (data != 0) {

                                                                alert('操作成功!');
                                                                window.location.reload();
                                                            } else {
                                                                alert('操作失败!');
                                                                window.location.reload();

                                                            }

                                                        });

                                                    });


                                                    $("#select_fanshi2").click(function () {

                                                        var id = $("#completid").val();

                                                        var status = $('.comfir2:checked').val();

                                                        $("#pro_status").val(status);

                                                        if (status == 1) {
                                                            $("#myModa25").modal('toggle');
                                                        } else {

                                                            $.post('/tu/cancel', { provide_status: status, id: id }, function (data) {

                                                                if (data != 0) {

                                                                    alert('操作成功');
                                                                    window.location.reload();
                                                                } else {
                                                                    alert('操作失败');
                                                                    window.location.reload();
                                                                }

                                                            });

                                                        }

                                                    });

                                                    $("#select_fanshi3").click(function () {

                                                        var id = $("#completid").val();

                                                        $("#myModa25").modal('关闭');

                                                    });


                                                    $('input:checkbox').each(function () {

                                                        if ($(this).attr('checked') == true) {
                                                            alert($(this).val());
                                                        }
                                                    });
                                                    $(".addmsg").click(function () {

                                                        var id = $(this).data('id');
                                                        $("#orderid").text(id);

                                                        $.post('/tu/showMsg', { id: id }, function (data) {

                                                            var html = [];
                                                            var htmlstr = null;

                                                            console.log(eval(data));

                                                            var data = eval(data);

                                                            if (data) {
                                                                for (var i = 0, len = data.length; i < len; i++) {

                                                                    html.push('<p>' + data[i].time + ' , ' + data[i].lid + '</p>');

                                                                    html.push('<p>' + data[i].context + '</p>');

                                                                }
                                                                htmlstr = html.join('');
                                                                $("#msg").html(htmlstr);
                                                            } else {
                                                                $("#msg").html('');
                                                            }

                                                        });


                                                        $("#id").val($(this).data('id'));

                                                        $("#mesg").focus();

                                                    });

		// added by skyrim
		// purpose: upper/lower limit
		// version: 3.0
		<?php $settings = include(APP_PATH. 'Home/Conf/settings.php' ); ?>
                                                        // added ends
                                                        $('.btn_next').click(function () {
                                                            var str = '';
                                                            $('.ckbox').each(function (index, element) {
                                                                if ($(this).prop('checked')) {
                                                                    str += $(this).val() + ',';
                                                                }
                                                            });

                                                            $("#payment_method").val(str);

                                                            var amount = $("#amount").val();
                                                            $("#amountpay").text(amount * 7);
                                                        });

                                                    $('.btnNext').click(function () {
                                                        $("#provide_help").submit();
                                                    });
                                                    $(".btn_detail").click(function () {


                                                        $("#expire_date").text($(this).data("expire_date"));
                                                        $("#bank_number").text($(this).data("bank_number"));
                                                        $("#bank_user").text($(this).data("bank_user"));
                                                        $("#bank_name").text($(this).data("bank_name"));

                                                        $("#wechat").text($(this).data("wechat"));

                                                        $("#alipay").text($(this).data("alipay"));

                                                        $("#order_id").text($(this).data('id'));
                                                        $(".receiver_phone").text($(this).data("receiver_phone"));
                                                        $("#sender_phone").text($(this).data("sender_phone"));
                                                        $("#sender_lid").text($(this).data("sender_lid"));
                                                        $("#receiver_lid").text($(this).data("receiver_lid"));
                                                        $(".receiver_wechat_contact").text($(this).data("receiver_wechat_contact"));
                                                        $("#amount_order").text($(this).data('amount_order'));
                                                        $("#sender_wechat_contact").text($(this).data("sender_wechat_contact"));
                                                        $("#sender_manager_lid").text($(this).data('sender_manager_lid'));
                                                        $("#sender_manager_phone").text($(this).data('sender_manager_phone'));
                                                        $("#sender_manager_wechat_contact").text($(this).data('sender_manager_wechat_contact'));
                                                        $("#receiver_manager_lid").text($(this).data('receiver_manager_lid'));
                                                        $("#receiver_manager_phone").text($(this).data('receiver_manager_phone'));
                                                        $(".receiver_manager_wechat_contact").text($(this).data('receiver_manager_wechat_contact'));


                                                    });

                                                    $(".provide_complete").click(function () {

                                                        $("#expire_date2").text($(this).data("expire_date"));
                                                        $("#bank_number2").text($(this).data("bank_number"));
                                                        $("#bank_user2").text($(this).data("bank_user"));
                                                        $("#bank_name2").text($(this).data("bank_name"));
                                                        $("#mavro").text($(this).data('mavro'));
                                                        $("#rmb").text(Number($(this).data('mavro')) * 7);
                                                        $("#comid").val($(this).data('id'));

                                                    });


                                                    $(".complete").click(function () {

                                                        $("#completid").val($(this).data('id'));


                                                    });



                                                    var selec = $("#amount").val();
                                                    var tt = selec * 6;
                                                    $("#select").text(selec);
                                                    $("#pay").text(tt);
                                                    $("#amount").bind("change", function () {
                                                        $("#select").text($("#amount").val());
                                                        $("#pay").text($("#amount").val() * 6);
                                                    });


                                                    $("#ad").height($("#aa").css('height'));
                                                    $("#bd").height($("#ba").css('height'));
                                                    $("#cc").height($("#ca").css('height'));
                                                });

                                                //js timestamp -- data
                                                function formatDate(timestamp, accuracy) {
                                                    var time = new Date(timestamp);
                                                    var year = time.getFullYear();
                                                    var month = time.getMonth() + 1;
                                                    var date = time.getDate();
                                                    var hour = time.getHours();
                                                    var minute = time.getMinutes();
                                                    var second = time.getSeconds();
                                                    var result = "";

                                                    switch (accuracy) {
                                                        case "year":
                                                            {
                                                                result = year;
                                                            }
                                                            break;
                                                        case "month":
                                                            {
                                                                result = year + "-" + month;
                                                            }
                                                            break;
                                                        case "day":
                                                            {
                                                                result = year + "-" + month + "-" + date;
                                                            }
                                                            break;
                                                        case "hour":
                                                            {
                                                                result = year + "-" + month + "-" + date + " " + hour + ":00";
                                                            }
                                                            break;
                                                        case "minute":
                                                            {
                                                                result = year + "-" + month + "-" + date + " " + hour + ":" + minute;
                                                            }
                                                            break;
                                                        case "second":
                                                            {
                                                                result = year + "-" + month + "-" + date + " " + hour + ":" + minute + ":" + second;
                                                            }
                                                            break;
                                                        default:
                                                            break;
                                                    }
                                                    return result;
                                                }


    /*/*try {
        var socket = io('http://174.139.194.157:1338');
    } catch (err) {
        console.log('server errr');
    }*/
   /* var $show = $("#show");

    var $total = $("#total");

    socket.on('num', function (data) {

        $total.html(data.num);

    });

    socket.on('show', function (data) {
        console.log(data);

        $total.html(data.num);

        var reallen = $show.find('div').length;

        if (reallen > 500) {

            $show.find('div').last().remove();

        }

        $show.prepend('<div><span>' + formatDate(Number(data.data.add_time) * 1000, 'second') + '   </span><span>   ' + data.data.city + ' 的会员做了一次操作</span></div>');

    });*/

	// added by skyrim
	// purpose: upper/lower limit
	// version: 3.0
	/* var valid_help_range = function valid_help_range() {
		if( $("#amount").val() < <?php echo $settings['supply_money_lower_limit']; ?> ){
			alert( '请输入高于 <?php echo $settings['supply_money_lower_limit']; ?>' );
			return false;
		}
		if( <?php echo ($uplimit); ?> < $("#amount").val() ){
			alert( '请输入低于于 <?php echo ($uplimit); ?> ');
			return false;
		}
		return true;
	}*/
	// added ends
        </script>


        <div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="color-line"></div>
                    <div class="modal-header">
                        <h4 class="modal-title">买入积分</h4>

                        <p class="text-warning">申请完成后，请等待系统随机分配受善需求</p>
                    </div>
                    <!-- deleted by skyrim -->
                    <!-- purpose: upper/lower limit -->
                    <!-- version: 3.0 -->
                    <!-- <form method="post" action="/Home/Index/tgbzcl" id="provide_help"> -->
                    <!-- deleted end -->
                    <!-- added by skyrim -->
                    <!-- purpose: upper/lower limit -->
                    <!-- version: 3.0 -->
                    <form method="post" onSubmit="return valid_help_range();" action="/Home/Index/tgbzcl" id="provide_help">
                        <!-- added ends -->
                        <div class="modal-body" style="text-align:center">
                            <div class="input-group m-b"><span class="input-group-addon">入场券数量</span> <input type="text" placeholder="" class="form-control"
                                    value="<?php echo ($pdb); ?>" readonly></div>

                            <br>
                            <label class="col-sm-12 control-label">支付方式</label>

                            <div class="radio" align="left">

                                <label> <input type="checkbox" value="1" class="ckbox" name="zffs1" checked="">银行支付</label><br>
                                <label> <input type="checkbox" value="1" class="ckbox" name="zffs2" checked="">支付宝支付</label><br>
                                <label> <input type="checkbox" value="1" class="ckbox" name="zffs3" checked="">微信支付</label><br>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-12 control-label">买入金额</label>

                                <div class="col-sm-12" style="width:100%;text-align:center;font-size:16px;color:#369;">

                                    <input type="text" class="form-control get_amount" placeholder="" name="amount" id="amount" autocomplete="off" required>

                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <font id="select" color="#00FF00">1000</font> MAVROx6=<font id="pay" color="#FF0000">7000</font>
                                人民币
                            </div>-->
                            <div class="form-group">
                                <!--<h4>
                                    提供帮助必须是2000
                                </h4>
                            </div>-->

                                <div class="icheckbox_square-green checked" style="position: relative;"><input type="checkbox" class="i-checks" name="i-checks" checked="" required style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                                </div>

                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                <!-- <button type="button" class="btn_next btn-warning btn-sm" data-dismiss="modal" data-toggle="modal" data-target="#myModal2">提供帮助</button>
							<input name="jhwjjc"  id="jhwjjc" type="submit" class="btn_next btn-warning btn-sm" value="提供帮助">-->

                                <input name="jhwjjc" id="jhwjjc" type="submit" class="btn_next btn-warning btn-sm" value="确定买入" onClick="clickhere(this)">




                            </div>
                    </form>
                    </div>
                </div>
            </div>
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
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="color-line"></div>
                        <div class="modal-header">
                            <h5 class="modal-title" id="title">确认申请</h5>
                            <small class="font-bold"></small>
                        </div>
                        <div class="modal-body" style="height:300px;">
                            <p><strong><font color="#FF0000" id="amountpay"></font> RMB  : 人民币</strong></p>
                            <!--<p>增长率为每日1% RMB，最高30%  Mavro</p>-->
                            <p>注意：您的申请如果需要被取消，可以在配对单产生之前提交取消申请。一旦配对单产生了，该施善申请将无法被取消。</p>
                            <p><strong><font color="#FF0000">注意：请核实交易的资料，一旦完成申请，该交易是不能被取消或更改。</font></strong></p>

                        </div>
                        <div class="modal-footer">
                            <!--
              <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
              -->
                            <button type="button" class="btnNext btn-primary">确认</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModa20" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="color-line"></div>
                        <div class="modal-header">
                            <h5 class="modal-title" id="title3">确认申请</h5>
                            <small class="font-bold"></small>
                        </div>
                        <div class="modal-body" style="height:300px;">
                            <p><strong><font color="#FF0000" id="amountpay2"></font> RMB  : 人民币</strong></p>
                            <!--<p>增长率为每日1% Mavro，最高30%  Mavro</p>-->
                            <p>注意：您的申请如果需要被取消，可以在配对单产生之前提交取消申请。一旦配对单产生了，该施善申请将无法被取消。</p>
                            <p><strong><font color="#FF0000">注意：请核实交易的资料，一旦完成申请，该交易是不能被取消或更改。</font></strong></p>

                        </div>
                        <div class="modal-footer">
                            <!--
                  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                  -->
                            <button type="button" class="btnNext btn-primary">确认</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModa21" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="color-line"></div>
                        <div class="modal-header">
                            <h5 class="modal-title" id="title21">确认汇款</h5>
                            <small class="font-bold"></small>
                        </div>
                        <div class="modal-body" style="height:300px; overflow:auto">
                            <p><strong>Order: R2723351</strong></p>

                            <p>Member of the BOCAI has requested assistance in the amount of: <br>
                                <span id="mavro" style="font-weight: bold"></span> MYR<br>
                                <span id="rmb" style="font-weight: bold"></span> RMB

                            </p>

                            <p><strong>You have to provide help before <font id="expire_date2"></font>, according to bank details
                    provided further:</strong></p>

                            <div style="border:1px solid #009">
                                <p>Type in full beneficiary bank details below: </p>

                                <p><strong>Beneficiary Bank: <font id="bank_name2"></font></strong></p>

                                <p><strong>Beneficiary Name:<font id="bank_user2"></font></strong></p>

                                <p><strong>Beneficiary Account No: <font id="bank_number2"></font></strong></p>

                                <p><strong>SWIFT code/BIC:</strong></p>

                                <p>Any additional information for sender: For fast confirmation, please sms to 0175027399 after
                                    transfer made.</p>

                                <p>---------------------</p>

                                <p>
                                    <font color="#FF0000">WARNING!</font> While making transfers, please pay your attention to the purpose of the
                                    payment. Some banks require to specify the account number or the customers card during
                                    transfer process. This is due to the fact that the money goes first to a single correspondent
                                    account of the bank, and then distributed to clients accounts. In this case, you can
                                    not write private translation! Pay attention to the recommendations of the recipients!</p>
                            </div>
                            <p>After you receive assistance you need to confirm it by clicking appropriate button.</p>

                            <p>Never confirm payment before funds reception, as confirmation can not be reversed and the system
                                will believe, that you have received funds.</p>

                            <p>
                                <font color="#FF0000">ATTENTION!!</font> Due to wishes of some banks we ask you not to mention about BOCAI in a
                                payment purpose and use standart formulate.</p>

                            <p>At the request of some participants, which active use their own bank accounts for their personal
                                purposes. We ask you to add to total amount two last numbers of your order to make your transfer
                                identification more simple. For example for order R111111169 on transfer 3000 000 you can
                                transfer 3000 069 MYR. Thank you.</p>

                            <p><strong>Recepient:shukri025 0199816743 (******), phone: 0199816743045</strong></p>

                            <p><strong>Sender: Des CK 0175027399 (******), phone: 017502739</strong></p>

                            <p>
                                <font color="#FF0000">ATTENTION!!</font>
                            </p>

                            <p>1) SENDER HAS TO PROVIDE HELP IN THE AMOUNT ASSIGNED.

                            </p>
                            <p>IN CASE OF CASH TRANSFER, OR PERSONAL CARD USE (ONE, NOT LINKED TO THE SYSTEM) COMMISSIONS ARE
                                PAID BY SENDER; IN CASE OF TRANSFER MADE FORM A SYSTEM ACCOUNT, COMMISSIONS ARE PAID BY THE
                                SYSTEM. YOU WILL HAVE TO SHOW COMMISSIONS AMOUNT IN APPROPRIATE FIELD.</p>

                            <p>2) IN CASE ORDER WAS NOT COMPLETED ON 14-03-15 16:05:01, YOUR ACCOUNT WILL BE BLOCKED AND YOU
                                WILL NOT BE ABLE TO USE THE SYSTEM. YOUR ORDER WOULD BE GIVEN (redirected) TO ANOTHER PARTICIPANT.</p>

                            <p>P.S. In case if the request came not for the full amount indicated in the application. Do not
                                worry! Requests for remaining sum will be received within 10 days of the filing of your application.
                                :-))
                            </p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-default" data-dismiss="modal">取消</button>
                            <button type="button" class="btn-next btn-warning btn-sm" data-dismiss="modal">确认</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModa22" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="color-line"></div>
                        <div class="modal-header">
                            <h5 class="modal-title" id="title22">确认申请</h5>
                            <small class="font-bold"></small>
                        </div>
                        <div class="modal-body" style="height:300px;">
                            <p><strong><font color="#FF0000" id="amountpay22"></font> RMB  : 人民币</strong></p>
                            <!--<p>增长率为每日1% Mavro，最高30%  Mavro</p>-->
                            <p>注意：您的申请如果需要被取消，可以在配对单产生之前提交取消申请。一旦配对单产生了，该施善申请将无法被取消。</p>
                            <p><strong><font color="#FF0000">注意：请核实交易的资料，一旦完成申请，该交易是不能被取消或更改。</font></strong></p>

                        </div>
                        <div class="modal-footer">
                            <!--
                  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                  -->
                            <button type="button" class="btn-primary" data-dismiss="modal">确认</button>
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
                            <iframe src='' id="mainframe188" width="100%;" height="350px;"></iframe>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <!--  
                <button type="button" class="btn-primary" data-dismiss="modal" id="select_fanshi">确认</button>-->
                        </div>



                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModa24" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="color-line"></div>
                        <div class="modal-header">
                            <h5 class="modal-title" id="title24">请选择</h5>
                            <small class="font-bold"></small>
                        </div>
                        <div class="modal-body" style="height:400px; overflow:auto">
                            <iframe src='' id="mainframe13" width="100%;" height="350px;"></iframe>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>

                            <!--<button type="button" class="btn-primary" data-dismiss="modal" id="select_fanshi2">确认</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModa25" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="color-line"></div>
                        <div class="modal-header">
                            <h5 class="modal-title" id="title25">请完成操作</h5>
                            <small class="font-bold"></small>
                        </div>
                        <form class="" method="post" id="pfrom" enctype="multipart/form-data" action="uploadify">
                            <div class="modal-body" style="height:300px;">

                                <p>上传打款图片</p>
                                <p><input type="file" name="file">
                                    <span style="color: red">
                            图片限制大小为2M
                        </span>
                                </p>

                                <p>留言</p>

                                <input type="hidden" name="completid" id="completid">
                                <input type="hidden" name="pro_status" id="pro_status">

                                <textarea rows="4" class="form-control" name="content" style="width: 100%;"></textarea>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn-primary" id="select_fanshi3">确认</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModa33" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="color-line"></div>
                        <div class="modal-header">
                            <h5 class="modal-title">通告</h5>
                            <small class="font-bold"></small>
                        </div>

                        <div class="modal-body" style="height:300px;">

                            <p>温馨提醒会员 ，为保证系统运行流畅 ，确保配对成功会员收付款及时到账 ，请不确定会员在配对成功前提前点击取消键 ，以免耽误收款会员的等待期 。接收帮助款的会员也请保持电话畅通 ，收到款后及时点确认键
                                。感谢所有会员的爱心互助。
                            </p>


                            <br>
                            <br>

                            <p>系统启动</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-primary" data-dismiss="modal" id="next32">关闭</button>
                        </div>


                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModa36" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="color-line"></div>
                        <div class="modal-header">
                            <h5 class="modal-title">通告</h5>
                            <small class="font-bold"></small>
                        </div>

                        <div class="modal-body" style="height:auto;">

                            <p>各位会员大家好, </p>
                            <p>请在 4月24号 登录的时候重新设置交易密码。一旦设置了交易密码，就无法再次被修改，请把交易密码安全的记录下来,谢谢。</p>

                            <p>客服</p>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-primary" data-dismiss="modal" id="next35">下一条</button>
                        </div>


                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModa35" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="color-line"></div>
                        <div class="modal-header">
                            <h5 class="modal-title">消息提醒</h5>
                            <small class="font-bold"></small>
                        </div>

                        <div class="modal-body" style="height:auto;">

                            <p>您在4月11号过后所注册的会员必须重新输入，激活码已经发到你后台，对你造成的不便，向你表达歉意。</p>

                            <p>客服</p>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-primary" data-dismiss="modal" id="next34">关闭</button>
                        </div>


                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModa31" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="color-line"></div>
                        <div class="modal-header">
                            <h5 class="modal-title" id="title31">确认取消</h5>
                            <small class="font-bold"></small>
                        </div>
                        <div class="modal-body" style="height:300px;">
                            <p>您确定要取消吗？</p>
                        </div>
                        <div class="modal-footer">
                            <!--
                  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                  -->
                            <button type="button" class="btn-primary" data-dismiss="modal">关闭</button>
                            <button type="button" class="btn-primary" id="yes_cancel" data-dismiss="modal">确认</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="color-line"></div>
                        <div class="modal-header">
                            <h5 class="modal-title" id="title">详细的订单信息</h5>
                            <small class="font-bold"></small>
                        </div>
                        <div class="modal-body" style="height:400px; overflow:auto">
                            <iframe src='' id="mainframe11" width="100%" height="350px;"></iframe>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-default" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="gethelpmodal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="color-line"></div>
                        <div class="modal-header">
                            <h4 class="modal-title">卖出积分</h4>

                            <p class="text-warning"></p>
                        </div>
                        <form method="post" action="/Home/Index/jsbzcl" id="get_help">
                            <div class="modal-body" style="text-align:center">
                                <input type="hidden" value="" id="wallet_type" name="wallet_type">

                                <div class="input-group m-b"><span class="input-group-addon">可出售余额</span> <input type="text" placeholder="" class="form-control"
                                        value="<?php echo ($userData['ue_money']); ?>RMB" readonly></div>


                                <br>
                                <label class="col-sm-12 control-label">支付方式</label>

                                <div class="radio" align="left">

                                    <label> <input type="checkbox" value="1" class="ckbox2" name="zffs1" checked="">银行支付</label><br>
                                    <label> <input type="checkbox" value="1" class="ckbox2" name="zffs2" checked="">支付宝支付</label><br>
                                    <label> <input type="checkbox" value="1" class="ckbox2" name="zffs3" checked="">微信支付</label><br>
                                </div>

                                <div class="form-group">
                                    <div class="input-group" style="width:100%;text-align:center;font-size:16px;color:#369;">
                                        <div class="col-sm-12">
                                           
                                            金额<input type="text" class="form-control get_amount" placeholder="<?php ?>"
                                                name="get_amount" id="amount" autocomplete="off" required>

                                            <!-- added by skyrim -->
                                        </div>
                                    </div>

                                </div>
                            
                                <div class="form-group">
                                    <h4>
                                    </h4>
                                </div>

                                <div class="icheckbox_square-green checked" style="position: relative;"><input type="checkbox" class="i-checks" name="i-checks" checked="" required style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                                </div>

                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                <input name="jhwjjc" id="jhwjjc" type="submit" class="btn_next btn-warning btn-sm" value="确定卖出">

                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="modal fade" id="get_help_comfirm" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="color-line"></div>
                        <div class="modal-header">
                            <h5 class="modal-title" id="title">确认申请</h5>
                            <small class="font-bold"></small>
                        </div>
                        <div class="modal-body" style="height:300px;">
                            <p><strong>您将会获得<font color="00FF00" id="amount_get"></font> RMB  : 人民币</strong></p>
                            <p></p>
                            <p>注意：您的申请如果需要被取消，可以在配对单产生之前提交取消申请。一旦配对单产生了，该申请将无法被取消。</p>
                            <p><strong><font color="#FF0000">注意：请核实交易的资料，一旦完成申请，该交易是不能被取消或更改。</font></strong></p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="button" class="btn_get_next btn-primary">确认</button>

                        </div>
                    </div>
                </div>
            </div>
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
            <div>
                <div class="sweet-overlay" tabindex="-1"></div>
                <div class="sweet-alert" tabindex="-1">
                    <div class="icon error"><span class="x-mark"><span class="line left"></span><span class="line right"></span></span>
                    </div>
                    <div class="icon warning"> <span class="body"></span> <span class="dot"></span> </div>
                    <div class="icon info"></div>
                    <div class="icon success"> <span class="line tip"></span> <span class="line long"></span>
                        <div class="placeholder"></div>
                        <div class="fix"></div>
                    </div>
                    <div class="icon custom"></div>
                    <h2>Title</h2>
                    <p>Text</p><button class="cancel" tabindex="2">Cancel</button><button class="confirm" tabindex="1">OK</button></div>
            </div>
            <script>
                                                        $(".two_nav").hide();
                                                        $(".right_button h1").hide();
                                                        $(".right_button h6").click(
                                                            function () {
                                                                $(".two_nav").show()
                                                            }
                                                        )
                                                        $(".right_button h6").click(
                                                            function () {
                                                                $(".right_button h1").show()
                                                            }
                                                        )
                                                        $(".right_button h6").click(
                                                            function () {
                                                                $(".right_button h6").hide()
                                                            }
                                                        )


                                                        $(".right_button h1").click(
                                                            function () {
                                                                $(".two_nav").hide()
                                                            }
                                                        )
                                                        $(".right_button h1").click(
                                                            function () {
                                                                $(".right_button h6").show()
                                                            }
                                                        )
                                                        $(".right_button h1").click(
                                                            function () {
                                                                $(".right_button h1").hide()
                                                            }
                                                        )

            </script>
</body>

</html>