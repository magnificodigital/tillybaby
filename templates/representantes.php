<?php 
    /*
        Template Name: Área do Representante
    */

session_start();

$sair = $_GET['sair'];

if(isset($sair) && $sair ==1)
{
    session_destroy();
    $url = get_bloginfo('url')."/area-do-representante/";
    echo '<script>window.location.href="'.$url.'"</script>';
}

if(!isset($_SESSION['logado']))
{
    $_SESSION['logado'] = 0;
}

$user = get_option('usuario_cliente');
$pass = get_option('senha_cliente');

$retorno = "";

if(isset($_POST['user']))
{
    if($user == $_POST['user'] && $pass == $_POST['pass'])
    {
        $_SESSION['logado'] = 1;
    }
    else
    {
        $retorno = "nao";
    }
}

get_header('representante'); 

?>
<?php
    if($_SESSION['logado'] == '1')
    {
        $args_colecoes = array( 
                'post_type' => 'tag-images',
                'posts_per_page' => -1
        );
        $colecoes = new WP_Query( $args_colecoes );

        $options = array();

        if($colecoes->have_posts())
        {
           while ( $colecoes->have_posts() ) : $colecoes->the_post();
                array_push($options, array("id_post"=>$post->ID, "titulo"=>get_the_title()));
           endwhile;
       }
       wp_reset_query();
?>
    <section id="tags" class="section tags">
        <div class="container cont-tags">

            <?php    
            
                $args = array( 
                        'post_type' => 'tag-images',
                        'posts_per_page' => 1
                );
                $loop = new WP_Query( $args );

                if($loop->have_posts())
                {
                   while ( $loop->have_posts() ) : $loop->the_post();
            ?>
                    <div class="loading"><img src="<?php echo get_bloginfo('template_url') ?>/assets/images/loading.gif" /><br/>Carregando imagens</div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 container-tags">
                        <div class="nome-colecao"><?php echo get_the_title() ?></div>
                        <div class="txt-tags">TAGS</div>
                        <div class="row">
                            <div class="select_box pull-right">
                                <select id="colecoes_select" onchange="troca_colecao()">
                                    <option value="">Coleções anteriores</option>
                                    <?php
                                        foreach ($options as $index => $option):
                                    ?>                               
                                            <option value="<?php echo $option['id_post']; ?>"><?php echo $option['titulo']; ?></option>
                                    <?php
                                        endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                         <div class="box-downloads">
                             <div class="image-produto">
                                <?php 
                                    $str_imagens = types_render_field("selecione-uma-ou-mais-imagens", array("raw"=>"true","separator"=>"|"));
                                    $arr_imagens = explode("|", $str_imagens);

                                    $html = '';
                                    $contador = 0;

                                    for($i = 0; $i<count($arr_imagens); $i++)
                                    {
                                        if($contador == 0)
                                        {
                                            $html .= '<div class="row">';
                                        }

                                        $html .= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><img class="size-full aligncenter" src="'.$arr_imagens[$i].'" /></div>';

                                        if($contador == 2)
                                        {
                                            $contador = 0;
                                            $html .= '</div>';
                                        }
                                        else
                                        {
                                            $contador ++;
                                        }
                                    }

                                    echo $html;
                                ?>
                             </div>
                         </div>
                     </div>

        <?php
                    endwhile;
                }

                wp_reset_query();
        ?>

        </div>
    </div>

    <!--<div class="container"><a href="javascript:verMais();" class="bt-ver-mais">Ver Mais...</a></div>-->
</section>

<?php
}
    $file_download = types_render_field("download-catalogo-file", array("output"=>"raw"));

    if(isset($file_download) && !empty($file_download))
    {
        $titulo_download = types_render_field("titulo-catalogo", array("output"=>"raw"));
?>
        <section id="download" class="section download" style="margin-top:30px;">
            <div class="container txt-download">
                <a href="<?php echo $file_download ?>" target="_blank">
                    <p><?php echo $titulo_download; ?></p> <img src="<?php echo get_bloginfo('template_url') ?>/assets/images/icon-download.png" width="60" height="60" />
                </a>
            </div>
        </section>
<?php
    }
?>

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

<script type="text/javascript">

    function validaCampos () {
        var nome  = $('input[name*="user"]').val();
        var pass = $('input[name*="pass"]').val();
        var erro = 0;

        if(nome != "" && email != "")
        {
            $('.form-download').submit();
        }
        else
        {
            $('.msg-error-login').css('display', 'none');
            
            if(nome == "" && erro == 0)
            {
                $('.box-user').append("<div class='erro-campo'><i class='fa fa-times'></i></div>");
                $('input[name*="user"]').css('border', '1px solid #ff0000');
            }

            if(pass == "" && erro == 0)
            {
                $('.box-pass').append("<div class='erro-campo'><i class='fa fa-times'></i></div>");
                $('input[name*="pass"]').css('border', '1px solid #ff0000');
            }

            $('.msg-error').css('display', 'block');

            erro = 1;
        }
        return false;
    }
</script>
 
<?php get_footer('representante'); ?>