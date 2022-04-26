<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Demo CodeIgniter con Bootstrap</title>

    <!-- Bootstrap CSS
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     -->
     
    <!--https://getbootstrap.com/docs/4.4/getting-started/introduction/-->
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" />
    
    <!--https://demos.creative-tim.com/now-ui-kit/docs/1.0/getting-started/introduction.html-->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/paper-kit.css">

    
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/modalizar.css">
    
    <!--Scripts-->
    <!--https://sweetalert.js.org/docs/-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!--   Core JS Files   -->
    <script src="<?php echo base_url()?>assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/js/core/bootstrap.min.js" type="text/javascript"></script>

    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="<?php echo base_url()?>assets/js/plugins/bootstrap-switch.js"></script>

    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="<?php echo base_url()?>assets/js/plugins/nouislider.min.js" type="text/javascript"></script>

    <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
    <script src="<?php echo base_url()?>assets/js/plugins/moment.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>

    <!-- Control Center for Paper Kit: parallax effects, scripts for the example pages etc -->
    <script src="<?php echo base_url()?>assets/js/paper-kit.min.js" type="text/javascript"></script>
    
<!-- ESTILOS PERSONALIZADOS -->
<style>    
    .bmenu {
        overflow: hidden;
        background-color: #0033cc;
    }

    .bmenu a {
        float: left;
        font-size: 16px;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    .submenu {
        float: left;
        overflow: hidden;
    }

    .submenu .submenubtn {
        font-size: 16px;  
        border: none;
        outline: none;
        color: white;
        padding: 14px 16px;
        background-color: inherit;
        font-family: inherit;
        margin: 0;
    }

    .bmenu a:hover, .submenu:hover .submenubtn {
        background-color: #009933;
    }

    .submenu-content {
        display: none;
        position: absolute;
        left: 0;
        background-color: #009933;
        width: 100%;
        z-index: 1;
    }

    .submenu-content a {
        float: left;
        color: white;
        text-decoration: none;
    }

    .submenu-content a:hover {
        background-color: #33cc33;
        color: black;
    }

    .submenu:hover .submenu-content {
        display: block;
    }
</style>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12" id="divTabla">
                <?php $this->load->view('inicio/login'); ?>
            </div>
        </div>
    </div>
</body>
</html>