<?php 
	include ( dirname(__DIR__).'/includes/configuration.php' );	
	include ( dirname(__DIR__).'/includes/lib.php' );

	if ( is_login_user() ) { 
		logout_user(); 
	}

	header ( 'Location: login.php' );
?>