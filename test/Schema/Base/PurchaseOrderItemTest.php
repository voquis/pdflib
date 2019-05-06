<?php

namespace VoquisTest\Schema;

use PHPUnit\Framework\TestCase;

use Voquis\Schema\Base\PurchaseOrderItem;

final class PurchaseOrderItemTest extends TestCase
{
    /**
     * Test partial population
     */
    public function testPartial()
    {
        $input = [
            'description' => 'Purchase Order Item Description',
            'quantity' => 1.25,
        ];

        $purchaseOrderItem = new PurchaseOrderItem($input);
        $this->assertEquals($input['description'], $purchaseOrderItem->description);
        $this->assertEquals($input['quantity'], $purchaseOrderItem->quantity);
        $this->assertEquals(0.0, $purchaseOrderItem->net);
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

        $purchaseOrderItem = new PurchaseOrderItem($expected);
        $actual = $purchaseOrderItem->getArray();
        $this->assertEquals($expected, $actual);
    }
}
