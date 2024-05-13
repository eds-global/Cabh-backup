<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IAQ Dashboard</title>
    <meta name="description" content="IAQ Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo $_SESSION['config']->server_host?>/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?php echo $_SESSION['config']->server_host?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $_SESSION['config']->server_host?>/assets/css/custom.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

   <style>
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }
        .nav-item .active{
            color: black;
        }

       

        
       
       

    </style>
</head>

<body>
    
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel" style="margin-left:0!important">
        <header id="header"  class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="<?php echo $_SESSION['config']->server_host?>/images/usaid.png" alt="Logo"></a>
                    </div>
            </div>
            <div class="top-right">
                <!-- <div class="header-menu"> -->
                    <div class="header-left" >
                    <div class="navbar-header text-right" >
                    <a class="navbar-brand" href="./" style="width:120px; margin-right:0;"><img src="<?php echo $_SESSION['config']->server_host?>/images/EDSlogo.png" alt="Logo" style="max-width:120px; margin-right:0;"></style></a>
                    <a class="navbar-brand" href="./" style="width:120px; margin-right:0;"><img src="<?php echo $_SESSION['config']->server_host?>/images/ceew.png" alt="Logo" style="max-width:130px; margin-right:0;"></a>
                        
                <!-- </div> -->
                    

                       

                       
                    </div>

                    

                </div>
            </div>
        </header>
        <!-- for mobile -->
        <header id="header-row" class="header hidden">
            <div class="row">
                <div class="col-lg-12" style="display:flex">
                    <img src="<?php echo $_SESSION['config']->server_host?>/images/usaid.png" alt="Logo"  style="max-width:30%; margin-right:5px; float:left" class="text-left">
                    <center>
                    <img src="<?php echo $_SESSION['config']->server_host?>/images/EDSlogo.png" alt="Logo" style="max-width:40%; margin-right:auto; margin-left:25%; float:left" class="text-center">
    </center>
                    <img src="<?php echo $_SESSION['config']->server_host?>/images/ceew.png" alt="Logo" style="max-width:20%; margin-right:5px; float:right" class="text-right">
              
                </div>
               
            </div>
            
            
        </header>
        <!-- mobile row finish -->
        <header id="header1" class="header bg-green">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="<?php echo $_SESSION['config']->server_host?>/images/CABH Logo Black.png" alt="Logo"></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu ">
                    <div class="header-left">
                       <?php// echo setMenu();?>
                       

                       <ul class="nav navbar-nav ml-auto " style="flex-direction: row;">
                        
                        <li class="nav-item ">
                            <a href="/home" class="nav-link" id="nav_home">Home</a>
                        </li>
                        <li class="nav-item ">
                            <a href="/dashboard" class="nav-link" id="nav_dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="/breathein" class="nav-link" id="nav_breath">Breathe-in</a>
                        </li>
                        <li class="nav-item">
                            <a href="/about-cabh" class="nav-link" id="nav_about">About <b>CABH</b></a>
                        </li>
                        <li class="nav-item">
                            <a href="/dialog" class="nav-link" id="nav_dialog">Dialogs</a>
                        </li>
                        <?php 
                            if($_SESSION['config']->user == "public"){
                                ?>
                                <li class="nav-item">
                                    <a href="/login" class="nav-link" id="nav_login">Login</a>
                                </li>
                                <?php
                            }
                        
                        ?>
                       </ul>

                      
                        

                       
                    </div>

                    <!-- <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                            <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                            <a class="nav-link" href="#"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div> -->

                </div>
            </div>
        </header>
        <header id="header1-mobile" class="header bg-green mobile-header-menu">
            <div class="text-left" >
                
                <img src="<?php echo $_SESSION['config']->server_host?>/images/cabh-logo.png" style="width:40%">
                        
                
                
            </div>
            <div class="text-right">
                <Strong id="mobile-menu-btn">Menu</strong>
            <ul class=" nav navbar-nav mobile-menu">
                        
                        <li class="nav-item ">
                            <a href="/home" class="nav-link" id="nav_home">Home</a>
                        </li>
                        <li class="nav-item ">
                            <a href="/dashboard" class="nav-link" id="nav_dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="/breathein" class="nav-link" id="nav_breath">Breathe-in</a>
                        </li>
                        <li class="nav-item">
                            <a href="/about-cabh" class="nav-link" id="nav_about">About <b>CABH</b></a>
                        </li>
                        <li class="nav-item">
                            <a href="/dialog" class="nav-link" id="nav_dialog">Dialogs</a>
                        </li>
                        <?php 
                            if($_SESSION['config']->user == "public"){
                                ?>
                                <li class="nav-item">
                                    <a href="/login" class="nav-link" id="nav_login">Login</a>
                                </li>
                                <?php
                            }
                        
                        ?>
                       </ul>
            </div>

            <!-- <div class="top-right">
                <div class="header-menu ">
                    <div class="header-left">
                       
                       

                       <ul class="nav navbar-nav ml-auto " style="flex-direction: row;">
                        
                        <li class="nav-item ">
                            <a href="/home" class="nav-link" id="nav_home">Home</a>
                        </li>
                        <li class="nav-item ">
                            <a href="/dashboard" class="nav-link" id="nav_dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="/breathein" class="nav-link" id="nav_breath">Breathe-in</a>
                        </li>
                        <li class="nav-item">
                            <a href="/about-cabh" class="nav-link" id="nav_about">About <b>CABH</b></a>
                        </li>
                        <li class="nav-item">
                            <a href="/dialog" class="nav-link" id="nav_dialog">Dialogs</a>
                        </li>
                        <?php 
                            if($_SESSION['config']->user == "public"){
                                ?>
                                <li class="nav-item">
                                    <a href="/login" class="nav-link" id="nav_login">Login</a>
                                </li>
                                <?php
                            }
                        
                        ?>
                       </ul>

                      
                        

                       
                    </div>

                    
                </div>
            </div> -->
        </header>
        
        