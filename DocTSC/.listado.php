<SCRIPT LANGUAGE="php">
if ( is_file(".comment")){
  echo "<table border=\"0\" bgcolor=\"#000000\" width=\"90%\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\">";
  echo "<tr><td>";
  echo "<table border=\"0\" bgcolor=\"#F6F6F6\" width=\"100%\" align=\"center\" cellpadding=\"10\" cellspacing=\"0\">";
  echo "<tr>";
  echo "<td>";
  $fh = fopen(".comment","r");
  $contents = fread($fh,filesize(".comment"));
  echo $contents;
  fclose($fh);
  echo "</td>";
  echo "</tr>";
  echo "</table>";
  echo "</td></tr>";
  echo "</table>";
}
</SCRIPT>
<div style="font-family: lucida,helvetica,arial">

<table border="0" bgcolor="#000000" width="90%" align="center" cellpadding="2" cellspacing="1">
<tr>
<td>
<table border="0" bgcolor="#fafafa" width="100%" align="center" cellpadding="10" cellspacing="0">
<tr>
<td>
<div style="font-family: lucida console,lucidatypewriter,screen">
<table border="0" bgcolor="#fafafa" width="90%" align="center" cellpadding="2" cellspacing="1">
<font size="-1">
<tr>
<td width="20"></td>
<td width="150" align="center">Nombre</td>
<td width="150" align="center">Longitud</td>
<td align="center">Descripcion</td>
</tr>
<tr>
<td colspan="4">
<hr noshade align="left" width="100%">
</td>
</tr>
<SCRIPT LANGUAGE="php">
$icons["exe"]="i-executable.png";
$icons["dll"]="i-executable.png";
$icons["rpm"]="gnome-pack-rpm.png";
$icons["bin"]="gnome-objectfile.png";
$icons["tgz"]=$icons["gz"]=$icons["Z"]=$icons["zip"]="gnome-compressed.png";
$icons["ps"]="gnome-application-encapsulated_postscript.png";
$icons["pdf"]="gnome-application-pdf.png";
$icons["tif"]=$icons["tiff"]="gnome-image-tiff.png";
$icons["html"]=$icons["htm"]="gnome-text-html.png";
$handle=opendir('.');
$count=0;
$countd=0;
while ( false !== ($tfile=readdir($handle))){
  if ( is_dir($tfile)) {
    $dirs[$countd]=$tfile;
    $countd++;
  } else {
    $file[$count] = $tfile;
    $count++;
  }
}
sort($dirs);
sort($file);
if ( is_file(".info")){
  $fh = fopen(".info","r");
  while ( fscanf($fh,"%s\t%s\n",$f,$i)){
    $info[$f] = $i;
  }
  fclose($fh);  
}
for ( $i=0;$i<$countd; $i++){
  if ($dirs[$i]{0} != '.') {
    echo "<tr>\n";
    echo "<td width=\"20\">";
    echo "<img border=\"0\" src=\"/mc-icons/menu.gif\" alt=\"[DIR]\" HEIGHT=\"22\" WIDTH=\"20\"> ";
    echo "</td><td width=\"150\">";
    echo "<a href=\"$dirs[$i]/\">$dirs[$i]</a>\n";
    echo "</td><td width=\"150\">";
    echo "DIR";
    echo "</td><td>";
    if (isset($info)) {
      if ( array_key_exists($dirs[$i],$info)) {
	echo $info[$dirs[$i]];
      }
    }
    echo "</td></tr>\n";
  }
}
for ( $i=0;$i<count($file);$i++) {
  if (array_key_exists($i,$file)){
    if (($file[$i] !== "index.php") && ($file[$i]{0} !== '.') && ($file[$i]{strlen($file[$i])-1} !=='~') ) {
      echo "<tr>\n";
      echo "<td width=\"20\">";
      $pathparts = pathinfo($file[$i]);
      if ( array_key_exists("extension",$pathparts))
	$ext = $pathparts["extension"];
      if (array_key_exists($ext,$icons))
	$icon=$icons[$ext];
      else
	$icon="i-regular.png";
      if ( $icon=="" )
	$icon="i-regular.png";
      echo "<img border=\"0\" src=\"/icons/$icon\" alt=\"[$ext]\" HEIGHT=\"28\" WIDTH=\"25\"> ";
      echo "</td><td width=\"150\">";
      echo "<a href=\"$file[$i]\">$file[$i]</a>\n";
      echo "</td><td width=\"150\">";
      if ( array_key_exists($i,$file)){
	echo filesize($file[$i]);    
	echo " bytes";
      }
      echo "</td><td>";
      if (isset ($info) && array_key_exists($file[$i],$info)) {
	echo $info[$file[$i]];
      }
      echo "</td></tr>\n";
    }
  }
}
</SCRIPT>
<tr>
<td colspan="4">
<hr noshade align="left" width="100%">
</td>
</tr></table>
</font>
</div>
</td>
</tr>
</table>
</td>
</tr>
</table>
</div>
<BR><BR>
<SCRIPT LANGUAGE="php">
if ( is_file(".footer")){
  echo "<table border=\"0\" bgcolor=\"#000000\" width=\"90%\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\">";
  echo "<tr><td>";
  echo "<table border=\"0\" bgcolor=\"#F6F6F6\" width=\"100%\" align=\"center\" cellpadding=\"10\" cellspacing=\"0\">";
  echo "<tr>";
  echo "<td>";
  $fh = fopen(".footer","r");
  $contents = fread($fh,filesize(".footer"));
  echo $contents;
  fclose($fh);
  echo "</td>";
  echo "</tr>";
  echo "</table>";
  echo "</td></tr>";
  echo "</table>";
  echo "<BR>\n";
}
</SCRIPT>


