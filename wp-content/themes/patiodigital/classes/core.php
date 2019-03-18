<?php
define( 'THEME_PATH',   TEMPLATEPATH . '/' );
define( 'SRC_PATH',     THEME_PATH . 'classes/' );

define( 'SITE_URL',     get_home_url() . '/' );
define( 'THEME_URL',    get_template_directory_uri() . '/' );

define( 'SITE_NAME',    get_bloginfo( 'name' ) );

require_once 'autoload.php';