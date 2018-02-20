<?PHP

include("lib.php");

session_start();

$sisifoConf  = new Configuracion ( "sisifo.xml" );

$sisifoConf -> closeDb();


session_unregister ("login");
session_unregister ("ip");
session_unregister ("login");
session_unregister ("ip");
session_unregister ("login");
session_unregister ("ip");

session_destroy();

header("Location: index.php\n\n");

?>
