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
define('DB_NAME', 'montr035_dbgm');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '#bl}U&t{s-[PU|,_tq-t-u~u{6%:!8aFuH!#D0Z#=aMh(J?)*m7gPWfK~ONCbC!,');
define('SECURE_AUTH_KEY',  'i[*08:`!{s3!<YaYYL2UXYv!Tb.R[YX*;MU kpV~lyO|mv#]J&dU2YvnIuYa{%~7');
define('LOGGED_IN_KEY',    ';rB3[cdTg~L{%Ge>9y4kp~MFOkI+QV5:dHz{l?Eg/(Xg?GJX{D4nJbX)$3 oThoF');
define('NONCE_KEY',        ';PMAB(L=*,mr-{:V}zD_p6<X:mJDdx<zKD|J+MVe66d]g@l g(#: AAI/7JM(,&|');
define('AUTH_SALT',        '#[(aIDB+k%&Nz6cqzhazI8ff1iv;};/1&J`;GBiK|U/Z9oSqq8kq&;m]@X^+iatL');
define('SECURE_AUTH_SALT', ':0#WQFk!%[+z:&nnhHDRw)z17-M$eXE]>v^t*kY{afCED&97JZyo@v[9k2%glAB0');
define('LOGGED_IN_SALT',   'D=Qw=+C76]4}.z78~2PxlSb0H<heMA}sD}Z&8R7zHEOW9K[!I|pS!b{Ic~wa>5mS');
define('NONCE_SALT',       'g6NGgLjP2e,_j3z|}O-4%YH(w$(x>Mg`+04 $om:3H3hF%{`X|*)w%doJzx3u`iN');

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
