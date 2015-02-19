<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<title>froosh（フルーシュ）を飲んで北欧に行こうキャンペーン 写真アップロード</title>
	<meta name="Description" content="">
	<meta name="Keywords" content="">
	<meta name="author" content="">

    <!-- Bootstrap Core CSS 
    <link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/css/bootstrap-social.css" rel="stylesheet">-->
    
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/mobile/css/default.css" media="screen,print">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/mobile/css/common.css" media="screen,print">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/mobile/css/webfont.css">
    <!-- Custom CSS -->
    <link href="<?php //echo $this->config->item('base_url'); ?>assets/assets2/css/stylish-portfolio.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation 
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
    </nav>-->

    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
           <!-- <h1>Welcome to Froosh</h1>-->
          
            <br>
            <div class="row">
           <!-- <a href="#about" class="btn btn-dark btn-lg">Find Out More</a>
            
            <div  style="min-height: 20px;padding: 19px;margin-bottom: 20px;background-color: #f5f5f5;border: 1px solid #e3e3e3;border-radius: 4px;" class="col-lg-10 col-lg-offset-1 text-center">
           <div class="alert alert-info">
              <strong> Thank you for your participation in the campaign !</strong>
            </div>-->
                  <div id="uploadpage">
				<div class="upload_fin_massege">
					<p>キャンペーンのご参加ありがとうございます！<br>
					1枚目の写真投稿で、北欧グッズへの応募が完了しました。</p>
					<p>北欧旅行賞への応募には、frooshを<span class="notice">あと3種類</span>手に入れる必要があります。<br>
					ぜひ他の味も体感してください！</p>
					<div class="center upload_fin_img"><img src="<?php echo base_url(); ?>assets/mobile/img/common/froosh.png" alt=""></div>
				</div>   

                    <!--<p class="center col-md-15">
					<h4>Flavor Details!</h4>
                        
						<?php   if(isset($image)){ foreach($image as $key =>$value){ // echo $value['idate']."&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;". $value['fname']."<br>";
						} }?>
						
						
             
                    </p> -->
                    
                     <input type="button" value="OK" id="subutton" class="btn_ok pie" onclick="goBack()">     
                
         </div>
         
        </div>
	</body>
    
   

    <!-- Footer 
    <footer>
        <div class="container">
            <div class="row">
                <div  class="col-lg-10 col-lg-offset-1 text-center">
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
    </footer>-->

    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo $this->config->item('base_url'); ?>files/files/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $this->config->item('base_url'); ?>files/files/js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
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
    });
function goBack() {
      window.location.href ="<?php echo $this->config->item('base_url'); ?>home/goback";
}
    </script>

</body>

</html>


