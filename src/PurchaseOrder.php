<?php

namespace Voquis;

class PurchaseOrder
{

    private $pdf;
    private $config;

    /**
     * Constructor
     */
    public function __construct(Pdf $pdf, PurchaseOrderConfig $config)
    {
        // inject dependencies
        $this->pdf = $pdf;
        $this->config = $config;
        // Prepare PDF
        $this->preparePdf();
    }

    /**
     * Prepare PDF
     */
    private function preparePdf()
    {
        // set document information
        $this->pdf->SetTitle($this->config->ref);
        // set auto page breaks
        $this->pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set font
        $this->pdf->SetFont('courier', '', 9, '', true);
        // add a page
        $this->pdf->AddPage();
        // get template content
        ob_start();
        include(dirname(__DIR__) . '/templates/purchaseOrder.php');
        $content = ob_get_clean();

        $this->pdf->writeHTMLCell(0, 0, '', '', $content, 0, 1, 0, true, '', true);
    }

    /**
     * Return PDF directly to client with appropriate headers
     */
    public function sendPdf()
    {
        $this->pdf->Output($this->config->title . '.pdf', 'I');
    }

    /**
     * Return PDF string
     */
    public function getPdf()
    {
        return $this->pdf->Output($this->config->title . '.pdf', 'S');
    }
}
