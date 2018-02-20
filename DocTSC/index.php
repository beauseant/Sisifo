<?PHP

session_start();

require_once ("../lib.php");
require_once ("../header.php");

$sisifoConf  = new Configuracion ( "../sisifo.xml" );

include ("../menu_opc.php");

?>

        </div>
                <div class="blogbody">
                        <div class="big">
                                [Documentos para usuarios de la red del departamento]<br><br>
                        </div>


<?PHP

		include (".listado.php");
?>
	</div>	
</div>


<?PHP
include ("../footer.php");


?>

