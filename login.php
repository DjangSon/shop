<?php
	require  './inc/config.php';	//加载数据库配置文件
	require_once './inc/loading.php';	//加载跳转页面函数
	$loginError = "";
	//判断用户是否提交数据
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//将POST里的用户与密码值赋予变量
		$mobile = $_POST['mobile'];		
		$password = $_POST['password'];
		//把提交的用户进行查库
		$datas = $database->select("user", "*",["mobile" => $mobile]);
		if (!empty($datas)){
			foreach($datas as $data)	//foreach是php自带的数组循环函数，详情：http://www.w3school.com.cn/php/php_looping_for.asp
			{
				$upassword = $data['password'];
				$flag = $data['flag'];
			}
			if ($flag == 1){
				alertAndLoading("您已被拉黑，请联系管理员", "login.php");
			}
			if ( $upassword == md5($password)){
				setcookie('mobile',base64_encode(base64_encode($mobile)),time()+3600,'/');
				loading('index.php');
			}else{
				$loginError = "密码错误，请重新输入。";
			}
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Rainbow网上免税店-登录</title>
	</head>
	<body>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/register.css">
    <link rel="stylesheet" type="text/css" href="css/cart.css">
    
    <style type="text/css">
	input {
  display: inline-block;
  width: 210px;
  margin-bottom: 9px;
  line-height: 18px;
  background-color: #ffffff;
  border: 1px solid #cccccc;
  border-radius: 3px;
  transition: border linear 0.2s, box-shadow linear 0.2s;
}
input:focus {
  border-color: rgba(82, 168, 236, 0.8);
  outline: thin dotted \9;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
}
	</style>
<!--header-->
<div id="header_container">
    <div id="logo">
        <a href="index.php" id="home" title="RAINBOW" style="float:left;height:20px;"><img src="images/rainbow.png"></a>
        <div class="header_logo_box">
            <a href="" rel="nofollow" class="top_link lightning" target="_blank"></a>
            <a href="" rel="nofollow" class="top_link gild" target="_blank"></a>
            <a href="" class="top_link credit" target="_blank"></a>
        </div>
    </div>
</div>

<!--content-->
<div class="sign">
    <div class="loginWrap">
        <div class="loginImage ">
  			<a href="" target="_blank" class="signup_link"></a>
            <div class="loginBord">
                <div class="loginTit">
                    <div class="tosignup">还没有账号？<a href="register.php">30秒注册</a></div>
                    <h1><strong>登录Rainbow</strong></h1>
                </div>
                <form id="login-user-form" method="post" action="" style="display: block;">
                    <input style="display:none" type="text" name="">
                    <input style="display:none" type="password" name="">
                    <div class="textbox_ui user">
                        <input type="text" placeholder="已验证手机/邮箱/用户名" name="mobile" id="mobile" autofocus="" autocomplete="off" value="">
                        <div class="focus_text">请输入登录名，登录名可能是您的手机号、邮箱或用户名</div>
                        <div class="invalid" style="display: none;">
                            <div class="msg"></div>
                            </div>
                        </div>
                        <div class="textbox_ui pass">
                            <input type="password" placeholder="密码" name="password" id="login_password" autocomplete="off">
                            <div class="focus_text">请输入您的密码，您的密码可能为字母、数字或符号的组合</div>
                        </div>
                        <p>
                            <a href="" class="fr">忘记密码?</a>
                        </p>
                        <input class="loginbtn submit_btn" type="submit" value="登 录" style=" display: block;width: 100%;">
                        <div id="errorMsg"></div>
                    </form>
                <div class="shadow_l"></div>
                <div class="shadow_r"></div>
            </div>
        </div>
    </div>
</div>
<!--footer-->
<div id="footer_container">
    <div id="footer_textarea">
        <div class="footer_con" id="footer_copyright">
            <p class="footer_copy_con">
                Copyright © 2016 Rainbow.com 保留一切权利。客服热线：123-456-7890 <br>
                京公网安备 11010102001226 | <a href="" target="_blank" rel="nofollow">京ICP证111033号</a> | 流通许可证 SP1101051111111111（1-1）
                | <a href="" target="_blank">营业执照</a>
            </p>
            <p>
                <a href="javascript:void(0)" class="footer_copy_logo logo01"></a>
                <a href="" target="_blank" class="footer_copy_logo logo02"></a>
                <a href="javascript:void(0)" class="footer_copy_logo logo03"></a>
                <a href="javascript:void(0)" class="footer_copy_logo logo04"></a>
                <a href="" target="_blank" class="footer_copy_logo logo05"></a>
            </p>
        </div>
    </div>
</div>
	</body>
</html>