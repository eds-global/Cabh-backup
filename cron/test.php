<?php
$typology = "Residential";
if(str_contains($typology, 'All')){
    $typology = "Residential,Office";
}
$typology  = "'" . str_replace(",","','", $typology ) . "'";
print $typology;

$pollutant = "pm25";
$column_nm = "max_". $pollutant;
$select_query = "select datetime, avg($column_nm) from reading_15min where typology in ($typology)";

print $select_query;

$typology = 'All';
print($typology);
if(str_contains($typology, 'All')){
    
    $typology_str = "Residential,Office";
    print($typology_str);
} 

?>