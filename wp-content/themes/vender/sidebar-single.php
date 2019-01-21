<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package vender
 */

if ( is_active_sidebar( 'post-sidebar' ) ) {
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'post-sidebar' ); ?>
</div><!-- #secondary -->

<?php } else { get_sidebar(); } ?>