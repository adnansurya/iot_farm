<?php 
include 'db_access.php';

$result = mysqli_query($conn,"SELECT * FROM monitoring ORDER BY id DESC");
$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}
$myarray = json_encode($rows); 

print json_encode(array('hasil' => $rows));
?>