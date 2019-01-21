<?php

namespace ComponentProjectManager\classes;


if ( ! defined('ABSPATH') ) die('Forbidden');

/**
 * Class Eonet_PM_TemplateLoader
 *
 * Handle the loaidng of the custom templates for the Eonet Project Manager Sections
 *
 * @package ComponentProjectManager\classes
 */
class Eonet_PM_TemplateLoader {

	protected static $instance = null;
	
	protected function __construct(){
		add_filter( 'template_include', array( $this, 'template_loader' ) );
	}

	public static function instance() {
		if(is_null(static::$instance))
			static::$instance = new static();

		return static::$instance;
	}

	function template_loader( $template ) {

		if ( is_embed() ) {
			return $template;
		}

		global $post;

		$file = '';

		$loop_page_id = eopm_get_loop_page_id();

		if ( is_single() && $post->post_type == Eonet_PM_Project::POST_TYPE ) {
			$file = 'single-project.php';
		} elseif ( is_post_type_archive( Eonet_PM_Project::POST_TYPE )
		           || $loop_page_id && is_page( $loop_page_id ) && !is_front_page() ) {
			$file 	= 'archive-projects.php';
		}

		if ( $file ) {
			return eonet_project_manager()->getTemplatePartPath($file);
		}

		return $template;
	}
}

Eonet_PM_TemplateLoader::instance();
