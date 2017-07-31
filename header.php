<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <title><?php wp_title(); ?></title>
 
    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url')."/assets/css/bootstrap.min.css"; ?>">

    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>?v=01" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url')."/assets/css/media-queries.css"; ?>" />

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

    <?php
        $color = get_option('color_default');

        if(isset($color) && $color != "")
        {
    ?>
        <style type="text/css">
            
            .select_box, .bt-ver-mais, .download, .form-newsletter .bt-enviar{
                background-color: <?php echo $color ?>;
            }

            svg{
                fill: <?php echo $color ?>;
            }

            h2, h5, .tit-nome-loja, .info-loja, .form-fale-conosco .bt-enviar, .txt-news, .txt_loja_tilly, .txt-tilly h3, .txt-tilly{
                color: <?php echo $color ?>;
            }

            .box-info-loja{
                border: 1px solid <?php echo $color ?>;
            }

        </style>
    <?php
        }
    ?>
    
    <script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-25345713-1']);
		_gaq.push(['_gat._forceSSL']);
		_gaq.push(['_trackPageview']);
	
		(function () {
			var ga = document.createElement('script');
			ga.type = 'text/javascript';
			ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 
	
	'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
		})();

	</script>


</head>
<body>
    <header>
        <div id="header">
            <div class="container">
                <div class="header">
                    <nav class="navbar navbar-default" id="myScrollspy">
                        <div class="container-fluid">
                            <div class="navbar-header">
                              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                              </button>
                              <a class="navbar-brand" href=""><img src="<?php echo get_bloginfo('template_url') ?>/assets/images/logotipo_tillybaby.svg" width="269" height="78" /></a>
                            </div>
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav openBold">
                                    <?php
                                        $menu_name = 'header-menu';

                                        $locations = get_nav_menu_locations();

                                        $menu = wp_get_nav_menu_object( $locations[ $menu_name  ] );

                                        $menu_items = wp_get_nav_menu_items($menu);

                                        //print_r($menu_items);

                                        for($i=0; $i<count($menu_items); $i++)
                                        {
                                            echo '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6"><a href="'.$menu_items[$i]->url.'">'.$menu_items[$i]->title.'</a></li>';
                                            echo '<li class="bullets"></li>';
                                        }
									
										/*$menuParameters = array(
										  'theme_location'  => 'header-menu',
										  'container'       => false,
										  'echo'            => false,
										  'items_wrap'      => '%3$s',
										  'depth'           => 0,
										);

                                        $teste = wp_nav_menu( $menuParameters );

                                            
								        
								        echo strip_tags(wp_nav_menu( $menuParameters ), '<li><a>' );*/
							        ?>
                                    
                                    <span id="selected-focus"></span>
                                </ul>
                                
                                <div class="bt-area-respresentante"><a href="<?php echo get_bloginfo('url')."/area-do-representante/"; ?>">Área do Representante <span class="icon-lock"></span></a></div>
                                
                                <div class="redes-sociais">
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
                        </div><!-- /.container-fluid -->
                    </nav>
                </div>
            </div>
        </div><!-- #header -->
    </header>