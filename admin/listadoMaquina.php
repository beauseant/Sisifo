
<?php

    session_start();


    require_once("../lib.php");
    require_once("../classes/class.SisifoIncidencia.php");
    require_once ("../classes/iterator/class.IncidenciaIterator.php");
    require_once ("../classes/iterator/class.TipoIncidenciaIterator.php");
    require_once ("../classes/iterator/class.EstadoIncidenciaIterator.php");
    require_once ("../classes/autenticar/class.SisifoAutenticador.php");
    require_once ("../classes/class.SisifoBuscar.php");
    require_once("../classes/iterator/class.MaquinaIterator.php");
    require_once("libAdmin.php");

    include("../header.php");

        extract($_REQUEST);

        include ("menu_listadomaq.php");


       $uid = getUID($_SESSION['login']);

        $sisifoConf  = new Configuracion ( $_SESSION ['fichero'] );

        $SisifoInfo = $sisifoConf -> getSisifoConf ();
        $limit_admin = $SisifoInfo -> getLimitAdmin();



        if( ($uid == 0 ) ) {
                echo 'El usuario no ha sido registrado en el sistema. Por favor <A
                 href="../logout.php">registrese</A>  en el sistema';
                exit();
        }

        if (!  esAdmin() ) {
                echo"Debe ser administrador para ver esta pagina";
                exit();
        }

	$validacion = new SisifoAutenticadorLdap ( "","");

	if (!$maquina) {
            $maquina = 1;
        }


       if ( ! $ordenfecha || $ordenfecha == "DESC" ) {
                $fichero_img = "sortdesc.png";
                $ordenfecha = "DESC";
        }else {
                $fichero_img = "sortasc.png";
        }



	$sql = "SELECT DISTINCT (incidencia.id) FROM incidencia, inci_soft,inci_hard WHERE " . 
		"(incidencia.id=inci_soft.id  AND inci_soft.id_equipo = '" . $maquina . "')" . 
		" OR (incidencia.id=inci_hard.id AND inci_hard.id_equipo ='" . $maquina . "') ORDER BY incidencia.id";

	$iterator = new IncidenciaIterator ( $sql,
                         -1, 0  );



?>


<div class="blogbody">

<table cellpadding=0 cellspacing=0 border=0 align="center">

        <tr valign="top">
                <td style="padding-top:4;padding-right:4px;">
                        <form name="opciones" action="listadoMaquina.php" method=POST>
				<input type="hidden" name="posInicio">
                                <table border=0 bgcolor=#B0B0B0 cellpadding=3 cellspacing=3 align="center">
                                        <th  bgColor="#cccccc" class="small" colspan=3>
                                                Seleccione la m&aacute;quina de la que quiere ver las incidencias
                                        </th>
                                        <tr>
                                                <td bgColor="#dddddd" style="border:1px solid #999999;">
                                                       Nombre 
                                                </td>
                                                <td style = "padding-right:44px;">
						    <?php

							$itmaq = new MaquinaIterator();
       							echo '<SELECT name="maquina" onChange="javascript:document.opciones.submit();">';
						        while ( !$itmaq -> EOF() ) {
                						$itmaq -> fetch () ;
								if ( $maquina == $itmaq -> getId()) { 
                							echo '<OPTION VALUE="' .  $itmaq -> getId() . '" SELECTED>' . $itmaq -> getNombre();
									$nombre = $itmaq -> getNombre();
									$ip = $itmaq -> getSerial();
									$labo = $itmaq -> getLaboratorio(); 
								}else {
									echo '<OPTION VALUE="' .  $itmaq -> getId() . '"
>' . $itmaq -> getNombre();
								}
								

        						}

        						echo "</SELECT>";
	
                                                    ?>
                                                </td>

					</tr>	
					<tr>
						<td bgColor="#dddddd" style="border:1px solid #999999;">
                                                      IP 
						</td>	
						<td>
                                                      <?php echo $ip; ?> 
                                                </td>

					</tr>
                                       <tr>
                                                <td bgColor="#dddddd" style="border:1px solid #999999;">
                                                     Laboratorio 
                                                </td>
                                                <td>
                                                      <?php echo $labo; ?>
                                                </td>

                                        </tr>
				</table>
			</form>
		</td>
	</tr>
</table>

<br><br>
<?php
                include ("pintarTablaInci.php");
?>

</div>

<?php

        include ("../footer.php");

?>



	
