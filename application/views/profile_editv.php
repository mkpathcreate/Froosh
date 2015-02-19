<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <meta name="description" content="">
    <meta name="author" content="">
    <title>froosh（フルーシュ）を飲んで北欧に行こうキャンペーン - アカウントの編集</title>
   
	
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url'); ?>assets/css/validationEngine.jquery.css" type="text/css"/>
        
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/css/default.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/css/common.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/css/webfont.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/css/form.css" media="all">

	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery-1.8.2.min.js" type="text/javascript">
	</script>  
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/languages/jquery.validationEngine-ja.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

 
  <script src="<?php echo $this->config->item('base_url'); ?>assets/js/common.js"></script>

<script src="<?php echo $this->config->item('base_url'); ?>assets/js/jquery.customSelect.js"></script>
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
		$('.birthSelect').customSelect({customClass:'birthSelectCustom'});
	$('.addrSelect').customSelect({customClass:'addrSelectCustom'});
		$("#upassword").focus(function() {
		  this.value = "";
		});


//				});
		$("#subutton").on("click",function(e){
		e.preventDefault();
		x=$('input[name="ugender"]:checked').val();
		if(x==1)
		{
		
		x="男性";
		}
		if(x==2)
		{
		
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
				if(response == "success")
				alert("プロフィール正常に更新");
				});
				return false;
			
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
         
		   }        
	    });
	}

	function connect_fb()
	{	
	     $.oauthpopup({
          path: 'http://test.froosh-cp.jp/index.php/auth/session/facebook',
          callback: function(){
          
		   }        
	    });
	}
	function connect_ig()
	{	
	     $.oauthpopup({
          path: 'http://test.froosh-cp.jp/index.php/auth/session/instagram',
          callback: function(){
         
		   }        
	    });
	}
	function updateValue(id, value) 
	{ 
	    
	    document.getElementById(id).value = value; 
		x="#"+id;
		if(id=="uname")
		$(x).attr('readonly', true);
		
	} 
	function updateview() 
	{ 
	    
	    window.location.href = "<?php echo $this->config->item('base_url'); ?>home/mview";
	} 
		function goBack() {
    window.location.href ="<?php echo $this->config->item('base_url'); ?>home/goback";
}
	</script>
</head>


<body id="top">

<div id="wrapper">
    <div id="head_tag">
        <img src="<?php echo $this->config->item('base_url'); ?>assets/js/img/common/tag.png" alt="froosh">
    </div>
    
    <div id="header">
        <div class="logo"><a href="mypage.php"><img src="<?php echo $this->config->item('base_url'); ?>assets/js/img/common/logo.png" alt="froosh"></a></div>
        <div class="accountArea">
            
        </div>
    </div>
    
    <div id="main">
    
        
        <div class="titleGroup">
            <h1 class="title_text bold">アカウントの編集</h1>
        </div>
       
                
                
                
	<form accept-charset="utf-8" id="formID" method="post" action="<?php echo $this->config->item('base_url');?>home/profile_modify" name="formID" class="form-horizontal">
	

            <div class="form_box">
                <table class="edit_table">
                    <tr>
                        <th><p class="bold">名前（ニックネーム）</p></th>
                            <td><input type="text" name="uname" id="uname" class="validate[required,custom[onlyLetterNumber],minSize[4],maxSize[50]] form-control"  value="<?php if(isset($user['uname']))echo $user['uname'];?>" onFocus="HideFormGuide(this,'例）スムージーフルーシュ');" style="color: #a7a7a7;" readonly></td>
                    </tr>
                    <tr>
                        <th><p class="bold">メールアドレス</p></th>
                        <td><input type="text" name="uemail" id="uemail" class="validate[required,custom[email]] form-control" value="<?php if(isset($user['uemail']))echo $user['uemail'];?>"  readonly onFocus="HideFormGuide(this,'?)taro@froosh.com');" style="color: #a7a7a7;" ></td>
                    </tr>
                    <tr>
                        <th><p class="bold">現在のパスワード</p></th>
                        <td><input type="password" name="upassword" id="upassword" class="validate[required,minSize[6],maxSize[50]] text-input form-control" placeholder="パスワード" value="<?php if(isset($user['upassword']))echo $user['upassword'];?>" style="color: #a7a7a7;"></td>
                    </tr>
					<tr>
                        <th><p class="bold">新しいパスワード<span class="notice">（確認）</span></p></th>
                        <td><input type="password" name="newpassword2" id="newpassword2" value="<?php if(isset($user['upassword']))echo $user['upassword'];?>" onFocus="HideFormGuide(this,'*******');" class="validate[required,equals[upassword]]" style="color: #a7a7a7;"></td>
                    </tr>
                </table>
            </div>
 
            <hr>
            <div class="form_box">
                <table class="edit_table">
				 <tr>
                        <th><p class="bold">名前（本名）</p></th>
                        <td><input type="text" class="ipt_l mt10" name="ufullname" id="ufullname" value="<?php if(isset($user['ufullname']))echo $user['ufullname'];?>" onFocus="HideFormGuide(this,'例）田中 太郎');" style="color: #a7a7a7;"></td>
                    </tr>
                    <tr>
                        <th><p class="bold">性別</p></th>
                        <td>
                        <label for="man">
                            <input type="radio" class="validate[required] radio" name="ugender" value="1" <?php if(isset($user['ugender']) && ($user['ugender']=="Male" || $user['ugender'] =="男性" || $user['ugender']== 1 ))echo "checked";?>>&nbsp;男性
                        </label>
                        <label for="woman">
                            <input type="radio" class="validate[required] radio" name="ugender" value="2" <?php if(isset($user['ugender']) && ($user['ugender']=="Female" || $user['ugender']=="女性"  || $user['ugender']== 2))echo "checked";?>>&nbsp;女性 
                        </label>
                        </td>
                    </tr>
 
 
                  
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
                  
                    <tr>
                        <th><p class="bold mt10">生年月日</p></th>
                        <td>
                        <div class="select_birth">
                        <div class="birthSelect_bg pie">
                            <select name="ubyear" id="ubyear" class="birthSelect" >
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
                            </div>
                            <div class="birthSelect_bg pie">
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
                            </div>
                            <div class="birthSelect_bg pie">
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
                        </div>
                        </td>
                    </tr>
                  
                  
                  
               
 <tr>
                        <th style="vertical-align: top;"><p class="bold">住所</p></th>
                        <td>
                        <div class="select_addr pie">
                            <div class="addrSelect_bg pie">

	<?php 
$dd_list = array(
                 ""   => "都道府県",
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
                        </div>
                    <input type="text" name="ucity" id="ucity" class="form-control" value="<?php if(isset($user['ucity']))echo $user['ucity'];?>" plceholder="例）新宿区新宿XXX-X 9F" style="color: #a7a7a7;">
                    </td>
                    </tr>
                </table>
            

            <p class="center col-md-15">
            <input type=hidden name="umode" id="umode" value="<?php if(isset($user['mode']))echo $user['mode']; else echo "mail"?>">
            <input type=hidden name="uid" id="uid" value="<?php if(isset($user['uid']))echo $user['uid'];?>">
            <input type=hidden name="umedia" id="umedia" value="<?php if(isset($umedia))echo $umedia; else echo "PC"?>"><br></p>

            <div class="input_btn mt0">
                    <input type="button" value="戻る" id="subutton2" onclick="goBack()" class="btn_back pie">
                    <input type="button" name="save" id="subutton"  value="保   存" class="btn_save pie">
            </div>

            </div>
        </form>
   

    </div>

    <div id="footer">
        <address>XrossFace Holdings Co., LTD.</address>
    </div>
    
</div>

</body>    
                         
                    

                    



</html>


