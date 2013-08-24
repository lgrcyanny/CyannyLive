<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
// //Added by WP-Cache Manager
define('DB_NAME', 'cyannyblog');

/** MySQL database username */
define('DB_USER', 'cyanny');

/** MySQL database password */
define('DB_PASSWORD', 'cyannyblog2013');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'gKxp.|(/6D4+6$}T;*h&)Mmi&JNL@r`@rE-r+}NGE%$%;.@?kW!V_bO,!yp*Li+m');
define('SECURE_AUTH_KEY',  'GDC^InI`dM^r2Vc:KM[AhXuXE1eJe3J11Jco|Goi[e&wikLbRzzlfzRwSydby 8S');
define('LOGGED_IN_KEY',    '}.$nQ{())U=qs`,uPU9N?CC]NN;w!-yCq^Q7I{+J>|D$#E%TVOJ$K[ 0iH(I4}%z');
define('NONCE_KEY',        'fe9U51;@+sn/_dcf=]QOhh=-,9.fjB~DRItnXM<Gv]%oF`VKIt=W-4@;(]RM?%&v');
define('AUTH_SALT',        'X}R_x:=n{SlaCUPe]rbo}OE!QdT`_<)NS)r!npcSCe%<1A:Cyt&%a+amtK^cW;2Q');
define('SECURE_AUTH_SALT', '4A[M94Q?]1-$tgz@6s^)(f-|_*-qA)H}]VZnPR$9:]vw9(P-unuMer+v`GLbl)oW');
define('LOGGED_IN_SALT',   '[[+EDb1hxX]@$kb<^()@-is:~XR!BV+w+ZbTDe5#$<JMl@-[%iQhK]wp#&oKj1-k');
define('NONCE_SALT',       'Y}x?Wg+|d_? pHVJ|xIm!)}-#M?/$X//--cf5hbq7e>L[T,jQFYY=*qpseeZ+N_Z');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
