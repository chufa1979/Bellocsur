<?php
class T4PSC_T4PSlider {

    public static $parent_args;

    /**
     * Initiate the shortcode
     */
    public function __construct() {

        add_shortcode( 't4pslider', array( $this, 'render_parent' ) );

    }

    /**
     * Render the parent shortcode
     * @param  array $args    Shortcode paramters
     * @param  string $content Content between shortcode
     * @return string          HTML output
     */
    function render_parent( $args, $content = '') {

        global $smof_data, $theme_prefix;

        $theme = wp_get_theme(); // gets the current theme

		$defaults = T4PCore_Plugin::set_shortcode_defaults(
			array(
				'class'			=> '',
				'id'			=> '',
				'name' 	        => '',
			), $args
		);	

        extract( $defaults );

        self::$parent_args = $defaults;

        ob_start();

        $term = $name;

        $term_details = get_term_by( 'slug', $term, 'slide-page' );
        $slider_slug = $term_details->slug;
        $slider_settings = get_option( 'taxonomy_' . $term_details->term_id );
        $slider_data = '';

        if ('alora' == $theme->name || 'alora' == $theme->parent_theme) {
                if( $slider_settings ) {
                        foreach( $slider_settings as $slider_setting => $slider_setting_value ) {
                            $slider_data .= 'data-' . $slider_setting . '="' . $slider_setting_value . '" ';
                        }
                }
        }

        $slider_class = '';
		
        if ('evolve Plus' == $theme->name || 'evolve Plus' == $theme->parent_theme) {
        if( $slider_settings['slider_width'] == '100%') {
            $slider_class .= ' full-width-slider';
        }

        if( $slider_settings['slider_width'] != '100%') {
            $slider_class .= ' fixed-width-slider';
        }
		
		} else {
		if( $slider_settings['slider_width'] == '100%' && ! $slider_settings['full_screen'] ) {
			$slider_class .= ' full-width-slider';
        }

        if( $slider_settings['slider_width'] != '100%' && ! $slider_settings['full_screen'] ) {
            $slider_class .= ' fixed-width-slider';
        }
			
		}

        $args                = array(
            'post_type'        => 'slide',
            'posts_per_page'   => -1,
            'suppress_filters' => 0
        );
        $args['tax_query'][] = array(
            'taxonomy' => 'slide-page',
            'field'    => 'slug',
            'terms'    => $term
        );

        $query = new WP_Query( $args );
        if ( $query->have_posts() ) {
        ?>
		<?php $theme = wp_get_theme(); // gets the current theme
        if ('evolve Plus' == $theme->name || 'evolve Plus' == $theme->parent_theme) { ?>
            <div class="t4p-slider-container <?php echo $slider_class; ?>-container" style="height:<?php echo $slider_settings['slider_height']; ?>; max-width:<?php echo $slider_settings['slider_width']; ?>;">
				<div id="<?php echo $slider_slug; ?>" class="t4p-slider-shortcode t4p-slider t4press-flexslider main-flex<?php echo $slider_class; ?>" style="max-width:<?php echo $slider_settings['slider_width']; ?>;" <?php echo $slider_data; ?>>
		<?php }else{ ?>
			<div class="t4p-slider-container <?php echo $slider_class; ?>-container" style="height:<?php echo $slider_settings['slider_height']; ?>;max-width:<?php echo $slider_settings['slider_width']; ?>;">
				<div id="<?php echo $slider_slug; ?>" class="t4p-slider flexslider main-flex<?php echo $slider_class; ?>" style="max-width:<?php echo $slider_settings['slider_width']; ?>;" <?php echo $slider_data; ?>>
		<?php } ?>               
                    <ul class="slides" style="width:<?php echo $slider_settings['slider_width']; ?>;">
                        <?php
                        while( $query->have_posts() ): $query->the_post();
                            $metadata = get_metadata( 'post', get_the_ID() );
                            
                            $background_image = '';
                            $background_class = '';

                            $img_width = '';

                            if( isset( $metadata[$theme_prefix.'type'][0] ) && $metadata[$theme_prefix.'type'][0] == 'image' && has_post_thumbnail() ) {
                                $image_id = get_post_thumbnail_id();
                                $image_url = wp_get_attachment_image_src( $image_id, 'full', true );
                                $background_image = 'background-image: url(' . $image_url[0] . ');';
                                $background_class = 'background-image';
                                $img_width = $image_url[1];
                            }

                            $video_attributes = '';
                            $youtube_attributes = '';
                            $vimeo_attributes = '';
                            $data_mute = 'no';
                            $data_loop = 'no';
                            $data_autoplay = 'no';

                            if( isset( $metadata[$theme_prefix.'mute_video'][0] ) && $metadata[$theme_prefix.'mute_video'][0] == 'yes' ) {
                                $video_attributes = "muted='muted'";
                                $data_mute = 'yes';
                            }

                            if( isset( $metadata[$theme_prefix.'autoplay_video'][0] ) && $metadata[$theme_prefix.'autoplay_video'][0] == 'yes' ) {
                                $video_attributes .= "autoplay='autoplay'";
                                $youtube_attributes .= '&amp;autoplay=1';
                                $vimeo_attributes .= '&amp;autoplay=1';
                                $data_autoplay = 'yes';
                            }

                            if( isset( $metadata[$theme_prefix.'loop_video'][0] ) && $metadata[$theme_prefix.'loop_video'][0] == 'yes' ) {
                                $video_attributes .= "loop='loop'";
                                $youtube_attributes .= '&amp;loop=1&amp;playlist=' . $metadata[$theme_prefix.'youtube_id'][0];
                                $vimeo_attributes .= '&amp;loop=1';
                                $data_loop = 'yes';
                            }

                            if( isset ( $metadata[$theme_prefix.'hide_video_controls'][0] ) && $metadata[$theme_prefix.'hide_video_controls'][0] == 'no' ) {
                                $video_attributes .= "controls='controls'";
                                $youtube_attributes .= '&amp;controls=1';
                                $video_zindex = 'z-index: 1;';
                            } else {
                                $youtube_attributes .= '&amp;controls=0';
                                $video_zindex = 'z-index: -99;';
                            }

                            $heading_color = '';

                            if( isset ( $metadata[$theme_prefix.'heading_color'][0] ) && $metadata[$theme_prefix.'heading_color'][0] ) {
                                $heading_color = 'color:' . $metadata[$theme_prefix.'heading_color'][0] . ';';
                            }

                            $heading_bg = '';

                            if( isset ( $metadata[$theme_prefix.'heading_bg'][0] ) && $metadata[$theme_prefix.'heading_bg'][0] == 'yes' ) {
                                $heading_bg = 'background-color: rgba(0,0,0, 0.4);';
                            }

                            $caption_color = '';

                            if( isset ( $metadata[$theme_prefix.'caption_color'][0] ) && $metadata[$theme_prefix.'caption_color'][0] ) {
                                $caption_color = 'color:' . $metadata[$theme_prefix.'caption_color'][0] . ';';
                            }

                            $caption_bg = '';

                            if( isset ( $metadata[$theme_prefix.'caption_bg'][0] ) && $metadata[$theme_prefix.'caption_bg'][0] == 'yes' ) {
                                $caption_bg = 'background-color: rgba(0, 0, 0, 0.4);';
                            }

                            $video_bg_color = '';

                            if( isset ( $metadata[$theme_prefix.'video_bg_color'][0] ) && $metadata[$theme_prefix.'video_bg_color'][0] ) {
                                $video_bg_color_hex = t4p_hex2rgb( $metadata[$theme_prefix.'video_bg_color'][0]  );
                                $video_bg_color = 'background-color: rgba(' . $video_bg_color_hex[0] . ', ' . $video_bg_color_hex[1] . ', ' . $video_bg_color_hex[2] . ', 0.4);';
                            }

                            $video = false;

                            if( isset( $metadata[$theme_prefix.'type'][0] ) ) {
                                if( isset( $metadata[$theme_prefix.'type'][0] ) && $metadata[$theme_prefix.'type'][0] == 'self-hosted-video' || $metadata[$theme_prefix.'type'][0] == 'youtube' || $metadata[$theme_prefix.'type'][0] == 'vimeo' ) {
                                    $video = true;
                                }
                            }

                            if( isset ( $metadata[$theme_prefix.'type'][0] ) &&  $metadata[$theme_prefix.'type'][0] == 'self-hosted-video' ) {
                                $background_class = 'self-hosted-video-bg';
                            }

                            $heading_font_size = 'font-size:60px;line-height:80px;';
                            if( isset ( $metadata[$theme_prefix.'heading_font_size'][0] ) && $metadata[$theme_prefix.'heading_font_size'][0] ) {
                                $line_height = $metadata[$theme_prefix.'heading_font_size'][0] * 1.4;
                                $heading_font_size = 'font-size:' . $metadata[$theme_prefix.'heading_font_size'][0] . 'px;line-height:' . $line_height . 'px;';
                            }

                            $caption_font_size = 'font-size: 24px;line-height:38px;';
                            if( isset ( $metadata[$theme_prefix.'caption_font_size'][0] ) && $metadata[$theme_prefix.'caption_font_size'][0] ) {
                                $line_height = $metadata[$theme_prefix.'caption_font_size'][0] * 1.4;
                                $caption_font_size = 'font-size:' . $metadata[$theme_prefix.'caption_font_size'][0] . 'px;line-height:' . $line_height . 'px;';
                            }
                        ?>
                        <li data-mute="<?php echo $data_mute; ?>" data-loop="<?php echo $data_loop; ?>" data-autoplay="<?php echo $data_autoplay; ?>">
                            <div class="slide-content-container slide-content-<?php 
							if( isset ( $metadata[$theme_prefix.'content_alignment'][0] ) && $metadata[$theme_prefix.'content_alignment'][0] ) {
								echo $metadata[$theme_prefix.'content_alignment'][0];                               
                            }
							 ?>">
                                <div class="slide-content">
                                    <?php if( isset ( $metadata[$theme_prefix.'heading'][0] ) && $metadata[$theme_prefix.'heading'][0] ): ?>
                                    <div class="heading animated fadeInUp <?php if($heading_bg): echo 'with-bg'; endif; ?>" data-animationtype="fadeInUp" data-animationduration="1"><h2 style="<?php echo $heading_bg; ?><?php echo $heading_color; ?><?php echo $heading_font_size; ?>"><?php echo $metadata[$theme_prefix.'heading'][0]; ?></h2></div>
                                    <?php endif; ?>
                                    <?php if( isset ( $metadata[$theme_prefix.'caption'][0] ) && $metadata[$theme_prefix.'caption'][0] ): ?>
                                    <div class="caption animated fadeInUp <?php if($caption_bg): echo 'with-bg'; endif; ?>" data-animationtype="fadeInUp" data-animationduration="1"><h3 style="<?php echo $caption_bg; ?><?php echo $caption_color; ?><?php echo $caption_font_size; ?>"><?php echo $metadata[$theme_prefix.'caption'][0]; ?></h3></div>
                                    <?php endif; ?>
                                    <?php if( isset ( $metadata[$theme_prefix.'link_type'][0] ) && $metadata[$theme_prefix.'link_type'][0] == 'button' ): ?>
                                    <div class="buttons animated fadeInUp" data-animationtype="fadeInUp" data-animationduration="1">
                                        <?php
                                        if( isset ( $metadata[$theme_prefix.'button_1'][0] ) && $metadata[$theme_prefix.'button_1'][0] ) {
                                            echo '<div class="t4p-button-1">' . do_shortcode( $metadata[$theme_prefix.'button_1'][0] ) . '</div>';
                                        }
                                        if( isset ( $metadata[$theme_prefix.'button_2'][0] ) && $metadata[$theme_prefix.'button_2'][0] ) {
                                            echo '<div class="t4p-button-2">' . do_shortcode( $metadata[$theme_prefix.'button_2'][0] ) . '</div>';
                                        }
                                        ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if( isset( $metadata[$theme_prefix.'link_type'][0] ) && $metadata[$theme_prefix.'link_type'][0] == 'full' && isset( $metadata[$theme_prefix.'slide_link'][0] ) && $metadata[$theme_prefix.'slide_link'][0] ): ?>
                            <a href="<?php echo $metadata[$theme_prefix.'slide_link'][0]; ?>" class="overlay-link"></a>
                            <?php endif; ?>
                            <?php if( isset ( $metadata[$theme_prefix.'preview_image'][0] ) && $metadata[$theme_prefix.'preview_image'][0] ):
                                $evolve_upload_imgsrc = wp_get_attachment_url($metadata[$theme_prefix.'preview_image'][0]);
                            ?>
                            <div class="mobile_video_image" style="background-image: url(<?php echo $evolve_upload_imgsrc; ?>); "></div>
                            <?php elseif( isset( $metadata[$theme_prefix.'type'][0] ) && $metadata[$theme_prefix.'type'][0] == 'self-hosted-video' ): ?>
                            <div class="mobile_video_image" style="background-image: url(<?php echo bloginfo('template_directory'); ?>/images/video_preview.jpg);"></div>
                            <?php endif; ?>
                            <?php if( $video_bg_color && $video == true ): ?>
                            <div class="overlay" style="<?php echo $video_bg_color; ?>"></div>
                            <?php endif; ?>
							<?php $theme = wp_get_theme(); // gets the current theme
							if ('evolve Plus' == $theme->name || 'evolve Plus' == $theme->parent_theme) { ?>
                            <div class="background <?php echo $background_class; ?>" style="<?php echo $background_image; ?>width:<?php echo $slider_settings['slider_width']; ?>;height:<?php echo $slider_settings['slider_height'];?>;background-size: cover;" data-imgwidth="<?php echo $img_width; ?>">
							<?php } else { ?>
							<div class="background <?php echo $background_class; ?>" style="<?php echo $background_image; ?>width:<?php echo $slider_settings['slider_width']; ?>;height:<?php echo $slider_settings['slider_height'];?>;" data-imgwidth="<?php echo $img_width; ?>">
							<?php } ?>
                                <?php if( isset( $metadata[$theme_prefix.'type'][0] ) ): if( $metadata[$theme_prefix.'type'][0] == 'self-hosted-video' && ( $metadata[$theme_prefix.'webm'][0] || $metadata[$theme_prefix.'mp4'][0] || $metadata[$theme_prefix.'ogg'][0] ) ): ?>
                                <video <?php echo $video_attributes; ?> preload="none" >
                                        <?php if ($metadata[$theme_prefix.'mp4'][0]): 
                                                $evolve_upload_mp4src = wp_get_attachment_url($metadata[$theme_prefix.'mp4'][0]);
                                        ?>
                                            <source src="<?php echo $evolve_upload_mp4src; ?>" type="video/mp4">
                                            <?php
                                        endif;
                                        if ($metadata[$theme_prefix.'ogv'][0]):
                                                $evolve_upload_oggsrc = wp_get_attachment_url($metadata[$theme_prefix.'ogv'][0]);
                                        ?>
                                            <source src="<?php echo $evolve_upload_oggsrc ?>" type="video/ogg">
                                            <?php
                                        endif;
                                        if ($metadata[$theme_prefix.'webm'][0]):
                                                $evolve_upload_webmsrc = wp_get_attachment_url($metadata[$theme_prefix.'webm'][0]);
                                        ?>
                                            <source src="<?php echo $evolve_upload_webmsrc; ?>" type="video/webm">
                                        <?php endif; ?>
                                </video>
                                <?php endif; endif; ?>
                                <?php if( isset( $metadata[$theme_prefix.'type'][0] ) && isset( $metadata[$theme_prefix.'youtube_id'][0] ) && $metadata[$theme_prefix.'type'][0] == 'youtube' && $metadata[$theme_prefix.'youtube_id'][0] ): ?>
                                <div style="position: absolute; top: 0; left: 0; <?php echo $video_zindex; ?> width: 100%; height: 100%">
                                    <iframe frameborder="0" height="100%" width="100%" src="http<?php echo (is_ssl())? 's' : ''; ?>://www.youtube.com/embed/<?php echo $metadata[$theme_prefix.'youtube_id'][0]; ?>?modestbranding=1&amp;showinfo=0&amp;autohide=1&amp;enablejsapi=1&amp;rel=0<?php echo $youtube_attributes; ?>"></iframe>
                                </div>
                                <?php endif; ?>
                                 <?php if( isset( $metadata[$theme_prefix.'type'][0] ) && isset( $metadata[$theme_prefix.'vimeo_id'][0] ) &&  $metadata[$theme_prefix.'type'][0] == 'vimeo' && $metadata[$theme_prefix.'vimeo_id'][0] ): ?>
                                 <div style="position: absolute; top: 0; left: 0; <?php echo $video_zindex; ?> width: 100%; height: 100%">
                                    <iframe src="https://player.vimeo.com/video/<?php echo $metadata[$theme_prefix.'vimeo_id'][0]; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;badge=0&amp;title=0<?php echo $vimeo_attributes; ?>" height="100%" width="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                </div>
                                <?php endif; ?>
                            </div>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        <?php
        }

        wp_reset_query();
        ?>
            <script type="text/javascript">
                jQuery('<?php echo '#'.$slider_slug ?>').flexslider({
                    slideshow: <?php echo ($slider_settings['autoplay'] == 1) ? "true" : "false" ?>,
                    slideshowSpeed: <?php echo $slider_settings['slideshow_speed'] ?>,
                    video: true,
                    controlNav: <?php echo ($slider_settings['pagination_circles'] == 1) ? "true" : "false" ?>,
                    pauseOnHover: false,
                    animation: '<?php echo $slider_settings['animation'] ?>',
                    animationSpeed: <?php echo $slider_settings['animation_speed'] ?>,
                    directionNav: <?php echo ($slider_settings['nav_arrows'] == 1) ? "true" : "false" ?>,
                    animationLoop: true,
                    useCSS: false,
                    smoothHeight: true,
                    touch: true,
                    prevText: '&#xf104;',
                    nextText: '&#xf105;',
                });
            </script>
        <?php

        $html = ob_get_clean();

        return $html;

    }

}

new T4PSC_T4PSlider();
