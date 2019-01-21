<?php 
 	Redux::setSection( $opt_name, array(
        'title'            => __( 'Shop Page', 'migwoo_enhancer' ),
        'id'               => 'shop-page',
        'desc'             => __( '', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-th-list'
    ) );
	
	Redux::setSection( $opt_name, array(
        'title'      => __( 'Design', 'redux-framework-demo' ),
        'id'         => 'shop-design',
        'desc'       => __( '', 'redux-framework-demo' ),
		'class' => '',
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'activate-shop-page-design',
                'type'     => 'checkbox',
                'title'    => __( 'Activate Shop Design Changes', 'redux-framework-demo' ),
                'subtitle' => __( 'this prevents override your default styles/functions without aprobation', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'default'  => '0'
            ),
			/*================= Shop Breadcrumb ===========================*/
			array(
                'id'       => 'shop-breadcrumb-section-start',
                'type'     => 'section',
                'title'    => __( 'Shop Breadcrumb Options', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
			array(
			'id'            => 'shop-breadcrumb-size',
			'type'          => 'slider',
			'title'         => __( 'Breadcrumb size (pixels)', 'redux-framework-demo' ),
			'subtitle'      => __( '', 'redux-framework-demo' ),
			'desc'          => __( '', 'redux-framework-demo' ),
			'default'       => 16,
			'min'           => 0,
			'step'          => 1,
			'max'           => 300,
			'display_value' => 'text'
			),
			array(
				'id'       => 'shop-breadcrumb-color',
				'type'     => 'color',
				'title'    => __( 'Breadcrumb Color', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'default'  => '',
			),
			array(
				'id'       => 'shop-breadcrumb-alignment',
				'type'     => 'select',
				'title'    => __( 'Breadcrumb Alignment', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'options'  => array(
					'left' => 'Left',
					'center' => 'Center',
					'right' => 'Right',
				),
				'default'	=> 'left'
			),
			array(
				'id'       => 'shop-breadcrumb-transform',
				'type'     => 'select',
				'title'    => __( 'Breadcrumb Transform', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'options'  => array(
					'none' => 'None',
					'uppercase' => 'Uppercase',
					'lowercase' => 'Lowercase',
					'capitalize' => 'Capitalize',
				),
			),
			/*================= Shop Title ===========================*/
			array(
                'id'       => 'shop-title-section-start',
                'type'     => 'section',
                'title'    => __( 'Shop Title Options', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
			array(
			'id'            => 'shop-title-size',
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
				'id'       => 'shop-title-color',
				'type'     => 'color',
				'title'    => __( 'Title Color', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'default'  => '',
			),
			array(
				'id'       => 'shop-title-alignment',
				'type'     => 'select',
				'title'    => __( 'Title Alignment', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'options'  => array(
					'left' => 'Left',
					'center' => 'Center',
					'right' => 'Right',
				),
				'default'	=> 'left'
			),
			array(
				'id'       => 'shop-title-transform',
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
			/*================= Shop Results Count ===========================*/
			array(
                'id'       => 'shop-result-section-start',
                'type'     => 'section',
                'title'    => __( 'Shop Results Count Options', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
			array(
			'id'            => 'shop-result-size',
			'type'          => 'slider',
			'title'         => __( 'Results Count size (pixels)', 'redux-framework-demo' ),
			'subtitle'      => __( '', 'redux-framework-demo' ),
			'desc'          => __( '', 'redux-framework-demo' ),
			'default'       => 18,
			'min'           => 0,
			'step'          => 1,
			'max'           => 300,
			'display_value' => 'text'
			),
			array(
				'id'       => 'shop-result-color',
				'type'     => 'color',
				'title'    => __( 'Results Count Color', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'default'  => '',
			),
			array(
				'id'       => 'shop-result-alignment',
				'type'     => 'select',
				'title'    => __( 'Results Count Alignment', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'options'  => array(
					'left' => 'Left',
					'center' => 'Center',
					'right' => 'Right',
				),
				'default'	=> 'left'
			),
			array(
				'id'       => 'shop-result-transform',
				'type'     => 'select',
				'title'    => __( 'Results Count Transform', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'options'  => array(
					'none' => 'None',
					'uppercase' => 'Uppercase',
					'lowercase' => 'Lowercase',
					'capitalize' => 'Capitalize',
				),
			),
			/*================= Shop Order Selector ===========================*/
			array(
                'id'       => 'shop-order-section-start',
                'type'     => 'section',
                'title'    => __( 'Shop Order Selector Options', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
			array(
			'id'            => 'shop-order-size',
			'type'          => 'slider',
			'title'         => __( 'Order Selector size (pixels)', 'redux-framework-demo' ),
			'subtitle'      => __( '', 'redux-framework-demo' ),
			'desc'          => __( '', 'redux-framework-demo' ),
			'default'       => 14,
			'min'           => 0,
			'step'          => 1,
			'max'           => 300,
			'display_value' => 'text'
			),
			array(
				'id'       => 'shop-order-color',
				'type'     => 'color',
				'title'    => __( 'Order Selector text color', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'default'  => '',
			),
			array(
				'id'       => 'shop-order-background-color',
				'type'     => 'color',
				'title'    => __( 'Order Selector background color', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'default'  => '',
			),
			array(
				'id'       => 'shop-order-transform',
				'type'     => 'select',
				'title'    => __( 'Order Selector Transform', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'options'  => array(
					'none' => 'None',
					'uppercase' => 'Uppercase',
					'lowercase' => 'Lowercase',
					'capitalize' => 'Capitalize',
				),
			),
			array(
				'id'             => 'shop-order-dimensions',
				'type'           => 'dimensions',
				'units'          => array( 'em', 'px', '%' ),    // You can specify a unit value. Possible: px, em, %
				'units_extended' => 'true',  // Allow users to select any type of unit
				'title'          => __( 'Pagination padding', 'redux-framework-demo' ),
				'subtitle'       => __( '', 'redux-framework-demo' ),
				'desc'           => __( '', 'redux-framework-demo' ),
				'default'        => array(
					'width'  => 10,
					'height' => 5,
				),
			),
			
			/*================= Shop Product ===========================*/
			array(
                'id'       => 'shop-product-section-start',
                'type'     => 'section',
                'title'    => __( 'Shop Products Options', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
			array(
				'id'       => 'shop-products-image',
				'type'     => 'select',
				'title'    => __( 'Image Shape', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'options'  => array(
					'square' => 'square',
					'rounded' => 'rounded',
					'circle' => 'circle',
				),
				'default' => ''
			),
			array(
			'id'            => 'shop-products-title-size',
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
				'id'       => 'shop-products-title-color',
				'type'     => 'color',
				'title'    => __( 'Title Color', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'default'  => '',
			),
			array(
				'id'       => 'shop-products-title-alignment',
				'type'     => 'select',
				'title'    => __( 'Title Alignment', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'options'  => array(
					'left' => 'Left',
					'center' => 'Center',
					'right' => 'Right',
				),
				'default'	=> 'left'
			),
			array(
				'id'       => 'shop-products-title-transform',
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
			array(
				'id'       => 'shop-products-stars-color',
				'type'     => 'color',
				'title'    => __( 'Stars Color', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'default'  => '',
			),
			array(
				'id'       => 'shop-products-price-color',
				'type'     => 'color',
				'title'    => __( 'Price Color', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'default'  => '',
			),
			array(
			'id'            => 'shop-products-price-size',
			'type'          => 'slider',
			'title'         => __( 'Price size (pixels)', 'redux-framework-demo' ),
			'subtitle'      => __( '', 'redux-framework-demo' ),
			'desc'          => __( '', 'redux-framework-demo' ),
			'default'       => 14,
			'min'           => 0,
			'step'          => 1,
			'max'           => 300,
			'display_value' => 'text'
			),
			array(
                'id'       => 'shop-products-addtocart-color',
                'type'     => 'link_color',
                'title'    => __( 'Add to cart text color', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'regular'   => true, // Disable Regular Color
                'hover'     => true, // Disable Hover Color
                'active'    => false, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                
            ),
			array(
                'id'       => 'shop-products-addtocart-background-color',
                'type'     => 'link_color',
                'title'    => __( 'Add to cart background color', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'regular'   => true, // Disable Regular Color
                'hover'     => true, // Disable Hover Color
                'active'    => false, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                
            ),
			/*================= Shop Pagination ===========================*/
			array(
                'id'       => 'shop-pagination-section-start',
                'type'     => 'section',
                'title'    => __( 'Shop Pagination Options', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
			array(
			'id'            => 'shop-pagination-size',
			'type'          => 'slider',
			'title'         => __( 'font size (pixels)', 'redux-framework-demo' ),
			'subtitle'      => __( '', 'redux-framework-demo' ),
			'desc'          => __( '', 'redux-framework-demo' ),
			'default'       => 14,
			'min'           => 0,
			'step'          => 1,
			'max'           => 300,
			'display_value' => 'text'
			),
			array(
                'id'       => 'shop-pagination-text-color',
                'type'     => 'link_color',
                'title'    => __( 'Pagination text color', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'regular'   => true, // Disable Regular Color
                'hover'     => true, // Disable Hover Color
                'active'    => false, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                
            ),
			array(
                'id'       => 'shop-pagination-background-color',
                'type'     => 'link_color',
                'title'    => __( 'Pagination Background color', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'regular'   => true, // Disable Regular Color
                'hover'     => true, // Disable Hover Color
                'active'    => false, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                
            ),
			array(
			'id'             => 'shop-pagination-dimensions',
			'type'           => 'dimensions',
			'units'          => array( 'em', 'px', '%' ),    // You can specify a unit value. Possible: px, em, %
			'units_extended' => 'true',  // Allow users to select any type of unit
			'title'          => __( 'Pagination padding', 'redux-framework-demo' ),
			'subtitle'       => __( '', 'redux-framework-demo' ),
			'desc'           => __( '', 'redux-framework-demo' ),
			'default'        => array(
				'width'  => 15,
				'height' => 12,
			),
		),
		 )

    ) );
	Redux::setSection( $opt_name, array(
        'title'      => __( 'Shop Grid', 'redux-framework-demo' ),
        'id'         => 'shop-grid',
        'desc'       => __( '', 'redux-framework-demo' ),
		'class' => 'migwoo_sorter_section',
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'activate-shop-page-hooks',
                'type'     => 'checkbox',
                'title'    => __( 'Activate Shop Hooks Changes', 'redux-framework-demo' ),
                'subtitle' => __( 'this prevents override your default styles/functions without aprobation', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'default'  => '0'
            ),
			
			array(
                'id'       => 'shop-page-hooks',
                'type'     => 'sorter',
				'class'		=> 'migwoo_enhancer_full_sorter',
                'title'    => 'Shop Page Grid',
                'subtitle' => 'Drag and drop the fields inside the proper column',
                'compiler' => 'true',
                'options'  => array(
                    'before_shop'  => array(
						'woocommerce_result_count' => 'Count',
						'woocommerce_catalog_ordering' => 'Order',
					),
                    'after_shop'  => array(
						'woocommerce_pagination' => 'Pagination'
					),
					'disabled' => array(
						'woocommerce_result_count' => 'Count',
						'woocommerce_catalog_ordering' => 'Order',
						'woocommerce_pagination' => 'Pagination'
					),
                ),

            ),
		 )

    ) );
	Redux::setSection( $opt_name, array(
        'title'      => __( $profunctions, 'redux-framework-demo' ),
        'id'         => 'shop-pro',
        'desc'       => __( '', 'redux-framework-demo' ),
		'class' => '',
        'subsection' => true,
        'fields'     => array(
			/*================= Shop QuickView ===========================*/
			array(
                'id'       => 'shop-quickview-section-start',
                'type'     => 'section',
                'title'    => __( 'Shop QuickView Options', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
			array(
				'id'       => 'shop-activate-quickview',
				'type'     => 'select',
				'title'    => __( 'Activate QuickView', 'redux-framework-demo' ),
				'subtitle' => __( '', 'redux-framework-demo' ),
				'desc'       => __( 'QuickView let customers get a product quick view when mouse pass over. <a href="http://alborotado.com/plugindemo/woocommerce_enhancer/shop/" target="_blank">DEMO</a>', 'redux-framework-demo' ),
				'options'  => array(
					'no' => 'No',
					'yes' => 'Yes',
				),
				'default'	=> 'no'
			),
		)
	) );
	
?>