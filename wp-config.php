<?php
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
define('DB_NAME', 'wordpress_test');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'cnsJcuGP,TgPvPFg=OT{52yr%6`Ym)]H.(c/Hum=H#F33PCHbxU&#8&7QY[*,j60');
define('SECURE_AUTH_KEY',  'I~.`LMUIox/4<D>IBR7)`m W1)dcZVGV~`FHdrS,<,!}v(s8gwu:bM?!/UH2Qi_I');
define('LOGGED_IN_KEY',    '!{I&cEt4;wqnlgZ6VPUp<`szbknq@E1%hE6Xu}:##6>3wyDQ><7FCRRM;DV>~0U*');
define('NONCE_KEY',        'cx_k)h(-1u*Qekgt==m=p%b>j[f0q)<PviLw}RPV~h_dypW|YTC,}PLV1l5#HEjT');
define('AUTH_SALT',        'O&Zn-&`*|6V7M;&JmKik=3u,&>A|1@o`1V_><tv)EHCb)-Q;e+mYL8u,[Fp$8R8S');
define('SECURE_AUTH_SALT', '36!DCF@4_oe,N+e=l@6*t6Q$=td^C(crDY};b T3^.q[w3>1X8IyyUW>H){^<?X@');
define('LOGGED_IN_SALT',   'caX8J;f`v0ryh$Cf+c5z2n8#)EnP5W(`45{8+*P8ZV.bMmY(youLLnAYn-U`#K*C');
define('NONCE_SALT',       '>`0E;m&9`.{:NB&@yOMH0!!,=ZSsDMFC^:y<E0W1b/47u`2j-3K[;-AR.rO+tT`X');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
