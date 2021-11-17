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

    // -----------------------------------------------------------------------------------------
    // INSERT CONSTANTS HERE -----------------------------------------------------------------------------------------
    // -----------------------------------------------------------------------------------------

    $constant_string = "## Constants<br><br>";

    $constants = "";

    preg_match_all("/[A-Z]+\S*/",$constants,$extracted_constant_names,PREG_PATTERN_ORDER);

    if (empty($constants)) {
        $constant_string .= "None<br>";
    } else {
        $constant_string .= "| Type | Name | Description |<br>";
        $constant_string .= "| ---- | ---- | ----------- |<br>";
        foreach ($extracted_constant_names[0] as $var_name) {
            $constant_string .= "|  | `". $var_name ."` |  |<br>";
        }
    }

    echo $constant_string;
    echo "<br>";

    // -----------------------------------------------------------------------------------------
    // INSERT PROPERTIES HERE -----------------------------------------------------------------------------------------
    // -----------------------------------------------------------------------------------------
    $property_string = "## Properties<br><br>";

    $properties = "";

    preg_match_all("/\\\$\S*(?<!;)/",$properties,$extracted_property_names,PREG_PATTERN_ORDER);

    if (empty($extracted_property_names[0])) {
        $property_string .= "None<br>";
    } else {
        foreach ($extracted_property_names[0] as $var_name) {
            $property_string .= "| Type | Name | Description |<br>";
            $property_string .= "| ---- | ---- | ----------- |<br>";
            $property_string .= "|  | `". $var_name ."` |  |<br>";
        }
    }

    echo $property_string;
    echo "<br>";

    // -----------------------------------------------------------------------------------------
    // INSERT METHODS HERE -----------------------------------------------------------------------------------------
    // -----------------------------------------------------------------------------------------

    $method_string = "## Methods<br><br>";

    $lines = file('/vagrant/app/mod/BinController.php', FILE_IGNORE_NEW_LINES);

    $matches_array = [];

    foreach ($lines as $line) {
        preg_match('/public .*function+.*\)/', $line, $matches);
        if (!empty($matches)) {
            $method_string .= "### `". $matches[0] ."`<br><br>";
            $method_string .= "--------- Description of the method ----------<br><br>";
            preg_match_all("/\\\$[^,]*(?<!\))(?<!,)/",$matches[0],$extracted_parameter_names,PREG_PATTERN_ORDER);
            $method_string .= "#### Return Value<br><br>";
            $method_string .= "--------- Return Value ----------<br><br>";
        }
        array_push($matches_array, $matches);
    }

    echo $method_string;

}