<?php

/* Front Page Content Boxes */
function evolve_content_boxes() {
    $evolve_content_boxes = evolve_get_option('evl_content_boxes', '1');
    if ($evolve_content_boxes == "1") {
        global $evl_options;

        $evolve_content_box1_enable = evolve_get_option('evl_content_box1_enable', '1');
        if ($evolve_content_box1_enable === false) {
            $evolve_content_box1_enable = '';
        }
        $evolve_content_box2_enable = evolve_get_option('evl_content_box2_enable', '1');
        if ($evolve_content_box2_enable === false) {
            $evolve_content_box2_enable = '';
        }
        $evolve_content_box3_enable = evolve_get_option('evl_content_box3_enable', '1');
        if ($evolve_content_box3_enable === false) {
            $evolve_content_box3_enable = '';
        }
        $evolve_content_box4_enable = evolve_get_option('evl_content_box4_enable', '1');
        if ($evolve_content_box4_enable === false) {
            $evolve_content_box4_enable = '';
        }

        $evolve_content_boxes_section_padding_top         = $evl_options['evl_content_boxes_section_padding']['padding-top'];
        $evolve_content_boxes_section_padding_bottom      = $evl_options['evl_content_boxes_section_padding']['padding-bottom'];
        $evolve_content_boxes_section_padding_left        = $evl_options['evl_content_boxes_section_padding']['padding-left'];
        $evolve_content_boxes_section_padding_right       = $evl_options['evl_content_boxes_section_padding']['padding-right'];
        $evolve_content_boxes_section_back_color          = evolve_get_option( 'evl_content_boxes_section_back_color', '' );
        $evolve_content_boxes_section_image_src           = evolve_get_option('evl_content_boxes_section_background_image');
        $evolve_content_boxes_section_image               = evolve_get_option('evl_content_boxes_section_image', 'cover');
        $evolve_content_boxes_section_background_repeat   = evolve_get_option('evl_content_boxes_section_image_background_repeat', 'no-repeat');
        $evolve_content_boxes_section_background_position = evolve_get_option('evl_content_boxes_section_image_background_position', 'center top');
        $evolve_content_boxes_section_background_parallax = evolve_get_option('evl_content_boxes_section_background_parallax', '0');

        $evolve_content_box_section_title = evolve_get_option('evl_content_boxes_title', 'evolve comes with amazing features which will blow your mind');
        if ($evolve_content_box_section_title == false) {
            $evolve_content_box_section_title = '';
        } else {
            $evolve_content_box_section_title = '<h2 class="content_box_section_title section_title">'.evolve_get_option('evl_content_boxes_title', 'evolve comes with amazing features which will blow your mind').'</h2>';
        }

        //html_attr
        $html_class = 't4p-fullwidth fullwidth-box hentry';
        $html_style = '';

        if( $evolve_content_boxes_section_background_parallax ) {
                $html_style .= 'background-attachment:fixed;';
        }

        if( $evolve_content_boxes_section_back_color ) {
                $html_style .= sprintf( 'background-color:%s;', $evolve_content_boxes_section_back_color );
        }

        if ( isset($evolve_content_boxes_section_image_src['url']) && $evolve_content_boxes_section_image_src['url'] ) {
                $html_style .= sprintf( 'background-image: url(%s);', $evolve_content_boxes_section_image_src['url'] );
        }

        if( $evolve_content_boxes_section_image ) {
                $html_style .= sprintf( 'background-size:%s;', $evolve_content_boxes_section_image );
                $html_style .= sprintf( '-webkit-background-size:%s;', $evolve_content_boxes_section_image );
                $html_style .= sprintf( '-moz-background-size:%s;', $evolve_content_boxes_section_image );
                $html_style .= sprintf( '-o-background-size:%s;', $evolve_content_boxes_section_image );
        }

        if( $evolve_content_boxes_section_background_position ) {
                $html_style .= sprintf( 'background-position:%s;', $evolve_content_boxes_section_background_position );
        }

        if( $evolve_content_boxes_section_background_repeat ) {
                $html_style .= sprintf( 'background-repeat:%s;', $evolve_content_boxes_section_background_repeat );
        }

        if( $evolve_content_boxes_section_padding_top ) {
                $html_style .= sprintf( 'padding-bottom:%s;', $evolve_content_boxes_section_padding_top );
        }

        if( $evolve_content_boxes_section_padding_bottom ) {
                $html_style .= sprintf( 'padding-top:%s;', $evolve_content_boxes_section_padding_bottom );
        }

        if( $evolve_content_boxes_section_padding_left ) {
                $html_style .= sprintf( 'padding-left:%s;', $evolve_content_boxes_section_padding_left );
        }

        if( $evolve_content_boxes_section_padding_right ) {
                $html_style .= sprintf( 'padding-right:%s;', $evolve_content_boxes_section_padding_right );
        }

        echo "<div class='$html_class' style='$html_style' ><div class='t4p-row'>";

        echo "<div class='home-content-boxes'><div class='row'>".$evolve_content_box_section_title;

        $evolve_content_box1_title = evolve_get_option('evl_content_box1_title', 'Flat & Beautiful');
        if ($evolve_content_box1_title === false) {
            $evolve_content_box1_title = '';
        }
        $evolve_content_box1_desc = evolve_get_option('evl_content_box1_desc', 'Clean modern theme with smooth and pixel perfect design focused on details');
        if ($evolve_content_box1_desc === false) {
            $evolve_content_box1_desc = '';
        }
        $evolve_content_box1_button = evolve_get_option('evl_content_box1_button', '<a class="read-more btn t4p-button" href="#">Learn more</a>');
        if ($evolve_content_box1_button === false) {
            $evolve_content_box1_button = '';
        }
        $evolve_content_box1_icon = evolve_get_option('evl_content_box1_icon', 'fa-cube');
        if ($evolve_content_box1_icon === false) {
            $evolve_content_box1_icon = '';
        }

        $evolve_evl_content_box1_icon_upload = evolve_get_option('evl_content_box1_icon_upload');

        /**
         * Count how many boxes are enabled on frontpage
         * Apply proper responsivity class
         *
         * @since 1.7.5
         */
        $BoxCount = 0; // Box Counter

        if ($evolve_content_box1_enable == true) {
            $BoxCount ++;
        }
        if ($evolve_content_box2_enable == true) {
            $BoxCount ++;
        }
        if ($evolve_content_box3_enable == true) {
            $BoxCount ++;
        }
        if ($evolve_content_box4_enable == true) {
            $BoxCount ++;
        }

        switch ($BoxCount):
            case $BoxCount == 1:
                $BoxClass = 'col-md-12';
                break;

            case $BoxCount == 2:
                $BoxClass = 'col-md-6';
                break;

            case $BoxCount == 3:
                $BoxClass = 'col-md-4';
                break;

            case $BoxCount == 4:
                $BoxClass = 'col-md-3';
                break;

            default:
                $BoxClass = 'col-md-3';
        endswitch;

        if ($evolve_content_box1_enable == true) {

            echo "<div class='col-sm-12 $BoxClass content-box content-box-1'>";

            if (isset($evolve_evl_content_box1_icon_upload['url']) && ( $evolve_evl_content_box1_icon_upload['url'] !== '' )) {
                echo "<img class='content_box_1_custom_icon' src='" . $evolve_evl_content_box1_icon_upload['url'] . "' height='" . $evolve_evl_content_box1_icon_upload['height'] . "' width='" . $evolve_evl_content_box1_icon_upload['width'] . "' alt=''/>";
            } else {
                echo "<i class='fa " . $evolve_content_box1_icon . "'></i>";
            }

            echo "<h2>" . esc_attr($evolve_content_box1_title) . "</h2>";

            echo "<p>" . do_shortcode($evolve_content_box1_desc) . "</p>";

            echo "<div class='cntbox_btn sbtn1'>" . do_shortcode($evolve_content_box1_button) . "</div>";

            echo "</div>";
        }

        $evolve_content_box2_title = evolve_get_option('evl_content_box2_title', 'Easy Customizable');
        if ($evolve_content_box2_title === false) {
            $evolve_content_box2_title = '';
        }
        $evolve_content_box2_desc = evolve_get_option('evl_content_box2_desc', 'Over a hundred theme options ready to make your website unique');
        if ($evolve_content_box2_desc === false) {
            $evolve_content_box2_desc = '';
        }
        $evolve_content_box2_button = evolve_get_option('evl_content_box2_button', '<a class="read-more btn t4p-button" href="#">Learn more</a>');
        if ($evolve_content_box2_button === false) {
            $evolve_content_box2_button = '';
        }
        $evolve_content_box2_icon = evolve_get_option('evl_content_box2_icon', 'fa-circle-o-notch');
        if ($evolve_content_box2_icon === false) {
            $evolve_content_box2_icon = '';
        }

        $evolve_evl_content_box2_icon_upload = evolve_get_option('evl_content_box2_icon_upload');

        if ($evolve_content_box2_enable == true) {

            echo "<div class='col-sm-12 $BoxClass content-box content-box-2'>";

            if (isset($evolve_evl_content_box2_icon_upload['url']) && ( $evolve_evl_content_box2_icon_upload['url'] !== '' )) {
                echo "<img class='content_box_2_custom_icon' src='" . $evolve_evl_content_box2_icon_upload['url'] . "' height='" . $evolve_evl_content_box2_icon_upload['height'] . "' width='" . $evolve_evl_content_box2_icon_upload['width'] . "' alt=''/>";
            } else {
                echo "<i class='fa " . $evolve_content_box2_icon . "'></i>";
            }

            echo "<h2>" . esc_attr($evolve_content_box2_title) . "</h2>";

            echo "<p>" . do_shortcode($evolve_content_box2_desc) . "</p>";

            echo "<div class='cntbox_btn sbtn2'>" . do_shortcode($evolve_content_box2_button) . "</div>";

            echo "</div>";
        }


        $evolve_content_box3_title = evolve_get_option('evl_content_box3_title', 'WooCommerce Ready');
        if ($evolve_content_box3_title === false) {
            $evolve_content_box3_title = '';
        }
        $evolve_content_box3_desc = evolve_get_option('evl_content_box3_desc', 'Start selling your products within few minutes using the WooCommerce feature');
        if ($evolve_content_box3_desc === false) {
            $evolve_content_box3_desc = '';
        }
        $evolve_content_box3_button = evolve_get_option('evl_content_box3_button', '<a class="read-more btn t4p-button" href="#">Learn more</a>');
        if ($evolve_content_box3_button === false) {
            $evolve_content_box3_button = '';
        }
        $evolve_content_box3_icon = evolve_get_option('evl_content_box3_icon', 'fa-send');
        if ($evolve_content_box3_icon === false) {
            $evolve_content_box3_icon = '';
        }

        $evolve_evl_content_box3_icon_upload = evolve_get_option('evl_content_box3_icon_upload');

        if ($evolve_content_box3_enable == true) {

            echo "<div class='col-sm-12 $BoxClass content-box content-box-3'>";

            if (isset($evolve_evl_content_box3_icon_upload['url']) && ( $evolve_evl_content_box3_icon_upload['url'] !== '' )) {
                echo "<img class='content_box_3_custom_icon' src='" . $evolve_evl_content_box3_icon_upload['url'] . "' height='" . $evolve_evl_content_box3_icon_upload['height'] . "' width='" . $evolve_evl_content_box3_icon_upload['width'] . "' alt=''/>";
            } else {
                echo "<i class='fa " . $evolve_content_box3_icon . "'></i>";
            }

            echo "<h2>" . esc_attr($evolve_content_box3_title) . "</h2>";

            echo "<p>" . do_shortcode($evolve_content_box3_desc) . "</p>";

            echo "<div class='cntbox_btn sbtn3'>" . do_shortcode($evolve_content_box3_button) . "</div>";

            echo "</div>";
        }

        $evolve_content_box4_title = evolve_get_option('evl_content_box4_title', 'Prebuilt Demos');
        if ($evolve_content_box4_title === false) {
            $evolve_content_box4_title = '';
        }
        $evolve_content_box4_desc = evolve_get_option('evl_content_box4_desc', 'Drag & Drop front page builder with many demos just perfect to start your new project');
        if ($evolve_content_box4_desc === false) {
            $evolve_content_box4_desc = '';
        }
        $evolve_content_box4_button = evolve_get_option('evl_content_box4_button', '<a class="read-more btn t4p-button" href="#">Learn more</a>');
        if ($evolve_content_box4_button === false) {
            $evolve_content_box4_button = '';
        }
        $evolve_content_box4_icon = evolve_get_option('evl_content_box4_icon', 'fa-tablet');
        if ($evolve_content_box4_icon === false) {
            $evolve_content_box4_icon = '';
        }

        $evolve_evl_content_box4_icon_upload = evolve_get_option('evl_content_box4_icon_upload');

        if ($evolve_content_box4_enable == true) {

            echo "<div class='col-sm-12 $BoxClass content-box content-box-4'>";

            if (isset($evolve_evl_content_box4_icon_upload['url']) && ( $evolve_evl_content_box4_icon_upload['url'] !== '' )) {
                echo "<img class='content_box_4_custom_icon' src='" . $evolve_evl_content_box4_icon_upload['url'] . "' height='" . $evolve_evl_content_box4_icon_upload['height'] . "' width='" . $evolve_evl_content_box4_icon_upload['width'] . "' alt=''/>";
            } else {
                echo "<i class='fa " . $evolve_content_box4_icon . "'></i>";
            }

            echo "<h2>" . esc_attr($evolve_content_box4_title) . "</h2>";

            echo "<p>" . do_shortcode($evolve_content_box4_desc) . "</p>";

            echo "<div class='cntbox_btn sbtn4'>" . do_shortcode($evolve_content_box4_button) . "</div>";

            echo "</div>";
        }
        echo "</div></div><div class='clearfix'></div></div></div>";
    }
}

/* Front Page Testimonials */
function evolve_testimonials() {
    $mainshortcode = evolve_testimonials_convert();

    $html = do_shortcode( $mainshortcode );

    echo $html;
}
function evolve_testimonials_convert() {
    global $evl_options;

    $evolve_testimonials_section_padding_top            = $evl_options['evl_testimonials_section_padding']['padding-top'];
    $evolve_testimonials_section_padding_bottom         = $evl_options['evl_testimonials_section_padding']['padding-bottom'];
    $evolve_testimonials_section_padding_left           = $evl_options['evl_testimonials_section_padding']['padding-left'];
    $evolve_testimonials_section_padding_right          = $evl_options['evl_testimonials_section_padding']['padding-right'];
    $evolve_testimonials_section_back_color             = evolve_get_option( 'evl_testimonials_section_back_color', '' );
    $evolve_testimonials_section_image_src              = evolve_get_option('evl_testimonials_section_background_image');
    $evolve_testimonials_section_image                  = evolve_get_option('evl_testimonials_section_image', 'cover');
    $evolve_testimonials_section_background_repeat      = evolve_get_option('evl_testimonials_section_image_background_repeat', 'no-repeat'); 
    $evolve_testimonials_section_background_position    = evolve_get_option('evl_testimonials_section_image_background_position', 'center top');
    $evolve_testimonials_section_background_parallax   = evolve_get_option('evl_testimonials_section_background_parallax', '0');

    if ( isset($evolve_testimonials_section_image_src['url']) && $evolve_testimonials_section_image_src['url'] ) {
        $evolve_testimonials_section_image_src = $evolve_testimonials_section_image_src['url'];
    }else{
        $evolve_testimonials_section_image_src = '';
    }

    if ( $evolve_testimonials_section_background_parallax ) {
        $evolve_testimonials_section_background_parallax = 'fixed';
    } else {
        $evolve_testimonials_section_background_parallax = 'scroll';
    }

    $evolve_testimonials_section_title = evolve_get_option('evl_testimonials_title', 'Why people love our themes');
    if ($evolve_testimonials_section_title == false) {
        $evolve_testimonials_section_title = '';
    } else {
        $evolve_testimonials_section_title = '<h2 class="testimonials_section_title section_title">'.evolve_get_option('evl_testimonials_title', 'Why people love our themes').'</h2>';

    }

    $shortcode = get_testimonials_shortcode();
    
    $mainshortcode = '[fullwidth backgroundcolor="'.$evolve_testimonials_section_back_color.'" backgroundimage="'.$evolve_testimonials_section_image_src.'" backgroundsize="'.$evolve_testimonials_section_image.'" backgroundrepeat="'.$evolve_testimonials_section_background_repeat.'" backgroundposition="'.$evolve_testimonials_section_background_position.'" backgroundattachment="'.$evolve_testimonials_section_background_parallax.'" paddingtop="'.$evolve_testimonials_section_padding_top.'" paddingbottom="'.$evolve_testimonials_section_padding_bottom.'" paddingleft="'.$evolve_testimonials_section_padding_left.'" paddingright="'.$evolve_testimonials_section_padding_right.'" ]'.$evolve_testimonials_section_title.$shortcode.'[/fullwidth]';

    return $mainshortcode;
}
function get_testimonials_shortcode() {
    global $evl_options;

    $backgroundcolor = $evl_options["evl_fp_testimonials_bg_color"];
    $textcolor = $evl_options["evl_fp_testimonials_text_color"];
    $slides = evolve_get_option("testimonial_slides", array());
    $sub_shortcode = '';

    if (isset($slides['enabled'])) {
        foreach ($slides['enabled'] as $i => $enabled) {
            if ($enabled == 1) {
                $name  = $slides["title"][$i];
                $avatar = 'image';
                $image = $slides["image"][$i]['url'];
                $company = '';
                $link = '';
                $target = '_self';
                $content = $slides["description"][$i];

                $sub_shortcode .= '[testimonial name="'.$name.'" avatar="'.$avatar.'" image="'.$image.'" image_button="" company="'.$company.'" link="'.$link.'" target="'.$target.'" ]'.$content.'[/testimonial]';
            }
        }
    }

    return '[testimonials el_title="" backgroundcolor="'.$backgroundcolor.'" textcolor="'.$textcolor.'" class="" id="" disabled_el="no" div_margin_top="0" div_margin_left="0" div_margin_bottom="0" div_margin_right="0" ]'.$sub_shortcode.'[/testimonials]';
}

/* Front Page Counter Circle */
function evolve_counter_circle() {
    $mainshortcode = evolve_counter_circle_convert();

    $html = do_shortcode( $mainshortcode );

    echo $html;
}
function evolve_counter_circle_convert() {
    global $evl_options;

    $evolve_counter_circle_section_padding_top          = $evl_options['evl_counter_circle_section_padding']['padding-top'];
    $evolve_counter_circle_section_padding_bottom       = $evl_options['evl_counter_circle_section_padding']['padding-bottom'];
    $evolve_counter_circle_section_padding_left         = $evl_options['evl_counter_circle_section_padding']['padding-left'];
    $evolve_counter_circle_section_padding_right        = $evl_options['evl_counter_circle_section_padding']['padding-right'];
    $evolve_counter_circle_section_back_color           = evolve_get_option( 'evl_counter_circle_section_back_color', '' );
    $evolve_counter_circle_section_image_src            = evolve_get_option('evl_counter_circle_section_background_image');
    $evolve_counter_circle_section_image                = evolve_get_option('evl_counter_circle_section_image', 'cover');
    $evolve_counter_circle_section_background_repeat    = evolve_get_option('evl_counter_circle_section_image_background_repeat', 'no-repeat');
    $evolve_counter_circle_section_background_position  = evolve_get_option('evl_counter_circle_section_image_background_position', 'center top');
    $evolve_counter_circle_section_background_parallax   = evolve_get_option('evl_counter_circle_section_background_parallax', '0');

    if ( isset($evolve_counter_circle_section_image_src['url']) && $evolve_counter_circle_section_image_src['url'] ) {
        $evolve_counter_circle_section_image_src = $evolve_counter_circle_section_image_src['url'];
    }else{
        $evolve_counter_circle_section_image_src = '';
    }

    if ( $evolve_counter_circle_section_background_parallax ) {
        $evolve_counter_circle_section_background_parallax = 'fixed';
    } else {
        $evolve_counter_circle_section_background_parallax = 'scroll';
    }
    
    $evolve_counter_circle_section_title = evolve_get_option('evl_counter_circle_title', 'Cooperation with many great brands is our mission');
    if ($evolve_counter_circle_section_title == false) {
        $evolve_counter_circle_section_title = '';
    } else {
        $evolve_counter_circle_section_title = '<h2 class="counter_circle_section_title section_title">'.evolve_get_option('evl_counter_circle_title', 'Cooperation with many great brands is our mission').'</h2>';
    }

    $shortcode = get_counter_circle_shortcode();

    $mainshortcode = '[fullwidth backgroundcolor="'.$evolve_counter_circle_section_back_color.'" backgroundimage="'.$evolve_counter_circle_section_image_src.'" backgroundsize="'.$evolve_counter_circle_section_image.'" backgroundrepeat="'.$evolve_counter_circle_section_background_repeat.'" backgroundposition="'.$evolve_counter_circle_section_background_position.'" backgroundattachment="'.$evolve_counter_circle_section_background_parallax.'" paddingtop="'.$evolve_counter_circle_section_padding_top.'" paddingbottom="'.$evolve_counter_circle_section_padding_bottom.'" paddingleft="'.$evolve_counter_circle_section_padding_left.'" paddingright="'.$evolve_counter_circle_section_padding_right.'" ]'.$evolve_counter_circle_section_title.$shortcode.'[/fullwidth]';

    return $mainshortcode;
}
function get_counter_circle_shortcode() {
    global $evl_options;

    $slides = evolve_get_option("countercircle_slides", array());
    $sub_shortcode = '';

    if (isset($slides['enabled'])) {
        foreach ($slides['enabled'] as $i => $enabled) {
            if ($enabled == 1) {
                $icon = $slides["icon"][$i];
                $percentage = $slides["percentage"][$i];
                $title = $slides["title"][$i];
                $filledcolor = $slides["filledcolor"][$i];
                $unfilledcolor = $slides["unfilledcolor"][$i];

                $sub_shortcode .= '[counter_circle div_margin_top="" div_margin_bottom="" disabled_el="no" class="" id="" description="" value="'.$percentage.'" filledcolor="'.$filledcolor.'" unfilledcolor="'.$unfilledcolor.'" size="220" font_size="30" icon="'.$icon.'" scales="no" countdown="no" speed="1500" ]'.$title.'[/counter_circle]';
            }
        }
    }

    return '[counters_circle el_title="" class="" id="" disabled_el="no" div_margin_top="0" div_margin_left="0" div_margin_bottom="0" div_margin_right="0" ]'.$sub_shortcode.'[/counters_circle]';
}

/* Front Page WooCommerce Product */
function evolve_woocommerce_products() {
    global $evl_options;

    $product_cat = $evl_options["evl_fp_woo_product"];
    $product_number = $evl_options["evl_fp_woo_product_number"];

    $evolve_woo_product_section_padding_top          = $evl_options['evl_woo_product_section_padding']['padding-top'];
    $evolve_woo_product_section_padding_bottom       = $evl_options['evl_woo_product_section_padding']['padding-bottom'];
    $evolve_woo_product_section_padding_left         = $evl_options['evl_woo_product_section_padding']['padding-left'];
    $evolve_woo_product_section_padding_right        = $evl_options['evl_woo_product_section_padding']['padding-right'];
    $evolve_woo_product_section_back_color           = evolve_get_option( 'evl_woo_product_section_back_color', '' );
    $evolve_woo_product_section_image_src            = evolve_get_option('evl_woo_product_section_background_image');
    $evolve_woo_product_section_image                = evolve_get_option('evl_woo_product_section_image', 'cover');
    $evolve_woo_product_section_background_repeat    = evolve_get_option('evl_woo_product_section_image_background_repeat', 'no-repeat');
    $evolve_woo_product_section_background_position  = evolve_get_option('evl_woo_product_section_image_background_position', 'center top');
    $evolve_woo_product_section_background_parallax   = evolve_get_option('evl_woo_product_section_background_parallax', '0');

    //html_attr
    $html_class = 't4p-fullwidth fullwidth-box hentry';
    $html_style = '';

    if( $evolve_woo_product_section_background_parallax ) {
            $html_style .= 'background-attachment:fixed;';
    }

    if( $evolve_woo_product_section_back_color ) {
            $html_style .= sprintf( 'background-color:%s;', $evolve_woo_product_section_back_color );
    }

    if ( isset($evolve_woo_product_section_image_src['url']) && $evolve_woo_product_section_image_src['url'] ) {
            $html_style .= sprintf( 'background-image: url(%s);', $evolve_woo_product_section_image_src['url'] );
    }

    if( $evolve_woo_product_section_image ) {
            $html_style .= sprintf( 'background-size:%s;', $evolve_woo_product_section_image );
            $html_style .= sprintf( '-webkit-background-size:%s;', $evolve_woo_product_section_image );
            $html_style .= sprintf( '-moz-background-size:%s;', $evolve_woo_product_section_image );
            $html_style .= sprintf( '-o-background-size:%s;', $evolve_woo_product_section_image );
    }

    if( $evolve_woo_product_section_background_position ) {
            $html_style .= sprintf( 'background-position:%s;', $evolve_woo_product_section_background_position );
    }

    if( $evolve_woo_product_section_background_repeat ) {
            $html_style .= sprintf( 'background-repeat:%s;', $evolve_woo_product_section_background_repeat );
    }

    if( $evolve_woo_product_section_padding_top ) {
            $html_style .= sprintf( 'padding-bottom:%s;', $evolve_woo_product_section_padding_top );
    }

    if( $evolve_woo_product_section_padding_bottom ) {
            $html_style .= sprintf( 'padding-top:%s;', $evolve_woo_product_section_padding_bottom );
    }

    if( $evolve_woo_product_section_padding_left ) {
            $html_style .= sprintf( 'padding-left:%s;', $evolve_woo_product_section_padding_left );
    }

    if( $evolve_woo_product_section_padding_right ) {
            $html_style .= sprintf( 'padding-right:%s;', $evolve_woo_product_section_padding_right );
    }

    $html = "<div class='$html_class' style='$html_style' ><div class='t4p-row'>";

    $evolve_woo_product_section_title = evolve_get_option('evl_woo_product_title', 'New Arrival Product');
    if ($evolve_woo_product_section_title == false) {
        $evolve_woo_product_section_title = '';
    } else {
        $evolve_woo_product_section_title = '<h2 class="woo_product_section_title section_title">'.evolve_get_option('evl_woo_product_title', 'New Arrival Product').'</h2>';
    }

    $html  .= "<div class='t4p-woo-product' >".$evolve_woo_product_section_title;

    if ( $product_cat ) {
        $html .= do_shortcode( '[product_category category="'.$product_cat.'"  per_page="'. $product_number .'" orderby="title" order="asc"]' );
    } else {
        $html .= do_shortcode( '[products limit="'. $product_number .'" columns="4" category="" cat_operator="AND"]' );
    }

    $html .= "</div></div></div>";

    echo $html;
}

/* Front Page Google Map */
function evolve_google_map() {
    $mainshortcode = evolve_google_map_convert();

    $html = do_shortcode( $mainshortcode );

    echo $html;
}
function evolve_google_map_convert() {
    global $evl_options;

    $evolve_googlemap_section_padding_top          = $evl_options['evl_googlemap_section_padding']['padding-top'];
    $evolve_googlemap_section_padding_bottom       = $evl_options['evl_googlemap_section_padding']['padding-bottom'];
    $evolve_googlemap_section_padding_left         = $evl_options['evl_googlemap_section_padding']['padding-left'];
    $evolve_googlemap_section_padding_right        = $evl_options['evl_googlemap_section_padding']['padding-right'];
    $evolve_googlemap_section_back_color           = evolve_get_option( 'evl_googlemap_section_back_color', '' );
    $evolve_googlemap_section_image_src            = evolve_get_option('evl_googlemap_section_background_image');
    $evolve_googlemap_section_image                = evolve_get_option('evl_googlemap_section_image', 'cover');
    $evolve_googlemap_section_background_repeat    = evolve_get_option('evl_googlemap_section_image_background_repeat', 'no-repeat');
    $evolve_googlemap_section_background_position  = evolve_get_option('evl_googlemap_section_image_background_position', 'center top');
    $evolve_googlemap_section_background_parallax   = evolve_get_option('evl_googlemap_section_background_parallax', '0');

    if ( isset($evolve_googlemap_section_image_src['url']) && $evolve_googlemap_section_image_src['url'] ) {
        $evolve_googlemap_section_image_src = $evolve_googlemap_section_image_src['url'];
    }else{
        $evolve_googlemap_section_image_src = '';
    }

    if ( $evolve_googlemap_section_background_parallax ) {
        $evolve_googlemap_section_background_parallax = 'fixed';
    } else {
        $evolve_googlemap_section_background_parallax = 'scroll';
    }
    
    $evolve_googlemap_section_title = evolve_get_option('evl_googlemap_title', 'Our Contact Place');
    if ($evolve_googlemap_section_title == false) {
        $evolve_googlemap_section_title = '';
    } else {
        $evolve_googlemap_section_title = '<h2 class="googlemap_section_title section_title">'.evolve_get_option('evl_googlemap_title', 'Our Contact Place').'</h2>';
    }

    $shortcode = get_google_map_shortcode();

    $mainshortcode = '[fullwidth backgroundcolor="'.$evolve_googlemap_section_back_color.'" backgroundimage="'.$evolve_googlemap_section_image_src.'" backgroundsize="'.$evolve_googlemap_section_image.'" backgroundrepeat="'.$evolve_googlemap_section_background_repeat.'" backgroundposition="'.$evolve_googlemap_section_background_position.'" backgroundattachment="'.$evolve_googlemap_section_background_parallax.'" paddingtop="'.$evolve_googlemap_section_padding_top.'" paddingbottom="'.$evolve_googlemap_section_padding_bottom.'" paddingleft="'.$evolve_googlemap_section_padding_left.'" paddingright="'.$evolve_googlemap_section_padding_right.'" ]'.$evolve_googlemap_section_title.$shortcode.'[/fullwidth]';

    return $mainshortcode;
}
function get_google_map_shortcode() {
    global $evl_options;

    $address  = $evl_options["evl_fp_googlemap_address"];
    $type = $evl_options["evl_fp_googlemap_type"];
    $width = $evl_options["evl_fp_googlemap_width"];
    $height = $evl_options["evl_fp_googlemap_height"];
    $zoom = $evl_options["evl_fp_googlemap_zoom_level"];
    $scrollwheel = $evl_options["evl_fp_googlemap_scrollwheel"];
    $scale = $evl_options["evl_fp_googlemap_scale"];
    $zoom_pancontrol = $evl_options["evl_fp_googlemap_zoomcontrol"];

    return '[map el_title="" address="'.$address.'" gmap_alignment="center" map_style="default" type="'.$type.'" width="'.$width.'" height="'.$height.'" zoom_slider="" zoom="'.$zoom.'" scrollwheel="'.$scrollwheel.'" scale="'.$scale.'" zoom_pancontrol="'.$zoom_pancontrol.'" popup="yes" animation_type="0" class="" id="" disabled_el="no" div_margin_top="0" div_margin_left="0" div_margin_bottom="0" div_margin_right="0" ][/map]';
}

/* Front Page Custom Content */
function evolve_custom_content() {
    $mainshortcode = evolve_custom_content_convert();

    $html = do_shortcode( $mainshortcode );

    echo $html;
}
function evolve_custom_content_convert() {
    global $evl_options;

    $content = $evl_options["evl_fp_custom_content_editor"];
    $evolve_custom_content_section_padding_top          = $evl_options['evl_custom_content_section_padding']['padding-top'];
    $evolve_custom_content_section_padding_bottom       = $evl_options['evl_custom_content_section_padding']['padding-bottom'];
    $evolve_custom_content_section_padding_left         = $evl_options['evl_custom_content_section_padding']['padding-left'];
    $evolve_custom_content_section_padding_right        = $evl_options['evl_custom_content_section_padding']['padding-right'];
    $evolve_custom_content_section_back_color           = evolve_get_option( 'evl_custom_content_section_back_color', '' );
    $evolve_custom_content_section_image_src            = evolve_get_option('evl_custom_content_section_background_image');
    $evolve_custom_content_section_image                = evolve_get_option('evl_custom_content_section_image', 'cover');
    $evolve_custom_content_section_background_repeat    = evolve_get_option('evl_custom_content_section_image_background_repeat', 'no-repeat');
    $evolve_custom_content_section_background_position  = evolve_get_option('evl_custom_content_section_image_background_position', 'center top');
    $evolve_custom_content_section_background_parallax  = evolve_get_option('evl_custom_content_section_background_parallax', '0');

    if ( isset($evolve_custom_content_section_image_src['url']) && $evolve_custom_content_section_image_src['url'] ) {
        $evolve_custom_content_section_image_src = $evolve_custom_content_section_image_src['url'];
    }else{
        $evolve_custom_content_section_image_src = '';
    }

    if ( $evolve_custom_content_section_background_parallax ) {
        $evolve_custom_content_section_background_parallax = 'fixed';
    } else {
        $evolve_custom_content_section_background_parallax = 'scroll';
    }

    $evolve_custom_content_section_title = evolve_get_option('evl_custom_content_title', 'Your Custom Content Here');
    if ($evolve_custom_content_section_title == false) {
        $evolve_custom_content_section_title = '';
    } else {
        $evolve_custom_content_section_title = '<h2 class="custom_content_section_title section_title">'.evolve_get_option('evl_custom_content_title', 'Your Custom Content Here').'</h2>';
    }

    $mainshortcode = '[fullwidth backgroundcolor="'.$evolve_custom_content_section_back_color.'" backgroundimage="'.$evolve_custom_content_section_image_src.'" backgroundsize="'.$evolve_custom_content_section_image.'" backgroundrepeat="'.$evolve_custom_content_section_background_repeat.'" backgroundposition="'.$evolve_custom_content_section_background_position.'" backgroundattachment="'.$evolve_custom_content_section_background_parallax.'" paddingtop="'.$evolve_custom_content_section_padding_top.'" paddingbottom="'.$evolve_custom_content_section_padding_bottom.'" paddingleft="'.$evolve_custom_content_section_padding_left.'" paddingright="'.$evolve_custom_content_section_padding_right.'" ]'.$evolve_custom_content_section_title.$content.'[/fullwidth]';

    return $mainshortcode;
}

/* Front Page Blog */
function evolve_blog_posts() {
    $mainshortcode = evolve_blog_posts_convert();

    $html = do_shortcode( $mainshortcode );

    echo $html;
}
function evolve_blog_posts_convert() {
    global $evl_options;

    $evolve_blog_section_padding_top          = $evl_options['evl_blog_section_padding']['padding-top'];
    $evolve_blog_section_padding_bottom       = $evl_options['evl_blog_section_padding']['padding-bottom'];
    $evolve_blog_section_padding_left         = $evl_options['evl_blog_section_padding']['padding-left'];
    $evolve_blog_section_padding_right        = $evl_options['evl_blog_section_padding']['padding-right'];
    $evolve_blog_section_back_color           = evolve_get_option( 'evl_blog_section_back_color', '' );
    $evolve_blog_section_image_src            = evolve_get_option('evl_blog_section_background_image');
    $evolve_blog_section_image                = evolve_get_option('evl_blog_section_image', 'cover');
    $evolve_blog_section_background_repeat    = evolve_get_option('evl_blog_section_image_background_repeat', 'no-repeat');
    $evolve_blog_section_background_position  = evolve_get_option('evl_blog_section_image_background_position', 'center top');
    $evolve_blog_section_background_parallax   = evolve_get_option('evl_blog_section_background_parallax', '0');

    if ( isset($evolve_blog_section_image_src['url']) && $evolve_blog_section_image_src['url'] ) {
        $evolve_blog_section_image_src = $evolve_blog_section_image_src['url'];
    }else{
        $evolve_blog_section_image_src = '';
    }

    if ( $evolve_blog_section_background_parallax ) {
        $evolve_blog_section_background_parallax = 'fixed';
    } else {
        $evolve_blog_section_background_parallax = 'scroll';
    }

    $evolve_fp_blog_section_title = evolve_get_option('evl_blog_section_title', 'Read New Story Here');
    if ($evolve_fp_blog_section_title == false) {
        $evolve_fp_blog_section_title = '';
    } else {
        $evolve_fp_blog_section_title = '<h2 class="fp_blog_section_title section_title">'.evolve_get_option('evl_blog_section_title', 'Read New Story Here').'</h2>';
    }

    $shortcode = get_blog_shortcode();

    $mainshortcode = '[fullwidth backgroundcolor="'.$evolve_blog_section_back_color.'" backgroundimage="'.$evolve_blog_section_image_src.'" backgroundsize="'.$evolve_blog_section_image.'" backgroundrepeat="'.$evolve_blog_section_background_repeat.'" backgroundposition="'.$evolve_blog_section_background_position.'" backgroundattachment="'.$evolve_blog_section_background_parallax.'" paddingtop="'.$evolve_blog_section_padding_top.'" paddingbottom="'.$evolve_blog_section_padding_bottom.'" paddingleft="'.$evolve_blog_section_padding_left.'" paddingright="'.$evolve_blog_section_padding_right.'" ]'.$evolve_fp_blog_section_title.$shortcode.'[/fullwidth]';

    return $mainshortcode;
}
function get_blog_shortcode() {
    global $evl_options;

    $layout = $evl_options["evl_fp_blog_layout"];
    $number_posts = ( ! $evl_options["evl_fp_blog_number_posts"] ) ? '-1' : $evl_options["evl_fp_blog_number_posts"];
    $cat_slug = ( !isset($evl_options["evl_fp_blog_cat_slug"]) ) ? '' : $evl_options["evl_fp_blog_cat_slug"];
    $exclude_cats = ( !isset($evl_options["evl_fp_blog_exclude_cats"]) ) ? '' : $evl_options["evl_fp_blog_exclude_cats"];
    $show_title = $evl_options["evl_fp_blog_show_title"];
    $title_link = $evl_options["evl_fp_blog_title_link"];
    $thumbnail = $evl_options["evl_fp_blog_thumbnail"];
    $excerpt = $evl_options["evl_fp_blog_excerpt"];
    $excerpt_length = $evl_options["evl_fp_blog_excerpt_length"];
    $meta_all = $evl_options["evl_fp_blog_meta_all"];
    $meta_author = $evl_options["evl_fp_blog_meta_author"];
    $meta_categories = $evl_options["evl_fp_blog_meta_categories"];
    $meta_comments = $evl_options["evl_fp_blog_meta_comments"];
    $meta_date = $evl_options["evl_fp_blog_meta_date"];
    $meta_link = $evl_options["evl_fp_blog_meta_link"];
    $meta_tags = $evl_options["evl_fp_blog_meta_tags"];
    $paging = $evl_options["evl_fp_blog_paging"];
    $scrolling = $evl_options["evl_fp_blog_scrolling"];
    $blog_grid_columns = $evl_options["evl_fp_blog_blog_grid_columns"];
    $strip_html = $evl_options["evl_fp_blog_strip_html"];

    if ( is_array( $cat_slug ) ) {
        $cat_slug = implode( ",", $cat_slug );
    }

    if ( is_array( $exclude_cats ) ) {
        $exclude_cats = implode( ",", $exclude_cats );
    }

    return '[blog layout="'.$layout.'" cat_slug="'.$cat_slug.'" exclude_cats="'.$exclude_cats.'" number_posts="'.$number_posts.'" show_title="'.$show_title.'" title_link="'.$title_link.'" thumbnail="'.$thumbnail.'" excerpt="'.$excerpt.'" excerpt_length="'.$excerpt_length.'" meta_all="'.$meta_all.'" meta_author="'.$meta_author.'" meta_categories="'.$meta_categories.'" meta_comments="'.$meta_comments.'" meta_date="'.$meta_date.'" meta_link="'.$meta_link.'" meta_tags="'.$meta_tags.'" paging="'.$paging.'" scrolling="'.$scrolling.'" blog_grid_columns="'.$blog_grid_columns.'" strip_html="'.$strip_html.'" class="" id="" disabled_el="no" div_margin_top="0" div_margin_left="0" div_margin_bottom="0" div_margin_right="0" ][/blog]';
}


/* Front Page Bootstrap Slider */
function fp_bootstrap_slider() {
    // Bootstrap Slider
    $evolve_bootstrap_on = evolve_get_option('evl_bootstrap_slider_support', '1');
    if ( ($evolve_bootstrap_on == "1" && is_front_page()) || ($evolve_bootstrap_on == "1" && is_home()) ):
	$evolve_bootstrap_slider = evolve_get_option('evl_bootstrap_slider_support', '1');
		if ($evolve_bootstrap_slider == "1"):
			evolve_bootstrap();
        endif;
    endif;
}

/* Front Page Parallax Slider */
function fp_parallax_slider() {
    // Parallax Slider
    $evolve_parallax_on = evolve_get_option('evl_parallax_slider_support', '1');
    if ( ($evolve_parallax_on == "1" && is_front_page()) || ($evolve_parallax_on == "1" && is_home()) ):
        $evolve_parallax_slider = evolve_get_option('evl_parallax_slider_support', '1');
        if ($evolve_parallax_slider == "1"):
            evolve_parallax();
        endif;
    endif;
}

/* Front Page Posts Slider */
function fp_post_slider() {
    // Posts Slider
    $evolve_post_on = evolve_get_option('evl_carousel_slider', '1');
    if ( ($evolve_post_on == "1" && is_front_page()) || ($evolve_post_on == "1" && is_home()) ):
        $evolve_carousel_slider = evolve_get_option('evl_carousel_slider', '1');
        if ($evolve_carousel_slider == "1"):
            evolve_posts_slider();
        endif;
    endif;
}
