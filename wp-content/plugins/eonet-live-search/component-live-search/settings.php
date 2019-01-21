<?php
/**
 * Component settings, used in the Eonet admin pages
 */

/**
 * Get array of all post types :
 */
$post_types = Eonet\Core\EonetOptions::getPostTypesArray();

/**
 * Buddypress components :
 */
$buddypress_components = array();
if(function_exists('bp_is_active')) {
    $buddypress_components['members'] = __('Members','eonet-live-search');
    if(bp_is_active('groups')) {
        $buddypress_components['groups'] = __('Groups','eonet-live-search');
    }
    if(bp_is_active('activity')) {
        $buddypress_components['activity'] = __('Activity','eonet-live-search');
    }
    $buddypress_components['nope'] = __('None of them','eonet-live-search');
} else {
    $buddypress_components['nope'] = __('BuddyPress is not installed...', 'eonet-live-search');
}

$settings = array(
    array(
        'name'      => 'search_user_history',
        'type'      => 'switch',
        'label'     => __('User history', 'eonet-live-search'),
        'desc'      => __('Save user\'s searches, so he can use his history on new search.', 'eonet-live-search'),
        'val'       => true
    ),
    array(
        'name'      => 'search_post_types',
        'type'      => 'select',
        'label'     => __('Post types included', 'eonet-live-search'),
        'desc'      => __('Select the post types which will be searched during the search.', 'eonet-live-search'),
        'multiple'  => true,
        'val'       => 'page',
        'choices'   => $post_types
    ),
    array(
        'name'      => 'search_buddypress_components',
        'type'      => 'select',
        'label'     => __('Buddypress components included', 'eonet-live-search'),
        'desc'      => __('Select the Buddypress components which will be searched during the search.', 'eonet-live-search'),
        'multiple'  => true,
        'val'       => 'members',
        'choices'   => $buddypress_components
    ),
    array(
        'name'      => 'search_field',
        'type'      => 'text',
        'label'     => __('Field selector', 'eonet-live-search'),
        'desc'      => __('Optional search field selector like : "#my-search" so only this one will be affected by the plugin.', 'eonet-live-search'),
        'val'       => '#s'
    ),
    array(
        'name'      => 'search_minimum',
        'type'      => 'text',
        'label'     => __('Minimum length', 'eonet-live-search'),
        'desc'      => __('Minimum number of characters before triggering the search.', 'eonet-live-search'),
        'val'       => '3'
    ),
    array(
        'name'      => 'search_tab_all',
        'type'      => 'switch',
        'label'     => __('Tab "All"', 'eonet-live-search'),
        'desc'      => __('Display a tab with all results fetched.', 'eonet-live-search'),
        'val'       => true
    ),
    array(
        'name'      => 'search_box_width',
        'type'      => 'text',
        'label'     => __('Box width', 'eonet-live-search'),
        'desc'      => __('It will be adjusted automatically on small devices.', 'eonet-live-search'),
        'val'       => '400'
    ),
);