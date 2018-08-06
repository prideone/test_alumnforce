<?php

class TerrainLeveling
{

    private $levelBoundaries;
    private $area;

    public function __construct($area){
        $this->area = $area;
    }


    /*
    *   return integer
    *   function that returns the minimum effort to level a terrain 
    */
    public function getMinimum(){

        
        // test if te area is accurate
        if (!$this->testAreaAccuracy()) {
            throw new \LogicException('The test area is not accurate.');
        }

        // transform the area in an array of numbers => array('0' => 2, '1' => 1, '2' => 0, ... )
        $meanArray = array();
        $meanCount = 0;
        foreach ($this->area as $line) {
            $splitLine = str_split($line);
            foreach ($splitLine as $level) {
                if (array_key_exists($level, $meanArray)) {
                    $meanArray[$level] += 1;
                }else{
                    $meanArray[$level] = 1;
                }

                $meanCount += $level;
            }
        }

        // compute the mean
        $mean = round($meanCount / (count($this->area) * strlen($this->area[0])));

        // count how many numbers ara above the mean and under the mean. We will call them $aboveMean and $underMean
        $aboveMean = 0;
        $underMean = 0;

        foreach ($meanArray as $key => $value) {
            if ($key > $mean) {
                $aboveMean += $value;
            }elseif ($key < $mean) {
                $underMean += $value;
            }
        }

        // Choose the other boundary for your level considering the higher number between $aboveMean and $underMean
        // if they are equal make an arbitrary choice
        if ($aboveMean > $underMean) {
            $levelBoundaries = array($mean, $mean+1);
        }elseif ($aboveMean < $underMean) {
            $levelBoundaries = array($mean-1, $mean);
        }else{
            $levelBoundaries = array($mean-1, $mean);
        }


        $effort = 0;

        // Loop on the $meanArray and add the number of effort to get to the nearest boundary on each number
        foreach ($meanArray as $key => $value) {
            if ($key > $levelBoundaries[1]) {
                $effort += $value * ($key - $levelBoundaries[1]);
            }elseif ($key < $levelBoundaries[0]) {
                $effort += $value * ($levelBoundaries[0] - $key);
            }
        }

        return (int) $effort;
    }


    /*
    *   return boolean
    *   function that checks if the area given to the getMinimum respects the different constaints
    */
    public function testAreaAccuracy(){

        // test if area length is between 1 and 50 elements
        if (count($this->area) > 50 || count($this->area) < 1) {
            return false;
        }

        $firstLineLength = strlen($this->area[0]);
        foreach ($this->area as $line) {
            // test if area elements length is between 1 and 50
            if (strlen($line) > 50 || strlen($line < 1)) {
                return false;
            }

            // test if all elements of area are the same length
            if (strlen($line) != $firstLineLength) {
                return false;
            }

            // test if all characters are between 0 and 9
            if (!ctype_digit($line)) {
                return false;
            }
        }

        return true;
    }
}

