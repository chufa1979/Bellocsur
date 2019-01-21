<?php
/**
 * Class Eonet Live Search Component
 */
namespace ComponentLiveSearch;

if ( ! defined('ABSPATH') ) die('Forbidden');

if ( ! class_exists( 'WP_Query', false ) ) {
    require_once ABSPATH . 'wp-includes/query.php';
}

use WP_Query;

use Eonet\Core\EonetComponents;

if(!class_exists('ComponentLiveSearch\EonetLiveSearch')) {

    class EonetLiveSearch extends EonetComponents
    {

        /**
         * Slug of the component so we can get its details
         * @var string
         */
        public $slug = "live-search";

        /**
         * Max search queries we save for each user
         * @var int
         */
        private $max_history = 5;

        /**
         * Get the deafult post searchable :
         * @var array
         */
        public $default_post_types = array('post', 'page');

        /**
         * Construct the component :
         */
        public function __construct()
        {
            // Ajax to handle the search
            add_action('wp_ajax_eonet_fetch_search', array($this, 'ajaxHandleSearch'));
            add_action('wp_ajax_nopriv_eonet_fetch_search', array($this, 'ajaxHandleSearch'));
            // JS scripts
            add_action('wp_enqueue_scripts', array($this,'loadScripts'));
            // Parent Instance :
            parent::__construct($this->slug);
            // Action :
            do_action('eonet_search_construct');
        }

        /**
         * Add the scripts used by the extension :
         */
        public function loadScripts()
        {

            $action = 'eonet_fetch_search';

            $data = array(
                'ajax_url' => admin_url( 'admin-ajax.php' ),
                'search_minimum' => eonet_get_option('search_minimum', '3'),
                'search_selector' => eonet_get_option('search_field', '#s'),
                'search_box_width' => eonet_get_option('search_box_width', '400'),
                'search_history' => eonet_get_option('search_user_history', 'true'),
                'search_nonce' => wp_create_nonce( $action . '_nonce' ),
                'search_action' => $action,
                'search_label_results' => __('Search result(s) for', 'eonet-live-search')
            );

            wp_enqueue_script( $this->slug.'-script', $this->getUrl($this->slug) . '/assets/js/eonet_live_search.js', array('jquery'), 1.0, true );
            wp_localize_script( $this->slug.'-script', 'EONET_SEARCH', $data);

        }

        /**
         * Handle ajax query from the search form :
         * We return directly the HTML that'll be outputed under the search form
         */
        public function ajaxHandleSearch()
        {
            // We check whether it's from our page or not.
            check_ajax_referer( 'eonet_fetch_search_nonce', 'security' );

            // We get the query & make it safe :
            $search = (isset($_POST['s'])) ? sanitize_text_field($_POST['s']) : '';

            do_action('eonet_search_fire', $search);

            if(!empty($search)) {
                // We save the search for the user if it's enabled :
                if(eonet_get_option('search_user_history', 'true') == true) {
                    $this->historyUpdate($search);
                }
                // We render the view :
                echo eonet_render_view($this->getPath($this->slug).'/views/results.php', array('search' => $search));
            }

            // We stop it :
            wp_die();

        }

        /**
         * Function to run the WP loop on the requested post types
         * @param $search : the search query
         * @return array : all matched posts as an array
         */
        public function getPostsFetched($search){
            // We make the main query and only take the ids so it's fast :
            $search_args = array(
                's' => $search,
                'fields' => array('ids', 'post_type'),
                'post_type' => eonet_get_option('search_post_types', $this->default_post_types)
            );
            $search_query = new WP_Query($search_args);
            if ( $search_query->have_posts() ) :
                // We save the results :
                $search_posts = $search_query->posts;
                wp_reset_postdata();
            else :
                $search_posts = array();
            endif;
            return $search_posts;
        }

        /**
         * Function to grab the Buddypress related items from the search
         * @param $search : the search query
         * @return array
         */
        public function getBuddypressResults($search){

            // We get were we should look :
            $components_allowed = eonet_get_option('search_buddypress_components', array('nope'));

            // If it's allowed :
            if($components_allowed == 'nope' || !function_exists('bp_is_active')) {
                return array();
            }

            // This is where we save the results :
            $search_results_bp_organized = array();

            // We go for the members :
            if(in_array('members', $components_allowed) && bp_is_active('members')){
                $members_args = array(
                    'search_terms' => $search,
                );
                $members_fetched = bp_core_get_users($members_args);
                if($members_fetched['total'] > 0) {
                    $all_users_fetched = array();
                    foreach ($members_fetched['users'] as $member) {
                        $all_users_fetched[] = $member->ID;
                    }
                    if(!empty($all_users_fetched)) {
                        $search_results_bp_organized['members'] = $all_users_fetched;
                    }
                }
            }

            // We go for the groups :
            if(in_array('groups', $components_allowed) && bp_is_active('groups')){
                $groups_args = array(
                    'search_terms' => $search,
                    'per_page' => -1
                );
                $groups_fetched = groups_get_groups($groups_args);
                if($groups_fetched['total'] > 0) {
                    $all_groups_fetched = array();
                    foreach ($groups_fetched['groups'] as $group) {
                        $all_groups_fetched[] = $group->id;
                    }
                    if(!empty($all_groups_fetched)) {
                        $search_results_bp_organized['groups'] = $all_groups_fetched;
                    }
                }
            }

            // We go for the activity :
            if(in_array('activity', $components_allowed) && bp_is_active('activity')){
                $activities_args = array(
                    'search_terms' => $search,
                );
                $activities_fetched = bp_activity_get($activities_args);
                if(count($activities_fetched['activities']) > 0) {
                    $all_activities_fetched = array();
                    foreach ($activities_fetched['activities'] as $activity) {
                        $all_activities_fetched[] = $activity->id;
                    }
                    if(!empty($all_activities_fetched)) {
                        $search_results_bp_organized['activities'] = $all_activities_fetched;
                    }
                }
            }

            return $search_results_bp_organized;

        }


        /**
         * Function to organize the posts per post types found
         * @param $search_posts : array of posts
         * @return array : array([post_type] => array(..))
         */
        public function getPostsOrganize($search_posts){

            // Array used to be displayed containing all informations we need from the loop :
            $search_results_organized = array();
            if(!empty($search_posts)){
                foreach($search_posts as $post) {
                    // We build the main array :
                    if(!array_key_exists($post->post_type, $search_results_organized)) {
                        $search_results_organized[$post->post_type] = array();
                    }
                    if(in_array($post->post_type, eonet_get_option('search_post_types', $this->default_post_types))) {
                        array_push($search_results_organized[$post->post_type], $post->ID);
                    }
                }
            }

            return $search_results_organized;
        }

        /**
         * Save search for an user, to build his search history :
         * @param $search : the search query
         * @return bool
         */
        private function historyUpdate($search)
        {
            // Only if the user is logged in :
            if(!is_user_logged_in()) {
                return null;
            }

            // Current user id :
            $user_id = get_current_user_id();

            // Deleting them (DEBUG) :
            //delete_user_meta($user_id, 'eonet_search_history');

            // We get the current value or create a new one :
            $current_history = get_user_meta($user_id, 'eonet_search_history', true);
            $current_history = (!empty($current_history)) ? $current_history : array();

            // We push it if it doesn't exist only :
            $needles = array($search, strtolower($search), ucfirst($search), strtoupper($search));
            $diff = array_diff($current_history, $needles);
            if(count($diff) == count($current_history)) {
                // If the history is already full, we remove the oldest searches :
                if(count($current_history) >= $this->max_history) {
                    // We remove the first row which is the oldest valye
                    array_splice($current_history, 0, 1);
                }
                // We add
                $current_history[] = $search;
            }

            $new_history = $current_history;

            // We update it :
            $update = (!empty($new_history)) ? update_user_meta($user_id, 'eonet_search_history', $new_history) : false;
            return $update;
        }

        /**
         * Returns HTML layout for a single post with a list
         * @param $id : post's ID
         * @param $type : type of the object -> posts | groups | members | activities
         * @return string : the HTML
         */
        static function renderGetSingle($id, $type = 'posts')
        {

            // If it's a member :
            if ($type == 'members') {
                $link = bp_core_get_user_domain($id);
                $title = bp_core_get_username($id);
            }
            // If it's a group :
            elseif ($type == 'groups') {
                $link = bp_get_group_permalink($id);
                // We get its details :
                $group_object = groups_get_group( array( 'group_id' => $id ) );
                $title = $group_object->name;
            }
            // If it's an activity :
            elseif ($type == 'activities') {
                $link = bp_activity_get_permalink($id);
                // We get its details :
                $activity_query = bp_activity_get_specific(array('activity_ids' => $id));
                $activity_object = $activity_query['activities'][0];
                $title = $activity_object->content;
            }
            // If it's a post :
            else {
                $link = get_the_permalink($id);
                $title = get_the_title($id);
            }

            // Extra data to add :
            $extra = '';
            if(function_exists('wc_get_product')){
                $current_product = wc_get_product( $id );
                if(!is_bool($current_product)) {
                    $extra = $current_product->get_price_html();
                }
            }

            $output = '<li class="eo_single_post" data-eo-post-id="'. $id .'">';
                $output .= '<a href="'. $link .'">';
                    // if it's an activity we display the user's thumb so we need his ID instead
                    $id = ($type == 'activities' && isset($activity_object)) ? $activity_object->user_id : $id;
                    $output .= self::getThumb($id, $type, $title);
                    $output .= '<h5>'. self::renderTitle($title) .' '.$extra.'</h5>';
                $output .= '</a>';
            $output .= '</li>';
            return $output;

        }

        /**
         * Render the title of the item in the search list
         * @param $title
         * @return string
         */
        static function renderTitle($title)
        {

            // max length :
            $max = 38;

            // Remove HTML:
            $title = wp_strip_all_tags($title);

            // Remove back slashes
            $title = stripslashes($title);

            // If too long :
            if (strlen($title) > $max) {
                $title_cut = substr($title, 0, $max);
                $title = substr($title_cut, 0, strrpos($title_cut, ' ')).'...';
            }

            // We return :
            return $title;

        }

        /**
         * Render the tab's title
         * @param $type
         * @param $count
         * @return string
         */
        static function renderTabTitle($type, $count)
        {

            // For members :
            if($type == 'members') {
                $title = ($count > 1) ? __('Members','eonet-live-search') : __('Member', 'eonet-live-search');
            }
            // For groups :
            elseif ($type == 'groups') {
                $title = ($count > 1) ? __('Groups','eonet-live-search') : __('Group', 'eonet-live-search');
            }
            // For activities :
            elseif ($type == 'activities') {
                $title = ($count > 1) ? __('Activities','eonet-live-search') : __('Activity', 'eonet-live-search');
            }
            // For custom post types :
            else {
                $post_obj = get_post_type_object( $type );
                if(!empty($post_obj)) {
                    $title = ($count > 1) ? $post_obj->labels->name : $post_obj->labels->singular_name;
                } else {
                    $title = '';
                }
            }

            /**
             * Filter to change the tabs titles
             * @since 1.0.2
             * @param $title string the title returned
             * @param $type string the type of result: members \ groups \ activities \ post-type-name
             */
            return apply_filters( 'eonet_search_tab_title', $title, $type );

        }

        /**
         * Create a thumb or use an existing one for possible types returned by the search
         * @param $id : the post id of the 'object'
         * @param $type : the type of thumb we need -> posts | groups | members | activities
         * @param $title : the title to use if there isn't any photo, we add it here to avoid 2 queries
         * @return string : the HTML markup
         */
        public function getThumb($id, $type = 'posts', $title){

            $html = '<span class="eo_thumb_wrapper">';

            if ($type == 'posts'){
                if(has_post_thumbnail($id)) {
                    // We return the thumb :
                    $html .= get_the_post_thumbnail($id, 'thumbnail');
                } else {
                    // We return the first later :
                    $html .= '<b>'.substr($title,0,1).'</b>';
                }
            } elseif($type == 'members' || $type == 'activities') {
                $html .= get_avatar( $id );
            } elseif($type == 'groups') {
                $html .= bp_core_fetch_avatar( array(
                    'item_id'    => $id,
                    'title'      => $title,
                    'avatar_dir' => 'group-avatars',
                    'object'     => 'group'
                ) );
            }

            $html .= '</span>';

            return $html;
        }


    }

    // We start it :
    new EonetLiveSearch();

}