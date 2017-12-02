<?php
## Disable Editing in Dashboard

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
if(strpos($_SERVER['HTTP_HOST'],'discovertaitung.com')!==false||$_SERVER["HTTP_HOST"]==='210.61.119.13'){
  $db_name='taitungdb';
  $db_user='taitungdba';
  $db_pass='JcS1VVf4gm0lj2Ia';
  $db_host='210.65.10.177';
  define('AUTOMATIC_UPDATER_DISABLED',true);
  //define('COOKIE_DOMAIN', 'ec2-52-76-231-110.ap-southeast-1.compute.amazonaws.com');
  define('DISALLOW_FILE_EDIT',false);
  define('WP_CACHE',true);
  define('WP_DEBUG',false);
  define('WP_DEBUG_LOG',true);
  define('WP_DEBUG_DISPLAY',false);
  define('SCRIPT_DEBUG',false);
	ini_set('log_errors','On');
	ini_set('display_errors','Off');
	ini_set('error_reporting', E_ALL );
}elseif($_SERVER["HTTP_HOST"]==='ec2-52-76-231-110.ap-southeast-1.compute.amazonaws.com'){
  $db_name='taitungdb';
  $db_user='taitungdba';
  $db_pass='53e=RaBUzEtE';
  $db_host='localhost';
  define('AUTOMATIC_UPDATER_DISABLED',true);
  //define('COOKIE_DOMAIN', 'ec2-52-76-231-110.ap-southeast-1.compute.amazonaws.com');
  define('DISALLOW_FILE_EDIT',false);
  define('WP_CACHE',false);
  define('WP_DEBUG',true);
  define('WP_DEBUG_LOG',true);
  define('WP_DEBUG_DISPLAY',false);
  define('SCRIPT_DEBUG',true);
  @ini_set('display_errors',1);
}elseif($_SERVER["HTTP_HOST"]==='106.14.57.109'){
  $db_name='taitungdb';
  $db_user='taitungdba';
  $db_pass='53e=RaBUzEtE';
  $db_host='localhost';
/*
  $db_name='taitungdb_aliyun_staging';
  $db_user='taitungdba';
  $db_pass='JcS1VVf4gm0lj2Ia';
  $db_host='210.65.10.177';
*/
  define('AUTOMATIC_UPDATER_DISABLED',true);
  //define('COOKIE_DOMAIN', 'ec2-52-76-231-110.ap-southeast-1.compute.amazonaws.com');
  define('DISALLOW_FILE_EDIT',false);
  define('WP_CACHE',false);
  define('WP_DEBUG',false);
  define('WP_DEBUG_LOG',true);
  define('WP_DEBUG_DISPLAY',false);
  define('SCRIPT_DEBUG',true);
  @ini_set('display_errors',1);
}


define('DB_NAME', $db_name);

/** MySQL database username */
define('DB_USER', $db_user);

/** MySQL database password */

// staging
// define('DB_PASSWORD', '53e=RaBUzEtE');
// production
define('DB_PASSWORD', $db_pass);

/** MySQL hostname */
define('DB_HOST', $db_host);

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '<9?-KJ1MQY?4.mZD`$,{]A;%A5-Yp;Eje6^aq*WnQlYS0YO7.FTf }%F!M_i!+G&');
define('SECURE_AUTH_KEY',  '(Pbk?V}o2:*yj.WgI1.l%>1$86~2IJ~Eau%1nf1mXA{K0-V rX<xr^S`f/p0D9 z');
define('LOGGED_IN_KEY',    '1bPU*E,H?4rl[SSG4X:offHJ!aLy0c&j,!N4Ql=a @a.jV2dm9v/{|[qsD>wN0KK');
define('NONCE_KEY',        'zra;Z3YD?_IUDr(8dR/$I,rt50qXR9KU=`C:TPgab514$dWtE&aHf-Z:b<gGEjqQ');
define('AUTH_SALT',        'R0WlbT^&DiflT[q=rFf>W6pR4&J-^jWRZF>I>C}39-zBF ,8blV&r[W4su<0jcF ');
define('SECURE_AUTH_SALT', '1*a(Gz,`<`kud}<db!|WaH`k8$Hy|#*eWt2H)4 O]m:]%#pVcl$A#|%a3QJW,x0w');
define('LOGGED_IN_SALT',   '%A[=(KP~Pw,(Wqw_|-FW5w38L[,fliGw-Qy?}S+Hz.p*y;X?h~E-IuCP6|MqSOc2');
define('NONCE_SALT',       '&IXB%,{a1hm]juT_ )L5O|O0,[Mr/=)Cd=U-MM*TN@c$0!WL`)Ih%M+EZoI oq_}');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_eXWv8DpB_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

  	/* Ben start */
  	define('WP_CONTENT_FOLDERNAME', 'assets');
  	define('WP_CONTENT_DIR', ABSPATH . WP_CONTENT_FOLDERNAME);
  	define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/');
  	define('WP_CONTENT_URL', WP_SITEURL . WP_CONTENT_FOLDERNAME);
  	/* Ben end */

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
