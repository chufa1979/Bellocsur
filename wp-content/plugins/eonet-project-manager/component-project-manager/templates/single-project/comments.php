<?php
/**
 * Single project section: Comments
 *
 * This template can be overridden by copying it to yourtheme/eonet-project-manager/single-project/comments.php.
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

<div class="eo-project-tab eo-project-tab-comments">

    <?php comments_template(); ?>

</div>
