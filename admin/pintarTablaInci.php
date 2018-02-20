<?php
#        extract($_REQUEST);
	extract($_REQUEST);
?>

		<table width=100%>
			<tr>
				<td bgColor="#dddddd" align=center style="border:1px solid #999999;">
					<b>Listado de incidencias:</b></td></tr>
		</table>
		<table>
			<tr>
				<th bgColor="#cccccc" class="small" style="border:1px solid
					#999999;">Id</th>
				<th bgColor="#cccccc" class="small" style="border:1px solid
					#999999;">Usuario</th>
				<th bgColor="#cccccc" class="small" style="border:1px solid
					#999999;">Descripcion</th>
				<th bgColor="#cccccc" class="small" style="border:1px solid
					#999999;">Tipo</th>
				<th bgColor="#cccccc" class="small" style="border:1px solid
					#999999;">Fecha llegada
					<?php echo  '
					<a href="javascript: OrdenarFecha(\'' . $ordenfecha . '\')"'
					?>;>
					<img src="../Documentos/Imagenes/
					<?php echo $fichero_img; ?> " border="0">
 					</img></a></th>
				<th bgColor="#cccccc" class="small" style="border:1px solid
					#999999;">Estado</th>
				<th bgColor="#cccccc" class="small" style="border:1px solid
					#999999;">Mostrar</th>
			<?php
				while ( !($iterator -> EOF() ) ) {
					$incidencia = $iterator -> fetch ();
					if ( ( $incidencia -> getId() ) == $id ) {
						$bgColor = "6699FF";
						//#F0F8FF";
					}else {
						$bgColor = "#eeeeee";
					}
					
					mostrarIncidencias ( $bgColor, $validacion, 
						$incidencia, $posInicio );
				}
			?>
		</table>
		<center>
			<table width=100%>
				<tr>					
					<td align="right" valign="middle" bgcolor="#dddddd"> 
					<?php
						$newPos = $posInicio + $limit_admin;
						if ($newPos < $_SESSION['incidencias_totales']){
							echo '<a href="javascript: calcularInicioAdminInci(\'' . $newPos . '\')">';
							echo '<img src="../Documentos/Imagenes/ver.gif" border=0 title="Ver siguientes" alt="Ver siguientes"></a>';	
						}
					?>
						
					<?php
						echo '<input type="hidden" name="posInicio" VALUE="'.$newPos2. '">';
						$newPos2 = $posInicio - $limit_admin;
						if ( $newPos2 >= 0 ) {
							echo '<a href="javascript: calcularInicioAdminInci(\'' . $newPos2 . '\')">';
							echo '<img src="../Documentos/Imagenes/atras.gif" border=0 title="Ver anteriores" alt="Ver anteriores"></a>';
						}
						echo ' <br>[' . $newPos . '/' .
						$_SESSION['incidencias_totales'] . ']';
					?>
						
					</td>
				</tr>
			</table>
		</center>
	</td>
			
</tr>
</table>		
