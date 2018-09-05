<?php
	define  ( 'THEME_LOAD', true );
	include ( dirname(__FILE__).'/includes/configuration.php' );	
	include ( dirname(__FILE__).'/includes/lib.php' );

	// 404
    $router->set404(function() {
		global $db, $router, $translate;
		header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
		$theme_array = array ( 
				   '404' => true,
				);
		include ( dirname(__FILE__).'/includes/themes/404.php' );
    });

    // Home
    $router->get('/', function() {
		global $db, $router, $translate;
		$theme_array = array ( 
				   'title' => '', 
				   'extra' => '', 
				   'metaDesc' => get_setting(28),
				   'socialTitle' => get_setting(1), 
				   'socialImg' => ''
				);
		include ( dirname(__FILE__).'/includes/themes/home.php' );
    });
	
    // Load Router
    $router->run();
?>