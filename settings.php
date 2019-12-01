<!DOCTYPE html>
<html>

<head>
    <title>Settings | IOT Farm</title>
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

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>PENGATURAN</h2>
            </div>
            <div class="row clearfix">               
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                PENYIRAMAN OTOMATIS
                            </h2>                           
                        </div>
                        <div class="body">
                        <!--<div class="row">-->
                        <!--    <label>-->
                        <!--        <input type="checkbox" id="pompaSw">-->
                        <!--        <span>Aktif</span>-->
                        <!--    </label>-->
                        <!--</div>-->
                            <div class="row">
                                <div class="col-md-6">  
                                    <p>Suhu Udara (Celcius)</p>                              
                                    <input id="suhuUdaraTxt" class="form-control" type="number" min="0" max="59"/>
                                </div>                                 
                                <div class="col-md-6">
                                    <p>Kelembaban Udara (%)</p>
                                    <input id="lembabUdaraTxt" class="form-control" type="number" min="0" max="59"/>
                                </div> 
                                <div class="col-md-12">
                                    <p>Kelembaban Tanah</p>
                                    <input id="lembabTanahTxt" class="form-control" type="number" min="0" max="1024"/>
                                </div>                              
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               PERIODE UPDATE DATA
                            </h2>                           
                        </div>
                        <div class="body">
                        <div class="row">
                                <div class="col-md-3">
                                   <input id="angkaTxt" class="form-control" type="number" min="0" max="59"/>
                                </div>
                                <div class="col-md-9">
                                    <select id="waktuSel" class="form-control show-tick">
                                        <option value="" disabled>-- Please select --</option>
                                        <option value="sec">Detik</option>
                                        <option value="min">Menit</option>
                                        <option value="hour">Jam</option>
                                        <option value="day">Hari</option>
                                        <option value="month">Bulan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </section>

    <?php require('partials/scripts.php'); ?>
    <?php require('api/db_access.php'); ?>
    <?php 
    
        function get_value($koneksi, $params){
            $parameter = $params;
            $result = mysqli_query($koneksi,"SELECT * FROM iot_farm_kontrol WHERE params='" .$params. "'");
            $row = mysqli_fetch_assoc($result);
            return $row['value'];
        }
    ?>
    <script>

        function updateAJAX(params, value){
            $.ajax({
                url: 'api/update_settings.php',
                type: 'post',
                data: {
                    params : params,
                    value: value
                },
               
                success: function(response){
                    console.log(response);                                    
                },
                error: function(xhr, textStatus, errorThrown) {
                   console.log(textStatus);
                             
                }
                });
        }
        $(function() {
            $("#angkaTxt").val('<?php echo get_value($conn, 'angka_periode'); ?>');
            $("#angkaTxt").change(function(){ 
                let angka = $('#angkaTxt').val();
                updateAJAX('angka_periode', angka);
            });       
            
            $("#waktuSel").val('<?php echo get_value($conn, 'waktu_periode'); ?>');
            $("#waktuSel").change(function(){                
                let waktu = $('#waktuSel').val();
                updateAJAX('waktu_periode', waktu);                
            });

            $("#suhuUdaraTxt").val('<?php echo get_value($conn, 'limit_suhu'); ?>');
            $("#suhuUdaraTxt").change(function(){                
                let suhu = $('#suhuUdaraTxt').val();
                updateAJAX('limit_suhu', suhu);                
            });

            $("#lembabUdaraTxt").val('<?php echo get_value($conn, 'limit_lembab_udara'); ?>');
            $("#lembabUdaraTxt").change(function(){                
                let lembab_udara = $('#lembabUdaraTxt').val();
                updateAJAX('limit_lembab_udara', lembab_udara);                
            });

            $("#lembabTanahTxt").val('<?php echo get_value($conn, 'limit_lembab_tanah'); ?>');
            $("#lembabTanahTxt").change(function(){                
                let lembab_tanah = $('#lembabTanahTxt').val();
                updateAJAX('limit_lembab_tanah', lembab_tanah);                
            });

            let pompaStat = '<?php echo get_value($conn, 'penyiraman'); ?>';
            
            $('#pompaSw').click(function(){                
                let switch_;
                if($(this).prop('checked')){
                    switch_ = 'ON';
                }else{
                    switch_ = 'OFF';
                }
                updateAJAX('penyiraman', switch_);
                
            });
        });
    </script>
</body>

</html>