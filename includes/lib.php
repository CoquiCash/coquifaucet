<?php
	/**
	 * This file contents all required php library
	 *
	 * @category   Library
	 * @author     Steven 
	 * @copyright  2018 VOS Group
	 * @version    1.0.0
	 * @since      File available since 1.0.0
	 */

	include ( dirname(__FILE__).'/lib/class.cryptolib.php' );
	include ( dirname(__FILE__).'/lib/class.easybitcoin.php' );
	include ( dirname(__FILE__).'/lib/class.jsonRPCClient.php' );
	include ( dirname(__FILE__).'/lib/class.functions.php' );
	include ( dirname(__FILE__).'/lib/class.cookies.php' ); 
	include ( dirname(__FILE__).'/lib/class.settings.php' );
	
	include ( dirname(__FILE__).'/lib/class.translate.php' );	
	include ( dirname(__FILE__).'/lib/class.router.php' );
	
	$translate = new Translator( 'GET' );
    $router = new \Bramus\Router\Router();
	
	include ( dirname(__FILE__).'/lib/class.phpmailer.php' );
	include ( dirname(__FILE__).'/lib/class.smtp.php' );
	include ( dirname(__FILE__).'/lib/class.email.php' );

	include ( dirname(__FILE__).'/lib/class.visitors.php' );
	include ( dirname(__FILE__).'/lib/class.users.php' );
	include ( dirname(__FILE__).'/lib/class.contact.php' );
	include ( dirname(__FILE__).'/lib/class.theme.php' );
?>