<?php 
    $args = array( 'post_type' => 'loja', 'posts_per_page'=>-1);
    $loop = new WP_Query( $args );

    $arr_estado = array();
    $arr_lojas = array();

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
        $latitude = types_render_field("latitude", array("output"=>"raw"));
        $longitude = types_render_field("longitude", array("output"=>"raw"));

        //array_push($arr_cidade_estado, array('cidade'=>$cidade, 'estado'=>$estado));
        array_push($arr_estado, $estado);

        array_push($arr_lojas, array('nome'=>$nome,'telefone'=>$telefone,'email'=>$email,'site'=>$site,'cidade'=>$cidade, 'estado'=>$estado, 'endereco'=>$endereco, 'bairro'=>$bairro, 'cep'=>$cep, 'latitude'=>$latitude, 'longitude'=>$longitude));

    endwhile;

    $arr_estado = array_unique($arr_estado);
    sort($arr_estado);
?>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZ3tbtpntErvlAvcIwtM4yS9dzMi5RpGc"></script>
<script type="text/javascript">
    var map;

    var jArray= <?php echo json_encode($arr_lojas); ?>;
    var allMyMarkers = [];
    var infowindow = new google.maps.InfoWindow;

    console.log(jArray);

    function initialize() {
        var myLatlng = new google.maps.LatLng(-23.54,-46.63);
        var mapOptions = {
          center: myLatlng,
          scrollwheel: false,
          zoom: 12
        };
        map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);

        for (var i = 0; i < jArray.length; i++) {
             
            var nomePostado = "Anônimo";
            
            if(jArray[i].nome_user != null)
            {
               nomePostado = jArray[i].nome_user;
            }
            
            createMarker(new google.maps.LatLng(jArray[i].latitude, jArray[i].longitude), jArray[i].nome, jArray[i].endereco, jArray[i].bairro, jArray[i].cep);
        }
    }

    function createMarker(latlng, nome, endereco, bairro, cep) 
    {
        var image = "<?php echo get_bloginfo('template_url') ?>" + "/assets//images/pin.png"; 

        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: image
        });
        
        var popupContent = '<div id="locationContent" style="font-family:Arial; font-size:11px;">' +
                              '<div><b>Nome:</b> '+nome+' </div>' +
                              '<div><b>Endereço:</b> '+endereco+' </div>' +
                              '<div><b>Bairro:</b> '+bairro+' </div>' +
                              '<div><b>CEP:</b> '+cep+' </div>';
        
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(popupContent);
            infowindow.open(map, this);
            map.setCenter(latlng);
        });
        
        allMyMarkers.push(marker); //push local var marker into global array
    }
    
    google.maps.event.addDomListener(window, "load", initialize);
</script>
  
<section id="onde-encontrar" class="section onde-encontrar">
    <div class="container">
        <h2>Onde Encontrar</h2>
        <h5>as lojas mais próximas de você!</h5>
        
        <div class="select_box">
            <select id="estado" onchange="carrega_cidades()">
                <option value="">Selecione o estado</option>
                <?php
                    foreach ($arr_estado as $local) 
                    {
                        echo '<option value="'.$local.'">'.$local.'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="select_box cidade_select" style="margin-top: 10px;">
            <select id="cidade" onchange="carrega_lojas()">
                <option value="">Selecione a cidade</option>
            </select>
        </div>
    </div>
    <div class="cont-mapa-lojas">
        <div class="box-mapa"><div id="map-canvas" style="height: 100%; margin: 0; padding: 0;"></div></div>
        <div class="gradiente-branco"></div>
    </div>

    <div id="lojas-encontradas" class="boxes-lojas">
        <div class="container">
            <div class="mostra-lojas">
                <div class="loading" style="display: none"><img src="<?php echo get_bloginfo('template_url')."/assets/images/loading.gif" ?>" /></div>
                <div class="container-lojas">
                	<?php 
                        $contador = 0;
                        $abriu_row = false;
                        foreach ($arr_lojas as $loja): 

                            //echo $loja['cidade']." | ".$loja['estado']."<br/>";
                            if($loja['cidade'] == "SAO PAULO" && $loja['estado']=="SP")
                            {
                                if($contador == 0)
                                {
                                    echo '<div class="row">';
                                    $abriu_row = true;
                                }
                    ?>
                    
                     		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="box-info-loja">
                                    <div class="tit-nome-loja">
                                        <?php echo $loja['nome']; ?><br/>
                                        <?php echo $loja['cidade']; ?> / <?php echo $loja['estado']; ?>
                                    </div>
                                    <div class="info-loja">
                                        <?php
                                            $telefone = $loja['telefone'];
                                            if($telefone != "")
                                            {
                                            	echo $telefone; 
                                            }
                                        ?>

                                        <?php
                                            $email = $loja['email'];
                                            if($email  != "")
                                            {
	                                          echo $email;
                                            }
                                        ?>

                                        <?php
                                            $site = $loja['site'];
                                            if($site != "")
                                            {
		                                        echo $site;
                                            }
                                        ?>
                                        <?php
                                            $endereco = $loja['endereco'];
                                            if($endereco != "")
                                            {
                                            	echo $endereco."<br/>";
                                            }
                                        ?>
                                        <?php
                                            $bairro = $loja['bairro'];
                                            if($bairro != "")
                                            {
	                                            echo $bairro."<br/>";
	                                        }
                                        ?>
                                        <?php
                                            $cep = $loja['cep'];
                                            if($cep != "")
                                            {
	                                            echo $cep;
	                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                    
                    <?php
                                $contador ++;
                                if($contador == 3)
                                {
                                    echo "</div>";
                                    $contador = 0; 
                                    $abriu_row = false;
                                }
                            }
                        endforeach;
                        if($abriu_row)
                        {
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>
            <a href="javascript:verMais();" class="bt-ver-mais">Ver Mais...</a>
        </div>
    </div>
</section>

<script type="text/javascript">
    var altura = 311;
    var margin_bottom = 40;

  function verMais()
  {
    var altura_anima = altura + margin_bottom;

    $('.mostra-lojas').animate({
        height: "+="+altura_anima
      }, 1000, function() {
        verificaVerMais();
    });
  }

  function verificaVerMais()
  {
    var altura_total = $('.container-lojas').height() - 40;
    var altura_atual = $('.mostra-lojas').height();

    if(altura_atual >= altura_total)
    {
        $('.bt-ver-mais').hide();
    }
    else
    {
        $('.bt-ver-mais').show();
    }
  }

  $(document).ready(function(){
    verificaVerMais();
  });

  function carrega_lojas()
  {
    var estado = $('#estado').val();
    var cidade = $('#cidade').val();

    $('.loading').show();
    $('.container-lojas').hide();
    $('.container-lojas').html('');

    if(cidade != "")
    {
        var url = "<?php echo get_bloginfo('template_url') ?>" + "/assets/inc/filtra_lojas.php";
        var url2 = "<?php echo get_bloginfo('template_url') ?>" + "/assets/inc/cidades_geo.php";

        $.ajax({
            type       : "POST",
            data       : { cidade : cidade, estado: estado },
            dataType   : "html",
            url        : url2,
            success    : function(data){
                if(data != "")
                {
                    var obj = JSON.parse(data);
                    var pos = new google.maps.LatLng(obj[0].latitude, obj[0].longitude);

                    map.setCenter(pos);
                    map.setZoom(12);
                }
            },
            error     : function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        }); 

        $.ajax({
            type       : "POST",
            data       : { cidade : cidade, estado: estado },
            dataType   : "html",
            url        : url,
            success    : function(data){
                if(data != "")
                {
                    $('.container-lojas').html(data);
                    $('.container-lojas').fadeIn(500, function(){ $('.loading').hide(); });

                    $('.mostra-lojas').height(altura);
                    $('.loading').hide();

                    verificaVerMais();
                }
            },
            error     : function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    }      
  }

  function carrega_cidades()
  {
    var url = "<?php echo get_bloginfo('template_url') ?>" + "/assets/inc/carrega_cidades.php";
    var estado = $('#estado').val();

    if(estado != "")
    {
        $('#cidade').html('<option value="">Carregando cidades</option>');

        $.ajax({
            type       : "POST",
            data       : { estado: estado },
            dataType   : "html",
            url        : url,
            success    : function(data){
                if(data != "")
                {
                    $('#cidade').html(data);
                    $('.cidade_select').show();
                }
            },
            error     : function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    }

  }
</script>