<?php 
include 'db_access.php';

$result = mysqli_query($conn,"SELECT * FROM iot_farm_kontrol");
$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}
$myarray = json_encode($rows); 

print json_encode(array('kontrol' => $rows));

?>