<?php
	define  ( 'THEME_LOAD', true );
	include ( dirname(__FILE__).'/includes/configuration.php' );	
	include ( dirname(__FILE__).'/includes/lib.php' );

	$user = 'user1310922601';
	$pass = 'pass140562bc7f3cd97eb8b33e1730ad2cec28b23132b22c3738ab9f90590481c08690';
	$host = '78.47.146.222';
	$port = 14276;
	
	$bitcoin = new Bitcoin($user, $pass, $host, $port);
	$bitcoin->getinfo();
	//$bitcoin->__call( 'sendtoaddress', array('RDsiZWgGtbwDb8Hvy65Z3sANMhdmARo1mM', 1) );
	
	echo $bitcoin->error."\n\n\n";
	
	echo $bitcoin->status;
	////////////////////////
	
/*$bitcoin = new jsonRPCClient('http://'.$user.':'.$pass.'@'.$host.':'.$port.'/');
echo "<pre>\n";
//print_r($bitcoin->getinfo());
//$bitcoin->__call( 'sendtoaddress', array('RDsiZWgGtbwDb8Hvy65Z3sANMhdmARo1mM', 1) );
echo "</pre>";*/
?>