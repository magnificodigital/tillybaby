<?php 
	/*
		Template Name: Home
	*/

$id = get_the_ID();

get_header(); ?>

    <section id="home" class="section home">
        <?php 
            $post_id_5369 = get_post($id );
            $content = $post_id_5369->post_content;

            echo do_shortcode($content);
        ?>
    </section>

    <section id="lookbook" class="section lookbook" style="background-image:url('<?php echo get_bloginfo('template_url') ?>/assets/images/bg_lookbook.jpg');">
        <div class="container">
            <a href="<?php echo get_bloginfo('url')."/lookbook/" ?>" target="_blank">
                <?php 
                    $img_lookbook = types_render_field("imagem-home-lookbook", array("output"=>"raw"));
                ?>
                <img src="<?php echo $img_lookbook; ?>" border="0" />
            </a>
        </div>
    </section>
    
    <?php
        $file_download = types_render_field("download-catalogo-file", array("output"=>"raw"));

        if(isset($file_download) && !empty($file_download))
        {
            $titulo_download = types_render_field("titulo-catalogo", array("output"=>"raw"));
    ?>
            <section id="download" class="section download">
                <div class="container txt-download">
                    <a href="<?php echo $file_download ?>" target="_blank">
                        <p><?php echo $titulo_download; ?></p> <img src="<?php echo get_bloginfo('template_url') ?>/assets/images/icon-download.png" width="60" height="60" />
                    </a>
                </div>
            </section>
    <?php
        }
    ?>

    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: none">
        <g>
            <g id="icon-news">
                <path d="M0,0v20h30V0H0z M15,10.96L5.277,2.857h19.445L15,10.96z M11.868,12.146L15,14.755l3.132-2.609l5.246,4.997H6.622
            L11.868,12.146z M3,16.552V4.755l6.606,5.505L3,16.552z M20.394,10.26L27,4.755v11.797L20.394,10.26z"/>
            </g>
        </g>
    </svg>
      
    <section id="newsletter" class="section newsleter">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="box-txt-news">
                        <svg viewBox="0 0 32 32">
                            <use xlink:href="#icon-news"></use>
                        </svg>
                        <span class="txt-news">Newsletter</span>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <?php echo do_shortcode('[contact-form-7 id="15" title="Newsletter"]'); ?>
                </div>
            </div>
        </div>
    </section>
    
    <?php 
        $bg_tilly = types_render_field("background-tilly-baby", array("output"=>"raw"));
        $bg_fale_conosco = types_render_field("background-fale-conosco", array("output"=>"raw"));
    ?>
    <section id="tilly-baby" class="section tilly" style="background-image:url('<?php echo $bg_tilly; ?>');">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="logo-tilly">
                        <img src="<?php echo get_bloginfo('template_url') ?>/assets/images/logotipo_tillybaby.svg" />
                    </div>
                    <?php
                        $info_lojas = types_render_field("informacoes-loja", array("output"=>"html"));
                        $txt_tilly_baby = types_render_field("texto-tilly-baby", array("output"=>"html"));
                    ?>
                    <div class="txt_loja_tilly">
                        <?php
                            echo $info_lojas;
                        ?>
                    </div>
                    
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 hidden-xs"></div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 txt-tilly">
                    <?php
                        echo $txt_tilly_baby;
                    ?>
                </div>
            </div>
        </div>
    </section>

    <?php get_template_part( 'templates/loop', 'lojas' );  ?>

    <section id="fale-conosco" class="section fale-conosco" style="background-image:url('<?php echo $bg_fale_conosco; ?>');">
        <div class="container">
            <h2>Fale Conosco</h2>
            <h5>ENTRE EM CONTATO PELO FORMULÁRIO ABAIXO</h5>

            <div class="select_box">
                <select id="sl_assunto" name="assunto" onchange="troca_assunto()">
                    <option value="Solicite um Representante">Solicite um Representante</option>
                    <option value="Cliente Final">Cliente Final</option>
                    <option value="Lojista">Lojista</option>
                </select>
            </div>

            <div class="box-form-fale">
                <?php echo do_shortcode('[contact-form-7 id="102" title="Fale conosco"]'); ?>
            </div>
            <div class="box-form-cliente-final" style="display:none">
                <?php echo do_shortcode('[contact-form-7 id="198" title="Cliente Final"]'); ?>
            </div>
        </div>
    </section>
    
    <div class="lightbox_form">
        <div class="close_lightbox">fechar X</div>
        <div class="logo-lightbox-cadastro"><img src="<?php echo get_bloginfo('template_url') ?>/assets/images/logotipo_tillybaby.svg"></div>
        <div class="txt-cadastrese">CADASTRE-SE E RECEBA ANTECIPADAMENTE AS NOVIDADES E LANÇAMENTOS</div>
        <?php echo do_shortcode('[contact-form-7 id="120" title="Cadastro"]'); ?>
    </div>
    <div class="mascara"></div>

    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory') ?>/assets/js/jquery.mask.js"></script>

    <script type="text/javascript">
        var lightbox = "<?php echo get_option('habilitar_lightbox'); ?>";

        jQuery( document ).ready(function() {

            jQuery('input[name*="data_nascimento"]').mask("99/99/9999",{placeholder:" "});
            jQuery('input[name*="telefone"]').mask("(99) 9999-9999?9");
            jQuery('input[name*="telefone"]').focusout(function(){
                var phone, element;
                element = jQuery(this);
                element.unmask();
                phone = element.val().replace(/\D/g, '');
                if(phone.length > 10) {
                    element.mask("(99) 99999-999?9");
                } else {
                    element.mask("(99) 9999-9999?9");
                }
            }).trigger('focusout');

        });

        if(lightbox != "")
        {
            $( ".lightbox_form" ).show();
            $( ".mascara" ).show();
        }

        $( ".mascara" ).click(function(){
            fecharLightbox();
        });

        $(".close_lightbox").click(function(){
            fecharLightbox();
        });

        function fecharLightbox()
        {
            $( ".lightbox_form" ).animate({
                opacity: 0,
            }, 600, function() {
               $( ".lightbox_form" ).hide();
            });

            $( ".mascara" ).animate({
                opacity: 0,
            }, 1000, function() {
               $( ".mascara" ).hide();
            });
        }

        function troca_assunto()
        {
            var assunto = $('#sl_assunto').val();

            if(assunto == "Cliente Final")
            {
                $('.box-form-fale').css('display', 'none');
                $('.box-form-cliente-final').css('display', 'block');
            }
            else
            {
                $('.box-form-fale').css('display', 'block');
                $('.box-form-cliente-final').css('display', 'none');
            }
        }
    </script>
 
<?php get_footer(); ?>