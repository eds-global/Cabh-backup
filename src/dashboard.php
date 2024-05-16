
    
    
    <!-- Header-->
        
        <?php include 'partials/header.php' ?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous"
  referrerpolicy="no-referrer" />

        <style>

            .marker {
        /* background-image: url('<?php// echo $_SESSION['config']->server_host?>/images/flag.png');
        background-size: cover; */
        /* circle shape
         background : #FF5733;
      
        textAlign : 'center';
        lineHeight :40px;
        color : #FFF;
        fontWeight : 'bold';
        width: 40px;
        height: 40px;
        border-radius: 50%;
        padding-top: 10px;
        padding-left:10px; */
        /* cursor: pointer; */

        /* rectangle shape */
        background : #023170;
        color : #FFF;
        width: 75px;
        height: 40px;
        border-radius: 10%;
        padding-top: 10px;
        /* padding-left:10px; */
        text-align:center;
      }
      .text-overlay {
      position: absolute;
      top: 10px;
      left: 10px;
      background-color: rgba(255, 255, 255, 0.8);
      padding: 10px;
      border-radius: 5px;
      font-family: Arial, sans-serif;
    }
      

            </style>
        
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- filter -->
                <!-- <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body float-left">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3">
                                        <div class="row">
                                            
                                            <label>Duration</label>
                                            <select id="duration" class="selectpicker" aria-label="duration" >
                                                <option> Last 24 Hour </option>
                                                <option> Last Week</option>
                                                <option>Last Year </option>
                                                <option> Custom Range</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <div class="row">
                                            <label>Typology</label>
                                        
                                            <select id="typology" class="selectpicker" multiple aria-label="typology" >
                                                <option id="all" value="all" selected> All</option>
                                            <?php
                                                /* $curl = curl_init();

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
                                                 */
                                            ?>
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <div class="row">
                                            
                                            <label>Location</label>
                                        
                                            <select id="location" class="selectpicker location_select" multiple aria-label="location" style="width:auto">
                                                <option id="all" value="all" selected> All</option>
                                            <?php
                                                /* $curl = curl_init();

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
                                                 */
                                            ?>
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <div class="row float-right">
                                        <input type="button" value="Filter" class="btn">
                                        <div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> -->
                <!-- filter end -->
                <!-- map and dial -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            
                            <div class="card-body" >
                                <div id="map" style="position: relative; overflow:hidden; width: 100%; height:380px "></div>
                                <div id="textOverlay" class="text-overlay"></div>
                                <div style="margin-top:10px; margin-bottom:10px"> 
                                    <form id="map_pollutant" name="map_pollutant"> 
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" ><b>Pollutants:</b> </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input pollutant_radio" type="radio" name="radio_pullutant" id="radio_pullutant" value="pm25" checked>
                                            <label class="form-check-label" for="radio_pm25">pm 2.5</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input pollutant_radio" type="radio" name="radio_pullutant" id="radio_pullutant" value="pm10" >
                                            <label class="form-check-label" for="radio_pm10">pm 10</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input pollutant_radio" type="radio" name="radio_pullutant" id="radio_pullutant" value="aqi">
                                            <label class="form-check-label" for="radio_pm10">AQI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input pollutant_radio" type="radio" name="radio_pullutant" id="radio_pullutant" value="co2">
                                            <label class="form-check-label" for="radio_pmco2">CO<sub>2</sub></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input pollutant_radio" type="radio" name="radio_pullutant" id="radio_pullutant" value="voc">
                                            <label class="form-check-label" for="radio_pmvoc">VOC</label>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>                  
                    
                </div>
                <!-- map and dial -->
                
            <!-- /#add-category -->
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
    <script>
	mapboxgl.accessToken = 'pk.eyJ1IjoiZGV2LW5pa3VuaiIsImEiOiJjbHMwYTNmdnowMDFxMmpyNTBteHoybTRwIn0.OEzenC6wBOTbqZXCUNoE7A';
    var map = new mapboxgl.Map({
    container: 'map', // container ID
    style: 'mapbox://styles/dev-nikunj/clw4k1rgq02jw01qvgmjr18op',
    center: [77.2, 28.58], // starting position [lng, lat]
    scrollZoom: false, // Disable scroll zoom
    dragPan: false, // Disable drag pan
    zoom: 10 // starting zoom

    });

    /* var latitude = 77.7128; // New York City latitude
    var longitude = 28.0060; // New York City longitude

    // Create a marker on the map with the given latitude and longitude
    new mapboxgl.Marker()
        .setLngLat([longitude, latitude])
        .addTo(map); */

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
        el.textContent = markerData.max_pm25+ " | " + markerData.outdoor_pm25; 

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
        //el.textContent = markerData.max_pm25; 

        // Create a marker on the map
        if(pollutant == "pm25"){
            //el.textContent = "I:" + markerData.max_pm25 +"\nO:" + markerData.outdoor_pm25 ;
            el.textContent =  markerData.max_pm25 + " | " + markerData.outdoor_pm25 ;
            el.style.width= "75px";
            new mapboxgl.Marker(el)
                .setLngLat([parseFloat(markerData.longitude), parseFloat(markerData.latitude)])
                //.setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
                //.setHTML('<p><b>Indoor(PM2.5) :</b><br> ' + markerData.max_pm25  + '</p>'))
                .addTo(map);
        }
        if(pollutant == "pm10"){
            el.textContent = markerData.max_pm10 + " | " + markerData.outdoor_pm10 ;
            el.style.width= "75px";
            new mapboxgl.Marker(el)
                .setLngLat([parseFloat(markerData.longitude), parseFloat(markerData.latitude)])
                //.setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
                //.setHTML('<p><b>Indoor(PM10) :</b><br> ' + markerData.max_pm10  + '</p>'))
                .addTo(map);
        }
        if(pollutant == "aqi"){
            el.textContent = markerData.max_aqi + " | " + markerData.outdoor_aqi ;;
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
            new mapboxgl.Marker(el)
                .setLngLat([parseFloat(markerData.longitude), parseFloat(markerData.latitude)])
                //.setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
                //.setHTML('<p><b>Indoor(CO<sub>2</sub>) :</b><br> ' + markerData.max_co2  + '</p>'))
                .addTo(map);
        }
        if(pollutant == "voc"){
            el.textContent = markerData.max_voc;
            el.style.width= "40px";

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

<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<!-- <script src="<?php echo $_SESSION['config']->server_host?>/assets/chartJS/amchart.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
