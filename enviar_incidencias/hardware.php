<?PHP
session_start();
require_once ("../lib.php");
require_once ("../header.php"); 

include ("menu_gen.php");      
?>
</div>
		<div class="blogbody">
			<div class="big">
				[ Enviar una incidencia hardware al sistema ]<br><br>
			</div>
				
			<?PHP
				$sisifoConf  = new Configuracion ( "../sisifo.xml" );
				
				$desc_larga = $_REQUEST['desc_larga'];
				$desc_breve = $_REQUEST['desc_breve'];
				$tipo_hard = $_REQUEST['tipo_hard'];
                                $cc 	   = $_REQUEST['cc'];
	
				$db = $sisifoConf -> getBd();
				$sql = "SELECT * FROM tipo_hard ORDER BY descripcion";
				$res = $db->Execute($sql);

				echo ( '
					<FORM NAME=frm_hard ACTION="hardware.php" METHOD="POST"> 
						<TABLE CELLPADDING="5px" style="font-size:11px;">
							<TR bgColor="#dddddd" style="border:3px solid #999999;">
								<TD> Poner en copia a otro correo (CC): </TD>
								<TD> <INPUT TYPE="text" NAME="cc" SIZE="25" MAXLENGTH="150" VALUE="' . $cc . '" </TD>
							</TR>
							<TR>
							</TR>
						</TABLE>
						<BR><BR><BR>
						<TABLE WIDTH="100%" CELLPADDING="5px" style="font-size:11px;">
							<TR bgColor="#dddddd" style="border:3px solid #999999;">
								<TD> Tipo de problema: </TD>	
								<TD> Explicaci&oacute;n: </TD>	
								<TD> M&aacute;quina afectada: </TD>	
							</TR>
							<TR bgcolor = white >
								<TD>
				');
				if ( ! isset ($primera) ) {
					$primera = true;
				}
				while(!$res->EOF) {
					$tipo = strtolower ( $res -> fields ['descripcion'] );
					$id_hard = $res -> fields ['id'];
					
					if ( $primera || ( $id_hard ==  $tipo_hard ) ) {
						echo ( '						
									<INPUT TYPE=RADIO NAME= tipo_hard VALUE=' . $id_hard .' CHECKED >' . $tipo . '<BR>
						');	
					}else {
						echo ( '						
									<INPUT TYPE=RADIO NAME= tipo_hard VALUE=' . $id_hard .'>' . $tipo . '<BR>
						');	
					};

					$res -> movenext();
					$primera = false;
				};
			?>
								</TD>
								<TD> 
									Descripci&oacute;n breve: <BR>
			<?PHP
				if (!$desc_breve) {
					$desc_breve="";
				}
				if (!$desc_larga) {
					$desc_larga = "";
				}
				
				echo ('
						<b>*</b><INPUT TYPE="text" NAME="desc_breve" SIZE="75" MAXLENGTH="150" VALUE="' . $desc_breve . '"><br><br>
						Descripci&oacute;n larga:<BR>
						<b>*</b><TEXTAREA NAME="desc_larga" rows="15" cols="73" ALIGN=LEFT>'. $desc_larga . '</TEXTAREA><BR><BR>
					');
			?>
					</TD>
					<TD>
						<?PHP
							$tipo = "frm_hard";
							include ("mostrar_maq.php");
						?>
					</TD>
					</TR>
				</TABLE>
				<BR>
				(*) Campos obligatorios.
				<BR>
		<script type="text/javascript">
        		frm_hard.desc_breve.focus();
      		</script>
				<DIV ALIGN=CENTER>
					<INPUT NAME="Enviar" VALUE="Enviar incidencia" TYPE=BUTTON onclick="submit_final();">
				</DIV>
					</FORM>
				</DIV>
		</DIV>
	</DIV>

<?PHP
include ("../footer.php");
?>
