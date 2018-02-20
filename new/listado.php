<?php
// basic sequence with LDAP is connect, bind, search, interpret search
// result, close connection

echo "<h3>LDAP query test</h3>";
echo "Connecting ...";
$ds=ldap_connect("localhost");  // must be a valid LDAP server!
echo "connect result is ".$ds."<p>";

if ($ds) { 
    echo "Binding ..."; 
    $user_bind = "uid = sblanco, ou=People, dc=tsc, dc=uc3m,dc=es";
    $user_passwd = "!Emeuc@;";

    $r = ldap_bind($ds, $user_bind, $user_passwd);
    //$r=ldap_bind($ds);     // this is an "anonymous" bind, typically
                           // read-only access
    echo "Bind result is ".$r."<p>";

    echo "Searching for (sn=S*) ...";
    // Search surname entry
//    $sr=ldap_search($ds,"o=My Company, c=US", "sn=S*");  
    //$sr=ldap_search($ds,"uid=sblanco, ou=People,dc=tsc,dc=uc3m,dc=es", "uid=sblanco");
    //$sr=ldap_search($ds,"cn=sysadmin, ou=Group,DC=tsc,DC=uc3m,DC=es", "memberuid=hmolina");
    //$sr=ldap_search($ds,"uidnumber=189, ou=People, dc=tsc, dc=uc3m,dc=es","uidnumber=189");    
     //$sr=ldap_search($ds,"ou=People,DC=tsc,DC=uc3m,DC=es", "uidnumber=189");
$sr=ldap_search($ds,"ou=People,DC=tsc,DC=uc3m,DC=es","uid=*");
    echo "Search result is ".$sr."<p>";

    echo "Number of entires returned is ".ldap_count_entries($ds,$sr)."<p>";

    echo "Getting entries ...<p>";
    $info = ldap_get_entries($ds, $sr);
    echo "Data for ".$info["count"]." items returned:<p>";

    for ($i=0; $i<$info["count"]; $i++) {
        echo "dn is: ". $info[$i]["dn"] ."<br>";
        echo "first cn entry is: ". $info[$i]["cn"][0] ."<br>";
        echo "first email entry is: ". $info[$i]["mail"][0] ."<br>";
	echo "id: " . $info[$i]["uidnumber"][0] . "<br>";
	echo "----------------------------- <br><br>";
    }

    echo "Closing connection";
    ldap_close($ds);

} else {
    echo "<h4>Unable to connect to LDAP server</h4>";
}
?>
