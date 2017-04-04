<?php 
	/*
		Template Name: Lookbook
	*/

	$arrows = types_render_field("arrows-slider", array("output"=>"raw"));
	$progress = types_render_field("progressbar-slider", array("output"=>"raw"));
	$navigation = types_render_field("navigations-slider", array("output"=>"raw"));

	$args = array( 'post_type' => 'lookbook-images', 'posts_per_page'=>-1);
    $loop = new WP_Query( $args );

    $arr_images = array();

    while ( $loop->have_posts() ) : $loop->the_post();

    	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

        $imagem = types_render_field("imagem-lookbook", array("output"=>"raw"));
        $thumb = $url;

        array_push($arr_images, array('image'=>$imagem, 'title'=>'', 'thumb'=>$thumb));

    endwhile;

    

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<!--
		Supersized - Fullscreen Slideshow jQuery Plugin
		Version : 3.2.7
		Site	: www.buildinternet.com/project/supersized
		
		Author	: Sam Dunn
		Company : One Mighty Roar (www.onemightyroar.com)
		License : MIT License / GPL License
	-->

	<head>

		<title>Coleção Primavera Verão 2015 - By Tilly Baby</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		
		<link rel="stylesheet" href="<?php echo get_bloginfo("template_url") ?>/assets/css/lookbook/supersized.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo get_bloginfo("template_url") ?>/assets/css/lookbook/supersized.shutter.css" type="text/css" media="screen" />
		
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo get_bloginfo("template_url") ?>/assets/js/lookbook/jquery.easing.min.js"></script>
		
		<script type="text/javascript" src="<?php echo get_bloginfo("template_url") ?>/assets/js/lookbook/supersized.3.2.7.min.js"></script>
		<script type="text/javascript" src="<?php echo get_bloginfo("template_url") ?>/assets/js/lookbook/supersized.shutter.min.js"></script>
		
		<script type="text/javascript">

			var slider_wp = <?php echo json_encode($arr_images); ?>
			
			jQuery(function($){
				
				$.supersized({
				
					// Functionality
					slideshow               :   1,			// Slideshow on/off
					autoplay				:	1,			// Slideshow starts playing automatically
					start_slide             :   1,			// Start slide (0 is random)
					stop_loop				:	0,			// Pauses slideshow on last slide
					random					: 	0,			// Randomize slide order (Ignores start slide)
					slide_interval          :   8000,		// Length between transitions
					transition              :   6, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	1000,		// Speed of transition
					new_window				:	0,			// Image links open in new window/tab
					pause_hover             :   0,			// Pause slideshow on hover
					keyboard_nav            :   1,			// Keyboard navigation on/off
					performance				:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
					image_protect			:	1,			// Disables image dragging and right click with Javascript
															   
					// Size & Position						   
					min_width		        :   0,			// Min width allowed (in pixels)
					min_height		        :   0,			// Min height allowed (in pixels)
					vertical_center         :   1,			// Vertically center background
					horizontal_center       :   1,			// Horizontally center background
					fit_always				:	1,			// Image will never exceed browser width or height (Ignores min. dimensions)
					fit_portrait         	:   1,			// Portrait images will not exceed browser height
					fit_landscape			:   0,			// Landscape images will not exceed browser width
															   
					// Components							
					slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					thumb_links				:	1,			// Individual thumb links for each slide
					thumbnail_navigation    :   0,			// Thumbnail navigation
					/*slides 					:  	[			// Slideshow Images
														{image : 'img/01.jpg', title : '', thumb : 'img/01_thumb.jpg', url : ''},
														{image : 'img/02.jpg', title : '', thumb : 'img/02_thumb.jpg', url : ''},
														{image : 'img/03.jpg', title : '', thumb : 'img/03_thumb.jpg', url : ''}, 
														{image : 'img/04.jpg', title : '', thumb : 'img/04_thumb.jpg', url : ''}, 
														{image : 'img/05.jpg', title : '', thumb : 'img/05_thumb.jpg', url : ''}, 
														{image : 'img/06.jpg', title : '', thumb : 'img/06_thumb.jpg', url : ''}, 
														{image : 'img/07.jpg', title : '', thumb : 'img/07_thumb.jpg', url : ''}, 
														{image : 'img/08.jpg', title : '', thumb : 'img/08_thumb.jpg', url : ''}, 
														{image : 'img/09.jpg', title : '', thumb : 'img/09_thumb.jpg', url : ''}, 
														{image : 'img/10.jpg', title : '', thumb : 'img/10_thumb.jpg', url : ''}, 
														{image : 'img/11.jpg', title : '', thumb : 'img/11_thumb.jpg', url : ''}, 
														{image : 'img/12.jpg', title : '', thumb : 'img/12_thumb.jpg', url : ''}, 
														{image : 'img/13.jpg', title : '', thumb : 'img/13_thumb.jpg', url : ''}, 
														{image : 'img/14.jpg', title : '', thumb : 'img/14_thumb.jpg', url : ''}, 
														{image : 'img/15.jpg', title : '', thumb : 'img/15_thumb.jpg', url : ''},
														{image : 'img/16.jpg', title : '', thumb : 'img/16_thumb.jpg', url : ''},
														{image : 'img/17.jpg', title : '', thumb : 'img/17_thumb.jpg', url : ''},
														{image : 'img/18.jpg', title : '', thumb : 'img/18_thumb.jpg', url : ''},
														{image : 'img/19.jpg', title : '', thumb : 'img/19_thumb.jpg', url : ''},
											
												],*/
					slides                  : slider_wp,
												
					// Theme Options			   
					progress_bar			:	1,			// Timer for each slide							
					mouse_scrub				:	0
					
				});
		    });
		    
		</script>

		<?php 


			if(isset($arrows) && !empty($arrows))
			{
				echo '
					<style type="text/css">
						#prevslide, #nextslide{ background:url("'.$arrows.'") !important; }
						#nextslide{ background-position: top right !important; }
					</style>
				';
			}

			if(isset($progress) && !empty($progress))
			{
				echo '
					<style type="text/css">
						#progress-bar{ background:url("'.$progress.'") repeat-x !important; }
					</style>
				';
			}

			if(isset($navigation) && !empty($navigation))
			{
				echo '
					<style type="text/css">
						ul#slide-list li a{ background:url("'.$navigation.'") no-repeat scroll 0 -24px; }
					</style>
				';
			}
		?>
		
	</head>
	
	<style type="text/css">
		ul#demo-block{ margin:0 15px 15px 15px; }
			ul#demo-block li{ margin:0 0 10px 0; padding:10px; display:inline; float:left; clear:both; color:#aaa; background:url('img/bg-black.png'); font:11px Verdana, sans-serif; }
			ul#demo-block li a{ color:#eee; font-weight:bold; }
	</style>

<body>

	<!--Demo styles (you can delete this block)-->
	
	<ul id="demo-block">
		
	</ul>
	
	<!--End of styles-->

	<!--Thumbnail Navigation-->
	<div id="prevthumb"></div>
	<div id="nextthumb"></div>
	
	<!--Arrow Navigation-->
	<a id="prevslide" class="load-item"></a>
	<a id="nextslide" class="load-item"></a>
	
	<div id="thumb-tray" class="load-item">
		<div id="thumb-back"></div>
		<div id="thumb-forward"></div>
	</div>
	
	<!--Time Bar-->
	<div id="progress-back" class="load-item">
		<div id="progress-bar"></div>
	</div>
	
	<!--Control Bar-->
	<div id="controls-wrapper" class="load-item">
		<div id="controls">
			
			<a id="play-button"><img id="pauseplay" src="<?php echo bloginfo('template_url'); ?>/assets/images/lookbook/pause.png"/></a>
		
			<!--Slide counter-->
			<div id="slidecounter">
				<span class="slidenumber"></span> / <span class="totalslides"></span>
			</div>
			
			<!--Slide captions displayed here-->
			<div id="slidecaption"></div>
			
			<!--Thumb Tray button-->
			<a id="tray-button"><img id="tray-arrow" src="<?php echo bloginfo('template_url'); ?>/assets/images/lookbook/button-tray-up.png"/></a>
			
			<!--Navigation-->
			<ul id="slide-list"></ul>
			
		</div>
	</div>

</body>
</html>
