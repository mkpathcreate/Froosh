<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
<title>froosh（フルーシュ）を飲んで北欧に行こうキャンペーン - ログイン</title>
<meta name="Description" content="">
<meta name="Keywords" content="">
<meta name="author" content="">
<!--<link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/css/bootstrap-social.css" rel="stylesheet">-->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/mobile/css/default.css" media="screen,print">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/mobile/css/common.css" media="screen,print">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/mobile/css/webfont.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/mobile/css/form.css">
<!-- ADDITIONAL  -->
<link rel="stylesheet" href="<?php echo $this->config->item('base_url'); ?>assets/css/validationEngine.jquery.css" type="text/css"/>
<!--<link rel="stylesheet" href="<?php echo $this->config->item('base_url'); ?>assets/css/template.css" type="text/css"/>-->

    <!-- Custom CSS
    <link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/css/stylish-portfolio.css" rel="stylesheet"> -->

    <!-- Custom Fonts 
    <link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	
	
	
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url'); ?>assets/css/validationEngine.jquery.css" type="text/css"/>
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url'); ?>assets/css/template.css" type="text/css"/>
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery-1.8.2.min.js" type="text/javascript">
	</script>  
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/languages/jquery.validationEngine-ja.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>-->
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery-1.8.2.min.js" type="text/javascript">
	</script>  
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/languages/jquery.validationEngine-ja.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>	
	
	<script src="<?php echo $this->config->item('base_url'); ?>assets/mobile/js/common.js"></script>
	
<script type="text/javascript">
		jQuery(document).ready(function(){
		
			jQuery("#loginf").validationEngine();
			});


$("#loginf").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) })
	 $.oauthpopup = function(options)
	    {
        if (!options || !options.path) {
            throw new Error("options.path must not be empty");
        }
        options = $.extend({
            windowName: 'ConnectWithOAuth' // should not include space for IE
          , windowOptions: 'location=0,status=0,width=800,height=400'
          , callback: function(){ window.location.reload(); }
        }, options);
 
        var oauthWindow   = window.open(options.path, options.windowName, options.windowOptions);
        var oauthInterval = window.setInterval(function(){
            if (oauthWindow.closed) {
                window.clearInterval(oauthInterval);
                options.callback();
            }
        }, 1000);
 	   };
 
 	   //bind to element and pop oauth when clicked
	    $.fn.oauthpopup = function(options) {
	        $this = $(this);
        	$this.click($.oauthpopup.bind(this, options));
	    };



		

		
		
		function finishAjax(id, response){
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
} 


function connect_tw()
		{
				$.oauthpopup({
						path: 'http://test.froosh-cp.jp/index.php/auth/session/twitter/',
						callback: function(){
						  window.location = "<?php echo site_url('home/fupload'); ?>";
				}
				});
		}

		function connect_fb()
		{
				$.oauthpopup({
						path: 'http://test.froosh-cp.jp/index.php/auth/session/facebook',
						callback: function(){
						  window.location = "<?php echo site_url('home/fupload'); ?>";
				}
				});
		}
		function connect_ig()
		{
				$.oauthpopup({
						path: 'http://test.froosh-cp.jp/index.php/auth/session/instagram',
						callback: function(){
						  window.location = "<?php echo site_url('home/fupload'); ?>";
				}
				});
		}
	function updateValue(id, value) 
	{ 
	    // this gets called from the popup window and updates the field with a new value 
	    document.getElementById(id).value = value; 
		x="#"+id;
		//if(id=="uname")
		//$(x).attr('readonly', true);
		
	} 
	function updateview() 
	{ 
	    // this gets called from the popup window and updates the field with a new value 
	    window.location.href = "<?php echo $this->config->item('base_url'); ?>home/mview";
	} 
	function forgot()
	{
	uname=$("#uemail").val();
	if(uname!='')
	{
	$("#upass").removeClass("validate[required,minSize[6]]");

	$url="/home/forgot";
        $.post($url, {
            uemail: $('#uemail').val()
        }, function(response){
                
			if(response=="success")
			//if(response>1)
		{
			alert("Password sent to your Email ID");
		}
		if(response=="mail")
			{
			alert("Password will be send to your Email ID");

			}
		if(response=="not")
		{
		alert("Not a Registered User");
		}
        });
	

	$("#upass").addClass("validate[required,minSize[6]]");
	$("#na").html('');
	}
	else
	{
	$("#upass").addClass("validate[required,minSize[6]]");
	alert("Fill Your Email ID");
	$("#na").html('');
	}

	}
			</script>
</head>
<body id="top">
<div id="wrapper">
    <div id="head_tag">
        <!--<img src="<?php echo $this->config->item('base_url'); ?>assets/js/img/common/tag.png" alt="froosh">-->
    </div>
	    <!-- start : header -->
    <div id="header">
        <div class="logo"><a href="http://www.froosh-cp.jp"><img src="<?php echo $this->config->item('base_url'); ?>assets/mobile/img/common/logo.png" alt="froosh"></a></div>
        <div class="accountArea">
            <!--<div class="account_btn blockLink pie"><a href="#"><span>アカウント</span><span class="icon-svg a_icon"></span></a></div>-->
        </div>
    </div>
    <!-- end : header -->

    <hr class="mt0">
    
    <!-- start : main -->
    <div id="main">
		<form method="post" action="<?php echo $this->config->item('base_url'); ?>home/login_user" id="loginf" name="loginf">
			<div class="box">
			<div id="na"><?php if(isset($error)){ echo '<span style="color:#f00;">'.$error.'</span>';  $error="";} ?></div>
                        <p class="bold">メールアドレス</p>
                        <input type="text" name="uemail" id="uemail" value="" class="validate[required,minSize[4],custom[email]] ipt_l" onFocus="HideFormGuide(this,'taro@froosh.com');"  placeholder="taro@froosh.com" style="color: #a7a7a7;">

                       <p class="bold">パスワード</p>
                       <input type="password" name="upass" id="upass" value="" class="validate[required,minSize[6]] ipt_l" onFocus="HideFormGuide(this,'*******');" placeholder="*****"  style="color: #a7a7a7;">

<!--                        <label for="remember_me">
                            <input type="checkbox" id="remember" name="remember"  class="ml5"><span class="remind_pass_text">&nbsp;パスワードを記憶する</span>
                	</label>			-->
	<div class="input_btn">
				<input type="submit" value="ログイン" class="btn_login pie"><br>
				<!--<input type="button" value="Forgot your password?" onClick="forgot()"><br>-->
			</div>
			</div>
		</form>
		 <hr class="light mb30">
		 <div class="facebook"><a href="http://test.froosh-cp.jp/index.php/auth/session/facebook">
            <img src="<?php echo $this->config->item('base_url'); ?>assets/mobile/img/common/facebook.png" alt="Facebook経由でログイン"></a></div>
<div class="twitter">
<a  href="http://test.froosh-cp.jp/index.php/auth/session/twitter/" >
            <img src="<?php echo $this->config->item('base_url'); ?>assets/mobile/img/common/twitter.png" alt="Twitter経由でログイン"></a></div>
<div class="instagram">
<a href="http://test.froosh-cp.jp/index.php/auth/session/instagram"><img src="<?php echo $this->config->item('base_url'); ?>assets/mobile/img/common/instagram.png" alt="instagram経由でログイン"></a></div>
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
