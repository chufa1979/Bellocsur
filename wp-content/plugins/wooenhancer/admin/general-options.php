<?php 
$mainadv = '
<div class="alborotado-advertiser clearfix">
	<h2 class="alborotado-title">Easyfix</h2>
	<a target="_blank" href="https://creativemarket.com/miguras/2709568-Easyfix-Handyman-Wordpress-Theme?u=miguras">
		<img class="alborotado-image" src="'.plugins_url( 'images/easyfix-preview-creative.jpg', __FILE__ ).'">
	</a>
	<p class="alborotado-description">
	Easyfix is a Divi Child Theme suitable for handymen. The design and page layouts were thought to satisfy this specific nich to provide you and easy way to build your site with an andanced base, not like those "Multipurpose Wordpress things" that bring headaech. Perfect for carpenter, electrician, welder, plumber, and many other related trades. It costs $39 and includes Divi for free ($89)
	<p>
	<div class="alborotado-buttons-container">
		<a target="_blank" class="alborotado-button" href="https://miguras.com/easyfix">Plugin Demo</a>
		<a target="_blank" class="alborotado-button" href="https://creativemarket.com/miguras/2709568-Easyfix-Handyman-Wordpress-Theme?u=miguras">Plugin Details</a>
	</div>	
	
	
	<h2 class="alborotado-title">Toro</h2>
	<a target="_blank" href="https://creativemarket.com/miguras/2686088-Toro-Restaurant-Bar-Theme?u=miguras">
		<img class="alborotado-image" src="'.plugins_url( 'images/toro-preview-creative.jpg', __FILE__ ).'">
	</a>
	<p class="alborotado-description">
	Toro is a responsive Bar & Restaurant theme made with Divi for Wordpress. Elegant and simple, fast and easy, Toro is not intend to embrace everything and everyone, it was thought to create an image accord to modern restaurants, coffee shops or bars. Everything you see it is included, Logo, Layouts Images and more. It costs $39 and includes Divi for free ($89)
	<p>
	<div class="alborotado-buttons-container">
		<a target="_blank" class="alborotado-button" href="https://miguras.com/toro">Plugin Demo</a>
		<a target="_blank" class="alborotado-button" href="https://creativemarket.com/miguras/2686088-Toro-Restaurant-Bar-Theme?u=miguras">Plugin Details</a>
	</div>	

</div>
';

 Redux::setSection( $opt_name, array(
        'title'            => __( 'General Options', 'redux-framework-demo' ),
        'desc'             => __( '', 'redux-framework-demo' ),
        'id'               => 'general-options-fields',
        'subsection'       => false,
        'customizer_width' => '700px',
        'fields'           => array(
			array(
				'id'    => 'wooenhancer-pro-alert',
				'type'  => 'info',
				'style' => 'info',
				'title' => __( 'WooEnhancer', 'redux-framework-demo' ),
				'desc'  => __( $isProNotice, 'redux-framework-demo' )
            ),
			array(
                'id'          => 'password-strength',
                'type'        => 'select',
                'title'       => __( 'Deactivate Password Strength Meter', 'redux-framework-demo' ),
                'subtitle'    => __( '', 'redux-framework-demo' ),
                'desc'        => __( '', 'redux-framework-demo' ),
                'options'	  => array(
					'enabled'	=> __('no', 'migwoo_enhancer'),
					'disabled'	=> __('Yes', 'migwoo_enhancer'),
				),
				'default' => 'enabled',
				'placeholder' => '',
            ),
			array( 
				'id'       => 'featured-alborotado',
				'type'     => 'raw',
				'title'    => __('FEATURED ITEM', 'redux-framework-demo'),
				'subtitle' => __('By Miguras', 'redux-framework-demo'),
				'desc'     => __('', 'redux-framework-demo'),
				'content'  => $mainadv,
			),
			/*
			array(
                'id'          => 'migwoo_enhancer_main_typography',
                'type'        => 'typography',
                'title'       => __( 'Typography h2.site-description', 'redux-framework-demo' ),
                'compiler'      => false,  // Use if you want to hook in your own CSS compiler
                'google'      => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup' => true,
                // Select a backup non-google font in addition to a google font
                'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                //'subsets'       => false, // Only appears if google is true and subsets not set to false
                'font-size'     => true,
                'line-height'   => true,
                //'word-spacing'  => true,  // Defaults to false
                //'letter-spacing'=> true,  // Defaults to false
                'color'         => true,
                'preview'       => true, // Disable the previewer
                'all_styles'  => true,
                // Enable all Google Font style/weight variations to be added to the page
                //'output'      => array( 'body' ),
                // An array of CSS selectors to apply this font style to dynamically
                //'compiler'    => array( 'h2.site-description-compiler' ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => __( '', 'redux-framework-demo' ),
                'default'     => array(
                    'color'       => '',
                    'font-style'  => '',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '',
                    'line-height' => ''
                ),
            ),
			*/
        )
    ) );
?>
