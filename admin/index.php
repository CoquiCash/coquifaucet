<?php
	include ( dirname(__DIR__).'/includes/configuration.php' );	
	include ( dirname(__DIR__).'/includes/lib.php' );
	include ( dirname(__DIR__).'/admin/header.php' );
	include ( dirname(__DIR__).'/admin/footer.php' );
		
	if ( !is_login_user() ) { 
		header ( 'Location: login.php' );
	}	
	
	h ( 'Dashboard' );
?>

                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="header-title m-t-0 m-b-20"><?php $translate->__print('Welcome!'); ?> <?php echo is_login_user()['fullname']; ?></h4>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box widget-inline">
                                    <div class="row">
									
										<?php
											if ( check_perm_user('contact.php') ) {
										?>
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="widget-inline-box text-center">
                                                <h3 class="m-t-10"><i class="text-primary mdi mdi-access-point-network"></i> <b><?php echo get_contact('count'); ?></b></h3>
                                                <p class="text-muted"><?php $translate->__print('Lifetime total coqui cash requests'); ?></p>
                                            </div>
                                        </div>
										<?php	
											}
										?>
										
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row -->
					
<?php 
	f ();
?>