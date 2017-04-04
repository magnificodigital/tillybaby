<?php

require_once('../../../../../wp-load.php');

$cidade_veio = $_POST['cidade'];
$estado_veio = $_POST['estado'];

$cidades_geo_arr = array();
$querystr = "SELECT * FROM cidades_geo WHERE cidade like '%".$cidade_veio."%' AND estado='".$estado_veio."'";
$results = $wpdb->get_results($querystr, OBJECT);

foreach ($results as $geo) { 
     array_push($cidades_geo_arr, array('latitude'=>$geo->lat_cidade,'longitude'=>$geo->long_cidade,'cidade'=>$geo->cidade,'estado'=>$geo->estado));
} 

$cidades_geo_arr = json_encode($cidades_geo_arr);

echo $cidades_geo_arr;

?>