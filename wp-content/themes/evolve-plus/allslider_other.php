<?php
/*
 *
 * Template: allslider.php
 *
 */
?>
<div class="sliderblock">
    <?php
    global $evl_frontpage_slider_status;
    $evolve_slider_page_id = '';
    $evolve_page_ID = get_queried_object_id();
    $evolve_slider_position = evolve_get_option('evl_slider_position', 'below');
    $evolve_current_post_slider_position = get_post_meta($evolve_page_ID, 'evolve_slider_position', true);
    $evolve_current_post_slider_position = empty($evolve_current_post_slider_position) ? 'default' : $evolve_current_post_slider_position;
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

    if ( ($evolve_current_post_slider_position == 'above') || ($evolve_current_post_slider_position == 'default' && $evolve_slider_position == 'above') ) {
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
        
        $evl_frontpage_slider_status['other'] = false;
    }
    ?>
</div><!--/.sliderblock-->
