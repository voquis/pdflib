<?php

namespace VoquisTest;

use PHPUnit\Framework\TestCase;

use Voquis\PurchaseOrderConfig;
use Voquis\PurchaseOrderItem;
use Voquis\CustomProperty;

final class PurchaseOrderConfigTest extends TestCase
{
    private $config;

    /**
     * Instantiate Config with DI
     */
    public function setUp(): void
    {
        $purchaseOrderItem = new PurchaseOrderItem;
        $customProperty = new CustomProperty;
        $this->config = new PurchaseOrderConfig(
            $purchaseOrderItem,
            $customProperty
        );
    }

    /**
     * Test populating config
     */
    public function testPopulate(): void
    {
        $this->config->populate($this->getInput());
        $this->assertEquals('Address Line 1', $this->config->addressLine1);
        $this->assertEquals(23.784, $this->config->net);
        // test re-populating same invoice config
        $this->config->populate([
            'addressLine1' => 'New Address Line 1'
        ]);
        $this->assertEquals('New Address Line 1', $this->config->addressLine1);
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
