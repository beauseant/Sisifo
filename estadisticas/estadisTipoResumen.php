<?PHP
session_start();
include_once ( "phplot/PHPlot.php" );

$graph = new PHPlot();
//$graph->SetPrintImage(false);
// $graph->SetFileFormat("jpg");
// $graph->SetOutputFile("estadisTipoResumen.jpg");
// $graph->SetIsInline(true);
$graph->SetDataValues($_SESSION['datos_stats3']);
$graph->SetDataColors($_SESSION['colores'] ,$which_border);
$graph->SetDataType( "text-data" );
$graph->SetPlotType("pie");
$graph->SetTitle("Tipos de incidencias");
$graph->SetXTitle("Tipo");
$graph->SetYTitle("Incidencias");
$graph->SetLegend("Hardware");
$graph->SetLegend("Software");  
$graph->SetLegend("Altas usuario");
$graph->SetLegend("Bajas usuario");
$graph->SetLegend("Llaves");
$graph->SetLegend("Cambio de status");
$graph->SetLegend("Otras");
$graph->SetLegend("Alta maquinas");
$graph->SetLegend("Cluster");
$graph->SetLegend("RF Inves");
$graph->SetLegend("RF Doc");
$graph->SetLegend("Audio");

$graph->DrawGraph();
//$graph->PrintImage();

?>
