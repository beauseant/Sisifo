<?php
require_once ( "phplot/phplot.php" );
session_start(); 

$graph = new PHPlot();
$graph->SetDataType( "text-data" );
$graph->SetPlotType("bars");
$graph->SetDataValues($_SESSION['datos_stats']);
$graph->DrawGraph();
$graph->PrintImage();

?>
