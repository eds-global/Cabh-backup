<?php
$myfile = fopen("log1.txt", "a") or die("Unable to open file!");
$txt = "new line ". date('Y-m-d H:i:s') ."\n";
fwrite($myfile, $txt);

fclose($myfile);
?>