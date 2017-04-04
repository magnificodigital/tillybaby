<?php

require_once('../../../../../wp-load.php');

$cidade_veio = $_POST['cidade'];
$estado_veio = $_POST['estado'];

$args = array( 'post_type' => 'loja', 'orderby'=>'title', 'order'=>'ASC', 'posts_per_page'=>-1 );
$loop = new WP_Query( $args );

$arr_cidade_estado = array();
$arr_lojas = array();

$contador = 0;
$abriu_row = false;
$html = '';

while ( $loop->have_posts() ) : $loop->the_post();

    $cidade = types_render_field("cidade-loja", array("output"=>"raw"));
    $estado = types_render_field("estado-loja", array("output"=>"raw"));
    $nome = types_render_field("nome-da-loja", array("output"=>"raw"));
    $telefone = types_render_field("telefone", array("output"=>"html"));
    $email = types_render_field("email-da-loja", array("output"=>"raw"));
    $site = types_render_field("site-da-loja", array("output"=>"raw"));
    $endereco = types_render_field("endereco", array("output"=>"raw"));
    $bairro = types_render_field("bairro", array("output"=>"raw"));
    $cep = types_render_field("cep-loja", array("output"=>"raw"));

    if($cidade == $cidade_veio && $estado == $estado_veio)
    {
        if($contador == 0)
        {
            $html .= '<div class="row">';
            $abriu_row = true;
        }

        $html .=  '
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="box-info-loja">
                    <div class="tit-nome-loja">
                       '.$nome.'<br/>
                        '.$cidade.' / '.$estado.'
                    </div>
                    <div class="info-loja">
                        '.$endereco.'<br/>
                        '.$bairro.'<br/>
                        '.$cep.'
                    </div>
                </div>
            </div>
        ';

        $contador ++;

        if($contador == 3)
        {
            $html .= "</div>";
            $contador = 0; 
            $abriu_row = false;
        }
    }

endwhile;

if($abriu_row)
{
    $html .= "</div>";
}

echo $html;

?>