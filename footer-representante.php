<footer>
    <div class="container">
        <div class="footer">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="logo_footer"><img src="<?php echo get_bloginfo('template_url') ?>/assets/images/LogoTillyClassico.png" /></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="copyright">Malharia Susi - Desde 1970</div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="redes-sociais" style="top:0; right:inherit; left:0">
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
<script type="text/javascript">
    var url = "<?php echo get_bloginfo('template_url') ?>" + "/assets/inc/troca_colecao.php"
    var altura;
    var margin_bottom = 30;

    $( document ).ready(function() {
        $('.loading').hide();
        $('.container-tags').show();
    });

    function troca_colecao(){
        var id = $('#colecoes_select').val();
        var option_colecoes = $('#colecoes_select').html();

        $('.loading').show();
        $('.container-tags').hide();

        $.ajax({
            type       : "POST",
            data       : { id : id },
            dataType   : "html",
            url        : url,
            success    : function(data){
                if(data != "")
                {
                    $('.cont-tags').html(data);
                    $('#colecoes_select').html(option_colecoes);
                    $('.loading').hide();
                    $('.container-tags').show();
                }
            },
            error     : function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    }

    function verMais()
    {
        altura = $('.image-produto > .row > div > img').height();

        var altura_anima = altura + margin_bottom;

        $('.cont-tags').animate({
            height: "+="+altura_anima
        }, 1000, function() {
            verificaVerMais();
        });
    }

    function verificaVerMais()
    {
        var altura_total = $('.box-downloads').height();
        var altura_atual = $('.cont-tags').height();

        if(altura_atual >= altura_total)
        {
            $('.bt-ver-mais').hide();
        }
        else
        {
            $('.bt-ver-mais').show();
        }
    }
</script>
</body>
</html>