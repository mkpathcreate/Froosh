<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
<title>froosh（フルーシュ）を飲んで北欧に行こうキャンペーン - ログイン</title>
<meta name="Description" content="">
<meta name="Keywords" content="">
<meta name="author" content="">
	
<?php
$ci = get_instance(); 
$ci->load->config('oauth',TRUE);
$x=$ci->config->item('oauth');

?>

	<link rel="stylesheet" href="<?php echo $this->config->item('base_url'); ?>assets/css/validationEngine.jquery.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/css/default.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/css/common.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/css/webfont.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/css/form.css" media="all">
	

	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery-1.8.2.min.js" type="text/javascript">
	</script>  
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/languages/jquery.validationEngine-ja.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>

<script src="<?php echo $this->config->item('base_url'); ?>assets/js/common.js"></script>
<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery.customSelect.js"></script>
	
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
            windowName: 'ConnectWithOAuth' 
          , windowOptions: 'location=0,status=0,width=1200,height=900'
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
           window.location = '<?php echo site_url('home/fupload'); ?>';
		   }        
	    });
	}
	function connect_ig()
	{	
	     $.oauthpopup({
          path: 'http://test.froosh-cp.jp/index.php/auth/session/instagram',
          callback: function(){
           window.location = '<?php echo site_url('home/fupload'); ?>';
		   }        
	    });
	}
	function updateValue(id, value) 
	{ 
	    document.getElementById(id).value = value; 
		x="#"+id;
	} 
	function updateview() 
	{ 
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
        <img src="<?php echo $this->config->item('base_url'); ?>assets/js/img/common/tag.png" alt="froosh">
    </div>
    <div id="header">
        <div class="logo"><a href="mypage.php"><img src="<?php echo $this->config->item('base_url'); ?>assets/js/img/common/logo.png" alt="froosh"></a>
		</div>
        <div class="accountArea">
        </div> 
    </div>

    <hr class="mt0">
    
    <div id="main">
        <form method="post" action="<?php echo $this->config->item('base_url'); ?>home/login_user" id="loginf" name="loginf">
        <div class="box">
			<div id="na"><?php if(isset($error)){ echo '<span style="color:#f00;">'.$error.'</span>';  $error="";} ?></div>
            <table class="login_table">
                    <tr>
                        <th><p class="bold">メールアドレス</p></th>
                        <td><input type=text name="uemail" id="uemail" value="" class="validate[required,minSize[4],custom[email]] ipt_l"  onFocus="HideFormGuide(this,'taro@froosh.com');"  placeholder="taro@froosh.com" onBlur="" style="color: #a7a7a7;"></td>
                    </tr>
                    <tr>
                        <th class="pb0"><p class="bold">パスワード</p></th>
                        <td class="pb0"><input type="password" name="upass" id="upass" value="" class="validate[required,minSize[6]] ipt_l pie"  onFocus="HideFormGuide(this,'*******');" placeholder="*******" onBlur="" style="color: #a7a7a7;"></td>
                    </tr>
            </table>
<!--
<label for="remember_me" class="remind_pass">

-->
            <div class="input_btn"><input type="submit" value="ログイン" class="btn_login pie"></div>
        </div>
        </form>
        <hr class="light mb30">
            <div class="facebook"><a class="btn btn-block btn-social btn-facebook"  onClick="connect_fb()">
            <img src="<?php echo $this->config->item('base_url'); ?>assets/js/img/common/facebook.png" alt="Facebook認証"></a></div>
            <div class="twitter"><a class="btn btn-block btn-social btn-twitter" onClick="connect_tw()" >
            <img src="<?php echo $this->config->item('base_url'); ?>assets/js/img/common/twitter.png" alt="Twitter認証"></a></div>
            <div class="instagram"><a class="btn btn-block btn-social btn-instagram" onClick="connect_ig()"> 
            <img src="<?php echo $this->config->item('base_url'); ?>assets/js/img/common/instagram.png" alt="instagram認証"></a></div>
	</div>
    
    <div id="footer">
        <address>XrossFace Holdings Co., LTD.</address>
    </div>
</div>
</body>
</html>