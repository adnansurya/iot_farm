<!DOCTYPE html>
<html>
<head>
    <title>Home | IOT Farm</title>
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

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DATA TANAMAN</h2>
            </div>
            <?php
                $load = mysqli_query($conn, "SELECT * from iot_farm_monitor  ORDER BY id DESC LIMIT 1;");               
                $last_row = mysqli_fetch_array($load);
            ?>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               SUHU UDARA
                            </h2>                           
                        </div>
                        <div class="body">
                            <p class="lead">
                                <?php echo $last_row['suhu_udara']; ?>
                            </p>                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               KELEMBABAN UDARA
                            </h2>                           
                        </div>
                        <div class="body">
                            <p class="lead">
                               <?php echo $last_row['lembab_udara']; ?>
                            </p>                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               PH TANAH
                            </h2>                           
                        </div>
                        <div class="body">
                            <p class="lead">
                                <?php echo $last_row['ph_tanah']; ?>
                            </p>                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              KELEMBABAN TANAH
                            </h2>                           
                        </div>
                        <div class="body">
                            <p class="lead">
                                <?php echo $last_row['lembab_tanah']; ?>
                            </p>                            
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </section>

    <?php require('partials/scripts.php'); ?>
</body>

</html>