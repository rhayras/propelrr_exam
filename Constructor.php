<?php

class Constructor
{
    private $array;

    public function __construct($inputArray)
    {
        if (!is_array($inputArray)) {
            throw new InvalidArgumentException("Input must be an array.");
        }

        $this->array = $inputArray;
        $this->bubbleSort();
    }

    private function bubbleSort()
    {
        $length = count($this->array);
        for ($i = 0; $i < $length - 1; $i++) {
            for ($j = 0; $j < $length - $i - 1; $j++) {
                if ($this->array[$j] > $this->array[$j + 1]) {
                    // Swap elements
                    $temp = $this->array[$j];
                    $this->array[$j] = $this->array[$j + 1];
                    $this->array[$j + 1] = $temp;
                }
            }
        }
    }

    public function getSortedArray()
    {
        return $this->array;
    }

    public function getMedian()
    {
        $length = count($this->array);
        $middle = floor($length / 2);

        if ($length % 2 === 0) {
            return ($this->array[$middle - 1] + $this->array[$middle]) / 2;
        } else {
            return $this->array[$middle];
        }
    }

    public function getLargestValue()
    {
        $length = count($this->array);
        return $this->array[$length - 1];
    }
}
