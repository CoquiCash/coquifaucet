<?php 
	include ( dirname(__DIR__).'/includes/configuration.php' );	
	include ( dirname(__DIR__).'/includes/lib.php' );
	include ( dirname(__DIR__).'/admin/header.php' );
	include ( dirname(__DIR__).'/admin/footer.php' );
	
	$group = exists_group_setting();
	
	if ( !check_perm_user() or !$group ) { 
		header ( 'Location: index.php' );
	}	
	
	if ( isset($_POST['submit']) ) {
		$array = array();
		
		foreach ( $_POST as $id => $value ) {
			$array[$id] = $value;
			
			// If a check box is empty assign value as false
			if ( substr_count($id, "checkbox-") > 0 ) {
				$id = str_replace('checkbox-', '', $id);
				if ( empty($array[$id]) ) {
					$array[$id] = 'false';
				}
			}

			// Delete the image if the box is check
			if ( substr_count($id, "image-") > 0 ) {
				$id = str_replace('image-', '', $id);
				$array[$id] = '';
			}
			
			// Update configuration
			if ( is_numeric($id) && get_setting($id) != $array[$id] ) {
				if ( update_setting ( trim($id), $array[$id] ) ) {
					$success[]['id'] = $id;
				}
				else {
					$error[]['id'] = $id;
				}
			}
		}
		
		// Alerts
		if ( empty($error) && empty($success) ) {
			$alert['content'] = 'Ok! No changes were made.';
			$alert['type'] = 'alert-secondary';
		} 		
		elseif ( empty($error) && !empty($success) ) {
			$alert['content'] = 'Great! The configuration was updated successfully.';
			$alert['type'] = 'alert-success';
		} 
		elseif ( !empty($error) && !empty($success) ) {
			$alert['content'] = 'Not all configurations where updated successfully.';
			$alert['type'] = 'alert-warning';
		} 
		else {
			$alert['content'] = 'Oops! An big error occurred while updating the configuration, try again.';
			$alert['type'] = 'alert-danger';
		} 
	}
	
	h ( $group );
?>  
                       <div class="row">
                            <div class="col-sm-12">
                                <h4 class="header-title m-t-0 m-b-20"><?php echo $translate->__('Settings').' / '.$translate->__($group);  ?></h4>
                            </div>
                        </div>

                       <div class="row">
                            <div class="col-sm-12">						
								<form action="#" method="post" class="form-validation" enctype="multipart/form-data">
					
								<?php
									foreach ( get_setting('all', 'WHERE cat = ? ORDER BY short_description ASC') as $id => $value ) {

										// Get the group name using the structure
										if ( substr_count($value['short_description'], "GROUP") > 0 ) {
											if ( substr_count($value['short_description'], "NAME:") > 0 ) {
												$group = explode('NAME:', trim($value['short_description']));
								?>
						
									<div class="row">
										<div class="col-sm-12">
											<h4 class="header-title m-t-0 m-b-20"><?php $translate->__print($group[1]);  ?></h4>
										</div>
									</div>
									
								<?php
											}
										}
								?>

									<div class="col-lg-6">
										<div class="p-20 m-b-20">

											<div class="m-b-20">
												<div class="form-group">
													<label for="userName"><?php $translate->__print(clean_setting($value['short_description']));  ?></label>
										
													<p class="text-muted font-13 m-b-10">
													<?php 
														$translate->__print($value['long_description']); 
														echo '<br />';
															
														// Determine if the string needs of translation
														if ( substr_count($value['short_description'], "TRANSLATE")>0 && $value['value'] != '' ) {
															if ( count($translate->get_langs()) > 1 ) {
																echo '<br /><span>'.$translate->__('You can edit the text translation in available languages').'. <a href="/admin/translate.php?settings='.$value['id_setting'].'" target="_blank">'.$translate->__('Click here to check the translations').'</a></span><br />';
																
																foreach ( $translate->get_langs() as $name => $val ) {
																	if ( $val['code'] != DEFAULT_LANGUAGE && !$translate->exists_string($value['value'], $val['code']) ) {
																		echo '<br /><span style="color:red;">'.$translate->__('Oops! It seems that there are some translation missing for the language').': <strong>'.$translate->__($val['name']).'</strong> <a href="/admin/translate.php?settings='.$value['id_setting'].'" target="_blank">'.$translate->__('Click here to fix it').'</a></span><br />';
																	}
																}
															}
														}
													?>
													</p>
													
													<?php
														// Determine if the input is a check-box
														if ( substr_count($value['short_description'], "INPUT-BOX") > 0 ) {
													?>
													<div>
														<input type="checkbox" name="<?php echo $value['id_setting']; ?>" value="true"<?php if( $value['value'] == 'true' ) { echo ' checked'; } ?> data-plugin="switchery" data-color="#1bb99a">
														<input type="text" name="checkbox-<?php echo $value['id_setting']; ?>" style="display:none !important;">
													</div>
													<?php
														}
														
														// Determine if the input is for image upload
														elseif ( substr_count($value['short_description'], "INPUT-IMAGE") > 0 ) {
													?>
													<div class="form-group">
														<?php if ( !empty($value['value']) ) { ?>
															<label class="control-label"><?php $translate->__print('Actual Image'); ?></label>
															<p class="text-muted font-13 m-b-10">
																<img src="<?php echo $value['value']; ?>" style="max-width:128px; max-height:128px;" class="rounded-circle" />
															</p>
														
															<label class="control-label"><?php $translate->__print('Check the box if you want none image (this will delete the actual one)'); ?></label>														
															<div class="checkbox checkbox-success">
																<input id="checkbox3" type="checkbox" name="image-<?php echo $value['id_setting']; ?>" value="delete" data-plugin="switchery" data-color="#1bb99a">
															</div>
															<br /><br />
														<?php } ?>
														<input type="file" name="<?php echo $value['id_setting']; ?>" class="filestyle" accept="image/*" data-input="false">
														<input type="text" name="file-<?php echo $value['id_setting']; ?>" style="display:none !important;">
													</div>
													<?php
														}
														// Determine if the input is a check-box
														elseif ( substr_count($value['short_description'], "INPUT-TEXT") > 0 ) {
													?>
														<input type="text" class="form-control" name="<?php echo $value['id_setting']; ?>" value="<?php echo $value['value']; ?>">
													<?php
														}
														// Regular text area for all others
														else {
															
															// If is SEO, only 120 characters are allowed for SEO mobile conversions
															if ( substr_count($value['short_description'], "SEO") > 0 ) {
													?>
																<script type='text/javascript'>
																	$(document).ready(function() {
																		var text_max = 120;
																		$('#text-<?php echo $value['id_setting']; ?>').ready(function() {
																			var text_length = $('#text-<?php echo $value['id_setting']; ?>').val().length;
																			var text_remaining = text_max - text_length;
  
																			$('#idmess-<?php echo $value['id_setting']; ?>').html(text_remaining + ' <?php $translate->__print('remaining'); ?>');
																		});
															
																		$('#text-<?php echo $value['id_setting']; ?>').keyup(function() {
																			var text_length = $('#text-<?php echo $value['id_setting']; ?>').val().length;
																			var text_remaining = text_max - text_length;
  
																			$('#idmess-<?php echo $value['id_setting']; ?>').html(text_remaining + ' <?php $translate->__print('remaining'); ?>');
																		});
																		
																		$('.summernote').summernote({
																			minHeight: 600,
																			maxHeight: null,             
																			focus: false                 
																		});

																	});
																</script>
													<?php
															} 
													?>		
															<textarea <?php 
																		if ( substr_count($value['short_description'], "SEO") > 0 ) { 
																			echo 'maxlength="120" style="height: 8em;" '; 
																		} 
																		else { 
																			echo 'style="height: 15em;" '; 
																		} 
																		?>id="text-<?php echo $value['id_setting']; ?>" class="form-control<?php 
																																			if ( substr_count($value['short_description'], "INPUT-HTML") > 0 ) { 
																																				echo ' summernote'; 
																																			} 
																																		?>" name="<?php echo $value['id_setting']; ?>"><?php echo $value['value']; ?></textarea>
															<?php if ( substr_count($value['short_description'], "SEO") > 0 ) { ?>
																<br /><h6 class="pull-right" id="idmess-<?php echo $value['id_setting']; ?>"></h6>
															<?php } ?>
													<?php 
														}
													?>
													
												</div>
											</div>

										</div>
									</div>
								<?php
									}
								?>
						
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