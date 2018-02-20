<?PHP
session_start();

include ("../lib.php");
include ("../header.php");

include ("menu_gen.php");

        import_request_variables("gp");


?>
</div>
		<div class="blogbody">
			<div class="big">
				[ Enviar una incidencia software al sistema ]<br><br>
			</div>
				
			<?PHP
			    	//$sisifoConf = new Configuracion ( $_SESSION ['fichero'] );
				
				$sisifoConf  = new Configuracion ( "../sisifo.xml" );
				
				$desc_larga = $_REQUEST['desc_larga'];
				$desc_breve = $_REQUEST['desc_breve'];
				$tipo_soft = $_REQUEST['tipo_soft'];
                                $cc        = $_REQUEST['cc'];

					
				$db = $sisifoConf -> getBd();

				$sql = "SELECT * FROM tipo_soft ORDER BY descripcion";
				$res = $db->Execute($sql);

				echo ( '
					<FORM NAME=frm_soft ACTION="software.php" METHOD="POST"> 
                                                <TABLE CELLPADDING="5px" style="font-size:11px;">
                                                        <TR bgColor="#dddddd" style="border:3px solid #999999;">
                                                                <TD> Poner en copia a otro correo (CC): </TD>
                                                                <TD> <INPUT TYPE="text" NAME="cc" SIZE="25" MAXLENGTH="150" VALUE="' . $cc . '" </TD> 
                                                        </TR>
                                                        <TR>
                                                        </TR>
                                                </TABLE>
                                                <BR><BR><BR>
						<TABLE WIDTH="100%" CELLPADDING="15px">
							<TR bgColor="#dddddd" style="border:3px solid #999999;">
								<TD> Problema con: </TD>	
								<TD> Explicaci&oacute;n: </TD>	
								<TD> M&aacute;quina afectada: </TD>	
							</TR>
							<TR bgcolor = white >
								<TD>
				');
				while(!$res->EOF) {				
					$tipo = strtolower ($res -> fields ['descripcion']);
					$id_soft = $res -> fields ['id'];					
					if ( ( $id_soft == $tipo_soft ) || !$tipo_soft  ) {
						echo ( '						
									<INPUT TYPE=RADIO NAME= tipo_soft VALUE='
									 . $id_soft .' CHECKED >' . $tipo . '<BR>
						');						
					}else {
						echo ( '						
									<INPUT TYPE=RADIO NAME= tipo_soft VALUE='
									 . $id_soft .'>' . $tipo . '<BR>
						');						
					};
					$res -> movenext();
				};
			?>
			</DIV>
								</TD>
								<TD> 
									Descripci&oacute;n breve: <BR>
			<?PHP
				echo ('
						<b>*</b><INPUT TYPE="text" NAME="desc_breve" SIZE="55" MAXLENGTH="90" VALUE="' . $desc_breve . '"><br><br>
						Descripci&oacute;n larga:<BR>
						<b>*</b><TEXTAREA NAME="desc_larga" rows="15" cols="53" ALIGN=LEFT>'. $desc_larga . '</TEXTAREA><BR><BR>
					');
			?>
					</TD>
					<TD>
						<?PHP
							$tipo = "frm_soft";
							include ("mostrar_maq.php");
						?>
					</TD>
					</TR>
				</TABLE>
				<BR>
				(*) Campos obligatorios.
				<BR>
		<script type="text/javascript">
        		frm_soft.desc_breve.focus();
      		</script>
				<DIV ALIGN=CENTER>
					<INPUT NAME="Enviar" VALUE="Enviar incidencia" TYPE=BUTTON onclick="submit_final_soft();">
				</DIV>
					</FORM>			<BR>
			</DIV>
		</DIV>
	</DIV>

<?PHP
include ("../footer.php");
?>




