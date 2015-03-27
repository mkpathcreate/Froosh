/* ====================== jQuery Script ================================================ */

//toggle (default close)
$(function(){
	$('.tgl_cont').hide();
	$('.tgl_btn').click(function(){
		$(this).next().slideToggle();
		if($(this).hasClass('open')) {
			$(this).removeClass('open');
			$(this).addClass('close');
		} else {
			$(this).addClass('open');
		}
	});
	$('.tgl_btn').css('cursor','pointer');
});

//toggle (default close)
$(function(){
	$('.tgl_cont_d_open').show();
	$('.tgl_btn_d_open').click(function(){
		$(this).next().slideToggle();
		if($(this).hasClass('close')) {
			$(this).removeClass('close');
			//$(this).addClass('close');
		} else {
			$(this).addClass('close');
		}
	});
	$('.tgl_btn').css('cursor','pointer');
});


// block link
$(function(){
	$('.blockLink').click(function() {
	location.href = $(this).find('a').attr('href');
	});
	$('.blockLink').css('cursor','pointer');
});


// block link (new window)
$(function(){
	//$('.blockLink_blank').css('cursor','pointer');
	$('.blockLink_blank').click(function(){
		window.open($(this).find('a').attr('href'), '_blank');
		return false;
	});
	$('.blockLink_blank').css('cursor','pointer');
});





/* ====================== form Guide text ================================================ */

function ShowFormGuide(obj,GuideText) {
  if( obj.value == '' ) {
	 obj.value = GuideText;
	 obj.style.color = '#a7a7a7';
  }
}
function HideFormGuide(obj,GuideText) {
  if( obj.value == GuideText ) {
	 obj.value='';
	 obj.style.color = '#3b201a';
  }
}
