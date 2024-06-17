<?php
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $_SERVER['HTTPS'] = 'on';
}

# URL base
define('WP_HOME', getenv('WORDPRESS_SITE_URL'));
define('WP_SITEURL',getenv('WORDPRESS_SITE_URL'));

# Database Configuration
define( 'DB_NAME', getenv('WORDPRESS_DB_NAME') );
define( 'DB_USER', getenv('WORDPRESS_DB_USER') );
define( 'DB_PASSWORD', getenv('WORDPRESS_DB_PASSWORD') );
define( 'DB_HOST', getenv('WORDPRESS_DB_HOST') );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         '?I?tfQL?Hu#~Ir}RGe~PHKG5hSzk>5Dq0ofe5%/doxWIf4wGSU7J9]bUzqTYAl[|');
define('SECURE_AUTH_KEY',  'O0:=+ OyK{tUy,u@%!HGkuucOfg|1q!UDFIP^?{|Vux3W$RJ5-?$mlRk):HIhl1E');
define('LOGGED_IN_KEY',    '8FBs/;e~.qRN|1-4IA:= xx8}KH`$>%V^`kT^ sp(~c iu=%]qsr}U8p3*4ASt:P');
define('NONCE_KEY',        ':rO*/F^%n9{O$!39}?<Pxo1RD%%+1zxs%QKv[l~uS{w+YU1_`dK|k5?4PKQjA>5m');
define('AUTH_SALT',        'YGus97MJ=[uMxmzp/g-i0MV!^p#T;ouDWd]I8baT4kq~@-cPf3dp($M{[8A`n!17');
define('SECURE_AUTH_SALT', 'l[>xt_]0_}Oh=/eUTz)V)Tm?bC $2.~tj&hG0%>r!q?umH$F$Do[BW3pA9xt>=~n');
define('LOGGED_IN_SALT',   'v}T9!({KySr`y2ddY3&T3XG1{y(r2U4(vodf7P.xSF0Dj:RW=foNjjBES.hE;};~');
define('NONCE_SALT',       'u2W{i Qz7,{AgK] ]jk!3KHGM(b9hZwQ4FJdap|m<$RvKYz@jF`7^rjbwW=&6%oI');


# Localized Language Stuff
define( 'WP_DEBUG', getenv('WORDPRESS_DEBUG') === "TRUE" );

define( 'WP_CACHE', FALSE );

# WP Engine ID
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M');

# WP Engine Settings

# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . '/');
require_once(ABSPATH . 'wp-settings.php');

# Disable WordPress auto updates
define("OTGS_DISABLE_AUTO_UPDATES", true);
