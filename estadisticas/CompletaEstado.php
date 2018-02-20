<?php
session_start();
include_once ( "phplot/PHPlot.php" );
	
	
	$graph = new PHPlot();
	$graph->SetDataValues($_SESSION['datos_stats']);
	$graph->SetDataColors($_SESSION['colores'] ,$which_border);
	$graph->SetDataType( "text-data" );
	$graph->SetPlotType("bars");
	$graph->SetTitle("Estado de las incidencias");
	$graph->SetXTitle('Meses');
	$graph->SetYTitle('Incidencias');
	$graph->SetLegend("Resuelta");
	$graph->SetLegend("Interrumpida");
	$graph->SetLegend("En curso");
	$graph->SetLegend("Desestimada");
	$graph->DrawGraph();
	//$graph->PrintImage();

?>