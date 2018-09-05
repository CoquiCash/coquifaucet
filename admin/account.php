<?php 
	include ( dirname(__DIR__).'/includes/configuration.php' );	
	include ( dirname(__DIR__).'/includes/lib.php' );
	include ( dirname(__DIR__).'/admin/header.php' );
	include ( dirname(__DIR__).'/admin/footer.php' );
	
	if ( !is_login_user() ) { 
		header ( 'Location: login.php' );
	}	

	$user = is_login_user();

	if ( isset($_POST['submit']) ) {
		unset($_POST['submit']);
		unset($_POST['files']);
		
		foreach ( $_POST as $name => $value ) {
			if ( $name == 'confirm' ) {
				break;
			}
			
			if ( $name == 'password' ) {
				if ( $value == $_POST['confirm'] ) {
					update_user($user['id_user'], $name, trim($value));
				}
				break;
			}
			
			if ( update_user($user['id_user'], $name, trim($value)) ) {
				$success[]['id'] = $name;
			}
			else {
				$error[]['id'] = $name;
			}
		}
				
		if ( empty($error) && !empty($success) ) {
			header( "refresh:3" );
			$alert['content'] = 'Great! The user details was updated successfully.';
			$alert['type'] = 'alert-success';
		} 
		elseif ( !empty($error) && !empty($success) ) {
			header( "refresh:3" );
			$alert['content'] = 'Not all fields where updated successfully.';
			$alert['type'] = 'alert-warning';
		} 
		else {
			$alert['content'] = 'Oops! An error occurred, try again.';
			$alert['type'] = 'alert-danger';
		} 
	}	

	h ( 'Edit Your Account' );
?>  
                       <div class="row">
                            <div class="col-sm-12">
                                <h4 class="header-title m-t-0 m-b-20"><?php $translate->__print('Edit Your Account'); ?></h4>
                            </div>
                        </div>									
	
                       <div class="row">
                            <div class="col-sm-12">	
								<form action="#" method="post" class="form-validation">
									<br />
										<br />
										
									<div class="form-group">
										<label class="control-label">
											<?php $translate->__print('Full Name'); ?> <span style="color:red">*<?php echo $translate->__('(required)'); ?></span>
										</label>
										
										<input type="text" class="form-control" name="fullname" maxlength="40"<?php if( !empty($user['fullname']) ) { echo ' value="'.$user['fullname'].'"'; } ?>>
									</div>
									
									<br />
									
									<div class="form-group">
										<label class="control-label">
											<?php $translate->__print('Email'); ?> <span style="color:red">*<?php echo $translate->__('(required)'); ?></span>
										</label>
										
										<input type="text" class="form-control" name="email" maxlength="255"<?php if( !empty($user['email']) ) { echo ' value="'.$user['email'].'"'; } ?>>
									</div>
									
									<br />
									
									<div class="form-group">
										<label class="control-label">
											<?php $translate->__print('Password'); ?> <span style="color:red"><?php if ( empty($user) ) { echo '*'.$translate->__('(required)'); } ?></span>
										</label>
										
										<p class="text-muted font-13 m-b-10">
											<?php $translate->__print('Requires a minimum of 8 characters.'); ?>
										</p>
										
										<input type="password" class="form-control" name="password" maxlength="255">
									</div>
									
									<br />
									
									<div class="form-group">
										<label class="control-label">
											<?php $translate->__print('Confirm Password'); ?> <span style="color:red"><?php if ( empty($user) ) { echo '*'.$translate->__('(required)'); } ?></span>
										</label>
										
										<input type="password" class="form-control" name="confirm" maxlength="255">
									</div>

									<br />

									<div class="form-group text-right m-b-0">
										<button class="btn btn-primary waves-effect waves-light" name="submit" type="submit">
											<?php $translate->__print('Save Changes'); ?>
										</button>
									</div>																	
								</form>
							</div>
						</div>
						
<?php
	f();
?>