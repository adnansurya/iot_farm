<?php
  
include 'db_access.php';

$suhu_udara = $_POST['suhu_udara'];
$lembab_udara = $_POST['lembab_udara'];
$lembab_tanah = $_POST['lembab_tanah'];
$ph_tanah = $_POST['ph_tanah'];


$date = new DateTime("now", new DateTimeZone('Asia/Makassar') );
$waktu = $date->format('Y-m-d H:i:s');

$sql = "INSERT INTO iot_farm_monitoring(suhu_udara,lembab_udara,lembab_tanah,ph_tanah,waktu) VALUES ('$suhu_udara','$lembab_udara','$lembab_tanah','$ph_tanah','$waktu')";

if (mysqli_query($conn,$sql)){

    
    include 'read_data.php';
}
else{

    echo "Terjadi Kesalahan.<br>";
    echo $waktu;
    
}

?>