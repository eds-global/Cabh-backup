<!-- Header-->
<?php include 'partials/header.php' ?>
<!-- /#header -->
<style>
        /* Add margin to the top of the "PARTNERS" section */
        .partners-section {
            margin-top: 40px; /* Adjust the margin as needed */
        }
        .partner-logo {
            display: inline-block;
            max-width: 100%;
            height: auto;
            max-height: 150px;
            vertical-align: middle;
        }
        .col-lg-4 {
            text-align: center;
            margin-bottom: 50px; /* Add margin bottom to create gap between images */
        }
        .smaller {
            max-height: 120px; /* Adjust the height for smaller size */
        }
        /* Center the last two partner sections */
        .last-partners-section {
            margin-top: 40px;
        }

        .last-partners-section .col-lg-4 {
            margin-bottom: 50px;
        }

        .last-partners-section .col-lg-4:last-child {
            margin-bottom: 0;
        }

        .last-partners-section .partner-logo {
            max-width: 100%;
            height: auto;
            max-height: 150px;
            vertical-align: middle;
            margin-bottom: 20px;
        }

        .last-partners-section .partner-description {
            margin-bottom: 20px;
        }

        #grey {
            background-color: #f3f3f3; /* Light grey background color */
            padding: 0px; /* Add padding to the div */
            margin-left: 90px; /* Margin on the left side */
            margin-right: 140px; /* Margin on the right side */
        }

        #grey .about-content {
            padding: 2px; /* Add padding to the content inside the div */
        }

        #grey p {
            color: black; 
        }

        #grey img {
            max-width: 56%; /* Set maximum width for images */
            height: 50px; /* Maintain aspect ratio */
        }

    </style>

<!-- Content -->
<div class="content">
        <!-- Animated -->
        <div class="animated fadeIn">
            <div class="row justify-content-center"> <!-- Centering the content -->
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h4 class="heading-about"> ABOUT CABH </h4>
                    </div>
                </div>
                <!-- <div style="background-color: #f2f2f2; padding: 18px;"> -->
                    <div class="row" id="grey">
                        <div class="col-lg-6 about-bg" style="margin-top: 20px;">
                            <div class="about-content">
                                <p style="color: black; margin-left: 220px;">
                                    Cleaner Air and Better Health is a five-year project supported by the United States Agency for
                                    International Development. It aims to strengthen air pollution mitigation and reduce exposure to
                                    air pollution in India by establishing evidence-based models for better air quality management.<br><br>
                                    The project is being implemented by a consortium led by the Council on Energy, Environment, and Water 
                                    and includes ASAR Social Impact Advisors, Environmental Design Solutions Defence Firm, and Vital Strategies 
                                    Legal.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4 text-center align-self-center">
                            <img src="../images/cabh_about.png" alt="CABH Logo" style="max-width: 116%; height: auto;">
                        </div>
                    </div>
                <!-- </div> -->

                <!----------------------------------------- Partners Section --------------------------------------->
                <div class="row partners-section">
                    <div class="col-lg-12 text-center">
                        <h4 class="heading-about"> PARTNERS </h4>
                    </div>
                    <div class="col-lg-4 text-center" style="margin-top: 20px;">
                        <img class="partner-logo" src="../images/ceew.png" alt="CEEW Logo" style="width: 130px;">
                        <div class="partner-description" style="margin-top: 20px;">
                            <p style="color: black; margin-left:60px;">CEEW is one of Asia's leading not-for-profit policy research institutions. 
                                It prides itself on the independence of its high-quality research.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center" style="margin-top: 20px;">
                        <img class="partner-logo smaller" src="../images/eds_logo.gif" alt="EDS Logo" style="width: 160px;">
                        <div class="partner-description" style="margin-top: 20px;">
                            <p style="color: black; margin-right:30px; margin-left:30px;">EDS is another leading organization in the field. 
                                Their commitment to excellence drives their research initiatives.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center" style="margin-top: 20px;">
                        <img class="partner-logo smaller" src="../images/asar.png" alt="ASAR Logo" style="width: 180px;">
                        <div class="partner-description" style="margin-top: 20px;">
                            <p style="color: black; margin-right:70px;">ASAR is known for its innovative approach to policy analysis. 
                                They strive to make a meaningful impact in the region.
                            </p>
                        </div>
                    </div>  
                </div>
                
                <!---------------------------------------- Last two partner sections ---------------------------------------->
                <div class="row last-partners-section justify-content-center" style="margin-top: 1px;">
                    <div class="col-lg-4 text-center">
                        <img class="partner-logo" src="../images/vital.png" alt="Vital Logo" style="width: 290px;">
                        <div class="partner-description">
                            <p style="color: black;">Vital Strategies Legal is dedicated to improving public health around the world.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <img class="partner-logo smaller" src="../images/eldf.png" alt="ELDF Logo">
                        <div class="partner-description">
                            <p style="color: black;">ELDF is committed to promoting sustainable development through legal advocacy.</p>
                        </div>
                    </div>
                </div><br>

                </div> <!-- Closing the existing row here -->

                <!------------------------- Starting a new row for the Contact section ------------------------------>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h4 class="heading-about"> CONTACT </h4>
                    </div>
                    <div class="row" style="background-color: #f2f2f2; margin-left:250px; margin-top:10px;">
                        <div class="col-lg-4 text-center">
                            <div class="partner-description">
                                <p style="color: black; text-align: left; margin-left:20px;">
                                    <b>Lakshmy Narayankutty</b><br>
                                    Program Manager- Breathein,<br>
                                    Environmental Design Solutions<br>
                                    Private Limited<br>
                                    Phone: 91-11-056-8633<br>
                                    Email: Lakshmy@edsglobal.com
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <div class="partner-description">
                                <p style="color: black; text-align: left;">
                                    <b>Om Prakash Singh</b><br>
                                    Chief of Party, Cleaner Air and<br>
                                    Better Health Project<br>
                                    Council on Energy, Environment and Water<br>
                                    Phone: 91-11-073-3300<br>
                                    Email: omprakash.singh@ceew.in
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <div class="partner-description">
                                <p style="color: black; text-align: left;">
                                    <b>Soumitri Das</b><br>
                                    Project Management Specialist<br>
                                    Environment United States Agency for<br>
                                    International Development<br>
                                    #USAID Phone: +91-11-219-8000<br>
                                    Email: sodas@usaid.gov
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                 <!------------------------------------- Starting a new row for the Legal section --------------------------------------->
                 <div class="row" style="margin-top: 30px;">
                    <div class="col-lg-12 text-center">
                        <h4 class="heading-about"> LEGAL </h4>
                    </div>
                    <div class="col-lg-12 text-center" style="margin-top: 20px;">
                        <div class="partner-description">
                            <p style="color: black;  text-align: left; margin-left: 90px;">
                                The portal has been put out in the public domain with intent of having public health. 
                                While the data is free to use, it must be duly acknowledged and referanced. Please refere 
                                suggested citation and disclaimers below.
                            </p>
                            <p style="color: black;  text-align: left; margin-left: 90px;"><b>Suggested Citation</b><br>
                            Information from Clean Air Better Health program 1202 compiledon BreathDashboard by EDS for 
                            USAID and CEE Please acknowledge this source while using information from this portal Select from 
                            MLA, APA and Harvard styles for generating citation.</p>
                        </div>
                    </div>  
                </div>

            </div>
        </div>
        <!-- .animated -->
    </div>
    <!-- /.content -->

    <div class="clearfix"></div>
<!-- Footer -->
<?php include 'partials/footer.php' ?>
<!-- /#footer -->