<?php
/*
Plugin Name: Eonet Project Manager
Plugin URI: https://wordpress.org/plugins/eonet-project-manager/
Description: Make your site a complete project management tool: create projects, set permissions and assign tasks your users.
Text Domain: eonet-project-manager
Domain Path: /languages/
Author: Alkaweb
Author URI: http://alka-web.com/
Version: 1.0.4
License: GPL2
*/
if ( ! defined('ABSPATH') ) die('Forbidden') ;

/**
 * We define the main directory constant :
 */
if ( ! defined( 'EONET_DIR' ) ) {
    define( 'EONET_DIR', plugin_dir_path( __FILE__ ) );
}

/**
 * We define the asset directory constant :
 */
if ( ! defined( 'EONET_ASSETS_URL' ) ) {
    define( 'EONET_ASSETS_URL', plugin_dir_url( __FILE__ ).'core/assets' );
}

/**
 * We check the PHP version to make sure it's above 5.3
 * Mainly because we're using namespaces
 */
if ( version_compare( PHP_VERSION, '5.3', '<' ) ) {
    exit( sprintf( 'Foo requires PHP 5.3 or higher. You’re still on %s.', PHP_VERSION ) );
}

/**
 * For Dev purpose and testing, as dev directory is different,
 * define( 'EONET_DEV_MAIN_REPO', true );
 */

/**
 * We load all the Eonet framework from here :
 */
if (!defined('Eonet') && !defined('EONET_DEV_MAIN_REPO')) {
    require EONET_DIR . 'core/bootstrap.php';
}
/**
 * We load all components init files :
 */
$components_folders = glob(plugin_dir_path( __FILE__ ).'component-*/', GLOB_ONLYDIR);
foreach ($components_folders as $component_folder) {
    $component_path = $component_folder.'init.php';
    if(file_exists($component_path)) {
        require_once($component_path);
    }
}

