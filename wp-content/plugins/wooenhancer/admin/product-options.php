<?php 

	 Redux::setSection( $opt_name, array(
        'title'            => __( 'Product Page', 'migwoo_enhancer' ),
        'id'               => 'product-page',
        'desc'             => __( '', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-shopping-cart'
    ) );
	
	
	Redux::setSection( $opt_name, array(
        'title'      => __( 'Design', 'redux-framework-demo' ),
        'id'         => 'product-page-colors-and-text',
        'desc'       => __( '', 'redux-framework-demo' ),
        'subsection' => true,
        'fields'     => array(
			 array(
                'id'       => 'activate-product-design',
                'type'     => 'checkbox',
                'title'    => __( 'Activate Product Design Options', 'redux-framework-demo' ),
                'subtitle' => __( 'this prevents override your default styles/functions without aprobation', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'default'  => '0'
            ),
			/*================= Product Title ===========================*/
			array(
                'id'       => 'producttitle-section-start',
                'type'     => 'section',
                'title'    => __( 'Product Title Options', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
			array(
			'id'            => 'product-title-size',
			'type'          => 'slider',
			'title'         => __( 'Title size (pixels)', 'redux-framework-demo' ),
			'subtitle'      => __( '', 'redux-framework-demo' ),
			'desc'          => __( '', 'redux-framework-demo' ),
			'default'       => 25,
			'min'           => 0,
			'step'          => 1,
			'max'           => 300,
			'display_value' => 'text'
			),
			array(
				'id'       => 'product-title-color',
				'type'     => 'color',
				'title'    => __( 'Title Color', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'default'  => '',
			),
			array(
				'id'       => 'product-title-transform',
				'type'     => 'select',
				'title'    => __( 'Title Transform', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'options'  => array(
					'none' => 'None',
					'uppercase' => 'Uppercase',
					'lowercase' => 'Lowercase',
					'capitalize' => 'Capitalize',
				),
			),
			/*================= Product Price ===========================*/
			array(
                'id'       => 'product-price-section-start',
                'type'     => 'section',
                'title'    => __( 'Product Price Options', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
			array(
			'id'            => 'product-price-size',
			'type'          => 'slider',
			'title'         => __( 'Price size (pixels)', 'redux-framework-demo' ),
			'subtitle'      => __( '', 'redux-framework-demo' ),
			'desc'          => __( '', 'redux-framework-demo' ),
			'default'       => 24,
			'min'           => 0,
			'step'          => 1,
			'max'           => 300,
			'display_value' => 'text'
			),
			array(
				'id'       => 'product-price-color',
				'type'     => 'color',
				'title'    => __( 'Price Color', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'default'  => '',
			),
			/*================= Product Quantity ===========================*/
			array(
                'id'       => 'product-quantity-section-start',
                'type'     => 'section',
                'title'    => __( 'Product Quantity Options', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
			array(
				'id'       => 'product-quantity-color',
				'type'     => 'color',
				'title'    => __( 'Quantity Color', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'default'  => '',
			),
			
			array(
				'id'       => 'product-quantity-backcolor',
				'type'     => 'color',
				'title'    => __( 'Quantity Background Color', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'default'  => '',
			),
			/*================= Product stock ===========================*/
			array(
                'id'       => 'product-stock-section-start',
                'type'     => 'section',
                'title'    => __( 'Product Stock Options', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
			array(
			'id'            => 'product-stock-size',
			'type'          => 'slider',
			'title'         => __( 'Stock size (pixels)', 'redux-framework-demo' ),
			'subtitle'      => __( '', 'redux-framework-demo' ),
			'desc'          => __( '', 'redux-framework-demo' ),
			'default'       => 15,
			'min'           => 0,
			'step'          => 1,
			'max'           => 300,
			'display_value' => 'text'
			),
			array(
				'id'       => 'product-stock-color',
				'type'     => 'color',
				'title'    => __( 'Stock Color', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'default'  => '',
			),
			/*================= Product Review ===========================*/
			array(
                'id'       => 'productreview-section-start',
                'type'     => 'section',
                'title'    => __( 'Product Customers Reviews Options', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
			array(
			'id'            => 'product-review-size',
			'type'          => 'slider',
			'title'         => __( 'Review size (pixels)', 'redux-framework-demo' ),
			'subtitle'      => __( '', 'redux-framework-demo' ),
			'desc'          => __( '', 'redux-framework-demo' ),
			'default'       => 25,
			'min'           => 0,
			'step'          => 1,
			'max'           => 300,
			'display_value' => 'text'
			),
			array(
				'id'       => 'product-review-stars-color',
				'type'     => 'color',
				'title'    => __( 'Stars color', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'default'  => '',
			),
			array(
				'id'       => 'product-review-link-color',
				'type'     => 'color',
				'title'    => __( 'Link color', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'default'  => '',
			),
			
			/*======================== Add To Cart =============================*/
			
			array(
                'id'       => 'addtocart-section-start',
                'type'     => 'section',
                'title'    => __( 'Add to Cart Button Options', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
			array(
                'id'       => 'add-to-cart-link-text-color',
                'type'     => 'link_color',
                'title'    => __( 'Add to cart button text color', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'regular'   => true, // Disable Regular Color
                'hover'     => true, // Disable Hover Color
                'active'    => false, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                
            ),
			
			array(
                'id'       => 'add-to-cart-link-background-color',
                'type'     => 'link_color',
                'title'    => __( 'Add to cart button background color', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'regular'   => true, // Disable Regular Color
                'hover'     => true, // Disable Hover Color
                'active'    => false, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                
            ),
			array(
                'id'             => 'add-to-cart-quantity-size',
                'type'           => 'dimensions',
                'units'          => array( 'em', 'px', '%' ),    // You can specify a unit value. Possible: px, em, %
                'units_extended' => 'true',  // Allow users to select any type of unit
                'title'          => __( 'Add to cart quantity field size (pixels)', 'redux-framework-demo' ),
                'subtitle'       => __( '', 'redux-framework-demo' ),
                'desc'           => __( '', 'redux-framework-demo' ),
                'default'        => array(
                    'width'  => 80,
                    'height' => 42,
                )
            ),
			
			/*======================= Tabs Options ===========================*/
			array(
                'id'       => 'tabs-section-start',
                'type'     => 'section',
                'title'    => __( 'Tabs Options', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
			
			array(
                'id'       => 'tab-link-color',
                'type'     => 'link_color',
                'title'    => __( 'Tab text color', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'regular'   => true, // Disable Regular Color
                'hover'     => true, // Disable Hover Color
                'active'    => true, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                
            ),
			
			array(
                'id'       => 'tab-link-background-color',
                'type'     => 'link_color',
                'title'    => __( 'Tab background color', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'regular'   => true, // Disable Regular Color
                'hover'     => true, // Disable Hover Color
                'active'    => true, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                
            ),
			/*======================= Description Options ===========================*/
			array(
                'id'       => 'description-section-start',
                'type'     => 'section',
                'title'    => __( 'Content inside tabs Options', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
			array(
				'id'            => 'product-description-title-size',
				'type'          => 'slider',
				'title'         => __( 'Titles size (pixels)', 'redux-framework-demo' ),
				'subtitle'      => __( '', 'redux-framework-demo' ),
				'desc'          => __( '', 'redux-framework-demo' ),
				'default'       => 25,
				'min'           => 0,
				'step'          => 1,
				'max'           => 300,
				'display_value' => 'text'
			),
			array(
				'id'       => 'product-description-title-color',
				'type'     => 'color',
				'title'    => __( 'Titles color', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'default'  => '',
			),
			array(
				'id'            => 'product-description-content-size',
				'type'          => 'slider',
				'title'         => __( 'Description text size (pixels)', 'redux-framework-demo' ),
				'subtitle'      => __( '', 'redux-framework-demo' ),
				'desc'          => __( '', 'redux-framework-demo' ),
				'default'       => 25,
				'min'           => 0,
				'step'          => 1,
				'max'           => 300,
				'display_value' => 'text'
			),
			array(
				'id'       => 'product-description-content-color',
				'type'     => 'color',
				'title'    => __( 'Description text color', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'default'  => '',
			),
			
		 )

    ) );
	 Redux::setSection( $opt_name, array(
        'title'            => __( 'Text', 'migwoo_enhancer' ),
        'id'               => 'product-text-page',
        'desc'             => __( '', 'redux-framework-demo' ),
        'customizer_width' => '',
		'subsection'	=> true,
		'fields'	=> array(
			array(
                'id'       => 'add-to-cart-text',
                'type'     => 'text',
                'title'    => __( 'Add to cart button text', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'default'  => __('', 'mighoo_enhancer'),
            ),
			
		),
    ) );
	
	Redux::setSection( $opt_name, array(
        'title'      => __( 'Single Product Grid', 'redux-framework-demo' ),
        'id'         => 'single_product_grid',
        'desc'       => __( '', 'redux-framework-demo' ),
        'subsection' => true,
		'class' => 'migwoo_sorter_section',
        'fields'     => array(
            array(
                'id'       => 'activate-product-page-hooks',
                'type'     => 'checkbox',
                'title'    => __( 'Activate Product Hooks Changes', 'redux-framework-demo' ),
                'subtitle' => __( 'this prevents override your default styles/functions without aprobation', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'default'  => '0'
            ),
			array(
                'id'       => 'single-product-hooks',
                'type'     => 'sorter',
				'class'		=> 'migwoo_enhancer_full_sorter',
                'title'    => 'Single Product Grid',
                'subtitle' => 'Drag and drop the fields inside the proper column',
                'compiler' => 'true',
                'options'  => array(
					'before_content' => array(
						'woocommerce_breadcrumb' => 'Breadcrumb',
					),
					
					'full_width'.$onlypro.'' => array(
						'wooenhancer_product_main_video' => 'Main Video '.$onlypro.'',
						'wooenhancer_product_html_block' => 'HTML '.$onlypro.'',
						'wooenhancer_product_total_sales' => 'Total Sales '.$onlypro.'',
						'wooenhancer_product_wysiwyg_block' => 'WYSIWYG '.$onlypro.'',
						//'wooenhancer_enquire' => 'Ask a Question '.$onlypro.'',
					),
                    'before_summary'  => array(
						'woocommerce_show_product_sale_flash' => 'Sale Flash',
						'woocommerce_show_product_images' => 'Main Image',
					),
					
                    'summary' => array(
						'woocommerce_template_single_title' => 'Product Title',
						'woocommerce_template_single_rating' => 'Product Rating',
						'woocommerce_template_single_price' => 'Product Price',
						'woocommerce_template_single_excerpt' => 'Product Excerpt',
						'woocommerce_template_single_add_to_cart' => 'Add to cart button',
						'woocommerce_template_single_meta' => 'Product Meta',
						'woocommerce_template_single_sharing' => 'Product Sharing',
					),
					'thumbnails_area'  => array(
						'woocommerce_show_product_thumbnails' => 'Product Thumbnails',
					),
					
					'after_summary' => array(
						'woocommerce_output_product_data_tabs' => 'Tabs',
						'woocommerce_upsell_display' => 'Upsell Display',
						'woocommerce_output_related_products' => 'Related Products',
					),
					'disabled' => array(),
                ),

            ),
        )

    ) );
	
	/* Pro Options 
	Redux::setSection( $opt_name, array(
        'title'      => __( $profunctions, 'redux-framework-demo' ),
        'id'         => 'product-pro',
        'desc'       => __( '', 'redux-framework-demo' ),
		'class' => '',
        'subsection' => true,
        'fields'     => array(
			//================= Ask a Question  ===========================
			array(
                'id'       => 'enquire-section',
                'type'     => 'section',
                'title'    => __( 'Ask a Question Settings', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
			array(
				'id'       => 'enquire-email',
				'type'     => 'text',
				'title'    => __( 'EMail Address', 'redux-framework-demo' ),
				'subtitle' => __( 'Where you will get questions', 'redux-framework-demo' ),
				'desc'       => __( '', 'redux-framework-demo' ),
				'default'	=> get_option('admin_email'),
			),
			array(
				'id'       => 'enquire-button-text',
				'type'     => 'text',
				'title'    => __( 'Button Text', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'desc'       => __( '', 'redux-framework-demo' ),
				'default'	=> 'Ask a Question',
			),
			
			array(
				'id'       => 'enquire-custom-message',
				'type'     => 'text',
				'title'    => __( 'Custom Message', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'desc'       => __( '', 'redux-framework-demo' ),
				'default'	=> 'Custom Message',
			),
			array(
				'id'       => 'enquire-success-message',
				'type'     => 'text',
				'title'    => __( 'On Success Message', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'desc'       => __( '', 'redux-framework-demo' ),
				'default'	=> 'Sent',
			),
		)
	) );
	*/
	
?>
