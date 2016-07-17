<?php
	require  './inc/config.php';	//加载数据库配置文件
	require './inc/loading.php'; //加载跳转页面函数
	
	setcookie('indexpic',base64_encode(base64_encode('/images/bg,jpg')),time()+86400,'/');
	
	$username = "";
	if (!empty($_COOKIE['mobile'])){
		$username = base64_decode(base64_decode($_COOKIE['mobile']));
	}
	$allcategory = $database -> select("category", "*");
	
	$allnew = $database -> select("goods", "*",[
			"AND" => [
			"addtime[>=]" => date("Y/m/d")." 00:00:00",
			"addtime[<=]" => date('Y/m/d',strtotime('+1 day'))." 00:00:00"
	]]);
	$allcrazy = $database -> select("goods", "*",[
			"crazy" => 1
	]);
	
	$alltop3 = $database -> select("goods", "*",[
			"top3" => 1
	]);
	
	if (!empty($_REQUEST['act'])){
		$act = $_REQUEST['act'];
		if ($act == "deletecookie"){
			setcookie('mobile',base64_encode(base64_encode($_COOKIE['mobile'])),time()-3600,'/');
			loading('index.php');
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($act == "search"){
				loading("brandgoods.php?getgoods=".$_POST['options']);
			}
		}
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>
			Rainbow - 【正品韩国化妆品网站】
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Cache-Control" content="No-Cache">
		<meta http-equiv="Pragma" content="No-Cache">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta name="renderer" content="ie-stand">
		<meta name="viewport" content="width=device-width,initial-scale=1" />
		<link rel="stylesheet" type="text/css" href="css/css.css">
		<script type="text/javascript" src="js/jquery-1.7.2.min.js">
		</script>
		<script type="text/javascript" src="layer/layer.js">
		</script>
	</head>
	<?php
	if (!empty($_COOKIE['indexpic'])) {
	} else {
		echo '<body onload="load();navi()" style="background: #f7f7f7;">';
	}
	?>
	<body onload="navi()" style="background: #f7f7f7;">
		<div class="cn_renewal cn_main">
			<div id="dialogMsg" title="rainbow">
			</div>
			<!-- header -->
			<div id="header" class="cn_header_wrap">
				<div class="cn_header">
					<div class="cn_header_inner">
						<h1>
							<a href="#" title="THE RAINBOW FREE SHOP">
								<img src="#" alt="RAINBOW FREE SHOP" title="RAINBOW FREE SHOP">
							</a>
						</h1>
						<h1>
							<a href="index.php" title="THE RAINBOW FREE SHOP">
								<img src="images/rainbow.png" alt="RAINBOW FREE SHOP" title="RAINBOW FREE SHOP">
							</a>
						</h1>
						<div class="cn_top_menu">
							<ul class="cn_top_global">
								<?php
								if (!empty($_COOKIE['mobile'])) {
									echo '
<div style="float: left; font-size: 13px; color: #666">欢迎您，<b><a href="userinfo.php" style=" text-decoration: none;">' . $username . '</a></b>&nbsp;[<a href="index.php?act=deletecookie" style="text-decoration: none; color: #ed155b">退出</a>]</div>
<li class="home">
<a href="index.php">
<img src="images/ico_home.png" alt=""> 首页
</a>
</li>
<li><a href="userinfo.php">信息完善</a></li>
<li class="on"><a href="cart.php">购物车</a></li>
<li><a href="orders.php">我的订单</a></li>';
								} else {
									echo '<li class="home">
<a href="index.php">
<img src="images/ico_home.png" alt=""> 首页
</a>
</li>
<li id="login"><a href="login.php">登录</a></li>
<li><a href="register.php">注册</a></li>';
								}
								?>
							</ul>
						</div>
						<div class="search cn_search_box">
							<div class="cn_search_area">
								<div id="searchbar_jj" class="searchbar">
									<input type="image" class="cn_btn_search" src="images/btn_search.gif" alt="搜索" title="搜索" onclick="">
								</div>
								<form id="searchFrm_h" name="searchFrm_h" method="post" action="index.php?act=search">
									<div class="searchbar">
										<span class="cn_input_area">
											<input type="text" id="query_h" name="options" class="input" title="">
										</span>
										<input type="image" class="cn_btn_search_head" src="images/gnb_btn_search.png" alt="搜索" title="搜索">
										<input type="image" class="cn_btn_search" src="images/btn_search.gif" alt="搜索" title="搜索">
									</div>
								</form>
							</div>
							<div>
							</div>
						</div>
					</div>
					<!-- 导航栏-->
					<div class="cn_gnb_wrap">
						<div class="cn_gnb">
							<ul class="cn_shopin_menu">
								<li class="cn_shop_duty" id="cn_shop_duty">
									<a href="#" onclick="return false;">
										商品分类
									</a>
								</li>
								<li class="cn_shop_product" id="cn_shop_product">
									<a href="#" onclick="return false;">
										品牌分类
									</a>
								</li>
							</ul>
							<ul class="cn_gnb_menu" style="margin-left: 20%;">
								<li>
									<a href="brandgoods.php" onmousedown="">
										全部商品
									</a>
								</li>
								<li>
									<a href="#mad" onmousedown="">
										今日疯抢
									</a>
								</li>
								<li>
									<a href="#brand" onmousedown="">
										品牌团
									</a>
								</li>
								<li>
									<a href="#top3" onmousedown="">
										TOP3
									</a>
								</li>
								<li>
									<a href="#new" onmousedown="">
										今日上新
									</a>
								</li>
							</ul>
						</div>
						<div>
							<a href="brandgoods.php">
								<img src="images/bg.jpg" width="100%" alt="">
							</a>
						</div>
					</div>
					<!--商品分类-->
					<div class="cn_brand_view" id="cn_goods_view" style="display: none;height:160px;border:1px solid #C0C0C0">
						<div id="tabs1-1" class="cn_cata_detail cn_tab_contents on">
							<div class="cn_dept_item_type">
								<dl>
									<dt>
										<a href="">
											护肤
										</a>
									</dt>
									<dd class="first">
									<?php 
										if (!empty($allcategory)){
											foreach ($allcategory as $category){
												echo '
												<a href="brandgoods.php?category=洁面">
																				'.$category['name'].'
												</a>';
											}
										}
									?>
								</dl>
								<dl>
									<dt>
										<a href="">
											彩妆
										</a>
									</dt>
									<dd>
										<a href="brandgoods.php?category=BB霜">
											BB霜
										</a>
										<a href="brandgoods.php?category=粉底液">
											粉底液
										</a>
										<a href="brandgoods.php?category=遮瑕笔">
											遮瑕笔
										</a>
										<a href="brandgoods.php?category=气垫BB">
											气垫BB
										</a>
										<a href="brandgoods.php?category=眼影">
											眼影
										</a>
										<a href="brandgoods.php?category=眼线笔">
											眼线笔
										</a>
										<a href="brandgoods.php?category=睫毛膏">
											睫毛膏
										</a>
										<a href="brandgoods.php?category=眉笔">
											眉笔
										</a>
										<a href="brandgoods.php?category=口红">
											口红
										</a>
										<a href="brandgoods.php?category=唇膏">
											唇膏
										</a>
										<a href="brandgoods.php?category=腮红">
											腮红
										</a>
								</dl>
							</div>
						</div>
					</div>
					<!--品牌分类-->
					<div class="cn_brand_view" id="cn_brand_view" style="display: none;">
						<div class="cn_brand_view-wrap">
							<div class="cn_brand_cont cn_tab_wrap">
								<div class="cn_brand_sort cn_tab_list">
									<div id="alphabetindex" class="cn_sort_cont">
										<a href="brandgoods.php?search=brand&brand=1" onclick="javascript:ScrollBrandListII(this, 1,0);return false;">
											1
										</a>
										<a href="brandgoods.php?search=brand&brand=2" onclick="javascript:ScrollBrandListII(this, 1,1);return false;">
											2
										</a>
										<a href="brandgoods.php?search=brand&brand=3" onclick="javascript:ScrollBrandListII(this, 1,2);return false;">
											3
										</a>
										<a href="brandgoods.php?search=brand&brand=4" onclick="javascript:ScrollBrandListII(this, 1,3);return false;">
											4
										</a>
										<a href="brandgoods.php?search=brand&brand=a" onclick="javascript:ScrollBrandListII(this, 1,4);return false;">
											A
										</a>
										<a href="brandgoods.php?search=brand&brand=b" onclick="document.getElemetnById('cn_scroll').scrollIntoView(true);return false;">
											B
										</a>
										<a href="brandgoods.php?search=brand&brand=c" onclick="javascript:ScrollBrandListII(this, 1,6);return false;">
											C
										</a>
										<a href="brandgoods.php?search=brand&brand=d" onclick="javascript:ScrollBrandListII(this, 1,7);return false;">
											D
										</a>
										<a href="brandgoods.php?search=brand&brand=e" onclick="javascript:ScrollBrandListII(this, 1,8);return false;">
											E
										</a>
										<a href="brandgoods.php?search=brand&brand=f" onclick="javascript:ScrollBrandListII(this, 1,9);return false;">
											F
										</a>
										<a href="#gbrand" onclick="javascript:ScrollBrandListII(this, 1,10);return false;">
											G
										</a>
										<a href="brandgoods.php?search=brand&brand=h" onclick="javascript:ScrollBrandListII(this, 1,11);return false;">
											H
										</a>
										<a href="brandgoods.php?search=brand&brand=i" onclick="javascript:ScrollBrandListII(this, 1,12);return false;">
											I
										</a>
										<a href="brandgoods.php?search=brand&brand=j" onclick="javascript:ScrollBrandListII(this, 1,13);return false;">
											J
										</a>
										<a href="brandgoods.php?search=brand&brand=k" onclick="javascript:ScrollBrandListII(this, 1,14);return false;">
											K
										</a>
										<a href="brandgoods.php?search=brand&brand=l" onclick="javascript:ScrollBrandListII(this, 1,15);return false;">
											L
										</a>
										<a href="brandgoods.php?search=brand&brand=m" onclick="javascript:ScrollBrandListII(this, 1,16);return false;">
											M
										</a>
										<a href="brandgoods.php?search=brand&brand=n" onclick="javascript:ScrollBrandListII(this, 1,17);return false;">
											N
										</a>
										<a href="brandgoods.php?search=brand&brand=o" onclick="javascript:ScrollBrandListII(this, 1,18);return false;">
											O
										</a>
										<a href="brandgoods.php?search=brand&brand=p" onclick="javascript:ScrollBrandListII(this, 1,19);return false;">
											P
										</a>
										<a href="brandgoods.php?search=brand&brand=r" onclick="javascript:ScrollBrandListII(this, 1,20);return false;">
											R
										</a>
										<a href="brandgoods.php?search=brand&brand=s" onclick="javascript:ScrollBrandListII(this, 1,21);return false;">
											S
										</a>
										<a href="#tbrand" onclick="javascript:ScrollBrandListII(this, 1,22);return false;">
											T
										</a>
										<a href="brandgoods.php?search=brand&brand=u" onclick="javascript:ScrollBrandListII(this, 1,23);return false;">
											U
										</a>
										<a href="brandgoods.php?search=brand&brand=v" onclick="javascript:ScrollBrandListII(this, 1,24);return false;">
											V
										</a>
										<a href="brandgoods.php?search=brand&brand=w" onclick="javascript:ScrollBrandListII(this, 1,25);return false;">
											W
										</a>
										<a href="brandgoods.php?search=brand&brand=y" onclick="javascript:ScrollBrandListII(this, 1,26);return false;">
											Y
										</a>
										<a href="brandgoods.php?search=brand&brand=z" onclick="javascript:ScrollBrandListII(this, 1,27);return false;">
											Z
										</a>
									</div>
								</div>
								<div class="cn_scroll" id="cn_scroll">
									<div class="jspContainer">
										<div id="alphabetlist" class="cn_tab_cont cn_brand_part_gp on">
											<div class="cn_brand_part">
												<em class="part_tit">A</em>
												<div>
													<a href="brandgoods.php?search=brand&brand=amore">
														amore
													</a>
												</div>
											</div>
											<div class="cn_brand_part">
												<em class="part_tit">C</em>
												<div>
													<a href="brandgoods.php?search=brand&brand=charmzone">
														charmzone
													</a>
													<a href="brandgoods.php?search=brand&brand=cloud9">
														cloud9
													</a>
												</div>
											</div>
											<div class="cn_brand_part">
												<em class="part_tit" id="gbrand">G</em>
												<div>
													<a href="brandgoods.php?search=brand&brand=guerisson">
														guerisson
													</a>
												</div>
											</div>
											<div class="cn_brand_part">
												<em class="part_tit">H</em>
												<div>
													<a href="brandgoods.php?search=brand&brand=hera">
														hera
													</a>
												</div>
											</div>
											<div class="cn_brand_part">
												<em class="part_tit">I</em>
												<div>
													<a href="brandgoods.php?search=brand&brand=innisfree">
														innisfree
													</a>
													<a href="brandgoods.php?search=brand&brand=iope">
														iope
													</a>
													<a href="brandgoods.php?search=brand&brand=it's skin">
														it's skin
													</a>
												</div>
											</div>
											<div class="cn_brand_part">
												<em class="part_tit">L</em>
												<div>
													<a href="brandgoods.php?search=brand&brand=laneige">
														laneige
													</a>
												</div>
											</div>
											<div class="cn_brand_part">
												<em class="part_tit">M</em>
												<div>
													<a href="brandgoods.php?search=brand&brand=missha">
														missha
													</a>
												</div>
											</div>
											<div class="cn_brand_part">
												<em class="part_tit">S</em>
												<div>
													<a href="brandgoods.php?search=brand&brand=skinfood">
														skinfood
													</a>
													<a href="brandgoods.php?search=brand&brand=sulwhasoo">
														sulwhasoo
													</a>
												</div>
											</div>
											<div class="cn_brand_part">
												<em class="part_tit" id="tbrand">T</em>
												<div>
													<a href="brandgoods.php?search=brand&brand=the face shop">
														the face shop
													</a>
													<a href="brandgoods.php?search=brand&brand=the history of whoo">
														the history of whoo
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--今日疯抢-->
					<div class="home_top_tab" id="home_top_tab" style="margin-top: 30%;">
						<ul class="tab_menu clearfix">
							<li class="current" id="mad" style="margin-left: 25%;">
								今日疯抢
							</li>
						</ul>
					</div>
					<div class="tab_wrapper">
						<div class="tab_content">
							<div class="tab_box">
								<div class="home_top_ad">
									<div class="home_ad_list clearfix" style="margin-top: 13px;">
										<a href="brandgoods.php?search=crazy&brand=skin" target="_blank">
											<img src="images/a1.jpg" border="0" alt="">
										</a>
										<a href="brandgoods.php?search=crazy&category=面膜" target="_blank">
											<img src="images/a2.jpg" border="0" alt="">
										</a>
										<a href="brandgoods.php?search=crazy&brand=sulwhasoo" target="_blank">
											<img src="images/a3.jpg" border="0" alt="">
										</a>
										<a href="brandgoods.php?search=crazy&category=水乳" target="_blank">
											<img src="images/a4.jpg" border="0" alt="">
										</a>
										<a href="brandgoods.php?search=crazy&brand=whoo" target="_blank">
											<img src="images/a5.jpg" border="0" alt="">
										</a>
										<a href="brandgoods.php?search=crazy&category=喷雾" target="_blank">
											<img src="images/a6.jpg" border="0" alt="">
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--品牌团-->
					<div class="home_top_tab" id="">
						<ul class="tab_menu clearfix" style="margin-left: 42%;">
							<li class="current" id="brand">
								品牌团
							</li>
						</ul>
						<div class="tab_wrapper">
							<div class="tab_content">
								<div class="tab_box">
									<div class="home_top_ad home_top_ad1">
										<div class="home_ad_list clearfix" style="width:100%;">
											<a href="brandgoods.php?search=brand&brand=innisfree" target="_blank">
												<img src="images/brand/brand1.jpg" border="0" alt="">
											</a>
											<a href="brandgoods.php?search=brand&brand=whoo" target="_blank">
												<img src="images/brand/brand2.gif" border="0" alt="">
											</a>
											<a href="brandgoods.php?search=brand&brand=laneige" target="_blank">
												<img src="images/brand/brand3.jpg" border="0" alt="">
											</a>
											<a href="brandgoods.php?search=brand&brand=faceshop" target="_blank">
												<img src="images/brand/brand4.jpg" border="0" alt="">
											</a>
											<a href="brandgoods.php?search=brand&brand=missha" target="_blank">
												<img src="images/brand/brand5.png" border="0" alt="">
											</a>
											<a href="brandgoods.php?search=brand&brand=sulwhasoo" target="_blank">
												<img src="images/brand/brand6.jpg" border="0" alt="">
											</a>
											<a href="brandgoods.php?search=brand&brand=skin" target="_blank">
												<img src="images/brand/brand7.jpg" border="0" alt="">
											</a>
											<a href="brandgoods.php?search=brand&brand=charmzone" target="_blank">
												<img src="images/brand/brand8.jpg" border="0" alt="">
											</a>
											<a href="brandgoods.php?search=brand&brand=hera" target="_blank">
												<img src="images/brand/brand9.jpg" border="0" alt="">
											</a>
											<a href="brandgoods.php?search=brand&brand=cloud" target="_blank">
												<img src="images/brand/brand10.jpg" border="0" alt="">
											</a>
											<a href="brandgoods.php?search=brand&brand=amore" target="_blank">
												<img src="images/brand/brand11.jpg" border="0" alt="">
											</a>
											<a href="brandgoods.php?search=brand&brand=iope" target="_blank">
												<img src="images/brand/brand12.jpg" border="0" alt="">
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--TOP3-->
					<div class="brand_list_box" id="home_new">
						<div style="height: 80px; width: 80%; margin-left: auto; margin-right: auto; background: #fff url(images/54101_1920_80_001-web.jpg) no-repeat top center;">
						</div>
						<div class="home_top_tab" id="Div1">
							<ul class="tab_menu clearfix" style="margin-left: 42%; margin-top: 2px;">
								<li class="current" id="top3">
									TOP3
								</li>
							</ul>
							<div class="home_top_ad">
							</div>
							<?php
							if (!empty($alltop3)) {
								foreach ($alltop3 as $top3) {
									echo '<div class="product_introduce clearfix" price="89" search_product_id="2146804" search_brand_id="10957" search_product_type="global_deal" search_hash_id="ht160406p2146804t2" search_warehouse_id="0" search_spu_id="101244" search_category_id="14" search_page="1"
search_pos="1" search_show_id="0">
<div class="pro_left">
<a href="product.php?goodsid=' . $top3['id'] . '" class="pro_a_in" target="_blank">
<div class="p_img_lg">
<img alt="" class="img_600" src="' . $top3['top3_pic'] . '">
</div>
</a>
</div>
<div class="pro_right" target="_blank">
<a href="product.php?goodsid=' . $top3['id'] . '" target="_blank">
<div class="flag_box clearfix">
<div class="flag_box_main fl clearfix">
<img src="images/product/021_flag.jpg" class="p_img_lg fl" />
<ul class="flag_text">
<li>Korea</li>
<li>韩国品牌</li>
</ul>
</div>
</div>
<p class="pro_eng_tit"><span class="f15">' . $top3['name'] . '</span><i class="mlr_5">/</i>(' . $top3['brand'] . ') </p>
<p class="pro_des  ">
<strong>【正品直邮】 </strong> ' . $top3['described'] . '
</p>
<div class="price_dis clearfix">
<div class="r_pric_box">
<em class="big_pic">
<span class="currency_arial">¥</span>' . $top3['price'] . '                                        </em>
<span class="org_cx">包邮</span>
</div>
</div>
</a>
<a href="product.php?goodsid=' . $top3['id'] . '" target="_blank">
<div class="shopping_car_layout">
<b class="advance_car_btn"></b>
</div>
</a>
</div>
</div>';
								}
							}
							?>
							<!--今日上新-->
							<div class="home_top_tab" id="">
								<ul class="tab_menu clearfix" style="margin-left: 45%; margin-top: 10px;">
									<li class="current" id="new">
										今日上新
									</li>
								</ul>
								<div class="today_new_productlist" style="width:100%;margin-left: 10%;">
									<ul class="today_new_ul clearfix" id="today_new_ul">
										<?php
										if (!empty($allnew)) {
											foreach ($allnew as $new) {
												echo '<li class="newdeal_box">
<div class="img_box">
<a class="img_box_href" target="_blank" href="product.php?goodsid=' . $new['id'] . '">
<img alt="" src="' . $new['describe_pic'] . '" class="img_400 all_cart_img"></a>
<div class="deals_tags">
<span class="tags_list tags_haitao"></span>
</div>
</div>
<a target="_blank" href="product.php?goodsid=' . $new['id'] . '">
<div class="today_new_detail">
<p class="title">' . $new['name'] . '</p>
<div class="intro_box">
<div class="price_box">
<em>¥</em>
<span class="pnum">' . $new['price'] . '</span>
<div class="price_icon_wrap">
<div class="icon_p">
<span class="y_icon">包邮</span>
</div>
</div>
</div>
</div>
</div>
</a>
</li>';
											}
										}
										?>
									</ul>
								</div>
							</div>
							<!--top-->
							<!--页面打开弹出-->
							<script type="text/javascript">function load() {
	var top_div = document.getElementById("home_nav_bar");
	top_div.style.display = "none";
	//document.getElementsByClassName("layui-layer-title").style.display = "none";
	//alert($(".layui-layer-title").text());
	//iframe层-禁滚动条
	var width = document.body.scrollWidth - 450;
	//alert(width);
	layer.open({
		type: 2,
		area: [width + 'px', '390px'],
		skin: 'layui-layer-rim', //加上边框
		content: ['window.htm', 'no']
	});
}

function navi() {
	//商品分类
	document.getElementById("cn_shop_duty").onmouseover = function() {
		//alert(123123);
		document.getElementById("cn_goods_view").style.display = "block";
		document.getElementById("cn_brand_view").style.display = "none";
		//document.getElementsByClassName("")
	}
	document.getElementById("cn_goods_view").onmouseover = function() {
		document.getElementById("cn_goods_view").style.display = "inline";
		//document.getElementsByClassName("")
	}
	document.getElementById("cn_goods_view").onmouseout = function() {
			document.getElementById("cn_goods_view").style.display = "none";
			//document.getElementsByClassName("")
		}
		//品牌分类
	document.getElementById("cn_shop_product").onmouseover = function() {
		//alert(123123);
		document.getElementById("cn_brand_view").style.display = "block";
		document.getElementById("cn_goods_view").style.display = "none";
		//document.getElementsByClassName("")
	}
	document.getElementById("cn_brand_view").onmouseover = function() {
		document.getElementById("cn_brand_view").style.display = "inline";
		//document.getElementsByClassName("")
	}
	document.getElementById("cn_brand_view").onmouseout = function() {
		document.getElementById("cn_brand_view").style.display = "none";
		//document.getElementsByClassName("")
	}
}
window.onscroll = function() {
	var t = document.documentElement.scrollTop || document.body.scrollTop;
	var top_div = document.getElementById("home_nav_bar");
	if (t < 1350) {
		top_div.style.display = "none";
	}
	if (t >= 1350) {
		top_div.style.display = "inline";
	} else {
		top_div.style.display = "none";
	}
}</script>
							<!--左边飘窗-->
							<div id="home_nav_bar" class="home_nav_bar home_nav_bar_action" style="margin-left: auto;display: none;">
								<div class="home_nav_border">
									<ul class="">
										<li class="nav_mustsee">
											<a href="#mad" class="act">
												<span>今日疯抢</span>
											</a>
										</li>
										<li class="nav_brand">
											<a href="#brand" class="">
												<span>品牌团</span>
											</a>
										</li>
										<li class="nav_top3">
											<a href="#top3" class="">
												<span>TOP3</span>
											</a>
										</li>
										<li class="nav_today_deals">
											<a href="#new" class="">
												<span>上新单品</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
							<!--右边飘窗-->
							<div id="Div2" class="home_nav_bar">
								<div class="home_nav_border">
									<img alt="" href="#" src="">
								</div>
							</div>
							<?php
							require 'footer.php';
							?>
						</div>
					</div>
				</div>
	</body>
</html>