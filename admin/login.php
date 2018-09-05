<?php 
	include ( dirname(__DIR__).'/includes/configuration.php' );	
	include ( dirname(__DIR__).'/includes/lib.php' );
	
	if ( is_login_user() ) { 
		header ( 'Location: index.php' );
	}
	
	if ( isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password']) ) {
		if ( empty($_POST['remember']) ) { 
			$_POST['remember'] = ''; 
		}
		
		if ( login_user ( $_POST['email'], $_POST['password'], $_POST['remember'] ) ) {
			header ( 'Location: index.php' );
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
		
        <title><?php $translate->__print('Login'); ?> | <?php get_setting_print(1); ?></title>
		
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

                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">
                                                <label for="emailaddress"><?php $translate->__print('Email'); ?></label>
                                                <input name="email" class="form-control" type="email" id="emailaddress" required="" placeholder="<?php $translate->__print('your@email.com'); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">
                                                <a href="/admin/recover.php" class="text-muted pull-right font-14"><?php $translate->__print('Forgot your password?'); ?></a>
                                                <label for="password"><?php $translate->__print('Password'); ?></label>
                                                <input name="password" class="form-control" type="password" required="" id="password" placeholder="<?php $translate->__print('Enter your password'); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group m-b-30">
                                            <div class="col-xs-12">
                                                <div class="checkbox checkbox-primary">
                                                    <input id="checkbox5" type="checkbox" name="remember" value="true">
                                                    <label for="checkbox5">
                                                        <?php $translate->__print('Remember me'); ?> 
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit"><?php $translate->__print('Sign In'); ?></button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            <!-- end card-box-->

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