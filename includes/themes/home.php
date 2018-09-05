<?php 
	if ( !defined('THEME_LOAD') ) { die ( header('Location: /404') ); }
				
	get_header($theme_array);
?>
            <!--  Page Content  -->
            <div id="page-content" class="header-fixed">
                <!--  HomePage header  -->
                <div id="home-header" class="bg" style="background-color: #223539;">
                    <div class="container">
                        <div class="row no-margin">
                            <div class="col-md-6 padding-leftright-null">
                                <div class="text padding-bottom-null">
                                    <h1 class="margin-bottom-extrasmall white" style="color: #5ab400 !important;"><?php $translate->__print('Obtén Coqui Cash GRATIS!!'); ?></h1>
                                    <h2 class="white weight-300"><?php $translate->__print('Llena el formulario y gana 100 coquis'); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  END HomePage header  -->
                <div id="home-wrap" class="content-section">
                    <!-- Info Section -->
                    <section id="info-form">
                        <div class="container">
                            <div class="row no-margin">
                                <div class="col-md-12 padding-leftright-null padding-onlytop-lg">
                                    <div class="col-md-7 padding-leftright-null">
                                        <div class="text padding-top-null padding-md-bottom-null">
                                            <p class="black">
												<?php $translate->__print('¿QUE ES COQUI CASH?'); ?>
                                            </p>

                                            <p class="black">
												COQUI Cash es una cryptomoneda administrada por la comunidad de desarrolladores que quiere traer la tecnología blockchain a Puerto Rico atraves de una economia descentralizada y de ideas innovadoras, de esta forma se incita a crear una comunidad más granda la cual pueda ayudar con las tareas de desarrollo de codigo abierto en la isla.
											</p>
											
                                            <ul class="styled">
												<li>No tiene FEES y es fácil para los commerciantes el comenzar a aceptar pagos</li>
                                                <li>Ofrece transaciones persona a persona con altos niveles de seguridad</li>
                                                <li>No hay una entidad dueña de Coqui Cash</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-5 padding-leftright-null main-form">
                                        <div class="text padding-md-top-null">
                                            <div class="box-form">
                                                <form id="contact-form" method="post" action="/includes/action/new-request.php">
                                                    <div class="row no-margin">
                                                        <h4><?php $translate->__print('Obtén tus coquis AHORA.'); ?></h4>
                                                        <p><?php $translate->__print('Llena el formulario para recibir tus coquis'); ?></p>
                                                        <div class="col-md-12 padding-leftright-null">
                                                            <label for="name"><?php $translate->__print('Nombre Completo'); ?><sup>*</sup></label>
                                                            <input class="form-field" name="name" id="name" type="text" placeholder="<?php $translate->__print('Tu Nombre'); ?>">
                                                        </div>
                                                        <div class="col-md-12 padding-leftright-null">
                                                            <label for="surname"><?php $translate->__print('Email'); ?><sup>*</sup></label>
                                                            <input class="form-field" name="email" id="email" type="text" placeholder="<?php $translate->__print('Tu Email'); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row no-margin">
                                                        <div class="col-md-12 padding-leftright-null">
                                                            <label for="wallet"><?php $translate->__print('Tu Wallet de Coquis'); ?><sup>*</sup></label>
                                                            <input class="form-field" name="wallet" id="wallet" type="text" placeholder="<?php $translate->__print('La dirección de tu wallet de coquis'); ?>">
															<a style="font-size:12px;" href="https://wallet.coqui.cash" target="_blank"><?php $translate->__print('¿No tienes wallet? Click aquí para crear una'); ?></a>
                                                        </div>
														<input type="text" name="checkplease" style="display:none;"><!--SPM PRT-->
                                                    </div>
													
													<br />
													
													<!-------------------------------------------------------------------->
													
                                                    <div class="row no-margin">
                                                        <div class="col-md-12 padding-leftright-null">
															<!-- CAPTCHA SITE KEY -->
                                                            <div class="g-recaptcha" data-sitekey="6Ldcnm4UAAAAAIwV-rISpsc8Y3_Qmss4R1-udTdn"></div>
                                                        </div>
                                                    </div>
													
													<!-------------------------------------------------------------------->
													
                                                    <div class="row no-margin">
                                                        <div class="col-md-12 padding-leftright-null text-center">
                                                            <div class="submit-area padding-onlytop-sm">
                                                                <input type="submit" id="submit-contact" class="btn-alt active shadow" value="<?php $translate->__print('QUIERO COQUIS'); ?>">
                                                                <div id="msg" class="message" style="padding-top:20px;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- END Info Section -->
					
                    <!-- Simple Share Section -->
                    <section id="share" class="light-background">
                        <div class="container">
                            <div class="row no-margin">
                                <div class="col-lg-12 padding-leftright-null">
                                    <div class="text text-center">
                                        <p class="big"><?php $translate->__print('Invita a tus amigos a reclamar sus coquis'); ?></p>
                                        <ul class="social-share">
                                            <li><a href="https://twitter.com/home?status=<?php echo $translate->__('Mira esto rápido, te va a gustar').' '.get_setting(1).' '.get_actual_url(); ?>"><i class="fa fa-twitter"></i>Tweet</a></li>
                                            <li><a href="https://plus.google.com/share?url=<?php echo get_actual_url(); ?>"><i class="fa fa-google-plus"></i>Share</a></li>
                                            <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_actual_url(); ?>"><i class="fa fa-facebook"></i>Post</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- END Simple Share Section -->
                </div>
            </div>
            <!--  END Page Content -->
<?php
	get_footer($theme_array);
?>