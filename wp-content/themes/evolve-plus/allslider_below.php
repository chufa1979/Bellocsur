<?php
/*
 *
 * Template: allslider.php
 *
 */
?>
<div class="sliderblock1">

    <?php
    global $evl_options, $evl_frontpage_slider_status;
    $evolve_slider_page_id = '';
    $evl_frontpage_slider = array();

    if (!empty($post->ID)) {
        if (!is_home() && !is_front_page() && !is_archive()) {
            $evolve_slider_page_id = $post->ID;
        }
        if (!is_home() && is_front_page()) {
            $evolve_slider_page_id = $post->ID;
        }
    }
    if (is_home() && !is_front_page()) {
        $evolve_slider_page_id = get_option('page_for_posts');
    }

    if ( !isset( $evl_frontpage_slider_status['other'] ) ) { 
    // LayerSlider Slider
        if (get_post_meta($evolve_slider_page_id, 'evolve_slider_type', true) == 'layer'):
            $evolve_layerslider = evolve_get_option('evl_layerslider', '1');
            if ($evolve_layerslider == "1"):
                evolve_layerslider();
            endif;
        endif;

    // Revolution Slider
        if (get_post_meta($evolve_slider_page_id, 'evolve_slider_type', true) == 'rev' && get_post_meta($evolve_slider_page_id, 'evolve_revslider', true) && function_exists('putRevSlider')) {
            putRevSlider(get_post_meta($evolve_slider_page_id, 'evolve_revslider', true));
        }

    // Theme4press Slider
        if (get_post_meta($evolve_slider_page_id, 'evolve_slider_type', true) == 'flex' && !is_product() && (get_post_meta($evolve_slider_page_id, 'evolve_wooslider', true) || get_post_meta($evolve_slider_page_id, 'evolve_wooslider', true) != 0)) {
            evolve_wooslider(get_post_meta($evolve_slider_page_id, 'evolve_wooslider', true));
            evolve_woosliderfunc(get_post_meta($evolve_slider_page_id, 'evolve_wooslider', true));
        }
    }

    //Bootstrap, Parallax & Posts Slider
        if ( isset($evl_options['evl_front_elements_header_area']['enabled']) )
            $evl_frontpage_slider = $evl_options['evl_front_elements_header_area']['enabled'];
            $evl_frontpage_slider_status;
        if ($evl_frontpage_slider):
                foreach ($evl_frontpage_slider as $sliderkey => $sliderval) {
                        switch ($sliderkey) {
                                case 'bootstrap_slider':
                                        if ( $sliderval && !isset( $evl_frontpage_slider_status['bootstrap'] ) ) {
                                                fp_bootstrap_slider();
                                        }
                                break;
                                case 'parallax_slider':
                                        if ( $sliderval && !isset( $evl_frontpage_slider_status['parallax'] ) ) {
                                                fp_parallax_slider();
                                        }
                                break;
                                case 'posts_slider':
                                        if ( $sliderval && !isset( $evl_frontpage_slider_status['posts'] ) ) {
                                                fp_post_slider();
                                        }
                                break;
                        }
                }
        endif;
    ?>
</div><!--/.sliderblock-->
