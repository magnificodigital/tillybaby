<footer>
    <div class="container">
        <div class="footer">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="logo_footer"><img src="<?php echo get_bloginfo('template_url') ?>/assets/images/logotipo_tillybaby.svg" width="269" height="78" /></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="copyright">Malharia Susi - Desde 1970</div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="bt-area-respresentante" style="top:0"><a href="<?php echo get_bloginfo('url')."/area-do-representante/"; ?>">Área do Representante <span class="icon-lock"></span></a></div>
                    <div class="redes-sociais" style="top:0">
                        <ul>
                            <?php
                                $url_face = get_option('facebook_icon');
                                $url_insta = get_option('instagram_icon');
                            ?>
                            <li><a href="<?php echo $url_face; ?>" class="bt-face animate-background" target="_blank"></a></li>
                            <li><a href="<?php echo $url_insta; ?>" class="bt-insta animate-background" target="_blank"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>

<script src="<?php echo get_bloginfo('template_url') ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo get_bloginfo('template_url') ?>/assets/js/main.js"></script>
<script src="<?php echo get_bloginfo('template_url') ?>/assets/js/vendor/jquery-scrollspy.js"></script>
<script src="<?php echo get_bloginfo('template_url') ?>/assets/js/menu.js"></script>
</body>
</html>