﻿<!DOCTYPE html> 
<head>
<meta charset="utf-8">
<meta name="Description" content="">
<meta name="Keywords" content="">
<meta name="author" content="">
<title>froosh（フルーシュ）を飲んで北欧に行こうキャンペーン 応募ページ</title>
<link href="<?php echo base_url(); ?>assets/css/dropzone.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/css/default.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/css/common.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>assets/css/webfont.css">

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dropzone.min.js" type="text/javascript"> </script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/boostrapv3/js/bootstrap.min.js" type="text/javascript"> </script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.alerts.js" type="text/javascript"> </script> -->
<link href="<?php echo base_url(); ?>assets/js/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<!--<link href="<?php echo base_url(); ?>assets/css/jquery.alerts.css" rel="stylesheet" type="text/css"/>-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/css/colorbox.css">
<script src="<?php echo base_url(); ?>assets/js/jquery.colorbox.js"></script>

<script src="<?php echo $this->config->item('base_url'); ?>assets/js/common.js"></script>
<script src="<?php echo $this->config->item('base_url'); ?>assets/js/image-scale.js"></script>



<script type="text/javascript">
var flist="";
img0=new Image()
	img0.src="<?php echo base_url(); ?>assets/img/common/type_img_br_pc.png"
	img1=new Image()
	img1.src="<?php echo base_url(); ?>assets/img/common/type_img_mo_pc.png"
	img2=new Image()
	img2.src="<?php echo base_url(); ?>assets/img/common/type_img_pbc_pc.png"
	img3=new Image()
	img3.src="<?php echo base_url(); ?>assets/img/common/type_img_ocg_pc.png"
	/*
	img4=new Image()
	img4.src="img/common/type_img_sbg.png"
	*/
	
	function imgChange(parts){
	fname=parts.options[parts.selectedIndex].value;
	if(fname==0){document.imgsmp.src=img0.src;}
	if(fname==1){document.imgsmp.src=img1.src;}
	if(fname==2){document.imgsmp.src=img2.src;}
	if(fname==3){document.imgsmp.src=img3.src;}
	//if(fname==4){document.imgsmp.src=img4.src;}
	}

$(document).ready(function(){	
 $("img.scale").imageScale();
 $("#iview").hide();

/*$("#sucbut").on("click",function()
{
$("input[value='Delete']").remove();
});*/


/*$.ajax({
	    url : "/fupload/imgflvdetails3",
	    type: "POST",
	    success: function(data, textStatus, jqXHR)
	    {
		var res = data;
		
		flist=res;
		
	    }
	   }); */

Dropzone.autoDiscover = false; // keep this line if you have multiple dropzones in the same page
	var idClicked;
       var idClicked2;
        var flaid;

$('body').click(function(e) {
var target = $(e.target);

if(target.is("[id^='img']")){
//idClicked="#img1";
idClicked="#"+e.target.id;

if(typeof $(idClicked).attr('flaid')=='undefined' || $(idClicked).attr('flaid')=='undefined'){
$('#seldata')
    .empty()
    .append('<option selected="selected" value="0">select</option>')
    .append('<option value="1">マンゴー＆オレンジ</option>')
    .append('<option value="2">パイナップル・バナナ＆ココナッツ</option>')
    .append('<option value="3">オレンジ・キャロット＆ジンジャー</option>')
    //.append('<option value="4">Carrot</option>')
    //.append('<option value="5">Strawberry</option>')
;

$("#seldata").attr("disabled",false);
console.log("flist @"+flist);
for ( i = 1; i <6; i++) {
$("#seldata option[value='" + i+ "']").attr("disabled", false);
}
p=flist.split(",");
 for (var i = 0, len = p.length; i < len; i++) {
$("#seldata option[value='" + p[i]+ "']").attr("disabled", true);
}
}
else



{
flaid=$(idClicked).attr('flaid');
$('#seldata')
    .empty()
    .append('<option value="0">select</option>')
     .append('<option selected="selected" value="0">select</option>')
    .append('<option value="1">マンゴー＆オレンジ</option>')
    .append('<option value="2">パイナップル・バナナ＆ココナッツ</option>')
    .append('<option value="3">オレンジ・キャロット＆ジンジャー</option>')
   // .append('<option value="4">Carrot</option>')
   // .append('<option value="5">Strawberry</option>')
;

$("#seldata option[value='" + flaid + "']").attr("selected", true);
$("#seldata").attr("disabled","disabled");


}

}
});


$('select').on('change', function() {

  x=$('select option:not(:selected)');
  
  
  out="<input type=checkbox id="+x[0].text+" name="+x[0].value+">"+x[0].value+"<br><input type=checkbox id="+x[1].value+" name="+x[1].value+">"+x[1].value+"<br><input type=checkbox id="+x[2].value+" name="+x[2].value+">"+x[2].value;
 // $('#remfl').html(out);
  
});

//Dropzone.options.myDropzone = {
$(".uploadform").dropzone({	
//enqueueForUpload: true,
autoProcessQueue:false,
maxFiles: 1,
acceptedFiles:"image/jpeg,image/png",
maxFilesize:3,
  url: '<?php echo site_url('/fupload/upload'); ?>',

  
    init: function() {
	var submitButton = document.querySelector("#subbuttimg")
        myDropzone = this; // closure
	this.on("maxfilesexceeded", function(file){
        alert("No more files please!");
	 this.removeFile(file);
    });
	this.on("uploadprogress",function(file, progress) {
      
    });
    submitButton.addEventListener("click", function() {
      v1=$("#seldata").val();
	if(v1!=0)
      myDropzone.processQueue(); // Tell Dropzone to process all queued files.
	else
	  alert("Select the Image and Flavour");
    });
    },
	sending:function(file, xhr, formData) {
	v2=$(idClicked).attr('iminfo');
	v1=$("#seldata").val();
	//$(idClicked).attr('selflv',v1);
    formData.append("uid",<?php echo $uid; ?>); // Append all the additional input data of your form here!
	if(v2!='')
	formData.append("imid",v2);
	formData.append("flavor",v1);
	
	},
	success: function (response) {
		//var x = JSON.parse(response.xhr.responseText);
		var x=response.xhr.responseText;
		x = x.replace(/.*?:/g, "");
		$('.icon').hide();
		$('#uploader').modal('hide');
		//$(idClicked).attr('src',"<?php echo base_url()."uploads/"; ?>"+x.img);
		$(idClicked).attr('src',x);
		$(idClicked).attr('iminfo',x.iid);
		//$(idClicked).parent().prepend('<input type="button" value="Delete" onclick="iminfo(event,'+x.iid+');">');
		$(idClicked).parent().prepend('<div class="remove bg_fit" onclick="iminfo(event,'+x.iid+');"></div>');
		$(idClicked).attr('flaid',x.fname);
		$(idClicked).attr('id',"img"+x.iid);
		idClicked2="#img"+x.iid;
		flist=x.flvdet;
			
		$('.thumb').attr('src',x.thumb);
		$('img').addClass('imgdecoration');
		this.removeAllFiles();
		if(x.butstatus==1)
		{
		alert("You Are Uploading the First Image");
		}
		if(x.butstatus==2)
		{
		$("#sucbut").show();
		}
		else
		{
		$("#sucbut").hide();
		}
		if(x.phase>1)
		{
	
		}

		$.ajax({
		    url : "<?php echo base_url();?>home/success2",
		    type: "POST",
		    success: function(data)
		    {
			imlist2=JSON.parse(data);
			fresult="";
			for (i = 0, len = imlist2.length; i < len; i++) {
			var myDate=parseInt(imlist2[i]['idate'].replace('/Date(', ''));
			if(i==0)
			fresult+="<dl class='history new'><dt>"+imlist2[i]['idate']+"</dt><dd>"+imlist2[i]['fname']+"</dd></dl>";
			else
			fresult+="<dl class='history'><dt>"+imlist2[i]['idate']+"</dt><dd>"+imlist2[i]['fname']+"</dd></dl>";
			}
			$("#userstatus").html(fresult);	
			
		}
		});
		
	},
	addRemoveLinks: true,
	removedfile: function(file) {
   	var _ref;
			 return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;  
     }
	//};
});	

//if($(".dz-clickable").length!=0)
$("form#myDropzone .dz-clickable").trigger('click');
});

function iminfo(event,x){
event.stopPropagation();
var formData={"imid":x};
if(confirm("Are you sure?"))
{
$.ajax({
    url : "<?php echo base_url();?>home/deleteimage",
    type: "POST",
    data : formData,
    success: function(data, textStatus, jqXHR)
    {
	
	
	//    jAlert('Confirmed: ' + r, 'Confirmation Results');

	//        alert("Image Deleted");
	alert('Image Deleted');
	$("#seldata").prop("disabled", false);
		t="#img"+x;
		$(t).attr('src','<?php echo base_url(); ?>assets/img/common/upload_01.png');
		$(t).attr('flaid',"undefined");
		$(this).next().hide();	
		$(event.target).hide();
		//$(idClicked).attr("id",idClicked2);
		//$(idClicked2).attr('flaid',"undefined");
		$("#seldata").prop("disabled", false);
		
	$.ajax({
	    url : "<?php echo base_url();?>fupload/imgflvdetails2",
	    type: "POST",
	    data : formData,
	    success: function(data, textStatus, jqXHR)
	    {
		var res = data;
		
		flist=res;
		
	    }
	   });

		$.ajax({
		    url : "<?php echo base_url();?>home/success2",
		    type: "POST",
		    success: function(data)
		    {
			imlist2=JSON.parse(data);
			fresult="";
			for (i = 0, len = imlist2.length; i < len; i++) {
			//fresult+=imlist2[i]['idate']+"     "+imlist2[i]['fname']+"<br>";
			if(i==0)
			fresult+="<dl class='history new'><dt>"+imlist2[i]['idate']+"</dt><dd>"+imlist2[i]['fname']+"</dd></dl>";
			else
			fresult+="<dl class='history'><dt>"+imlist2[i]['idate']+"</dt><dd>"+imlist2[i]['fname']+"</dd></dl>";
			}
			$("#userstatus").html(fresult);		
		}
		});
		
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
 alert("Image Undeleted");
    }
});
}
}



</script>
</head>
<body id="top">
<div id="demo-header"></div>
<div id="wrapper">
     <div id="head_tag">
        <img src="<?php echo $this->config->item('base_url'); ?>assets/js/img/common/tag.png" alt="froosh">
    </div>
    <!-- start : header -->
    <div id="header">
        <div class="logo"><a href="mypage.php"><img src="<?php echo $this->config->item('base_url'); ?>assets/js/img/common/logo.png" alt="froosh"></a></div>
        <div class="accountArea">
            <div class="account_btn blockLink pie"><a href="<? echo $this->config->item('base_url')."home/profile_edit/"; ?>"><span>アカウント</span><span class="icon-svg a_icon"></span></a></div>
				
			<div class="account_btn blockLink pie" style="margin-top:10px"><a href="<? echo $this->config->item('base_url')."home/logout/"; ?>"><span>ログアウト</span></a></div>
			
			 </div>
    </div>
    <!-- end : header -->
    
    <!-- start : main -->
    <div id="main">
    
        <!-- start : タイトル -->
        <div class="titleGroup">
            <h1 class="title_text">froosh(フルーシュ)を飲んで北欧に行こう<br>キャンペーン応募ページ</h1>
            <p class="period">応募期間：2015年3月31日まで</p>
        </div>
        <!-- end : タイトル -->
                
        <!-- start : 写真投稿 -->
		<div class="uplad_titleArea">
            <h2 class="title">写真投稿</h2>
            <div class="text">
                <p>※1枚投稿で<span class="notice">「参加賞(リサ･ラーソンの置物)」</span>への応募が完了し、4枚投稿で<span class="notice">「北欧往復チケット賞」</span>へ応募ができます。</p>
            </div>
        </div>
		
<!--<div class="container" style="width:1029px;">-->

	
                    
    <div class="box mt0">                    
              <div class="uploadArea" id="iview">
              
				<?php if(isset($images)) { ?>
                    <p class="times"><span><?php echo "1回目";?></span></p>
					<div class="uploadWrap"> 
						<?php } ?>
              
 	<?php if(isset($images)){ $la=1; foreach($images as $key =>$value){ ?>
	
           

<?php if($la!= $value['phase']){ $la=$value['phase'];?> <br><div class="times"><span><?php echo $la."回目"."</span></div><br>";} ?>
<div class="upload">

<div  id="buploader" data-toggle="modal" <?php if($value['fstatus']!=1) { ?>data-target="#uploader"  <?php } ?> style="width:160px;  margin-right: 4px; height:172px; border:1px solid ; float:left; cursor:pointer;">

                            
<?php if($value['fstatus']!=1){?>
<div class="remove bg_fit" onclick="iminfo(event,<?php if($value['id']!=''){ echo $value['id'];} else echo "0";    ?>);"></div> <!--<input type="button" value="Delete" onclick="iminfo(event,<?php //if($value['id']!=''){ echo $value['id'];} else echo "0";    ?>);">--> <?php } ?> 

<img id="img<?php if($value['id']!=''){ echo $value['id'];}?>" <?php if($value['image_name']!=''){ ?> src="<?php echo base_url()."uploads/".$value['image_name']; }else ?>" src=""  

height=170 width=160 iminfo=<?php if($value['id']!=''){ echo $value['id'];} else echo "0";    ?>  flaid=<?php if($value['image_fla_id']!=''){echo $value['image_fla_id'];}else 

echo 0; ?>  /> </div></div><?php } }?>
						
			<?php if(isset($images)) { ?>	
			</div>
			<?php } ?>
			</div></div>
			 <div class="uploadArea">
                
				<div class="times"><span><?php if(isset($la))echo (++$la)."回目"; else echo "1回目";?></span></div>
				<div class="uploadWrap">
				
				<div class="upload">
				
	<div  id="buploader2" data-toggle="modal" data-target="#uploader"  style="width:160px;  margin-right: 4px; height:208px; border:1px solid ; float:left; cursor:pointer;"><img id="img2" src="<?php echo base_url(); ?>assets/img/common/upload_01.png"  height=206 width=200  /> </div>
	</div>
	<div class="upload">
	<div  id="buploader3" data-toggle="modal" data-target="#uploader"  style="width:160px;  margin-right: 4px; height:208px; border:1px solid ; float:left; cursor:pointer;"><img id="img3" src="<?php echo base_url(); ?>assets/img/common/upload_02.png" height=206 width=200 /> </div>
	</div>
	<div class="upload">
	<div  id="buploader4" data-toggle="modal" data-target="#uploader"  style="width:160px;  margin-right: 4px; height:208px; border:1px solid ; float:left; cursor:pointer;"><img id="img4" src="<?php echo base_url(); ?>assets/img/common/upload_03.png" height=206 width=200  /> </div>
	</div>
	<div class="upload">
    <div style="display:block;text-align:center">
	
	<div  id="buploader5" data-toggle="modal" data-target="#uploader"  style="width:160px;  margin-right: 4px; height:208px; border:1px solid ; float:left; cursor:pointer;"><img  id="img5" src="<?php echo base_url(); ?>assets/img/common/upload_04.png"  height=206 width=200  /> </div>
		</div></div></div></div></div>
    <div class="btn_apply blockLink pie" style="cursor: pointer;">
  <!--  <img class="img" src="" style="width:350px"> <br/>
    <img class="thumb" src="" style="width:180px">  -->
    <a href="<?php echo site_url('/home/success/'); ?>" id="sucbut">応募する</a>
           
	</div>
	<!-- Start Post Attachments -->
                   <div class="modal fade" id="uploader" tabindex="-1" role="dialog" aria-labelledby="updater" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                         <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>-->
                          <br>
                          <i class="icon-credit-card icon-7x"></i>
                          <p class="no-margin">あなたは、一度に1 JPEGまたはPNGまたはJPGファイルをアップロードすることができます！</p>
                        </div>
                        <div class="modal-body">
                          <form action="" class="uploadform dropzone no-margin dz-clickable" id="myDropzone">   
									あなたの画像を削除するか、またはここをクリック						  
                   		  <div class="dz-default dz-message">
                          <span>ここにあなたのカバー画像をドロップ</span>
                          </div>
						  		  
                          </form>
						<!--	Choose the Flavor:
						  <select id="seldata">
						  <option value="0">Select</option>
						  <option value="1">Mango</option>
						  <option value="2">Pineapple</option>
						  <option value="3">Blueberry</option>
						  <option value="4">Carrot</option>
						  <option value="5">Strawberry</option>
						  </select><br><br><br>-->
						  <p>●種類を選んで投稿してください</p>
				<div class="typeSelectArea pie" style="width:397px;">
					<div class="type_img"><img src="<?php echo base_url(); ?>assets/img/common/type_img_br_pc.png" alt="ブルーベリー＆ラズベリー" name="imgsmp"></div>
						<div class="typeSelectWrap" style="position: relative;width: 382px;">
							<!-- <select name="focus" id="type" class="typeSelect" onchange="imgChange(this)"> -->
				<select name="focus" class="typeSelect hasCustomSelect" id="type" onchange="imgChange(this)" style="position: absolute;opacity: 0.5;margin-top: 0px;width: 325px;margin-left: 50px;border:0px"> 
								<option value="0" selected="selected">ブルーベリー＆ラズベリー</option>
								<option value="1">マンゴー＆オレンジ</option>
								<option value="2">パイナップル・バナナ＆ココナッツ</option>
								<option value="3">オレンジ・キャロット＆ジンジャー</option>
								<!--<option value="4">ストロベリー・バナナ＆グアバ</option>-->
							</select>
						</div>
				</div>
				<!-- / 商品タイプセレクトエリア -->
        
				<p class="notice fs14 center">※既に登録した種類を再度選択することはできません。</p>
				
				<div>
<!--<img style="width:520px;" src="<?php //echo base_url(); ?>assets/images/flavour.jpg">-->
</div>		 
                         </div>
                          <div class="modal-footer">
						  <!-- btn btn-default attachtopost-->
						  <center>
						  <button type="button" class="btn_upload pie" id="subbuttimg">写真を投稿する</button>
                          <button type="button" class="btn_cancel pie" data-dismiss="modal">キャンセル</button>
						  </center>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
  <!-- End Post Attachments -->
  
  <!--<a href="<?php echo site_url('home/logout'); ?>">logout</a>
<a href="<?php echo site_url('home/profile_edit'); ?>">Edit Profile</a>-->
		
	
 <hr>
        
        <!-- start : 応募方法 -->
        <h2 class="title_02">応募方法</h2>
        <div class="stepArea">
            <div class="step_wrap">
                <div class="step_img"><img src="<?php echo base_url(); ?>assets/js/img/common/step_01.png" alt=""></div>
                <div class="step_body">
                    <div class="inner">
                        <h4><span class="icon-svg2 step_num"></span><span class="step_title">frooshの写真を撮る</span></h4>
                        <p class="idt_1">※空の状態・中身が入った状態どちらでもOK!<br>
                        ラベルが見えるように撮ってください。</p>
                    </div>
                </div>
            </div>

            <div class="step_wrap">
                <div class="step_img"><img src="<?php echo base_url(); ?>assets/js/img/common/step_02.png" alt=""></div>
                <div class="step_body">
                    <div class="inner">
                        <h4><span class="icon-svg3 step_num"></span><span class="step_title">写真を登録する</span></h4>
                        <p class="idt_1">※４種類別々の写真を登録します。<br>
                        1回の応募のうち､同じ種類は登録できません。</p>
                    </div>
                </div>
            </div>

            <div class="step_wrap">
                <div class="step_img"><img src="<?php echo base_url(); ?>assets/js/img/common/step_03.png" alt=""></div>
                <div class="step_body">
                    <div class="inner">
                        <h4><span class="icon-svg4 step_num"></span><span class="step_title">応募する！</span></h4>
                        <p class="idt_1">※４種類登録したら「応募する」ボタンを押します。キャンペーンは何度でも応募できます。</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- / .stepArea -->
        <!-- end : 応募方法 -->
        
        <!-- start : 利用規約 -->
        <div class="box pb0">
            <div class="tgl_btn pie">
                <h2 class="tgl_text">利用規約</h2>
            </div>
            <div class="tgl_cont policy mt10">
                <p>この利用規約（以下、「本規約」といいます。）は、クロスフェイスホールディングス株式会社（以下、「当社」といいます。）がこのウェブサイト上で提供するサービス（以下、「本サービス」といいます。）の利用条件を定めるものです。登録ユーザーの皆さま（以下、「ユーザー」といいます。）には、本規約に従って、本サービスをご利用いただき、以下の利用規約に同意したものとみなします。</p>
                <h3 class="pp_title">第1条（適用）</h3>
                <p class="pp_text">本規約は、ユーザーと当社との間の本サービスの利用に関わる一切の関係に適用されるものとします。</p>

                <h3 class="pp_title">第2条（利用登録）</h3>
                <ol class="pp_text">
                    <li>登録希望者が当社の定める方法によって利用登録を申請し、当社がこれを承認することによって、利用登録が完了するものとします。</li>
                    <li>当社は、利用登録の申請者に以下の事由があると判断した場合、利用登録の申請を承認しないことがあり、その理由については一切の開示義務を負わないものとします。<br>
                    （1）利用登録の申請に際して虚偽の事項を届け出た場合<br>
                    （2）本規約に違反したことがある者からの申請である場合<br>
                    （3）その他、当社が利用登録を相当でないと判断した場合</li>
                </ol>

                <h3 class="pp_title">第3条（ユーザーIDおよびパスワードの管理）</h3>
                <ol class="pp_text">
                    <li>ユーザーは、自己の責任において、本サービスのユーザーIDおよびパスワードを管理するものとします。</li>
                    <li>ユーザーは、いかなる場合にも、ユーザーIDおよびパスワードを第三者に譲渡または貸与することはできません。当社は、ユーザーIDとパスワードの組み合わせが登録情報と一致してログインされた場合には、そのユーザーIDを登録しているユーザー自身による利用とみなします。</li>
                </ol>
                
                <h3 class="pp_title">第4条（禁止事項）</h3>
                <p class="pp_text">ユーザーは、本サービスの利用にあたり、以下の行為をしてはなりません。<br>
                （1）法令または公序良俗に違反する行為<br>
                （2）犯罪行為に関連する行為<br>
                （3）当社のサーバーまたはネットワークの機能を破壊したり、妨害したりする行為<br>
                （4）当社のサービスの運営を妨害するおそれのある行為<br>
                （5）他のユーザーに関する個人情報等を収集または蓄積する行為<br>
                （6）他のユーザーに成りすます行為<br>
                （7）当社のサービスに関連して、反社会的勢力に対して直接または間接に利益を供与する行為<br>
                （8）その他、当社が不適切と判断する行為</p>
                
                <h3 class="pp_title">第5条（本サービスの提供の停止等）</h3>
                <ol class="pp_text">
                    <li>当社は、以下のいずれかの事由があると判断した場合、ユーザーに事前に通知することなく本サービスの全部または一部の提供を停止または中断することができるものとします。<br>
                        （1）本サービスにかかるコンピュータシステムの保守点検または更新を行う場合<br>
                        （2）地震、落雷、火災、停電または天災などの不可抗力により、本サービスの提供が困難となった場合<br>
                        （3）コンピュータまたは通信回線等が事故により停止した場合<br>
                    （4）その他、当社が本サービスの提供が困難と判断した場合                    </li>
                    <li>当社は、本サービスの提供の停止または中断により、ユーザーまたは第三者が被ったいかなる不利益または損害について、理由を問わず一切の責任を負わないものとします。</li>
                    <li>当社は，利用者に対し14日前までに通知を行うことにより各サービスを終了することができるものとします。</li>
                    <li>前項の各サービス終了の通知について，当社は，利用者及び閲覧者に対して本サイト内への掲示、利用者のメールアドレスへの連絡をもって行うものとします。</li>
                    <li>第3項の各サービス終了によって直接又は間接的に生じた，利用者又は第三者の損失や損害について，その内容，態様の如何に係わらず，当事務所は，同利用者又は第三者に対して一切の損害の責任を負いません。</li>
                </ol>
                
                <h3 class="pp_title">第6条（利用制限および登録抹消）</h3>
                <ol class="pp_text">
                    <li>当社は，以下の場合には，事前の通知なく，投稿データを削除し，ユーザーに対して本サービスの全部もしくは一部の利用を制限しまたはユーザーとしての登録を抹消することができるものとします。<br>
                        （1）本規約のいずれかの条項に違反した場合<br>
                        （2）登録事項に虚偽の事実があることが判明した場合<br>
                        （3）破産，民事再生，会社更生または特別清算の手続開始決定等の申立がなされたとき<br>
                        （4）3か月以上本サービスの利用がない場合<br>
                        （5）当社からの問い合わせその他の回答を求める連絡に対して30日間以上応答がない場合<br>
                        （6）第2条第2項各号に該当する場合<br>
                    （7）その他，当社が本サービスの利用を適当でないと判断した場合</li>
                    <li>当社は，本条に基づき当社が行った行為によりユーザーに生じた損害について，一切の責任を負いません。</li>
                </ol>
                
                <h3 class="pp_title">第7条（著作権）</h3>
                <ol class="pp_text">
                    <li>ユーザーは、自ら著作権等の必要な知的財産権を有するか、または必要な権利者の許諾を得た文章、画像や映像等の情報のみ、本サービスを利用し、投稿または編集することができるものとします。</li>
                    <li>ユーザーが本サービスを利用して投稿または編集した文章、画像、映像等の著作権については、当該ユーザーその他既存の権利者に留保されるものとします。ただし、当社は、本サービスを利用して投稿または編集された文章、画像、映像等を利用できるものとし、ユーザーは、この利用に関して、著作者人格権および使用に関する著作権使用料請求を行使しないものとします。</li>
                    <li>前項本文の定めるものを除き、本サービスおよび本サービスに関連する一切の情報についての著作権およびその他知的財産権はすべて当社または当社にその利用を許諾した権利者に帰属し、ユーザーは無断で複製、譲渡、貸与、翻訳、改変、転載、公衆送信（送信可能化を含みます。）、伝送、配布、出版、営業使用等をしてはならないものとします。</li>
                    <li>本サービスの閲覧者は，当社が特段の事情があると判断した場合を除き，本サイトの画像，データ及びプログラムを他のサイト，雑誌，広告等に転載できないものとします。ただし，閲覧者は，当社の許諾を得た場合，本サイト上の記事及び文章をＷＥＢサイト上において転載及び引用することができるものとします。</li>
                    <li>前項に違反して本サイトに掲載の情報等を無断で転載した場合，当社は，同違反者に対し，著作権法に基づく各処置（警告，告訴，損害賠償請求，差止請求，名誉回復措置等請求等）を行います。</li>
                </ol>
                
                <h3 class="pp_title">第8条（保証の否認および免責事項）</h3>
                <ol class="pp_text">
                    <li>当社は、本サービスに事実上または法律上の瑕疵（安全性、信頼性、正確性、完全性、有効性、特定の目的への適合性、セキュリティなどに関する欠陥、エラーやバグ、権利侵害などを含みます。）がないことを明示的にも黙示的にも保証しておりません。</li>
                    <li>本サイト内のすべての情報，記事，画像等に，ウイルスなどの有害物が含まれていないこと，および第三者からの不正なアクセスのないこと，その他本サイトの安全性に関して一切の保証をしないものとします。</li>
                    <li>当社は、本サービスに関して、ユーザーと他のユーザーまたは第三者との間において生じた取引、連絡または紛争等について一切責任を負いません。</li>
                </ol>
                
                <h3 class="pp_title">第9条（サービス内容の変更等）</h3>
                <p class="pp_text">当社は、ユーザーに通知することなく、本サービスの内容を変更しまたは本サービスの提供を中止することができるものとし、これによってユーザーに生じた損害について一切の責任を負いません。</p>
                
                <h3 class="pp_title">第10条（利用規約の変更）</h3>
                <p class="pp_text">当社は、必要と判断した場合には、ユーザーに通知することなくいつでも本規約を変更することができるものとします。</p>
                
                <h3 class="pp_title">第11条（通知または連絡）</h3>
                <p class="pp_text">ユーザーと当社との間の通知または連絡は、当社の定める方法によって行うものとします。</p>
                
                <h3 class="pp_title">第12条（権利義務の譲渡の禁止）</h3>
                <p class="pp_text">ユーザーは、当社の書面による事前の承諾なく、利用契約上の地位または本規約に基づく権利もしくは義務を第三者に譲渡し、または担保に供することはできません。</p>
                
                <h3 class="pp_title">第13条（準拠法・裁判管轄）</h3>
                <ol class="pp_text">
                    <li>本規約の解釈にあたっては、日本法を準拠法とします。</li>
                    <li>本サービスに関して紛争が生じた場合には、当社の本店所在地を管轄する裁判所を専属的合意管轄とします。</li>
                </ol>
                
                <p class="right mt10">以上</p>
            </div>
        </div>
        <!-- / .box -->
        <!-- end : 利用規約 -->

        <!-- start : 個人情報の取り扱い -->
        <div class="box pb0">
            <div class="tgl_btn">
                <h2 class="tgl_text">個人情報の取り扱い</h2>
            </div>
            <div class="tgl_cont policy">
                <p class="bold mt10">クロスフェイスグループ　個人情報保護方針</p>
                <h3 class="pp_title">1. 本方針</h3>
                <ol class="pp_text">
                    <li>本方針は、お客様がクロスフェイスグループ（以下「当グループ」という）の運営するサイト、サービス（以下「サービス」という）をご利用されたことに伴い、当グループが取得したお客様の個人情報の取り扱い方針を定めるものです。</li>
                </ol>
                
                <h3 class="pp_title">2. 用語の意味</h3>
                <ol class="pp_text">
                    <li>本方針において、「個人情報」は、「個人情報の保護に関する法律」（以下「個人情報保護法」といいます）第2条各号に定める意味を有します。</li>
                    <li>本方針において、「当グループ」とは、クロスフェイスホールディングス株式会社、その子会社、関連会社、持分法の適用される会社、その他業務上の提携関係にある会社であって、別途指定される会社をいいます。なお、「当グループ」として指定される会社は随時更新され、現在の「当グループ」 に所属する主な会社は、株式会社クロスフェイス、株式会社ワ・ソシエテ、株式会社コンセプト・ビィになります。</li>
                    <li>本方針において、「サービス提供者」とは、キャンペーン、ショップ、取引の対象となる商品を提供する者をいいます。</li>
                </ol>
                
                <h3 class="pp_title">3. 個人情報の収集</h3>
                <ol class="pp_text">
                    <li>当グループは、サービスの提供にあたり、主に以下のような、お客様に関する情報を取得します。なお、以下は例示であり、また、情報の具体的内容によっては個人情報に該当しない場合もあります。
                    <ol style="margin-left: 0.5em;">
                    	<li><strong>お客様から提供される情報</strong><br>
                    	    <p>&#9312;氏名（フリガナを含む）、住所、電話番号（携帯電話・FAXを含む）、電子メールアドレス、携帯メールアドレス、その他連絡先に関する情報、職業、年齢・生年月日、性別、クレジットカード情報など、お客様から当グループに提供される一切の情報 </p>
                    	    <p>&#9313;他の方が贈答品などの相手先としてお客様を指定した場合に当グループが取得する、お客様  の氏名（フリガナを含む）、住所、電話番号（携帯電話・FAXを含む）、電子メールアドレス、携帯メールアドレス、所在地、その他連絡先に関する情報（以下「宛先情報」といいます）</p>
                    	    <p>&#9314;サービス提供者がサービスとは別に取得した個人情報で当グループ所定の手続きにより、当グループに提供された情報</p>
                    	</li>
                        <li><strong>サービスの利用に関連して取得される情報</strong><br>
                        <p>&#9312;お客様が当グループまたはサービス提供者が提供する商品の予約・購入、プレゼント応募、その他の取引を申し込まれた場合の、お客様を識別できる情報と紐づいた状態での取引履歴に関する情報</p>
                        <p>&#9313;当グループからのメールマガジンなどの購読に関する情報</p>
                        <p>&#9314;電話や電子メール、SNSその他の手段により、当グループまたはサービス提供者に質問する、アンケートやキャンペーンに参加する、掲示板を利用する、またはサービスを評価するなどを行った場合の、その発言または記載内容に関する情報</p>
                        </li>
                        <li><strong>アクセスしたことを契機として機械的に取得される情報</strong><br>
                        <p>&#9312;お客様のコンピュータがインターネットに接続するときに使用されるIPアドレス、携帯端末の機体識別に関する情報</p>
                        <p>&#9313;当グループの運営するウェブサイトにアクセスしたことを契機として取得された、お使いのブラウザの種類・バージョン、オペレーティングシステム、プラットフォームなどのほか、お客様の閲覧されたページ(URL)、閲覧した日時、表示または検索された商品などに関する情報</p>
                        <p>&#9314;上記のほか、クッキー(cookie)やウェブビーコン(web beacon)の技術を使用して取得したアクセス情報など、お客様が当グループのサービスを利用されるごとに、自動的に収集・保管される情報</p>
                        </li>
                    </ol>
                    </li>
                </ol>
                
                <h3 class="pp_title">4. 利用目的</h3>
                <ol class="pp_text">
                    <li>当グループは、当グループが取得したお客様の個人情報について、次の目的（以下「利用目的」といいます）のために利用いたします。ただし、お客様が指定された他の方の宛先情報につきましては、ご本人から個別の同意がない限り、下記のB、DおよびFの目的に限って利用いたします。
                    <p class="pp_text"><strong>A. お客様が当グループのサービスを利用する場合</strong></p>
                    <p>当グループのサービスに登録し、サービスを利用する場合、ログイン時およびログイン後における本人認証、各種画面におけるお客様の情報の自動表示</p>
                    <p class="pp_text"><strong>B. 当グループの提供する取引の遂行</strong></p>
                    <p>お客様が商品の予約・購入、プレゼントなどの応募、その他の取引を申し込まれた場合には、商品の配送、代金決済、お客様からのお問い合わせへの対応、当グループからお客様へのお問い合わせ、関連するアフター サービス、その他取引遂行にあたって必要な業務</p>
                    <p class="pp_text"><strong>C. 当グループの広告宣伝またはマーケティングなど</strong></p>
                    <p>&#9312;お客様向け各種メールマガジンなどの情報提供 </p>
                    <p>&#9313;サービスについての電子メール、郵便、電話などによる情報提供 </p>
                    <p>&#9314;お客様がご覧になるコンテンツや広告を、お客様の性別、年齢、居住地、趣味・嗜好など個人の属性または購入履歴、当グループの運営するウェブサイトの閲覧履歴などによりパーソナライズするため </p>
                    <p>&#9315;お客様によるサービスの利用を分析し、新規サービスの開発や既存サービスの改善をするため</p>
                    <p>&#9316;アンケート、キャンペーン、掲示板などの意見・情報の交換、日記等のサービスに関連して、お客様と連絡をとること</p>
                    <p class="pp_text"><strong>D. お客様からのお問い合わせへの対応</strong></p>
                    <p>お客様から当グループになされる、電子メール、郵送、電話などによるお問い合わせに対する対応</p>
                    <p class="pp_text"><strong>E. その他業務に付随する場合</strong></p>
                    <p>上記AからDに付随して、当グループのサービス提供にあたって必要な利用</p>
                    <p class="pp_text"><strong>F. サービス提供者への提供</strong></p>
                    <p>サービス提供者に対し、『5.個人情報等の取り扱い』に従い、個人情報を提供すること</p>
                    <p class="pp_text"><strong>G. その他</strong></p>
                    <p>個別サービスにおいて、上記に規定のない目的で個人情報を利用する場合があります。その場合には、個別サービスのウェブサイトにその旨を掲載します。</p>
                    </li>
                </ol>
                
                <h3 class="pp_title">5. 個人情報等の取り扱い</h3>
                <ol class="pp_text">
                    <li>当グループは、個人情報保護法に従い、個人情報を取り扱います。</li>
                    <li>当グループは、利用目的の達成に必要な範囲で、お客様の個人データを、当グループ各社間で共同利用いたします。
                    <p>&#9312;共同利用される個人データは、『3.個人情報の収集』と同じです。</p>
                    <p>&#9313;共同利用者の範囲は、当グループの各社となります。</p>
                    <p>&#9314;共同利用の目的は、『4.利用目的』と同じです。</p>
                    <p>&#9315;共同利用における管理責任者は、クロスフェイスホールディングス株式会社となります。具体的なお問い合わせにつきましては、『8.窓口』をご参照ください。</p>
                    </li>
                    <li>当グループは、お客様がサービス提供者に対し商品の予約・購入、プレ ゼントなどの応募、その他の取引を申し込まれた場合、その取引に必要な範囲で、お客様の個人データをサービス提供者に提供します。このように提供された個人データにつきましては、サービス提供者において管理されることとなります。サービス提供者は、その取引を遂行することに加え、取引後のお客様向けメールマガジンなどによる情報提供、お客様による購買の分析をして、サービス提供者の事業運営の改善をするために、個人データ（お客様が指定された他の方の宛先 情報を除く）を利用します。当グループは、サービス提供者に対し、個人情報保護法を遵守し、お客様のプライバシーに配慮した個人情報の取り扱いをすること を規約などで義務づけております。しかしながら、サービス提供者がこれを遵守することを保証するものではありません。詳細につきましては、サービス提供者にお問い合わせください。
                    <p>&#9312;当グループからサービス提供者に提供される個人データの項目は、『3.個人情報の収集について』と同じです。 </p>
                    <p>&#9313;提供手段・方法としては、当グループの管理するシステム、CD-ROMなどの電子媒体、紙などのアナログ媒体などとなります。</p>
                    <p>&#9314;サービス提供者への提供停止を求められる場合、『7. 保有個人データの確認等について』の手続きをお取りください。                    </p>
                    </li>
                </ol>
                
                <h3 class="pp_title">6. データ内容の正確性・安全性</h3>
                <ol class="pp_text">
                    <li>当グループは、お客様の個人データの正確性、最新性を確保するため、お客様にご協力をお願いする場合があります。</li>
                    <li>当グループは、セキュリティ確保のため、クレジットカード番号などの重要な情報の入力時には、これらの情報が傍受、妨害または改ざんされることを防ぐ目的でSSL（Secure Sockets Layer）技術を使用します。</li>
                </ol>
                
                <h3 class="pp_title">7. 保有個人データの確認等</h3>
                <ol class="pp_text">
                    <li>お客様の保有個人データの確認、訂正、削除等は、弊社のWebサイトからアクセス、もしくはメールにてのご連絡にて行うことできます。なお、ユーザID、パスワードを忘れてしまった場合は、弊社窓口へ直接お問い合わせをお願いいたします。</li>
                    <li>ユーザID、パスワードを忘れてしまった<br>
                    <p>&#9312;削除の手続きにつきましては、保有個人データの性質上、削除対応できないことがあります。この場合、当グループは、利用停止およびサービス提供者への提供停止をすることで対応いたします。 </p>
                    <p>&#9313;お客様が利用停止またはサービス提供者への提供停止の手続きをされたときは、サービスの全部または一部の利用ができなくなる場合があります。 </p>
                    <p>&#9314;当グループは、コンピュータの故障その他不可抗力または人的ミスによるデータ消失に備えてバックアップデータを保管することがあります。このバックアップデータは、その性質上、確認等の手続きを行うことができません。</p>
                    <p>&#9315;お客様が当グループのサービスをご利用された場合、この『7.保有個人データの確認等』についてご同意いただいたものとして取り扱わせていただきます。</p>
                    </li>
                </ol>
                
                <h3 class="pp_title">8. 窓口</h3>
                <p class="pp_text">個人情報の取り扱いに関し、ご不明な点がございましたら、弊社へ電話、もしくは、メールにてご連絡をお願いいたします。</p>
                <p class="pp_text"><strong>froosh輸入総代理店</strong><br>
                クロスフェイスホールディングス株式会社 </p>
                <p class="pp_text"><strong>電話番号</strong><br>
                0120-984-266</p>
                <p class="pp_text"><strong>メール</strong><br>
                    froosh_info@xrossface.com</p>
                
                <h3 class="pp_title">9. その他</h3>
                <p class="pp_text">個人情報保護法の規定により、上記と異なる扱いをする場合があります。</p>
                
                <p class="right mt10">2015年1月5日改定</p>
            </div>
        </div>
        <!-- / .box -->
        <!-- end : 個人情報の取り扱い -->

        <!-- start : 活動履歴 -->
        <div class="box pb0">
            <div class="tgl_btn_d_open">
                <h2 class="tgl_text">活動履歴</h2>
            </div>
            <div class="tgl_cont_d_open mt10" id="userstatus">
                <!--<dl class="history new">
                    <dt>2015/02/01</dt>
                    <dd>コンプリートしました！コンプリートしました！</dd>
                </dl>
                <dl class="history">
                    <dt>2015/02/01</dt>
                    <dd>コンプリートしました！</dd>
                </dl>
                <dl class="history">
                    <dt>2015/02/01</dt>
                    <dd>コンプリートしました！</dd>
                </dl>-->
            </div>
        </div>
        <!-- / .box -->
        <!-- end : 活動履歴 -->

<center><a href="<?php echo site_url('/home/success/'); ?>" ><img style="padding-top:50px;display:none" src="<?php echo base_url(); ?>assets/images/button.png" id="sucbut"/></a></center>
<!--<div id="userstatus" name="userstatus"  style="padding-top:600px;"></div>-->	   
	
    <!-- end : main -->
    
    <!-- start : footer -->
    <div id="footer">
        <address>XrossFace Holdings Co., LTD.</address>
    </div>
    <!-- end : footer -->
	</div>
	</div>

</div>
<!-- / .wrapper -->




</body>
</html>


