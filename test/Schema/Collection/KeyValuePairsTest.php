<?php

namespace VoquisTest\Schema;

use PHPUnit\Framework\TestCase;

use Voquis\Schema\Collection\KeyValuePairs;

final class KeyValuePairsTest extends TestCase
{
    /**
     * Test partial population
     */
    public function testPartial()
    {
        $input = [
            [
                'key' => 'MyKey1',
            ],
            [
                'key' => 'MyKey2',
            ]
        ];

        $collection = new KeyValuePairs($input);
        $collectionObjects = $collection->items;
        $collectionArrays = $collection->getArray();
        // Test array of objects
        $this->assertEquals($collectionArrays[0]['key'], $input[0]['key']);
        $this->assertEquals($collectionArrays[1]['key'], $input[1]['key']);
        $this->assertNull($collectionArrays[0]['value']);
        $this->assertNull($collectionArrays[1]['value']);
        // Test array of arrays
        $this->assertEquals($collectionObjects[0]->key, $input[0]['key']);
        $this->assertEquals($collectionObjects[1]->key, $input[1]['key']);
        $this->assertNull($collectionObjects[0]->value);
        $this->assertNull($collectionObjects[1]->value);
    }

    /**
     * Test full population
     */
    public function testFull()
    {
        $expected = [
            [
                'key' => 'MyKey1',
                'value' => 'MyValue1'
            ],
            [
                'key' => 'MyKey2',
                'value' => 'MyValue2'
            ]
        ];

        $collection = new KeyValuePairs($expected);
        $actual = $collection->getArray();
        $this->assertEquals($expected, $actual);
    }
}
