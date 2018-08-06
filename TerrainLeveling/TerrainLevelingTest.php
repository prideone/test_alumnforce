<?php

use PHPUnit\Framework\TestCase;
require_once('TerrainLeveling.php');


class TerrainLevelingTest extends TestCase
{

	// test the class with a terrain that does not need leveling
	public function testComputeMinimumEffortSimpleArea()
    {
    	$area = array("989");

        $terrainLeveling = new TerrainLeveling($area);

        $this->assertSame(0, $terrainLeveling->getMinimum());
    }


    // test class with complexe leveling needed
	public function testComputeMinimumEffortComplexArea()
    {
    	$area = array("5781252",
              		  "2471255",
              		  "0000291",
              		  "1212489");

        $terrainLeveling = new TerrainLeveling($area);

        $this->assertSame(53, $terrainLeveling->getMinimum());
    }

    // test the first constraint
    public function testAreaOutOfBound()
    {
    	$area = array("");
        $terrainLeveling = new TerrainLeveling($area);

        $this->expectException('LogicException');

        $terrainLeveling->getMinimum();
    }

    // test the second constraint
    public function testLineOutOfBound()
    {
    	$area = array("666666666666666666666666666666666666666666666666661");
        $terrainLeveling = new TerrainLeveling($area);

        $this->expectException('LogicException');

        $terrainLeveling->getMinimum();
    }

    // test the third constraint
    public function testAreaNotRectangular()
    {
    	$area = array("967",
    				  "22",
    				  "1111");

        $terrainLeveling = new TerrainLeveling($area);

        $this->expectException('LogicException');

        $terrainLeveling->getMinimum();
    }

    // test the fourth constraint
    public function testAreaNotOnlyIntegers()
    {
    	$area = array("967b",
    				  "2123",
    				  "1111");

        $terrainLeveling = new TerrainLeveling($area);

        $this->expectException('LogicException');

        $terrainLeveling->getMinimum();
    }
}
