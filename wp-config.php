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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Ns_taxud`l!|Qw$!K:BE,,R?;%;-UM.VBs%bu3TTx/ -M<v(dj45a,&F%xG,A:1H' );
define( 'SECURE_AUTH_KEY',  ')UQXK_GiM>28r_g~w*_,1S#S*+a+kHCKNai=3XWdP,TDs1w,e-keALsPgJ!a<<jr' );
define( 'LOGGED_IN_KEY',    'ih&UZ:A7#tFGxfM)]^av}Efi<I_+q4Fg,r=6.p?eTiSjYt7@u=WjY$r=,1wY8yV0' );
define( 'NONCE_KEY',        'i9o0d0iGM%]J>3~CTH0yjCJi|>hUb8z6;z1>X]bk$J=W=,_]ST`~fmM(){bWa8^a' );
define( 'AUTH_SALT',        'cT6Dz7f7dGiTVwu~bvRk|8)vgBA5QRN~dY8:qKqfFB!<N3=S9>):G0SC>[sZ~+gJ' );
define( 'SECURE_AUTH_SALT', '.u%_+dD~ximHtf}k<M|so+~,jR*d#PB$NBvvz1BR*dJcNW:a+TNIX6_58aArFtvE' );
define( 'LOGGED_IN_SALT',   '4}oK$~1yT?A){8]pxu9p1_!E1W}DQC4wHgr!V?6E63;Ul<:*Jb5fcXj`T~&mUVen' );
define( 'NONCE_SALT',       'W&/We3(FJmPOq]%`=*#L[{]Retbj~u^bB]{zV%h%,iG<w.{8>MczE6Y7L.`k:9x-' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
