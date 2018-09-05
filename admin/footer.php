<?php 
	function f () {
		global $translate;
?>
                    </div> <!-- container -->
					
                    <div class="footer">
                        <div>
                            <a href="<?php get_setting_print(10); ?>"><strong>VOS LABS</strong></a> | <?php $translate->__print('All rights reserved'); ?> | © <?php get_copyright_date(); ?>
                        </div>
                    </div>

                </div> <!-- content -->

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
			
        </div>
        <!-- END wrapper -->

        <!-- jQuery  -->
        <script src="/content/admin/js/popper.min.js"></script>
        <script src="/content/admin/js/bootstrap.min.js"></script>
        <script src="/content/admin/js/metisMenu.min.js"></script>
        <script src="/content/admin/js/waves.js"></script>
        <script src="/content/admin/js/jquery.slimscroll.js"></script>
        <script src="/content/admin/js/modernizr.min.js"></script>

        <script src="/content/admin/js/bootstrap-filestyle.min"></script>		
        <script src="/content/admin/plugins/switchery/switchery.min.js"></script>
        <script src="/content/admin/plugins/summernote/summernote-bs4.min.js"></script>
		<script src="/content/admin/plugins/sweet-alert2/sweetalert2.min.js"></script>
		<script src="/content/admin/js/jquery.form.min.js"></script>
		<script src="/content/admin/plugins/select2/js/select2.min.js" type="text/javascript"></script>
		<script src="/content/admin/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>

        <!-- App js -->
        <script src="/content/admin/js/jquery.core.js"></script>
        <script src="/content/admin/js/jquery.app.js"></script>

		
		<!-- Tables -->
        <script src="/content/admin/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/content/admin/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="/content/admin/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="/content/admin/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="/content/admin/plugins/datatables/vfs_fonts.js"></script>
        <script src="/content/admin/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="/content/admin/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="/content/admin/plugins/datatables/responsive.bootstrap4.min.js"></script>
        <script src="/content/admin/plugins/datatables/dataTables.select.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function() {
                // Responsive Datatable
                $('#responsive-datatable').DataTable( {
					<?php
						if ( USE_MULTI_LANG ) {
					?>
					"language": {
						"url": "/assets/admin/js/dataTables.<?php echo $translate->lng; ?>.lang"
					}
					<?php
						}
					?>
				});

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
						
				$("textarea[maxlength]").on("propertychange input", function() {
					if (this.value.length > this.maxlength) {
						this.value = this.value.substring(0, this.maxlength);
					}  
				});
			});
		</script>
		
    </body>
</html>
<?php 
	}
?>