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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'vardan' );

/** Database username */
define( 'DB_USER', 'vardan' );

/** Database password */
define( 'DB_PASSWORD', 'Vardan1' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'tI}>?}3#>ug#_H30{TGw_7{Qv#cBnlY0geKh008u4RFds<5ALk<O&!r9^E_s.AO&' );
define( 'SECURE_AUTH_KEY',  'dFN2P9~3!E*Tz=P7.n+A{1tms`5A}-Yt!t{VG]$0H#2r_PJqNZ&73gX4zO/~RB,,' );
define( 'LOGGED_IN_KEY',    'I6T{,24&6x!.@ =Y!@zsn#XqH)((4V&M. Z#&%LhlwLEL&`9iT|G</m8d&@dqo<F' );
define( 'NONCE_KEY',        ',qDac[YR7|aZ-w>.T!1CP(C|k;3&Q>AUM?Dlx_Sb-|kl|P7w>H<GSzE/ }cu!H8C' );
define( 'AUTH_SALT',        'GKk}J9ymt!|u,d-!)/O17VeZW*Z,hzD1+8N:(%^]}Jb}h9Gt A=pul<VwJooO!ee' );
define( 'SECURE_AUTH_SALT', '1pW1TOM!Czg`]QN5icRGJ+ui(oij<vyqsBLgXD3=|Y[*9s8%6`[HNy=C/MGC,%PF' );
define( 'LOGGED_IN_SALT',   '**@ilcJBJ8je vx!%F92<uWt@>-t%DORDz721~^]4 I.Cylb!yhihWZ+IdV+q|&A' );
define( 'NONCE_SALT',       'Fw|t[/+-w ICK(aJDnb=(,*~#U/.ms&AA[&*-K=,kNsQ<sOMP0!a6C|3_O~]5CL8' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
