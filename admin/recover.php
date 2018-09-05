<?php 
	include ( dirname(__DIR__).'/includes/configuration.php' );	
	include ( dirname(__DIR__).'/includes/lib.php' );

	if ( is_login_user() ) { 
		header ( 'Location: index.php' );
	}
	
	/**
	 * The code below process to see if the user has a password recover link
	 *
	 * Validations that are performed: 
	 * 		1) check if the recover data is true (auth)
	 *		2) check date has not pass 24 hours period
	 */
	if ( !empty($_GET['email']) && is_email($_GET['email']) && !empty(get_user($_GET['email'])['recover']) && !empty($_GET['auth']) && !empty($_GET['date']) ) {
		$user = get_user($_GET['email']);
		$check = explode( ';', trim($user['recover']) );

		if ( $_GET['auth'] == $check[0] && $_GET['date'] == $check[1] && time()<$check[1] ) {
			$user['check'] = true;
		}
	}
	
	if ( isset($_POST['submit']) ) {
		if ( !empty($user['check']) && $user['check'] == true && !empty($_POST['passwordconfirm']) && !empty($_POST['password']) ) {						
			if ( update_user ( $user['id_user'], 'password', array( 'pass' => $_POST['password'], 'conf' => $_POST['passwordconfirm'] )  ) ) {
				 update_user ( $user['id_user'], 'recover', 'NULL' ); // Remove the update auth
				
				$alert['content'] = 'Great! Your password has been updated.';
				$alert['type'] = 'alert-success';
			}
			else {
				$alert['content'] = 'Oops! An error occurred, try again.';
				$alert['type'] = 'alert-danger';
			}
		}								
		elseif ( !empty($_POST['email']) && email_exists_user ($_POST['email']) ) {
			$auth = random_number(6);
			$date = time()+60*60*24; // Code expire in 24 hours

			$user = get_user($_POST['email']);
			
			$link = get_domain()."/admin/recover.php?email={$user['email']}&auth=$auth&date=$date";
			
			if ( update_user ( $user['id_user'], 'recover', $auth.';'.$date ) ) {
				send_recover_email ( $user['first'], $user['email'], $link );
				$alert['content'] = 'Great! We have sent you the email.';
				$alert['type'] = 'alert-success';
			}
			else {
				$alert['content'] = 'Oops! An error occurred, try again.';
				$alert['type'] = 'alert-danger';
			}
		}
		else {
			$alert['content'] = 'Oops! An error occurred, try again.';
			$alert['type'] = 'alert-danger';
		}
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php $translate->__print('Reset Password'); ?> | <?php get_setting_print(1); ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <link href="/content/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/content/admin/css/style.css" rel="stylesheet" type="text/css" />

		<?php get_404(); ?>
    </head>

    <body>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

							<?php 
								if ( !empty($alert) ) {
							?>
							<div class="alert <?php echo $alert['type']; ?> alert-white alert-dismissible fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?php $translate->__print($alert['content']); ?>
                            </div>
							<?php 
								}	
							?>
							
                            <div class="m-t-40 card-box">
                                <div class="text-center">
                                    <h2 class="text-uppercase m-t-0 m-b-30">
                                        <a href="/admin" class="text-success">
                                            <span><img src="/content/admin/images/logo-lg.png" alt="" height="30"></span>
                                        </a>
                                    </h2>
                                    <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                                </div>
                                <div class="account-content">

                                    <form method="post" class="form-horizontal" action="#">
									
									<?php 
										if ( !empty($user['check']) && $user['check'] == true ) {									
									?>
									
                                    <div class="text-center m-b-20">
                                        <p class="text-muted m-b-0 line-h-24"><?php $translate->__print('Enter your new password below.'); ?></p>
										<p class="text-muted m-b-0 line-h-24"><b><?php $translate->__print('Passwords must be 8 characters or more.'); ?></b></p>
                                    </div>
									
                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">
                                                <label for="password"><?php $translate->__print('Password'); ?></label>
                                                <input name="password" class="form-control" type="password" required="">
                                            </div>
                                        </div>						

                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">
                                                <label for="password"><?php $translate->__print('Confirm Password'); ?></label>
                                                <input name="passwordconfirm" class="form-control" type="password" required="">
                                            </div>
                                        </div>								
									
									<?php
										}
										else {
									?>
									
                                    <div class="text-center m-b-20">
                                        <p class="text-muted m-b-0 line-h-24"><?php $translate->__print("Enter your email address and we'll send you an email with instructions to reset your password."); ?></p>
                                    </div>
									
                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">
                                                <label for="emailaddress"><?php $translate->__print('Email'); ?></label>
                                                <input name="email" class="form-control" type="email" id="emailaddress" required="" placeholder="<?php $translate->__print('your@email.com'); ?>">
                                            </div>
                                        </div>

									<?php
										}
									?>
									
                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit"><?php $translate->__print('Reset Password'); ?></button>
                                            </div>
                                        </div>
										
                                    </form>
									
                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            <!-- end card-box-->

                            <div class="row m-t-50">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted"><?php $translate->__print('Back to'); ?> <a href="/admin/login.php" class="text-dark m-l-5"><?php $translate->__print('Sign In'); ?></a></p>
                                </div>
                            </div>
							
                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
        </section>

        <!-- jQuery  -->
        <script src="/content/admin/js/jquery.min.js"></script>
        <script src="/content/admin/js/bootstrap.min.js"></script>

    </body>
</html>