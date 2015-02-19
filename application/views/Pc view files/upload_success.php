<?php
echo '{"name":"'.$upload_data['file_name'].'","type":"'.$upload_data['file_type'].'","size":"'.$upload_data['file_size'].'"}';
?>
<br/><br/><br/>
<a href= "<?php echo base_url().'uploads/' .$upload_data['file_name'] ?>" ><img style="float:left; padding: 20px;" width="80" src="<?php echo base_url().'uploads/' .$upload_data['file_name'] ?>"/></a><?php echo '<br/>name: ' .$upload_data['file_name'] .'<br/>size: ' .$upload_data['file_size'] .' k' ?>
