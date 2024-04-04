
<?php
    header('Access-Control-Allow-Origin: *');
    $uri = explode('/',$_SERVER['REQUEST_URI']);
    $uri = array_filter($uri);
    $uri = array_values($uri);
    $file = $uri[0];
    $method = $uri[1];
    echo $file;
    require_once "$file.php";
    echo $method();
    exit;
?>