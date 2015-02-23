﻿<!DOCTYPE html>
<html lang="en">
<head>
<?php
$ci = get_instance(); // CI_Loader instance
$ci->load->config('oauth',TRUE);
$x=$ci->config->item('oauth');
?>
    <meta charset="utf-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>froosh（フルーシュ）を飲んで北欧に行こうキャンペーン - 新規アカウント登録</title>  


	<link rel="stylesheet" href="<?php echo $this->config->item('base_url'); ?>assets/css/validationEngine.jquery.css" type="text/css"/>
        
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/mobile/css/default.css" media="screen,print">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/mobile/css/common.css" media="screen,print">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/mobile/css/webfont.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/mobile/css/form.css">
        
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery-1.8.2.min.js" type="text/javascript">
	</script>  
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/languages/jquery.validationEngine-ja.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>

 
 <script src="<?php echo $this->config->item('base_url'); ?>assets/mobile/js/common.js"></script>
<!-- jQuery jQuery customSelect (select box styling plugin) -->
<script src="<?php echo $this->config->item('base_url'); ?>assets/mobile/js/jquery.customSelect.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.birthSelect').customSelect({customClass:'birthSelectCustom'});
	$('.addrSelect').customSelect({customClass:'addrSelectCustom'});
});
</script>
	<script type="text/javascript">
		jQuery(document).ready(function(){
		/*$('#datetimepicker5').datepicker({
					format: 'yyyy-mm-dd',
    autoclose: true,
    keyboardNavigation : true 
				});
var myDate = new Date();
var prettyDate =(myDate.getFullYear()-18) + '-' + myDate.getMonth() + '-' +
        myDate.getDate();
var prettyDate2=(myDate.getFullYear()-18) + '-' +'12-31';
$("#datetimepicker5").datepicker('setDate', prettyDate);
$("#datetimepicker5").datepicker('maxDate', prettyDate2);*/

  $('#uname').blur(function(){
    var a = $("#uname").val();
	
    
    if (a !=="") 
   	{
               
		$url="/home/check_username";
        $.post($url, {
            uname: $('#uname').val()
        }, function(response){
                
			if(response=="use")
		{
		$('#text2').html('<span style="color:#f00;float:left" >Username already in use. </span>');
		$('input[type="submit"]').attr('disabled','disabled');
		}
		else
		{
		$('#text2').html('<span style="color:#0c0;float:left">Username Available</span>');
		
			 $('input[type="submit"]').removeAttr('disabled');
		}
        });
	}
        return false;
   
	
	});


$('#subutton').click(function(){
    var a = $("#recaptcha_response_field").val();
	 if (a ==""){ 
	$(".loginerror").html('<p style="color:#f00;">Captcha is Required</p>');
        $("#recaptcha_reload").click(); 
	 return false;
	}
	// else
	//$(".loginerror").html("");
	// $("#error2").html("");
 });

		
	  $('#uemail').blur(function(){
    var a = $("#uemail").val();
	
    
    var filter =/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
       // check if email is valid
    if(filter.test(a)){
               
		$url="/home/check_usermail";
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
						path: 'http://test.froosh-cp.jp/index.php/auth/session/twitter/',
						callback: function(){
						//window.location = '';
				}
				});
		}

		function connect_fb()
		{
				$.oauthpopup({
						path: 'http://test.froosh-cp.jp/index.php/auth/session/facebook',
						callback: function(){
						//window.location = '';
				}
				});
		}
		function connect_ig()
		{
				$.oauthpopup({
						path: 'http://test.froosh-cp.jp/index.php/auth/session/instagram',
						callback: function(){
						//window.location = '';
				}
				});
		}
	function updateValue(id, value) 
	{ 
	    // this gets called from the popup window and updates the field with a new value 
		if(id=="ugender" && value=="male")
		{
		$('input[name=ugender][value=1]').prop("checked",true);

		}
		if(id=="ugender" && value=="female")
		{
		$('input[name=ugender][value=2]').prop("checked",true);

		}
	    document.getElementById(id).value = value; 
		x="#"+id;
		if(id=="uname")
		$(x).attr('readonly', true);
		
	} 
	function updateview() 
	{ 
	    // this gets called from the popup window and updates the field with a new value 
	    window.location.href = "<?php echo $this->config->item('base_url'); ?>home/mview";
	} 
		
	</script>
</head>
<!--
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

     Header 
    <header id="top" class="header">
        <div class="text-vertical-center">
            <h1>Welcome to Froosh</h1>
          
            <br>
            <div class="row">

            <a href="#about" class="btn btn-dark btn-lg">Find Out More</a>
            
            <div  style="min-height: 20px;padding: 19px;margin-bottom: 20px;background-color: #f5f5f5;border: 1px solid #e3e3e3;border-radius: 4px;" class="col-lg-10 col-lg-

offset-1 text-center">
            <div class="alert alert-info">
               Welcome to User Registration <?php if(isset($user['mode']) &&  strtolower($user['mode'])=="mobile")echo "(".$user['mode'].")";?>
            </div>
<div id="error2"></div> -->

<body id="top">

<div id="wrapper">
    <!-- start : header -->
    <div id="header">
        <div class="logo"><a href="http://www.froosh-cp.jp"><img src="<?php echo $this->config->item('base_url'); ?>assets/mobile/img/common/logo.png" alt="froosh"></a></div>
        <div class="accountArea">
            <!--<div class="account_btn blockLink"><a href="<?php echo $this->config->item('base_url'); ?>home/profile_edit"><span>アカウント</span><span class="icon-svg a_icon"></span></a></div>-->
        </div>
    </div>
    <!-- end : header -->
    
    <!-- start : main -->
    <div id="main">
    
        <!-- start : タイトル -->
        <div class="titleGroup">
            <h1 class="title_text bold">新規アカウント登録</h1>
        </div>
        <!-- end : タイトル -->
        
        <!-- start : アカウント編集フォーム -->

	<form accept-charset="utf-8" id="formID" method="post" action="<?php echo $this->config->item('base_url');?>home/register" name="formID" class="form-horizontal">
	<!--<fieldset>-->
<!--	<div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
	<input type=text name="uname" id="uname" class="validate[required,minSize[4],maxSize[50]] form-control" placeholder="??" value="<?php if(isset($user['username']))echo 

$user['username'];?>" <?php if(isset($user['rusername']) && $user['rusername']==1) echo "readonly";?>> </div>
                    <div class="clearfix"></div><div id="text2" style="padding-bottom: 5px;padding-top: 5px;"></div><br>
	 <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope red"></i></span>
	<input type=text name="uemail" id="uemail" class="validate[required,custom[email]] form-control" value="<?php if(isset($user['email']))echo $user['email'];?>"  

placeholder="???"></div>
	
                    <div class="clearfix"></div><div id="text" style="padding-bottom: 5px;padding-top: 5px;"></div><br>
					
					
	<div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
	<input type=password name="upassword" id="upassword" class="validate[required,minSize[6],maxSize[50]] text-input form-control" placeholder="?????" value=""><br></div>
                    <div class="clearfix"></div><br>
	<div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
	<input type=password name="ucpassword" id="ucpassword" class="validate[required,equals[upassword],minSize[6],maxSize[50]] text-input form-control" value="" 

placeholder="????????"></div>
 <div class="clearfix"></div><br>-->




     <!--  Start  -->
        
           <div class="box">
                <p class="bold">名前（ニックネーム）</p>		
                    <input type="text" name="uname" id="uname" class="validate[required,minSize[4],maxSize[50]] text-input form-control ipt_1" placeholder="名前" value="<?php if(isset($user['username']))echo $user['username'];?>" <?php if(isset($user['rusername']) && $user['rusername']==1) echo "readonly";?> style="color: #a7a7a7;">
                   
                <p class="bold">メールアドレス</p>
                   <input type="text" name="uemail" id="uemail" class="validate[required,custom[email]] text-input form-control ipt_l " value="<?php if(isset($user['email']))echo $user['email'];?>"  placeholder="メール" style="color: #a7a7a7;">
                    
                <p class="bold">パスワード</p>
                     <input type="password" name="upassword" id="upassword" class="validate[required,minSize[6],maxSize[50]] text-input form-control ipt_l " placeholder="パスワード" value="" style="color: #a7a7a7;">
                    
                <p class="bold">パスワード<span class="notice">（確認）</span></p>
                        <input type="password" name="ucpassword" id="ucpassword" class="validate[required,equals[upassword],minSize[6],maxSize[50]] text-input form-control ipt_l" value="" placeholder="パスワードを確認" style="color: #a7a7a7;">
                    
                
           </div>
        
    <!-- End  -->





<!--<div class="input-group input-group-lg"> 
                   
                   <span style="padding: 6px 12px;//font-size: 14px;font-weight: 400;line-height: 1;color: #555;text-align: center;background-color: none; 
border: 1px solid #ccc; border-radius: 4px;" class="input-group-addon"><i class="glyphicon">Gender</i></span>
				   <div style="height: 46px;padding: 10px 16px;font-size: 18px;line-height: 1.33;display:block;border-radius: 6px ;border-top-left-radius: 
0;border-bottom-left-radius: 0;border: 1px solid #f5f5f5; position:relative">
           <span style="float:left;"> <input type="radio" class="validate[required] radio" name="ugender" value="1" <?php if(isset($user['ugender']) && ($user
['ugender']=="Male" || $user['ugender']=="??"))echo "checked";?>></span><span style="float:left; margin-left:10px;"> ??</span>
         <span style="float:left; margin-left:10px;"> <input type="radio" class="validate[required] radio" name="ugender" value="2" <?php if(isset($user['ugender']) 
&& ($user['ugender']=="Female" || $user['ugender']=="??"))echo "checked";?>></span><span style="float:left; margin-left:10px;"> ??</span> 
		    </div>
                   </div>
 <div class="clearfix"></div><br>-->


<!-- Start Gender -->

         <hr>
            <div class="box">   
                
                <p class="bold">名前（本名）</p>
                <input type="text" class="ipt_l" name="ufullname" id="ufullname" placeholder="例）田中 太郎" value="<?php if(isset($user['ufullname']))echo $user['ufullname'];?>"     onFocus="HideFormGuide(this,'例）田中 太郎');"  style="color: #a7a7a7;">
                        
                
                <p class="bold">性別</p>
                    
                    <label for="man">
                    <input type="radio" class="validate[required] radio" name="ugender" value="1" <?php if(isset($user['ugender']) && ($user['ugender']=="Male" || $user['ugender'] =="男性" || $user['ugender']== 1 ))echo "checked";?>>&nbsp;男性 
                    </label>
                    <label for="woman">
                    <input type="radio" class="validate[required] radio" name="ugender" value="2" <?php if(isset($user['ugender']) && ($user['ugender']=="Female" || $user['ugender']=="女性" || $user['ugender']== 2 ))echo "checked";?>>&nbsp;女性 
                    </label>
<!-- end -->


<!--<div class="input-group input-group-lg date" id='datetimepicker5'>
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
	<input type=text name="ubdate" id="ubdate" class="validate[required,custom[date]] form-control" placeholder="????" value="<?php if(isset($user['ubdate']))echo 

$user['ubdate'];?>" data-date-format="YYYY/MM/DD"> <span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span></div>
                    <div class="clearfix"></div><div id="text4" style="padding-bottom: 5px;padding-top: 5px;"></div><br>-->

<!-- Start Datetime -->

                      <p class="bold mt10">生年月日</p>
		<div class="select_birth">
                            <select name="ubyear" id="birth_year" class="birthSelect">
                                <option value="">年</option>
                                <option value="1910">1910</option>
                                <option value="1911">1911</option>
                                <option value="1912">1912</option>
                                <option value="1913">1913</option>
                                <option value="1914">1914</option>
                                <option value="1915">1915</option>
                                <option value="1916">1916</option>
                                <option value="1917">1917</option>
                                <option value="1918">1918</option>
                                <option value="1919">1919</option>
                                <option value="1920">1920</option>
                                <option value="1921">1921</option>
                                <option value="1922">1922</option>
                                <option value="1923">1923</option>
                                <option value="1924">1924</option>
                                <option value="1925">1925</option>
                                <option value="1926">1926</option>
                                <option value="1927">1927</option>
                                <option value="1928">1928</option>
                                <option value="1929">1929</option>
                                <option value="1930">1930</option>
                                <option value="1931">1931</option>
                                <option value="1932">1932</option>
                                <option value="1933">1933</option>
                                <option value="1934">1934</option>
                                <option value="1935">1935</option>
                                <option value="1936">1936</option>
                                <option value="1937">1937</option>
                                <option value="1938">1938</option>
                                <option value="1939">1939</option>
                                <option value="1940">1940</option>
                                <option value="1941">1941</option>
                                <option value="1942">1942</option>
                                <option value="1943">1943</option>
                                <option value="1944">1944</option>
                                <option value="1945">1945</option>
                                <option value="1946">1946</option>
                                <option value="1947">1947</option>
                                <option value="1948">1948</option>
                                <option value="1949">1949</option>
                                <option value="1950">1950</option>
                                <option value="1951">1951</option>
                                <option value="1952">1952</option>
                                <option value="1953">1953</option>
                                <option value="1954">1954</option>
                                <option value="1955">1955</option>
                                <option value="1956">1956</option>
                                <option value="1957">1957</option>
                                <option value="1958">1958</option>
                                <option value="1959">1959</option>
                                <option value="1960">1960</option>
                                <option value="1961">1961</option>
                                <option value="1962">1962</option>
                                <option value="1963">1963</option>
                                <option value="1964">1964</option>
                                <option value="1965">1965</option>
                                <option value="1966">1966</option>
                                <option value="1967">1967</option>
                                <option value="1968">1968</option>
                                <option value="1969">1969</option>
                                <option value="1970">1970</option>
                                <option value="1971">1971</option>
                                <option value="1972">1972</option>
                                <option value="1973">1973</option>
                                <option value="1974">1974</option>
                                <option value="1975">1975</option>
                                <option value="1976">1976</option>
                                <option value="1977">1977</option>
                                <option value="1978">1978</option>
                                <option value="1979">1979</option>
                                <option value="1980">1980</option>
                                <option value="1981">1981</option>
                                <option value="1982">1982</option>
                                <option value="1983">1983</option>
                                <option value="1984">1984</option>
                                <option value="1985">1985</option>
                                <option value="1986">1986</option>
                                <option value="1987">1987</option>
                                <option value="1988">1988</option>
                                <option value="1989">1989</option>
                                <option value="1990">1990</option>
                                <option value="1991">1991</option>
                                <option value="1992">1992</option>
                                <option value="1993">1993</option>
                                <option value="1994">1994</option>
                                <option value="1995">1995</option>
                                <option value="1996">1996</option>
                                <option value="1997">1997</option>
                            </select>
                            <select name="ubmonth" id="birth_month" class="birthSelect">
                                <option value="">月</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                               <select name="ubday" id="birth_day" class="birthSelect">
                                <option value="">日</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                            </div>




<!-- End  -->
<!--<div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>

	</div>
                    <div class="clearfix"></div><div id="text5" style="padding-bottom: 5px;padding-top: 5px;"></div><br>
<div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
	<input type=text name="ucity" id="ucity" class="validate[required] form-control" placeholder="????" value="<?php if(isset($user['ucity']))echo $user['ucity'];?>"> 

</div>
                    <div class="clearfix"></div><div id="text6" style="padding-bottom: 5px;padding-top: 5px;"></div><br>-->


<!--Start Prefacture-->

        <p class="bold">住所</p>
                <div class="select_addr">
                    <?php 
                        $dd_list = array(  ""   => "都道府県",
                                                "北海道"=>"北海道",
                                                "青森県"=>"青森県",
                                                "宮城県"=>"宮城県",
                                                "秋田県"=>"秋田県",
                                                "山形県"=>"山形県",
                                                "福島県"=>"福島県",
                                                "茨城県"=>"茨城県",
                                                "栃木県"=>"栃木県",
                                                "群馬県"=>"群馬県",
                                                "埼玉県"=>"埼玉県",
                                                "千葉県"=>"千葉県",
                                                "東京都"=>"東京都",
                                                "神奈川県"=>"神奈川県",
                                                "新潟県"=>"新潟県",
                                                "富山県"=>"富山県",
                                                "石川県"=>"石川県",
                                                "福井県"=>"福井県",
                                                "山梨県"=>"山梨県",
                                                "長野県"=>"長野県",
                                                "岐阜県"=>"岐阜県",
                                                "静岡県"=>"静岡県",
                                                "愛知県"=>"愛知県",
                                                "三重県"=>"三重県",
                                                "滋賀県"=>"滋賀県",
                                                "京都府"=>"京都府",		 
                                                "大阪府"=>"大阪府",
                                                "兵庫県"=>"兵庫県",
                                                "奈良県"=>"奈良県",
                                                "和歌山県"=>"和歌山県",
                                                "鳥取県"=>"鳥取県",
                                                "島根県"=>"島根県",
                                                "岡山県"=>"岡山県",
                                                "広島県"=>"広島県",
                                                "山口県"=>"山口県",
                                                "徳島県"=>"徳島県",			  
                                                "香川県"=>"香川県",
                                                "愛媛県"=>"愛媛県",
                                                "高知県"=>"高知県",
                                                "福岡県"=>"福岡県",
                                                "佐賀県"=>"佐賀県",
                                                "長崎県"=>"長崎県",
                                                "熊本県"=>"熊本県",
                                                "大分県"=>"大分県",
                                                "宮崎県"=>"宮崎県",
                                                "鹿児島県"=>"鹿児島県",
                                                "沖縄県"=>"沖縄県");
                                            $dd_name = "uprefecture";
                                            echo form_dropdown($dd_name, $dd_list,  ( !empty($user['uprefecture'])  ? $user['uprefecture'] : "" ) ,' class="form-control addrSelect" id="uprefecture"');   ?> 
                </div>

                    <!--<p class="bold">市の名前</p>-->
                    <input type="text" name="ucity" id="ucity" class="validate[required] form-control ipt_l" placeholder="市の名前" value="<?php if(isset($user['ucity']))echo $user['ucity'];?>" style="color: #a7a7a7;" /> 
                    
                




<!--end-->


          
                    <p class="bold">入力欄に画像に表示されている文字を半角英数字で入力して下さい。</p><span class="loginerror"> <?php if ($this->session->flashdata('error') !== FALSE) { echo $this->session->flashdata('error'); } ?></span>
                <p id="capimage"><?php echo $recaptcha_html; ?></p>
           





<!--<div style="margin-left:10px"><label style="margin-left:10px">Captcha:</label>
 <span class="loginerror"> <?php if ($this->session->flashdata('error') !== FALSE) { echo $this->session->flashdata('error'); } ?></span>
<div id="capimage">
<?php 
//echo $image;?><?php// echo $recaptcha_html; ?></div></div>-->
  
<!--<div style="margin-top:10px" class="input-group input-group-lg">  
   <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
      <input  id="captcha" name="captcha" type="text" placeholder="CAPTCHA?????????" class="text-input form-control">
    
  </div>-->
            <div id="captchastatus" style="padding-bottom: 5px;padding-top: 5px;"></div>
            <div class="clearfix"></div>
				
				<input type="hidden" name="umode" id="umode" value="<?php if(isset($user['mode']))echo $user['mode']; else echo "mail"?>">
				<input type="hidden" name="umedia" id="umedia" value="<?php if(isset($umedia))echo $umedia; else echo "Mobile"?>">
         
			
			<div class="input_btn">
				<!--<input type="button" value="戻る" onclick="history.back()" class="btn_back">&nbsp;-->
                            <input type="submit" value="新規登録" id="subutton" class="btn_save" style="width: 285px;"> 
			</div>
            </div>
      	</form>  
        <hr class="light mb30">
        <div class="facebook"><a class="btn btn-block btn-social btn-facebook"  href="http://test.froosh-cp.jp/index.php/auth/session/facebook">
            <img src="<?php echo $this->config->item('base_url'); ?>assets/mobile/img/common/facebook.png" alt="Facebook経由でログイン"></a></div>
        <div class="twitter"><a class="btn btn-block btn-social btn-twitter"  href="http://test.froosh-cp.jp/index.php/auth/session/twitter/" >
           <img src="<?php echo $this->config->item('base_url'); ?>assets/mobile/img/common/twitter.png" alt="Twitter経由でログイン"></a></div>
        <div class="instagram"> <a class="btn btn-block btn-social btn-instagram" href="http://test.froosh-cp.jp/index.php/auth/session/instagram">
            <img src="<?php echo $this->config->item('base_url'); ?>assets/mobile/img/common/instagram.png" alt="instagram経由でログイン"></a></div>
<!--        <div class="input_btn">
            <a href="<?php echo site_url('home/login');?>" class="btn_back pie">経由でログイン</a> </div>-->

	<!-- end : アカウント編集フォーム -->

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


