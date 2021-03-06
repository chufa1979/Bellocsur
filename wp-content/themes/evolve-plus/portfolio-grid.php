<?php
// Template Name: Portfolio Grid
get_header();

$evolve_portfolio_pagination_type = evolve_get_option('evl_portfolio_pagination_type', 'pagination');
$content_css = 'width:100%';
$sidebar_css = 'display:none';
$content_class = '';
$sidebar_class = '';
$sidebar_exists = false;
$evl_width_px = evolve_get_option('evl_width_px', '1200');
if (get_post_meta($post->ID, 'evolve_portfolio_full_width', true) == 'yes' && $evl_width_px == 1200) {
    $content_css = 'width:100%';
    $sidebar_css = 'display:none';
    $content_class = 'portfolio-grid-mansory-page';
    $sidebar_exists = false;
} elseif (get_post_meta($post->ID, 'evolve_portfolio_full_width', true) == 'no' && get_post_meta($post->ID, 'evolve_portfolio_sidebar_position', true) == 'left' && $evl_width_px == 1200) {
    $content_css = 'display:block;';
    $sidebar_css = 'display:block;';
    $content_class = 'portfolio-grid-mansory-page portfolio-grid-mansory-sidebar-page col-md-8 col-md-push-4';
    $sidebar_class = 'col-md-4 col-md-pull-8';
    $sidebar_exists = true;
} elseif (get_post_meta($post->ID, 'evolve_portfolio_full_width', true) == 'no' && get_post_meta($post->ID, 'evolve_portfolio_sidebar_position', true) == 'right' && $evl_width_px == 1200) {
    $content_css = 'display:block;';
    $sidebar_css = 'display:block;';
    $content_class = 'portfolio-grid-mansory-page portfolio-grid-mansory-sidebar-page col-md-8';
    $sidebar_class = 'col-md-4';
    $sidebar_exists = true;
} elseif (get_post_meta($post->ID, 'evolve_portfolio_full_width', true) == 'yes' && $evl_width_px == 1600) {
    $content_css = 'width:100%';
    $sidebar_css = 'display:none';
    $content_class = 'portfolio-grid-mansory-page portfolio-grid-mansory-page-1600';
    $sidebar_exists = false;
} elseif (get_post_meta($post->ID, 'evolve_portfolio_full_width', true) == 'no' && get_post_meta($post->ID, 'evolve_portfolio_sidebar_position', true) == 'left' && $evl_width_px == 1600) {
    $content_css = 'display:block;';
    $sidebar_css = 'display:block;';
    $content_class = 'portfolio-grid-mansory-page portfolio-grid-mansory-sidebar-page portfolio-grid-mansory-sidebar-page-1600 col-md-8 col-md-push-4';
    $sidebar_class = 'col-md-4 col-md-pull-8';
    $sidebar_exists = true;
} elseif (get_post_meta($post->ID, 'evolve_portfolio_full_width', true) == 'no' && get_post_meta($post->ID, 'evolve_portfolio_sidebar_position', true) == 'right' && $evl_width_px == 1600) {
    $content_css = 'display:block;';
    $sidebar_css = 'display:block;';
    $content_class = 'portfolio-grid-mansory-page portfolio-grid-mansory-sidebar-page portfolio-grid-mansory-sidebar-page-1600 col-md-8';
    $sidebar_class = 'col-md-4';
    $sidebar_exists = true;
} elseif (get_post_meta($post->ID, 'evolve_portfolio_full_width', true) == 'yes' && $evl_width_px == 985) {
    $content_css = 'width:100%';
    $sidebar_css = 'display:none';
    $content_class = 'portfolio-grid-mansory-page portfolio-grid-mansory-page-985';
    $sidebar_exists = false;
} elseif (get_post_meta($post->ID, 'evolve_portfolio_full_width', true) == 'no' && get_post_meta($post->ID, 'evolve_portfolio_sidebar_position', true) == 'left' && $evl_width_px == 985) {
    $content_css = 'display:block;';
    $sidebar_css = 'display:block;';
    $content_class = 'portfolio-grid-mansory-page portfolio-grid-mansory-sidebar-page portfolio-grid-mansory-sidebar-page-985 col-md-8 col-md-push-4';
    $sidebar_class = 'col-md-4 col-md-pull-8';
    $sidebar_exists = true;
} elseif (get_post_meta($post->ID, 'evolve_portfolio_full_width', true) == 'no' && get_post_meta($post->ID, 'evolve_portfolio_sidebar_position', true) == 'right' && $evl_width_px == 985) {
    $content_css = 'display:block;';
    $sidebar_css = 'display:block;';
    $content_class = 'portfolio-grid-mansory-page portfolio-grid-mansory-sidebar-page portfolio-grid-mansory-sidebar-page-985 col-md-8';
    $sidebar_class = 'col-md-4';
    $sidebar_exists = true;
} elseif (get_post_meta($post->ID, 'evolve_portfolio_full_width', true) == 'yes' && $evl_width_px == 800) {
    $content_css = 'width:100%';
    $sidebar_css = 'display:none';
    $content_class = 'portfolio-grid-mansory-page portfolio-grid-mansory-page-800';
    $sidebar_exists = false;
} elseif (get_post_meta($post->ID, 'evolve_portfolio_full_width', true) == 'no' && get_post_meta($post->ID, 'evolve_portfolio_sidebar_position', true) == 'left' && $evl_width_px == 800) {
    $content_css = 'display:block;';
    $sidebar_css = 'display:block;';
    $content_class = 'portfolio-grid-mansory-page portfolio-grid-mansory-sidebar-page portfolio-grid-mansory-sidebar-page-800 col-md-8 col-md-push-4';
    $sidebar_class = 'col-md-4 col-md-pull-8';
    $sidebar_exists = true;
} elseif (get_post_meta($post->ID, 'evolve_portfolio_full_width', true) == 'no' && get_post_meta($post->ID, 'evolve_portfolio_sidebar_position', true) == 'right' && $evl_width_px == 800) {
    $content_css = 'display:block;';
    $sidebar_css = 'display:block;';
    $content_class = 'portfolio-grid-mansory-page portfolio-grid-mansory-sidebar-page portfolio-grid-mansory-sidebar-page-800 col-md-8';
    $sidebar_class = 'col-md-4';
    $sidebar_exists = true;
}

$evolve_edit_post = evolve_get_option('evl_edit_post', '0');
$evolve_pagetitlebar_layout = evolve_get_option('evl_pagetitlebar_layout', '0');
$evolve_breadcrumbs = evolve_get_option('evl_breadcrumbs', '1');

$evolve_paginationclass = '';
if ($evolve_portfolio_pagination_type == 'infinite') {
    $evolve_paginationclass = ' portfolio-infinite';
}
?>
<div id="content" class="portfolio-template portfolio portfolio-grid-mansory <?php echo $content_class . $evolve_paginationclass; ?>" style="<?php echo $content_css; ?>">

    <?php
    if (is_home() || is_front_page()) {
        get_template_part('frontpagebuilder');
    }
    ?>

    <?php

    if ($evolve_breadcrumbs == "1" && $evolve_pagetitlebar_layout == '0'):
        if (is_home() || is_front_page()):
        elseif (evolve_titlebar_breadcrumb() == true):
            evolve_breadcrumb();
        endif;
    endif;

    if (is_home() || is_front_page()) :
    ?>
            <div class="t4p-fullwidth homepage-content" >
                <div class="t4p-row">
    <?php
    endif;

    while (have_posts()): the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php
                if ($evolve_pagetitlebar_layout == '0') {
                    if (evolve_titlebar_title() == true):
                        ?>
                        <h1 class="entry-title"><?php
                            if (get_the_title()) {
                                the_title();
                            }

                            if ($evolve_edit_post == "1") {
                                if (current_user_can('edit_post', $post->ID)):
                                    edit_post_link(__('EDIT', 'evolve'), '<span class="edit-page edit-attach">', '</span>');
                                endif;
                            }
                            ?></h1>
                        <?php
                    endif;
                }
            ?>
            <span class="entry-title" style="display: none;"><?php the_title(); ?></span>
            <span class="vcard" style="display: none;"><span class="fn"><?php the_author_posts_link(); ?></span></span>
            <span class="updated" style="display:none;"><?php the_modified_time('c'); ?></span>	          
            <div class="post-content">
                <?php
                the_content();

                wp_link_pages(array(
                    'before' => '<div class="pagination single-pagination">' . __('Pages:', 'evolve'),
                    'after' => '</div>',
                    'link_before' => '<span class="current">',
                    'link_after' => '</span>',
                    'next_or_number' => 'next_and_number',
                    'separator' => ' ',
                    'nextpagelink' => __('Next <i class="t4p-icon-angle-right"></i>', 'evolve'),
                    'previouspagelink' => __('<i class="t4p-icon-angle-left"></i> Previous', 'evolve'),
                    'pagelink' => '%',
                    'echo' => 1
                ));
                ?>
            </div>
        </div>
        <?php
        $current_page_id = $post->ID;

    endwhile;

    if (is_home() || is_front_page()) :
    ?>
                </div><!--END .t4p-row-->
            </div><!--END .t4p-fullwidth-->
    <?php
    endif;

    if (is_front_page()) {
        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
    } else {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }
    $evl_portfolio_no_item_per_page = evolve_get_option('evl_portfolio_no_item_per_page', '10');
    $args = array(
        'post_type' => 'evolve_portfolio',
        'paged' => $paged,
        'posts_per_page' => $evl_portfolio_no_item_per_page,
    );
    $pcats = get_post_meta(get_the_ID(), 'evolve_portfolio_category', true);
    if ($pcats && $pcats[0] == 0) {
        unset($pcats[0]);
    }
    if ($pcats) {
        $args['tax_query'][] = array(
            'taxonomy' => 'portfolio_category',
            'field' => 'term_id',
            'terms' => $pcats
        );
    }
    $gallery = new WP_Query($args);
    if (is_array($gallery->posts) && !empty($gallery->posts)) {
        foreach ($gallery->posts as $gallery_post) {
            $post_taxs = wp_get_post_terms($gallery_post->ID, 'portfolio_category', array("fields" => "all"));
            if (is_array($post_taxs) && !empty($post_taxs)) {
                foreach ($post_taxs as $post_tax) {
                    if (is_array($pcats) && !empty($pcats) && (in_array($post_tax->term_id, $pcats) || in_array($post_tax->parent, $pcats))) {
                        $portfolio_taxs[urldecode($post_tax->slug)] = $post_tax->name;
                    }

                    if (empty($pcats) || !isset($pcats)) {
                        $portfolio_taxs[urldecode($post_tax->slug)] = $post_tax->name;
                    }
                }
            }
        }
    }

    $all_terms = get_terms('portfolio_category');
    if (!empty($all_terms) && is_array($all_terms)) {
        foreach ($all_terms as $term) {
            if (array_key_exists(urldecode($term->slug), $portfolio_taxs)) {
                $sorted_taxs[urldecode($term->slug)] = $term->name;
            }
        }
    }

    $portfolio_taxs = $sorted_taxs;

    $portfolio_category = get_terms('portfolio_category');
    if (!post_password_required($post->ID)):
        if (is_array($all_terms) && !empty($all_terms) && get_post_meta($post->ID, 'evolve_portfolio_filters', true) != 'no'):
            ?>
            <ul class="portfolio-tabs clearfix">
                <li class="active"><a data-filter="*" href="#"><?php echo __('All', 'evolve'); ?></a></li>
                <?php foreach ($all_terms as $term): ?>
                    <li><a data-filter=".<?php echo $term->slug; ?>" href="#"><?php echo $term->name; ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div class="portfolio-center">
            <div class="portfolio-wrapper clearfix">
                <?php
                while ($gallery->have_posts()): $gallery->the_post();
                    if ($pcats) {
                        $permalink = t4p_addUrlParameter(get_permalink(), 'portfolioID', $current_page_id);
                    } else {
                        $permalink = get_permalink();
                    }
                    if (has_post_thumbnail() || get_post_meta($post->ID, 'evolve_video', true)):

                        $item_classes = '';
                        $item_cats = get_the_terms($post->ID, 'portfolio_category');
                        if ($item_cats):
                            foreach ($item_cats as $item_cat) {
                                $item_classes .= urldecode($item_cat->slug) . ' ';
                            }
                        endif;
                        ?>
                        <div class="portfolio-item <?php echo $item_classes; ?>">
                            <span class="vcard" style="display: none;"><span class="fn"><?php the_author_posts_link(); ?></span></span>
                            <span class="updated" style="display: none;"><?php the_time('c'); ?></span>      
                            <?php if (has_post_thumbnail()): ?>
                                <div class="image" aria-haspopup="true">
                                    <?php
                                    $evl_portfolio_rollover = evolve_get_option('evl_portfolio_rollover', '1');
                                    if ($evl_portfolio_rollover == 0):
                                        ?>
                                        <a href="<?php echo $permalink; ?>"><?php the_post_thumbnail('full'); ?></a>
                                    <?php else: ?>
                                        <a href="<?php echo $permalink; ?>"><?php the_post_thumbnail('full'); ?></a>

                                        <?php
                                        if (get_post_meta($post->ID, 'evolve_image_rollover_icons', true) == 'link') {
                                            $link_icon_css = 'display:inline-block;';
                                            $zoom_icon_css = 'display:none;';
                                        } elseif (get_post_meta($post->ID, 'evolve_image_rollover_icons', true) == 'zoom') {
                                            $link_icon_css = 'display:none;';
                                            $zoom_icon_css = 'display:inline-block;';
                                        } elseif (get_post_meta($post->ID, 'evolve_image_rollover_icons', true) == 'no') {
                                            $link_icon_css = 'display:none;';
                                            $zoom_icon_css = 'display:none;';
                                        } else {
                                            $link_icon_css = 'display:inline-block;';
                                            $zoom_icon_css = 'display:inline-block;';
                                        }

                                        $link_target = "";
                                        $icon_url_check = get_post_meta(get_the_ID(), 'evolve_link_icon_url', true);
                                        if (!empty($icon_url_check)) {
                                            $icon_permalink = get_post_meta($post->ID, 'evolve_link_icon_url', true);
                                            if (get_post_meta(get_the_ID(), 'evolve_link_icon_target', true) == "yes") {
                                                $link_target = ' target="_blank"';
                                            }
                                        } else {
                                            $icon_permalink = $permalink;
                                        }
                                        ?>
                                        <div class="image-extras">
                                            <div class="image-extras-content">
                                                <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                                                <a style="<?php echo $link_icon_css; ?>" class="icon link-icon" href="<?php echo $icon_permalink; ?>"<?php echo $link_target; ?>>Permalink</a>
                                                <?php
                                                if (get_post_meta($post->ID, 'evolve_video_url', true)) {
                                                    $full_image[0] = get_post_meta($post->ID, 'evolve_video_url', true);
                                                }
                                                ?>
                                                <a style="<?php echo $zoom_icon_css; ?>" class="icon gallery-icon" href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery]" title="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id($post->ID)); ?>"><img style="display:none;" alt="<?php echo get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true); ?>" />Gallery</a>
                                                <br /><h3 class="entry-title"><a href="<?php echo $icon_permalink; ?>"<?php echo $link_target; ?>><?php the_title(); ?></a></h3>
                                                <br /><h4><?php echo get_the_term_list($post->ID, 'portfolio_category', '', ', ', ''); ?></h4>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php
                    endif;
                endwhile;
                ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="text-center">
            <?php
            t4p_pagination($gallery->max_num_pages, $range = 2);
            ?>
        </div>
    <?php endif; // password check    ?>    
</div>
<?php
if ($sidebar_exists == true):
    wp_reset_query();
    ?>  
    <div id="sidebar" style="<?php echo $sidebar_css; ?>" class="<?php echo $sidebar_class; ?>"><?php generated_dynamic_sidebar(); ?></div>
    <?php
endif;
get_footer();
