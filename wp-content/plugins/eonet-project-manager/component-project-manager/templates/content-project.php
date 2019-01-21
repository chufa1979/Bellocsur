<?php
/**
 * The template for displaying project content within loops
 *
 * This template can be overridden by copying it to yourtheme/eonet-project-manager/content-project.php.
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

<article data-project-id="<?php the_ID(); ?>" <?php post_class('eonet-project'); ?>>

	<?php do_action( 'eopm_before_projects_loop_item' ); ?>

	<div class="eo-project-content-box">

		<header class="eo-project-header eo_clearfix <?php echo eopm_get_featured_image_css_class( $project->post->ID ); ?>" <?php echo eopm_get_featured_image_style($project->post->ID); ?>>

			<?php
			// Project title
			echo '<h2 class="eo_project_item_title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';

			// The additional information of the project (Dates, members, etc)
			eonet_project_manager()->getTemplatePart('global/project-header.php'); ?>

		</header>

		<div class="eo_projects_loop_item_content_wrap">

			<?php

			// Project Description
			the_content();

			// Open Project Button
			eonet_project_manager()->getTemplatePart( 'loop/open-project-button.php' );
			?>
			
		</div>

	</div>
	
	<?php do_action( 'eopm_after_projects_loop_item' ); ?>

</article>
