<?php
/**
 * The template for displaying project content in the single-project.php template
 *
 * This template can be overridden by copying it to yourtheme/eonet-project-manager/content-single-project.php.
 *
 * IMPORTANT: We will try to update this template file as little as possible,
 * but on occasion it will happens, above all in the early versions. When this happens,
 * you (the theme developer) will need to copy the new files to your theme to maintain compatibility.
 * If you want to avoid this, we strongly suggest you to use hooks when you can,
 * instead of override whole template files
 *
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $project;

?>

<?php do_action( 'eopm_before_single_project' ); ?>

<article data-project-id="<?php the_ID(); ?>" id="eonet-project" <?php post_class('eonet-project eonet-single-project'); ?>>

	<div class="eo-project-content-box">

		<header class="eo-project-header eo_clearfix <?php echo eopm_get_featured_image_css_class( $project->post->ID ); ?>" <?php echo eopm_get_featured_image_style($project->post->ID); ?>>

			<?php
			// Project title
			echo '<h1 class="eo_project_item_title">' . get_the_title() . '</h1>';
			?>

			<?php
			// The additional information of the project (Dates, members, etc)
			eonet_project_manager()->getTemplatePart('global/project-header.php');
			?>

		</header>

		<nav class="eo-project-nav">

			<?php
			/**
			 * eopm_sigle_project_nav hook.
			 * 
			 * @hooked eopm_render_project_nav - 10
			 */
			do_action( 'eopm_sigle_project_nav', eopm_project_nav_items($project) );
			?>

		</nav>

		<div class="eo-project-content">

			<?php
			/**
			 * eopm_single_project_content hook.
			 *
			 * @hooked eopm_single_project_sections_wrapper - 10
			 * @hooked eopm_add_custom_edit_frontend_btn - 20
			 */
			do_action( 'eopm_single_project_content', eopm_project_nav_items($project) );
			?>

		</div>

	</div>

</article>

<?php do_action( 'eopm_after_single_project' ); ?>
