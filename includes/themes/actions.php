<?php 
	if ( !defined('THEME_LOAD') ) { die ( header('Location: /404') ); }
	
	$actions_array = array(
		'css' => '<link rel="stylesheet" href="/content/actions/style.css">',
		'js' => array(
			'new-request' => '<script src="/content/actions/new-request.js"></script>',
		),
	);
?>
