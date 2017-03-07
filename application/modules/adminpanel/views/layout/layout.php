<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->load->view('layout/header'); ?>
    </head>
    <body class="flat-blue">
        <div class="app-container">
            <div class="row content-container">
                <!-- top  menu  -->
                <?php echo $this->load->view('layout/top-menu'); ?>
                <div class="side-menu sidebar-inverse">

                    <!-- left menu  -->
                    <?php echo $this->load->view('layout/left-menu'); ?>
                </div>
                <!-- Main Content -->

                <?php echo $admin_body; ?>
                <!-- end of main content  -->
            </div>
            <?php echo $this->load->view('layout/footer'); ?>
            <div>

                <?php echo $this->load->view('layout/footer-includes'); ?>

                </body>

                </html>
