<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <title><?php
        if ( is_single() ) { single_post_title(); }
        elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); get_page_number(); }
        elseif ( is_page() ) { single_post_title(''); }
        elseif ( is_search() ) { bloginfo('name'); print ' | Search results for ' . wp_specialchars($s); get_page_number(); }
        elseif ( is_404() ) { bloginfo('name'); print ' | Not Found'; }
        else { bloginfo('name'); wp_title('|'); get_page_number(); }
    ?></title>
 
    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url')."/assets/css/bootstrap.min.css"; ?>">

    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url')."/assets/css/media-queries.css"; ?>" />

    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url')."/assets/css/admin.css"; ?>" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 
    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

    <?php wp_head(); ?>
 
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <script src="<?php echo get_bloginfo('template_url') ?>/assets/js/jquery.min.js"></script>
</head>
<body>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NM8JMW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NM8JMW');</script>
<!-- End Google Tag Manager -->
    <div class="main-admin">
        <header>
            <div id="header-admin">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="logo-admin">
                                <a href="<?php echo get_bloginfo('url'); ?>">
                                    <img src="<?php echo get_bloginfo('template_url') ?>/assets/images/LogoTillyClassico.png" width="269" height="78" border="0" />
                                </a>
                            </div>
                        </div>
                    </div>
                            
                    <?php
                        if($_SESSION['logado'] == '0'):
                    ?>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-login-representantes">
                               <form action="#" method="post" class="form-download" onsubmit="return validaCampos()">
                                    <div class="box_campos box-user">
                                        <input type="text" name="user" placeholder="Login:" class="input-busca" />
                                    </div>
                                    <div class="box_campos box-pass">
                                        <input type="password" name="pass" placeholder="Senha:" class="input-busca" />
                                    </div>
                                    <div class="box-bt-logar">
                                        <input type="submit" value="Entrar" class="bt-logar" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                       else:
                    ?>
                        <div class="bt-sair-respresentante"><a href="<?php echo get_bloginfo('url')."/area-do-representante/?sair=1"; ?>">Sair <span class="icon-lock"></span></a></div>
                    <?php
                       endif;
                    ?>
                </div>
            </div><!-- #header -->
        </header>