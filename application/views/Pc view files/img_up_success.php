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

    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/css/default.css" media="all">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/css/webfont.css">

    <link href="<?php //echo $this->config->item('base_url'); ?>assets/assets2/css/stylish-portfolio.css" rel="stylesheet">

    <link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">


</head>

<body>

    <header id="top" class="header">
	  </header>
	<body id="top" class="window">
        <div class="text-vertical-center">
           <!-- <h1>Welcome to Froosh</h1>-->
          
            <br>
            <div class="row">

			<div id="uploadpage">
				<div class="upload_fin_massege">
					<p>キャンペーンのご参加ありがとうございます！<br>
					1枚目の写真投稿で、北欧グッズへの応募が完了しました。</p>
					<p>北欧旅行賞への応募には、frooshを<span class="notice">あと3種類</span>手に入れる必要があります。<br>
					ぜひ他の味も体感してください！</p>
					<div class="center upload_fin_img"><img src="<?php echo base_url(); ?>assets/img/common/froosh.png" alt=""></div>
				</div>                    
                   
                    
              <input type="button" value="OK" id="subutton" class="btn_ok pie" onclick="goBack()">     
                </div>
         
        </div>
	</body>

    
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script src="<?php echo $this->config->item('base_url'); ?>assets/js/boostrapv3/js/bootstrap.min.js"></script>


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
    });
function goBack() {
      window.location.href ="<?php echo $this->config->item('base_url'); ?>home/goback";
}
    </script>

</body>

</html>


