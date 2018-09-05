<?php 
	if ( !defined('THEME_LOAD') ) { die ( header('Location: /404') ); }
?>
<!DOCTYPE html>
<html lang="<?php echo $translate->lng; ?>">
	<head>

		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8">

		<!-- Mobile Specific
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<!-- CSS
		================================================== -->
        <link rel="stylesheet" href="/content/theme/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="/content/theme/css/bootstrap/bootstrap-theme.min.css">
        <link rel="stylesheet" href="/content/theme/css/style.css">
        <link rel="stylesheet" href="/content/theme/css/font-awesome.min.css">
        <link rel="stylesheet" href="/content/theme/css/ionicons.min.css">
        <link rel="stylesheet" href="/content/theme/css/owl.carousel.css">
        <link rel="stylesheet" href="/content/theme/css/magnific-popup.css">
		
		<?php get_action('css'); ?>

		<?php get_seo($theme_array); ?>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->		
    </head>

    <body>

        <!--  Main Wrap  -->
        <div id="main-wrap">
            <!--  Header & Menu  -->
            <header id="header" class="transparent fixed full-width">
                <div class="container">
                    <nav class="navbar navbar-default white">
                        <!--  Header Logo  -->
                        <div id="logo">
                            <a class="navbar-brand" href="index.html">
                                <img src="/content/theme/img/logo-b.png" class="normal" alt="logo">
                                <img src="/content/theme/img/logo-b2.png" class="retina" alt="logo">
                                <img src="/content/theme/img/logo-w.png" class="normal white-logo" alt="logo">
                                <img src="/content/theme/img/logo-w2.png" class="retina white-logo" alt="logo">
                            </a>
                        </div>
                        <!--  END Header Logo  -->
                        <!--  Menu  -->
                        <div id="sidemenu">
                            <div class="menu-holder">
                                <ul>
                                    <li>
                                        <a href="/" class="anchor"><?php $translate->__print('Inicio'); ?></a>
                                    </li>
                                    <li>
                                        <a href="https://coqui.cash" class="anchor"><?php $translate->__print('Conoce Más'); ?></a>
                                    </li>
                                    <li>
                                        <a href="https://wallet.coqui.cash" class="anchor" target="_blank"><?php $translate->__print('Crea tu Wallet'); ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--  END Menu  -->
						
                        <!--  Button for Responsive Menu  -->
                        <div id="menu-responsive-sidemenu">
                            <div class="menu-button">
                                <span class="bar bar-1"></span>
                                <span class="bar bar-2"></span>
                                <span class="bar bar-3"></span>
                            </div>
                        </div>
                        <!--  END Button for Responsive Menu  -->
						
                    </nav>
                </div>
            </header>
            <!--  END Header & Menu  -->