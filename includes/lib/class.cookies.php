<?php
	/**
	 * This file compiles all cookies actions
	 *
	 * @category   Cookies
	 * @author     Steven 
	 * @copyright  2018 VOS Group
	 * @version    1.0.0
	 * @since      File available since 1.0.0
	 */	
	
	$cookies_array = array(
		'user_email' => 'VOSM',
		'user_password' => 'VOSS',
	);
	
	function get_cookie($name) {	
		if ( !empty($_COOKIE[$name]) ) {
			return decrypt_string($_COOKIE[$name], COOKIES_KEY);
		}
		return false;
	}

	function delete_cookie($name) {
		if ( get_cookie($name) ) {
			if( new_cookie($name, 'delete') ) {
				return true;
			}
		} 
		return false;
	}

	/**
	 * Create a Cookie
	 * 
	 * Notes: 
	 *   $expire - Expiration date (24 hours from now by default; time()+60*60*24*7 for 7 days)
	 *   $path - Path to be used on ('/' is global)
	 *   $domain - Domain of the cookie to be used on (blank for actual)
	 *   $secure - If true only create cookies on HTTPS request
	 *   $http - If true disable cookie use via JavaScript
	 *
	 * @return: true or false 
	 */
	function new_cookie($name, $value, $expire = '') {	
		if ( empty($expire) ) {
			$expire = time()+60*60*24;
		}

		if ( is_https() ) {
			$secure = true;
		}
		else {
			$secure = false;
		}
		
		$path = '/';
		$domain = '';
		$http = true;
	
		$cookie = encrypt_string($value, COOKIES_KEY);
	
		if ( setcookie ($name, $cookie, $expire, $path, $domain, $secure, $http) ) {
			return true;
		}
		return false;
	}
?>