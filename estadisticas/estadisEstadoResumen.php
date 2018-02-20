<?php
session_start();
include_once ( "phplot/PHPlot.php" );
	 

	//$which_data = array("blue","green",array(222,222,255),array(222,255,255),
		//array(255,222,255));

	$graph = new PHPlot();
	$graph->SetDataValues($_SESSION['datos_stats4']);
	$graph->SetDataColors($_SESSION['colores'] ,$which_border);
	$graph->SetDataType( "text-data" );
	$graph->SetPlotType("pie");
	$graph->SetTitle("Estado de las incidencias");
	$graph->SetXTitle('Estado');
	$graph->SetYTitle('Incidencias');
	$graph->SetLegend("Resueltas");
	$graph->SetLegend("Interrumpidas");	
	$graph->SetLegend("En curso");
	$graph->SetLegend("Desestimadas");
	$graph->DrawGraph();
	//$graph->PrintImage();

?>