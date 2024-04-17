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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'avas' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '_`:a%6t9X$FoF7KV(M)I5[Q{:`WtZT$pqmo>o@BS|Ef/9PVG5A924TQ]Q7]MJ$jK' );
define( 'SECURE_AUTH_KEY',  'H!<+?VS*K0taV1z s8N_$yL>Q{}#&m]U/C96]y1N@mK]X/Cch7blOlfNMa~~&8y ' );
define( 'LOGGED_IN_KEY',    '5l(NI^BCn(id|^W01J^r}o2l;n0UW4<MN^vuSVI.%(KdhJx2J(V8<{!>$^`u$8d`' );
define( 'NONCE_KEY',        'dwR(%t>+;MW:8H.V+28JLfq1PT}Qm]Ge8N8cgBfPl3^Z3ilS7~*OSxF(`?<Mb{[S' );
define( 'AUTH_SALT',        '-io>V,5The6cST_=+z~k-7y-15m9B$uk~rC#rQD6RK =Ru=KT!Cmj<-1;Cr>}i3h' );
define( 'SECURE_AUTH_SALT', 'W|@f~X3,IlySTcZ1QA65y%sOrS<MI6WI;/y<4gh::GPP6%RCN] w,&_dk<<tMbrg' );
define( 'LOGGED_IN_SALT',   ')2028/ohetB?pUeVC0Og.Pw{ mWofN|vVXWc4ps*@kGh6j?bFEBhG-lpeK$;+n%T' );
define( 'NONCE_SALT',       'hyeur,}vlNhs*pM@o%kj5IBflnwZX=wXvnn]H=(+wa}a/%Ua<d{uAadc^Hs)r)Hh' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
