<?php
/**
 * Template functions used for the site footer.
 *
 * @package vender
 */

if ( ! function_exists( 'vender_credit' ) ) {
	/**
	 * Display the theme credit
	 * @since  1.0.0
	 * @return void
	 */
	function vender_credit() {
		?>
		<div class="site-info">
			<?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ) ); ?>
			<?php if ( apply_filters( 'storefront_credit_link', true ) && is_home() || is_front_page()) { ?>
			<?php printf( __( '| %1$s by %2$s and %3$s.', 'vender' ), 'Powered','<a href="https://wordpress.org/" title="Blog Tool, Publishing Platform, and CMS">WordPress</a>','<a href="http://ecommercethemes.org/">EcommerceThemes.org</a>' ); ?>
			<?php } ?>
		</div><!-- .site-info -->
		<?php
	}
}