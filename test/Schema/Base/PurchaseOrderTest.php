<?php

namespace VoquisTest\Schema\Base;

use PHPUnit\Framework\TestCase;

use Voquis\Schema\Base\PurchaseOrder;
use Voquis\Schema\Base\Company;
use Voquis\Schema\Base\Address;
use Voquis\Schema\Collection\PurchaseOrderItems;
use Voquis\Schema\Collection\KeyValuePairs;

final class PurchaseOrderTest extends TestCase
{
    /**
     * Test full population
     */
    public function testFull()
    {
        $expected = $this->getData();
        $address = new Address($expected['company']['address']);

        $company = new Company(
            $address,
            $expected['company']
        );
        $keyValuePairs = new KeyValuePairs($expected['keyValuePairs']);
        $purchaseOrderItems = new PurchaseOrderItems($expected['purchaseOrderItems']);
        $purchaseOrder = new PurchaseOrder(
            $company,
            $purchaseOrderItems,
            $keyValuePairs,
            $expected
        );
        $actual = $purchaseOrder->getArray();
        $this->assertEquals($expected, $actual);
    }

    public static function getData()
    {
        return [
            'summary' => 'Purchase summary',
            'notes' => 'Purchase notes',
            'instructions' => 'Purchase instructions',
            'symbol' => '&pound;',
            'net' => 135.0,
            'tax' => 13.5,
            'gross' => 148.5,
            'ref' => 'PRCH-123',
            'company' => [
                'name' => 'Supplier Co',
                'number' => 'NI123456',
                'vatNumber' => 'AU12345678',
                'email' => 'info@example.com',
                'telephone' => '01234567890',
                'website' => 'https://www.example.com',
                'logoUrl' => 'https://www.example.com/img/logo.png',
                'address' => [
                    'line1' => 'Supplier Co Addr Line 1',
                    'line2' => 'Supplier Co Addr Line 2',
                    'line3' => 'Supplier Co Addr Line 3',
                    'city' => 'Supplier Co Addr City',
                    'county' => 'Supplier Co Addr County',
                    'postcode' => 'Supplier Co Addr Postcode',
                ]
            ],
            'purchaseOrderItems' => [
                [
                    'description' => 'Item 1',
                    'quantity' => 100.0,
                    'unitPrice' => 1.25,
                    'taxPercent' => 10.0,
                    'net' => 125.0,
                    'tax' => 12.5,
                    'gross' => 137.5,
                ],
                [
                    'description' => 'Item 2',
                    'quantity' => 1,
                    'unitPrice' => 10,
                    'taxPercent' => 10,
                    'net' => 10,
                    'tax' => 1,
                    'gross' => 11,
                ],
            ],
            'keyValuePairs' => [
                [
                    'key' => 'myKey1',
                    'value' => 'myValue1'
                ],
                [
                    'key' => 'myKey2',
                    'value' => 'myValue2'
                ]
            ]
        ];
    }
}
