<?php
require 'vendor/autoload.php';

use ToolkitTester\TestableConditions;
use ToolkitTester\TestableCondition;
use ToolkitApi\CW;

$conditionsObj = new TestableConditions();
$conditions = $conditionsObj->getConditions();

echo '<style type="text/css"> .success{background-color:green; color:white;} .failure{background-color:red; color:black;}</style>';

foreach ($conditions as $condition)
{
    echo "<b>-------Begin Test-------</b><br>";
    echo "Version: ".$condition->getVersion()->getVersion()."<br>";
    echo "Source: ".$condition->getSource()->getSource()."<br>";
    echo "Transport type: ".$condition->getTransportType()->getTransportType()."<br>";
    echo runtest($condition)."<br>";
    echo "<b>-------End Test-------</b><br>";
    echo "<br><br>";
}

/**
 * @param TestableCondition $condition
 * @return mixed
 */
function runTest(TestableCondition $condition)
{
    // create curl resource
    $ch = curl_init();

    // set url
    curl_setopt($ch, CURLOPT_URL, "http://10.0.6.2:10088/ToolkitTester/test.php?version=" . $condition->getVersion()->getVersion() . "&source=" . $condition->getSource()->getSource(). "&transportType=".$condition->getTransportType()->getTransportType());

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);

    return $output;
}