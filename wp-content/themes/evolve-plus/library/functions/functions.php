<?php

/**
 * Functions - general template functions that are used throughout EvoLve
 *
 * @package evolve
 * @subpackage Functions
 */
function evolve_media() {
    global $evl_options;
    $evolve_template_url = get_template_directory_uri();

    $evolve_css_data = '';

    $evolve_pagination_type = evolve_get_option('evl_pagination_type', 'pagination');
    $evolve_pos_button = evolve_get_option('evl_pos_button', 'right');
    $evolve_carousel_slider = evolve_get_option('evl_carousel_slider', '1');
    $evolve_parallax_slider = evolve_get_option('evl_parallax_slider_support', '1');
    $evolve_status_gmap = evolve_get_option('evl_status_gmap', '1');
    $evolve_recaptcha_public = evolve_get_option('evl_recaptcha_public', '');
    $evolve_recaptcha_private = evolve_get_option('evl_recaptcha_private', '');
    $evolve_fontawesome = evolve_get_option('evl_fontawesome', '0');
    $evolve_responsive_menu = evolve_get_option('evl_responsive_menu', 'icon');
    $evolve_responsive_menu_layout = evolve_get_option('evl_responsive_menu_layout', 'basic');
    $evolve_google_map_api = evolve_get_option('evl_google_map_api', '');
	$evolve_footer_reveal = evolve_get_option('evl_footer_reveal');

    if (is_admin())
        return;

    wp_enqueue_script('jquery');

    $evolve_animatecss = evolve_get_option('evl_animatecss', '1');

    if ($evolve_animatecss == "1") {
        wp_enqueue_style('animatecss', get_template_directory_uri() . '/assets/css/animate-css/animate-custom.min.css');
    }

    if ($evolve_parallax_slider == "1") {
        wp_enqueue_script('parallax', EVOLVEJS . '/parallax/parallax.min.js');
        wp_enqueue_style('parallaxcss', EVOLVEJS . '/parallax/parallax.min.css');
        wp_enqueue_script('modernizr', EVOLVEJS . '/parallax/modernizr.min.js');
    }

    if ($evolve_carousel_slider == "1") {
        wp_enqueue_script('carousel', EVOLVEJS . '/carousel.min.js');
    }
    wp_enqueue_script('tipsy', EVOLVEJS . '/tipsy.min.js');
    wp_enqueue_script('fields', EVOLVEJS . '/fields.min.js');
    //if ($evolve_pagination_type == "infinite") {
    wp_enqueue_script('jscroll', EVOLVEJS . '/jquery.infinite-scroll.min.js');
    //}
    
    if ($evolve_pos_button == "disable" || $evolve_pos_button == "") {
        
    } else {
        wp_enqueue_script('jquery_scroll', EVOLVEJS . '/jquery.scroll.pack.min.js');
    }
    wp_enqueue_script('supersubs', EVOLVEJS . '/supersubs.min.js');
    wp_enqueue_script('superfish', EVOLVEJS . '/superfish.min.js');
    wp_enqueue_script('buttons', EVOLVEJS . '/buttons.min.js');
    wp_enqueue_script('ddslick', EVOLVEJS . '/ddslick.min.js');
    wp_enqueue_script('meanmenu', EVOLVEJS . '/jquery.meanmenu.min.js');
    wp_enqueue_script('flexslidermin', EVOLVEJS . '/jquery.flexslider.min.js');
    wp_enqueue_script('prettyphoto', EVOLVEJS . '/jquery.prettyPhoto.min.js');
    wp_enqueue_script('modernizr-2', EVOLVEJS . '/modernizr.min.js');
    wp_enqueue_script('carouFredSel', EVOLVEJS . '/jquery.carouFredSel.min.js');
    wp_enqueue_script('main', EVOLVEJS . '/main.min.js', array(), '', true);
    wp_enqueue_script('main_backend', EVOLVEJS . '/main_backend.min.js', array(), '', true);
    $ubermenu_status_gmap = '';
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if (is_plugin_active('ubermenu/ubermenu.php')) {
        $ubermenu_general = get_option('ubermenu_general');
        if (isset($ubermenu_general['load_google_maps'])):
            $ubermenu_status_gmap = $ubermenu_general['load_google_maps'];
        endif;
    }

    if ($ubermenu_status_gmap == 'on') {

        function evolve_gmap() {
            wp_enqueue_script('gmap', EVOLVEJS . '/gmap.min.js', array(), '', true);
        }

        add_action('wp_footer', 'evolve_gmap');
    } else {
        if ($evolve_status_gmap == "1") {
            wp_enqueue_script('googlemaps', '//maps.googleapis.com/maps/api/js?key=' . $evolve_google_map_api . '&amp;language=' . mb_substr(get_locale(), 0, 2));
            wp_enqueue_script('gmap', EVOLVEJS . '/gmap.min.js', array(), '', true);
        }
    }

    if ($evolve_recaptcha_public && $evolve_recaptcha_private) {
        wp_enqueue_script('googlerecaptcha', 'https://www.google.com/recaptcha/api.js');
    }
	
    if ($evolve_footer_reveal == '1') {
	wp_enqueue_script('footer-reveal', get_template_directory_uri() . '/library/media/js/footer-reveal.min.js' ,array( 'jquery' ), '', true);
	wp_enqueue_script('footer-reveal-fix', get_template_directory_uri() . '/library/media/js/footer-reveal-fix.min.js', array( 'jquery' ), '', true);
    wp_enqueue_style('footer-revealcss', get_template_directory_uri() . '/assets/css/footer-reveal.min.css');
	}			

    if ($evolve_fontawesome != "1") {
    // FontAwesome 
        wp_enqueue_style('fontawesomecss', get_template_directory_uri() . '/assets/fonts/fontawesome/css/font-awesome.min.css', false);
    }

    function evolve_woosliderfunc($term) {
        global $slider_settings;
        $term_details = get_term_by('slug', $term, 'slide-page');
        $slider_settings = get_option('taxonomy_' . $term_details->term_id);

        $slider_local_variables = array(
            'slide_show_speed' => $slider_settings['slideshow_speed'],
            'slide_animation' => $slider_settings['animation'],
            'slide_animation_speed' => $slider_settings['animation_speed'],
            'slide_auto_play' => ($slider_settings['autoplay'] == 1 ? true : false),
            'slide_nav_arrows' => ($slider_settings['nav_arrows'] == 1 ? true : false),
            'slide_pagination_circles' => ($slider_settings['pagination_circles'] == 1 ? true : false),
            'slide_loop' => ($slider_settings['loop'] == 1 ? true : false),
        );

        wp_localize_script('main', 'js_local_vars', $slider_local_variables);
    }

    // Main Stylesheet
    function evolve_styles() {

        wp_enqueue_style('maincss', get_stylesheet_uri(), false);

        require_once( get_template_directory() . '/custom-css.min.php' );
        wp_add_inline_style('bootstrapcsstheme', $evolve_css_data);

        $evolve_header_type = evolve_get_option('evl_header_type', 'none');
        switch ($evolve_header_type) {
            case "none":
                require_once( get_template_directory() . '/assets/css/header1.min.php' );
                break;
            case "h1":
                require_once( get_template_directory() . '/assets/css/header2.min.php' );
                break;
            case "h2":
                require_once( get_template_directory() . '/assets/css/header3.min.php' );
                break;
            case "h3":
                require_once( get_template_directory() . '/assets/css/header4.min.php');
                break;
            case "h4":
                require_once( get_template_directory() . '/assets/css/header5.min.php');
                break;
            case "h5":
                require_once( get_template_directory() . '/assets/css/header6.min.php');
                break;
        }
        wp_add_inline_style('bootstrapcsstheme', $evolve_css_data);
	wp_enqueue_style('meanmenu', get_template_directory_uri() . '/assets/css/shortcode/meanmenu.min.css');
    }

    add_action('wp_enqueue_scripts', 'evolve_styles');


    if (defined('ICL_LANGUAGE_CODE')) {
        $language_code = ICL_LANGUAGE_CODE;
    } else {
        $language_code = '';
    }

    if ($evolve_responsive_menu == 'icon') {
        $evolve_responsive_menu = '<span class="t4p-icon-menu"></span>';
    } elseif ($evolve_responsive_menu == 'text') {
        $evolve_responsive_menu = evolve_get_option('evl_responsive_menu_text', 'Menu');
    } else {
        $evolve_responsive_menu = '';
    }

    //$evl_portfolio_pagination_type = isset($evl_options['evl_portfolio_pagination_type']) ? $evl_options['evl_portfolio_pagination_type'] : '';
    $local_variables = array(
        'mobile_nav_cart' => __('Shopping Cart', 'evolve'),
        'language_flag' => $language_code,
        'testimonials_speed' => $evl_options['evl_shortcode_testimonial_speed'],
        'infinite_blog_finished_msg' => '<em>' . __('All posts displayed', 'evolve') . '</em>',
        'infinite_blog_text' => '<em>' . __('Loading the next set of posts...', 'evolve') . '</em>',
        'portfolio_loading_text' => '<em>' . __('Loading Portfolio Items...', 'evolve') . '</em>',
        'theme_url' => get_template_directory_uri(),
        //'blog_pagination_type'			=> $evl_portfolio_pagination_type,			
        'order_actions' => __('Details', 'evolve'),
    );

    global $woocommerce;

    if (class_exists('Woocommerce')) {
        if (version_compare($woocommerce->version, '2.3', '>=')) {
            $local_variables['woocommerce_23'] = true;
        }
    }

    wp_localize_script('main', 'js_local_vars', $local_variables);

    $responsive_menu_vars = array(
        'responsive_menu' => $evolve_responsive_menu,
        'responsive_menu_layout' => $evolve_responsive_menu_layout,
    );

    wp_localize_script('main', 'js_responsive_menu', $responsive_menu_vars);
}

/**
 * evolve_menu - adds css class to the <ul> tag in wp_page_menu.
 *
 * @since 0.3
 * @filter evolve_menu_ulclass
 * @needsdoc
 */
function evolve_menu_ulclass($ulclass) {
    $classes = apply_filters('evolve_menu_ulclass', (string) 'nav-menu'); // Available filter: evolve_menu_ulclass
    return preg_replace('/<ul>/', '<ul class="' . $classes . '">', $ulclass, 1);
}

/**
 * evolve_get_terms() Returns other terms except the current one (redundant)
 *
 * @since 0.2.3
 * @usedby evolve_entry_footer()
 */
function evolve_get_terms($term = NULL, $glue = ', ') {
    if (!$term)
        return;

    $separator = "\n";
    switch ($term):
        case 'cats':
            $current = single_cat_title('', false);
            $terms = get_the_category_list($separator);
            break;
        case 'tags':
            $current = single_tag_title('', '', false);
            $terms = get_the_tag_list('', "$separator", '');
            break;
    endswitch;
    if (empty($terms))
        return;

    $thing = explode($separator, $terms);
//    foreach ($thing as $i => $str) {
//        if (strstr($str, ">$current<")) {
//            unset($thing[$i]);
//            break;
//        }
//    }
    if (empty($thing))
        return false;

    return trim(join($glue, $thing));
}

/**
 * evolve_get Gets template files
 *
 * @since 0.2.3
 * @needsdoc
 * @action evolve_get
 * @todo test this on child themes
 */
function evolve_get($file = NULL) {
    do_action('evolve_get'); // Available action: evolve_get
    $error = "Sorry, but <code>{$file}</code> does <em>not</em> seem to exist. Please make sure this file exist in <strong>" . get_stylesheet_directory() . "</strong>\n";
    $error = apply_filters('evolve_get_error', (string) $error); // Available filter: evolve_get_error
    if (isset($file) && file_exists(get_stylesheet_directory() . "/{$file}.php"))
        locate_template(get_stylesheet_directory() . "/{$file}.php");
    else
        echo $error;
}

/**
 * evolve_include_all() A function to include all files from a directory path
 *
 * @since 0.2.3
 * @credits k2
 */
function evolve_include_all($path, $ignore = false) {

    /* Open the directory */
    $dir = @dir($path) or die('Could not open required directory ' . $path);

    /* Get all the files from the directory */
    while (( $file = $dir->read() ) !== false) {
        /* Check the file is a file, and is a PHP file */
        if (is_file($path . $file) and ( !$ignore or ! in_array($file, $ignore) ) and preg_match('/\.php$/i', $file)) {
            require_once( $path . $file );
        }
    }
    $dir->close(); // Close the directory, we're done.
}

/**
 * Remove title attribute from menu
 * 
 */
function evolve_my_menu_notitle($menu) {
    return $menu = preg_replace('/ title=\"(.*?)\"/', '', $menu);
}

add_filter('wp_nav_menu', 'evolve_my_menu_notitle');

/**
 * reCaptcha Class
 *
 * @recaptcha 2
 * @since 1.7.9
 */
class evolve_GoogleRecaptcha {
    /* Google recaptcha API url */

    public function VerifyCaptcha($response) {

        $response = isset($_POST['g-recaptcha-response']) ? esc_attr($_POST['g-recaptcha-response']) : '';
        $remote_ip = $_SERVER["REMOTE_ADDR"];
        $secret = evolve_get_option('evl_recaptcha_private', '');
        $request = wp_remote_get('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $response . '&remoteip=' . $remote_ip);
        $response_body = wp_remote_retrieve_body($request);
        $res = json_decode($response_body, TRUE);
        if ($res['success'] == 'true')
            return TRUE;
        else
            return FALSE;
    }

}


function evolve_element_to_shortcode() {
        $response = array();
        $evl_options = get_option('evl_options', false);
        $shortcode = '';
        $evl_frontpage_elements = array();

        // Convert shortcode from element
        if ( isset($evl_options['evl_front_elements_content_area']['enabled']) )
            $evl_frontpage_elements = $evl_options['evl_front_elements_content_area']['enabled'];

        if ($evl_frontpage_elements):
                foreach ($evl_frontpage_elements as $elementkey => $elementval) {
                        switch ($elementkey) {
                                case 'content_box':
                                        $shortcode .= '';
                                break;
                                case 'testimonial':
                                        $shortcode .= evolve_testimonials_convert();
                                break;
                                case 'blog_post':
                                        $shortcode .= evolve_blog_posts_convert();
                                break;
                                case 'google_map':
                                        $shortcode .= evolve_google_map_convert();
                                break;
                                case 'woocommerce_product':
                                        $shortcode .= '';
                                break;
                                case 'counter_circle':
                                        $shortcode .= evolve_counter_circle_convert();
                                break;
                                case 'custom_content':
                                        $shortcode .= evolve_custom_content_convert();
                                break;
                        }
                }
        endif;

        // Add shortcode in selected page
        $post_id = $_POST['evolve_pageid'];
        $t4p_composer_content = get_post_meta( $post_id, '_t4p_page_builder_content', true );
        if ( $t4p_composer_content ) {
                $shortcode = "[row][column]{$shortcode}[/column][/row]";
                $post_content = $t4p_composer_content.$shortcode;
                update_post_meta( $post_id, '_t4p_page_builder_content', $post_content );
        } else {
                $current_post = get_post( $post_id, 'ARRAY_A' );
                $current_post['post_content'] = $current_post['post_content'].$shortcode;
                wp_update_post($current_post);
        }
        update_post_meta( $post_id, '_wp_page_template', '100-width.php' );
        update_post_meta( $post_id, 'evolve_hundredp_padding', '0px' );

        $response['status'] .= '<div id="setting-error-settings_updated" class="updated settings-error convertsc_succ_msg"><p>';
        $response['status'] .= __( 'The elements have been successfully converted and imported in the page', 'evolve' );
        $response['status'] .= "</p></div>";

        $page_title = get_the_title( $post_id ); 
        $view = get_post_permalink( $post_id );
        $edit = get_edit_post_link( $post_id );
		
		$previewurl_keys['post'] = $post_id;
        $previewurl_keys['t4p_pb'] = 'livepagebuilder_editor';
        $edit_composer = set_url_scheme( add_query_arg( $previewurl_keys, get_permalink( $previewurl_keys['post'] ) ) );		
		
        $response['status'] .= '<div id="setting-error-settings_updated" class="updated settings-error show_page_link"><p>';
        $response['status'] .= '<a target="_blank" href="' . $view . '">' . __( 'View '.$page_title.' page', 'evolve' ) . '</a>';
        $response['status'] .= ' | ';
        $response['status'] .= '<a target="_blank" href="' . $edit . '">' . __( 'Edit '.$page_title.' page in classic editor', 'evolve' ) . '</a>';
		
        if ( is_plugin_active('t4p-core-composer/t4p-core.php') ) {
        $response['status'] .= ' | ';
        $response['status'] .= '<a target="_blank" href="' . $edit_composer . '">' . __( 'Edit '.$page_title.' page in Theme4Press Composer', 'evolve' ) . '</a>';		
        }				
        $response['status'] .= '</p></div>';		

        // Encode response.
        $response_json = wp_json_encode( $response );

        // Send the response.
        header( 'Content-Type: application/json' );
        echo $response_json;

        exit;
}
add_action( "wp_ajax_evolve_element_to_shortcode", 'evolve_element_to_shortcode');