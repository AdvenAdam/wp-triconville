<?php
define('WP_CACHE', true); // Added by WP Cloudflare Super Page Cache

/**
* The base configuration for WordPress
*
* The wp-config.php creation script uses this file during the installation.
* You don't have to use the website, you can copy this file to "wp-config.php"
* and fill in the values.
*
* This file contains the following configurations:
*
* * Database settings
* * Secret keys
* * Database table prefix
* * ABSPATH
*
* @link https://wordpress.org/documentation/article/editing-wp-config-php/
*
* @package WordPress
*/

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp_triconville');

/** Database username */
define('DB_USER', 'awan');

/** Database password */
define('DB_PASSWORD', 'ins-awan@srg');

/** Database hostname */
define('DB_HOST', '34.143.245.128');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('BASE_API', 'https://platform.indospacegroup.com/v1/');
define('API_KEY', 'Token 09633df1426fce26fc53de676e8bb65f47a0dcf1');
define('BASE_URL', 'https://triconville.com');
define('BASE_LINK', '');

define('WP_HOME', 'https://triconville.com');
define('WP_SITEURL', 'https://triconville.com');
define('ENV', 'prod');

/**#@+
* Authentication unique keys and salts.
*
* Change these to different unique phrases! You can generate these using
* the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
*
* You can change these at any point in time to invalidate all existing cookies.
* This will force all users to have to log in again.
*
* @since 2.6.0
*/
define('AUTH_KEY',         'bBD`h+V1b9M2o?Zc.m83>+~MS?i/9AEOWh)/k#}LCqLW2g(;k58RqYG>TaITjE.H');
define('SECURE_AUTH_KEY',  '`Q~/:7q/9%K|,`+1*bE}w^Rrq;T jEPOV;=o}@PiE`9/emm+<Lwz@q6/LX<jp>S[');
define('LOGGED_IN_KEY',    'Vr//5[D5~vAv8FHc*(<=R:O4WzSg87.c=BB{F4/#;D>mNr2o&yW7kby0,qXRqrJz');
define('NONCE_KEY',        'muV1on(:IgEP3^j@-8+|rW)Hgs*75)$])Y^lU3y!sa<FuW}_~hY%Jrmc@>3 p8_q');
define('AUTH_SALT',        './!Sab0<Q{AWY0l!i|YnLHa8trCl!&=bOf}fxkcZ_o|Zhe|(UE9h##fLJG~S+fOV');
define('SECURE_AUTH_SALT', '{6fgj+8N~!&fo3|2vo]=:#l?sl|9XS=imaDC$|]M|fC6Q<)3.^|<5>4Zyr842,a,');
define('LOGGED_IN_SALT',   '?vfosI|`0Yi}s0VS%_K0xiN%,I]{NLVT7 hF(>(WtC=r2nq-DflQ& +`cRR3@(?,');
define('NONCE_SALT',       '_]|1TT9qtcp_#QEY$I1x$X$nE!} LWDqI}>{>-_--hywiW9txl(.iO,81}!@_Cx}');

/**#@-*/

/**
* WordPress database table prefix.
*
* You can have multiple installations in one database if you give each
* a unique prefix. Only numbers, letters, and underscores please!
*/
$table_prefix = 'wp_';

/**
* For developers: WordPress debugging mode.
*
* Change this to true to enable the display of notices during development.
* It is strongly recommended that plugin and theme developers use WP_DEBUG
* in their development environments.
*
* For information on other constants that can be used for debugging,
* visit the documentation.
*
* @link https://wordpress.org/documentation/article/debugging-in-wordpress/
*/
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);
/* Add any custom values between this line and the "stop editing" line. */

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';