<?php
  
include 'db_access.php';

$id= $_GET['id'];
$gambar = $_GET['gambar'];

$sql = "DELETE FROM iot_farm_monitor WHERE id = ".$id; 

if (mysqli_query($conn,$sql)){    
    unlink("../gambar/".$gambar);
    header("Location: https://makassarrobotics.000webhostapp.com/iot_farm/log.php", true, 301);
    exit();
}
else{
    echo "Terjadi Kesalahan.<br>";
    echo $waktu;  
}

?>