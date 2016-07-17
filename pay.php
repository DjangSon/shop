<?php
	require  './inc/config.php';	//加载数据库配置文件
	require './inc/loading.php'; //加载跳转页面函数.
	if (empty($_COOKIE['mobile'])){
		alertAndLoading("非用户，请先登录", "login.php");
	}
	$mobile = base64_decode(base64_decode($_COOKIE['mobile']));
	
	$user = $database -> select("user", "*",[
			"mobile" => $mobile
	]);
	foreach ($user as $getid){
		$id = $getid['id'];
	}
	
	$thiscart = $database->select("cart", "*",[
			"mobile" => $mobile
	]);
	
	$alladdress = $database -> select("address", "*",[
			"flag" => $id
	]);
	$sum = 0;
	$flag = 0;
	if (!empty($thiscart)){
		foreach ($thiscart as $cart){
			$ids[$flag] = $cart['id'];
			$goods_id[$flag] = $cart['goods_id'];
			$goods_price[$flag] = $cart['goods_price'];
			$time[$flag] = $cart['time'];
			$flag++;
		}
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(!empty($_REQUEST['act'])){
			$act = $_REQUEST['act'];
			if ($act == "addorders"){
				if (!empty($_POST['address'])){
					for ($j=0;$j<$flag;$j++){
						$database -> insert("orders", [
								"receiver" => $_POST['address'],
								"username" => base64_decode(base64_decode($_COOKIE['mobile'])),
								"goods_id" => $_POST["goods".$j],
								"price" => $_POST['price'],
								"piece" => $_POST['piece'],
								"orderid" => date("YmdHms")
						]);
						$database -> delete("cart", [
								"AND" => [
										"mobile" => base64_decode(base64_decode($_COOKIE['mobile'])),
										"goods_id" => $_POST["goods".$j],
								]
						]);
					}
					alertAndLoading("已加入订单，请及时付款", "orders.php");
				}else {
					alertAndLoading("请选择送货地址", "pay.php");
				}
			}
		}
	}
	
	if (!empty($_GET['cart_id'])) {
		if(!empty($_REQUEST['act'])){
			$act = $_REQUEST['act'];
			if ($act == "deletecart"){
				$database -> delete("cart", [
						"id" => $_GET['cart_id']
				]);
				alertAndLoading("删除成功", "cart.php");
			}
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Rainbow - 【确认订单】</title>
	<body>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="stylesheet" href="css/confirm.css">
	</head>
	<body>
		
		<style type="text/css">
.cart_header{
width: 960px;
margin: 0 auto;
}
.cart_header_box{
border-bottom: 2px solid #e5e5e5;
box-shadow: 0px 1px 2px rgba(0,0,0,0.1);
padding-bottom: 15px;
}
.cart_header .logo_box{
float: left;
}
.cart_header .order_path{
float: right;
width: 377px;
height: 48px;
}
.cart_header .order_path_1{
background: url(images/order_path.png) no-repeat;
background-position: -2px -2px;
}
.cart_header .order_path_2{
background: url(images/order_path.png) no-repeat;
background-position: -2px -54px;
}
.cart_header .order_path_3{
background: url(images/order_path.png) no-repeat;
background-position: -2px -106px;
}
.cart_header .order_path_4{
background: url(images/order_path.png) no-repeat;
background-position: -2px -158px;
}
.cart_top{
position: relative;
height: 32px;
line-height: 32px;
color: #999999;
width: 960px;
margin: 0 auto;
}
.cart_top .user_box{
position: absolute;
right: 0;
top: 0;
}
.cart_top .user_box .tips{
font-style: normal;
color: #dddddd;
padding: 0 5px;
}
.cart_top .user_box .out,.cart_top .user_box .query{
color: #999999;
}
.cart_top .user_box a:hover{text-decoration: none;color: #ed145b;}
		</style>
		<!--header-->
<div style="background: white;">

    <div class="cart_top">
        <div class="user_box" id="JS_user_box"><div>欢迎您，<a href=""><?php echo $mobile; ?></a>&nbsp;<a href="index.php?act=deletecookie" class="out">[退出]</a><i class="tips">|</i><a href="orders.php" class="query">我的订单</a></div></div>
    </div>
    <div class="cart_header_box">
        <div class="cart_header clearfix">
            <h1 class="logo_box">
                <a href="index.php" target="" id="home">
                    <img src="images/small_rainbow.png" alt="">
                </a>
            </h1>
            <div class="order_path order_path_2">
            </div>
        </div>
    </div>
</div>
			
			<!--content start-->
			<div id="JS_confirmation_main">
					<div class="main">
					<form method="post" action="pay.php?act=addorders">
							<div class="main_content" style="diplay:block;">
								<h2 class="title">
									1. 地址选择
								</h2>
								<div class="prefer_delivery_day">
									<div class="clearfix">
									<?php 
											if (!empty($alladdress)){
												foreach ($alladdress as $address){
													echo '<div class="box" style="margin-left:30px;margin-top: 20px;">
														<input type="radio" name="address" value="'.$address['recivename'].'">
														<label>'.$address['recivename'].'     '.$address['address'].'         '.$address['mobile'].'       '.$address['identity'].'</label>
														</div>';
												}
											}
										?>
									</div>
								</div>
										<div class="address_express clearfix">
											<div class="fl" style="margin-left:30px;">
												<a href="userinfo.php" class="add">
													<i class="icon">+</i><span>使用新地址</span>
												</a>
											</div>
										</div>
							
						</div>
						<div class="border_line orders-list" style="border-bottom:none;">
							<div class="main_content" style="position:static;">
								<h2 class="title">
									<span>2. 商品清单</span>
								</h2>
								<div class="order">
									<div style="margin-bottom:20px;">
										<div class="box JS_order_box" style="border-top:none;">
											<div class="order_header clearfix" style="background:#fafafa;width:918px;position:relative;left:-1px;padding-left:0px;border:1px solid #ccc;">
												<div class="fl" style="width:465px;text-align:left;border-left:5px solid #ed145b;">
													<strong style="font-size:14px;position:relative;left:10px;color:#0abfde;">RAINBOW发货</strong>
												</div>
												<div class="fl" style="width:110px;">
													数量
												</div>
												<div class="fl" style="width:160px;">
													单价
												</div>
												<div class="fl" style="width:170px;">
													小计
												</div>
											</div>
											<div style="padding:0px;">
												<div class="clearfix order_info">
												<?php 
													if (!empty($thiscart)){
														
														for ($i =0;$i < $flag;$i ++){
															$getgoods = $database -> select("goods", "*",[
																	"id" => $goods_id[$i]
															]);
															foreach ($getgoods as $rgoods){
																$describe_pic = $rgoods['describe_pic'];
																$name = $rgoods['name'];
																$type = $rgoods['type'];
															}
															echo '<div class="fl relative" style="width:450px;padding:16px 0;line-height:21px;">
														<div style="overflow:hidden;">
															<a href="product.php?goodsid='.$goods_id[$i].'" target="_blank" class="item-pic">
																<img src="'.$describe_pic.'" alt="'.$name.'">
															</a>
															<a href="product.php?goodsid='.$goods_id[$i].'	" target="_blank" class="order_title JS_order_title" title="TOO COOL FOR SCHOOL米酒死皮膏" >
																'.$name.'
															</a><span class="info">容量：'.$type.'</span>
														</div>
													</div>
													<div class="fl" style="width:110px;font-weight:normal;text-align:center;">
														1
													</div>
													<div class="fl price" style="width:100px;">
													<input type="hidden" name="goods'.$i.'" value="'.$goods_id[$i].'">
														¥'.$goods_price[$i].'
													</div>
													<div class="fl price" style="width:110px;">
														<span class="price-to-align" style="margin-left:10px;margin-right:0px;float:left;">¥'.$goods_price[$i].'</span>
													</div>';
															$sum += $goods_price[$i];
														}
													}
												?>
													
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="border_line bottom-confirm" style="margin-bottom: 62px;">
							<div class="summary-container">
								<div class="summary">
									<div class="line line-text">
										<span>共</span><span class="pink" style="color:#ed145b;"><?php echo $flag;?></span><span>件商品,总商品金额:</span><span class="pink sum">¥<?php echo $sum;?></span>
									</div>
									<div class="line need-pay" style="margin-bottom: 0px;">
										<div class="line-text">
											<span>应付总额:</span><span class="pink sum">¥<?php echo $sum;?></span>
										</div>
									</div>
									<div class="confirm_pay main_content clearfix" style="background:#fafafa;height:42px;">
										<div class="submit_box clearfix">
											<div class="fl price_box" style="position:relative;top:8px;">
											<input name="piece" value="<?php echo $flag?>" type="hidden">
											<input name="price" value="<?php echo $sum?>" type="hidden">
												<span>应付总额：</span><span class="price"><span>¥</span><span><?php echo $sum;?></span></span>
											</div>
											<div class="fl" style="position:relative;top:10px;">
												<button type="submit" style="cursor:pointer;font-weight:normal;font-size:18px;" class="submit_btn">确认交易</button>
											</div>
										</div>
									</div>
								</div>
						</div>
					</div>
					</form>
			</div>
		</div>
		<div id="footer_container">
			<div id="footer_textarea">
				<div id="footer_copyright" class="footer_copyright">
					<div class="footer_con">
						<p class="footer_copy_con">
							COPYRIGHT © 2010-2015 RAINBOW.COM 保留一切权利。 客服热线：123-456-789
							<br> ******************************* |*******************************|****************************
						</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>