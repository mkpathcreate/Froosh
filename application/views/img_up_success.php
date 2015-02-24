<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

<title>froosh（フルーシュ）を飲んで北欧に行こうキャンペーン - 応募完了</title>

<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/css/default.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/css/common.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/css/webfont.css">

<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery-1.8.2.min.js"></script>
<script src="<?php echo $this->config->item('base_url'); ?>assets/js/common.js"></script>

</head>
<body id="top">

<div id="wrapper">

  <div id="head_tag"><img src="<?php echo $this->config->item('base_url'); ?>assets/js/img/common/tag.png" alt="froosh"></div>
  
  
  <div id="header">
    <div class="logo"><img src="<?php echo $this->config->item('base_url'); ?>assets/js/img/common/logo.png" alt="froosh"></div>
    <div class="accountArea"> </div>
  </div>
  
  
  <hr class="mt0">
  
  
  <div id="main">
    <div class="box logout_page">
      <div id="uploadpage">
      
      
        <div class="upload_fin_massege">
          <p>キャンペーンへのご応募<br />
            誠にありがとうございます！</p>
          <p>ぜひ全種類のfrooshを体感して、<br />
            何度でもご応募ください！</p>
          <div class="center upload_fin_img"><img src="<?php echo base_url(); ?>assets/img/common/froosh.png" alt=""></div>
        </div>
        
        
        <input type="button" value="応募ページヘ戻る" id="subutton" class="btn_ok pie" onclick="goBack()">
      </div>
    </div>
  </div>
  
  
  
  <div id="footer">
    <address>
    XrossFace Holdings Co., LTD.
    </address>
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
</html>
