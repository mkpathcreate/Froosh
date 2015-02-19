<?php
	$this->set_css($this->default_theme_path.'/flexigrid/css/flexigrid.css');
	$this->set_js_lib($this->default_javascript_path.'/'.grocery_CRUD::JQUERY);

	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.noty.js');
	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/config/jquery.noty.config.js');
	$this->set_js_lib($this->default_javascript_path.'/common/lazyload-min.js');

	if (!$this->is_IE7()) {
		$this->set_js_lib($this->default_javascript_path.'/common/list.js');
	}

	$this->set_js($this->default_theme_path.'/flexigrid/js/cookies.js');
	$this->set_js($this->default_theme_path.'/flexigrid/js/flexigrid.js');
	$this->set_js($this->default_theme_path.'/flexigrid/js/jquery.form.js');
	$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.numeric.min.js');
	$this->set_js($this->default_theme_path.'/flexigrid/js/jquery.printElement.min.js');

	/** Fancybox */
	$this->set_css($this->default_css_path.'/jquery_plugins/fancybox/jquery.fancybox.css');
	$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.fancybox-1.3.4.js');
	$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.easing-1.3.pack.js');

	/** Jquery UI */
	$this->load_js_jqueryui();

?>
<script type='text/javascript'>
var base_url = '<?php echo base_url();?>';

	var subject = '<?php echo $subject?>';
	var ajax_list_info_url = '<?php echo $ajax_list_info_url; ?>';
        var ajax_list='<?php echo $ajax_list_url?>';
	var unique_hash = '<?php echo $unique_hash; ?>';

	var message_alert_delete = "<?php echo $this->l('alert_delete'); ?>";
$(function() {
$('#quickSearchBox').show();


/*$('.filtering_form2').submit(function(){
$(this).ajaxSubmit({
url: ajax_list,
	
 
dataType: 'json',
 success:    function(data){

}

});

});*/

$("#clear").click(function(){
$('#search_text1').val('');
$('#search_text2').val('0');
$('#search_text3').val('0');
$('#search_text4').val('0');
$('#search_text5').val('');
$('#search_text6').val('0');
location.reload();
//$('.filtering_form').trigger('submit');

});

$('#search_text').focus(function() {
      $(this).val('');
      });



});

	
</script>


<div id='list-report-error' class='report-div error'></div>
<div id='list-report-success' class='report-div success report-list' <?php if($success_message !== null){?>style="display:block"<?php }?>><?php
if($success_message !== null){?>
	<p><?php echo $success_message; ?></p>
<?php }
?></div>
<!-            Regular Content                 -->
<div class="flexigrid" style='width: 100%;' data-unique-hash="<?php echo $unique_hash; ?>">
	<div id="hidden-operations" class="hidden-operations"></div>
	<div class="mDiv">
		<div class="ftitle">
			&nbsp;
		</div>
		<div title="<?php echo $this->l('minimize_maximize');?>" class="ptogtitle">
			<span></span>
		</div>
	</div>
	<div id='main-table-box' class="main-table-box">

	<?php if(!$unset_add || !$unset_export || !$unset_print){?>
	<div class="tDiv">
		<?php if(!$unset_add){?>
		<div class="tDiv2">
        	<a href='<?php echo $add_url?>' title='<?php echo $this->l('list_add'); ?> <?php echo $subject?>' class='add-anchor add_button'>
			<div class="fbutton">
				<div>
					<span class="add"><?php echo $this->l('list_add'); ?> <?php echo $subject?></span>
				</div>
			</div>
            </a>
			<div class="btnseparator">
			</div>
		</div>
		<?php }?>
		<div class="tDiv3">
			<?php if(!$unset_export) { ?>
        	<a class="export-anchor" data-url="<?php echo base_url();?>down"> 
		
				<div class="fbutton">
					<div>
						<span class="export"><?php echo $this->l('list_export');?></span>
					</div>
				</div>
            </a>
			<div class="btnseparator"></div>
			<?php } ?>
			<?php if(!$unset_print) { ?>
        	<a class="print-anchor" data-url="<?php echo $print_url; ?>">
				<div class="fbutton">
					<div>
						<span class="print"><?php echo $this->l('list_print');?></span>
					</div>
				</div>
            </a>
			<div class="btnseparator"></div>
			<?php }?>
		</div>
		<div class='clear'></div>
	</div>
	<?php }?>
<?php echo form_open( $ajax_list_url, 'method="post" id="filtering_form" class="filtering_form" autocomplete = "off" data-ajax-list-info-url="'.$ajax_list_info_url.'"'); ?>

	<div class="sDiv quickSearchBox" id='quickSearchBox'>
		<!--<div class="sDiv2">
			<?php echo $this->l('list_search');?>: <input type="text" class="qsbsearch_fieldox search_text" name="search_text" size="30" id='search_text'>
			<select name="search_field" id="search_field">
				<option value=""><?php echo $this->l('list_search_all');?></option>
				<?php foreach($columns as $column){?>
				<option value="<?php echo $column->field_name?>"><?php echo $column->display_as?>&nbsp;&nbsp;</option>
				<?php }?>
			</select>
            <input type="button" value="<?php echo $this->l('list_search');?>" class="crud_search" id='crud_search'>
		</div> -->


<div class="sDiv2">
<input type="text" name="search_field[]" id="search_field" readonly value="Name">
  <!-- <select name="search_field[]" id="search_field">
	<option value=""><?php echo $this->l('list_search_all');?></option>
	<?php foreach($columns as $column){?>
	<option value="<?php echo $column->field_name?>"><?php echo $column->display_as?>&nbsp;&nbsp;</option>
	<?php }?>
   </select> -->
   <!--<select name="search_type[]" id="search_type">
	<option value="">like</option>
	<option value="=">=</option>
	<option value="&lt;&gt;">&lt;&gt;</option>
	<option value="&lt;=">&lt;=</option>
	<option value="&lt;">&lt;</option>
	<option value="&gt;=">&gt;=</option>
	<option value="&gt;">&gt;</option>
	<option value="&lt;=&gt;">&lt;=&gt;</option>
   </select>-->
   <input type="text" class="qsbsearch_fieldox" name="search_text[]" size="30" id='search_text1'>

<!--<select name="search_field[]" id="search_field">
	 <option value=""><?php echo $this->l('list_search_all');?></option>
	 <?php foreach($columns as $column){?>
	 <option value="<?php echo $column->field_name?>"><?php echo $column->display_as?>&nbsp;&nbsp;</option>
	 <?php }?>
	</select> -->
<input type="text" name="search_field[]" id="search_field" readonly value="Media">
  <!--   <select name="search_field[]" id="search_field">
	 <option value=""><?php echo $this->l('list_search_all');?></option>
	 <?php foreach($columns as $column){?>
	 <option value="<?php echo $column->field_name?>"><?php echo $column->display_as?>&nbsp;&nbsp;</option>
	 <?php }?>
	</select>
 <select name="search_type[]" id="search_type">
	<option value="">like</option>
	<option value="=">=</option>
	<option value="&lt;&gt;">&lt;&gt;</option>
	<option value="&lt;=">&lt;=</option>
	<option value="&lt;">&lt;</option>
	<option value="&gt;=">&gt;=</option>
	<option value="&gt;">&gt;</option>
	<option value="&lt;=&gt;">&lt;=&gt;</option>
   </select>
   <input type="text" class="qsbsearch_fieldox" name="search_text[]" size="30" id='search_text'>-->
	<select name="search_text[]" id='search_text3'>
	<option value="0">All</option>
	<option value="PC">PC</option>
	<option value="Mobile">Mobile</option>
	  </select><br>
<input type="text" name="search_field[]" id="search_field" readonly value="Gender">
  <!-- <select name="search_type[]" id="search_type">
	<option value="">like</option>
	<option value="=">=</option>
	<option value="&lt;&gt;">&lt;&gt;</option>
	<option value="&lt;=">&lt;=</option>
	<option value="&lt;">&lt;</option>
	<option value="&gt;=">&gt;=</option>
	<option value="&gt;">&gt;</option>
	<option value="&lt;=&gt;">&lt;=&gt;</option>
   </select>
   <input type="text" class="qsbsearch_fieldox" name="search_text[]" size="30" id='search_text'>-->
	<select name="search_text[]" id='search_text2'>
	<option value="0">Select</option>
	<option value="マレ">マレ</option>
	<option value="女性">女性</option>
	  </select>
<input type="text" name="search_field[]" id="search_field" readonly value="Level">
<!-- <input type="text" class="qsbsearch_fieldox" name="search_text[]" size="30" id='search_text5'> -->
<select name="search_text[]" id='search_text5'>
 <option value="0" selected>Select</option>
 <option value="1" >1</option>
 <option value="2" >2</option>
 <option value="3" >3</option>
 <option value="4" >4</option>
 <option value="5" >5</option>
 <option value="6" >6</option>
 <option value="7" >7</option>
 <option value="8" >8</option>
 <option value="9" >9</option>
 <option value="10" >10</option>
 <option value="11" >11</option>
 <option value="12" >12</option>
 <option value="13" >13</option>
 <option value="14" >14</option>
 <option value="15" >15</option>
 <option value="16" >16</option>
 <option value="17" >17</option>
 <option value="18" >18</option>
 <option value="19" >19</option>
 <option value="20" >20</option>
 <option value="21" >21</option>
 <option value="22" >22</option>
 <option value="23" >23</option>
 <option value="24" >24</option>
 <option value="25" >25</option>
</select>
<br> 
 <input type="text" name="search_field[]" id="search_field" readonly value="Prefecture">
<select name="search_text[]" id='search_text4'>
	 <option value="0" selected>選択してください</option>
    <option value="北海道" >北海道</option>
	<option value="青森県" >青森県</option>
	<option value="岩手県" >岩手県</option>
	<option value="宮城県" >宮城県</option>
	<option value="秋田県" >秋田県</option>
	<option value="山形県" >山形県</option>
	<option value="福島県" >福島県</option>
	<option value="茨城県" >茨城県</option>
	<option value="栃木県" >栃木県</option>
	<option value="群馬県" >群馬県</option>
	<option value="埼玉県" >埼玉県</option>
	<option value="千葉県" >千葉県</option>
	<option value="東京都" >東京都</option>
	<option value="神奈川県" >神奈川県</option>
	<option value="新潟県" >新潟県</option>
	<option value="富山県" >富山県</option>
	<option value="石川県" >石川県</option>
	<option value="福井県" >福井県</option>
	<option value="山梨県" >山梨県</option>
	<option value="長野県" >長野県</option>
	<option value="岐阜県" >岐阜県</option>
	<option value="静岡県" >静岡県</option>
	<option value="愛知県" >愛知県</option>
	<option value="三重県" >三重県</option>
	<option value="滋賀県" >滋賀県</option>
	<option value="京都府" >京都府</option>
	<option value="大阪府" >大阪府</option>
	<option value="兵庫県" >兵庫県</option>
	<option value="奈良県" >奈良県</option>
	<option value="和歌山県" >和歌山県</option>
	<option value="鳥取県" >鳥取県</option>
	<option value="島根県" >島根県</option>
	<option value="岡山県" >岡山県</option>
	<option value="広島県" >広島県</option>
	<option value="山口県" >山口県</option>
	<option value="徳島県" >徳島県</option>
	<option value="香川県" >香川県</option>
	<option value="愛媛県" >愛媛県</option>
	<option value="高知県" >高知県</option>
	<option value="福岡県" >福岡県</option>
	<option value="佐賀県" >佐賀県</option>
	<option value="長崎県" >長崎県</option>
	<option value="熊本県" >熊本県</option>
	<option value="大分県" >大分県</option>
	<option value="宮崎県" >宮崎県</option>
	<option value="鹿児島県" >鹿児島県</option>
	<option value="沖縄県" >沖縄県</option>      
	  </select>
<input type="text" name="search_field[]" id="search_field" readonly value="Register">
<select name="search_text[]" id='search_text6'>
 <option value="0" selected>Select</option>
 <option value="facebook">Facebook</option>
 <option value="twitter">Twitter</option>
 <option value="instagram">Instagram</option>
  <option value="mail">Mail</option>
</select>
<input type="hidden" class="qsbsearch_fieldox" name="additional" value=1 id='additional'>
 <br />
		 <input type="button" value="<?php echo $this->l('list_search');?>" id='crud_search' class="crud_search">
<!--<div class='search-div-clear-button'> -->
		<input type="button" id="clear" value="Clear">
        	<!--<input type="button" value="<?php echo $this->l('list_clear_filtering');?>" id='search_clear' class="search_clear"> -->
        <!--</div>-->
</div>




        
	</div>


	<div class="pDiv">
		<div class="pDiv2">
			<div class="pGroup">
				<div class="pSearch pButton quickSearchButton" id='quickSearchButton' title="<?php echo $this->l('list_search');?>"> 
				    <div>
					<span></span>
				</div>
			</div> 
			<div class="btnseparator">
			</div>
			<div class="pGroup">
				<select name="per_page" id='per_page' class="per_page">
					<?php foreach($paging_options as $option){?>
						<option value="<?php echo $option; ?>" <?php if($option == $default_per_page){?>selected="selected"<?php }?>><?php echo $option; ?>&nbsp;&nbsp;</option>
					<?php }?>
				</select>
				<input type='hidden' name='order_by[0]' id='hidden-sorting' class='hidden-sorting' value='<?php if(!empty($order_by[0])){?><?php echo $order_by[0]?><?php }?>' />
				<input type='hidden' name='order_by[1]' id='hidden-ordering' class='hidden-ordering'  value='<?php if(!empty($order_by[1])){?><?php echo $order_by[1]?><?php }?>'/>
			</div>
			<div class="btnseparator">
			</div>
			<div class="pGroup">
				<div class="pFirst pButton first-button">
					<span></span>
				</div>
				<div class="pPrev pButton prev-button">
					<span></span>
				</div>
			</div>
			<div class="btnseparator">
			</div>
			<div class="pGroup">
				<span class="pcontrol"><?php echo $this->l('list_page'); ?> <input name='page' type="text" value="1" size="4" id='crud_page' class="crud_page">
				<?php echo $this->l('list_paging_of'); ?>
				<span id='last-page-number' class="last-page-number"><?php echo ceil($total_results / $default_per_page)?></span></span>
			</div>
			<div class="btnseparator">
			</div>
			<div class="pGroup">
				<div class="pNext pButton next-button" >
					<span></span>
				</div>
				<div class="pLast pButton last-button">
					<span></span>
				</div>
			</div>
			<div class="btnseparator">
			</div>
			<div class="pGroup">
				<div class="pReload pButton ajax_refresh_and_loading" id='ajax_refresh_and_loading'>
					<span></span>
				</div>
			</div>
			<div class="btnseparator">
			</div>
			<div class="pGroup">
				<span class="pPageStat">
					<?php $paging_starts_from = "<span id='page-starts-from' class='page-starts-from'>1</span>"; ?>
					<?php $paging_ends_to = "<span id='page-ends-to' class='page-ends-to'>". ($total_results < $default_per_page ? $total_results : $default_per_page) ."</span>"; ?>
					<?php $paging_total_results = "<span id='total_items' class='total_items'>$total_results</span>"?>
					<?php echo str_replace( array('{start}','{end}','{results}'),
											array($paging_starts_from, $paging_ends_to, $paging_total_results),
											$this->l('list_displaying')
										   ); ?>
				</span>
			</div>
		</div>
		<div style="clear: both;">
		</div>
	</div>
	<?php echo form_close(); ?>
	</div>
	<div id='ajax_list' class="ajax_list">
		<?php echo $list_view?>
	</div>
	
</div>


