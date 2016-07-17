<?php
	require './inc/config.php';
	require './inc/loading.php';
	
	if (empty($_COOKIE['mobile'])){
		alertAndLoading("请先登录", "login.php");
	}
	
	$mobile = base64_decode(base64_decode($_COOKIE['mobile']));
	$usertable = $database -> select("user", "*",[
			"mobile" => $mobile
	]);
	foreach ($usertable as $user){
		$userid = $user['id'];
		$urealname = $user['realname'];
		$uqq = $user['qq'];
		$uemail = $user['email'];
	}
	
	$alladdress = $database -> select("address", "*",[
			"flag" => $userid
	]);
	
	if (!empty($_GET['addressid'])){
		if (!empty($_REQUEST['act'])){
			$act = $_REQUEST['act'];
			if ($act == "deleteaddress"){
				$database -> delete("address", [
						"id" => $_GET['addressid']
				]);
				alertAndLoading("地址删除成功", "userinfo.php");
			}
		}
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (!empty($_REQUEST['act'])){
			$act = $_REQUEST['act'];
			if ($act == "improveUserinfo"){
				$database -> update("user", [
						"realname" => $_POST['realname'],
						"email" => $_POST['useremail'],
						"qq" => $_POST['userqq']
				],[
						"mobile" => $mobile
				]);
				alertAndLoading("修改成功", "userinfo.php");
			}elseif ($act == "addaddress"){
				$database -> insert("address", [
						"recivename" => $_POST['cnee'],
						"mobile" => $_POST['mobile'],
						"postal" => $_POST['postal'],
						"identity" => $_POST['identity'],
						"address" => $_POST['address'],
						"flag" => $userid
				]);
				alertAndLoading("添加成功", "userinfo.php");
			}
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Rainbow - 【用户信息】</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/userinfo.css">
    <link rel="stylesheet" type="text/css" href="css/css.css">
    <link rel="stylesheet" type="text/css" href="css/register.css">
</head>

<body>
    <!--header-->
    <div id="header_container">
        <div id="logo">
            <a href="index.php" id="home" title="RAINBOW" style="float: left; height: 20px; margin-top: 1%;">
                <img src="images/rainbow.png" alt=""></a>
            <div class="cn_renewal cn_main">
                <div class="new_header_ab">
                    <div class="header header_wide_lv1 w960">
                        <div class="header_top">
                            <div class="cn_top_menu">
                                <ul class="cn_top_global">
                                    <div style="float: left; font-size: 13px; color: #666">欢迎您，<a href="userinfo.php" style=" text-decoration: none;"><?php echo $mobile;?></a>&nbsp;[<a href="index.php?act=deletecookie" style="text-decoration: none; color: #ed155b">退出</a>]</div>
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

    <!--content-->
<?php 
	if ($uqq==null&&$uemail==null&&$urealname==null){
		echo ' <div class="mainbody">
        <h1>完善用户信息</h1>
        <hr />
        <div class="reg-wrapper2">
            <form id="regform" class="form-horizontal" action="userinfo.php?act=improveUserinfo" method="post">
                <div class="control-group">
                    <label class="control-label" for="phone">真实姓名</label>
                    <div class="controls">
                        <input required="required" value="" name="realname" id="userlxr" type="text">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="email">Email</label>
                    <div class="controls">
                        <input value="" name="useremail" id="email" type="text">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="qq">QQ</label>
                    <div class="controls">
                        <input value="" name="userqq" id="userqq" type="text">
                    </div>
                </div>
                <div class="act">
                    <input class="loginbtn submit_btn" type="submit" value="提  交" style="display: block; width: 300px; margin-left: 15%; margin-top: 20px;">
                </div>
            </form>
        </div>
    </div>';
	}
?>

    <!--修改密码-->

    <!--管理收货地址-->
    <div class="mainbody">
        <h1>管理收货地址</h1>
        <hr />
        <h2><span class="addAddress">新增</span><span class="modifyAddress" style="display: none;">修改</span>收货地址</h2>
        <div class="reg-wrapper2">
            <form id="Form1" class="form-horizontal" action="userinfo.php?act=addaddress" method="post">
                <div class="control-group">
                    <label class="control-label" for="username">收货人</label>
                    <div class="controls">
                        <input required="required" yyucval="YYUCUNIQUE@user@un@REG@MSG该帐号已经被注册！ONE@ANOTHER/^.{0,30}$/REG@MSG帐号长度不能大于于30个字符！ONE@ANOTHER/^.{2,}$/REG@MSG帐号长度不能小于2个字符！ONE@ANOTHER" value="" name="cnee" id="Text1" type="text">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="phone">手机号</label>
                    <div class="controls">
                        <input required="required" value="" name="mobile" id="Text2" type="text">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="phone">邮政编码</label>
                    <div class="controls">
                        <input required="required" value="" name="postal" id="Text4" type="text">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="phone">身份证号</label>
                    <div class="controls">
                        <input required="required" value="" name="identity" id="Text3" type="text">
                    </div>
                </div>
                <div class="control-group" style="margin-top: 5px;">
                    <label class="control-label" for="">收货地址</label>
                    <div class="controls">
                        <input value="" name="address" id="Text5" type="text" style="width: 560px">
                    </div>
                </div>

                <div class="act">
                    <input class="loginbtn submit_btn" type="submit" value="提  交" style="display: block; width: 300px; margin-left: 15%; margin-top: 20px;">
                </div>
            </form>
        </div>
    </div>
    <div class="mainbody">
        <h1>已保存的地址</h1>
        <hr />
        <table border="1" style="width: 100%;">
            <tr class="addresstr" style="background-color: #ccc;">
                <th>收货人</th>
                <th>收货地址</th>
                <th>手机</th>
                <th width="105px">身份证号码</th>
                <th width="80">操作</th>
            </tr>
            <?php 
            	if (!empty($alladdress)){
            		foreach ($alladdress as $address){
            			echo ' <tr class="addresstr">
				                <td class="real_name_td">'.$address['recivename'].'&nbsp;</td>
				                <td class="order_info_td">'.$address['address'].'</td>
				                <td class="real_name_td">'.$address['mobile'].'&nbsp;</td>
				                <td>'.$address['identity'].'</td>
				                <td class="real_name_td"><a address_id="97971179" class="sp_address_edit" style="display: inline-block;" href="javascript:void(0)">修改</a> &nbsp; <a address_id="97971179" class="sp_address_delete" style="display: inline-block;" href="userinfo.php?act=deleteaddress&addressid='.$address['id'].'">删除</a></td>
				            </tr>';
            		}
            	}
            ?>
        </table>
    </div>
    </div>

   

    <!--footer-->
    <div id="footer_container">
        <div id="footer_textarea">
            <div class="footer_con" id="footer_copyright">
                <p class="footer_copy_con">
                    Copyright © 2016 Rainbow.com 保留一切权利。客服热线：123-456-7890
                    <br>
                    京公网安备 11010102001226 | <a href="http://www.miibeian.gov.cn" target="_blank" rel="nofollow">京ICP证111033号</a> | 流通许可证 SP1101051111111111（1-1）
                | <a href="#" target="_blank">营业执照</a>
                </p>
                <p>
                    <a href="javascript:void(0)" class="footer_copy_logo logo01"></a>
                    <a href="#" target="_blank" class="footer_copy_logo logo02"></a>
                    <a href="javascript:void(0)" class="footer_copy_logo logo03"></a>
                    <a href="javascript:void(0)" class="footer_copy_logo logo04"></a>
                    <a href="#" target="_blank" class="footer_copy_logo logo05"></a>
                </p>
            </div>
        </div>
    </div>
    </div>
</body>
</html>
