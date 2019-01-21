<?php
/**
 * Private Project. It's used when the current user isn't allowed to see the content of a project
 *
 * This template can be overridden by copying it to yourtheme/eonet-project-manager/single-project/private-project.php.
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

?>

<?php
do_action( 'eopm_before_single_project' );
?>

	<article data-project-id="<?php the_ID(); ?>" id="eonet-project" <?php post_class('eonet-project eonet-single-project eonet-single-pivate-project'); ?>>

		<?php echo '<h2>' , esc_html__('Private content', 'eonet-project-manager') , '</h2>'; ?>
		<?php esc_html_e('It seems that you are not allowed to see this content', 'eonet-project-manager')?>

	</article>

<?php do_action( 'eopm_after_single_project' ); ?>