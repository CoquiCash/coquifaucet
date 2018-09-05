<?php 
	include ( dirname(__DIR__).'/includes/configuration.php' );	
	include ( dirname(__DIR__).'/includes/lib.php' );
	include ( dirname(__DIR__).'/admin/header.php' );
	include ( dirname(__DIR__).'/admin/footer.php' );
	
	if ( !check_perm_user('contact.php') ) { 
		header ( 'Location: index.php' );
	}	

	if ( !empty($_GET['d']) ) {
		header('Content-Type: application/json');
		$array = array();
		
		if (  delete_contact($_GET['d']) ) {
			$array['status'] = 'success';
		}
		else {
			$array['status'] = 'error';
		}
		
		echo json_encode($array);
		die;
	}
	
	if ( !empty($_GET['a']) ) {
		header('Content-Type: application/json');
		$array = array();
		
		if (  update_contact($_GET['a'], 'status', 1) ) {
			$array['status'] = 'success';
		}
		else {
			$array['status'] = 'error';
		}
		
		echo json_encode($array);
		die;
	}
	
	if ( !empty($_GET['na']) ) {
		header('Content-Type: application/json');
		$array = array();
		
		if (  update_contact($_GET['na'], 'status', 0) ) {
			$array['status'] = 'success';
		}
		else {
			$array['status'] = 'error';
		}
		
		echo json_encode($array);
		die;
	}

	if ( !empty($_GET['r']) ) {
		header('Content-Type: application/json');
		$array = array();
		
		$array['message'] = get_contact($_GET['r'])['comments'];
		
		echo json_encode($array);
		die;
	}
	
	h ( 'Contact' );	
?>  
                       <div class="row">
                            <div class="col-sm-12">
                                <h4 class="header-title m-t-0 m-b-20"><?php $translate->__print('Request'); ?></h4>
                                    <h4 class="font-14"><?php $translate->__print('Here you will find all the request of people that has asked for coqui cash.'); ?></h4>
								<p>
									<?php
										if ( !empty($_GET['q']) && $_GET['q'] == 'archived' ) {
											echo '		<a href="/admin/contact.php" class="btn btn btn-dark pull-right">'.$translate->__('See All Request').'</a>';
										}
										else {
											echo '		<a href="/admin/contact.php?q=archived" class="btn btn btn-dark pull-right">'.$translate->__('See Archived Request').'</a>';
										}
									?>
								</p>
                            </div>
                        </div>
                       <div class="row p-t-50">
                            <div class="col-12">
                                <div class="table-responsive">
									<br />
									<br />
                                    <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th><?php $translate->__print('Name'); ?></th>
                                            <th><?php $translate->__print('Email'); ?></th>
                                            <th><?php $translate->__print('Actions'); ?></th>
                                        </tr>
                                        </thead>


                                        <tbody>
										<?php
											if ( !empty($_GET['q']) && $_GET['q'] == 'archived' ) {
												$query = get_contact('all', 'WHERE status = 1 ORDER BY date DESC');
											}
											else {
												$query = get_contact('all', 'WHERE status = 0 ORDER BY date DESC');
											}
											
											foreach ( $query as $id => $value ) {	

										?>
                                        <tr>
                                            <td><?php echo $value['name']; ?></td>
                                            <td><?php echo $value['email']; ?></td>
                                            <td>
												<?php
													if ( $value['status'] == 1 ) {
														echo '		<a href="/admin/contact.php?na='.$value['id_contact'].'" class="contact-narchived btn btn-sm btn-dark">'.$translate->__('Move from Archived').'</a>';
													}
													else {
														echo '		<a href="/admin/contact.php?a='.$value['id_contact'].'" class="contact-archived btn btn-sm btn-dark">'.$translate->__('Archived').'</a>';
													}
												?>
												<a href="/admin/contact.php?r=<?php echo $value['id_contact']; ?>" class="read-this btn btn-sm btn-primary"><?php $translate->__print('Wallet Address'); ?></a>
												<a href="/admin/contact.php?d=<?php echo $value['id_contact']; ?>" class="contact-delete btn btn-sm btn-danger"><?php $translate->__print('Delete'); ?></a>
											</td>
                                        </tr>
										<?php
											}
										?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end row -->
						<script type="text/javascript">
							var addressdel;
							
							$(document).ready(function() {
								
								$(".read-this").click(function () {
									window.addressdel = $.trim($(this).attr('href'));
									$.get(addressdel)
									
									.done(function (data) {
										swal(
											'<?php $translate->__print('Wallet Address'); ?>',
											data.message,
										);
									})
									
									return false;
								});
								
								$(".contact-delete").click(function () {	
									window.addressdel = $.trim($(this).attr('href'));
									
									swal({
										title: '<?php $translate->__print('Are you sure?'); ?>',
										text: "<?php $translate->__print("You won't be able to revert this!"); ?>",
										type: 'warning',
										showCancelButton: true,
										confirmButtonText: '<?php $translate->__print('Yes'); ?>',
										cancelButtonText: '<?php $translate->__print('No'); ?>',
										confirmButtonClass: 'btn btn-success',
										cancelButtonClass: 'btn btn-danger m-l-10',
										buttonsStyling: false
									}).then(function () {	

											swal(
												'<?php $translate->__print('Wait a sec...'); ?>',
												'<?php $translate->__print('We are trying to delete it.'); ?>',
												'info',
											);
										
											$.get(addressdel)
											
											.done(function (data) {
												if (data.status == 'success' ) {
													var msTittle = '<?php $translate->__print('Yes!'); ?>';
													var msMessage = '<?php $translate->__print('Great! The request was deleted.'); ?>';
													var msStatus = 'success';
													
													location.reload();
												}
												else {
													var msTittle = '<?php $translate->__print('Error!'); ?>';
													var msMessage = '<?php $translate->__print('An error occurred while deleting the request. Please try again.'); ?>';
													var msStatus = 'error';
												}
												
												swal(
													msTittle,
													msMessage,
													msStatus
												)
											})		
									}, function (dismiss) {
											// dismiss can be 'cancel', 'overlay',
											// 'close', and 'timer'
											if (dismiss === 'cancel') {
												swal(
													'<?php $translate->__print('Cancelled'); ?>',
													'<?php $translate->__print('The request is safe'); ?>',
													'error'
												)
											}
									});
									return false;
								});
								
								$(".contact-archived").click(function () {	
									window.addressdel = $.trim($(this).attr('href'));

											swal(
												'<?php $translate->__print('Wait a sec...'); ?>',
												'<?php $translate->__print('We are trying to archived the request.'); ?>',
												'info',
											);
										
											$.get(addressdel)
											
											.done(function (data) {
												if (data.status == 'success' ) {
													var msTittle = '<?php $translate->__print('Yes!'); ?>';
													var msMessage = '<?php $translate->__print('Great! The request was archived.'); ?>';
													var msStatus = 'success';
													
													location.reload();
												}
												else {
													var msTittle = '<?php $translate->__print('Error!'); ?>';
													var msMessage = '<?php $translate->__print('An error occurred while archiving the request. Please try again.'); ?>';
													var msStatus = 'error';
												}
												
												swal(
													msTittle,
													msMessage,
													msStatus
												)
											})		
									return false;
								});
								
								$(".contact-narchived").click(function () {	
									window.addressdel = $.trim($(this).attr('href'));

											swal(
												'<?php $translate->__print('Wait a sec...'); ?>',
												'<?php $translate->__print('We are trying to un-archived the request.'); ?>',
												'info',
											);
										
											$.get(addressdel)
											
											.done(function (data) {
												if (data.status == 'success' ) {
													var msTittle = '<?php $translate->__print('Yes!'); ?>';
													var msMessage = '<?php $translate->__print('Great!'); ?>';
													var msStatus = 'success';
													
													location.reload();
												}
												else {
													var msTittle = '<?php $translate->__print('Error!'); ?>';
													var msMessage = '<?php $translate->__print('An error occurred. Please try again.'); ?>';
													var msStatus = 'error';
												}
												
												swal(
													msTittle,
													msMessage,
													msStatus
												)
											})		
									return false;
								});
							});
						</script>	
<?php
	f();
?>