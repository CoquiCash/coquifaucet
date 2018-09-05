<?php
	/**
	 * This file compiles all users actions
	 *
	 * @category   Users
	 * @author     Steven 
	 * @copyright  2018 VOS Group
	 * @version    1.0.0
	 * @since      File available since 1.0.0
	 */	

	$error_array = array(
		1 => $translate->__('The email is already on use.'),
		2 => $translate->__('Please enter your name, a valid email and password.'),
		3 => $translate->__('Your name needs to be 80 characters or less.'),
		4 => $translate->__('Your email is too long, use one that has 255 characters or less'),
		5 => $translate->__('The password needs to be 8 characters or more.'),
	);
		
	function check_perm_user($page = '') {
		if ( empty($page) ) {
			$page = basename ($_SERVER['PHP_SELF']);
		}
		
		if ( !is_login_user() ) {
			return false;
		}
		
		$role = get_perm_user();
		
		if ( $role == 2657 ) {
			return true;
		}
		elseif ( $role == 4) {
			$access = array ( 'project', 'contact', 'service', 'apps', 'image', 'translate' );
		}
		elseif ( $role == 3) {
			$access = array ( 'project', 'contact', 'apps', 'image', 'translate' );
		}
		elseif ( $role == 2) {
			$access = array ();
		}
		elseif ( $role == 1) {
			$access = array ();
		}
		
		foreach ( $access as $name ) {
			if ( substr_count($page, $name) > 0) {
				return true;
			}
		}
			
		return false;
	}
	
	function get_role_user($role = '') {
		if ( $role == 2657 ) {
			return 'Administrator';
		}
		elseif ( $role == 4) {
			return 'Moderator';
		}
		elseif ( $role == 3) {
			return 'Customer Support Rep';
		}
		elseif ( $role == 2) {
			return 'Premium';
		}
		elseif ( $role == 1) {
			return 'Standard';
		}
		return false;
	}

	function is_login_user() {
		global $db, $cookies_array;
		
		if( get_cookie ( $cookies_array['user_email'] ) && get_cookie ( $cookies_array['user_password'] ) ) {
			$email = get_cookie ( $cookies_array['user_email'] );
					
			$q = $db->prepare ( "SELECT * FROM vos_users WHERE email = ?" );
			$q->bind_param ( 's', $email );
			$q->execute();
			$result = $q->get_result();

			while ( $o = $result->fetch_array(MYSQLI_ASSOC) ) {			
				if ( get_cookie ( $cookies_array['user_email'] ) == $o['email'] && get_cookie ( $cookies_array['user_password'] ) == $o['password'] ) {
					return $o;
				}
			}
			$q->close();
		}
		return false;
	}

	function logout_user() {
		global $cookies_array;
		
		if ( is_login_user() ) {
			if ( delete_cookie ( $cookies_array['user_email'] ) && delete_cookie ( $cookies_array['user_password'] ) ) {
				return true;
			}
		}
		return false;
	}

	function login_user($email, $password, $remember = '') {
		global $db, $cookies_array;
		
		if ( !is_email($email) ) {
			return false;
		}
		
		$expire = '';
		if ( $remember == 'true' ) {
			$expire = time()+60*60*24*7;
		}
		
		$q = $db->prepare ( "SELECT * FROM vos_users WHERE email = ?" );
		$q->bind_param ( 's', $email );
		$q->execute();
		$result = $q->get_result();

		while ( $o = $result->fetch_array ( MYSQLI_ASSOC ) ) {
			if ( $email == $o['email'] && validate_hash($o['password'], $password) ) {
				
				if ( new_cookie ( $cookies_array['user_email'], $o['email'], $expire ) && new_cookie ( $cookies_array['user_password'], $o['password'], $expire ) ) {
					return true;
				}
			}
		}
		$q->close();

		return false;
	}

	function get_perm_user($id = '') {
		if ( empty($id) && is_login_user() ) {
			return is_login_user()['privilege'];
		}
		return get_user($id)['privilege'];
	}

	function email_exists_user($email) {
		global $db;

		if ( !is_email($email) ) {
			return false;
		}
		
		$q = $db->prepare ( "SELECT email FROM vos_users WHERE email = ?" );
		$q->bind_param ( 's', $email );
		$q->execute();
		$result = $q->get_result();
	
		while ( $o = $result->fetch_array(MYSQLI_ASSOC) ) {	
			if ( $o['email'] == $email ) {
				return true;
			}		
		}
		return false;
	}

	function get_user($var, $specific = '') {
		global $db;

		if ( $var == 'all' or $var == 'count' ) {
			$q = $db->prepare ( "SELECT * FROM vos_users $specific" );
		}		
		elseif ( is_email($var) ) {
			$q = $db->prepare ( "SELECT * FROM vos_users WHERE email = ?" );
			$q->bind_param ( 's', $var );
		}
		elseif( is_numeric($var) ) {
			$q = $db->prepare ( "SELECT * FROM vos_users WHERE id_user = ?" );
			$q->bind_param ( 'i', $var );
		}

		$q->execute();
		$result = $q->get_result();
		$array = array();

		if ( $var == 'count' ) {
			return $result->num_rows;
		}
		
		while ( $o = $result->fetch_array(MYSQLI_ASSOC) ) {	
			if ( $var == 'all' ) {
				array_push($array, $o);
			}
			else {
				return $o;
			}
		}
		$q->close();	

		if ( $var == 'all' ) {
			return $array;
		}	
		
		return false;
	}

	function delete_user($id) {
		global $db;

		// Protect main administrator
		if ($id == 1) { return false; }
	
		// Only main admin can delete other admins
		if ( get_perm_user($id) == 2657 && is_login_user()['id_user'] != 1 ) {
			return false;
		}
	
		$q = $db->prepare ( "DELETE FROM vos_users WHERE id_user = ?" );
		$q->bind_param ( 'i', $id );
	
		if ( $q->execute() ) {
			return true;
		}

		return false;
	}

	function update_user($id, $table, $value) {
		global $db, $translate, $error_array;

		if ( !get_user($id) or empty($table) or empty($value) ) {
			return false;
		}
		
		if ( $table != 'fullname' && $table != 'email' && $table != 'password' && $table != 'privilege' && $table != 'recover' ) {
			return false;
		}

		// Only allow full admins to change user "privilege"
		if ( $table == 'privilege' && !check_perm_user('admin') ) {
			return false;
		}
		
		if ( $table == 'email' && !is_email($value) or  $table == 'email' && email_exists_user($value) ) {
			new_error($error_array[1]);
			return false;
		}
		
		if ( $table == 'fullname' && strlen($value)>80 ) {
			new_error($error_array[3]);
			return false;
		}

		if ( $table == 'email' && strlen($value)>255 ) {
			new_error($error_array[4]);
			return false;
		}
		
		if ( $table == 'password' && strlen($value)<8 ) {
			new_error($error_array[5]);
			return false;
		}
		
		if ( $table == 'fullname' ) {
			$value = preg_replace ( '/[^A-Za-z0-9\ ]/', '', $value );
		}
		
		if ( $table == 'password' ) {
			$value = encrypt_hash($value);
		}
				
		$q = $db->prepare ( "UPDATE vos_users SET $table = ? WHERE id_user = ?" );
		$q->bind_param ( 'si', $value, $id );
	
		if ( $q->execute() ) {
			return true;
		}
		$q->close();
	
		return false;
	}

	function new_user($fullname, $email, $password, $privilege = '') {
		global $db, $translate, $error_array;
		
		if ( email_exists_user($email) ) {
			new_error($error_array[1]);
			return false;
		}

		if ( empty($fullname) or !is_email($email) or empty($password) ) {
			new_error($error_array[2]);
			return false;
		}
		
		if ( strlen($fullname)>80 ) {
			new_error($error_array[3]);
			return false;
		}

		if ( strlen($email)>255 ) {
			new_error($error_array[4]);
			return false;
		}
		
		if ( strlen($password)<8 ) {
			new_error($error_array[5]);
			return false;
		}

		$fullname = preg_replace ( '/[^A-Za-z0-9\ ]/', '', $fullname );
		$password = encrypt_hash($password);	
		
		$q = $db->prepare ( "INSERT INTO vos_users (fullname, email, password, privilege) values (?, ?, ?, ?)" );
		$q->bind_param ( 'ssss', $fullname, $email, $password, $privilege );
	
		if ( $q->execute() ) {
			return true;
		}
		$q->close();
	
		return false;
	}
?>