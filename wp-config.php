<?php
define('WP_CACHE', true);
error_reporting(0);
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */

define( 'WPCACHEHOME', '/www/bellocsur.com/htdocs/wp-content/plugins/wp-super-cache/' );
define('DB_NAME', 'bellocsu_basewp');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'admindario');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'xJyol01btrI9');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', '192.168.0.63');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', ']o&!w(a$2]>rLB1UM~}qEf>k[egOT1h50M,bP>U58_!)@YRxFa9`0hKV>$@Y#Yh/');
define('SECURE_AUTH_KEY', '::qRnk;Xp.{N+q!eFBesDA$&f8M%zh#ETSMpmje^>,ReaE*O]CCyC4[-e`1-A?*L');
define('LOGGED_IN_KEY', '~iPcUi3SoI&rk{/|HHu-!kXZ+ t!-$7m{wWHmaT|ssVD-h (v:tFms=vJT9-b[!`');
define('NONCE_KEY', '`jp`(Tvl6jTBVUrN]{8lCTNmgp/S_db[^.-];dO73%>0Fi?N!1!UJjm^..2$6$>#');
define('AUTH_SALT', 'h_b<Do[LXwAQrV%4bEYXoDn~0.h7JqA$FE>00Q%z&&2#5G->5m+9WTVHmL6^K9@#');
define('SECURE_AUTH_SALT', 'P<~OolSwK@:$PdfU}UIf/>MoVKv%;g:IHln@$NX;%*tTdh6@T#l,YEWrMS$E.4+E');
define('LOGGED_IN_SALT', 'GnmIgL6-7v$5-<Z!RZnb.B)61TfHD-v^hA*5$!hyq;`mb(w$8?%^OK7X9llW9bi0');
define('NONCE_SALT', 'U_oU+lWE<-QQQ,G=&VQ,u59,JMN?6B%a^-.qgGVv<Y-cWf_.@`_3dw6,r#c!A/Se');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
ini_set('log_errors','On');
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');



?>