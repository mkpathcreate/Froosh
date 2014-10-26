<!DOCTYPE html>
<html lang="en">
<head>

<?php
$ci = get_instance(); // CI_Loader instance
$ci->load->config('oauth',TRUE);
$x=$ci->config->item('oauth');

//echo $x['twitter']['redirect_uri'];
//echo $x['instagram']['redirect_uri'];
//echo $x['facebook']['redirect_uri'];

?>
	<meta charset="utf-8">
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Registration</title>
<link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/css/bootstrap-social.css" rel="stylesheet">
    

    <!-- Custom CSS -->
    <link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/css/stylish-portfolio.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	
	
	
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url'); ?>assets/css/validationEngine.jquery.css" type="text/css"/>
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url'); ?>assets/css/template.css" type="text/css"/>
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery-1.8.2.min.js" type="text/javascript">
	</script>  
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>
	 <!--<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery-1.11.0.js"></script> -->
 <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $this->config->item('base_url'); ?>assets/assets2/js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
		
		
	  $('#uemail').blur(function(){
    var a = $("#uemail").val();
	
    
    var filter =/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
       // check if email is valid
    if(filter.test(a)){
               
		$url="/froosh/index.php/home/check_usermail";
        $.post($url, {
            uemail: $('#uemail').val()
        }, function(response){
                
			if(response=="use")
		{
		$('#text').html('<span style="color:#f00;float:left" >Email already in use. </span>');
		$('input[type="submit"]').attr('disabled','disabled');
		}
		else
		{
		$('#text').html('<span style="color:#0c0;float:left">Email Available</span>');
		
			 $('input[type="submit"]').removeAttr('disabled');
		}
        });
        return false;
    }
	
	});
		
			jQuery("#formID").validationEngine();

			$("#formID").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) })
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



		});
		
		function finishAjax(id, response){
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
} 

	function connect_tw()
	{	
	     $.oauthpopup({
          path: 'http://rhytha.info/froosh/auth/session/twitter',
          callback: function(){
           //window.location = '';
		   }        
	    });
	}

	function connect_fb()
	{	
	     $.oauthpopup({
          path: 'http://rhytha.info/froosh/auth/session/facebook',
          callback: function(){
           //window.location = '';
		   }        
	    });
	}
	function connect_ig()
	{	
	     $.oauthpopup({
          path: 'http://rhytha.info/froosh/auth/session/instagram',
          callback: function(){
           //window.location = '';
		   }        
	    });
	}
	function updateValue(id, value) 
	{ 
	    // this gets called from the popup window and updates the field with a new value 
	    document.getElementById(id).value = value; 
	} 
		
	</script>
</head>
<body>

<a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="#top">Start Bootstrap</a>
            </li>
            <li>
                <a href="#top">Home</a>
            </li>
            <li>
                <a href="#about">About</a>
            </li>
            <li>
                <a href="#services">Services</a>
            </li>
            <li>
                <a href="#portfolio">Portfolio</a>
            </li>
            <li>
                <a href="#contact">Contact</a>
            </li>
        </ul>
    </nav>

    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
           <!-- <h1>Welcome to Froosh</h1>-->
          
            <br>
            <div class="row">
          <!--  <a href="#about" class="btn btn-dark btn-lg">Find Out More</a>-->
            
            <div  style="min-height: 20px;padding: 19px;margin-bottom: 20px;background-color: #f5f5f5;border: 1px solid #e3e3e3;border-radius: 4px;" class="col-lg-10 col-lg-offset-1 text-center">
            <div class="alert alert-info">
               Welcome to User Registration <?php if(isset($user['mode']) &&  strtolower($user['mode'])=="mobile")echo "(".$user['mode'].")";?>
            </div>
	<form accept-charset="utf-8" id="formID" method="post" action="<?php echo $this->config->item('base_url');?>home/register" name="formID" class="form-horizontal">
	<fieldset>
	<div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
	<input type=text name="uname" id="uname" class="validate[required,custom[onlyLetterNumber],minSize[6],maxSize[50]] form-control" placeholder="Username" value="<?php if(isset($user['username']))echo $user['username'];?>"> </div>
                    <div class="clearfix"></div><br>
	 <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope red"></i></span>
	<input type=text name="uemail" id="uemail" class="validate[required,custom[email]] form-control" value="<?php if(isset($user['email']))echo $user['email'];?>"  placeholder="Email"></div>
	
                    <div class="clearfix"></div><div id="text" style="padding-bottom: 5px;padding-top: 5px;"></div><br>
					
					
	<div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
	<input type=password name="upassword" id="upassword" class="validate[required,minSize[6],maxSize[50]] text-input form-control" placeholder="Password" value=""><br></div>
                    <div class="clearfix"></div><br>
	<div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
	<input type=password name="ucpassword" id="ucpassword" class="validate[required,equals[upassword],minSize[6],maxSize[50]] text-input form-control" value="" placeholder="Conform Password"></div>
 <div class="clearfix"></div><br>
<div style="margin-left:10px"><label style="margin-left:10px">Captcha:</label>
<?php 
echo $image;?></div>
  
<div style="margin-top:10px" class="input-group input-group-lg">  
   <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
      <input  id="captcha" name="captcha" type="text" placeholder="Enter Captcha" class="text-input form-control">
    
  </div>


                    <div class="clearfix"></div><br>
					 <p class="center col-md-15">
<input type=hidden name="umode" id="umode" value="<?php if(isset($user['mode']))echo $user['mode']; else echo "mail"?>"><br>
	<input type=hidden name="umedia" id="umedia" value="<?php if(isset($umedia))echo $umedia; else echo "PC"?>"><br>
	<input type=submit value="Register" id="subutton" class="btn btn-primary">
<a class="btn btn-block btn-social btn-facebook"  onClick="connect_fb()">
            <i class="fa fa-facebook"></i>Sign in with Facebook</a>

<a class="btn btn-block btn-social btn-twitter" onClick="connect_tw()" >
            <i class="fa fa-twitter"></i> Sign in with Twitter</a>

<a class="btn btn-block btn-social btn-instagram" onClick="connect_ig()">
            <i class="fa fa-instagram"></i> Sign in with Instagram</a> 	
	</form>
 

	</div>

	
</div>

</body>
</html>


