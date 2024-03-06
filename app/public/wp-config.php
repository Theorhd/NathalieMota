<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',          '=A&pe=%z(QRiFIRRp$|G%7Ji7Sq[:,%IvwE2cVbXQl``{x+1oUHEoPW^,oktqJtW' );
define( 'SECURE_AUTH_KEY',   'N/5z17xHXE-f ^IJgBS5F6xCLZf1:r_uR+;`c65rlUVk!>3sk_hEi3{JCV|/(XJ`' );
define( 'LOGGED_IN_KEY',     '|`Wh@.KO&lq^{98[x@kqUG6jc&TfOa/4.,p,meF0p,1-v2iZn)UuL[) bwq>$LV,' );
define( 'NONCE_KEY',         'rG9UUK_nIo JsB^%v?UlxA=i #dqh{kE?0iN4LcVR XCKFJy><A[+<[FwW7?60ow' );
define( 'AUTH_SALT',         'N:iW!|J.rL=r/5aBwgFRFV%a:$q#B&W<kozV$3@:m%/rI7S%=?+8fkv/r-MRw|A5' );
define( 'SECURE_AUTH_SALT',  'VgK:Uv<4<z.b8&;U{d9X|<$$g~PZ9LM!PhvN,K2>j^UQ]T+Hw0ayh5s#k&BY&KJn' );
define( 'LOGGED_IN_SALT',    'ME(eLdpz-UZR #RlZmP1&s;/9Ai{E{^|F}cnx3@lXi$c^><W.=0xnQrL2Yg%-|pM' );
define( 'NONCE_SALT',        'zpNmz`pPIABj$7Hdd-i8<BNcEjCmsM!p-)ZAo^yby}]stfFbR<hS@wm.N!SA~;^B' );
define( 'WP_CACHE_KEY_SALT', 'E]>qbpR_b&+}vP@Yqf<P9%^1;/!=QF:7*U9{c)/i9@*VF?M/lvJj+<6!9~Orjk8=' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
