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
define( 'DB_NAME', 'admin_insights' );

/** Database username */
define( 'DB_USER', 'insights_user' );

/** Database password */
define( 'DB_PASSWORD', '7aq4y6K*9!!x' );

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
define( 'AUTH_KEY',         '`T <`rT|ItYj--t*QhxyAT)[IodGF-K#ni]O5qHJP*$GW;3ZCg!]Cn]aN-a!.^df' );
define( 'SECURE_AUTH_KEY',  '.]`B4G^y]2oZk$w{T`DP&$7A{ ?Fd~j{*i>_/[w,m}`[lNP1B+^=9,;9ku7-eGZ0' );
define( 'LOGGED_IN_KEY',    'HR{{veB8MFUD8@!@/qejK+Tubt[ bh6;z-L1/(oN:S9nqLBLIPMY fm8xp))FsX]' );
define( 'NONCE_KEY',        ';s3LnR5}d+lBw[ +Yyp#3Zx4xg9b}Ou3*ER>PteGJXUlNH&$d45;+?nlb^<$gX=m' );
define( 'AUTH_SALT',        'u,vC(Wkc4sWG+6EZnsx:lgN>8G9=JK&t6j09~rr@9y&b.gAV{e8=xDx9Pnj.pww:' );
define( 'SECURE_AUTH_SALT', '#JLwYwjD/EyH@;c@.Fm,BXdtjm3U$z?;_a]sJ>Wf~L<^AC:Q&XESU=,E{!=3y)Kx' );
define( 'LOGGED_IN_SALT',   '+{<YPwiVq4}5@>j&[6_1XEZg@#qNQ{Q(3:bADO|g#F$Q9M%)!aaDMBo:@LG0p&-f' );
define( 'NONCE_SALT',       'aF%#aWb(UKe7Y^nF!qb(v`2UPp}/Y}z+U0INmLAFv|}#[?#kI4F#3tq8?K=H&o>n' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );

/* Add any custom values between this line and the "stop editing" line. */


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
