<?php
require_once('../../../../../wp-load.php');

$id = $_POST['id'];

$post_7 = get_post( $id ); 
$title = $post_7->post_title;

$html = '
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="nome-colecao">'.$post_7->post_title.'</div>
        <div class="txt-tags">TAGS</div>
        <div class="row">
            <div class="select_box pull-right">
                <select id="colecoes_select" onchange="troca_colecao()">
                </select>
            </div>
        </div>
         <div class="box-downloads">
             <div class="image-produto">';
                '.do_shortcode($post_7->post_content).';
            
$str_imagens = types_render_field("selecione-uma-ou-mais-imagens", array('post_id' => $post_7->ID,"raw"=>"true","separator"=>"|"));
$arr_imagens = explode("|", $str_imagens);

$contador = 0;

if(count($arr_imagens) > 1)
{
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

	$html .= ' </div>
	         </div>
	     </div>
	';
}
else
{
	$html .= "Nenhuma tag encontrada.";
}

echo $html;
?>