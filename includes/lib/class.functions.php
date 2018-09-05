<?php
	/**
	 * This file compiles all functions
	 *
	 * @category   Functions
	 * @author     Steven 
	 * @copyright  2018 VOS Group
	 * @version    1.0.0
	 * @since      File available since 1.0.0
	 */

	function random_number($long) {
		$crypt = new CryptoLib();
		return $crypt->randomInt( 100000, 999999 );
	}
	
	function decrypt_string($string, $key) {
		$crypt = new CryptoLib();
		return $crypt->decryptData($string, $key);
	}
	
	function encrypt_string($string, $key) {
		$crypt = new CryptoLib();
		return $crypt->encryptData($string, $key);
	}
	
	function validate_hash($hash, $string) {
		$crypt = new CryptoLib();
		return $crypt->validateHash($hash, $string);
	}
	
	function encrypt_hash($string) {
		$crypt = new CryptoLib();
		return $crypt->hash($string);
	}
	
	function new_error($error) {
		$_SESSION['new_error'][] = $error;
		return;
	}
	
	function get_error() {
		if ( !empty($_SESSION['new_error']) && is_array($_SESSION['new_error']) ) {
			return $_SESSION['new_error'];
		}
		return false;
	}

	function is_https() {
		if ( isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ) {
			return true;
		}
		
		return false;
	}
	
	function is_email($email) { 
		if ( filter_var($email, FILTER_VALIDATE_EMAIL) !== false ) {
			return true;
		}
		return false;
	} 

	function get_copyright_date() {
		if( date('Y') != '2018' ) { 
			echo '2018-'.date('Y'); 
		} 
		else { 
			echo '2018'; 
		}
	}
	
	function get_actual_url($lang = '') {
		global $router, $translate;
		
		$url = get_domain();
		
		if ( !empty($router->getCurrentUri()) ) {
			$url = $url.$router->getCurrentUri();
		}
		
		if ( $lang != 'NO_LANG' && !empty($_GET['lang']) && $_GET['lang'] == $translate->lng ) {
			$url = $url.'?lang='.$translate->lng;
		}
		
		return $url;
	}
	
	// Get the host URL (ie. return: http://domain.com)	
	function get_domain() {
		$url = base_url(TRUE);
		$url = substr($url, 0, -1); 
		
		return $url;
	}

	// Get the host URL (ie. return: domain.com)
	function get_host() {
		$url = base_url(NULL, NULL, TRUE)['host'];
		
		return $url;
	}
	
	// Clean a String (eliminate html, php tags)
	function clean_string($str) {
		$text = strip_tags($str);
	
		return $text;
	}
	
	// Clean a TEXT or URL (return ie. this-is-an-example)
	function clean_url($str) {
		$text = $str;
	
		$text = str_replace('?lang=es', '', $text);
		$text = str_replace('?lang=en', '', $text);
	
		$text = preg_replace ( '~[^\\pL0-9]+~u', '-', $text ); 
		$text = trim ( $text, "-" );
		$text = iconv ( "utf-8", "us-ascii//TRANSLIT", $text );
		$text = strtolower ( $text );
		$text = preg_replace ( '~[^-a-z0-9]+~', '', $text );
	
		return $text;
	}
	
	/**
	 * Get the base URL
	 * 
	 * base_url() will produce something like: http://domain.com/admin/users/
	 * base_url(TRUE) will produce something like: http://domain.com/
	 * base_url(TRUE, TRUE); || echo base_url(NULL, TRUE), will produce something like: http://domain.com/admin/
	 * base_url(NULL, NULL, TRUE) will produce something like: 
	 *		array(3) {
	 *			["scheme"] => string(4) "http"
	 * 			["host"] => string(12) "domain.com"
	 *			["path"] => string(35) "/admin/users/"
	 *		}
	 */
    function base_url ( $atRoot = FALSE, $atCore = FALSE, $parse = FALSE ) {
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];

            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf( $tmplt, $http, $hostname, $end );
        }
        else $base_url = 'http://localhost/';

        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
        }

        return $base_url;
    }
	
	/**
	 * Get a relative date (ie. Today)
	 *
	 * get_relative_time($datetime, 1); //10 hours ago  
	 * get_relative_time($datetime, 2); //10 hours and 50 minutes ago  
	 * get_relative_time($datetime, 3); //10 hours, 50 minutes and 50 seconds ago  
	 * get_relative_time($datetime, 4); //10 hours, 50 minutes and 50 seconds ago 
	 *
	 * @return: date
	 */
	function get_relative_time ($datetime, $depth = 1) {
		global $translate;

		if(!ctype_digit($datetime)) {
			$datetime = strtotime($datetime);
		}
		
		$units = array(
			$translate->__("year") => 31104000,
			$translate->__("month") => 2592000,
			$translate->__("week") => 604800,
			$translate->__("day") => 86400,
			$translate->__("hour") => 3600,
			$translate->__("minute") => 60,
			$translate->__("second") => 1
		);

		$plural = "s";
		$conjugator = ' '.$translate->__('and').' ';
		$separator = ", ";
		$suffix1 = ' '.$translate->__('ago');
		$suffix2 = ' '.$translate->__('left');
		$now = $translate->__("now");
		$empty = "";

		$timediff = time()-$datetime;
		if ($timediff == 0) return $now;
		if ($depth < 1) return $empty;

		$max_depth = count($units);
		$remainder = abs($timediff);
		$output = "";
		$count_depth = 0;
		$fix_depth = true;

		foreach ($units as $unit=>$value) {
			if ($remainder>$value && $depth-->0) {
				if ($fix_depth) {
					$max_depth -= ++$count_depth;
					if ($depth>=$max_depth) $depth=$max_depth;
					$fix_depth = false;
				}
				$u = (int)($remainder/$value);
				$remainder %= $value;
				$pluralise = $u>1?$plural:$empty;
				$separate = $remainder==0||$depth==0?$empty:
                            ($depth==1?$conjugator:$separator);
				$output .= "{$u} {$unit}{$pluralise}{$separate}";
			}
			$count_depth++;
		}
		return $output.($timediff<0?$suffix2:$suffix1);
	}
?>