<?php 
defined('_JEXEC') or die;
?>
<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<jdoc:include type="head" />
			<!-- Load Single CSS File // Compiled With Crunch -->
			<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/load.css">
			<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
			<!--[if lt IE 9]>
				<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
				<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
			<![endif]-->
		</head>
		<body>
        		<jdoc:include type="modules" name="topmenu" />
				<div id="outer-wrap">
                    <jdoc:include type="message" />
					<jdoc:include type="component" />
                    <jdoc:include type="modules" name="footer" />
				</div> 
			<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
			<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
            <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/lightbox.min.js"></script>
<script>    
			$(function() {
		
		// get footer height
		var ftHeight = $('#footer').height();
		
		// add dynamic height to #footer_space
		$('#footer_space').css("height", ftHeight);
		
	});	
				$('.home-carousel').carousel({
  					interval: 3500
				})
				$(document).ready(function(){
					$('#home-carousel').on('slid.bs.carousel', function () {
						$holder = $( "ol li.active" );
						$holder.removeClass('active');
						var idx = $('div.active').index('div.item');
						$('ol.home-carousel-indicators li[data-slide-to="'+ idx+'"]').addClass('active');
					});
					$('ol.carousel-indicators  li').on("click",function(){ 
						$('ol.home-carousel-indicators li.active').removeClass("active");
						$(this).addClass("active");
					});
				});
			</script>
		</body>
</html>