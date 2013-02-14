<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wpgk');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'mechamothra');

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
define('AUTH_KEY',         '=onN1^>Hi|ke22-*<JV*%g)g|3wZ{>Fh8OGaC}o 6PTy9=pKz+#MSO1?X~H$Y#-D');
define('SECURE_AUTH_KEY',  '%<%;x 7tD1yy9FsRP^9 N!?F=2enOF&s9rTs4esp~]_ }WX4{2Xa|m0:RACCS[D~');
define('LOGGED_IN_KEY',    '1ehgN0vVF48(y:cY,(*pjw6(xk7c2O&p!TmdDytZ%3 gEvknC8RknBKb1-6aZt4w');
define('NONCE_KEY',        'a[u9_Wn`kC]a]ea%Gim$PE<kc]12* 0`v^#qd% ft2 b~6|Bz*gk^3[1E-DF>$d&');
define('AUTH_SALT',        '=H$8 SLA6B9u&q_[6,Ey+oEl[:91j}R-O +i<y[MF.xD1G|tM-S|?i>B?jjbLxb3');
define('SECURE_AUTH_SALT', 'sJM1R]&Pnl:(u|hC[)s5=CXO*+@cp.k+8gCf}wR[L0-4q|/KyjubQ*eCDN8fSLay');
define('LOGGED_IN_SALT',   'a@L]*v,cs?=W&[5(|g[ez9/h_ir=sR--[?~k)T2^!991u?a8 >bj<%a83v;@Mw_{');
define('NONCE_SALT',       'De!,],|n8!4!w ELLVq5c8h_]dL7ZXvb:pUt|6^$oG3$q~yBgbUHXbnA;x.E`uL[');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
