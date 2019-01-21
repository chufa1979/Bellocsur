<?php 
Redux::setSection( $opt_name, array(
        'title'            => __( 'Account Page', 'migwoo_enhancer' ),
        'id'               => 'account-page',
        'desc'             => __( '', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-torso'
    ) );
	
	
	Redux::setSection( $opt_name, array(
        'title'      => __( 'Design', 'redux-framework-demo' ),
        'id'         => 'account-page-design',
        'desc'       => __( '', 'redux-framework-demo' ),
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'activate-account-design',
                'type'     => 'checkbox',
                'title'    => __( 'Activate Account design options', 'redux-framework-demo' ),
                'subtitle' => __( 'this prevents override your default styles/functions without aprobation', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'default'  => '0'
            ),
			array(
                'id'       => 'account-link-color',
                'type'     => 'link_color',
                'title'    => __( 'menu links color', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'regular'   => true, // Disable Regular Color
                'hover'     => true, // Disable Hover Color
                'active'    => false, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                
            ),
			array(
                'id'       => 'account-link-background-color',
                'type'     => 'link_color',
                'title'    => __( 'menu links background color', 'redux-framework-demo' ),
                'subtitle' => __( '', 'redux-framework-demo' ),
                'desc'     => __( '', 'redux-framework-demo' ),
                'regular'   => true, // Disable Regular Color
                'hover'     => true, // Disable Hover Color
                'active'    => false, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                
            ),
			array(
                'id'             => 'account-links-dimensions',
                'type'           => 'dimensions',
                'units'          => array( 'em', 'px', '%' ),    // You can specify a unit value. Possible: px, em, %
                'units_extended' => 'true',  // Allow users to select any type of unit
                'title'          => __( 'Menu links padding', 'redux-framework-demo' ),
                'subtitle'       => __( '', 'redux-framework-demo' ),
                'desc'           => __( '', 'redux-framework-demo' ),
                'default'        => array(
                    'width'  => 20,
                    'height' => 10,
                )
            ),
			
			array(
                'id'             => 'account-links-width',
                'type'           => 'select',
                'title'          => __( 'Menu links fixed width', 'redux-framework-demo' ),
                'subtitle'       => __( '', 'redux-framework-demo' ),
                'desc'           => __( '', 'redux-framework-demo' ),
                'options'        => array(
                    'no'  => 'No',
                    'yes' => 'Yes',
                )
            ),
			
			array(
                'id'             => 'account-links-width-size',
                'type'           => 'dimensions',
                'units'          => array( 'em', 'px', '%' ),    // You can specify a unit value. Possible: px, em, %
                'units_extended' => 'true',  // Allow users to select any type of unit
                'title'          => __( 'Fixed width size', 'redux-framework-demo' ),
                'subtitle'       => __( '', 'redux-framework-demo' ),
                'desc'           => __( '', 'redux-framework-demo' ),
                'height'		 => false,
				'default'        => array(
                    'width'  => 200,
                )
            ),
		 )

    ) );
?>