<?php

require_once('../../../../../wp-load.php');

$estado_veio = $_POST['estado'];

$args = array( 'post_type' => 'loja', 'posts_per_page'=>-1 );
$loop = new WP_Query( $args );

$arr_cidades = array();

$html = '<option value="">Selecione a cidade</option>';

while ( $loop->have_posts() ) : $loop->the_post();

    $cidade = types_render_field("cidade-loja", array("output"=>"raw"));
    $estado = types_render_field("estado-loja", array("output"=>"raw"));

    if($estado == $estado_veio)
    {
    	array_push($arr_cidades, $cidade);
    }

endwhile;

$arr_cidades = array_unique($arr_cidades);
sort($arr_cidades);

foreach ($arr_cidades as $city) 
{
	$html .= '<option value="'.$city.'">'.$city.'</option>';
}

echo $html;

?>