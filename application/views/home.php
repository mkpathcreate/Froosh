<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome to Froosh</title>

    <link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/css/bootstrap-social.css" rel="stylesheet">
    

    <link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/css/stylish-portfolio.css" rel="stylesheet">

    <link href="assets/assets2/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">


</head>

<body>

    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
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

    <header id="top" class="header">
        <div class="text-vertical-center">
            <h1>Welcome to Froosh</h1>

	<br>
            <div class="row">
			 <div  style="min-height: 20px;padding: 19px;margin-bottom: 20px;background-color: #f5f5f5;border: 1px solid #e3e3e3;border-radius: 4px;" class="col-lg-10 col-lg-offset-1 text-center">
            <div class="alert alert-info">
               Welcome to User Registration
            </div>
                    
					<p class="center col-md-15">
	<a style="color:white; text-decoration:none;" href="<?php echo $this->config->item('base_url'); ?>home/mail"><button class="btn btn-primary">Mail</button></a>
	 


<a class="btn btn-block btn-social btn-facebook" href="<?php echo $this->config->item('base_url'); ?>home/mail">
            <i class="fa fa-facebook"></i>Sign in with Facebook</a>

<a class="btn btn-block btn-social btn-twitter" href="<?php echo $this->config->item('base_url'); ?>home/mail">
            <i class="fa fa-twitter"></i> Sign in with Twitter</a>

<a class="btn btn-block btn-social btn-instagram" href="<?php echo $this->config->item('base_url'); ?>home/mail">
            <i class="fa fa-instagram"></i> Sign in with Instagram</a> 	

			</p>
    
                </fieldset>
            </form>
        </div>
            
        </div>
    </header>

    
   

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h4><strong>Froosh Free trip to Sweden</strong>
                    </h4>
                    <p>JESCO<br>Shinjuku, Tokyo 160022</p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-phone fa-fw"></i> (123) 456-7890</li>
                        <li><i class="fa fa-envelope-o fa-fw"></i>  <a href="mailto:name@example.com">name@example.com</a>
                        </li>
                    </ul>
                    <br>
                    <ul class="list-inline">
                        <li>
                            <a href="#"><i class="fa fa-facebook fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dribbble fa-fw fa-3x"></i></a>
                        </li>
                    </ul> 
		
			


                    <hr class="small">
                    <p class="text-muted">Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </div>
    </footer>

	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery-1.8.2.min.js" type="text/javascript">

    <!-- Bootstrap Core JavaScript 
    <script src="<?php //echo $this->config->item('base_url'); ?>/files/files/js/bootstrap.min.js"></script> -->
<script src="<?php echo $this->config->item('base_url'); ?>assets/assets2/js/bootstrap.min.js"></script>

    <script>
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });

	$("#formID").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) })
	 $.oauthpopup = function(options)
	    {
        if (!options || !options.path) {
            throw new Error("options.path must not be empty");
        }
        options = $.extend({
            windowName: 'ConnectWithOAuth' 
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
 
	    $.fn.oauthpopup = function(options) {
	        $this = $(this);
        	$this.click($.oauthpopup.bind(this, options));
	    };

    });
	function finishAjax(id, response){
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
} 

	/*function connect_tw()
	{	
	     $.oauthpopup({
          path: 'http://rhytha.info/froosh/auth/session/twitter',
          callback: function(){
		   }        
	    });
	}

	function connect_fb()
	{	
	     $.oauthpopup({
          path: 'http://rhytha.info/froosh/auth/session/facebook',
          callback: function(){
		   }        
	    });
	}
	function connect_ig()
	{	
	     $.oauthpopup({
          path: 'http://rhytha.info/froosh/auth/session/instagram',
          callback: function(){
        }        
	    });
	}*/
	function updateValue(id, value) 
	{ 
	    document.getElementById(id).value = value; 
	} 
    </script>

</body>

</html>