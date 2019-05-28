
<?php
$database="*****"; 
$username="****"; 
$password="******"; 
$host="********"; 

$conn = mysqli_connect($host,$username,$password, $database);

$sql = "select id from contadores where zona like '%HERMLE%' and programa like'%SP5%' order by orden";
//	echo "---". $sql . "---<br>";
$result = mysqli_query($conn, $sql);
include "calculo.php";

?>

