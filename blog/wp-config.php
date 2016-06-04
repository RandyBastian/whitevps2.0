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
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/askarali/public_html/white-vps.com/blog/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'askarali_wp113');

/** MySQL database username */
define('DB_USER', 'askarali_wp113');

/** MySQL database password */
define('DB_PASSWORD', '0G)Sx[5m3P');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'y6tmsmsobbrch1qy35wwf2lvnxrbhhxutjexdth2vgjyuzrrbvlncis3uuuwdxg6');
define('SECURE_AUTH_KEY',  '0ewezoy9ohwtfdbuowryx5rzrdlwcomhvwjqeg5wwdluf3a8nfxbn1fiib59xljz');
define('LOGGED_IN_KEY',    'qpwatppjofnyywnhg6twi1ckgncznigp9gd92yfmmsnnomozirgr3mclkoggisqp');
define('NONCE_KEY',        'zogmvaua4kpfwq0dkp3f1eedz6w8xofbddmt30kdst1qwruaqchau0mnoevdzrsj');
define('AUTH_SALT',        'gnxfahbtrapkeouy9xmnl9plxtnupns9htf43jjvg3pzsuu5ht8zpgsxjzunmtox');
define('SECURE_AUTH_SALT', '3jwf8qb02fpcqzfjrfthomkimxibuzdwrbs2lns2oavk0pf2ylpyfk9w8pejrhht');
define('LOGGED_IN_SALT',   'esjonqqi9tejc9f7m6wx9fuvcsqzzlcat2tlpf7rvjfc2239bcqzrpvpzmrhdzsm');
define('NONCE_SALT',       'sf40wpz0dperell45xfivbdizfq3w5ng1jmvsjz3dymagnlvcyq34rlprwup3b4i');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpzk_';

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
