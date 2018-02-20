<?php
require_once ( "phplot/phplot.php" );
session_start(); 

$graph = new PHPlot();
$graph->SetDataType( "text-data" );
$graph->SetPlotType("bar");
$graph->SetDataValues($_SESSION['datos_stats2']);
$graph->DrawGraph();
$graph->PrintImage();

?>
