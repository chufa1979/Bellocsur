<?php
/**
 * Template rendered through AJAX search
 * It gets the $search variable which isn't null and is safe
 */

$EonetLiveSearch = new ComponentLiveSearch\EonetLiveSearch();

// To get all WP posts :
$search_posts = $EonetLiveSearch->getPostsFetched($search);

// Orgnaized WP for the tabs :
$search_results_organized = $EonetLiveSearch->getPostsOrganize($search_posts);
$search_results_organized_count = count($search_results_organized);

// Organized Buddypress for the tabs :
$search_results_bp_organized = $EonetLiveSearch->getBuddypressResults($search);
// Get the count :
$search_buddypress_count = 0;
foreach ($search_results_bp_organized as $component=>$results) :
    foreach ($results as $id) :
        $search_buddypress_count = $search_buddypress_count + 1;
    endforeach;
endforeach;

// We get the history:
$current_history = get_user_meta(get_current_user_id(), 'eonet_search_history', true);

// DO we display the "All tabs":
$show_all = eonet_get_option('search_tab_all', 'true');

?>

<?php if(!empty($search_results_organized) || !empty($search_results_bp_organized)) : ?>

    <div class="eo_search_tabs eo_tabs">

        <ul class="eo_tabs_header">

            <?php do_action('eonet_before_search_tabs_header'); ?>

            <?php
            if( ($search_results_organized_count > 1 || $search_buddypress_count > 0) && $show_all == 'true'):
			/* All Results :  */  ?>
            <li class="eo_tab_nav">
                <a href="javascript:void(0);" data-eo-post-type="all">
                    <?php _e('All', 'eonet-live-search'); ?>
                    <span class="tag"><?php echo (count($search_posts) + $search_buddypress_count); ?></span>
                </a>
            </li>
	        <?php endif; ?>

            <?php /* Posts Results : */ ?>
            <?php foreach ($search_results_organized as $post_type=>$results) : ?>
                <?php $count = count($search_results_organized[$post_type]); ?>
                <li class="eo_tab_nav">
                    <a href="javascript:void(0);" data-eo-post-type="<?php echo $post_type; ?>">
                        <?php echo ComponentLiveSearch\EonetLiveSearch::renderTabTitle($post_type, $count); ?>
                        <span class="tag"><?php echo $count; ?></span>
                    </a>
                </li>
            <?php endforeach; ?>

            <?php /* Buddypress Results : */ ?>
            <?php foreach ($search_results_bp_organized as $component=>$results) : ?>
                <?php $count = count($search_results_bp_organized[$component]); ?>
                <li class="eo_tab_nav">
                    <a href="javascript:void(0);" data-eo-post-type="<?php echo $component; ?>">
                        <?php echo ComponentLiveSearch\EonetLiveSearch::renderTabTitle($component, $count); ?>
                        <span class="tag"><?php echo $count; ?></span>
                    </a>
                </li>
            <?php endforeach; ?>

            <?php /* History */ ?>
            <?php if(eonet_get_option('search_user_history', 'true') == true  && is_user_logged_in() && !empty($current_history)) : ?>
                <li class="eo_tab_nav">
                    <a href="javascript:void(0);" data-eo-post-type="history">
                        <i class="fa fa-history"></i>
                    </a>
                </li>
            <?php endif; ?>

            <?php do_action('eonet_after_search_tabs_header'); ?>

        </ul>

        <div class="eo_tabs_content">

            <div class="eo_tabs_content_inner">

                <?php do_action('eonet_before_search_tabs_content'); ?>

                <?php
                if(($search_results_organized_count > 1 || $search_buddypress_count > 0) && $show_all == 'true'):
                /* All Results :  */ ?>
                <div class="eo_tab_content" data-eo-post-type="all">
                    <ul class="eo_posts_list">
                        <?php foreach($search_posts as $post) : ?>
                            <?php echo ComponentLiveSearch\EonetLiveSearch::renderGetSingle($post->ID); ?>
                        <?php endforeach; ?>
                        <?php foreach ($search_results_bp_organized as $component=>$results) : ?>
                            <?php foreach ($results as $id) : ?>
                                <?php echo ComponentLiveSearch\EonetLiveSearch::renderGetSingle($id, $component); ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
	            <?php endif; ?>

                <?php /* Sorted by Post types :  */ ?>
                <?php foreach ($search_results_organized as $post_type=>$results) : ?>
                    <div class="eo_tab_content" data-eo-post-type="<?php echo $post_type; ?>">
                        <ul class="eo_posts_list">
                            <?php foreach ($results as $id) : ?>
                                <?php echo ComponentLiveSearch\EonetLiveSearch::renderGetSingle($id); ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>

                <?php /* Sorted by Buddypress components :  */ ?>
                <?php foreach ($search_results_bp_organized as $component=>$results) : ?>
                    <div class="eo_tab_content" data-eo-post-type="<?php echo $component; ?>">
                        <ul class="eo_posts_list">
                            <?php foreach ($results as $id) : ?>
                                <?php echo ComponentLiveSearch\EonetLiveSearch::renderGetSingle($id, $component); ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>


                <?php /* History :  */ ?>
                <?php if(eonet_get_option('search_user_history', 'true') == true && is_user_logged_in() && !empty($current_history)) : ?>
                    <div class="eo_tab_content" data-eo-post-type="history">
                        <?php $display_history = array_reverse($current_history); ?>
                        <ul class="eo_history_list eo_posts_list">
                            <?php foreach($display_history as $search) : ?>
                                <li><a href="javascript:void(0);"><h5><?php echo $search; ?></h5></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php do_action('eonet_after_search_tabs_content'); ?>

            </div>

        </div>

    </div>

<?php else : ?>

    <div class="eo_nothing_found text-center">
        <i class="fa fa-search"></i>
        <h4><?php _e('Nothing found... Please try something else.', 'eonet-live-search'); ?></h4>
    </div>

<?php endif; ?>
