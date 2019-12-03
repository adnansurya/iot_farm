<!DOCTYPE html>
<html>

<head>
    <title>Log | IOT Farm</title>
    <?php require('api/db_access.php'); ?>
    <?php require('partials/head.php'); ?>
</head>

<body class="theme-green">
    <!-- Page Loader -->
    <?php require('partials/page_loader.php'); ?>
    <!-- #END# Page Loader -->

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Top Bar -->
    <?php require('partials/top_bar.php'); ?>
    <!-- #Top Bar -->

    <section>
        <!-- Left Sidebar -->
        <?php require('partials/left_sidebar.php'); ?>
        <!-- #END# Left Sidebar -->        
    </section>
        <?php 
            $result_kontrol = mysqli_query($conn,"SELECT * FROM iot_farm_kontrol");
            $rows_kontrol = array();
            while($r_kontrol = mysqli_fetch_assoc($result_kontrol)) {
                $rows_kontrol[] = $r_kontrol;
            }
            $limit_suhu = $rows_kontrol[1]['value'];
            $limit_lembab_udara = $rows_kontrol[2]['value'];
            $limit_lembab_tanah = $rows_kontrol[3]['value'];
        ?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DATA LOG</h2>
            </div>
            <?php
                $load = mysqli_query($conn, "SELECT * from iot_farm_monitor ORDER BY id DESC");                         
            ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12    col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              MONITORING
                            </h2>                           
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="logTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Action</th>
                                            <th>Suhu Udara</th>
                                            <th>Kelembaban Udara</th>
                                            <th>Kelembaban Tanah</th>
                                            <th>PH Tanah</th>                                            
                                            <th>Waktu</th>
                                           
                                            <th>Gambar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            while ($row = mysqli_fetch_array($load)){
                                                if($row['suhu_udara'] >= $limit_suhu){
                                                    $status_suhu = 'Panas';    
                                                }else{
                                                    $status_suhu = 'Dingin';
                                                }
                                                
                                                if($row['lembab_udara'] <= $limit_lembab_udara){
                                                    $status_udara = 'Kering';    
                                                }else{
                                                    $status_udara = 'Lembab';
                                                }

                                                if($row['lembab_tanah'] >= $limit_lembab_tanah){
                                                    $status_tanah = 'Kering';    
                                                }else{
                                                    $status_tanah = 'Basah';
                                                }
                                                
                                                $nilai_ph = abs(round($row['ph_tanah'],1));
                                                if(intval($nilai_ph) < 7){
                                                    $status_ph = 'Asam';
                                                }else if(intval($nilai_ph) > 7){
                                                    $status_ph = 'Basa';
                                                }else{
                                                    $status_ph = 'Netral';
                                                }

                                                                                                
                                                echo '<tr>';
                                                echo '<td>'.$row['id'].'</td>';
                                                echo "<td><a class='btn btn-danger' href='api/delete_data.php?id=".$row['id']."&gambar=".$row['gambar']."'>Hapus</a></td>";
                                                echo '<td>'.$row['suhu_udara'].' &#8451;<br>'.$status_suhu.'</td>';
                                                echo '<td>'.$row['lembab_udara'].' %<br>'.$status_udara.'</td>';
                                                echo '<td>'.$row['lembab_tanah'].'<br>'.$status_tanah.'</td>';
                                                echo '<td>'.$nilai_ph.'<br>'.$status_ph.'</td>';                                            
                                                echo '<td>'.$row['waktu'].'</td>';
                                               
                                                echo '<td><img src="gambar/'.$row['gambar'].'" alt="'.$row['waktu'].'" class="img-thumbnail"></td>';                                               
                                                echo '</tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>   
                            </div>                                                    
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </section>

    <?php require('partials/scripts.php'); ?>
    <script>
       $(document).ready(function() {

            $('#logTable').DataTable({
                responsive: true,
                "order": [[ 0, "desc" ]]
            });

        });
           
        
    </script>
</body>

</html>