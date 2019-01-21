<?php

namespace ComponentProjectManager\classes;


if ( ! defined('ABSPATH') ) die('Forbidden');

class Eonet_PM_Security {
	protected static $instance = null;

	protected function __construct(){
		add_filter( 'pre_get_posts', array( $this, 'hideProjectsInFrontend' ) );
		add_filter( 'pre_get_posts', array( $this, 'hideProjectsFromSearchResults' ) );
	}

	public static function instance() {
		if(is_null(static::$instance))
			static::$instance = new static();

		return static::$instance;
	}

	/**
	 * Find all the projects not allowed to the current user and exclude them from the loop
	 *
	 * @param \WP_Query $query
	 *
	 * @return \WP_Query
	 */
	public function hideProjectsInFrontend($query) {

		if(is_admin()
		   || current_user_can('manage_options')
		   || (!$query->is_main_query())
		   || is_single()
		)
			return $query;

		//Ensure that is a loop of projects
		if( isset($query->query['post_type']) && $query->query['post_type'] != Eonet_PM_Project::POST_TYPE)
			return $query;

		//Additional flag to check
		if(isset($query->query['eopm_include_all_projects']) && $query->query['eopm_include_all_projects'])
			return $query;

		$args = array(
			'post_type' => Eonet_PM_Project::POST_TYPE,
			'posts_per_page' => '-1',
			'eopm_include_all_projects' => true,
		);

		$excluded_posts = $this->getExcludedProjects( $args );

		//If not exclude it from the real query call
		if(!empty($excluded_posts))
			$query->set('post__not_in', $excluded_posts);

		return $query;
	}

	/**
	 * @param \WP_Query $query
	 *
	 * @return \WP_Query
	 */
	public function hideProjectsFromSearchResults( $query ) {
		if(is_admin() || current_user_can('manage_options') || !$query->is_search() || is_single())
			return $query;

		//Additional flag to check
		if(isset($query->query['eopm_include_all_projects']) && $query->query['eopm_include_all_projects'])
			return $query;

		//Set args for the new query and add a flag to detect it
		$args = array(
			's' => $query->query['s'],
			'posts_per_page' => '-1',
			'eopm_include_all_projects' => true,
		);

		$excluded_posts = $this->getExcludedProjects( $args );

		//If not exclude it from the real query call
		if(!empty($excluded_posts))
			$query->set('post__not_in', $excluded_posts);

		return $query;
	}

	/**
	 * @param $args arguments for the WP_Query function
	 *
	 * @return array Array of post ids
	 */
	protected function getExcludedProjects( $args ) {

		$my_query = new \WP_Query($args);

		$excluded_posts = array();

		if (!isset($my_query->posts)) {
			wp_reset_postdata();
			return $excluded_posts;
		}

		//For each post of the search results
		foreach ($my_query->posts as $post) {

			if($post->post_type != Eonet_PM_Project::POST_TYPE)
				continue;

			//Check if the post is allowed
			$project = new Eonet_PM_Project($post);

			//eonet_print($project->getVisibilityPermissions());

			if(!$project->permissions()->userCanDisplay())
				array_push($excluded_posts, $post->ID);

		}

		wp_reset_postdata();

		return $excluded_posts;

	}
}

Eonet_PM_Security::instance();