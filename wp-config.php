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
define( 'DB_NAME', 'dbe3cg2yrny327' );

/** Database username */
define( 'DB_USER', 'uvvmbpk17mwuo' );

/** Database password */
define( 'DB_PASSWORD', 'jgsfb41uzjif' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          '}?;,[b){/>oM#-FLL7#(ZY%K1gcAbZu>:a5uvwl!gHxyyD2Hpau/NS7gG`5>B @l' );
define( 'SECURE_AUTH_KEY',   'w8c$?j9CB>DZNz?X9A^jzr5BWP?hh1_Eh y7dg`:3}}htS?Nph@O&PY}/G3e?Sxf' );
define( 'LOGGED_IN_KEY',     'lZ8L@om6TE?=sx*zyhK$fxB^D+plIZ_?G?tf?zH:y6(X> *7KhpJC~&XtOWJS,Z@' );
define( 'NONCE_KEY',         'LB8+&zIz:6z_pUN|A$?{Sp.K{Cb[OVx3{SK{PUod>JldfHu-X7g/7<@?ezwmuJrW' );
define( 'AUTH_SALT',         'W(3k^.o>{lj? 7_q@gnZnP50-@mY2yn<B>4VJzSOp;J^I86*58K/eKBY}i>[FCg@' );
define( 'SECURE_AUTH_SALT',  '6,6ShqSEbJ)!7j.)(i^HC/<g#LGQvG??|R6iMT[IU>?ZA>WWBQ`AKJr)3nRK {r3' );
define( 'LOGGED_IN_SALT',    'zCv,vfA1&g%F.Yct%e(z60+^;4%`57* a^Ne{e+/-~V3-WvOyU :1Ui]6#ep_(%(' );
define( 'NONCE_SALT',        ';J*6]7rtE)2R`G#9 %>l`X5EE3W%S&h+*}V+MH_g=K`et4vfoV<n~u8zo{gX>nAW' );
define( 'WP_CACHE_KEY_SALT', '&XcZs_Bm&ob6w!c[s,h,?;@P/;FlZ| V$;p6wi<.~nnf}JJ|+ywJtG4Q;eh8bD!k' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'iwa_';


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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
@include_once('/var/lib/sec/wp-settings-pre.php'); // Added by SiteGround WordPress management system
require_once ABSPATH . 'wp-settings.php';
@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system
