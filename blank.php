<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Blank Page | Bootstrap Based Admin Template - Material Design</title>
    <?php require('partials/head.php'); ?>
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <?php require('partials/page_loader.php'); ?>
    <!-- #END# Page Loader -->

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Top Bar -->
    <?php require('partials/top_bar.php'); ?>
    <!-- #Top Bar -->

    <!-- Search Bar -->
    <?php require('partials/search_bar.php'); ?>
    <!-- #END# Search Bar -->

    <section>
        <!-- Left Sidebar -->
        <?php require('partials/left_sidebar.php'); ?>
        <!-- #END# Left Sidebar -->

        <!-- Right Sidebar -->
        <?php require('partials/right_sidebar.php'); ?>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>BLANK PAGE</h2>
            </div>
        </div>
    </section>

    <?php require('partials/scripts.php'); ?>
</body>

</html>