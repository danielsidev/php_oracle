<?php
//header('Content-Type: text/html ; charset=utf-8');
//echo "<meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\" />";
/*$dbstr ="(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.122.1)(PORT = 1521))
(CONNECT_DATA =
(SERVER = DEDICATED)
(SERVICE_NAME = ORCL)
))";

if($conn = oci_connect('system','123', 'localhost/xe')):
    print "CONECTADO EM Localhost <hr/>";
else:
    print "ERRO NA CONEXAO <hr/>";
endif;
*/


// Create connection to Oracle
/*
$conn = $c oci_pconnect("system", "123", "//localhost/xe");
if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}
else {
   print "Connected to Oracle!";
}
// Close the Oracle connection
oci_close($conn);
*/

$c = oci_pconnect("system", "123", "//localhost/xe");

//$stid = oci_parse($c, 'select * from usuarios');
//oci_execute($stid);
//oci_fetch_all($stid, $res);
//var_dump($res);

$query = 'select * from usuarios';
$stid = oci_parse($c, $query);
$r = oci_execute($stid);


print '<table border="1"><tr> <th>ID </th> <th>NOME</th> <th>SOBRENOME</th> </tr>';
while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
    print '<tr>';
   foreach ($row as $item) {
      print '<td>'.($item?htmlentities($item):' ').'</td>';
   }
   print '</tr>';

//var_dump($row);
}
print '</table>';

// Close the Oracle connection
oci_close($conn);
?>


