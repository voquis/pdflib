<?php

namespace VoquisTest;

use PHPUnit\Framework\TestCase;

use Voquis\Pdf;
use Voquis\PdfConfig;

final class PdfTest extends TestCase
{
    private $pdf;

    /**
     * Set up
     */
    public function setUp(): void
    {
        $pdfConfig = new PdfConfig($this->getData());
        $this->pdf = new Pdf($pdfConfig);
    }

    /**
     * Test PDF
     */
    public function testPdf(): void
    {
        $this->assertEquals('Company', $this->pdf->config->companyName);
    }

    /**
     * Get data
     */
    private function getData(): array
    {
        return [
            'companyName' => 'Company',
            'companyNumber' => 1234567,
            'vatRegistration' => 'GB1234567',
            'addressLine1' => 'Address Line 1',
            'city' => 'City',
            'postcode' => 'CF11 0NS'
        ];
    }
}
