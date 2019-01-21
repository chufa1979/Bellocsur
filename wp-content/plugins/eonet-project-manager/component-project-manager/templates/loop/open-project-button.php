<?php
/**
 * The "See Project" button displayed in the loop. It allows to reach the single project page
 *
 * This template can be overridden by copying it to yourtheme/eonet-project-manager/loop/open-project-button.php.
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

<div class="eo_projects_open_project_wrap">
	<a class="eo_projects_open_project eo_btn eo_btn_default" href="<?php echo get_permalink()?>"><i class="ion-android-open"></i><?php esc_html_e('See Project', 'eonet-project-manager'); ?></a>
</div>
