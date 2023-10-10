<?php

include('Constructor.php');

class ArrayProcessor
{

    public function displayOutput($inputArray)
    {
        $output = "";

        $arrayProcessor = new Constructor($inputArray);

        $output .= "Sorted Array: " . implode(", ", $arrayProcessor->getSortedArray()) . "\n";
        $output .= "Median: " . $arrayProcessor->getMedian() . "\n";
        $output .= "Largest Value: " . $arrayProcessor->getLargestValue() . "\n";

        return $output;
    }
}

$inputArray = [5, 2, 9, 1, 5];
$arrayProcessor = new ArrayProcessor();
echo $arrayProcessor->displayOutput($inputArray);
