<?php
/**
 * @package vender
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="http://schema.org/BlogPosting">

	<?php
		/**
		* vender_blog_index_thumb hook
		*
		* @hooked vender_post_thumb - 10
		*/	
		do_action( 'vender_blog_index_thumb' );
	?>
	<div class="post-content-area">
	<?php
		/**
		* vender_blog_index_header hook
		*
		* @hooked vender_post_header - 10
		*/	
		do_action( 'vender_blog_index_header' );
		/**
		* vender_blog_index_content hook
		*
		* @hooked vender_post_content - 10
		*/	
		do_action( 'vender_blog_index_content' );
	?>
	</div>
	<div class="clearfix"></div>
</article><!-- #post-## -->