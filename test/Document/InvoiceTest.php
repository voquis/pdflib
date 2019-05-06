<?php

namespace VoquisTest\Document;

use PHPUnit\Framework\TestCase;
use VoquisTest\Schema\Base\InvoiceTest as InvoiceBaseTest;
use Smalot\PdfParser\Parser;

use Voquis\Document\Invoice as InvoiceDocument;
use Voquis\Schema\Base\Address;
use Voquis\Schema\Base\Company;
use Voquis\Schema\Base\Invoice as InvoiceBase;
use Voquis\Schema\Collection\InvoiceItems;
use Voquis\Schema\Collection\KeyValuePairs;

final class InvoiceTest extends TestCase
{
    /**
     * Test document
     */
    public function testDocument()
    {
        $data = InvoiceBaseTest::getData();

        $myAddressData = [
            'line1' => 'My Addr Line 1',
            'line2' => 'My Addr Line 2',
            'line3' => 'My Addr Line 3',
            'city' => 'My Addr City',
            'county' => 'My Addr County',
            'postcode' => 'My Addr Postcode',
        ];

        $myCompanyData = [
            'name' => 'My Co',
            'number' => 'OC123456',
            'vatNumber' => 'GB12345678',
            'email' => 'info@example.com',
            'telephone' => '01234567890',
            'website' => 'https://www.example.com',
            'logoUrl' => dirname(__DIR__) . '/assets/logo.jpg',
        ];

        $myAddress = new Address($myAddressData);

        $myCompany = new Company(
            $myAddress,
            $myCompanyData
        );

        $invoice = new InvoiceBase(
            new Company(
                new Address($data['company']['address']),
                $data['company']
            ),
            new InvoiceItems($data['invoiceItems']),
            new KeyValuePairs($data['keyValuePairs']),
            $data
        );

        $document = new InvoiceDocument(
            $myCompany,
            $invoice,
            [
                'logoHeight' => 80
            ]
        );
        $parser = new Parser();
        $pdf = $parser->parseContent($document->getPdf());
        $pdfText = $pdf->getText();

        $this->assertStringContainsString($myCompany->name, $pdfText);
        $this->assertStringContainsString($myCompany->telephone, $pdfText);
        // Check company address data
        $this->assertStringContainsString(implode("\n", $myAddressData), $pdfText);
        // Check customer data
        $this->assertStringContainsString($data['company']['name'], $pdfText);
        $this->assertStringContainsString(implode("\n", $data['company']['address']), $pdfText);
        // Check invoice data
        $this->assertStringContainsString($data['notes'], $pdfText);
    }
}
