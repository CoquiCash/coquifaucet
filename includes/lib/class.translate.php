<?php
	/**
	 * This file compiles all translation actions
	 *
	 * @category   Translation
	 * @author     Steven 
	 * @copyright  2018 VOS Group
	 * @version    1.0.0
	 * @since      File available since 1.0.0
	 */		
	
	/** NEED SOME MODIFICATIONS **/
	
	class Translator {
		private $lang_cookie = 'VOSLG';
		private $language = DEFAULT_LANGUAGE;
		private $lang = array();
		private $file_url;
		
		public $is_auto = false;
		public $lng_default;
		public $lng_name;
		public $lng;

		public function __construct($load = '') {
			
			/* The admin has its own language section */
			if ( basename(getcwd()) == 'admin' ) {
				$this->lang_cookie = 'admin-lang';
			}
			
			$this->file_url = dirname(__DIR__).'/lang/';

			if ( $load == 'GET' && USE_MULTI_LANG ) {
				if ( !empty( get_cookie($this->lang_cookie) ) && empty( $_GET['lang'] ) ) {
					$url = $_SERVER['REQUEST_URI'];
										
					if ( substr_count($url, '?') > 0 ) { $url = $url.'&'; }
					else {
						$url = $url.'?';
					}
			
					if ( $this->exists_language( get_cookie($this->lang_cookie) )  ) {
						die ( header('Location: '.$url.'lang='.get_cookie($this->lang_cookie) ) );
					}
				}					
				elseif ( !empty($_GET['lang']) && $this->exists_language($_GET['lang']) ) {
					new_cookie ($this->lang_cookie, $_GET['lang'], time()+60*60*24*90);
					$this->language = $_GET['lang'];
				} 
			}
			elseif ( !empty(get_cookie($this->lang_cookie)) && $this->exists_language(get_cookie($this->lang_cookie)) && USE_MULTI_LANG ) {
				$this->language = get_cookie($this->lang_cookie);	
			}
			
			/* The admin has its own language section */
			if ( basename(getcwd()) == 'admin' ) {
				$this->language = 'admin-'.$this->language;
			}

			$this->lng = str_replace('admin-', '', $this->language);
			$this->lng_name = $this->get_langs()[$this->lng]['name'];
			$this->lng_default = $this->get_langs()[DEFAULT_LANGUAGE]['name'];
		}

		public function get_langs($var = '') {							
			$lang_exists = array();
			$lang = array ( 'en' => array ( 'code' => 'en', 'name' => 'English'),
							'es' => array ( 'code' => 'es', 'name' => 'Spanish'),);

			if ( $var == 'admin' ) {
				$lang = array ( 'en' => array ( 'code' => 'en', 'name' => 'English'),
								'es' => array ( 'code' => 'es', 'name' => 'Spanish'),);
				return $lang;
			}
			
			foreach ( $lang as $name => $value ) {
				if ( $this->exists_language($value['code']) ) {
					$lang_exists[$name] = array ( 'code' => $value['code'], 'name' => $value['name'] );
				}
			}
			
			return $lang_exists;
		}
		
		public function exists_language($language) {
			// Default Language does not need a file
			if ( $language == DEFAULT_LANGUAGE ) { return true; }

			if ( file_exists($this->file_url.$language.'.txt')) {
				return true;
			}
			return false;
		}
			
		public function exists_string($str, $language) {	
			$str = trim($str);
			
			if (!array_key_exists($language, $this->lang)) {
				if ( file_exists($this->file_url.$language.'.txt')) {
					$strings = array_map(array($this,'split_strings'),file($this->file_url.$language.'.txt'));
					foreach ($strings as $k => $v) {
						if ( !empty($v[0]) && !empty($v[1]) ) {
							$v[0] = trim($v[0]);
							$this->lang[$language][$v[0]] = trim($v[1]);
						}
					}
						
					if (!empty($this->lang[$language]) && array_key_exists($str, $this->lang[$language])) {
						return $this->lang[$language][$str];
					}
					return false;
				}
				return false;
			}
			else {
				if (!empty($this->lang[$language]) && array_key_exists($str, $this->lang[$language])) {
					return $this->lang[$language][$str];
				}

				return false;
			}
		}			

		public function __print($str) {  
			echo $this->__($str);
		}
				
		public function __($str) {  		
			if (!array_key_exists($this->language, $this->lang)) {
				if ( file_exists($this->file_url.$this->language.'.txt')) {
					$strings = array_map(array($this,'split_strings'),file($this->file_url.$this->language.'.txt'));
					foreach ($strings as $k => $v) {
						if ( !empty($v[0]) && !empty($v[1]) ) {
							$this->lang[$this->language][$v[0]] = $v[1];
						}
					}
					return $this->get_string($str);
				}
				return $str;
			}
			return $this->get_string($str);
		}
		
		private function split_strings($str) {
			return explode('=',trim($str));
		}
				
		private function get_string($str) {
			if ( !empty($this->lang[$this->language]) && array_key_exists($str, $this->lang[$this->language]) ) {
				$v = $this->lang[$this->language][$str];
				
				// Allow comments on files using "#"
				if ( $v[0] != "#" ) {
					return $v;
				}
			}
			return $str;
		}

		public function update_string ($str, $new_str, $language) {
			if ( file_exists($this->file_url.$language.'.txt')) {
				$contents = file_get_contents ($this->file_url.$language.'.txt');
				$contents = str_replace (trim($str), trim($new_str), $contents);
				
				if( file_put_contents ($this->file_url.$language.'.txt', $contents) ) {
					return true;
				}
				
				return false;
			}
			
			return false;
		}
		
		public function new_string ($str, $translated_str, $language) {
			if ( file_exists($this->file_url.$language.'.txt')) {
				$contents = file_get_contents ($this->file_url.$language.'.txt');
				$contents = $contents."\n";
				$contents = $contents.trim($str.'='.$translated_str);
				
				if( file_put_contents ($this->file_url.$language.'.txt', $contents) ) {
					return true;
				}
				
				return false;
			}
			else {
				if ( file_put_contents($this->file_url.$language.'.txt', trim($str.'='.$translated_str)."\n" ) ) {
					return true;
				}
				return false;
			}
		}
	}
?>