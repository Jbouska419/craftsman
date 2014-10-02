<?php 
defined('_JEXEC') or die;
?>
<!DOCTYPE html>
	<html lang="en">
		<head>
            <?php
			if(file_exists('templates/'.$this->template.'/include/head.php')){
  				require_once('templates/'.$this->template.'/include/head.php');
			}else{
				echo 'Can not find head.php @ templates/'.$this->template.'/include/';
			}
			?>
		</head>
		<body>
			<?php
			if(file_exists('templates/'.$this->template.'/include/body.php')){
  				require_once('templates/'.$this->template.'/include/body.php');
			}else{
				echo 'Can not find body.php @ templates/'.$this->template.'/include/';
			}
			?>
			<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
		</body>
</html>