<!DOCTYPE html>
<html class="no-js">
    
    <head>
<meta charset="utf-8" />
        <title>Froosh</title>
        <!-- Bootstrap -->
    
        <link href="<?php echo $this->config->item('base_url'); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo $this->config->item('base_url'); ?>assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo $this->config->item('base_url'); ?>assets/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="<?php echo $this->config->item('base_url'); ?>assets/css/styles.css" rel="stylesheet" media="screen">
		
		
		
		<!--<link href="<?php //echo $this->config->item('base_url'); ?>assets/image_crud/css/fineuploader.css" rel="stylesheet" media="screen">
		<link href="<?php //echo $this->config->item('base_url'); ?>assets/image_crud/css/photogallery.css" rel="stylesheet" media="screen">
		<link href="<?php //echo $this->config->item('base_url'); ?>assets/image_crud/css/colorbox.css" rel="stylesheet" media="screen">
		<link href="<?php //echo $this->config->item('base_url'); ?>assets/css/smartpaginator.css" rel="stylesheet" media="screen">
         HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="<?php echo $this->config->item('base_url'); ?>assets/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
         <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		 
		 
		 <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		 <script src="<?php //echo $this->config->item('base_url'); ?>assets/image_crud/js/jquery-ui-1.9.0.custom.min.js"></script>
		 <script src="<?php //echo $this->config->item('base_url'); ?>assets/image_crud/js/jquery.fineuploader-3.5.0.min.js"></script>
		 <script src="<?php //echo $this->config->item('base_url'); ?>assets/image_crud/js/jquery.colorbox-min.js"></script>
		 <script src="<?php //echo $this->config->item('base_url'); ?>assets/smartpaginator.js"></script> -->
	
		 
		
		
    <?php foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>
    <?php foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
    
    
    </head>
    
    <body>
        <div class="container-fluid">
            <div class="row-fluid">