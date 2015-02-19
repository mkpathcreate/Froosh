<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8 without BOM">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <meta name="description" content="">
    <meta name="author" content="">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url');?>assets/css/default.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url');?>assets/css/common.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url');?>assets/css/webfont.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url');?>assets/css/form.css" media="all">
<link rel="stylesheet" href="<?php echo $this->config->item('base_url'); ?>assets/css/validationEngine.jquery.css" type="text/css"/>
<link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo $this->config->item('base_url'); ?>assets/css/validationEngine.jquery.css" type="text/css"/>
</head>
<body id="top">
<div id="wrapper">
    <div id="head_tag">
        <img src="<?php echo $this->config->item('base_url'); ?>assets/js/img/common/tag.png" alt="froosh">
    </div>
	    <!-- start : header -->
    <div id="header">
        <div class="logo"><a href="mypage.php"><img src="<?php echo $this->config->item('base_url'); ?>assets/js/img/common/logo.png" alt="froosh"></a></div>
        <div class="accountArea">
           <!-- <div class="account_btn blockLink pie"><a href="#"><span>アカウント</span><span class="icon-svg a_icon"></span></a></div>-->
        </div> 
    </div>
    <!-- end : header -->

    <hr class="mt0">
    
    <!-- start : main -->
    <div id="main">
		<form method="post" action="<?php echo $this->config->item('base_url'); ?>home/login_user" id="loginf" name="loginf">
		<div class="box">
			<div id="na"><?php if(isset($error)){ echo '<span style="color:#f00;">'.$error.'</span>';  $error="";} ?></div>
			<table class="login_table">
                <tr>
                        <th><p class="bold">メールアドレス</p></th>
						<td><input type=text name="uemail" id="uemail" value="" class="validate[required,minSize[4],custom[email]] ipt_l" 

onFocus="HideFormGuide(this,'taro@froosh.com');" onBlur="" style="color: #a7a7a7;"></td>
				</tr>
				<tr>
                        <th class="pb0"><p class="bold">パスワード</p></th>
						<td class="pb0"><input type=password name="upass" id="upass" value="" class="validate[required,minSize[6]] ipt_l pie" 

onFocus="HideFormGuide(this,'*******');" onBlur="" style="color: #a7a7a7;"></td>
				</tr>
				<tr>
                        <td class="pt0 pb0 fs16">&nbsp;</td>
                        <td class="pt0"><label for="remember_me" class="remind_pass">
							<input type=checkbox id="remember" name="remember"  class="ml5"><span class="remind_pass_text">&nbsp;パスワードを記憶する

</span></label>
						</td>
				</tr>
            </table>
			 <div class="input_btn">			
				<input type="submit" value="ログイン" class="btn_login pie"><br>
			<!--<input type="button" value="Forgot your password?" onClick="forgot()"><br>-->
			 </div>
		</div>
		</form>
		<!-- end : ログインフォーム -->
        <hr class="light mb30">
		<div class="facebook pie"><a class="btn btn-block btn-social btn-facebook"  onClick="connect_fb()">
           <img src="<?php echo $this->config->item('base_url'); ?>assets/js/img/common/facebook.png" alt="Facebook経由でログイン"></a></div>
		<div class="twitter pie"><a class="btn btn-block btn-social btn-twitter" onClick="connect_tw()" >
            <img src="<?php echo $this->config->item('base_url'); ?>assets/js/img/common/twitter.png" alt="Twitter経由でログイン"></a></div>
		<div class="instagram pie"><a class="btn btn-block btn-social btn-instagram" onClick="connect_ig()"> 
           		<img src="<?php echo $this->config->item('base_url'); ?>assets/js/img/common/instagram.png" alt="instagram経由でログイン"></a></div>
	</div>
    <!-- end : main -->
    
    <!-- start : footer -->
    <div id="footer">
        <address>XrossFace Holdings Co., LTD.</address>
    </div>
    <!-- end : footer -->
</div>
<!-- / .wrapper -->
</body>
</html>