<?php error_reporting(0); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta property="og:title" content="Project Management System">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">
        <meta property="og:site_name" content="Project Management System">
        <meta name="csrf-token" content="XYZ123">

 <!--<meta http-equiv='refresh' content='5;url=<?php echo frontend_url('login'); ?>'>-->
        <?php echo $this->load->view('layout/header'); ?>

    </head>
    <body class="flat-blue">
        <!-- top  menu  -->
        <?php echo $this->load->view('layout/top-menu'); ?>

        <!-- Main Content -->		

        <?php echo $site_body; ?>

        <!-- end of main content  -->

        <?php echo $this->load->view('layout/footer'); ?>

        <?php // echo $this->load->view('layout/footer-includes'); ?>


    </body>

</html>
