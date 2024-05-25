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
                        <!-- place map here-->
                        <div id="map" style="position: relative; overflow:hidden; width: 100%; height:380px "></div>

                        <div style="margin-top:10px; margin-bottom:10px"> 
                            <!-- pollutant radio-->
                            <form id="map_pollutant" name="map_pollutant"> 
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" ><b>Pollutants:</b> </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input pollutant_radio" type="radio" name="radio_pullutant" id="radio_pullutant" value="pm25" checked>
                                    <label class="form-check-label" for="radio_pm25">PM 2.5 (µg/m<sup>3</sup>)</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input pollutant_radio" type="radio" name="radio_pullutant" id="radio_pullutant" value="pm10" >
                                    <label class="form-check-label" for="radio_pm10">PM 10 (µg/m<sup>3</sup>)</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input pollutant_radio" type="radio" name="radio_pullutant" id="radio_pullutant" value="aqi">
                                    <label class="form-check-label" for="radio_pm10">AQI</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input pollutant_radio" type="radio" name="radio_pullutant" id="radio_pullutant" value="co2">
                                    <label class="form-check-label" for="radio_pmco2">CO<sub>2</sub> (ppm)</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input pollutant_radio" type="radio" name="radio_pullutant" id="radio_pullutant" value="voc">
                                    <label class="form-check-label" for="radio_pmvoc">TVOC (µg/m<sup>3</sup>)</label>
                                </div>
                            </form>
                            <!-- map legend-->
                            <div class="map-legend" >
                                <span class="indoor" style="width:40px; padding:10px;float:none;"> Indoor </span>
                                <span class="outdoor" style="width:40px; padding:10px; "> outdoor </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /# Map card -->
            </div>                  
        </div>
        <!-- /#map -->

        <!-- chart1 - line chart -->
        <div class="row">
            <div class="col-lg-12">
                <!-- line chart card -->
                <div class="card">
                    <div class="card-body" >
                        <!-- filter -->
                        <div class="row">
                            <div class="col-lg-2 col-md-2" style="align-content: end; text-align: center;">
                                <input type="button" class="btn" id="btnduration1" name="btnduration" value="24 Hour">
                            </div>
                            <div class="col-lg-2 col-md-2" style="align-content: end; text-align: center;">
                                <input type="button" class="btn" id="btnduration2" name="btnduration" value="Week"   >
                            </div>
                            <div class="col-lg-2 col-md-2" style="align-content: end; text-align: center;">
                                <input type="button" class="btn" id="btnduration3" name="btnduration" value="Month"  >
                            </div>
                            <div class="col-lg-2 col-md-2" style="align-content: end; text-align: center;">
                                <input type="button" class="btn" id="btnduration4" name="btnduration" value="YTD"  >
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <div class="row">
                                    <label>Typology</label>
                                
                                    <select id="typology" name="typology" class="selectpicker" multiple aria-label="typology" >
                                        <option id="All" value="All" selected> All</option>
                                    <?php
                                        $curl = curl_init();

                                        curl_setopt_array($curl, array(
                                        CURLOPT_URL => $_SESSION['config']->api_host.'/api/dashboard/getTypology',
                                        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_ENCODING => '',
                                        CURLOPT_MAXREDIRS => 10,
                                        CURLOPT_TIMEOUT => 0,
                                        CURLOPT_FOLLOWLOCATION => true,
                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                        CURLOPT_CUSTOMREQUEST => 'POST',
                                        ));

                                        $response = curl_exec($curl);

                                        curl_close($curl);
                                        $data = json_decode($response, true);
                                        foreach ($data['Data'] as $typology){
                                            echo "<option>" . $typology . "</option>";
                                        }
                                        
                                    ?>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <div class="row">
                                    
                                    <label>Location</label>
                                
                                    <select id="location" name="location" class="selectpicker location_select" multiple aria-label="location" style="width:auto">
                                        <option id="All" value="All" selected> All</option>
                                    <?php
                                        $curl = curl_init();

                                        curl_setopt_array($curl, array(
                                        CURLOPT_URL => $_SESSION['config']->api_host.'/api/dashboard/getLocation',
                                        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_ENCODING => '',
                                        CURLOPT_MAXREDIRS => 10,
                                        CURLOPT_TIMEOUT => 0,
                                        CURLOPT_FOLLOWLOCATION => true,
                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                        CURLOPT_CUSTOMREQUEST => 'POST',
                                        ));

                                        $response = curl_exec($curl);

                                        curl_close($curl);
                                        $data = json_decode($response, true);
                                        foreach ($data['Data'] as $location){
                                            echo "<option>" . $location . "</option>";
                                        }
                                        
                                    ?>
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                        <!-- /# filter -->

                        <!-- line chart --> 
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-body" >
                                    <input type="hidden" id="hid_duration" name="hid_duration" value="24hour">
                                    <div id="linechart1" name="linechart1" style="position: relative; overflow:hidden; width: 100%; height:380px "></div>
                                </div>
                            </div>
                        </div>
                        <!-- /# line chart -->

                        <!-- pollutant radio -->
                        <div class="row">
                            <div style="margin-top:10px; margin-bottom:10px"> 
                                <form id="line_pollutant" name="line_pollutant"> 
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" ><b>Pollutants:</b> </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input pollutant_radio" type="radio" name="line_radio_pullutant" id="line_radio_pullutant" value="pm25" checked>
                                        <label class="form-check-label" for="radio_pm25">PM 2.5 (µg/m<sup>3</sup>)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input pollutant_radio" type="radio" name="line_radio_pullutant" id="line_radio_pullutant" value="pm10" >
                                        <label class="form-check-label" for="radio_pm10">PM 10 (µg/m<sup>3</sup>)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input pollutant_radio" type="radio" name="line_radio_pullutant" id="line_radio_pullutant" value="aqi">
                                        <label class="form-check-label" for="radio_pm10">AQI</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input pollutant_radio" type="radio" name="line_radio_pullutant" id="line_radio_pullutant" value="co2">
                                        <label class="form-check-label" for="radio_pmco2">CO<sub>2</sub> (ppm)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input pollutant_radio" type="radio" name="line_radio_pullutant" id="line_radio_pullutant" value="voc">
                                        <label class="form-check-label" for="radio_pmvoc">TVOC (µg/m<sup>3</sup>)</label>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /# pollutant radio -->

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

        // Listen for change event on radio buttons
        var radioButtons = document.getElementsByName('radio_pullutant');
        radioButtons.forEach(function(radio) {
        radio.addEventListener('change', function(event) {
            var selectedOption = event.target.value;
            updateMap(selectedOption);
        });
        });
    
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
        updateMap("pm25")



    
    </script>
    <!-- /# load pins on map script -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- for linechart  -->
    
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="<?php echo $_SESSION['config']->server_host?>/chart_JS_api/linechart1.js"></script>

    <script>
        // script for updating line chart
        
        $(document).ready(function() {
            var post_url = '<?php echo $_SESSION['config']->server_host?>/chartData/linechart.php';
            var duration = $('#hid_duration').val();
            var typology = $('#typology').val();
            var loc = $('#location').val();
            var pollutants = 'pm25';
            getLinechart1(duration, typology, loc,pollutants,post_url);
            $('#btnduration1').click(function() {
                var duration = '24hour'; 
                var typology = $('#typology').val();
                var loc = $('#location').val();
                $('#hid_duration').val('24hour');
                getLinechart1(duration, typology, loc,pollutants,post_url);
            });
            $('#btnduration2').click(function() {
                var duration = 'week';  
                var typology = $('#typology').val();
                var loc = $('#location').val();
                $('#hid_duration').val('week');
                getLinechart1(duration, typology, loc,pollutants, post_url);
            });
            $('#btnduration3').click(function() {
                var duration = 'month'; 
                var typology = $('#typology').val();
                var loc = $('#location').val();
                $('#hid_duration').val('month');
                getLinechart1(duration, typology, loc,pollutants, post_url);
            });
            $('#btnduration4').click(function() {
                var duration = 'ytd';  
                var typology = $('#typology').val();
                var loc = $('#location').val();
                $('#hid_duration').val('ytd');
                getLinechart1(duration, typology, loc,pollutants, post_url);
            });
            $('#typology').on('change', function() {
                var duration = $('#hid_duration').val();
                var typology = $('#typology').val();
                getLinechart1(duration, typology, loc,pollutants, post_url);
            });
            $('#location').on('change', function() {
                var duration = $('#hid_duration').val();
                var loc = $('#location').val();
                getLinechart1(duration, typology, loc,pollutants, post_url);
            });
            $('input[name=line_radio_pullutant]').change(function(){
                var duration = $('#hid_duration').val();
                var typology = $('#typology').val();
                var loc = $('#location').val();
                pollutants = $('#line_radio_pullutant:checked').val();
                getLinechart1(duration, typology, loc,pollutants, post_url);

            });
        });
    </script>