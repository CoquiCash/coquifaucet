<?php 
	if ( !defined('THEME_LOAD') ) { die ( header('Location: /404') ); }
	
	get_header($theme_array);
?>
             <!--  Page Content  -->
            <div id="page-content" class="header-fixed">
                <!--  Page header  -->
                <div id="page-header" class="bg" style="background-color: #223539;">
                    <div class="container">
                        <div class="row no-margin">
                            <div class="col-md-12 padding-leftright-null">
                                <div class="text text-center">
                                    <h1 class="margin-bottom-extrasmall white"><?php $translate->__print('La página que buscas no existe.'); ?></h1>
                                    <a href="/" class="btn-alt"><?php $translate->__print('Ve al Inicio'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  END Page header  -->
            </div>
            <!--  END Page Content -->
<?php
	get_footer($theme_array);
?>