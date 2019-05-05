<?php

namespace VoquisTest;

use PHPUnit\Framework\TestCase;

use Voquis\InvoiceConfig;
use Voquis\InvoiceItem;
use Voquis\InvoiceCustomProperty;

final class InvoiceConfigTest extends TestCase
{
    private $invoiceConfig;

    /**
     * Instantiate Invoice Config with DI
     */
    public function setUp(): void
    {
        $invoiceItem = new InvoiceItem;
        $invoiceCustomProperty = new InvoiceCustomProperty;
        $this->invoiceConfig = new InvoiceConfig(
            $invoiceItem,
            $invoiceCustomProperty
        );
    }

    /**
     * Test populating invoice config
     */
    public function testPopulate(): void
    {
        $this->invoiceConfig->populate($this->getInput());
        $this->assertEquals('Address Line 1', $this->invoiceConfig->addressLine1);
        $this->assertEquals(23.784, $this->invoiceConfig->net);
        // test re-populating same invoice config
        $this->invoiceConfig->populate([
            'addressLine1' => 'New Address Line 1'
        ]);
        $this->assertEquals('New Address Line 1', $this->invoiceConfig->addressLine1);
    }

    /**
     * Input data
     */
    public function getInput(): array
    {
        return [
            'addressLine1' => 'Address Line 1',
            'addressLine2' => 'Address Line 2',
            'items' => [
                [
                    'quantity' => 1,
                    'description' => 'First item',
                    'unitPrice' => 20.45,
                    'vatPercent' => 20
                ],
                [
                    'quantity' => 2,
                    'description' => 'Second item',
                    'unitPrice' => 1.667,
                    'vatPercent' => 20
                ],
            ],
            'customProperties' => [
                [
                    'key1' => 'value1',
                    'key2' => 1.25
                ]
            ]
        ];
    }
}
