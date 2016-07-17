<?php
	require  './inc/config.php';	//加载数据库配置文件
	require './inc/loading.php'; //加载跳转页面函数
	//判断用户是否提交数据
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(preg_match("/^1[34578]\d{9}$/",$_POST['mobile'])){
			//用$username放到数据库(shop.user)中进行查询，将查询结果放入$data。
			$data = $database->select("user", "*",["mobile"=>$_POST["mobile"]]);
			//若$data为空，则用户名可用
			if(empty($data)){
				if ($_POST['password1'] == $_POST['password2']){
					//将用户信息(username,password,email,phone,address)写入数据库(shop.username)
					$database->insert("user", [
							"mobile" => $_POST["mobile"],
							"password" => md5($_POST["password1"]),
							"regtime" => date("Y/m/d H:i:s")
					]);
					//弹窗提示注册成功，并跳转到登录页面
					alertAndLoading('注册成功', 'login.php');
				}else {
					alertAndLoading("两次输入的密码不同", "register.php");
				}
			}
			//若$data不为空，用户名已被注册，提示并返回注册页面
			else{
				alertAndLoading('该用户名已被注册', 'register.php');
			}
		}else {
			alertAndLoading("请输入正确的手机号格式", "register.php");
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Rainbow - 【注册】</title>
	</head>
	<body>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/register.css">
    <style>
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
        <div class="loginPic ">
                        <a href="" target="_blank" class="signup_link"></a>
            <div class="loginBord">
                <div class="loginTit">
                    <div class="tosignup">已有账号<a href="login.php">在此登录</a></div>
                    <h1><strong>用户注册</strong></h1>
                </div>
                <form id="phone" method="post">
                    <div class="line">
                        <div class="textbox_ui">
                        <input type="text" id="mobile" placeholder="手机号" name="mobile" autofocus="" autocomplete="off" value="">
                            <div class="focus_text">请输入11位手机号码</div>
                            <div class="invalid" style="display: none;">
                                <i></i>
                                <div class="msg"></div>
                            </div>
                            <i class="valid"></i>
                            <i class="loading"></i>
                        </div>
                    </div>
                    <div class="line">
                        <div class="textbox_ui">
                            <input type="password" placeholder="密码" name="password1" id="password" autocomplete="off">
                            <div class="focus_text">
                                <p class="default">6-16个字符，建议使用字母加数字或符号组合</p>
                                <div class="safe">
                                    <div class="pw_isstrong clearfix">
                                        <div class="pw_level pw_success" data-class="pw_weak" data-strength="weak">弱</div>
                                        <div class="pw_level pw_success" data-class="pw_normal" data-strength="normal">中</div>
                                        <div class="pw_level pw_success" data-class="pw_strong" data-strength="strong" style="border-right:0">强</div>
                                    </div>
                                </div>
                            </div>
                            <i class="valid"></i>
                            <div class="invalid">
                                <div class="msg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="line">
                        <div class="textbox_ui">
                            <input type="password" id="password2" name="password2" placeholder="重复密码" autocomplete="off">
                            <div class="focus_text">请再次输入密码</div>
                            <i class="valid"></i>
                            <div class="invalid">
                                <div class="msg"></div>
                            </div>
                        </div>
                    </div>
                                        <div class="act" style="margin-left: 0px;">
                        <p>
                            <input type="submit" class="submit_btn" value="同意协议并注册" name="mobileCommit" style="width: 100%;">
                        </p>
                        <p>
                            <a href="" rel="nofollow" target="_blank" style="color:#ed145b;">《RAINBOW用户协议》</a>
                        </p>
                    </div>
                    <br>
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
                京公网安备 11010102001226 | <a href="http://www.miibeian.gov.cn" target="_blank" rel="nofollow">京ICP证111033号</a> | 流通许可证 SP1101051111111111（1-1）
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