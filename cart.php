<?php
	require  './inc/config.php';	//加载数据库配置文件
	require './inc/loading.php'; //加载跳转页面函数.
	if (empty($_COOKIE['mobile'])){
		alertAndLoading("非用户，请先登录", "login.php");
	}
	$mobile = base64_decode(base64_decode($_COOKIE['mobile']));
	$datas = $database->select("cart", "*",[
			"mobile" => $mobile
	]);
	$flag = 0;
	if (!empty($datas)){
		foreach ($datas as $data){
			$ids[$flag] = $data['id'];
			$goods_id[$flag] = $data['goods_id'];
			$goods_price[$flag] = $data['goods_price'];
			$time[$flag] = $data['time'];
			$flag++;
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
		<title>Rainbow - 【购物车】</title>
	</head>
	<body>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/cart.css">
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
            <div class="order_path order_path_1">
            </div>
        </div>
    </div>
</div>
<!--container-->
<div id="container" style="width: auto;">
	<div class="content_show_wrapper"> 
		<div class="cart_notification cart_error" style=""> 
        	<div class="message"> 
            	<p></p> 
            </div> 
        </div> 
        <div id="group_show"> 
        	<div class="content_header clearfix">
                <div class="top_banner"> 
                	<ul class="header_icons"> 
                    	<li> 
                        	<span> 
                        		<i class="icon_zhenpin header_icon png"></i> 真品防伪码 </span> </li> 
                        <li> 
                        	<span> 
                            	<i class="icon_tuihuo header_icon png"></i> 30天无条件退货 </span> </li> 
                        <li> 
                        	<span> 
                            	<i class="icon_baoyou header_icon png"></i> 美妆满2件或299元包邮 </span> </li>
                    </ul> 
               	</div>  
                <div class="common_shippment"> 
                	<i class="icon_small icon_baoyou png">包邮</i> 新用户首单全场满39元包邮,自营非食品类满两件或满299元包邮,极速免税店单件包邮 </div>   
           	</div>  
            <div class="groups_wrapper"> 
            	<table class="cart_group_item  cart_group_item_product"> 
                	<thead> 
                    	<tr> 
                        	<th class="cart_overview"> 
                            	<div class="cart_group_header"> 
                                	<input type="checkbox" class="js_group_selector cart_group_selector" checked="checked"> 
                                    	<h2>  RAINBOW发货  </h2> 
                                </div>
                            </th> 
                            <th class="cart_price">单价（元）</th> 
                            <th class="cart_option">操作</th> 
                       	</tr> 
         			</thead> 
         			<?php 
         				$sum = 0;
         				$howmany = 0;
         				if (!empty($datas)){
         					for($i=0;$i<$flag;$i++){
         						$goods = $database -> select("goods", "*",[
         								"id" => $goods_id[$i]
         						]);
         						foreach ($goods as $getgood){
         							$pic = $getgood['describe_pic'];
         							$goodsname = $getgood['name'];
         							$goodstype = $getgood['type'];
         						}
         						$sum += $goods_price[$i];
         						$howmany++;
		         					echo '<tbody>   
					                    	<tr class="cart_item " hashid="ht160321p2085913t2" id="702016860_ht160321p2085913t2" product_id="2085913" item_price="118.00" category_v3_3="38" brand_id="10593" product_type="global_deal"> 
					                        	<td valign="top"> 
					                            	<div class="cart_item_desc clearfix">  
					                                	<input type="checkbox" class="js_item_selector cart_item_selector" data-item-key="702016860_ht160321p2085913t2" data-app="all" /">  
					                              	<div class="cart_item_desc_wrapper"> 
					                                	<a class="cart_item_pic" href="" target="_blank"> 
					                                    	<img src="'.$pic.'" style="width:60px; height:60px;"  alt=""> 
					                                        	<span class="sold_out_pic png"></span> </a>
					                                    				<a class="cart_item_link" title="'.$goodsname.'" href="" target="_blank">'.$goodsname.'</a> 	
					                                                    	<p class="sku_info">容量：
					                                                        	<span class="cart_item_capacity">'.$goodstype.'</span>   
					                                                        </p> 
					                                       	<div class="sale_info clearfix"> 
					                                    	</div> 
					                               		</div> 
					                            	</div> 
					                          	</td> 
					                            <td> 	
					                            	<div class="cart_item_price"> 
					                                	<p class="jumei_price">'.$goods_price[$i].'</p>  
					                                    <p class="market_price  hide">218.90</p>  
					                                </div> 
					                         	</td> 
					                            
					                            <td> 
					                            	<div class="cart_item_option"> 
					                                	<a class="icon_small delete_item png" data-item-key="702016860_ht160321p2085913t2" href="cart.php?act=deletecart&cart_id='.$ids[$i].'" title="删除"></a> 
					                                </div> 
					                            </td> 
					                       	</tr>   
					                 	</tbody> ';
         					}
         					echo '<tfoot> 
			                    	<tr> 
			                        	<td colspan="5">
										商品金额：
										<span class="group_total_price">¥'.$sum.'</span>
										</td>
										</tr>
							</tfoot>
                        			</table>
									</div>
									<div class="common_handler_anchor">
									</div>
									<div class="common_handler common_handler_fixed">
										<div class="right_handler">
											共
											<span class="total_amount">
												'.$howmany.'
											</span> &nbsp;件商品 &nbsp;&nbsp; 商品应付总额：
											<span class="total_price">¥'.$sum.'</span>
											<a id="go_to_order" class="btn" href="pay.php?money='.$sum.'">
												去结算
											</a>
								</div>
							</div>';
         				}
         			?>
                    
                    
									
		</div>
	</div>
</div>

<!--footer-->
<?php
	require'footer.php';
?>
</body>
</html>