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
define('DB_NAME', 'db99887_spensational');

/** MySQL database username */
define('DB_USER', '1clk_wp_EYArUg7');

/** MySQL database password */
define('DB_PASSWORD', '6OusqUAE');

/** MySQL hostname */
define('DB_HOST', $_ENV{DATABASE_SERVER});

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
define('AUTH_KEY',         'hXtg42Ll uqlI3B4i N4dJOtnO i3nVwhCp b1NwJFgl');
define('SECURE_AUTH_KEY',  'DEPjOqVN rOpj1Oyr lL4Jd6Au hNJqPOWJ diYwoNwp');
define('LOGGED_IN_KEY',    'dRyP2vZY iyepDCpj LxIA6lmN M11QsRmc zwnktQXp');
define('NONCE_KEY',        '1aw3B72T DxvNXp3F Ydcqqijg IPgYhScx dEa1sEKK');
define('AUTH_SALT',        'UMFMplXm VUga3YuG Su6xvtto NC17Kst1 FzEwRAFV');
define('SECURE_AUTH_SALT', 'kcbON3dY wyhSTAIy yOFVVp6W wNgGXRHr Lku53nVZ');
define('LOGGED_IN_SALT',   '8zRpzgjw EC62jrrk HxcUFoUK jr2Je1iE yw1yMR3f');
define('NONCE_SALT',       '2ycT7O2N bHUIibCN E6yYbkoB KoxjNFMh JpNMzhXN');

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
