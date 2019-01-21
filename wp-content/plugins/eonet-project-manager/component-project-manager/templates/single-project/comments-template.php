<?php
/**
 * The template for displaying comments on a single project page
 *
 * This template can be overridden by copying it to yourtheme/eonet-project-manager/single-project/comments-template.php.
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

<div id="eonet-pm-comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title eonet-pm-comment-title">
			<?php
			$comments_number = get_comments_number();
			if ( 1 === $comments_number ) {
				/* translators: %s: post title */
				esc_html_x( 'One message presents', 'project comments title', 'eonet-project-manager' );
			} else {
				printf(
				/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s message presents',
						'%1$s messages present',
						$comments_number,
						'project comments title',
						'eonet-project-manager'
					),
					number_format_i18n( $comments_number )
				);
			}
			?>
		</h2>

		<?php //the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 42,
				'per_page' => -1
			) );
			?>
		</ol><!-- .comment-list -->

		<?php //the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments eonet-pm-no-comments"><?php esc_html_e( 'Messages are suspended.', 'eonet-project-manager' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form( array(
		'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
		'title_reply_after'  => '</h2>',
		'title_reply' => esc_html__( 'Leave a message', 'eonet-project-manager' ),
		'title_reply_to' => esc_html__( 'Leave a message to %s', 'eonet-project-manager' ),
		'cancel_reply_link' => esc_html__( 'Cancel message', 'eonet-project-manager' ),
		'label_submit' => esc_html__( 'Send message', 'eonet-project-manager' )
	) );
	?>

</div><!-- .comments-area -->
