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
define( 'DB_USER', 'wordpress' );

/** MySQL database password */
define( 'DB_PASSWORD', 'ab01a82b1376285781897838c8d79f93940e7fbee2de2e5f' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         ']qp>|@ZahEb/2[mp;jAkYA/0nIMty0AVu1f-~uROlSbXYUJ*b#K_ PS&ienB(^1Y' );
define( 'SECURE_AUTH_KEY',  'y@RvY-0q|*_{.@iV^i&fJ)H7,k!)M;#k~@Ha~3@m]jkAsDT5gp3mCJs{giFOvMv@' );
define( 'LOGGED_IN_KEY',    ']Q%4@K3&9:>:vH_SpY$hjU~M)pT+dnW<sGw!)N?w]`euYs/C5({ZO{0F 3y2F,>U' );
define( 'NONCE_KEY',        'i=)wi,>giqs?L3,D}V>M#J .TG&fCt73Hf)#|]0?+%:[nji8J:w;LLf~lH$XLT}E' );
define( 'AUTH_SALT',        'f3mECVssFD=&cIqf`&06OP004cw@XYzO<nxk}WD):z~Fwgt}Aj1u:I<>t N<RcJT' );
define( 'SECURE_AUTH_SALT', 'hpaloHN<qL_^$0zpO`Bj4;FcD(P?HPHJIgoyd&,f+<n;4CAN2x/nRYX.U?+eH xd' );
define( 'LOGGED_IN_SALT',   'QJ4lsRWSM}C^jDd+Fx2!4H #*P0gnSy^LnHGaKy5-TTv]r&;r7VIsQ`LyqAc ~V$' );
define( 'NONCE_SALT',       '6D6{j_cw(1FT.a/c;lITnhmXT>V|0LB~xgJbGZ _!xhmrF~}3f(?m+)HwjBj[>9 ' );

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
