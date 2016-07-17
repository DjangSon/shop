<?php
	require  './inc/config.php';	//加载数据库配置文件
	require './inc/loading.php'; //加载跳转页面函数
	
	if (empty($_GET['goodsid'])){
		alertAndLoading("请输入商品id", "index.php");
	}
	
	if (!empty($_COOKIE['mobile'])){
		$mobile = base64_decode(base64_decode($_COOKIE['mobile']));
	}
	
	if (!empty($_REQUEST['act'])){
		$act = $_REQUEST['act'];
		if ($act == "addcart"){
			if (!empty($_COOKIE['mobile'])){
				$database -> insert("cart", [
						"mobile" => base64_decode(base64_decode($_COOKIE['mobile'])),
						"goods_id" => $_GET['goodsid'],
						"goods_price" => $_GET['price'],
						"time" => date("Y/m/d H:m:s")
				]);
				loading("cart.php");
			}else {
				alertAndLoading("请先登录", "login.php");
			}
		}
	}
	
	$getproduct = $database -> select("goods", "*",[
			"id" => $_GET['goodsid']
	]);
	if (empty($getproduct)){
		alertAndLoading("无此商品", "index.php");
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Rainbow - 【正品直邮】后(The history of whoo) 秘贴3合一自生精华保湿水乳套盒</title>
	</head>
	<body>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/product.css">
	<link rel="stylesheet" type="text/css" href="css/css.css">
<!--header-->
<div class="header_container">
    <!--header-->
    <div id="header_container">
        <div id="logo">
            <a href="index.php" id="home" title="RAINBOW" style="float: left; height: 20px; margin-top: 1%;margin-left: 16%;">
                <img src="images/rainbow.png" alt=""></a>
            <div class="cn_renewal cn_main">
                <div class="new_header_ab">
                    <div class="header header_wide_lv1 w960">
                        <div class="header_top">
                            <div class="cn_top_menu">
                                <ul class="cn_top_global">
                                <?php 
                               		if (!empty($_COOKIE['mobile'])) {
                               			echo '<div style="float: left; font-size: 13px; color: #666">欢迎您，<a href="userinfo.php" style=" text-decoration: none;">'.$mobile.'</a>&nbsp;[<a href="index.php?act=deletecookie" style="text-decoration: none; color: #ed155b">退出</a>]</div>';
                               		}else {
                               			echo '<li id="login"><a href="login.php">登录</a></li>
<li><a href="register.php">注册</a></li>';
                               		}
                                ?>
                                    
                                    <li class="home"><a href="index.php">
                                        <img src="images/ico_home.png" alt="">
                                        首页</a></li>
                                    <li class="on"><a href="cart.php">购物车</a></li>
									<li><a href="orders.php">我的订单</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="head_wrapper clearfix">
        <div class="head_certif">
            <div class="cart_flag_all" id="cart_box">
                <a href="cart.php" rel="nofollow" class="cart_box cart_box_hover">
                    <span class="cart_logtext">去购物车结算</span>
                    <span class="nav_cart_num" style="display: none;"></span>
                <div class="cart_content"><div class="cart_content_null" style="display: block;">购物车中还没有商品，<br>快去挑选心爱的商品吧！</div><div class="cart_content_all" style="display: none;"><div class="cart_left_time"><span class="cart_diff"></span>后购物袋被清空,请及时结算</div><div class="cart_content_center"></div><div class="con_all"><div class="price_whole"><span>共<span class="num_all">0</span>件商品</span><span class="price_gongji"><em>¥</em><span class="total_price f_color">0</span></span></div><div><a href="">去购物车结算</a></div></div></div><span class="recent_deals_strangle"></span></div></a>
            </div>
        </div>
    </div>
</div>



<!--content-->
<?php 
	foreach ($getproduct as $product){
		echo '<div id="body" class="global_body">
<div class="detail_wrap">
    <div class="deal_main clearfix">
        <div class="deal_left">
            <div class="deal_titles">
                <p class="long_title">
                 <strong>  </strong>
                    <span class="single_price" style="color:#ec2b8c;">【正品直邮】</span>'.$product['described'].'</p>
            </div>
            <div class="preview_product_id">
                <div class="hk_direct"></div>
                    <div class="detail_sold_out"></div>
                        <img src="'.$product['top3_pic'].'" class="ImageStd_1000" id="deal_img">
                </div>
        </div>
        <div class="deal_right">
        	<!--r_first-->
            <div class="r_first clearfix">
                <a href="" target="_blank" rel="nofollow"></a>
                    <div class="flag_box_main clearfix fr" style="float:left;">
                    <img src="images/product/021_flag.jpg" class="p_img_lg fl" alt="flag">
                	</div>
            </div>
            <!--r_second-->
            <div class="r_second">
                <ul class="price_module clearfix">
                    <li class="price_module jumei_price clearfix"><em class="jp_cur">¥</em>'.$product['price'].'</li>           
                </ul>
            </div>
            <!--people clearfix-->
            <div class="people clearfix">
                <!--秒杀不显示心愿 购买人数-->
                <div class="num fl">已购买人数 <em>'.$product['sales'].'</em></div>
                <div class="comments fr"></div>
            </div>
            <!--r_third-->
            <div class="r_third">
                <dl class="mail_policy clearfix">
                    <dt class="fl">包邮政策：</dt>
                                            <dd class="retail_global_mail"><em>包邮</em></dd>
                                    </dl>
                                    <dl class="mail_policy clearfix">
                        <dt class="fl">服务政策：</dt>
                        <dd class="global_mail">
                                                            <span class="day"></span>7天拆封无理由退货
                                                    </dd>
                    </dl>
                                                    <dl class="mail_policy clearfix">
                        <dt class="fl">限购政策：</dt>
                        <dd class="global_mail">仅限购买3件</dd>
                    </dl>
                                                    <dl class="mail_policy clearfix">
                        <dd class="global_mail">正品直邮商品，暂不支持使用现金券</dd>
                    </dl>
                                <dl class="deal_sku clearfix">
                    <dt><span class="r_third_spacing">型</span>号:</dt>
                    <dt class="dt_relative">
                    <div class="deal_sku_input">请选择型号</div>
                    <i class="new_detail_btn"></i>
                    <div class="warningtip">请选择型号</div>
                    <ul class="sku_select" id="sku_select"></ul>
                    </dt>
                </dl>
            </div>
            <!--r_fourth-->
            <div class="r_fourth"><a href="product.php?act=addcart&goodsid='.$product['id'].'&price='.$product['price'].'" class="detail_btn_fom btn_fom_add buy_local" id="shop_cart"><span>加入购物车</span><i></i></a></div>
            <input type="hidden" id="show_category" value="deal">
            <input type="hidden" id="hid_hashid" value="ht160319p2206523t1">
            <input type="hidden" id="hid_shippingsystemid" value="2754">
            <input type="hidden" id="category_id" value="107">
            <input type="hidden" id="deal_category" value="retail_global">
            <input type="hidden" id="sku_no" value="702018413">
            <input type="hidden" id="stream_id" class="stream_id" search_product_id="2206523" search_category_id="352" search_brand_id="1610" search_product_type="global_deal" search_show_id="0" search_hash_id="ht160319p2206523t1" search_sku_id="702018413" search_spu_id="0" search_warehouse_id="2754" price="369" search_short_name="后秘贴自生精华保湿水乳套盒" search_category_path="化妆品/面部护肤/精华/精华液/露">
        </div>
    </div>
    
    
    <div class="deal_prefer deal_prefer_direct clearfix" id="deal_prefer">
        <!--预售start-->
                    <div class="list rightborder">
                <div class="item">
                    <div class="item_show item_show_0"></div>
                    <div class="item_desp item_desp_0"><a href="" class="more" target="_blank"></a></div>
                </div>
            </div>
            <div class="list rightborder">
                <div class="item">
                    <div class="item_show item_show_1"></div>
                    <div class="item_desp item_desp_1"><a href="" class="more" target="_blank"></a></div>
                </div>
            </div>
            <div class="list rightborder">
                <div class="item">
                    <div class="item_show item_show_2"></div>
                    <div class="item_desp item_desp_2"><a href="" class="more" target="_blank"></a></div>
                </div>
            </div>
                            <div class="list last">
                    <div class="item">
                        <div class="item_show item_show_3"></div>
                        <div class="item_desp item_desp_3"><a href="" class="more" target="_blank"></a></div>
                    </div>
                </div>
                        </div>
            
    <div class="deal_detail">
        <div style="width: 1090px; height: 50px; padding: 0px; margin: 0px; top: auto; right: auto; bottom: auto; left: auto; display: none;"></div>
        <div class="deal_tab_nav nav_bar_fixed" id="anchorbar" style="left: 0px; z-index: 1001; width: 100%;">
            <div class="inner">
                <ul class="clearfix fl">
                    <li><a href="#spxx" class="">商品信息</a></li>
                                    <li><a href="#spxq" class="">商品详情</a></li>
                </ul>
                <div class="nav_fixed_pric fr">
                    <span class="nav_fprice">
                        <strong class="jm_price">¥369</strong>
                                            </span>
                    <span class="btn"><a href="javascript:;" id="anchorbarBuyBtn" class="fixed_buy_now">加入购物车</a></span>
                </div>
            </div>
        </div>

        <div class="content_nav_con content_book">
            <!--授权书-->
                        <!--品牌介绍（店铺介绍）-->
       </div>

        <div class="ptb_30">
            <div id="spxx" class="content_nav_con  content_book" loaded="loaded">
                <div class="detail_content guts_box"></div>
                <div class="content_text">                        <div class="deal_con_content">
                            <table border="0" cellpadding="0" cellspacing="0" style="font-family:arial;">
                                <tbody>
                                <tr>
                                    <td width="85" align="left"><b>商品名称：</b></td>
                                    <td width="500"><span>'.$product['name'].'</span></td>
                                    <td rowspan="7" style="padding-right:0;">
                                        <img src="'.$product['describe_pic'].'" class="w200">
                                    </td>
                                </tr>
                                                                    <tr>
                                        <td width="85" align="left"><b>商品型号：</b></td>
                                        <td>
                                                                                            <span style="margin-right:10px;">'.$product['type'].'</span>
                                                                                    </td>
                                    </tr>
                                                                                                    <tr>
                                        <td align="left"><b>品&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牌：</b></td>
                                        <td><span>'.$product['brand'].'</span></td>
                                    </tr>
                                                                                                    <tr>
                                        <td align="left"><b>分&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;类：</b></td>
                                        <td><span>'.$product['category'].'</span></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><b>功&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;效：</b></td>
                                        <td><span>'.$product['function'].'</span></td>
                                    </tr>
                                  </tbody>
                            </table>
                        </div>
                    </div>
                <div class="content_img">
                	<img src="images/3_10_1.jpg" alt="gyhwg_img">
                                    </div>
            </div>

                                    <div id="spxq" class="content_nav_con" loaded="loaded">
                            <div class="detail_content spxq_box"></div>
                                </div>
                                                        <div class="content_text">
                                                        <img src="'.$product['picture01'].'" alt="">
                                                        <img src="'.$product['picture02'].'" alt="">
                                                        <img src="'.$product['picture03'].'" alt="">
                                                        <img src="'.$product['picture04'].'" alt="">
                                                        <br>
                                                        </div>
           </div>';
	}
?>

            
                        <div id="yhkb" class="content_nav_con yhkb" loaded="loaded">
                <div class="detail_content yhkb_box" id="deal_koubei"></div>
                <div class="content_text" id="script_koubei" koubeiwrap="script_koubei" productid="2206523"></div>
            </div>
            <div id="cjwt" class="content_nav_con" loaded="loaded">
                <div class="detail_content gyhwg_box"></div>
                                    <div class="content_img">
                        <a href="" class="static_img" style="display: block;" target="_blank">
                            <img src="images/3_03_2.jpg" alt="">
                        </a>
                    </div>
                            </div>
            <div id="lxjm" class="content_nav_con lxjm">
                <div class="detail_content lxjm_box"></div>
                <div class="content_img">
                    <img src="images/3_15.jpg" alt="lxjm_img">
                    <a class="myfaq" id="detailfaq" href="javascript:;">点击这里-联系在线客服</a>
                    <a class="myticket" href="http://www.jumei.com/i/RMA/show" target="_blank">我的订单-售后服务</a>
                </div>
            </div>
    </div>  
    </div>
</div>
</div>
<!--footer-->
<div class="footer_container">
    <div class="footer_bottom">
        <p class="footer_copy_con" style="margin-left: 40%;">
            Copyright 2016, 版权所有RAINBOW.COM 客服电话:123-456-7890
        </p>
    </div>
</div>
</body>
</html>
