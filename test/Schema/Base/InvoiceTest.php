<?php

namespace VoquisTest\Schema\Base;

use PHPUnit\Framework\TestCase;

use Voquis\Schema\Base\Invoice;
use Voquis\Schema\Base\Company;
use Voquis\Schema\Base\Address;
use Voquis\Schema\Collection\InvoiceItems;
use Voquis\Schema\Collection\KeyValuePairs;

final class InvoiceTest extends TestCase
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
        $invoiceItems = new InvoiceItems($expected['invoiceItems']);
        $invoice = new Invoice(
            $company,
            $invoiceItems,
            $keyValuePairs,
            $expected
        );
        $actual = $invoice->getArray();
        $this->assertEquals($expected, $actual);
    }

    public static function getData()
    {
        return [
            'summary' => 'Invoice summary',
            'notes' => 'Invoice notes',
            'instructions' => 'Payment instructions',
            'symbol' => '&pound;',
            'net' => 135.0,
            'tax' => 13.5,
            'gross' => 148.5,
            'ref' => 'INV-123',
            'company' => [
                'name' => 'Customer Co',
                'number' => 'OC123456',
                'vatNumber' => 'GB12345678',
                'email' => 'info@example.com',
                'telephone' => '01234567890',
                'website' => 'https://www.example.com',
                'logoUrl' => 'https://www.example.com/img/logo.png',
                'address' => [
                    'line1' => 'Customer Co Addr Line 1',
                    'line2' => 'Customer Co Addr Line 2',
                    'line3' => 'Customer Co Addr Line 3',
                    'city' => 'Customer Co Addr City',
                    'county' => 'Customer Co Addr County',
                    'postcode' => 'Customer Co Addr Postcode',
                ]
            ],
            'invoiceItems' => [
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
