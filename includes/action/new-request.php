<?php 
	/**
	 * This file execute the actions for the site contact form
	 *
	 * @category   Actions
	 * @author     Steven 
	 * @copyright  2018 VOS Group
	 * @version    1.0.0
	 * @since      File available since 1.0.0
	 */
	if ( !$_POST ) die();
	
	//CAPTCHA SECRET KEY INPUT IT HERE
	//https://www.google.com/recaptcha/admin#site/342793820
	$secret = '6Ldcnm4UAAAAAG9PbBVPjIIVXC4g3Y4rgrlJX5CQ';
	
	include ( dirname(__DIR__).'/configuration.php' );	
	include ( dirname(__DIR__).'/lib.php' );

	$translate = new Translator();

	$error_array = array(
		1 => $translate->__('Occurió un error. Intenta nuevamente.'),
		2 => $translate->__('Favor ingresar su wallet.'),
		3 => $translate->__('Favor ingresar su email.'),
		4 => $translate->__('Favor ingresar un email válido.'),
		5 => $translate->__('Favor ingresar su nombre.'),
		6 => $translate->__('La promoción es 1 por persona.'),
		7 => $translate->__('La dirección de tu wallet de coquis no es válida.'),
		8 => $translate->__('Favor de darle click al captcha.'),
	);
	
	$values = array();
	foreach ( $_POST as $name => $value ) {
		$values[$name] = clean_string(trim($value));
	}
	extract($values);
	
	// Validation process
	if( !empty($checkplease) ) {
		$error = $error_array[1];
	}

	//Crea un codigo que empiece con "R"
	if ( !empty($wallet) && $wallet[0] != "R" ) {
		$error = $error_array[7];
	}
	
	//Wallet 33 caracteres o 34
	if ( strlen($wallet)<33 or strlen($wallet)>34 ) {
		$error = $error_array[7];
	}
	
	if( empty($wallet) ) {
		$error = $error_array[2];
	} 	
	
	if( empty($email) ) {
		$error = $error_array[3];
	} 
	elseif( !is_email($email) ) {
		$error = $error_array[4];
	}
	
	if( empty($name) ) {
		$error = $error_array[5];
	}
	
	// Only one promotion per email, ip, or address
	if( !empty($email) && is_email($email) && get_contact($email) ) {
		$error = $error_array[6];
	}

	if ( !empty($wallet) ) {
		$vs = new visitorTracking();
		$v  = $vs->getThisVisit();
		
		//El check de los ip tienen que ser 1 por hora
		//Poner captcha en el formulario
		$query = get_contact('all');											
		foreach ( $query as $id => $value ) {
			if ( $value['comments'] == $wallet ) {
				$error = $error_array[6];
				break;
			}
		}
	}
	
	//////////////////////////////////
    //get verify response data
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);
    if(!$responseData->success) {
		$error = $error_array[8];
	}
	
	//Captcha verification
	if( empty($_POST['g-recaptcha-response']) ) {
		$error = $error_array[8];
	}
	///////////////////////////////////
	
	if ( !empty($error) ) {
		die( '<div class="text-danger">'.$error.'</div>' );
	}
	
	//Send the transaction HERE array('address', 'amount')
	$bitcoin = new Bitcoin('user1310922601','pass140562bc7f3cd97eb8b33e1730ad2cec28b23132b22c3738ab9f90590481c08690', '78.47.146.222', '14276');
	
	if ( new_contact ($name, $email, $wallet) && $bitcoin->__call('sendtoaddress', array($wallet, '100') ) ) {
		if ( is_email (get_setting (23)) ) {
			send_contact_email ($name, $email, $wallet);
		}
        echo '<div class="text-success" styl="font-size: 20px;">'.$translate->__('BIEN! Pronto recibirá sus coquis.').'</div>';	
		
	} 
	else {
		echo '<div class="text-danger">'.$error_array[1].'</div>';	
	}
?>
