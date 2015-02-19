        <?php $this->load->view('includes/header'); ?>
        <?php $this->load->view('includes/top_nav'); ?>
        <?php $this->load->view('includes/left_menu'); ?>
                

                <br>
                <div class="span9" id="content">
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

                    <?php echo $output; ?>
         <?php $this->load->view('includes/footer'); ?>