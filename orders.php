<?php
	require  './inc/config.php';	//加载数据库配置文件
	require './inc/loading.php'; //加载跳转页面函数
	
	
	if (!empty($_COOKIE['mobile'])){
		$user = $database -> select("user", "*",[
				"mobile" => base64_decode(base64_decode($_COOKIE['mobile']))
		]);
		$mobile = base64_decode(base64_decode($_COOKIE['mobile']));
		
		foreach ($user as $userget){
			$username = $userget['realname'];
			$userid = $userget['id'];
		}
	}
	
	if (empty($username)){
		alertAndLoading("请补全信息", "userinfo.php");
	}
	
// 	$all = $database -> select("orders" ,"*",[
// 			"username" => $mobile
// 	]);
	
	$notpay = $database -> select("orders", "*",[
			"AND" => [
					"pay" => 0,
					"username" => $mobile
			]
	]);
	
	if (!empty($notpay)){
		$flag1 = 0;
		foreach ($notpay as $anot){
			$npreceiver[$flag1] = $anot['receiver'];
			$npprice[$flag1] = $anot['price'];
			$nppiece[$flag1] = $anot['piece'];
			$nporderid[$flag1] = $anot['orderid'];
			$flag1++;
		}
	}
	
	$notcomment = $database -> select("orders", "*",[
			"AND" => [
					"pay" => 1,
					"receive" => 1,
					"comment" => null,
					"username" => $mobile,
			]
	]);
	
	if (!empty($notcomment)){
		$flag2 = 0;
		foreach ($notcomment as $notcom){
			$ncreceiver[$flag2] = $notcom['receiver'];
			$ncprice[$flag2] = $notcom['price'];
			$ncpiece[$flag2] = $notcom['piece'];
			$ncorderid[$flag2] = $notcom['orderid'];
			$flag2++;
		}
	}
	
	$receive = $database -> select("orders", "*",[
			"AND" => [
					"receive" => 0,
					"pay" => 1,
					"username" => $mobile
			]
	]);
	
	if (!empty($receive)){
		$flag3 = 0;
		foreach ($receive as $notrec){
			$nrreceiver[$flag3] = $notrec['receiver'];
			$nrprice[$flag3] = $notrec['price'];
			$nrpiece[$flag3] = $notrec['piece'];
			$nrorderid[$flag3] = $notrec['orderid'];
			$flag3++;
		}
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$goods_id = $_POST['goods_id'];
		$price = $_POST['price'];
		$piece = $_POST['piece'];
		$exprice = "";
		$dealtime = date("Y/m/d H:i:s");
	}
?>
<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="textml; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="format-detection" content="telephone=no" />
		<title>我的订单</title>

		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="js/common.js"></script>

		<link rel="stylesheet" href="css/bootstrap.css" />
		<link rel="stylesheet" href="css/index.css" />
		<link rel="stylesheet" href="css/css.css" />

	</head>

	<body style="background-color: #F7F7F7;">
		<div class="cn_renewal cn_main">
			<div id="dialogMsg" title="rainbow"></div>

			<!-- header -->
			<div id="header" class="cn_header_wrap" style="height:70px;margin-bottom: 100px;">
				<div class="cn_header">
					<div class="cn_header_inner">
						<h1><a href="#" title="THE RAINBOW FREE SHOP">
                        <img src="#" alt="RAINBOW FREE SHOP" title="RAINBOW FREE SHOP"></a></h1>
						<h1><a href="index.php" title="THE RAINBOW FREE SHOP">
                        <img src="images/small_rainbow.png" alt="RAINBOW FREE SHOP" title="RAINBOW FREE SHOP"></a></h1>

						<div class="cn_top_menu">
							<ul class="cn_top_global" style="top:15px;">
							<?php 
								if (!empty($mobile)){
									echo '<div style="float: left; font-size: 13px; color: #666">欢迎您，<a href="#" style="color: #ed155b; text-decoration: none;">'.$mobile.'</a>&nbsp;[<a href="index.php?act=deletecookie" style="text-decoration: none; color: #ed155b">退出</a>]</div>';
								}else{
									echo '<li id="login"><a href="login.php">登录</a></li>
								<li><a href="register.php">注册</a></li>';
								}
							?>
								
								<li class="home">
									<a href="index.php">
										<img src="images/ico_home.png" alt=""> 首页
									</a>
								</li>
								<li class="on"><a href="cart.php">购物车</a></li>
							</ul>
						</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr/>
		<!--top-->
		<div class="text-center change container"style="margin-top: -80px;">
			<ul>
				<li style="width: 30%;" onclick="settab_zzjsnet('zzjs_1',1,5)"><span id="zzjs_11" class="hover" style="margin-left: 8px;">待付款</span></li>
				<li style="width: 30%;" onclick="settab_zzjsnet('zzjs_1',2,5)"><span id="zzjs_12">待收货</span></li>
				<li style="width: 30%;" onclick="settab_zzjsnet('zzjs_1',3,5)"><span id="zzjs_13">待评价</span></li>

			</ul>
		</div>
		<!--待付款-->
		<div class="change1 change2 container" style="margin-top:10px;margin-bottom: 100px;">
			<div id="zzjs_zzjs_1_1" class="text-center">
			<?php 
				if (!empty($notpay)){
					for ($i=0;$i<$flag1;$i+=$nppiece[$i]){
						echo '<div class="alls" style="margin-top: 0;">
								<a href="" class="all">
									<p><span class="detial">'.$nporderid[$i].'</span><span class="text-center all1">待付款</span></p>
									<p class="text-left" style="height: 76px;font-size: 12px;padding-top: 12px;">
										<img src="img/all1.png" />
										<span class="name">'.$npreceiver[$i].'</span>
										<span class="pice"><label>￥'.$npprice[$i].'</label><label class="num">x1</label></span>
									</p>
									<p style="font-size: 12px;">
										<span class="alls1" style="float: right;margin-right: 15px;">立即支付</span>
									</p>
								</a>
							</div>
							<div class="clear"></div>';
					}
				}
			?>
				
			</div>
			<!--待收货-->
			<div id="zzjs_zzjs_1_2" class="text-center" style="display: none">
			<?php 
				if (!empty($receive)){
					for ($j = 0;$j<$flag3;$j+=$nrpiece[$j]){
						echo '<div class="alls" style="margin-top: 0;">
								<a href="#" class="all">
									<p><span class="detial">'.$nrorderid[$j].'</span><span class="text-center all1">已发货</span></p>
									<p class="text-left" style="height: 76px;font-size: 12px;padding-top: 12px;">
										<img src="img/all1.png" />
										<span class="name">'.$nrreceiver[$j].'</span>
										<span class="pice"><label>￥'.$nrprice[$j].'</label><label class="num">x1</label></span>
									</p>
									<p style="font-size: 12px;">
										<span class="alls1" style="float: right;margin-right: 15px;">确认收货</span>
										<span class="alls1" style="float: right;">订单跟踪</span>
									</p>
								</a>
							</div>
							<div class="clear"></div>';
					}
				}
			?>
			</div>

			<!--待评价-->
			<div id="zzjs_zzjs_1_3" class="text-center" style="display: none">
			<?php 
				if (!empty($notcomment)){
					for ($k=0;$k<$flag2;$k+=$ncpiece[$k]){
						echo '<div class="alls" style="margin-top: 0;">
								<a href="#" class="all">
									<p><span class="detial">'.$ncorderid[$k].'</span><span class="text-center all1">已收货</span></p>
									<p class="text-left" style="height: 76px;font-size: 12px;padding-top: 12px;">
										<img src="img/all1.png" />
										<span class="name">'.$ncreceiver[$k].'</span>
										<span class="pice"><label>￥'.$ncprice[$k].'</label><label class="num">x1</label></span>
									</p>
									<p style="font-size: 12px;">
										<span class="alls1" style="float: right;margin-right: 15px;">评价</span>
										<span class="alls1" style="float: right;">订单跟踪</span>
									</p>
								</a>
							</div>
							<div class="clear"></div>';
					}
				}
			?>
				
			</div>
		</div>

		<!--footer-->
	<?php
	require 'footer.php';
	?>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</body>

</html>