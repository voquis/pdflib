<?php

namespace VoquisTest\Schema;

use PHPUnit\Framework\TestCase;

use Voquis\Schema\Base\InvoiceItem;

final class InvoiceItemTest extends TestCase
{
    /**
     * Test partial population
     */
    public function testPartial()
    {
        $input = [
            'description' => 'Invoice Item Description',
            'quantity' => 1.25,
        ];

        $invoiceItem = new InvoiceItem($input);
        $this->assertEquals($input['description'], $invoiceItem->description);
        $this->assertEquals($input['quantity'], $invoiceItem->quantity);
        $this->assertEquals(0.0, $invoiceItem->net);
    }

    /**
     * Test full population
     */
    public function testFull()
    {
        $expected = [
            'description' => 'Description',
            'quantity' => 1.25,
            'unitPrice' => 10.0,
            'taxPercent' => 20.0,
            'net' => 12.5,
            'tax' => 3.5,
            'gross' => 16.0,
        ];

        $invoiceItem = new InvoiceItem($expected);
        $actual = $invoiceItem->getArray();
        $this->assertEquals($expected, $actual);
    }
}
