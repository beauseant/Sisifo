<?PHP
//session_start();
include_once ( "phplot/PHPlot.php" );
	
   $data=array(array("Votación",30,25,12,33));
   $graph = new PHPlot();
   $graph->SetPrintImage(false);
   $graph->SetFileFormat("jpg");
   $graph->SetOutputFile("graph.jpg");
   $graph->SetIsInline(true);
   $graph->SetDataValues($data);
   $graph->SetDataType("text-data");
   $graph->SetPlotType("pie");
   $graph->SetTitle("Resultados de la votación");
   $graph->SetLegend(array("Partido A", " Partido B", " Partido C", " Partido D"));
   $graph->DrawGraph();
   $graph->PrintImage();

	
	
/*$graph = new PHPlot();
$graph->SetDataType( "text-data" );
        $graph->SetPlotType("pie");
	        $graph->SetDataValues($_SESSION['datos_stats3']);
		        $graph->SetDataColors($_SESSION['colores'] ,$which_border);
			        $graph->SetTitle("Tipos de incidencias");
				        $graph->SetXTitle('Tipo');
					        $graph->SetYTitle('Incidencias');
						        $graph->SetLegend("Hardware");
							        $graph->SetLegend("Software");  
								        $graph->SetLegend("Altas usuario");
									        $graph->SetLegend("Bajas usuario");
										        $graph->SetLegend("Llaves");
											        $graph->SetLegend("Cambio de status");
												        $graph->SetLegend("Otras");
													        $graph->SetLegend("Alta maquinas");
														        $graph->DrawGraph();
															        $graph->PrintImage();
	
*/
?>