<?php
function root_autoload( $class_name )
{
	$name_space = __NAMESPACE__;


	if ( class_exists( $class_name ) )
		return false;

	$class_lower = strtolower( $class_name );

	$file_name   = str_replace( '_' , '-', $class_lower );

	$paths = array(
		SRC_PATH,
		SRC_PATH . 'Breadcrumbs/',
		SRC_PATH . 'XTestes/',
		//SRC_PATH . 'custom/'
	);

	$file = false;
	foreach( $paths as $path ) {

		$f = $path . $file_name . '.php';
		if ( file_exists( $f ) ) {
			$file = $f;
			break;
		}
	}

	if ( $file )
		//echo '<h1>Ollyver Entrei root_autoload '.$name_space.'</h1>';
		require_once $file;
}

if ( function_exists( 'spl_autoload_register' ) )
	spl_autoload_register(__NAMESPACE__  . 'root_autoload' );