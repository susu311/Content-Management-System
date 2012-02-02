<?php

/*
 * Developed by Su Su Thant
 * CMS config file 
 * 
 */

ini_set( "display_errors", true );
date_default_timezone_set( "Europe/London" );  // http://www.php.net/manual/en/timezones.php
define( "DB_DSN", "mysql:host=localhost;dbname=cms" );
define( "DB_USERNAME", "root" );
define( "DB_PASSWORD", "test123" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "HOMEPAGE_NUM_ARTICLES", 5 );
define( "ADMIN_USERNAME", "admin" );
define( "ADMIN_PASSWORD", "abc" );
require( CLASS_PATH . "/Article.php" );
DEFINE('DB_USER', 'susu311');
DEFINE('DB_PASSWORD', 'Skystar311*');

DEFINE('DB_HOST', '188.121.40.31');

DEFINE('DB_NAME', 'susu311');

?>
