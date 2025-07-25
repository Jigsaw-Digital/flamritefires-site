<?php
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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', strpos($_SERVER['HTTP_HOST'], 'test') !== false ? 'flame_2025_dev' : 'flamerite');

/** Database username */
define('DB_USER', strpos($_SERVER['HTTP_HOST'], 'test') !== false ? 'root' : 'forge');

/** Database password */
define('DB_PASSWORD', strpos($_SERVER['HTTP_HOST'], 'test') !== false ? '' : 'th0IKKLcmIqPQvJXzD7y');

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'M9g#ihb|xJPL_/6C^wx^ACR)B&YD5=jJ:L{h%sxj`Mq.Do;0cfz_pdG`+--p+#?d' );
define( 'SECURE_AUTH_KEY',  'jikT&2cw5SWFXK{{+t0Y.`.l+i-M;|SKo*}w4r}USXt3q[~eQ-QT=YsqI1w &RJy' );
define( 'LOGGED_IN_KEY',    'ha3Iq)H$:6LOv^>5=$oHV5.+vYJvS^<:LyyL_GRthGCdhQ7^-S$ CF~ ;vF%v#gj' );
define( 'NONCE_KEY',        'OE4wq[d?^jCjzO}@1(oYjF[{[2JnPA5@Vn<E3Etrv8t6VtLwr71:-kbz<Rb,[vzd' );
define( 'AUTH_SALT',        ')vvaT,B@mV0~8-SO 6%O9!F6-:5kQUjvupXOx#$&^%9o7wx^G?51%z7*satH,:D)' );
define( 'SECURE_AUTH_SALT', 'V8}i3D^a8LqzQkoi83KLNk]IUDjhthQ6%Xkbv2>Qs%bX7j:x-!BU=%Va1R:x{>aQ' );
define( 'LOGGED_IN_SALT',   '%gvX XtdYmND5^UFNZ_N6;zp&{Om;DNkciF:{Qyz7%OLo?c19bnnoGQvJ/%%=Wp-' );
define( 'NONCE_SALT',       '^$n!RF>}GsQfeQy|vNB{Td@<F1[ TER(_hq)}4w9|pydk7/+7e5=+gAfgSdiQs6;' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'sx_col_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
