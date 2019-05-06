<?php

namespace VoquisTest\Schema;

use PHPUnit\Framework\TestCase;

use Voquis\Schema\Collection\InvoiceItems;

final class InvoiceItemsTest extends TestCase
{
    /**
     * Test partial population
     */
    public function testPartial()
    {
        $input = [
            [
                'description' => 'Description 1',
            ],
            [
                'description' => 'Description 2',
            ]
        ];

        $collection = new InvoiceItems($input);
        $collectionObjects = $collection->items;
        $collectionArrays = $collection->getArray();
        // Test array of objects
        $this->assertEquals($collectionArrays[0]['description'], $input[0]['description']);
        $this->assertEquals($collectionArrays[1]['description'], $input[1]['description']);
        $this->assertEquals($collectionArrays[0]['quantity'], 0.0);
        $this->assertEquals($collectionArrays[1]['quantity'], 0.0);
        // Test array of arrays
        $this->assertEquals($collectionObjects[0]->description, $input[0]['description']);
        $this->assertEquals($collectionObjects[1]->description, $input[1]['description']);
        $this->assertEquals($collectionObjects[0]->quantity, 0.0);
        $this->assertEquals($collectionObjects[1]->quantity, 0.0);
    }

    /**
     * Test full population
     */
    public function testFull()
    {
        $expected = [
            [
                'description' => 'Description 1',
                'quantity' => 1.25,
                'unitPrice' => 10.0,
                'taxPercent' => 20.0,
                'net' => 12.5,
                'tax' => 3.5,
                'gross' => 16.0,
            ],
            [
                'description' => 'Description 2',
                'quantity' => 12.50,
                'unitPrice' => 100.0,
                'taxPercent' => 20.0,
                'net' => 1250.0,
                'tax' => 350.0,
                'gross' => 1600.0,
            ]
        ];

        $collection = new InvoiceItems($expected);
        $actual = $collection->getArray();
        $this->assertEquals($expected, $actual);
    }
}
