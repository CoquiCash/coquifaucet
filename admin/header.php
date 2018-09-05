<?php 
	function h ($title = '', $extra = '') {
		global $db, $translate, $alert, $icons_css;
		$page = basename ($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="<?php echo $translate->lng; ?>">
    <head>
        <meta charset="utf-8" />

		<title><?php if ( !empty($extra) ) { echo $translate->__($extra).' | '; }
					 if ( !empty($title) ) { echo $translate->__($title).' | '; } echo ' Admin | '; get_setting_print(1); ?></title>
					 
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <link href="/content/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/content/admin/css/style.css" rel="stylesheet" type="text/css" />
        <link href="/content/admin/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="/content/admin/css/metismenu.min.css" rel="stylesheet" type="text/css" />
		
        <link href="/content/admin/plugins/summernote/summernote-bs4.css" rel="stylesheet" />
		<link href="/content/admin/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
		<link href="/content/admin/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="/content/admin/plugins/switchery/switchery.min.css" rel="stylesheet" >
		<link href="/content/admin/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
		
        <link href="/content/admin/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="/content/admin/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="/content/admin/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		
        <!-- jQuery  -->
        <script src="/content/admin/js/jquery.min.js"></script>
		
		<?php get_404(); ?>
    </head>


    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="/admin/" class="logo">
                        <span>
                            <img src="/content/admin/images/lg.png" alt="">
                        </span>
                        <i>
                            <img src="/content/admin/images/logo-sm.png" alt="">
                        </i>
                    </a>
                </div>

                <nav class="navbar-custom">

                    <ul class="list-unstyled topbar-right-menu float-right mb-0">
						<?php 
							if ( USE_MULTI_LANG && count($translate->get_langs('admin')) > 1 ) {
						?>
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="mdi mdi-earth"></i> <?php $translate->__print($translate->lng_name); ?>  <i class="mdi mdi-chevron-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
							<?php
								foreach ( $translate->get_langs('admin') as $name => $value ) {
									if( $value['code'] != $translate->lng ) {
										echo '		<a href="?lang='.$value['code'].'" class="dropdown-item">'.$translate->__($value['name']).'</a>'."\n";
									}
								}
							?>
                            </div>
                        </li>
						<?php
							}
						?>

						<?php
							// The notification function, only support contact messages							
							if ( get_contact('count', 'WHERE status = 0') > 0 && check_perm_user( 'contact.php' ) ) { 
						?>
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="mdi mdi-bell noti-icon"></i>
                                <span class="badge badge-danger badge-pill noti-icon-badge"><?php echo get_contact('count', 'WHERE status = 0'); ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                                <div class="dropdown-item noti-title">
                                    <h6 class="m-0"><span class="float-right"></span><?php $translate->__print('Notification'); ?></h6>
                                </div>

                                <div class="slimscroll" style="max-height: 190px;">

								<?php
									foreach ( get_contact('all', 'WHERE status = 0 ORDER BY id_contact DESC LIMIT 3') as $id => $value ) {	
								?>
                                    <a href="/admin/contact.php?id=<?php echo $value['id_contact']; ?>" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-success"><i class="mdi mdi-message"></i></div>
                                        <p class="notify-details"><?php $translate->__print('Request from'); ?> <?php echo $value['name']; ?><small class="text-muted"><?php echo get_relative_time($value['date']); ?></small></p>
                                    </a>
								<?php	
									}
								?>
                                <a href="/admin/contact.php" class="dropdown-item text-center text-primary notify-item notify-all">
                                    <?php $translate->__print('View all'); ?> <i class="fi-arrow-right"></i>
                                </a>

                            </div>
                        </li>
						<?php
							}
						?>
						
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="ml-1"><?php echo is_login_user()['fullname']; ?> <i class="mdi mdi-chevron-down"></i> </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <a href="/" class="dropdown-item notify-item" target="_blank">
                                    <i class="ti-location-arrow"></i> <span><?php $translate->__print('View Site'); ?></span>
                                </a>
								
                                <!-- item-->
                                <a href="/admin/account.php" class="dropdown-item notify-item">
                                    <i class="ti-user"></i> <span><?php $translate->__print('My Account'); ?></span>
                                </a>

                                <!-- item-->
                                <a href="/admin/logout.php" class="dropdown-item notify-item">
                                    <i class="ti-power-off"></i> <span><?php $translate->__print('Logout'); ?></span>
                                </a>

                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </li>
                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="user-details">
                    <div class="user-info">
                        <a href="#"><?php echo is_login_user()['fullname']; ?></a>
                        <p class="text-muted m-0"><?php $translate->__print(get_role_user(is_login_user()['privilege'])); ?></p>
                    </div>
                </div>

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu" id="side-menu">
                        <li class="menu-title"><?php $translate->__print('Navigation'); ?></li>
                        <li>
                            <a href="/admin/"<?php if ( $page == 'index.php' ) { echo ' class="active"'; } ?>>
                                <i class="ti-home"></i><span> <?php $translate->__print('Dashboard'); ?> </span>
                            </a>
                        </li>

						<?php 
							if ( check_perm_user( 'contact.php' ) ) {
						?>
                        <li>
                            <a href="#"<?php if ( $page == 'contact.php' ) { echo ' class="active"'; } ?>>
                                <i class="ti-comment"></i><?php if ( get_contact('count', 'WHERE status = 0') > 0 ) { ?><span class="badge badge-custom pull-right"><?php echo get_contact('count', 'WHERE status = 0'); ?></span><?php } ?> <span><?php $translate->__print('Coquis Request'); ?></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="contact.php"><?php $translate->__print('All'); ?></a></li>
                                <li><a href="contact.php?q=archived"><?php $translate->__print('Archived'); ?></a></li>
                            </ul>
                        </li>
						<?php } ?>
						
						<?php if ( check_perm_user( 'settings.php' ) ) { ?>		
                        <li>
                            <a href="#"<?php if ( $page == 'settings.php' ) { echo ' class="active"'; } ?>><i class="ti-settings"></i> <span> <?php $translate->__print('Settings'); ?> </span> <span class="menu-arrow"></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
							<?php
								foreach ( get_group_setting() as $id => $name ) {
									echo '		<li><a href="/admin/settings.php?p='.$id.'">'.$translate->__($name).'</a></li>';
								}
							?>
                               
                            </ul>
                        </li>
						<?php } ?>
						
                    </ul>

                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>

            </div>
            <!-- Left Sidebar End -->
			
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
			
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
					
						<?php 
							if ( !empty($alert) ) {
						?>
						<div class="alert <?php echo $alert['type']; ?> alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                            </button>
                            <?php $translate->__print($alert['content']); ?>
                        </div>
						<?php 
							}	
	}
?>