<?php
    if ($_POST) {
        $duration = $_POST['duration'];
        $typology = implode(',', $_POST['typology']);
        $spaceType = implode(',',$_POST['spaceType']);
        $sensorID = implode(',',$_POST['sensorID']);
        $pollutants = $_POST['pollutants'];
        //return json_encode(['Response' => 'Success', 'Data' => $pollutants]);

        $parameter = [
            'duration' => $duration,
            'typology' => $typology,
            'spaceType' => $spaceType,
            'sensorID' => $sensorID,
            'pollutant' => $pollutants
        ];

        $url = 'https://iaq-dashboard.edsglobal.com/api/dashboard/getIndoorData';
        $parameterJson = json_encode($parameter);
        //echo $parameterJson;

        //call api
        $curl = curl_init();

        // Set cURL options
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $parameterJson); // Pass the associative array
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        // Option to return the response instead of printing it
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        
        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
       
    }

?>