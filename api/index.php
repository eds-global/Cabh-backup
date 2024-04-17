
<?php
    header('Access-Control-Allow-Origin: *');
    date_default_timezone_set("Asia/Kolkata");
    $uri = explode('/',$_SERVER['REQUEST_URI']);
    $uri = array_filter($uri);
    $uri = array_values($uri);
    $file = $uri[1];
    $method = $uri[2];
    echo $file;
    require_once "$file.php";
    echo $method();
    exit;
?>