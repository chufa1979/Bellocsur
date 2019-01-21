<?php
/**
 * Content Wrapper starts
 *
 * This template can be overridden by copying it to yourtheme/eonet-project-manager/global/wrapper-start.php.
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

$template = get_option( 'template' );

switch( $template ) {
	case 'twentythirteen' :
		echo '<div id="primary" class="site-content"><div id="content" role="main" class="entry-content twentythirteen">';
		break;
	case 'twentyfourteen' :
		echo '<div id="primary" class="content-area"><div id="content" role="main" class="site-content twentyfourteen"><div class="tfwc">';
		break;
	case 'twentyfifteen' :
		echo '<div id="primary" role="main" class="content-area twentyfifteen"><div id="main" class="site-main t15wc">';
		break;
	case 'twentysixteen' :
		echo '<div id="primary" class="content-area"><main id="main" class="site-main" role="main">';
		break;
	case 'twentyseventeen' :
		echo '<div class="wrap"><div id="primary" class="content-area"><main id="main" class="site-main" role="main">';
		break;
	default :
		echo '<div id="container"><div id="content" role="main">';
		break;
}
