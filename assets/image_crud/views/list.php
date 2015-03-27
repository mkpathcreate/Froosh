<!--<div id="freshtilledsoil_embed_widget" class="video-chat-widget"></div>
<script id="fts" src="http://freshtilledsoil.com/embed/webrtc-v5.js?r=FTS0316-CZ6NqG97"></script> -->
<title>Froosh</title>
<?php 
$ci =& get_instance();

//$page=$ci->load->view('includes/header2',$t,TRUE); 
//$page=$ci->load->view('includes/header2',$t,TRUE);
//$string = $ci->load->view('includes/left_menu', '', true); 

//if(strcmp($x,'favourite')!=0){
if(!$ci->load->is_loaded('includes/left_menu')){
$ci->load->view('includes/top_nav'); 
		$ci->load->view('includes/left_menu');  
}
else
{


}


	$this->set_css('assets/bootstrap/css/bootstrap.min.css');
	$this->set_css('assets/bootstrap/css/bootstrap-responsive.min.css');
	$this->set_css('assets/vendors/easypiechart/jquery.easy-pie-chart.css');
	$this->set_css('assets/css/styles.css');
	$this->set_css('assets/image_crud/css/fineuploader.css');
	$this->set_css('assets/image_crud/css/photogallery.css');
	$this->set_css('assets/image_crud/css/colorbox.css');
	$this->set_css('assets/css/smartpaginator.css');

	
	//$this->set_js('assets/image_crud/js/jquery-1.8.2.min.js');
	$this->set_js('assets/image_crud/js/jquery-1.8.2.min.js');
	$this->set_js('assets/image_crud/js/jquery-ui-1.9.0.custom.min.js');

	//$this->set_js('assets/image_crud/js/jquery.fineuploader-3.5.0.min.js');

	$this->set_js('assets/image_crud/js/jquery.colorbox-min.js');
	$this->set_js('assets/smartpaginator.js');
	
	$this->set_js('assets/bootstrap/js/bootstrap.min.js');
	

	
	
?>
<script>
$(function(){
fdata="";
 $('.dropdown-toggle').dropdown();
	<?php if ( ! $unset_upload) {?>
	//	createUploader();
	<?php }?>
		loadColorbox();
		
		$('#green2').smartpaginator({ totalrecords: <?php echo count($photos);?>,
                                      recordsperpage: 20, 
                                      datacontainer: 'paginator', 
                                      dataelement: 'li',
                                      theme: 'green',
									  });
		
		/*$('#imid').each(function() 
		{
		console.log($('#imid').length);
		$(this).remove();
		});*/
		
		$('#fav').on('click',function(){
		fdata="";
		if($('input:checkbox:checked').length>0)
		{
		$('input:checkbox:checked').each(function() 
		{
		
		if(fdata=="")
		fdata+=$(this).val();
		else
		fdata+=","+$(this).val();
		});
		fdata="flist="+fdata;
		$.ajax({
		url: "<?php echo base_url()?>index.php/home/favourite",
		cache: false,
		data:fdata,
		type: "POST",
		success: function(data){
			alert("Successfully Added");
			$("input:checkbox").prop('checked',false);
			//loadColorbox();
		}
		});
		}
		else
		alert("Please Select the Image");
		});
		
});
function loadColorbox()
{
	$('.color-box').colorbox({
		rel: 'color-box'
	});
}
function loadPhotoGallery(){
	$.ajax({
		url: '<?php echo $ajax_list_url?>',
		cache: false,
		dataType: 'text',
		beforeSend: function()
		{
			$('.file-upload-messages-container:first').show();
			$('.file-upload-message').html("<?php echo $this->l('loading');?>");
		},
		complete: function()
		{
			$('.file-upload-messages-container').hide();
			$('.file-upload-message').html('');
		},
		success: function(data){
			$('#ajax-list').html(data);
			loadColorbox();
		}
	});
}

/*function createUploader() {
	var uploader = new qq.FineUploader({
		element: document.getElementById('fine-uploader'),
		request: {
			 endpoint: '<?php echo $upload_url?>'
		},
		validation: {
			 allowedExtensions: ['jpeg', 'jpg', 'png', 'gif']
		},
		callbacks: {
			 onComplete: function(id, fileName, responseJSON) {
				 loadPhotoGallery();
			 }
		},
		debug: true,
		/*template: '<div class="qq-uploader">' +
			'<div class="qq-upload-drop-area"><span><?php echo $this->l("upload-drop-area");?></span></div>' +
			'<div class="qq-upload-button"><?php echo $this->l("upload_button");?></div>' +
			'<ul class="qq-upload-list"></ul>' +
			'</div>',
		fileTemplate: '<li>' +
			'<span class="qq-upload-file"></span>' +
			'<span class="qq-upload-spinner"></span>' +
			'<span class="qq-upload-size"></span>' +
			'<a class="qq-upload-cancel" href="#"><?php echo $this->l("upload-cancel");?></a>' +
			'<span class="qq-upload-failed-text"><?php echo $this->l("upload-failed");?></span>' +
			'</li>',
*/
/*	});
}*/

function saveTitle(data_id, data_title)
{
	  	$.ajax({
			url: '<?php echo $insert_title_url; ?>',
			type: 'post',
			data: {primary_key: data_id, value: data_title},
			beforeSend: function()
			{
				$('.file-upload-messages-container:first').show();
				$('.file-upload-message').html("<?php echo $this->l('saving_title');?>");
			},
			complete: function()
			{
				$('.file-upload-messages-container').hide();
				$('.file-upload-message').html('');
			}
			});
}

//window.onload = createUploader;

</script>
<div class="span9" style="width:800px;padding-left:70px;padding-top:35px" id="content">

<?php
  

 if(!$unset_upload){ ?> <div id="file-uploader-demo1" class="floatL upload-button-container"></div>
<div class="file-upload-messages-container hidden">
	<div class="message-loading"></div>
	<div class="file-upload-message"></div>
	<div class="clear"></div>
</div>
<div id="fine-uploader"></div>
<?php }?>
<div class="clear"></div>
<div id='ajax-list'> 
	<?php if(!empty($photos)){?>
	<script type='text/javascript'>
		$(function(){
			$('.delete-anchor').click(function(){
				if(confirm('<?php echo $this->l("alert_delete");?>'))
				{
					$.ajax({
						url:$(this).attr('href'),
						beforeSend: function()
						{
							$('.file-upload-messages-container:first').show();
							$('.file-upload-message').html("<?php echo $this->l('deleting');?>");
						},
						success: function(){
							loadPhotoGallery();
						}
					});
				}
				return false;
			});
			$(".color-box img").mousedown(function(){
				return false;
			});
    		$(".photos-crud").sortable({
        		handle: '.move-box',
        		opacity: 0.6,
        		cursor: 'move',
        		revert: true,
        		update: function() {
    				var order = $(this).sortable("serialize");
	    				$.post("<?php echo $ordering_url?>", order, function(theResponse){});
    			}
    		});
    		$('.ic-title-field').keyup(function(e) {
    			if(e.keyCode == 13) {
					var data_id = $(this).attr('data-id');
					var data_title = $(this).val();

					saveTitle(data_id, data_title);
    			}
    		});

    		$('.ic-title-field').bind({
    			  click: function() {
    				$(this).css('resize','both');
    			    $(this).css('overflow','auto');
    			    $(this).animate({height:80},600);
    			  },
    			  blur: function() {
      			    $(this).css('resize','none');
      			  	$(this).css('overflow','hidden');
      			  	$(this).animate({height:20},600);

					var data_id = $(this).attr('data-id');
					var data_title = $(this).val();

					saveTitle(data_id, data_title);
    			  }
    		});
		});
	</script>
	
	<!-- <div class="span9" >  -->
	
	<?php if(!$ci->load->is_loaded('includes/left_menu')){ ?>
                    <div class="row-fluid">
                        
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="<?php echo base_url();?>froosh">Dashboard</a> <span class="divider">-</span>	
	                                    </li>
	                                    <li>
	                                        <a href="#"></a> 
	                                    </li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
						<?php } ?>
	<ul class='photos-crud' id="paginator">
	<?php 
	//echo count($photos);
	
	
	//$ci->uri->rsegments[2]
	foreach($photos as $photo_num => $photo){?>
			<li id="photos_<?php echo $photo->$primary_key; ?>">
				<div class='photo-box'>
					<a href='<?php echo $photo->image_url?>' <?php if (isset($photo->title)) {echo 'title="'.str_replace('"',"&quot;",$photo->title).'" ';}?>target='_blank' class="color-box" rel="color-box" tabindex="-1"><img src='<?php echo $photo->thumbnail_url ?>' class='basic-image' /></a>
					<?php if($title_field !== null){ ?>
					<textarea class="ic-title-field" data-id="<?php echo $photo->$primary_key; ?>" autocomplete="off" ><?php echo $photo->$title_field; ?></textarea>
					<div class="clear"></div><?php }?>
					<?php if($has_priority_field){?><div class="move-box"></div><?php }?>
					<?php if(!$unset_delete){?><div class='delete-box'>
						<a href='<?php echo $photo->delete_url;?>' class='delete-anchor' tabindex="-1"><?php echo $this->l('list_delete');?></a>
						
					</div><?php }?><div class='delete-box'>
					<?php if(strcmp($ci->uri->rsegments[2],'favourite')!=0) {?>
					<!--<input type=checkbox name="imid" id="imid" value=<?php //echo $photo->$primary_key; ?>> <?php } ?> -->
					&nbsp;&nbsp;&nbsp;<?php echo $photo->uname."(".$photo->uid.")"."<br>".$photo->flv."<br>".$photo->uda; ?>
					</div>
					
					<div class="clear"></div>
				</div>
			</li>
	<?php }?>
		</ul>
		<div class='clear'></div>
	<?php }?>
	</div>
	<!-- style="margin-left:595px"  margin-left:1125px -->
	<div id="green2" class="pager green" style="margin-left:155px"></div><br>
	<?php if(strcmp($ci->uri->rsegments[2],'favourite')!=0) {?>
	<!--<input id="fav" name="fav" type=button value="Add favourite" style="margin-left:685px">-->
	<?php  } ?>
	
</div>
</div>
  <?php $ci->load->view('includes/footer'); ?>