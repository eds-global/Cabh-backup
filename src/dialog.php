<!-- Header-->
<?php include 'partials/header.php' ?>
<!-- /#header -->
<style>
    /* Add margin to the top of the "PARTNERS" section */
    .partners-section {
        margin-top: 40px; /* Adjust the margin as needed */
    }
    .partner-box {
        width: 180px; /* Adjust width as needed */
        height: 180px; /* Adjust height as needed */
        /* background-color: blue; Blue color */
        border-radius: 20px; /* Border radius */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .box-content {
        color: white; /* Text color */
        font-size: 18px; /* Font size */
        font-weight: bold; /* Font weight */
    }
    .col-lg-3 {
        text-align: center;
        margin-bottom: 50px; /* Add margin bottom to create gap between boxes */
    }
    /* Center the last two partner sections */
    .last-partners-section {
        margin-top: 40px;
    }

    .last-partners-section .col-lg-3 {
        margin-bottom: 50px;
    }

    .last-partners-section .col-lg-3:last-child {
        margin-bottom: 0;
    }

</style>

<!-- Content -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <div class="row justify-content-center"> <!-- Centering the content -->
            <!----------------------------------------- Dialog Section --------------------------------------->
            <div class="row partners-section">
                <div class="col-lg-3 text-center" style="margin-top: 20px;">
                    <a href="register1.php">
                        <div class="partner-box" style="background-color: #EDA641; margin-left: 127px;">
                            <p class="box-content">Breathe-in</p>
                        </div>
                        <div class="partner-description" style="margin-top: 20px;">
                            <p style="color: black; margin-left:65px;">Global Trends in Indoor Air Quality Technologies and...</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 text-center" style="margin-top: 20px;">
                    <a href="register2.php">
                        <div class="partner-box" style="background-color: #485E4E; margin-left: 75px;">
                            <p class="box-content">Breathe-in</p>
                        </div>
                        <div class="partner-description" style="margin-top: 20px;">
                            <p style="color: black; margin-right:30px; margin-right:27px;">Healthy Indoors: An exchange of stories, facts and experienced...
                            </p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 text-center" style="margin-top: 20px;">
                    <a href="register3.php">
                        <div class="partner-box" style="background-color: #4D5C95; margin-left: 35px;">
                            <p class="box-content">Breathe-in</p>
                        </div>
                        <div class="partner-description" style="margin-top: 20px;">
                            <p style="color: black; margin-right:99px;">Prioritization of Indoor air contaminants
                            </p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 text-center" style="margin-top: 20px;">
                    <a href="register4.php">
                        <div class="partner-box" style="background-color: #E9BC6D">
                            <p class="box-content">Breathe-in</p>
                        </div>
                        <div class="partner-description" style="margin-top: 20px;">
                            <p style="color: black; margin-right:170px;">Pro Indoor air quality actions
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- .animated -->
</div>
<!-- /.content -->

<div class="clearfix"></div>
<?php include 'partials/footer.php' ?>
<!-- Footer -->