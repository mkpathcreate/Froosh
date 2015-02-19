<?php error_reporting(0) ?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Froosh</title>

    
        <link href="<?php echo $this->config->item('base_url'); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo $this->config->item('base_url'); ?>assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo $this->config->item('base_url'); ?>assets/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="<?php echo $this->config->item('base_url'); ?>assets/css/styles.css" rel="stylesheet" media="screen">

        <script src="<?php echo $this->config->item('base_url'); ?>assets/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<style type="text/css">
       p{margin:0 0 10px;color:red;}
</style>
    </head>
  <body id="login">
    <div class="container">
      <div class="form-signin">
          <?php echo form_open('login'); ?>
        <h3 class="form-signin-heading">Froosh Admin</h3>
        <p class="err"> <span> <?php echo validation_errors(); ?></span></p>
        <input type="text" class="input-block-level" name="emailid" placeholder="Email address">
        <input type="password" class="input-block-level" name="password" placeholder="Password">    
          <button class="btn btn-large btn-primary" type="submit">Sign in</button>    
      </form>
      </div>
    </div> 
 <?php $this->load->view('includes/footer'); ?>