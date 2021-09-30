<?php

// Shortcode static page Title,Subtitle and Short_description

function single_page_title() { 
 
	ob_start();
	?> 
	<div class="single-main-container1">
		<div class='single-wrapper'>
			<div class="rows">
				<div class="single-title">
					<h1><?php echo get_the_title(); ?></h1>
				</div>
				<div class="single-subtitle">
					<h2><?php echo get_post_meta( get_the_ID(), 'subtitle', true ); ?></h2>
				</div>
				
			</div>
			<div class="rows">
				<div class="single-container1"></div>
				<div class="single-container2"></div>
			</div>
		</div>
	</div>
	<div class="single-main-container2">
	<div class="single-short-description">
		<p><?php echo get_post_meta( get_the_ID(), 'short_description', true ); ?></p>
	</div>
	</div>

	<?php
  
	return ob_get_clean();
} 
add_shortcode('title-container', 'single_page_title'); 
 
