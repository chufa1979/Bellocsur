<?php
/**
 * Displayed when no projects are found matching the current query
 *
 * This template can be overridden by copying it to yourtheme/eonet-project-manager/loop/no-projects-found.php.
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
<p class="eonet-pm eonet-info"><?php esc_html_e( 'No projects were found matching your selection.', 'eonet-project-manager' ); ?></p>
