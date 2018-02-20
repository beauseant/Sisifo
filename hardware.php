<?PHP

session_start();

require_once ("../lib.php");
require_once ("header.php");

import_request_variables("gp");


$sisifoConf  = new Configuracion ( "sisifo.xml" );
	
      
?>

	</div>
		<div class="blogbody">
			<div class="big">
				[Enviar una incidencia hardware al sistema:]<br><br>
			</div>
				
			<?PHP
				$db = $sisifoConf -> getBd();
				$sql = "SELECT * FROM tipo_hard";
				$res = $db->Execute($sql);

				echo ( '
					<FORM NAME=frm_hard ACTION="hardware.php" METHOD="POST"> 
						<TABLE WIDTH="100%" CELLPADDING="5px" style="font-size:11px;">
							<TR bgColor="#dddddd" style="border:3px solid #999999;">
								<TD> Tipo de problema: </TD>	
								<TD> Explicacion: </TD>	
								<TD> Maquina afectada: </TD>	
							</TR>
							<TR bgcolor = white >
								<TD>
				');
				while(!$res->EOF) {
					$tipo = strtolower ( $res -> fields ['descripcion'] );
					$id_hard = $res -> fields ['id'];
					
					if ( !$tipo_hard || ( $id_hard ==  $tipo_hard ) ) {
						echo ( '						
									<INPUT TYPE=RADIO NAME= tipo_hard VALUE=' . $id_hard .' CHECKED >' . $tipo . '<BR>
						');	
					}else {
						echo ( '						
									<INPUT TYPE=RADIO NAME= tipo_hard VALUE=' . $id_hard .'>' . $tipo . '<BR>
						');	
					};

					$res -> movenext();
				};
			?>
			</DIV>
								</TD>
								<TD> 
									Descripcion breve: <BR>
			<?PHP
				if (!$desc_breve) {
					$desc_breve="";
				}
				if (!$desc_larga) {
					$desc_larga = "";
				}
				
				echo ('
						<b>*</b><INPUT TYPE="text" NAME="desc_breve" SIZE="75" MAXLENGTH="150" VALUE="' . $desc_breve . '"><br><br>
						Descripci� larga:<BR>
						<b>*</b><TEXTAREA NAME="desc_larga" rows="15" cols="73" ALIGN=LEFT>'. $desc_larga . '</TEXTAREA><BR><BR>
					');
			?>
					</TD>
					<TD>

						<b>*</b><SELECT NAME="lst_maquina" onChange="javascript:document.frm_hard.submit();">
			<?PHP
				$sql = "SELECT * FROM maquina";
				$res = $db->Execute($sql);
				while(!$res->EOF) {
					$nombre = $res -> fields ['nombre'];

					if ( !$lst_maquina || ( trim($lst_maquina) == trim ($nombre))  ) {			
						echo ('
							<OPTION SELECTED>'. $nombre .'</OPTION>
		 			         ');
						$ip = $res -> fields ['serial'];
						$id_maq = $res -> fields ['id'];
					}else {
						echo ('
							<OPTION>'. $nombre .'</OPTION>
		 			         ');
					}
					$res -> movenext();
				}
				echo ('
						</SELECT>
						<BR><BR>
						Direcci� IP: ' . $ip .
						'<INPUT TYPE="HIDDEN" NAME="id_maq" VALUE="'. $id_maq .'" >
				');
			?>
						<BR><BR><BR>
						<DIV ALIGN=RIGHT>
							<A HREF="camb_maquina.php"> La m�uina no aparece en el listado, o los datos no son correctos </A>
						</DIV>
					</TD>
					</TR>
				</TABLE>
				<DIV ALIGN=RIGHT>
					<INPUT NAME="Enviar" VALUE="Enviar incidencia" TYPE=BUTTON onclick="submit_final();">
				</DIV>
					</FORM>			<BR>
				<DIV CLASS="date">
					<CENTER>
						 <A HREF="../mostrar.php">::men principal::</a> 
					</CENTER>
				</DIV>
			</DIV>
		</DIV>
	</DIV>

<?PHP
include ("../footer.php");
?>
