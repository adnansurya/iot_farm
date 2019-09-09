<?php 
    require ('db_access.php');
    

    if($_POST['params']) {
        $params = $_POST['params'];
        $value= $_POST['value'];
        $query = mysqli_query($conn, "UPDATE iot_farm_kontrol SET value = '".$value."' WHERE params='" .$params. "'") or die(mysqli_error($conn));

        echo "Update data Berhasil";

    }else{
        echo "Terjadi Kesalahan";
    }

?>