<?php
/**
* Class Eonet Project Manager Component
*/
namespace ComponentProjectManager;

use ComponentProjectManager\classes\Eonet_PM_Project;
use Eonet\Core\EonetComponents;
use ComponentProjectManager\classes\Eonet_PM_TaskRendering;

if ( ! defined('ABSPATH') ) die('Forbidden');


if(!class_exists('ComponentProjectManager\EonetProjectManager')) {

	class EonetProjectManager extends EonetComponents{

		/**
		 * Slug of the component so we can get its details
		 * @var string
		 */
		public $slug = "project-manager";

		/**
		 * Construct the component :
		 */
		public function __construct()
		{
			// Parent Instance :
			parent::__construct($this->slug);

			//Load Styles & Scripts
			add_action('admin_enqueue_scripts', array($this,'loadScripts'));
            add_action('wp_enqueue_scripts', array($this,'loadScripts'));
			
			//Regsiter Custom Post Types
			add_action( 'init', array( $this, 'register_project_post_type' ) );
			add_action( 'init', array( $this, 'register_project_taxonomy' ) );
			add_action( 'init', array( $this, 'register_task_post_type' ) );

			//Flush rewrite urls to avoid 404 errors or empty pages
			add_action('eonet_admin_settings_saved', 'flush_rewrite_rules' );
			add_action('save_post', array($this, 'rewrite_rules_on_projects_page_editing') );

			$theme = wp_get_theme();
			if( $theme == 'Twenty Seventeen' || $theme == 'Twenty Seventeen Child')
				add_action( 'wp_head', array($this, 'loadTwentyseventeenScript') );

			do_action('eonet_project_manager_construct');
		}

		public function loadScripts() {
			
			if ( !eopm_is_projects_page() && !(is_admin() && get_current_screen()->post_type == Eonet_PM_Project::POST_TYPE))
				return;

			wp_enqueue_script( $this->slug.'-script', $this->getUrl($this->slug) . '/assets/js/eonet_project_manager.js', array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'jquery-ui-autocomplete', 'jquery-ui-accordion', 'jquery-ui-sortable'), null, true );

            wp_enqueue_style( $this->slug.'-style', $this->getUrl($this->slug) . '/assets/css/eonet-project-manager-style.min.css');

            wp_enqueue_style( 'jquery-ui-datepicker', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );

            $blank_task = new Eonet_PM_TaskRendering();

            $data = array(
                'task_template' => $blank_task->getBackendLayout()
            );

            wp_localize_script($this->slug . '-script', 'EONET_PROJECTS', $data);

			$ajax_url = apply_filters( 'eopm_ajax_url', admin_url( 'admin-ajax.php', is_ssl() ? 'admin' : 'http' ) );
			wp_localize_script( $this->slug.'-script', 'eopm_ajax_object', array( 'ajax_url' => $ajax_url ) );


		}
		
		public function loadTwentyseventeenScript() {

			echo '<script>
				$ = jQuery.noConflict();
				$(window).load( function() {
	
					//Twentyseventeen integration
					var $primary = $("#primary"),
	                   $secondary = $("#secondary");
	        			
	        			if($primary.length > 0 && $secondary.length > 0) {
		        			$("body").addClass("has-sidebar");
	        			}
			    });
			    </script>';
			
		}
		
		public function rewrite_rules_on_projects_page_editing( $post_id ) {

			$is_autosave = wp_is_post_autosave( $post_id );
			$is_revision = wp_is_post_revision( $post_id );

			if ( $is_autosave || $is_revision ) {
				return;
			}

			if($post_id != eopm_get_loop_page_id())
				return;

			flush_rewrite_rules();
		}

		/**
		 *
		 */
		public function register_project_post_type() {

			$labels = array(
				'name'               => __( 'Projects', 'eonet-project-manager' ),
				'singular_name'      => __( 'Project', 'eonet-project-manager' ),
				'menu_name'          => __( 'Projects', 'eonet-project-manager' ),
				'name_admin_bar'     => __( 'Project', 'eonet-project-manager' ),
				'add_new'            => __( 'Add New', 'eonet-project-manager' ),
				'add_new_item'       => __( 'Add New Project', 'eonet-project-manager' ),
				'new_item'           => __( 'Project', 'eonet-project-manager' ),
				'edit_item'          => __( 'Edit Project', 'eonet-project-manager' ),
				'view_item'          => __( 'View Project', 'eonet-project-manager' ),
				'all_items'          => __( 'All Projects', 'eonet-project-manager' ),
				'search_items'       => __( 'Search Project', 'eonet-project-manager' ),
				'not_found'          => __( 'No Project found.', 'eonet-project-manager' ),
				'not_found_in_trash' => __( 'No Project found in Trash.', 'eonet-project-manager' )
			);

			$labels = apply_filters('eopm_post_type_labels', $labels);

			$slug = apply_filters('eopm_post_type_slug', 'project');

			$supports = apply_filters('eopm_post_type_supports', array( 'title', 'editor','thumbnail', 'revisions', 'author', 'comments' ));

			$has_archive = ( $loop_page_id = eonet_get_option( 'pm_projects_page_id' ) ) && get_post( $loop_page_id ) ? get_page_uri( $loop_page_id ) : 'projects';

			$capabilities = array(

				//Meta
				'edit_post' => 'manage_options',
				'delete_post' => 'manage_options',
				'read_post' => 'manage_options',

				// Primitive capabilities used outside of map_meta_cap():
				'edit_posts' => 'manage_options',
				'edit_others_posts' => 'manage_options',
				'publish_posts' => 'manage_options',
				'read_private_posts' => 'manage_options',

				// Primitive capabilities used within map_meta_cap():
				'read' => 'manage_options',
				'edit_private_posts' => 'manage_options',
				'edit_published_posts' => 'manage_options',
				'delete_posts' => 'manage_options',
				'delete_others_posts' => 'manage_options',
				'delete_private_posts' => 'manage_options',
				'delete_published_posts' => 'manage_options',


			);
			$capabilities = apply_filters('eopm_post_type_capabilities', $capabilities);

			$args = array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'menu_icon' => 'dashicons-index-card',
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => $slug, 'with_front' => false, 'feeds' => true ),
				'capabilities'    => $capabilities,
				//'map_meta_cap'       => true,
				'has_archive'        => $has_archive,
				'hierarchical'       => true,
				'menu_position'      => null,
				'supports'           => $supports
			);

			$args = apply_filters('eopm_post_type_args', $args, $labels);

			register_post_type( Eonet_PM_Project::POST_TYPE, $args );


		}

		public function register_project_taxonomy() {

			$labels = array(
				'name'              => __( 'Project Categories', 'eonet-project-manager' ),
				'singular_name'     => __( 'Project Category', 'eonet-project-manager' ),
				'search_items'      => __( 'Search Project Categories', 'eonet-project-manager' ),
				'all_items'         => __( 'All Project Categories', 'eonet-project-manager' ),
				'edit_item'         => __( 'Edit Category', 'eonet-project-manager' ),
				'update_item'       => __( 'Update Project Category', 'eonet-project-manager' ),
				'add_new_item'      => __( 'Add New Project Category', 'eonet-project-manager' ),
				'new_item_name'     => __( 'New Project Category', 'eonet-project-manager' ),
				'menu_name'         => __( 'Categories', 'eonet-project-manager' ),
			);

			$slug = apply_filters('eopm_taxonomy_slug', Eonet_PM_Project::CATEGORY_SLUG);

			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => false,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => $slug ),
			);

			register_taxonomy( 'project-category', array( Eonet_PM_Project::POST_TYPE ), $args );

		}

		public function register_task_post_type() {

			$labels = array(
				'name'               => __( 'Tasks', 'eonet-project-manager' ),
				'singular_name'      => __( 'Task', 'eonet-project-manager' ),
				'menu_name'          => __( 'Tasks', 'eonet-project-manager' ),
				'name_admin_bar'     => __( 'Task', 'eonet-project-manager' ),
				'add_new'            => __( 'Add New', 'eonet-project-manager' ),
				'new_item'           => __( 'Task', 'eonet-project-manager' ),
				'edit_item'          => __( 'Edit Task', 'eonet-project-manager' ),
				'view_item'          => __( 'View Task', 'eonet-project-manager' ),
				'all_items'          => __( 'All Tasks', 'eonet-project-manager' ),
				'search_items'       => __( 'Search Task', 'eonet-project-manager' ),
				'not_found'          => __( 'No Task found.', 'eonet-project-manager' ),
				'not_found_in_trash' => __( 'No Task found in Trash.', 'eonet-project-manager' )
			);

			$labels = apply_filters('eopm_post_type_task_labels', $labels);

			$slug = apply_filters('eopm_post_type_task_slug', 'task');

			$supports = apply_filters('eopm_post_type_task_supports', array( 'title', 'editor', 'author', 'comments' ));

			$args = array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'exclude_from_search'=> true,
				'query_var'          => false,
				'has_archive'        => false,
				'show_ui'            => false,
				'show_in_nav_menus'  => false,
				'menu_icon'          => 'dashicons-index-card',
				'show_in_menu'       => true,
				'rewrite'            => array( 'slug' => $slug ),
				//'capability_type'    => array('task', 'tasks'),
				//'map_meta_cap'       => true,
				'hierarchical'       => true,
				'menu_position'      => null,
				'supports'           => $supports
			);

			$args = apply_filters('eopm_post_type_task_args', $args, $labels, $slug, $supports);

			register_post_type( 'eopm_task', $args );


		}

		//TODO François: I tryied to make these 2 functions available to every component without rewrite every time but I didn't find a way
		//They should be placed in EonetComponenets and automatically used be the child classes, without pass the slug parameter

		/**
		 * Include the template file of the template name passed by parameter
		 *
		 * @param $template_name
		 */
		public function getTemplatePart( $template_name ) {

			$template = $this->getTemplatePartPath( $template_name );

			do_action( 'eonet_before_template_part', $template_name );

			include $template ;

			do_action( 'eonet_after_template_part', $template_name );
		}

		/**
		 * Return the path of the requested template
		 *
		 * @param string $template_name The name of the file to include
		 * @throws \Exception
		 * @return string|void
		 */
		public function getTemplatePartPath( $template_name ) {
			$template_path = $this->getPath( $this->slug ) . '/templates/';

			//The templace to include from the plugin
			$template = $template_path . $template_name;


			// Check if there is a template in the theme
			$theme_template = locate_template(
				array(
					trailingslashit( apply_filters('eopm_theme_templates_path', 'eonet-project-manager/') ) . $template_name,
					$template_name
				)
			);

			$disable_theme_templates = apply_filters('eopm_disable_theme_template_files', false);

			// Use the template from the theme if it's present
			if(!empty($theme_template) && !$disable_theme_templates)
				$template = $theme_template;

			if ( ! file_exists( $template ) ) {
				_doing_it_wrong( __FUNCTION__, sprintf( 'The file <code>%s</code> does not exist.', $template ), '4.6.1' );

				if(WP_DEBUG === true) {
					throw new \Exception(sprintf( 'The file %s does not exist.', $template ));
				}

				return;
			}

			return $template;
		}
	}
}
?>