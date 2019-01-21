<?php
/**
 * The header of the project posts (in both loop and single project pages).
 *
 * This template can be overridden by copying it to yourtheme/eonet-project-manager/global/project-header.php.
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
/**
 * Before all the project headers
 */
do_action( 'eopm_before_project_header' );
?>

<div class="eo_single_project_header_left">

	<?php
	/**
	 * eopm_project_header_left hook.
	 *
	 * @hooked eopm_project_dates - 10
	 * @hooked eopm_project_progress - 20
	 */
	do_action('eopm_project_header_left');
	?>
	
</div>

<div class="eo_single_project_header_right">
	
	<?php
	/**
	 * eopm_project_header_right hook.
	 *
	 * @hooked eopm_render_administrators_list - 10
	 * @hooked eopm_render_members_list - 20
	 */
	do_action('eopm_project_header_right');
	?>
	
</div>

<?php
/**
 * After all the project headers
 */
do_action( 'eopm_after_project_header' ); ?>