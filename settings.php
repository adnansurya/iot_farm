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
                            <div class="switch">
                                <label>
                                Off
                                <input type="checkbox" id="pompaSw">
                                <span class="lever"></span>
                                On
                                </label>
                            </div>                           
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </section>

    <?php require('partials/scripts.php'); ?>
    <script>
        $(function() {
  // hooking event only on buttons, can do tr's as well.
            $('#pompaSw').click(function(){
                let params = 'pompa';
                let switch_;
                if($(this).prop('checked')){
                    switch_ = 'ON';
                }else{
                    switch_ = 'OFF';
                }
                $.ajax({
                url: 'api/update_settings.php',
                type: 'post',
                data: {
                    params : params,
                    value: switch_
                },
               
                success: function(response){
                    console.log(response);
                    
                    // if(response.success){
                  
                    //    console.log(response.message);
                    // } else {
                    //     console.log('gagal');
                        
                    // }
                },
                error: function(xhr, textStatus, errorThrown) {
                   console.log(textStatus);
                             
                }
                });
            });
        });
    </script>
</body>

</html>