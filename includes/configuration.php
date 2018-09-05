<?php
	/**
	 * Pepper
	 *
	 * Is required for cryptographic salt purposes
	 *
	 * DO NOT CHANGE IT OR OLD ENCRYPTED DATA WILL NOT WORK
	 * ONLY CHANGE IT ON FIRST SET UP
	 *
	 * @location class.CryptoLib.php
	 */
	define ( 'PEPPER', '+?*er*F+*^&%##&*(SHSHSmb5#@&(hj6549hf34%$$*kskaP{8787^&&*^jd@#%&snsh&^%w}Nazr}iD}--vA}+Jq%+$LCPsP#J#' );

	/**
	 * Cookies Key
	 *
	 * Is required for cryptographic encryption/decryption purposes 
	 * 
	 * DO NOT CHANGE IT OR OLD COOKIES WILL NOT WORK
	 * ONLY CHANGE IT ON FIRST SET UP
	 *
	 * @location class.cookies.php
	 */	
	define ( 'COOKIES_KEY', 'fghkj&^%346NGH865FHNMp09GBCF2346G*&%$^ggstdg*&^^#Jmsihg^hsjjdhd6565$%%$$hsjs6%' );

	/**
	 * DEFAULT LANGUAGE
	 *
	 * Use a two letter name for it (example: 'en', 'es')
	 *
	 * @location class.translate.php
	 */	
	define ( 'DEFAULT_LANGUAGE', 'es' );
	define ( 'USE_MULTI_LANG', false );
	
	/**
	 * MYSQL Host
	 *
	 * Is required for database access
	 * 
	 * Needs to be changed every new project
	 */	
	define ( 'MYSQL_HOST', '127.0.0.1' );	

	/**
	 * MYSQL USER
	 *
	 * Is required for database access
	 * 
	 * Needs to be changed every new project
	 */	
	define ( 'MYSQL_USER', 'root' );	

	/**
	 * MYSQL PASSWORD
	 *
	 * Is required for database access
	 * 
	 * Needs to be changed every new project
	 */	
	define ( 'MYSQL_PASSWORD', '' );	

	/**
	 * MYSQL DATABASE
	 *
	 * Is required for database access
	 * 
	 * Needs to be changed every new project
	 */	
	define ( 'MYSQL_DATABASE', 'faucet' );	

	/**
	 *
	 * DO NOT EDIT BELOW THIS LINE
	 *
	 * ///////////////////////////////////////////////////////////////////////////////////////////////////////////
	 * ///////////////////////////////////////////////////////////////////////////////////////////////////////////
	 *
	 * Note on globals vars
	 * 
	 * GENERAL: $db, $router, $translate, $[themes, errors]_array
	 *
	 * ADMIN ONLY: $alert
	 */	
	if ( $_SERVER['SERVER_NAME'] == 'localhost' or $_SERVER['REMOTE_ADDR'] == '127.0.0.1' ) {
		define ( 'SCRIPT_LIVE', false );
	}
	else {
		define ( 'SCRIPT_LIVE', true );
		error_reporting(0); 
	} 
	
	$db = new mysqli ( MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE );
	$db->set_charset ( 'utf8' );
	
	if ( !isset($_SESSION) ) { session_start(); }
?>