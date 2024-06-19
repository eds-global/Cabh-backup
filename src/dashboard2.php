<!-- Header-->   
<?php include 'partials/header.php' ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- /#header -->

<!-- Content -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        
        <!-- map -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Map card -->
                <div class="card">
                    <div class="card-body" >
                        
                        <div class="row">
                            <!-- place map here-->
                            <div class="col-lg-9">
                                <h4 class="dashboard_title text-center">Map</h4>
                                <div id="map" style="position: relative; overflow:hidden; width:100%; height:470px "></div>
                                <span class="note"><b>Note: </b> map pin showing max value of selected pollutants for last hour</span>
                            </div>
                            <div class="col-lg-3">
                                <!-- Pollutants-->
                                <div class="row text-center " style="margin-top:10px; margin-bottom:10px; ">  <!-- display:block -->
                                    <h4>Pollutants:</h4>
                                    <button type="button" class="btn active" id="btnaqi_map" name="btnaqi_map" >AQI</button>
                                    <button type="button" class="btn" id="btnpm25_map" name="btnpm25_map" >PM<sub>2.5</sub> </button>
                                    <button type="button" class="btn" id="btnpm10_map" name="btnpm10_map" >PM<sub>10</sub></button>
                                    <button type="button" class="btn" id="btnco2_map" name="btnco2_map">CO<sub>2</sub></button>
                                    <button type="button" class="btn" id="btntvoc_map" name="btntvoc_map"  >TVOC</button>
                                </div>

                                <!-- Typology-->
                                <div class="row text-center " style="margin-top:10px; margin-bottom:10px;"> 
                                    <h4>Typology:</h4>
                                    <button type="button" class="btn_typology" id="btnResidential_map" name="btnResidential_map" onClick="document.getElementById('residential_row').scrollIntoView();" >Residential</button>
                                    <button type="button" class="btn_typology" id="btnOffice_map" name="btnOffice_map" onclick="scrollToOffice()">Office</button>
                                    <button type="button" class="btn_typology" id="btnSchool_map" name="btnSchool_map" disabled>School</button>
                                </div>
                                <!-- Pin Info-->
                                <div class="row text-center " style="margin-top:10px; margin-bottom:10px; "> 
                                    <div class="card">
                                        <div class="card-body map-card">
                                            <span id="monitor_count">0</span> monitors
                                        </div>
                                    </div>
                                </div>

                                <!-- map legend-->
                                <div class="row " style="float:right" > 
                                    <div class="map-legend" >
                                        <span class="indoor" style="width:40px; padding:10px;float:none;"> Indoor </span>
                                        <span class="outdoor" style="width:40px; padding:10px; "> outdoor </span>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /# Map card -->
            </div>                  
        </div>
        <!-- /#map -->

        <!-- chart2 - box plot chart (Residential typology) -->
        <div class="row" id="residential_row">
            <div class="col-lg-12">
                <!-- line chart card -->
                <div class="card">
                    <div class="card-body" >
                        <!-- filter -->
                        <div class="row">
                            <div class="col-lg-9">
                                <!-- box chart --> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-body" >
                                            <h4 class="dashboard_title text-center">Plot for Residential Typology</h4>
                                            <div class="col-lg-6 col-md-6" style="align-content: end; margin-left:80px; margin-bottom:-10px;">
                                                <input type="button" class="btn_duration active" id="btnduration1d_R_boxplot" name="btnduration1d_R_boxplot" value="1d">
                                                <input type="button" class="btn_duration" id="btnduration7d_R_boxplot" name="btnduration7d_R_boxplot" value="7d"   >
                                                <input type="button" class="btn_duration" id="btnduration30d_R_boxplot" name="btnduration30d_R_boxplot" value="30d"  >
                                                <input type="button" class="btn_duration" id="btndurationAll_R_boxplot" name="btndurationAll_R_boxplot" value="All"  >
                                            </div>
                                            <input type="hidden" id="hid_duration_R_boxplot" name="hid_duration_R_boxplot" value="24hour">
                                            <input type="hidden" id="hid_pollutants_R_boxplot" name="hid_pollutants_R_boxplot" value="aqi">
                                            <div id="boxchart1" name="boxchart1" style="position: relative; overflow:hidden; width: 100%; height:380px "></div>
                                            <span class="note"><b>Note: </b>Chart showing box plot data for indoor sensor of Residential typology</span>
                            
                                        </div>
                                    </div>
                                </div>
                                <!-- /# box chart -->
                            </div>
                            <div class="col-lg-3">
                                <!-- Pollutants-->
                                <div class="row text-center " style="margin-top:10px; margin-bottom:10px; display:block"> 
                                    <h4>Pollutants:</h4>
                                    <button type="button" class="btn active" id="btnaqi_R_box" name="btnaqi_R_box" >AQI</button>
                                    <button type="button" class="btn" id="btnpm25_R_box" name="btnpm25_R_box" >PM<sub>2.5</sub></button>
                                    <button type="button" class="btn" id="btnpm10_R_box" name="btnpm10_R_box" >PM<sub>10</sub> </button>
                                    <button type="button" class="btn" id="btnco2_R_box" name="btnco2_R_box">CO<sub>2</sub></button>
                                    <button type="button" class="btn" id="btntvoc_R_box" name="btntvoc_R_box"  >TVOC</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div>                  
        </div>
        <!-- /#chart1 - box plot chart (Residential typology)-->

        <!-- chart2 - box plot chart (Office typology) -->
        <div class="row" id="office_row">
            <div class="col-lg-12">
                <!-- line chart card -->
                <div class="card">
                    <div class="card-body" >
                        <!-- filter -->
                        <div class="row">
                            <div class="col-lg-9">
                                <!-- box chart --> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-body" >
                                            <h4 class="dashboard_title text-center">Plot for Office Typology</h4>
                                            <div class="col-lg-6 col-md-6" style="align-content: end; text-align: center;">
                                                <input type="button" class="btn btn_duration" id="btnduration1d_O_boxplot" name="btnduration1d_O_boxplot" value="1d">
                                                <input type="button" class="btn btn_duration" id="btnduration7d_O_boxplot" name="btnduration7d_O_boxplot" value="7d"   >
                                                <input type="button" class="btn btn_duration" id="btnduration30d_O_boxplot" name="btnduration30d_O_boxplot" value="30d"  >
                                                <input type="button" class="btn btn_duration" id="btndurationAll_O_boxplot" name="btndurationAll_O_boxplot" value="All"  >
                                            </div>
                                            <input type="hidden" id="hid_duration_boxplot_office" name="hid_duration_boxplot_office" value="24hour">
                                            <div id="boxchart1_office" name="boxchart1_office" style="position: relative; overflow:hidden; width: 100%; height:380px "></div>
                                            <span class="note"><b>Note: </b>Chart showing box plot data for indoor sensor of Office typology</span>
                            
                                        </div>
                                    </div>
                                </div>
                                <!-- /# box chart -->
                            </div>
                            <div class="col-lg-3">
                                <!-- Pollutants-->
                                <div class="row text-center " style="margin-top:10px; margin-bottom:10px; display:block"> 
                                    <h4>Pollutants:</h4>
                                    <button type="button" class="btn" id="btnpm25_O_box" name="btnpm25_O_box" >PM<sub>2.5</sub> (µg/m<sup>3</sup>)</button>
                                    <button type="button" class="btn" id="btnpm10_O_box" name="btnpm10_O_box" >PM 10 (µg/m<sup>3</sup>)</button>
                                    <button type="button" class="btn" id="btnaqi_O_box" name="btnaqi_O_box" >AQI</button>
                                    <button type="button" class="btn" id="btnco2_O_box" name="btnco2_O_box">CO<sub>2</sub> (ppm)</button>
                                    <button type="button" class="btn" id="btntvoc_O_box" name="btntvoc_O_box"  >TVOC (µg/m<sup>3</sup>)</button>
                                </div>
                            </div>                     
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div>                  
        </div>
        <!-- /#chart1 - box plot chart (Office typology)-->

        <!-- chart1 - line chart for single sensor-->
        <div class="row">
            <div class="col-lg-12">
                <!-- line chart card -->
                <div class="card">
                    <div class="card-body" >
                        <!-- filter -->
                        <div class="row">
                            <div class="col-lg-9">
                                <!-- box chart --> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-body" >
                                            <h4 class="dashboard_title text-center">Plot for Single Sensor</h4>
                                            <div class="col-lg-6 col-md-6" style="align-content: end; text-align: center;">
                                                <input type="button" class="btn btn_duration" id="btnduration1d_O_sensor" name="btnduration1d_O_sensor" value="1d">
                                                <input type="button" class="btn btn_duration" id="btnduration7d_O_sensor" name="btnduration7d_O_sensor" value="7d"   >
                                                <input type="button" class="btn btn_duration" id="btnduration30d_O_sensor" name="btnduration30d_O_sensor" value="30d"  >
                                                <input type="button" class="btn btn_duration" id="btndurationAll_O_sensor" name="btndurationAll_O_sensor" value="All"  >
                                            </div>
                                            <input type="hidden" id="hid_duration" name="hid_duration" value="24hour">
                                            <div id="linechart1" name="linechart1" style="position: relative; overflow:hidden; width: 100%; height:380px "></div>
                                            <span class="note"><b>Note: </b>Chart showing line plot for indoor sensor of '1202240025' device</span>
                            
                                        </div>
                                    </div>
                                </div>
                                <!-- /# box chart -->

                            </div>
                            <div class="col-lg-3">
                                <!-- Pollutants-->
                                <div class="row text-center " style="margin-top:10px; margin-bottom:10px; display:block"> 
                                    <h4>Pollutants:</h4>
                                    <button type="button" class="btn" id="btnpm25_sensor" name="btnpm25_O_box" >PM<sub>2.5</sub> (µg/m<sup>3</sup>)</button>
                                    <button type="button" class="btn" id="btnpm10_sensor" name="btnpm10_sensor" >PM 10 (µg/m<sup>3</sup>)</button>
                                    <button type="button" class="btn" id="btnaqi_sensor" name="btnaqi_sensor" >AQI</button>
                                    <button type="button" class="btn" id="btnco2_sensor" name="btnco2_sensor">CO<sub>2</sub> (ppm)</button>
                                    <button type="button" class="btn" id="btntvoc_sensor" name="btntvoc_sensor"  >TVOC (µg/m<sup>3</sup>)</button>
                                </div>
                            </div>                           
                            
                        </div>
                        

                    </div>
                </div>
                <!-- /# card -->
            </div>                  
        </div>
        <!-- /#chart1 - line chart -->

        

    </div>
    <!-- .animated -->
</div>
        
<!-- /.content -->
<div class="clearfix"></div>
<!-- Footer -->
<?php include 'partials/footer.php' ?>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2jlT6C_to6X1mMvR9yRWeRvpIgTXgddM"></script>

    <script src="assets/js/lib/gmap/gmaps.js"></script>
    <script src="assets/js/init/gmap-init.js"></script> -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.1.2/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.1.2/mapbox-gl.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- load pins on map script -->
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiZGV2LW5pa3VuaiIsImEiOiJjbHMwYTNmdnowMDFxMmpyNTBteHoybTRwIn0.OEzenC6wBOTbqZXCUNoE7A';
        var map = new mapboxgl.Map({
        container: 'map', // container ID
        style: 'mapbox://styles/mapbox/light-v11',
        center: [77.2, 28.55], // starting position [lng, lat] [77.2, 28.58]
        scrollZoom: false, // Disable scroll zoom
        dragPan: false, // Disable drag pan
        zoom: 10.5 // starting zoom //10

        });

        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        const raw = JSON.stringify({
        //"active": 1,
        //"primary_sensor": 1
        });

        const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
        };
        
        var dep_data;
        // Fetch data from API
        fetch("https://iaq-dashboard.edsglobal.com/api/dashboard/getPinData", requestOptions)
        .then(response => response.json())
        .then(data => {
            console.log(data.Data)
            total_pin = data.RowCount;
            $('#monitor_count').text(total_pin);
            if (!Array.isArray(data.Data)) {
                throw new Error('Data is not an array');
            }
            // Process API response data
            dep_data = data.Data
            dep_data.forEach(function(markerData) {
            // Create a marker element
            console.log(markerData.longitude+" " + markerData.latitude)
            var el = document.createElement('div');
            el.className = 'marker'; //'marker';

            var el_1 = document.createElement('div');
            el_1.className = 'indoor'; //'marker';
            el_1.textContent = markerData.max_pm25;

            var el_2 = document.createElement('div');
            el_2.className = 'outdoor'; //'marker';
            el_2.textContent = markerData.outdoor_pm25;

            el.appendChild(el_1);
            el.appendChild(el_2);
            
            //el.textContent = markerData.max_pm25+ " | " + markerData.outdoor_pm25; 

            // Create a marker on the map
            new mapboxgl.Marker(el)
                .setLngLat([parseFloat(markerData.longitude), parseFloat(markerData.latitude)])
                //.setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
                //.setHTML('<p><b>Indoor(PM2.5) :</b><br> ' + markerData.max_pm25  + '</p>'))
                .addTo(map);
                
            });
            
        })
        .catch(error => {
            console.error('Error fetching data from API:', error);
        });

        // Listen for click event on pullutants buttons
        $('#btnpm25_map').click(function() {
            $(this).addClass('active');
            $('#btnpm10_map').removeClass('active')
            $('#btnaqi_map').removeClass('active')
            $('#btnco2_map').removeClass('active')
            $('#btntvoc_map').removeClass('active')
            updateMap("pm25");
        });
        $('#btnpm10_map').click(function() {
            $(this).addClass('active');
            $('#btnpm25_map').removeClass('active')
            $('#btnaqi_map').removeClass('active')
            $('#btnco2_map').removeClass('active')
            $('#btntvoc_map').removeClass('active')
            updateMap("pm10");
        });
        $('#btnaqi_map').click(function() {
            $(this).addClass('active');
            $('#btnpm25_map').removeClass('active')
            $('#btnpm10_map').removeClass('active')
            $('#btnco2_map').removeClass('active')
            $('#btntvoc_map').removeClass('active')
            updateMap("aqi");
        });
        $('#btnco2_map').click(function() {
            $(this).addClass('active');
            $('#btnpm25_map').removeClass('active')
            $('#btnpm10_map').removeClass('active')
            $('#btnaqi_map').removeClass('active')
            $('#btntvoc_map').removeClass('active')
            updateMap("co2");
        });
        $('#btntvoc_map').click(function() {
            $(this).addClass('active');
            $('#btnpm25_map').removeClass('active')
            $('#btnpm10_map').removeClass('active')
            $('#btnaqi_map').removeClass('active')
            $('#btnco2_map').removeClass('active')
            updateMap("voc");
        });
        

        //typology button click redirect
        
        /* $('#btnResidential_map').click(function(e) {
            console.log("residential button click");
            e.target.href = '#residential_row';
        }); */

        // function to handle click event of pollutants button on Map
        function updateMap(pollutant){
            $( ".marker" ).remove();
            // Create a marker on the map
            dep_data.forEach(function(markerData) {
                // Create a marker element
                console.log(markerData.longitude+" " + markerData.latitude)
                var el = document.createElement('div');
                el.className = 'marker'; //'marker';
                

                // Create a marker on the map
                if(pollutant == "pm25"){
                    var el_1 = document.createElement('div');
                    el_1.className = 'indoor'; //'marker';
                    el_1.textContent = markerData.max_pm25;

                    var el_2 = document.createElement('div');
                    el_2.className = 'outdoor'; //'marker';
                    el_2.textContent = markerData.outdoor_pm25;

                    el.appendChild(el_1);
                    el.appendChild(el_2);
                    //el.textContent =  markerData.max_pm25 + " | " + markerData.outdoor_pm25 ;
                    el.style.width= "75px";
                    new mapboxgl.Marker(el)
                        .setLngLat([parseFloat(markerData.longitude), parseFloat(markerData.latitude)])
                        //.setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
                        //.setHTML('<p><b>Indoor(PM2.5) :</b><br> ' + markerData.max_pm25  + '</p>'))
                        .addTo(map);
                }
                if(pollutant == "pm10"){
                    var el_1 = document.createElement('div');
                    el_1.className = 'indoor'; //'marker';
                    el_1.textContent = markerData.max_pm10;

                    var el_2 = document.createElement('div');
                    el_2.className = 'outdoor'; //'marker';
                    el_2.textContent = markerData.outdoor_pm10;

                    el.appendChild(el_1);
                    el.appendChild(el_2);
                    //el.textContent = markerData.max_pm10 + " | " + markerData.outdoor_pm10 ;
                    el.style.width= "75px";
                    new mapboxgl.Marker(el)
                        .setLngLat([parseFloat(markerData.longitude), parseFloat(markerData.latitude)])
                        //.setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
                        //.setHTML('<p><b>Indoor(PM10) :</b><br> ' + markerData.max_pm10  + '</p>'))
                        .addTo(map);
                }
                if(pollutant == "aqi"){
                    var el_1 = document.createElement('div');
                    el_1.className = 'indoor'; //'marker';
                    el_1.textContent = markerData.max_aqi;

                    var el_2 = document.createElement('div');
                    el_2.className = 'outdoor'; //'marker';
                    el_2.textContent = markerData.outdoor_aqi;

                    el.appendChild(el_1);
                    el.appendChild(el_2);
                    //el.textContent = markerData.max_aqi + " | " + markerData.outdoor_aqi ;;
                    el.style.width= "75px";
                    new mapboxgl.Marker(el)
                        .setLngLat([parseFloat(markerData.longitude), parseFloat(markerData.latitude)])
                        //.setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
                        //.setHTML('<p><b>Indoor(AQI) :</b><br> ' + markerData.max_aqi  + '</p>'))
                        .addTo(map);
                }
                if(pollutant == "co2"){

                    el.textContent = markerData.max_co2;
                    el.style.width= "40px";
                    el.style.padding= "10px 0 0 0";
                    new mapboxgl.Marker(el)
                        .setLngLat([parseFloat(markerData.longitude), parseFloat(markerData.latitude)])
                        //.setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
                        //.setHTML('<p><b>Indoor(CO<sub>2</sub>) :</b><br> ' + markerData.max_co2  + '</p>'))
                        .addTo(map);
                }
                if(pollutant == "voc"){
                    el.textContent = markerData.max_voc;
                    el.style.width= "40px";
                    el.style.padding= "10px 0 0 0";

                    new mapboxgl.Marker(el)
                        .setLngLat([parseFloat(markerData.longitude), parseFloat(markerData.latitude)])
                        //.setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
                        //.setHTML('<p><b>Indoor(VOC) :</b><br> ' + markerData.max_voc  + '</p>'))
                        .addTo(map);
                }
            });
        
        }
        updateMap("aqi");

        
        
        



    
    </script>
    <!-- /# load pins on map script -->
    <script>
        function scrollToOffice() {
            var element = document.getElementById('office_row');
            var headerOffset = 145;
            var elementPosition = element.getBoundingClientRect().top;
            var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
        
            window.scrollTo({
                top: offsetPosition,
                behavior: "smooth"
            });   
        }
    </script>

    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- for linechart  -->
    
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="<?php echo $_SESSION['config']->server_host?>/chart_JS_api/linechart1.js"></script>
    <script src="<?php echo $_SESSION['config']->server_host?>/chart_JS_api/boxplot_2.js"></script>

    <script>
        // script for updating line chart
        
        $(document).ready(function() {
            var post_url = '<?php echo $_SESSION['config']->server_host?>/chartData/linechart.php';
            var duration = $('#hid_duration').val();
            var typology = ['All']; //$('#typology').val();
            var spaceType = ['All']; //$('#spaceType').val();
            var sensorID = ['1202240025'];//$('#sensorID').val();
            var pollutants = 'pm25';
            getLinechart1(duration, typology,  spaceType, sensorID, pollutants, post_url);
            $('#btnduration1').click(function() {
                var duration = '24hour'; 
                var typology = $('#typology').val();
                var spaceType = $('#spaceType').val();
                var sensorID = $('#sensorID').val();
                $('#hid_duration').val('24hour');
                getLinechart1(duration, typology, spaceType, sensorID, pollutants,post_url);
            });
            $('#btnduration2').click(function() {
                var duration = 'week';  
                var typology = $('#typology').val();
                var spaceType = $('#spaceType').val();
                var sensorID = $('#sensorID').val();
                $('#hid_duration').val('week');
                getLinechart1(duration, typology,  spaceType, sensorID,pollutants, post_url);
            });
            $('#btnduration3').click(function() {
                var duration = 'month'; 
                var typology = $('#typology').val();
                var spaceType = $('#spaceType').val();
                var sensorID = $('#sensorID').val();
                $('#hid_duration').val('month');
                getLinechart1(duration, typology,  spaceType, sensorID,pollutants, post_url);
            });
            $('#btnduration4').click(function() {
                var duration = 'ytd';  
                var typology = $('#typology').val();
                var spaceType = $('#spaceType').val();
                var sensorID = $('#sensorID').val();
                $('#hid_duration').val('ytd');
                getLinechart1(duration, typology,  spaceType, sensorID,pollutants, post_url);
            });
            $('#typology').on('change', function() {
                var duration = $('#hid_duration').val();
                var typology = $('#typology').val();
                var spaceType = $('#spaceType').val();
                var sensorID = $('#sensorID').val();
                getLinechart1(duration, typology, spaceType, sensorID,pollutants, post_url);
            });
            $('#spaceType').on('change', function() {
                var duration = $('#hid_duration').val();
                var typology = $('#typology').val();
                var spaceType = $('#spaceType').val();
                var sensorID = $('#sensorID').val();
                getLinechart1(duration, typology,  spaceType, sensorID,pollutants, post_url);
            });
            $('#sensorID').on('change', function() {
                var duration = $('#hid_duration').val();
                var typology = $('#typology').val();
                var spaceType = $('#spaceType').val();
                var sensorID = $('#sensorID').val();
                getLinechart1(duration, typology,  spaceType, sensorID,pollutants, post_url);
            });
            $('input[name=line_radio_pullutant]').change(function(){
                var duration = $('#hid_duration').val();
                var typology = $('#typology').val();
                var spaceType = $('#spaceType').val();
                var sensorID = $('#sensorID').val();
                pollutants = $('#line_radio_pullutant:checked').val();
                getLinechart1(duration, typology,  spaceType, sensorID,pollutants, post_url);

            });
        });
    </script>

<script>
        // script for updating box chart Residentail
        
        $(document).ready(function() {
            var post_url = '<?php echo $_SESSION['config']->server_host?>/chartData/boxplot.php';
            var duration = $('#hid_duration_R_boxplot').val();
            var typology = ['Residential']; //$('#typology_boxplot').val();
            var spaceType = ['All']; //$('#spaceType_boxplot').val();
            var sensorID = ['All']; //$('#sensorID_boxplot').val();
            var pollutants = 'aqi';
            getBoxplot(duration, typology,  spaceType, sensorID, pollutants, post_url, 'boxchart1');
            $('#btnduration1d_R_boxplot').click(function() {
                $(this).addClass('active');
                $('#btnduration7d_R_boxplot').removeClass('active')
                $('#btnduration30d_R_boxplot').removeClass('active')
                $('#btndurationAll_R_boxplot').removeClass('active')
                var pollutants = $('#hid_pollutants_R_boxplot').val();
                var duration = '24hour'; 
                var typology = ['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                $('#hid_duration_R_boxplot').val('24hour');
                getBoxplot(duration, typology, spaceType, sensorID, pollutants,post_url, 'boxchart1');
            });
            $('#btnduration7d_R_boxplot').click(function() {
                $(this).addClass('active');
                $('#btnduration1d_R_boxplot').removeClass('active')
                $('#btnduration30d_R_boxplot').removeClass('active')
                $('#btndurationAll_R_boxplot').removeClass('active')
                var pollutants = $('#hid_pollutants_R_boxplot').val();
                var duration = 'week';  
                var typology =['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                $('#hid_duration_R_boxplot').val('week');
                getBoxplot(duration, typology,  spaceType, sensorID,pollutants, post_url, 'boxchart1');
            });
            $('#btnduration30d_R_boxplot').click(function() {
                $(this).addClass('active');
                $('#btnduration1d_R_boxplot').removeClass('active')
                $('#btnduration7d_R_boxplot').removeClass('active')
                $('#btndurationAll_R_boxplot').removeClass('active')
                var pollutants = $('#hid_pollutants_R_boxplot').val();
                var duration = 'month'; 
                var typology = ['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                $('#hid_duration_R_boxplot').val('month');
                getBoxplot(duration, typology,  spaceType, sensorID,pollutants, post_url, 'boxchart1');
            });
            $('#btndurationAll_R_boxplot').click(function() {
                $(this).addClass('active');
                $('#btnduration1d_R_boxplot').removeClass('active')
                $('#btnduration7d_R_boxplot').removeClass('active')
                $('#btnduration30d_R_boxplot').removeClass('active')
                var pollutants = $('#hid_pollutants_R_boxplot').val();
                var duration = 'ytd';  
                var typology = ['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                $('#hid_duration_R_boxplot').val('ytd');
                getBoxplot(duration, typology,  spaceType, sensorID,pollutants, post_url, 'boxchart1');
            });
            //Residential pollutants button click
            $('#btnaqi_R_box').click(function() {
                $(this).addClass('active');
                $('#btnpm25_R_box').removeClass('active')
                $('#btnpm10_R_box').removeClass('active')
                $('#btnco2_R_box').removeClass('active')
                $('#btntvoc_R_box').removeClass('active')
                var duration = $('#hid_duration_R_boxplot').val();
                var typology = ['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                pollutants = 'aqi';
                $('#hid_pollutants_R_boxplot').val('aqi');
                getBoxplot(duration, typology,  spaceType, sensorID,pollutants, post_url, 'boxchart1');
            });
            $('#btnpm25_R_box').click(function() {
                $(this).addClass('active');
                $('#btnaqi_R_box').removeClass('active')
                $('#btnpm10_R_box').removeClass('active')
                $('#btnco2_R_box').removeClass('active')
                $('#btntvoc_R_box').removeClass('active')
                var duration = $('#hid_duration_R_boxplot').val();
                var typology = ['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                pollutants = 'pm25';
                $('#hid_pollutants_R_boxplot').val('pm25');
                getBoxplot(duration, typology,  spaceType, sensorID,pollutants, post_url, 'boxchart1');
            });
            $('#btnpm10_R_box').click(function() {
                $(this).addClass('active');
                $('#btnaqi_R_box').removeClass('active')
                $('#btnpm25_R_box').removeClass('active')
                $('#btnco2_R_box').removeClass('active')
                $('#btntvoc_R_box').removeClass('active')
                var duration = $('#hid_duration_R_boxplot').val();
                var typology = ['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                pollutants = 'pm10';
                $('#hid_pollutants_R_boxplot').val('pm10');
                getBoxplot(duration, typology,  spaceType, sensorID,pollutants, post_url, 'boxchart1');
            });
            $('#btnco2_R_box').click(function() {
                $(this).addClass('active');
                $('#btnaqi_R_box').removeClass('active')
                $('#btnpm25_R_box').removeClass('active')
                $('#btnpm10_R_box').removeClass('active')
                $('#btntvoc_R_box').removeClass('active')
                var duration = $('#hid_duration_R_boxplot').val();
                var typology = ['Residential'];
                var spaceType = ['All']; 
                pollutants = 'co2';
                var sensorID = ['All']; 
                $('#hid_pollutants_R_boxplot').val('co2');
                getBoxplot(duration, typology,  spaceType, sensorID,pollutants, post_url, 'boxchart1');
            });
            $('#btntvoc_R_box').click(function() {
                $(this).addClass('active');
                $('#btnaqi_R_box').removeClass('active')
                $('#btnpm25_R_box').removeClass('active')
                $('#btnpm10_R_box').removeClass('active')
                $('#btnco2_R_box').removeClass('active')
                var duration = $('#hid_duration_R_boxplot').val();
                var typology = ['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                pollutants = 'voc';
                $('#hid_pollutants_R_boxplot').val('voc');
                getBoxplot(duration, typology,  spaceType, sensorID,pollutants, post_url, 'boxchart1');
            });
        });
    </script>


<script>
        // script for updating box chart Office
        
        $(document).ready(function() {
            var post_url = '<?php echo $_SESSION['config']->server_host?>/chartData/boxplot.php';
            var duration = $('#hid_duration_boxplot_office').val();
            var typology = ['Office']; //$('#typology_boxplot').val();
            var spaceType = ['All']; //$('#spaceType_boxplot').val();
            var sensorID = ['All']; //$('#sensorID_boxplot').val();
            var pollutants = 'pm25';
            
            getBoxplot(duration, typology,  spaceType, sensorID, pollutants, post_url, 'boxchart1_office');
            $('#btnduration1_boxplot').click(function() {
                var duration = '24hour'; 
                var typology = $('#typology_boxplot').val();
                var spaceType = $('#spaceType_boxplot').val();
                var sensorID = $('#sensorID_boxplot').val();
                $('#hid_duration_boxplot').val('24hour');
                getBoxplot(duration, typology, spaceType, sensorID, pollutants,post_url);
            });
            $('#btnduration2_boxplot').click(function() {
                var duration = 'week';  
                var typology = $('#typology_boxplot').val();
                var spaceType = $('#spaceType_boxplot').val();
                var sensorID = $('#sensorID_boxplot').val();
                $('#hid_duration_boxplot').val('week');
                getBoxplot(duration, typology,  spaceType, sensorID,pollutants, post_url);
            });
            $('#btnduration3_boxplot').click(function() {
                var duration = 'month'; 
                var typology = $('#typology_boxplot').val();
                var spaceType = $('#spaceType_boxplot').val();
                var sensorID = $('#sensorID_boxplot').val();
                $('#hid_duration_boxplot').val('month');
                getBoxplot(duration, typology,  spaceType, sensorID,pollutants, post_url);
            });
            $('#btnduration4_boxplot').click(function() {
                var duration = 'ytd';  
                var typology = $('#typology_boxplot').val();
                var spaceType = $('#spaceType_boxplot').val();
                var sensorID = $('#sensorID_boxplot').val();
                $('#hid_duration_boxplot').val('ytd');
                getBoxplot(duration, typology,  spaceType, sensorID,pollutants, post_url);
            });
            $('#typology_boxplot').on('change', function() {
                var duration = $('#hid_duration_boxplot').val();
                var typology = $('#typology_boxplot').val();
                var spaceType = $('#spaceType_boxplot').val();
                var sensorID = $('#sensorID_boxplot').val();
                getBoxplot(duration, typology, spaceType, sensorID,pollutants, post_url);
            });
            $('#spaceType_boxplot').on('change', function() {
                var duration = $('#hid_duration_boxplot').val();
                var typology = $('#typology_boxplot').val();
                var spaceType = $('#spaceType_boxplot').val();
                var sensorID = $('#sensorID_boxplot').val();
                getBoxplot(duration, typology,  spaceType, sensorID,pollutants, post_url);
            });
            $('#sensorID_boxplot').on('change', function() {
                var duration = $('#hid_duration_boxplot').val();
                var typology = $('#typology_boxplot').val();
                var spaceType = $('#spaceType_boxplot').val();
                var sensorID = $('#sensorID_boxplot').val();
                getBoxplot(duration, typology,  spaceType, sensorID,pollutants, post_url);
            });
            $('input[name=box_radio_pullutant]').change(function(){
                var duration = $('#hid_duration_boxplot').val();
                var typology = $('#typology_boxplot').val();
                var spaceType = $('#spaceType_boxplot').val();
                var sensorID = $('#sensorID_boxplot').val();
                pollutants = $('#box_radio_pullutant:checked').val();
                getBoxplot(duration, typology,  spaceType, sensorID,pollutants, post_url);

            });
        });
    </script>