<!-- Header-->
<?php include 'partials/header.php' ?>
<!-- /#header -->
<style>
        /* Add margin to the top of the "PARTNERS" section */
        .partners-section {
            margin-top: 40px; /* Adjust the margin as needed */
            margin-left: 160px;
            margin-right: 140px;
        }
        .partner-logo {
            display: inline-block;
            max-width: 100%;
            height: auto;
            max-height: 150px;
            vertical-align: middle;
        }
        .donor-logo {
            display: block;
            max-width: 80%; /* Allows the image to grow up to double its original width */
            height: auto;
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
            margin-right: 210px; /* Margin on the right side */
            border-radius: 10px;
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
                    <div class="section-heading col-lg-12 text-center">
                        <h2> ABOUT CABH </h2> 
                    </div>
                </div>
                <!-- <div style="background-color: #f2f2f2; padding: 18px;"> -->
                <div class="row" id="grey" style="background-color: #D9D9D9; margin-left : 160px;">
                    <div class="col-lg-6 col-md-6 col-sm-12 about-bg" style="margin-top: 10px;">
                        <div class="about-content">
                            <p style="color: black; margin-left: 70px; ">
                                <b>Cleaner Air and Better Health</b> is a five-year <b>project supported by the United States Agency</b> for
                                International Development. It aims to <b>strengthen air pollution mitigation and reduce exposure to
                                air pollution</b> in India by establishing <b>evidence-based models for better air quality management.</b><br><br>
                                The project is being <b>implemented by a consortium</b> led by the Council on Energy, Environment, and Water 
                                and includes ASAR Social Impact Advisors, Environmental Design Solutions, Enviro-Legal Defence Firm, and Vital 
                                Strategies.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-3 text-center align-self-center">
                        <img src="../images/CABH_logo_rounded.png" alt="CABH Logo" style="max-width: 160%; height: auto;">
                    </div>
                </div>
                 <!-- </div> -->

                <!----------------------------------------- Donor Section --------------------------------------->

                <div class="row partners-section">
                    <div class="col-lg-12 text-center" style="margin-bottom: 20px;">
                    <h4 class="heading-about" style="font-weight: 600;">DONOR</h4>
                    </div>
                    <!-- <div class="col-lg-12 text-center"> <!-- Adjusted for the logo alignment -->
                        <!-- <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-4 text-center">
                                <img class="partner-logo" src="../images/ceew.png" alt="CEEW Logo">
                                <div class="partner-description" style="margin-top: 20px;">
                                    <p style="color: black; margin-left:60px;  margin-right:70px;">The United States Agency for International Development (USAID) is 
                                         the US government’s premier international development agency and a catalytic actor driving
                                         development results across the world. USAID works to help lift lives, build communities, 
                                         and advance democracy. Its work advances US national security and economic prosperity, 
                                         demonstrates American generosity, and helps countries with their development journey. 
                                         In India, USAID is collaborating with the country’s growing human and financial resources
                                         through partnerships that catalyse innovation and entrepreneurship to solve critical local
                                         and global development challenges.

                                         USAID’s air quality programming aims to mitigate and reduce ambient and household air pollution
                                         to reduce adverse health impacts, advance climate change mitigation and adaptation, and promote
                                           inclusive, sustainable development. It is supporting the Cleaner Air and Better Health (CABH) 
                                           project to enable and frame policies and programmes to match the needs of target populations, 
                                           with a focus on gender inclusion.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  -->

                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Logo section (centered within left half) -->
                            <div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
                                <img class="img-fluid donor-logo" src="../images/USAID_new_logo_no_bg.png" alt="USAID Logo">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Text section (right half) -->
                            <div class="partner-description">
                                <p style="color: black;">
                                    The United States Agency for International Development (USAID) is the US government’s premier international development agency and a catalytic actor driving development results across the world. USAID works to help lift lives, build communities, and advance democracy. Its work advances US national security and economic prosperity, demonstrates American generosity, and helps countries with their development journey. In India, USAID is collaborating with the country’s growing human and financial resources through partnerships that catalyse innovation and entrepreneurship to solve critical local and global development challenges.

                                    USAID’s air quality programming aims to mitigate and reduce ambient and household air pollution to reduce adverse health impacts, advance climate change mitigation and adaptation, and promote inclusive, sustainable development. It is supporting the Cleaner Air and Better Health (CABH) project to enable and frame policies and programmes to match the needs of target populations, with a focus on gender inclusion.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- </div> -->

                <!----------------------------------------- Partners Section --------------------------------------->
                <div class="row partners-section">
                    <div class="col-lg-12 text-center" style="margin-bottom: 20px;">
                        <h4 class="heading-about" style="font-weight: 600;"> THE CONSORTIUM </h4>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <img class="partner-logo" src="../images/ceew.png" alt="CEEW Logo">
                        <div class="partner-description" style="margin-top: 20px; margin-left: 160 px;">
                            <p style="color: black; margin-left:60px;">The Council on Energy, Environment and Water is one of Asia’s leading not-for-profit policy research institutions and among the world’s top climate think tanks. The Council uses data, integrated analysis, and strategic outreach to explain - and change - the use, reuse, and misuse of resources. CEEW is the lead organisation focusing on emissions mitigation, market-based approaches, and nudge experiments.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <img class="partner-logo smaller" src="../images/eds_logo.gif" alt="EDS Logo" style="width: 120px;">
                        <div class="partner-description" style="margin-top: 20px;">
                            <p style="color: black; margin-right:30px; margin-left:30px;">Environmental Design Solutions has a wide range of experience in the design, development, and implementation of large-scale programmes both in terms of project investments as well as bundled initiatives for energy efficiency and climate change measures. EDS focuses on reducing exposure through indoor air quality (IAQ) solutions.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <img class="partner-logo smaller" src="../images/asar.png" alt="ASAR Logo" style="width: 110px;">
                        <div class="partner-description" style="margin-top: 30px; margin-right: 140px;">
                            <p style="color: black; margin-right:70px;">Asar Social Impact Advisors created the National Clean Air Collective in 2017 to get organisations, individuals, and groups working on air pollution to collaborate, complement each other's work, and to align on strategy. Asar leads on empowering communities through outreach and awareness initiatives.
                            </p>
                        </div>
                    </div>  
                </div>
                
                <!---------------------------------------- Last two partner sections ---------------------------------------->
                <div class="row last-partners-section justify-content-center" style="margin-top: 1px;">
                    <div class="col-lg-4 text-center">
                        <img class="partner-logo" src="../images/vital.png" alt="Vital Logo" style="width: 140px;">
                        <div class="partner-description">
                            <p style="color: black;">Vital Strategies has programmes spanning 70 countries, and has worked with the government of India – the Ministry of Health and Family Welfare, and the Ministry of Environment, Forest and Climate Change, with local advocates for clean air, and with clinicians to promote clean air and health benefits of scaling clean household energy. Vital Strategies focuses on minimising exposure and health impact from air pollution through health data collection and engagement with the health sector.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <img class="partner-logo smaller" src="../images/eldf.png" alt="ELDF Logo" style="width: 80px;">
                        <div class="partner-description">
                            <p style="color: black;">Enviro-Legal Defence Firm is India’s first environmental law firm, and has dealt with multiple landmark environmental cases that have shaped the course of air quality management across India. ELDF has experience on legal and policy dimensions of air pollution including judicial precedents and leads the CABH project in identifying regulatory reforms, developing a comprehensive legal structure to support pollution control boards.</p>
                        </div>
                    </div>
                </div><br>

                </div> <!-- Closing the existing row here -->

                <!------------------------- Starting a new row for the Contact section ------------------------------>
                <!-- <div class="row">
                    <div class="col-lg-12 text-center">
                        <h4 class="heading-about" style="font-weight: 600;"> CONTACT </h4>
                    </div>
                    <div class="row" style="margin-left:100px; margin-top:10px; Background-color: #D9D9D9; padding-top: 30px;border-radius: 10px;">
                        <div class="col-lg-4 text-center" style="margin-top: 20px; ">
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
                        <div class="col-lg-4 text-center" style="margin-top: 20px;">
                            <div class="partner-description">
                                <p style="color: black; text-align: left; margin-left:99px;">
                                    <b>Om Prakash Singh</b><br>
                                    Chief of Party, Cleaner Air and<br>
                                    Better Health Project<br>
                                    Council on Energy, Environment and Water<br>
                                    Phone: 91-11-073-3300<br>
                                    Email: omprakash.singh@ceew.in
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center" style="margin-top: 20px;">
                            <div class="partner-description">
                                <p style="color: black; text-align: left; margin-left:99px;">
                                    <b>Soumitri Das</b><br>
                                    Project Management Specialist<br>
                                    Environment United States Agency for
                                    International Development<br>
                                    #USAID Phone: +91-11-219-8000<br>
                                    Email: sodas@usaid.gov
                                </p>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h4 class="heading-about" style="font-weight: 600;"> CONTACT </h4>
                    </div>
                    <div class="row" style="margin-left:160px; margin-right: 140px; margin-top:10px; Background-color: #D9D9D9; padding-top: 30px;border-radius: 10px;">
                        <div class="col-lg-4 text-center" style="margin-top: 20px; ">
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
                        <div class="col-lg-4 text-center" style="margin-top: 20px;">
                            <div class="partner-description">
                                <p style="color: black; text-align: left; margin-left:70px;">
                                    <b>Om Prakash Singh</b><br>
                                    Chief of Party, Cleaner Air and<br>
                                    Better Health Project<br>
                                    Council on Energy, Environment and Water<br>
                                    Phone: 91-11-073-3300<br>
                                    Email: omprakash.singh@ceew.in
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center" style="margin-top: 20px;">
                            <div class="partner-description">
                                <p style="color: black; text-align: left; margin-left:99px;">
                                    <b>Soumitri Das</b><br>
                                    Project Management Specialist<br>
                                    Environment United States Agency for
                                    International Development<br>
                                    #USAID Phone: +91-11-219-8000<br>
                                    Email: sodas@usaid.gov
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                 <!------------------------------------- Starting a new row for the Legal section --------------------------------------->
                 <!-- <div class="row" style="margin-top: 30px;">
                    <div class="col-lg-12 text-center">
                        <h4 class="heading-about" style="font-weight: 600;"> LEGAL </h4>
                        <p style="color: black;  text-align: left; margin-left: 160px; margin-right: 140px;">
                        This portal is made possible by the generous support of the American people through the United States Agency for International Development (USAID). The contents do not necessarily reflect the views of USAID or the United States Government.
                            </p>
                    </div>
                    <div class="col-lg-12 text-center">
    <h5 class="heading-useOfInfo custom-left-align" style="font-weight: 600;">Use of Information</h5>
</div>
                    <div class="col-lg-12 text-center" style="margin-top: 20px;">
                        <div class="partner-description">
                            <p style="color: black;  text-align: left; margin-left: 160px; margin-right: 140px;">
                            This portal has been put out in the public domain with the intent of improving public health. While the information herein is free to use, it must not be used for commercial purposes. The data must be duly acknowledged and referenced as well.
                            </p>
                            <p style="color: black;  text-align: left; margin-left: 160px; margin-right: 140px; "><b>Suggested Citation</b><br>
                            Breathe-in: Indoor Air-quality Dashboard (2024) developed by EDS for USAID’s CABH project
                            </p>
                            <p style="color: black;  text-align: left; margin-left: 160px; margin-right: 140px; "><b>Disclaimer</b><br>
                            Data monitoring and acquisition are complex operations susceptible to missing data, hardware failure, and many other challenges. Therefore, while this portal is a culmination of best efforts of technical experts in the indoor air quality and data monitoring & acquisition domain, there may be unexpected outcomes. The user, therefore, agrees to indemnify EDS and its partners against any damages or liabilities arising from the use of information published on this portal.
                        </div>
                    </div>  
                </div> -->

                <div class="row" style="margin-top: 30px;">
                    <div class="col-lg-12 text-center">
                        <h4 class="heading-about" style="font-weight: 600;"> LEGAL </h4>
                        <p style="color: black;  text-align: left; margin-left: 160px; margin-right: 140px;">
                        This portal is made possible by the generous support of the American people through the United States Agency for International Development (USAID). The contents do not necessarily reflect the views of USAID or the United States Government.
                            </p>
                    </div>
                    <!-- <div class="col-lg-12 text-center">
    <h5 class="heading-useOfInfo custom-left-align" style="font-weight: 600;">Use of Information</h5>
</div> -->
                    <div class="col-lg-12 text-center" style="margin-top: 10px;">
                        <div class="partner-description">
                            <p style="color: black;  text-align: left; margin-left: 160px; margin-right: 140px;"><b>Use of Information</b><br>
                            This portal has been put out in the public domain with the intent of improving public health. While the information herein is free to use, it must not be used for commercial purposes. The data must be duly acknowledged and referenced as well.
                            </p>
                            <p style="color: black;  text-align: left; margin-left: 160px; margin-right: 140px; "><b>Suggested Citation</b><br>
                            Breathe-in: Indoor Air-quality Dashboard (2024) developed by EDS for USAID’s CABH project
                            </p>
                            <p style="color: black;  text-align: left; margin-left: 160px; margin-right: 140px; "><b>Disclaimer</b><br>
                            Data monitoring and acquisition are complex operations susceptible to missing data, hardware failure, and many other challenges. Therefore, while this portal is a culmination of best efforts of technical experts in the indoor air quality and data monitoring & acquisition domain, there may be unexpected outcomes. The user, therefore, agrees to indemnify EDS and its partners against any damages or liabilities arising from the use of information published on this portal.
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