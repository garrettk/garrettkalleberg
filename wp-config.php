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
define('AUTH_KEY',         'W*__3B=](<F`>Xp#eHBA+`cjZ]f<nw%->PL<N+3}|ZM0!~gY~w&=&Tm^<s@p?T)L');
define('SECURE_AUTH_KEY',  '{p#;G:cp?NM9q+Tg~uM5-?Z*~2lwU9~jtzvHUt2X|tB3F:!xLT.YoY>_--7+z*{|');
define('LOGGED_IN_KEY',    'cKf~gFh?=Cb&J-hwQ}A-KG*=O1Zzhj~$_}ol|FiCN+a:HB*:9m2Ng=O:J2!PSw=6');
define('NONCE_KEY',        'Mn{]dk?2OHQRE{g}^ Q.D/z-P9[Fs=-+u{4YxyjfZZ+)|(YHa9|z/qGn?`=.nR4x');
define('AUTH_SALT',        'jd8b^9>Z_@OnrN7B2^DNQy,6BZ#B4XI,=MSBu)|#)zhEkF060P$o-)+5o9Pv2<Js');
define('SECURE_AUTH_SALT', 'gVRxe|GV*i:RA:E CB31cuscJh*[_.ww&x]O|Ao&K6IbqnzS-eaL?p]+XW`Ghr;R');
define('LOGGED_IN_SALT',   'dwh}n5^o|rNqe;;wtu^-/4tdfGA0r(],9q(|=^1y=-_A-1nxt]h7n,$;:#M|aIQF');
define('NONCE_SALT',       '$+yC`S*CSM(maK4qJ{bCxHwR3MRQ.n3+|Y-zdWq(tL>mlajYWg?Zp7Libd.,h*@m');

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

