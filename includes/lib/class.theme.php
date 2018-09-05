<?php
	/**
	 * This file compiles all themes actions
	 *
	 * The $array variable is an array composed of six parts: 
	 * 		404, title, extra (for a second part of the title), metaDesc, socialTitle, socialImg
	 *
	 * @category   Themes
	 * @author     Steven 
	 * @copyright  2018 VOS Group
	 * @version    1.0.0
	 * @since      File available since 1.0.0
	 */

	function get_li_langs($class = '') {
		global $translate;
		
		if ( USE_MULTI_LANG ) {
			foreach ( $translate->get_langs() as $name => $value ) {
				if ( $value['code'] != $translate->lng ) {
					echo '		<li class="'.$class.'"><a href="?lang='.$value['code'].'">'.$translate->__($value['name']).'</a></li>'."\n";
				}
			}
		}
	}
	
	function get_action($type) {
		if( file_exists( dirname(__DIR__).'/themes/actions.php' ) ) {
			include( dirname(__DIR__).'/themes/actions.php' );
			
			if ( $type == 'css' && !empty($actions_array['css']) ) {
				echo '<!-- ACTIONS -->'."\n";
				echo '		'.$actions_array['css']."\n";
			}
			elseif( $type == 'js' && !empty($actions_array['js']) && is_array($actions_array['js']) ) {
				echo '<!-- ACTIONS -->'."\n";
				
				foreach ( $actions_array['js'] as $name => $value ) {
					echo '		'.$value."\n";
				}
			}
		}
		return;
	}
	
	function get_404() {
		echo "\n".'		<meta name="robots" content="noindex">'."\n";			
		echo '		<meta name="googlebot" content="noindex">'."\n";
	}
	
	function get_canonical($array = '') {
		global $translate;		
		
		echo '		<link rel="canonical" href="'.get_actual_url( 'NO_LANG' ).'" />	'."\n";
		
		if ( USE_MULTI_LANG ) {
			foreach ( $translate->get_langs() as $name => $value ) {		
				echo '		<link rel="alternate" hreflang="'.$value['code'].'" href="'.get_actual_url( 'NO_LANG' ).'?lang='.$value['code'].'" />'."\n";
			}
		}
		
		echo "\n";
	}
	
	function get_seo($array = '') {
		global $translate;

		echo "\n".'		<title>';
			get_title($array);
		echo '</title>'."\n\n";
		
		if ( !empty($array['404']) ) {
			echo "\n".'		<meta name="robots" content="noindex">'."\n";			
			echo '		<meta name="googlebot" content="noindex">'."\n";
			return; //@404 do not include any more data because is a 404 page
		}

		echo '		<!-- SOCIAL/SEO TAGS
		================================================== -->'."\n";
		
		get_canonical($array);
		
		echo '		<meta name="og:site_name" content="'.get_setting(1).'">'."\n";
		echo '		<meta name="og:type" content="website">'."\n";
		echo '		<meta property="og:image:width" content="1200">'."\n";
		echo '		<meta property="og:image:height" content="628">'."\n";
		echo '		<meta name="twitter:card" content="summary">'."\n";

		if ( !empty(get_setting(52)) ) { 
			echo '		<meta name="twitter:site" content="'.get_setting(52).'">'."\n";
			echo '		<meta name="twitter:creator" content="'.get_setting(52).'">'."\n";
		}
			
		if ( !empty($array['socialTitle']) ) {
			echo '		<meta property="og:title" content="'.$translate->__($array['socialTitle']).'">'."\n";
			echo '		<meta name="twitter:title" content="'.$translate->__($array['socialTitle']).'">'."\n";
		}
		else {
			echo '		<meta property="og:title" content="'.$translate->__(get_setting(51)).'">'."\n";
			echo '		<meta name="twitter:title" content="'.$translate->__(get_setting(51)).'">'."\n";
		}		
			
		if ( !empty($array['metaDesc']) ) {
			echo '		<meta property="og:description" content="'.$translate->__($array['metaDesc']).'">'."\n";
			echo '		<meta name="twitter:description" content="'.$translate->__($array['metaDesc']).'">'."\n";
		}
		else {
			echo '		<meta property="og:description" content="'.$translate->__(get_setting(28)).'">'."\n";
			echo '		<meta name="twitter:description" content="'.$translate->__(get_setting(28)).'">'."\n";
		}		

		if ( !empty($array['socialImg']) ) {
			echo '		<meta property="og:image" content="'.$array['socialImg'].'">'."\n";
			echo '		<meta name="twitter:image:src" content="'.$array['socialImg'].'">'."\n";
		}
		
		echo '		<meta property="og:url" content="'.get_actual_url().'">'."\n\n";
		
		if( !empty($array['metaDesc']) ) {
			echo '		<meta name="description" content="'.$translate->__($array['metaDesc']).'">'."\n";
		}
	}
	
	function get_title($array = '') {
		global $translate;
		
		$separator = '|';
		
		if ( !empty($array['extra']) ) { 
			echo $translate->__($array['extra'])." {$separator} "; 
		}	 
		if ( !empty($array['title']) ) { 
			echo $translate->__($array['title'])." {$separator} "; 
		} 
		if ( !empty($array['404']) ) {
			echo $translate->__print('Oops! Page Not Found')." {$separator} "; 
		}
		get_setting_print(1);
	}
	
	function get_header($theme_array) {
		global $translate;
		
		if( file_exists( dirname(__DIR__).'/themes/header.php' ) ) {
			include( dirname(__DIR__).'/themes/header.php' );
		}
	}
	
	function get_footer($theme_array) {
		global $translate;
		
		if( file_exists( dirname(__DIR__).'/themes/footer.php' ) ) {
			include( dirname(__DIR__).'/themes/footer.php' );
		}
	}
?>