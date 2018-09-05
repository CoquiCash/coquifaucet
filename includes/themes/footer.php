<?php 
	if ( !defined('THEME_LOAD') ) { die ( header('Location: /404') ); }
?>

        </div>
        <!--  Main Wrap  -->
		
        <!--  Footer  -->
        <footer>
            <div class="container">
                <div class="row no-margin">
                    <div class="col-md-12 text text-center padding-bottom-null">
                        <div class="row no-margin">
                            <ul class="social">
                                <?php if(!empty(get_setting(5))) { ?><li><a href="<?php get_setting_print(5); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li><?php } ?>
                                <?php if(!empty(get_setting(9))) { ?><li><a href="<?php get_setting_print(9); ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li><?php } ?>
                                <?php if(!empty(get_setting(8))) { ?><li><a href="<?php get_setting_print(8); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li><?php } ?>
                                <?php if(!empty(get_setting(6))) { ?><li><a href="<?php get_setting_print(6); ?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li><?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12 text text-center">
                        <p>© Copyright 2018 coquicash. <?php $translate->__print('Todos los derechos reservados.'); ?></p>
                        <p class="margin-null"><?php $translate->__print('Desarrollado por'); ?> <a href="https://vosfirm.com" target="_blank" class="white">VOSFirm</a>.</p>
                    </div>
                </div>
            </div>
        </footer>
        <!--  END Footer. Class fixed for fixed footer  -->
   
		<!-- Scripts
		================================================== -->

		<script src="/content/theme/js/jquery.min.js"></script>
		
		<!-- Google Analitics -->
		<?php get_setting_print(48); ?>

		<?php get_action('js'); ?>
		
		<!-- Captcha -->
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		
		<!-- More -->
		<script src="/content/theme/js/bootstrap/bootstrap.min.js"></script>
        <script src="/content/theme/js/owl.carousel.min.js"></script>
        <script src="/content/theme/js/jquery.magnific-popup.min.js"></script>
        <script src="/content/theme/js/jquery.scrollTo.min.js"></script>
        <script src="/content/theme/js/smooth.scroll.min.js"></script>
        <script src="/content/theme/js/jquery.appear.js"></script>
        <script src="/content/theme/js/jquery.countTo.js"></script>
        <script src="/content/theme/js/jquery.scrolly.js"></script>
        <script src="/content/theme/js/plugins-scroll.js"></script>
        <script src="/content/theme/js/pace.min.js"></script>
        <script src="/content/theme/js/main.js"></script>
    </body>
</html>