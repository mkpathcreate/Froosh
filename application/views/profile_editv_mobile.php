<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
        <title>froosh（フルーシュ）を飲んで北欧に行こうキャンペーン - アカウントの編集</title>
        <meta name="description" content="">
        <meta name="author" content="">
<!--
        <link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/css/bootstrap-social.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $this->config->item('base_url'); ?>assets/css/datepicker3.css">

         Custom CSS 
        <link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/css/stylish-portfolio.css" rel="stylesheet">
         Custom Fonts 
        <link href="<?php echo $this->config->item('base_url'); ?>assets/assets2/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	-->
	
	
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url'); ?>assets/css/validationEngine.jquery.css" type="text/css"/>
        
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/mobile/css/default.css" media="screen,print">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/mobile/css/common.css" media="screen,print">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/mobile/css/webfont.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/mobile/css/form.css">        
        
	<!--<link rel="stylesheet" href="<?php echo $this->config->item('base_url'); ?>assets/css/template.css" type="text/css"/>-->
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery-1.8.2.min.js" type="text/javascript">
	</script>  
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/languages/jquery.validationEngine-ja.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>
<!--<script src="<?php echo $this->config->item('base_url'); ?>assets/js/bootstrap-datepicker.js" type="text/javascript" charset="utf-8"></script>
	 <script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery-1.11.0.js"></script> 
  Bootstrap Core JavaScript 
    <script src="<?php echo $this->config->item('base_url'); ?>assets/assets2/js/bootstrap.min.js"></script>-->
        
        
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
		$("#upassword").focus(function() {
		  this.value = "";
		});
		/*$('#datetimepicker5').datepicker({
					format: 'yyyy-mm-dd',
    autoclose: true,
    keyboardNavigation : true 
				});*/
		$("#subutton").on("click",function(e){
		e.preventDefault();
		x=$('input[name="ugender"]:checked').val();
		if(x==1){
		//x="Male";
		x="男性";
		}
		if(x==2)
		{
		//x="Female";
		x="女性";
		}
		$url="<?php echo $this->config->item('base_url');?>home/profile_modify";
		 $.post($url, {
		upassword:$("#upassword").val(),
		ugender:x,
                ufullname:$("#ufullname").val(),
		ubyear:$("#ubyear").val(),
		ubmonth:$("#ubmonth").val(),
		ubday:$("#ubday").val(),
		uprefecture:$("#uprefecture").val(),
		uid:$("#uid").val(),
		ucity:$("#ucity").val()
			}, function(response){
				if(response=="success")
				alert("プロフィールを更新しました");
				});
				return false;
			
		});


  /*$('#uname').blur(function(){
    var a = $("#uname").val();
	
    if (a !=="") 
   	{
              
		$url="/froosh/index.php/home/check_username";
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


$('#captcha').blur(function(){
    var a = $("#captcha").val();
	
    if (a !=="") 
   	{
              
		$url="/froosh/index.php/home/check_captcha";
        $.post($url, {
            captcha: $('#captcha').val()
        }, function(response){
                
			if(response!="use")
		{
		$('#captchastatus').html('<span style="color:#f00;float:left" >Invalid Captcha. </span>');
		$('#capimage').html(response);
		$('input[type="submit"]').attr('disabled','disabled');
		}
		else
		{
		$('#captchastatus').html('');
		
			 $('input[type="submit"]').removeAttr('disabled');
		}
        });
	}
        return false;
   
	
	}); */





		
	  /*$('#uemail').blur(function(){
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
	
	});*/




		
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
          path: 'http://rhytha.info/froosh/index.php/auth/session/facebook',
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
		x="#"+id;
		if(id=="uname")
		$(x).attr('readonly', true);
		
	} 
	function updateview() 
	{ 
	    // this gets called from the popup window and updates the field with a new value 
	    window.location.href = "<?php echo $this->config->item('base_url'); ?>home/mview";
	} 
		function goBack() {
      window.location.href ="<?php echo $this->config->item('base_url'); ?>home/goback";
}
	</script>
</head>
<!--<body>

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
               Welcome to Profile Modification <?php if(isset($user['mode']) &&  strtolower($user['mode'])=="mobile")echo "(".$user['mode'].")";?>
            </div>-->

   <body id="top">

<div id="wrapper">

    <!-- start : header -->
    <div id="header">
        <div class="logo"><a href="http://www.froosh-cp.jp"><img src="<?php echo $this->config->item('base_url'); ?>assets/mobile/img/common/logo.png" alt="froosh"></a></div>
        <div class="accountArea">
            <!--<div class="account_btn blockLink pie"><a href="<?php echo $this->config->item('base_url'); ?>home/profile_edit"><span>アカウント</span><span class="icon-svg a_icon"></span></a></div>-->
        </div>
    </div>
    <!-- end : header -->
    
    <!-- start : main -->
    <div id="main">
    
        <!-- start : タイトル -->
        <div class="titleGroup">
            <h1 class="title_text bold">アカウントの編集</h1>
        </div>
        <!-- end : タイトル -->


	<form accept-charset="utf-8" id="formID" method="post" action="<?php echo $this->config->item('base_url');?>home/profile_modify" name="formID" class="form-horizontal">
            
        <div class="box">
            <p class="bold">名前（ニックネーム）</p>

            <input type=text name="uname" id="uname" class="validate[required,custom[onlyLetterNumber],minSize[4],maxSize[50]] form-control" placeholder="Username" value="<?php if(isset($user['uname']))echo $user['uname'];?>" readonly style="color: #a7a7a7;"> 

            <p class="bold">メールアドレス</p>
            <input type=text name="uemail" id="uemail" class="validate[required,custom[email]] form-control" value="<?php if(isset($user['uemail']))echo $user['uemail'];?>" placeholder="Email" readonly style="color: #a7a7a7;">
        
            <p class="bold">現在のパスワード</p>
            <input type=password name="upassword" id="upassword" class="validate[required,minSize[6],maxSize[50]] text-input form-control ipt_l" placeholder="パスワード" value="<?php if(isset($user['upassword']))echo $user['upassword'];?>" style="color: #a7a7a7;">
            
            
            <p class="bold">新しいパスワード<span class="notice">（確認）</span></p>
              <input type="password" name="newpassword2" id="newpassword2" value="<?php if(isset($user['upassword']))echo $user['upassword'];?>" placeholder="パスワード" class="validate[equals[upassword]] text-input form-control ipt_l" style="color: #a7a7a7;">
        </div>
        

<!--           <span style="float:left;"> <input type="radio" class="validate[required] radio" name="ugender" value="1" <?php if(isset($user['ugender']) && ($user['ugender']=="Male" || $user['ugender']=="男性"))echo "checked";?>></span><span style="float:left; margin-left:10px;">男性</span>
		   <span style="float:left; margin-left:10px;"> <input type="radio" class="validate[required] radio" name="ugender" value="2" <?php if(isset($user['ugender']) && ($user['ugender'])=="Female" || $user['ugender']=="女性") echo "checked";?>></span><span style="float:left; margin-left:10px;"> 女性</span> 
		    </div>
                   </div>
 <div class="clearfix"></div><br>

<div class="input-group date" id='datetimepicker5'>
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
	<input type=text name="ubdate" id="ubdate" class="validate[custom[date]] form-control" placeholder="生年月日" value="<?php if(isset($user['ubdate']))echo $user

['ubdate'];?>"> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
					</span></div>
                    <div class="clearfix"></div><div id="text4" style="padding-bottom: 5px;padding-top: 5px;"></div><br>-->


<!--start-->

         <hr>
            <div class="box">
                
                <p class="bold">名前（本名）</p>
                <input type="text" class="ipt_l" name="ufullname" id="ufullname" value="<?php if(isset($user['ufullname']))echo $user['ufullname'];?>" onFocus="HideFormGuide(this,'例）田中 太郎');" style="color: #a7a7a7;">
                
                <p class="bold">性別</p>
                <label for="man">
                    <input type="radio" class="validate[required] radio" name="ugender" value="1" <?php if(isset($user['ugender']) && ($user['ugender']=="Male" || $user['ugender'] =="男性" || $user['ugender']== 1 ))echo "checked";?>>&nbsp;男性
                </label>
                <label for="woman">
                   <input type="radio" class="validate[required] radio" name="ugender" value="2" <?php if(isset($user['ugender']) && ($user['ugender']=="Female" || $user['ugender']=="女性" || $user['ugender']== 2))echo "checked";?>>&nbsp;女性 
                </label>



<!--End-->


<!--start-->
                <?php 
                    if(isset($user['ubdate']))
                    {
                        $date  = strtotime($user['ubdate']);
                        $year  = date('Y',$date);
                        $month = date('m',$date);
                        $day   = date('d',$date);
                    }else{
                        $year ='年';
                        $month = '月';
                        $day = '日';
                    }  
                ?>
            <p class="bold mt10">生年月日</p>
                        <div class="select_birth">
                            <select name="ubyear" id="ubyear" class="birthSelect">
                               <option value="<?php echo $year; ?>" selected="selected"><?php echo $year; ?></option>
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
                            <select name="ubmonth" id="ubmonth" class="birthSelect">
                                <option value="<?php echo $month; ?>" selected="selected"><?php echo $month; ?></option>
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
                               <select name="ubday" id="ubday" class="birthSelect">
                                 <option value="<?php echo $day; ?>" selected="selected"><?php echo $day; ?></option>
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

<!--End-->
<!--<div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>-->
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
                 echo form_dropdown($dd_name, $dd_list,  ( !empty($user['uprefecture'])  ? $user['uprefecture'] : "" ) ,'class="addrSelect" id="uprefecture"');   ?>
                </div>
<!-- </div>
                    <div class="clearfix"></div><div id="text5" style="padding-bottom: 5px;padding-top: 5px;"></div><br>-->

<!--<div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
	<input type=text name="ucity" id="ucity" class="form-control" placeholder="市の名前" value="<?php if(isset($user['ucity']))echo $user['ucity'];?>"> </div>
                    <div class="clearfix"></div><div id="text6" style="padding-bottom: 5px;padding-top: 5px;"></div><br>
 
<br>-->

            <!--<p class="bold">市の名前</p>-->
                <input type="text" name="ucity" id="ucity" class="form-control" value="<?php if(isset($user['ucity']))echo $user['ucity'];?>" onFocus="HideFormGuide(this,'例）新宿区新宿XXX-X 9F');" style="color: #a7a7a7;">

<!--
                    <div class="clearfix"></div><br>-->
<!--                   <p class="center col-md-15">-->
                        <input type=hidden name="umode" id="umode" value="<?php if(isset($user['mode']))echo $user['mode']; else echo "mail"?>">
                        <input type=hidden name="uid" id="uid" value="<?php if(isset($user['uid']))echo $user['uid'];?>">
                        <input type=hidden name="umedia" id="umedia" value="<?php if(isset($umedia))echo $umedia; else echo "Mobile"?>"><br>
            
<!--                        <input type=submit value="Save" id="subutton" class="btn btn-primary">
                        <input type="button" value="Back" id="subutton" class="btn btn-primary" onclick="goBack()">-->
                        
                        
                        <div class="input_btn">
				<input type="button" value="戻る" id="subutton2"  onclick="goBack()" class="btn_back">&nbsp;
				<input type="submit" value="保存する" id="subutton" class="btn_save">
			</div>
                        
          </div>

	</form>
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


