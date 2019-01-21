<?php 
Redux::setSection( $opt_name, array(
	'title'            => __( 'Checkout Page', 'migwoo_enhancer' ),
	'id'               => 'checkout-page',
	'desc'             => __( '', 'redux-framework-demo' ),
	'customizer_width' => '400px',
	'icon'             => 'el el-check'
) );

Redux::setSection( $opt_name, array(
	'title'            => __( 'Design', 'migwoo_enhancer' ),
	'id'               => 'checkout-page-design',
	'desc'             => __( '', 'redux-framework-demo' ),
	'customizer_width' => '',
	'subsection'        => true,
	'fields' => array(
		array(
			'id'       => 'checkout-titles-section',
			'type'     => 'section',
			'title'    => __( 'Titles', 'redux-framework-demo' ),
			'subtitle' => __( '', 'redux-framework-demo' ),
			'indent'   => true, // Indent all options below until the next 'section' option is set.
		),
		 array(
			'id'       => 'activate-checkout-titles-design',
			'type'     => 'checkbox',
			'title'    => __( 'Activate Titles customization', 'redux-framework-demo' ),
			'subtitle' => __( 'this prevents override your default styles/functions without aprobation', 'redux-framework-demo' ),
			'desc'     => __( '', 'redux-framework-demo' ),
			'default'  => '0'
		),
		array(
			'id'            => 'checkout-titles-size',
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
			'id'       => 'checkout-titles-color',
			'type'     => 'color',
			'title'    => __( 'Title Color', 'redux-framework-demo' ),
			'subtitle' => __( '', 'redux-framework-demo' ),
			'default'  => '',
		),
		array(
			'id'       => 'checkout-titles-transform',
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
			'id'       => 'checkout-fields-section',
			'type'     => 'section',
			'title'    => __( 'Fields', 'redux-framework-demo' ),
			'subtitle' => __( '', 'redux-framework-demo' ),
			'indent'   => true, // Indent all options below until the next 'section' option is set.
		),		
		 array(
			'id'       => 'activate-checkout-fields-design',
			'type'     => 'checkbox',
			'title'    => __( 'Activate fields customization', 'redux-framework-demo' ),
			'subtitle' => __( 'this prevents override your default styles/functions without aprobation', 'redux-framework-demo' ),
			'desc'     => __( '', 'redux-framework-demo' ),
			'default'  => '0'
		),
		array(
			'id'       => 'checkout-fields-label-color',
			'type'     => 'color',
			'title'    => __( 'Fields Label Color', 'redux-framework-demo' ),
			'subtitle' => __( '', 'redux-framework-demo' ),
			'default'  => '',
		),
		array(
			'id'       => 'checkout-fields-background-color',
			'type'     => 'color',
			'title'    => __( 'Fields Background Color', 'redux-framework-demo' ),
			'subtitle' => __( '', 'redux-framework-demo' ),
			'default'  => '',
		),
		array(
			'id'       => 'checkout-fields-text-color',
			'type'     => 'color',
			'title'    => __( 'Fields Text Color', 'redux-framework-demo' ),
			'subtitle' => __( '', 'redux-framework-demo' ),
			'default'  => '',
		),
		array(
			'id'             => 'checkout-fields-dimensions',
			'type'           => 'dimensions',
			'units'          => array( 'em', 'px', '%' ),    // You can specify a unit value. Possible: px, em, %
			'units_extended' => 'true',  // Allow users to select any type of unit
			'title'          => __( 'Fields padding', 'redux-framework-demo' ),
			'subtitle'       => __( '', 'redux-framework-demo' ),
			'desc'           => __( '', 'redux-framework-demo' ),
			'default'        => array(
				'width'  => 15,
				'height' => 5,
			)
		),
		array(
			'id'       => 'checkout-fields-allmax',
			'type'     => 'select',
			'title'    => __( 'Fields Width', 'redux-framework-demo' ),
			'subtitle' => __( 'Use the same width for all fields?', 'redux-framework-demo' ),
			'options'  => array(
				'no'	=> 'No',
				'yes'	=> 'Yes',
			),
		),
	),
	
) );
Redux::setSection( $opt_name, array(
	'title'            => __( 'Labels', 'migwoo_enhancer' ),
	'id'               => 'checkout-page-labels',
	'desc'             => __( '', 'redux-framework-demo' ),
	'customizer_width' => '',
	'subsection'	=> true,
	'fields'	=> array(
		array(
			'id'       => 'billing_first_name_label',
			'type'     => 'text',
			'title'    => __( 'First Name', 'redux-framework-demo' ),
		),
		array(
			'id'       => 'billing_last_name_label',
			'type'     => 'text',
			'title'    => __( 'Last Name', 'redux-framework-demo' ),
		),
		array(
			'id'       => 'billing_company_label',
			'type'     => 'text',
			'title'    => __( 'Company', 'redux-framework-demo' ),
		),
		array(
			'id'       => 'billing_address_1_label',
			'type'     => 'text',
			'title'    => __( 'Address', 'redux-framework-demo' ),
		),
		array(
			'id'       => 'billing_city_label',
			'type'     => 'text',
			'title'    => __( 'City', 'redux-framework-demo' ),
		),
		array(
			'id'       => 'billing_postcode_label',
			'type'     => 'text',
			'title'    => __( 'Postcode', 'redux-framework-demo' ),
		),
		array(
			'id'       => 'billing_country_label',
			'type'     => 'text',
			'title'    => __( 'Country', 'redux-framework-demo' ),
		),
		array(
			'id'       => 'billing_state_label',
			'type'     => 'text',
			'title'    => __( 'Fields Width', 'redux-framework-demo' ),
		),
		array(
			'id'       => 'billing_email_label',
			'type'     => 'text',
			'title'    => __( 'Email', 'redux-framework-demo' ),
		),
		array(
			'id'       => 'billing_phone_label',
			'type'     => 'text',
			'title'    => __( 'Phone', 'redux-framework-demo' ),
		),
	),
	
) );


Redux::setSection( $opt_name, array(
	'title'      => __( 'Billing Fields', 'redux-framework-demo' ),
	'id'         => 'checkout_billing_fields_sorter',
	'class'		=> 'migwoo_enhancer_full_sorter',
	'desc'       => __( '', 'redux-framework-demo' ),
	'class' => 'migwoo_sorter_section',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'checkout-billing-fields',
			'type'     => 'sorter',
			'title'    => 'Billing Fields',
			'subtitle' => 'Drag and drop the fields inside the proper column',
			'compiler' => 'true',
			'options'  => array(
				'enabled'  => array(
					'billing_first_name' => 'First Name',
					'billing_last_name' => 'Last Name',
					'billing_company' => 'Company',
					'billing_address_1' => 'Address 1',
					'billing_address_2' => 'Address 2',
					'billing_city' => 'City',
					'billing_postcode' => 'Post Code',
					'billing_country' => 'Country',
					'billing_state' => 'State',
					'billing_email' => 'Email',
					'billing_phone' => 'Phone',
				),
				'disabled' => array(),
			),

		),
	)

) );
Redux::setSection( $opt_name, array(
	'title'      => __( 'Shipping Fields', 'redux-framework-demo' ),
	'id'         => 'checkout_shipping_fields_sorter',
	'class'		=> 'migwoo_enhancer_full_sorter',
	'desc'       => __( '', 'redux-framework-demo' ),
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'checkout-shipping-fields',
			'type'     => 'sorter',
			'title'    => 'Shipping Fields',
			'subtitle' => 'Drag and drop the fields inside the proper column',
			'compiler' => 'true',
			'options'  => array(
				'enabled'  => array(
					'shipping_first_name' => 'First Name',
					'shipping_last_name' => 'Last Name',
					'shipping_company' => 'Company',
					'shipping_address_1' => 'Address One',
					'shipping_address_2' => 'Address Two',
					'shipping_city' => 'City',
					'shipping_postcode' => 'Postcode',
					'shipping_country' => 'Country',
					'shipping_state' => 'State',
				),
				'disabled' => array(),
			),

		),
	)

) );


Redux::setSection( $opt_name, array(
	'title'      => __( 'Order Notes Fields', 'redux-framework-demo' ),
	'id'         => 'checkout_ordernotes_fields_sorter',
	'class'		=> 'migwoo_enhancer_full_sorter',
	'desc'       => __( '', 'redux-framework-demo' ),
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'checkout-order-fields',
			'type'     => 'sorter',
			'title'    => 'Order Notes Fields',
			'subtitle' => 'Drag and drop the fields inside the proper column',
			'compiler' => 'true',
			'options'  => array(
				'enabled'  => array(
					'order_comments' => 'Order Notes',
				),
				'disabled' => array(),
			),

		),
	)

) );
Redux::setSection( $opt_name, array(
	'title'      => __( 'Additional', 'redux-framework-demo' ),
	'id'         => 'checkout_additional_options',
	'class'		=> 'migwoo_enhancer_full_sorter',
	'desc'       => __( '', 'redux-framework-demo' ),
	'subsection' => true,
	'fields'     => array(
		 array(
			'id'       => 'checkout-custom-message',
			'type'     => 'editor',
			'title'    => __( 'Add a custom message in your checkout page', 'redux-framework-demo' ),
			'subtitle' => __( 'This message it will be displayed above ', 'redux-framework-demo' ),
			'default'  => '',
		),
	)

) );



?>