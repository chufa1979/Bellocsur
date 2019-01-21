<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/eonet-project-manager/single-project.php.
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

get_header( 'eonet_pm' ); ?>

<?php
/**
 * eopm_before_main_content hook.
 *
 * @hooked eopm_main_content_wrapper_start - 10
 */
do_action( 'eopm_before_main_content' );
?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php
	global $project;

	if($project->permissions()->userCanDisplay())
		eonet_project_manager()->getTemplatePart('content-single-project.php');
	else
		eonet_project_manager()->getTemplatePart('single-project/private-project.php');

	?>

<?php endwhile; ?>

<?php
/**
 * eopm_after_main_content hook.
 *
 * @hooked eopm_main_content_wrapper_end - 10
 */
do_action( 'eopm_after_main_content' );
?>

<?php
/**
 * eopm_sidebar hook.
 *
 * @hooked eopm_render_sidebar - 10
 */
do_action( 'eopm_sidebar' );
?>

<?php get_footer( 'eonet_pm' ); ?>
