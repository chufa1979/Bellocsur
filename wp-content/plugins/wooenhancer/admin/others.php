<?php 
$advcontent = '
<div class="alborotado-advertiser clearfix">
	<h2 class="alborotado-title">Easyfix</h2>
	<a target="_blank" href="https://creativemarket.com/miguras/2709568-Easyfix-Handyman-Wordpress-Theme">
		<img class="alborotado-image" src="'.plugins_url( 'images/easyfix-preview-creative.jpg', __FILE__ ).'">
	</a>
	<p class="alborotado-description">
	Easyfix is a Divi Child Theme suitable for handymen. The design and page layouts were thought to satisfy this specific nich to provide you and easy way to build your site with an andanced base, not like those "Multipurpose Wordpress things" that bring headaech. Perfect for carpenter, electrician, welder, plumber, and many other related trades. It costs $39 and includes Divi for free ($89)
	<p>
	<div class="alborotado-buttons-container">
		<a target="_blank" class="alborotado-button" href="https://miguras.com/easyfix">Plugin Demo</a>
		<a target="_blank" class="alborotado-button" href="https://creativemarket.com/miguras/2709568-Easyfix-Handyman-Wordpress-Theme">Plugin Details</a>
	</div>	
	
	
	<h2 class="alborotado-title">Toro</h2>
	<a target="_blank" href="https://creativemarket.com/miguras/2686088-Toro-Restaurant-Bar-Theme">
		<img class="alborotado-image" src="'.plugins_url( 'images/toro-preview-creative.jpg', __FILE__ ).'">
	</a>
	<p class="alborotado-description">
	Toro is a responsive Bar & Restaurant theme made with Divi for Wordpress. Elegant and simple, fast and easy, Toro is not intend to embrace everything and everyone, it was thought to create an image accord to modern restaurants, coffee shops or bars. Everything you see it is included, Logo, Layouts Images and more. It costs $39 and includes Divi for free ($89)
	<p>
	<div class="alborotado-buttons-container">
		<a target="_blank" class="alborotado-button" href="https://miguras.com/toro">Plugin Demo</a>
		<a target="_blank" class="alborotado-button" href="https://creativemarket.com/miguras/2686088-Toro-Restaurant-Bar-Theme">Plugin Details</a>
	</div>	

</div>
';


 Redux::setSection( $opt_name, array(
        'title'            => __( 'Themes & Plugins', 'redux-framework-demo' ),
        'desc'             => __( '', 'redux-framework-demo' ),
        'id'               => 'alborotado-options-fields',
        'subsection'       => false,
        'customizer_width' => '700px',
        'fields'           => array(
            array( 
				'id'       => 'advertise-alborotado',
				'type'     => 'raw',
				'title'    => __('Other themes & plugins made by Miguras', 'redux-framework-demo'),
				'subtitle' => __('', 'redux-framework-demo'),
				'desc'     => __('', 'redux-framework-demo'),
				'content'  => $advcontent,
			),
        )
    ) );
?>