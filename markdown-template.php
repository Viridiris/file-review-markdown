<?php
function helper1(){

    // USE THIS TO BUILD THE ROUTES TABLE IN YOUR TYPICAL MARKDOWN FILE BY COPY PASTING THE ROUTES METHOD ARRAY.
    $file_title = "Example File Title";
    echo "# " . $file_title . "<br><br>";


    $table_string = "## Routes<br><br>";
    $table_string .= "| Verb | Route  | Invoked Method  |<br>";
    $table_string .= "| ---- | ------ | --------------- |<br>";

    $route_array_original = [
        'example/route' => 'example_funtion',
        'example/route2' => 'example_funtion2'
    ];

    foreach ($route_array_original as $route_uri => $function_name) {
        $table_string .= "|  | `".$route_uri."` | `". $function_name ."()` |<br>";
    }
    echo $table_string;
    echo "<br>";

}