<?php
/**
 * @package vender
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="http://schema.org/BlogPosting">
	<?php
	/**
	 * @hooked vender_post_meta - 10
	 */
		do_action('vender_blog_post_content');

	/**
	 * @hooked storefront_post_content - 20
	 */
		do_action('vender_single_post');
		
	/**
	 * Functions hooked in to storefront_single_post_after action
	 *
	 * @hooked storefront_post_nav         - 10
	 * @hooked storefront_display_comments - 20
	 */
	do_action( 'storefront_single_post_bottom' );
	?>
</article><!-- #post-## -->