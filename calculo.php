
 <script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<link rel="stylesheet" type="text/css" href="./print.css">	

<?php

$numgraf=0;
$queryop="";
$graphs=array(50);
$graphssem0=array(50);
$graphssem1=array(50);
$graphssem2=array(50);
$graphssem3=array(50);
$tit=array(50);
$niv1=array(50);
$niv2=array(50);
$niv3=array(50);
$dhasta=array(50);
$hhasta=array(50);
$obj=array(50);
$phechas=array(50);
$piezashechas = 0.00;
$divide = 5;
$div=array(50);

//$numeroSemana = date("W"); 
$numeroSemana = 23; 
$numeroSemana1 = $numeroSemana - 1; 
$numeroSemana2 = $numeroSemana1 - 1; 
$numeroSemana3 = $numeroSemana2 - 1; 

//echo "-NUMROWS--". $result->num_rows . "----";

	while($row =  $result->fetch_assoc())
	{ 
			$idcontador = $row['id'];
			//echo "-idcontador--". $idcontador . "----";
		  $sql2 = "SELECT zona, descripcion, diahasta, objetivo, programa, op, op2, horahasta, material FROM contadores WHERE id =" . $idcontador;
			//echo "---". $sql2 . "---<br>";
			$result2 = mysqli_query($conn, $sql2);
			while($row2 =  $result2->fetch_assoc())
			{ 
				$zona = $row2['zona'];
				$descripcion = $row2['descripcion'];
				$diahasta = $row2['diahasta'];
				$objetivo = $row2['objetivo'];
				$programa = $row2['programa'];
				$op = $row2['op'];
				$op2 = $row2['op2'];
				$horahasta = $row2['horahasta'];
				$material = $row2['material'];
				
				if ((strpos($zona, '5TURNO') !== false)){
				    $divide = 7;
				} else {
					$divide = 5;
				}
				array_push($div, $divide);
				array_push($obj, $objetivo);
				
				$queryop =  $op;
				if ($op <> 0)
				{
					if ($op2 <> 0) 	$queryop =  $queryop . " or op = " . $op2;
					
					$numgraf = $numgraf + 1;
					$objetivo2 = $objetivo + 2;
					//echo "numgraf: " . $numgraf;
					$nivel1 = round($objetivo2 / 3);
					$nivel2 = $nivel1 + $nivel1;
					$nivel3 = $nivel2 + $nivel1;
					
					array_push($niv1, $nivel1);
					array_push($niv2, $nivel2);
					array_push($niv3, $nivel3);
					array_push($dhasta, $diahasta);
					array_push($hhasta, $horahasta);
					
					$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes", "Sabado");
					setlocale(LC_TIME,"es_ES");
					$hoy = getdate();
									
					//print_r($hoy);
					$idiahoy = date("w");
					
					$idiahasta = array_search($diahasta, $dias); 

					$sql3 = "select diasresta, diaslleva, diasllevalab from calculo where fechahoy like '%" . $dias[date("w")] . "%' and fechahasta like '%" . $diahasta . "%'";
					$hora1 = strtok($horahasta, ":");
					$hora2 = $hoy[hours];
					$result3 = mysqli_query($conn, $sql3);
					while($row3 =  $result3->fetch_assoc())
					{ 
							$diasresta = $row3['diasresta'];
							$diasresta = $diasresta - 1; //19.06.2018
							
							$diaslleva = $row3['diaslleva'];
							$diasllevalab = $row3['diasllevalab'];
							if ($divide <= 6 )  {
									$diaslleva = $diasllevalab;
							}

							
							if (($dias[date("w")] == $diahasta)  and ((int)$hora1 < (int)$hora2))
							{ 
								$diasresta = 0;
								$diaslleva = 0;
								 $sql4 = "SELECT count(*) as numreg  FROM ircio WHERE  CONCAT(STR_TO_DATE(fechafin, '%d.%m.%Y'), ' ', horafin) BETWEEN CONCAT(DATE_FORMAT('2019-05-24' - interval  ". $diasresta ." day,'%Y-%m-%d'), ' ', '" . $horahasta . "') AND DATE_FORMAT('2019-05-24','%Y-%m-%d H%:i%') AND (op = " . $queryop . ") AND material like '%" . $material . "%'";
								
								// Se ha resetado el contador actual y hay que mostrar 4 semanas
								$sql4sem0 = "SELECT count(*) as numreg  FROM ircio WHERE  CONCAT(STR_TO_DATE(fechafin, '%d.%m.%Y'), ' ', horafin) BETWEEN CONCAT(DATE_FORMAT('2019-05-24' - interval 7 day,'%Y-%m-%d'), ' ', '" . $horahasta . "') AND CONCAT(DATE_FORMAT('2019-05-24' - interval 0 DAY,'%Y-%m-%d'), ' ', '" . $horahasta . "') AND (op = " . $queryop . ") AND material like '%" . $material . "%'";
								$diasresta = $diasresta + 7;
								$diasrestasem0 = $diasresta;
							
							} else {
									  $sql4 = "SELECT count(*) as numreg  FROM ircio WHERE  CONCAT(STR_TO_DATE(fechafin, '%d.%m.%Y'), ' ', horafin) BETWEEN CONCAT(DATE_FORMAT('2019-05-24' - interval  ". $diasresta ." day,'%Y-%m-%d'), ' ', '" . $horahasta . "') AND DATE_FORMAT('2019-05-24','%Y-%m-%d H%:i%') AND (op = " . $queryop . ") AND material like '%" . $material . "%'";
										if ($idiahasta < $idiahoy)
										{
												// Se ha resetado el contador actual y hay que mostrar 4 semanas
												$diasrestasem0 = $diasresta + 7;
												$sql4sem0 = "SELECT count(*) as numreg  FROM ircio WHERE  CONCAT(STR_TO_DATE(fechafin, '%d.%m.%Y'), ' ', horafin) BETWEEN CONCAT(DATE_FORMAT('2019-05-24' - interval  ". $diasrestasem0 ." day,'%Y-%m-%d'), ' ', '" . $horahasta . "') AND CONCAT(DATE_FORMAT('2019-05-24' - interval ". $diasresta ." DAY,'%Y-%m-%d'), ' ', '" . $horahasta . "') AND (op = " . $queryop . ") AND material like '%" . $material . "%'";
									  } else {
									   		$sql4sem0 = "";
									   		$diasrestasem0 = $diasresta;
									 }
							}
							
							$diasrestasem1 = $diasrestasem0 + 7;
							$diasrestasem2 = $diasrestasem1 + 7;
							$diasrestasem3 = $diasrestasem2 + 7;
							
													
							
							$sql4sem1 = "SELECT count(*) as numreg  FROM ircio WHERE  CONCAT(STR_TO_DATE(fechafin, '%d.%m.%Y'), ' ', horafin) BETWEEN CONCAT(DATE_FORMAT('2019-05-24' - interval  ". $diasrestasem1 ." day,'%Y-%m-%d'), ' ', '" . $horahasta . "') AND CONCAT(DATE_FORMAT('2019-05-24' - interval ". $diasrestasem0 . " DAY,'%Y-%m-%d'), ' ', '" . $horahasta . "') AND (op = " . $queryop . ") AND material like '%" . $material . "%'";
							$sql4sem2 = "SELECT count(*) as numreg  FROM ircio WHERE  CONCAT(STR_TO_DATE(fechafin, '%d.%m.%Y'), ' ', horafin) BETWEEN CONCAT(DATE_FORMAT('2019-05-24' - interval  ". $diasrestasem2 ." day,'%Y-%m-%d'), ' ', '" . $horahasta . "') AND CONCAT(DATE_FORMAT('2019-05-24' - interval ". $diasrestasem1 . " DAY,'%Y-%m-%d'), ' ', '" . $horahasta . "') AND (op = " . $queryop . ") AND material like '%" . $material . "%'";
							$sql4sem3 = "SELECT count(*) as numreg  FROM ircio WHERE  CONCAT(STR_TO_DATE(fechafin, '%d.%m.%Y'), ' ', horafin) BETWEEN CONCAT(DATE_FORMAT('2019-05-24' - interval  ". $diasrestasem3 ." day,'%Y-%m-%d'), ' ', '" . $horahasta . "') AND CONCAT(DATE_FORMAT('2019-05-24' - interval ". $diasrestasem2 . " DAY,'%Y-%m-%d'), ' ', '" . $horahasta . "') AND (op = " . $queryop . ") AND material like '%" . $material . "%'";
							
							if (!empty($sql4sem0)) {
								$result0 = mysqli_query($conn, $sql4sem0);
								$row0 =  $result0->fetch_assoc();
								$sem0 = $row0['numreg'];
							} else {
								$sem0 = "999";
								
							}
								array_push($graphssem0, $sem0);
							
							
							//echo "sql4sem1---". $sql4sem1 . "<br>";
							$result4 = mysqli_query($conn, $sql4sem1);
							
							$row4 =  $result4->fetch_assoc();
							$sem1 = $row4['numreg'];
							//echo "-sem1--". $sem1 . "---<br>";
							array_push($graphssem1, $sem1);
							
							//echo "sql4sem2---". $sql4sem2 . "<br>";
							$result4 = mysqli_query($conn, $sql4sem2);
							
							$row4 =  $result4->fetch_assoc();
							$sem2 = $row4['numreg'];
						  //echo "-sem2--". $sem2 . "---<br>";
							array_push($graphssem2, $sem2);
							
							$result4 = mysqli_query($conn, $sql4sem3);
							$row4 =  $result4->fetch_assoc();
							$sem3 = $row4['numreg'];
							//echo "-sem3--". $sem3 . "---<br>";
							array_push($graphssem3, $sem3);
							
							$result4 = mysqli_query($conn, $sql4);
							
							while($row4 =  $result4->fetch_assoc())
							{ 
								$numreg = $row4['numreg'];
								//echo "-numreg--". $numreg . "---<br>";
								$piezashechas = $objetivo / $divide;
								$piezashechas = $piezashechas * $diaslleva;
								array_push($phechas, $piezashechas);
								
								
								array_push($graphs, $numreg);
								$objetivo = round($objetivo, 1);
								$titulo = $descripcion . " Objetivo " . $objetivo;
								array_push($tit, $titulo);
							}
						}
				}
			}
	}
	
?>

<script type="text/javascript">
var cont = 0; 	
var valor = 0;
var valorsem0 = '';
var valorsem1 = '';
var valorsem2 = '';
var valorsem3 = '';
var titulo = '';
var rango1 = 0;
var rango2 = 0;
var valor1 = 0;
var valor2 = 0;
var rango3 = 0;
var objs = 0;
var pok = 0.0;
var fondo = '';
var restacolor = 0.0;
var semana0 = 0;
var semana1 = 0;
var semana2 = 0;
var semana3 = 0;

cont = <?php echo ($numgraf) ?>;	
semana0 = <?php echo ($numeroSemana) ?>;	
semana1 = <?php echo ($numeroSemana1) ?>;	
semana2 = <?php echo ($numeroSemana2) ?>;	
semana3 = <?php echo ($numeroSemana3) ?>;	

var VanillaRunOnDomReady = function() {

for (var i = 1; i <= cont; i++) 
{
	  var chartg = "container" + i;
	  titulo = '';
		switch (i)
		{

		   case 1: 
		       valor  = <?php print_r($graphs [1]) ?>;
		       valorsem0  = <?php print_r($graphssem0 [1]) ?>;
		       valorsem1  = <?php print_r($graphssem1 [1]) ?>;
		       valorsem2  = <?php print_r($graphssem2 [1]) ?>;
		       valorsem3  = <?php print_r($graphssem3 [1]) ?>;
		       titulo = '<?php print_r($tit [1]) ?>';
		       rango1 = '<?php print_r($niv1 [1]) ?>';
		       rango2 = '<?php print_r($niv2 [1]) ?>';
		       objs = '<?php print_r($obj [1]) ?>';
		       rango3 = '<?php print_r($niv3 [1]) ?>';
		       pok = '<?php print_r($phechas [1]) ?>';
		       break;
		   case 2:
		        valor  = <?php      
		       if (empty($graphs [2])) {
    					echo("0");	
						} else {
							print_r($graphs [2]);
						}
		        ?>;
		        valorsem0  = <?php      
		       if (empty($graphssem0 [2])) {
    					echo("0");	
						} else {
							print_r($graphssem0 [2]);
						}
		        ?>;
		       valorsem1  = <?php      
		       if (empty($graphssem1 [2])) {
    					echo("0");	
						} else {
							print_r($graphssem1 [2]);
						}
		        ?>;
		       valorsem2  = <?php      
		       if (empty($graphssem2 [2])) {
    					echo("0");	
						} else {
							print_r($graphssem2 [2]);
						}
		        ?>;
		       valorsem3  = <?php      
		       if (empty($graphssem3 [2])) {
    					echo("0");	
						} else {
							print_r($graphssem3 [2]);
						}
		        ?>;
		       titulo = '<?php print_r($tit [2]) ?>';
		       rango1 = '<?php print_r($niv1 [2]) ?>';
		       rango2 = '<?php print_r($niv2 [2]) ?>';
		       objs = '<?php print_r($obj [2]) ?>';
		       rango3 = '<?php print_r($niv3 [2]) ?>';
		       pok = '<?php print_r($phechas [2]) ?>';
		       break;
		   case 3:
		        valor  = <?php      
		       if (empty($graphs [3])) {
    					echo("0");	
						} else {
							print_r($graphs [3]);
						}
		        ?>;

		        valorsem0 = '<?php print_r($graphssem0 [3]) ?>';
		        valorsem1  = <?php      
		       if (empty($graphssem1 [3])) {
    					echo("0");	
						} else {
							print_r($graphssem1 [3]);
						}
		        ?>;
		       valorsem2  = <?php      
		       if (empty($graphssem2 [3])) {
    					echo("0");	
						} else {
							print_r($graphssem2 [3]);
						}
		        ?>;
		       valorsem3  = <?php      
		       if (empty($graphssem3 [3])) {
    					echo("0");	
						} else {
							print_r($graphssem3 [3]);
						}
		        ?>;
		       titulo = '<?php print_r($tit [3]) ?>';
		       rango1 = '<?php print_r($niv1 [3]) ?>';
		       rango2 = '<?php print_r($niv2 [3]) ?>';
		       objs = '<?php print_r($obj [3]) ?>';
		       rango3 = '<?php print_r($niv3 [3]) ?>';
		       pok = '<?php print_r($phechas [3]) ?>';
		       break;
		    case 4:
		       valor  = <?php      
		       if (empty($graphs [4])) {
    					echo("0");	
						} else {
							print_r($graphs [4]);
						}
		        ?>;
		         valorsem0  = <?php      
		       if (empty($graphssem0 [4])) {
    					echo("0");	
						} else {
							print_r($graphssem0 [4]);
						}
		        ?>;
		        valorsem1  = <?php      
		       if (empty($graphssem1 [4])) {
    					echo("0");	
						} else {
							print_r($graphssem1 [4]);
						}
		        ?>;
		       valorsem2  = <?php      
		       if (empty($graphssem2 [4])) {
    					echo("0");	
						} else {
							print_r($graphssem2 [4]);
						}
		        ?>;
		       valorsem3  = <?php      
		       if (empty($graphssem3 [4])) {
    					echo("0");	
						} else {
							print_r($graphssem3 [4]);
						}
		        ?>;
		       titulo = '<?php print_r($tit [4]) ?>';
		       rango1 = '<?php print_r($niv1 [4]) ?>';
		       rango2 = '<?php print_r($niv2 [4]) ?>';
		       objs = '<?php print_r($obj [4]) ?>';
		       rango3 = '<?php print_r($niv3 [4]) ?>';
		       pok = '<?php print_r($phechas [4]) ?>';
		       break;
		   case 5:
		       valor  = <?php      
		       if (empty($graphs [5])) {
    					echo("0");	
						} else {
							print_r($graphs [5]);
						}
		        ?>;
		         valorsem0  = <?php      
		       if (empty($graphssem0 [5])) {
    					echo("0");	
						} else {
							print_r($graphssem0 [5]);
						}
		        ?>;
		        valorsem1  = <?php      
		       if (empty($graphssem1 [5])) {
    					echo("0");	
						} else {
							print_r($graphssem1 [5]);
						}
		        ?>;
		       valorsem2  = <?php      
		       if (empty($graphssem2 [5])) {
    					echo("0");	
						} else {
							print_r($graphssem2 [5]);
						}
		        ?>;
		       valorsem3  = <?php      
		       if (empty($graphssem3 [5])) {
    					echo("0");	
						} else {
							print_r($graphssem3 [5]);
						}
		        ?>;
		       titulo = '<?php print_r($tit [5]) ?>';
		       rango1 = '<?php print_r($niv1 [5]) ?>';
		       rango2 = '<?php print_r($niv2 [5]) ?>';
		       objs = '<?php print_r($obj [5]) ?>';
		       rango3 = '<?php print_r($niv3 [5]) ?>';
		       pok = '<?php print_r($phechas [5]) ?>';
		       break;
		}
			
		if (valorsem0 == '999') {
			valorsem0 = '';
		} else {
					valorsem0 = 'S'+semana0+': <span style="color:blue;">'+valorsem0+'</span>';
		}

		if (valorsem1 >= 0) {
			valorsem1 = 'S'+semana1+': <span style="color:blue;">'+valorsem1+'</span>';
		}
		
		if (valorsem2 >= 0) {
			valorsem2 = 'S'+semana2+': <span style="color:blue;">'+valorsem2+'</span>';
		}
		
		if (valorsem3 >= 0) {
			valorsem3 = 'S'+semana3+': <span style="color:blue;">'+valorsem3+'</span>';
		}
		
		 
		pok = Math.round(pok * 10) / 10
		restacolor = pok - valor
		
		 	  
		if (pok <= valor) {
			fondo = '#55BF3B';
			valor1 = pok;
			valor2 = valor;
		} else {
			if (restacolor <= 0.5 && restacolor>0) {
				fondo = '#55BF3B';
			} else {
					fondo = '#f00';
			}
				valor1 = valor;
				valor2 = pok
		}
		
		
	  Highcharts.chart(chartg, {
	    chart: {
	      type: 'gauge',
	     renderTo: 'container',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
	    },
	  exporting: { enabled: false },
		title: {
	      text: '<div style="text-align: center; padding: 1px; color: white; background-color: #537895">' +
				'<span style="font-size: medium">'+titulo+'</span></div>'+valorsem0+'&nbsp;&nbsp;&nbsp;'+valorsem1+'&nbsp;&nbsp;&nbsp;'+valorsem2+'&nbsp;&nbsp;&nbsp;'+valorsem3,
		         floating: false,
		            useHTML: true
		    },
		     pane: {
			    startAngle: -90,
			    endAngle: 90,
			    background: {
	            	borderWidth: 0,
	                backgroundColor: 'none',
	               innerRadius: '60%',
	                outerRadius: '100%',
	                shape: 'arc'
	            },
			  size: '160%',
			    center: ['50%', '70%']
		  },
	    plotOptions: {
	      gauge: {
	        dataLabels: {
	          enabled: false
	        },
	        dial: {
	          baseLength: '0%',
	          baseWidth: 10,
	          radius: '100%',
	          rearLength: '0%',
	          topWidth: 1
	        }
	      }
	      
	    },
	    // the value axis
	    yAxis: {
	      labels: {
	        enabled: true,
	        //x: 15,
	        y: -5,
	         useHTML: true,
		        style: {
		        'color': 'white',
		        'fontWeight': 'bold',
		         'textShadow': '0px 1px 2px black',
		         'fontSize': '22px',
		         'fontFamily': 'proxima-nova,helvetica,arial,sans-seri',
             'whiteSpace': 'nowrap',
             'paddingLeft': '0px',
             'paddingRight': '0px',
             'paddingTop': '0px',
             'paddingBottom': '0px',
             'padding': '0px'
		      }
	      },
	      tickPositions: [0, valor1, valor2, objs, rango3, valor],
	      tickLength: 30,
	      tickColor: 'orange',
	      tickWidth: 5,
	      min: 0,
	      max: rango3,
	      plotBands: [{
	        from: 0,
	        to: valor1,
	        color: '#55BF3B', // red
	        thickness: '50%'
	      }, {
	        from: valor1,
	        to: valor2,
	        color: fondo, // yellow
	        thickness: '50%'
	      }, {
	        from: valor2,
	        to: objs,
	        color: '#005aa7', // azul 
	        thickness: '50%'
	      }, {
	        from: objs,
	        to: rango3,
	        color: '#00008B', // azul oscuro
	        thickness: '50%'
	      }]
	    },
	    series: [{
	    	type: 'gauge',
	      name: 'Piezas',
	      data: [valor]
	    }],
	       credits: {
	      enabled: false
	    }
	  });
	}

 
		
}

var alreadyrunflag = 0;

if (document.addEventListener)
    document.addEventListener("DOMContentLoaded", function(){
        alreadyrunflag=1; 
        VanillaRunOnDomReady();
    }, false);
else if (document.all && !window.opera) {
    document.write('<script type="text/javascript" id="contentloadtag" defer="defer" src="javascript:void(0)"><\/script>');
    var contentloadtag = document.getElementById("contentloadtag")
    contentloadtag.onreadystatechange=function(){
        if (this.readyState=="complete"){
            alreadyrunflag=1;
            VanillaRunOnDomReady();
            
    fnSemaforo();
            
        }
    }
}

window.onload = function(){
  setTimeout("if (!alreadyrunflag){VanillaRunOnDomReady}", 0);
}

</script>


<div style="overflow-x:auto;">
  <table>
  <tr align="center">
  	<th align="center">
  		<span class="faltan">
  			<?php 
  			$numera = array_sum($graphs)-50;
  			$denomina = array_sum($phechas)-50;
				if ($denomina == 0) {
					$porcent = 0;
				} else {
					$porcent = ($numera / $denomina) * 100; 
				}
				echo (round($porcent). "%");
				?>
  			</span>
  	</th>
  	<?php 
		for ($t = 1; $t <= $numgraf; $t++) { 
				$divid = "container" . $t;
		?>
			<th align="center">
					<div id="<?php echo ($divid) ?>"  style="min-width: 350px; height: 280px; max-width: 800px; margin: 0 auto">></div>
			</th>
		<?php
		}
		?>
	</tr>
  <tr>
  	<td></td>
			<?php 
			for ($j = 1; $j <= $numgraf; $j++) { 
				
				$semaf = ceil($obj[$j] /  $divide);
				$falta = $semaf - $graphs [$j];
				$estado = $graphs [$j] - $phechas [$j];
				if ($falta < 0) $falta = 0;
			?>
			  <td>
						<table>
			    	<tr>	
						<td valign="top" align="left" id="queda" style="margin: 0 left">
							<span class="faltan">Estado: 
								
							<?php 
							if (round($estado) > 0) echo("+" . ceil($estado)); 
							if (round($estado) == 0) echo("OK"); 
							if (round($estado) < 0) echo(round($estado)); 
							?>
								 
							</span>
						</td>
						<td valign="top" align="left" id="queda" style="margin: 0 left">
							<span class="faltan"><?php echo ($dhasta[$j]) ?> 
							<?php echo($hhasta [$j]) ?></span>
						 </td>
						</tr>
					</table>
			</td>
		<?php
		}
		?>
	</tr>
 </table>
</div>
