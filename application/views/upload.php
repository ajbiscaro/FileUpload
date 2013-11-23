<!DOCTYPE HTML>
<!--
/**
 * File Upload View
 * View for uploading file.
 * @File name: upload.php
 * @Version: 1.0 (September 29, 2013)
 * @copyright Copyright (C) Ardel John Biscaro
 * @link http://ajbiscaro.net84.net
 **/
-->

<html lang="en-US">
<head>
	<title>File Upload</title>
	<meta charset="UTF-8">
	<script src=<?php echo base_url()."application/scripts/jquery.js" ?> type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('.deletefile').click(function(e) {
		        e.preventDefault();
		        var id = $(this).parent().attr('id');
		        var parent = $(this).parent();
		        $.ajax({
			       	type: "POST",
	      		 	url: "<?php echo base_url() ?>index.php/upload/deleteFile/"+id,
		            success: function() {
		                parent.slideUp(300,function() {
		                    parent.remove();
							$('.message').remove();
		                });
		            }
		        });
		    });
		});
	</script>
</head>

<body>
	<div>
	
	<?php echo $error;?>
	
	<div class="message"><?php echo $msg;?></div>
	<br />
	
	<?php $attributes = array('id' => 'form'); ?>

	<?php echo form_open_multipart('upload/do_upload',$attributes);?>
	
		<div class="form_item" >
			<input type="file" name="userfile" size="20" />
		</div>
	
		<div>	
			<input type="submit" value="Upload" />
		</div>
		
		<p>Files Uploaded:</p>
	
		<?php foreach($uploads as $upload): ?>
			
			<div id= "<?php echo $upload->file_id ?>" >
				<?php echo anchor('upload/downloadFile/'.$upload->file_id, $upload->filename); ?>
				<?php echo anchor('#','Remove',array('class' => 'deletefile'));?>
			</div>
			
		<?php endforeach; ?>	
	
	<?php echo form_close(); ?>		
	</div>

</body>
</html>
