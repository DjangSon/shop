<?php
	require  './inc/config.php';	//加载数据库配置文件
	require './inc/loading.php'; //加载跳转页面函数

	if (empty($_GET['search'])){
		$search = $database -> select("goods", "*");
	}
	
	if (!empty($_COOKIE['mobile'])){
		$mobile = base64_decode(base64_decode($_COOKIE['mobile']));
	}
	
	if (!empty($_GET['getgoods'])){
		$search = $database -> select("goods", "*",[
				"OR" => [
						"name[~]" => $_GET['getgoods'],	
						"type[~]" => $_GET['getgoods'],
						"function[~]" => $_GET['getgoods'],
						"cbrand[~]" => $_GET['getgoods'],
						"brand[~]" => $_GET['getgoods'],
						"category[~]" => $_GET['getgoods'],
				]
		]);
	}
	if (!empty($_GET['sortph'])){
		$search = $database -> select("goods", "*",[
				"ORDER" => "price DESC",
		]);
	}
	
	if (!empty($_GET['sortpl'])){
		$search = $database -> select("goods", "*",[
				"ORDER" => "price",
		]);
	}
	
	if (!empty($_GET['category'])){
		$search = $database -> select("goods", "*",[
						"category[~]" => $_GET['category'],
		]);
	}
	
	if (!empty($_GET['sortt'])){
		$search = $database -> select("goods", "*",[
				"ORDER" => "addtime DESC",
		]);
	}
	
	if (!empty($_GET['sorts'])){
		$search = $database -> select("goods", "*",[
				"ORDER" => "sales DESC",
		]);
	}
	
	if (!empty($_GET['function'])){
		$search = $database -> select("goods", "*",[
				"function[~]" => $_GET['function'],
		]);
	}
	
	if (!empty($_GET['search'])){
		if ($_GET['search'] == "crazy"){
			if (!empty($_GET['brand'])){
				$search = $database -> select("goods", "*",[
						"AND" => [
								"brand[~]" => $_GET['brand'],
								"crazy" => 1
						]
				]);
			}elseif (!empty($_GET['category'])){
				$search = $database -> select("goods", "*",[
						"AND" => [
								"category[~]" => $_GET['category'],
								"crazy" => 1
						]
				]);
			}
		}elseif ($_GET['search'] == "brand"){
			$search = $database -> select("goods", "*",[
					"brand[~]" => $_GET['brand']
			]);
		}
	}
// 	var_dump($search);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Rainbow - 【商品】</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <link rel="stylesheet" type="text/css" href="css/css.css">
    <link rel="stylesheet" type="text/css" href="css/brandgoods.css">
</head>
<body style="background: #f7f7f7;">
    <div class="cn_renewal cn_main">
        <div id="dialogMsg" title="rainbow"></div>

        <!-- header -->
        <div id="header" class="cn_header_wrap">
            <div class="cn_header">
                <div class="cn_header_inner">
                    <h1><a href="#" title="THE RAINBOW FREE SHOP">
                        <img src="#" alt="RAINBOW FREE SHOP" title="RAINBOW FREE SHOP"></a></h1>
                    <h1><a href="index.php" title="THE RAINBOW FREE SHOP">
                        <img src="images/rainbow.png" alt="RAINBOW FREE SHOP" title="RAINBOW FREE SHOP"></a></h1>

                    <div class="cn_top_menu">
                        <ul class="cn_top_global">
                        <?php 
                        	if (!empty($mobile)){
                        		echo ' <div style="float: left; font-size: 13px; color: #666">欢迎您，<a href="#" style="color: #ed155b; text-decoration: none;">'.$mobile.'</a>&nbsp;<a href="index.php?deletecookie" style="text-decoration: none;color: #ed155b">[退出]</a></div>';
                        	}else{
                        		echo '
                            <li id="login"><a href="login.php">登录</a></li>
                            <li><a href="register.php">注册</a></li>';
                        	}
                        ?>
                        	<li class="home">
								<a href="index.php">
									<img src="images/ico_home.png" alt=""> 首页
								</a>
							</li>
                            <li class="on"><a href="cart.php">购物车</a></li>
                            <li><a href="orders.php">我的订单</a></li>
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
                                        <input type="text" id="query_h" name="options" class="input" title=""></span>
                                    <input type="image" class="cn_btn_search_head" src="images/gnb_btn_search.png" alt="搜索" title="搜索">
                                    <input type="image" class="cn_btn_search" src="images/btn_search.gif" alt="搜索" title="搜索">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--商品-->
    <div id="body">
        <div id="search_result_wrap">
            <!--存在搜索结果显示的 页面内容 start-->

            <div class="search_info" id="J_search_info" style="display: block;">
        
                <a href="" target="_blank" class="s_i_into png"></a></div>
            <div class="search_filter">

                <div class="filter_con">
                    <div class="filter_tit">
                        <span>分类:</span>
                    </div>
                    <div class="filter_attrs" id="filter_cat" style="height: auto;">
                        <ul>
                        	<li class="" title="">
                                <a name="" id="" href="brandgoods.php">全部
                                </a>
                            </li>
                        	<li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=洁面">洁面
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=爽肤水">爽肤水
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=柔肤水">柔肤水
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=化妆水">化妆水
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=精华素">精华素
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=乳液">乳液
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=水乳">水乳
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=面霜">面霜
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=喷雾">喷雾
                                </a>
                            </li>
                            <li class="" title="面霜">
                                <a name="" id="" href="brandgoods.php?category=面膜">面膜
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=BB霜">BB霜
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=气垫BB">气垫BB
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=粉底液">粉底液
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=眼影">眼影
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=眼线笔">眼线笔
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=睫毛膏">睫毛膏
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=眉笔">眉笔
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=口红">口红
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=腮红">腮红
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=遮瑕笔">遮瑕笔
                                </a>
                            </li>
                            <li class="" title="">
                                <a name="" id="" href="brandgoods.php?category=唇膏">唇膏
                                </a>
                            </li>
                    	</ul>
                    </div>
                </div>


                <div class="filter_con">
                    <div class="filter_tit">功效:</div>
                    <div class="filter_attrs" id="filter_fun">
                        <ul>
                            <li class="" title=""><a name="" id="" href="brandgoods.php?function=保湿">保湿
                            </a>
                            </li>
                            <li class="" title=""><a name="" id="" href="brandgoods.php?function=补水">补水
                            </a>
                            </li>
                            <li class="" title=""><a name="" id="" href="brandgoods.php?function=滋润">滋润
                            </a>
                            </li>
                            <li class="" title=""><a name="" id="" href="brandgoods.php?function=清洁">清洁
                            </a>
                            </li>
                            <li class="" title=""><a name="" id="" href="brandgoods.php?function=控油">控油
                            </a>
                            </li>
                            <li class="" title=""><a name="" id="" href="brandgoods.php?function=护理">护理
                            </a>
                            </li>
                            <li class="" title=""><a name="" id="" href="brandgoods.php?function=遮瑕">遮瑕
                            </a>
                            </li>
                            <li class="" title=""><a name="" id="" href="brandgoods.php?function=隔离">隔离
                            </a>
                            </li>
                            <li class="" title=""><a name="" id="" href="brandgoods.php?function=美白">美白
                            </a>
                            </li>
                            <li class="" title=""><a name="" id="" href="brandgoods.php?function=去黑头">去黑头
                            </a>
                            </li>
                            <li class="" title=""><a name="" id="" href="brandgoods.php?function=紧致">紧致
                            </a>
                            </li>
                            <li class="" title=""><a name="" id="" href="brandgoods.php?function=祛痘">祛痘
                            </a>
                            </li>
                            <li class="" title=""><a name="" id="" href="brandgoods.php?function=柔肤">柔肤
                            </a>
                            </li>
                            <li class="" title=""><a name="" id="" href="brandgoods.php?function=去眼袋">去眼袋
                            </a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="filter_con">
                    <div class="filter_tit">排序:</div>
                    <div class="filter_attrs" id="filter_fun">
                        <ul>
                    		<li class="selected">
		                    <a class="">默认<img src="images/desc_selected_hover.png" style="padding-bottom: 6px;padding-left: 9px;"></a>
		                	</li>
			                <li class="" style="width: 102px">           
			                	<a class="" href="brandgoods.php?sortph=price" >价格从高到低<img src="images/desc_selected_hover.png" style="padding-bottom: 6px;padding-left: 9px;"></a>
			                </li>
			                 <li class="" style="width: 102px">           
			                	<a class="" href="brandgoods.php?sortpl=price" >价格从低到高<img src="images/desc_selected_hover.png" style="padding-bottom: 6px;padding-left: 9px;"></a>
			                </li>
			                <li>
			                    <a class="" href="brandgoods.php?sorts=sales">销量<img src="images/desc_selected_hover.png" style="padding-bottom: 6px;padding-left: 9px;"></a>
			                </li>
			                <li>
			                    <a class="" href="brandgoods.php?sortt=addtime">上架时间<img src="images/desc_selected_hover.png" style="padding-bottom: 6px;padding-left: 9px;"></a>
			                </li> 
                        </ul>
                    </div>
                </div>
                
                
            </div>


            <div id="search_list_wrap">
                <div class="products_wrap">
                    <ul>
                        <!--deal start-->
                        <?php 
                        	if (!empty($search)){
                        		foreach ($search as $goods){
                        			echo '<li class="formall item">
				                            <div class="item_wrap clearfix" style="left: -14px;">
				                                <div class="item_wrap_left" style="float: right; display: none;">
				                                    <a class="cs_prev disabled"></a>
				                                    
				                                    <a class="cs_next"></a>
				                                </div>
				                                <div class="item_wrap_right deal_item_wrap" style="float: left;">
				                                    <div class="s_l_pic">
				                                        <a href="product.php?goodsid='.$goods['id'].'" target="_blank">
				                                            <img alt="" width="255" height="255" src="'.$goods['describe_pic'].'" style="display: inline;">
				                                        </a>
				                                    </div>
				
				                                    <div class="s_l_name">
				                                        <a href="product.php?goodsid='.$goods['id'].'" target="_blank">
				                                            <em class="black">'.$goods['name'].'</em>
				                                        </a>
				                                    </div>
				                                    <div class="s_l_view_bg">
				                                        <div class="icon_wrap_bot clearfix">
				                                        </div>
				                                        <div class="search_list_price">
				                                            <label>¥</label>
				                                            <span>'.$goods['price'].'</span>
				                                        </div>
				                                    </div>
				                                    <div class="search_deal_buttom_bg clearfix">
				                                        <div class="rating">
				                                            <div style="width: 88%" class="value"></div>
				                                        </div>
				                                    </div>
				                                </div>
				                            </div>
				                        </li>';
                        		}
                        	}
                        ?>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div style="display: none;">
                    <i id="brand_id">837</i>
                    <i id="search_keywords">悦诗风吟</i>
                </div>

                <div class="page-nav-wrapper">
                    <ul class="page-nav">
                        <li class="current"><span>1</span></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li class="last"><a class="next" href="#">下一页</a></li>
                    </ul>
                </div>
            </div>
            <!--存在搜索结果显示的 页面内容 end-->

            <!--可能喜欢-->

            <!--最终购买 异步ajax-->
            <div class="search_last_buy" search="悦诗风吟" style="display: none;"></div>
            <div class="search_footer ">
                <p class="sf_other">
                </p>
                <div class="search_foot_label">搜索全部</div>
                <div class="search_footer_wrap">
                    <form action="brandgoods.php" method="get" onsubmit="">
                        <input type="hidden" name="filter" value="0-11-1">
                        <input name="search" type="text" class="" value="悦诗风吟" id="search_footer_input" />
                        <input name="from" type="hidden" value="">
                        <input name="cat" type="hidden" value="">
                        <button type="submit">搜索</button>

                    </form>
                    <!--搜索结果容器-->
                    <div class="search_result_pop_a" id="foot_search_pop_div">
                    </div>
                </div>
            </div>
            <?php
				require 'footer.php';
			?>
        </div>
    </div>
</body>
</html>
