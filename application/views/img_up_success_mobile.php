<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
<title>froosh（フルーシュ）を飲んで北欧に行こうキャンペーン 応募完了</title>
<meta name="Description" content="">
<meta name="Keywords" content="">
<meta name="author" content="">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/mobile/css/default.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/mobile/css/common.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/mobile/css/webfont.css">


<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery-1.8.2.min.js"></script>
<script src="<?php echo $this->config->item('base_url'); ?>assets/js/common.js"></script>
</head>
<body id="top">


<div id="wrapper">


    <!-- start : header -->
    <div id="header">

        <div class="logo"><a href="http://www.froosh-cp.jp"><img src="<?php echo $this->config->item('base_url'); ?>assets/mobile/img/common/logo.png" alt="froosh"></a></div>

    </div>
    <!-- end : header -->


    <hr class="mt0">
    
    <!-- start : main -->
    <div id="main">
        

        <div class="box logout_page">



                 <div id="uploadpage">
                  
				<div class="upload_fin_massege">
					<p>キャンペーンへのご応募<br />誠にありがとうございます！</p>
					<p>ぜひ全種類のfrooshを体感して、<br />何度でもご応募ください！</p>
					<div class="center upload_fin_img"><img src="<?php echo base_url(); ?>assets/mobile/img/common/froosh.png" alt=""></div>
				</div>   

                     <input type="button" value="応募ページヘ戻る" id="subutton" class="btn_ok pie" onclick="goBack()">     
       			 </div>
        
		</div>
    
    
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


</html>
