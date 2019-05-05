<?php

namespace Voquis;

use \TCPDF;

class Pdf extends TCPDF
{
    public $config;

    /**
     * Constructor
     */
    public function __construct(PdfConfig $config)
    {
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $this->config = $config;
        $this->SetMargins(11, PDF_MARGIN_TOP, 11);
        $this->SetHeaderMargin(11);
        $this->SetFooterMargin(11);
    }

    //Page header
    public function header()
    {
        $address = implode('<br />', $this->config->address);
        // Logo
        $lhs = '<img height="' . $this->config->logoHeight . 'px" src="' . $this->config->logoUrl . '">';
        // Address
        $addressString = implode('<br />', array_filter([
            $this->config->addressLine1,
            $this->config->addressLine2,
            $this->config->addressLine3,
            $this->config->addressCity,
            $this->config->addressCounty,
            $this->config->addressPostcode,
        ]));
        $rhs = $this->config->companyName . '<br>' . $addressString;
        // Add email and telephone under logo (lhs) or address (rhs)
        if ($this->config->emailTelUnderLogo) {
            $lhs .= "<br />{$this->config->email} | {$this->config->telephone}";
        } else {
            $rhs .= "<br />{$this->config->email} | {$this->config->telephone}";
        }

        // Set header HTML
        $html = <<<EOT
        <table>
            <tbody>
                <tr>
                    <td>{$lhs}</td>
                    <td style="text-align: right;">{$rhs}</td>
                </tr>
                <tr>
                    <td colspan="2"><br /><hr /></td>
                </tr>
            </tbody>
        </table>
EOT;

        // Set font
        $this->SetFont('helvetica', '', 9);
        // Title
        $this->writeHTMLCell(
            $w = 0,
            $h = 0,
            $x = '',
            $y = '',
            $html,
            $border = '',
            $ln = 0,
            $fill = 0,
            $reseth = true,
            $align = 'top',
            $autopadding = true
        );
    }

    // Page footer
    public function footer()
    {
        $lhs = "Page {$this->getAliasNumPage()}/{$this->getAliasNbPages()}";
        $rhs = "{$this->config->companyName} is a private company limited by shares, registered in England " .
               "and Wales no: {$this->config->companyNumber}<br />VAT " .
               "Registration No: {$this->config->vatRegistration}";

        $html = <<<EOT
        <table>
            <tbody>
                <tr>
                    <td colspan="2" ><hr /></td>
                </tr>
                <tr>
                    <td width="20%">{$lhs}</td>
                    <td width="80%" align="right">{$rhs}</td>
                </tr>
            </tbody>
        </table>
EOT;
        // Position from bottom
        $this->SetY(-20);
        // Set font
        $this->SetFont('helvetica', '', 9);
        // Page number
        $this->writeHTMLCell(
            $w = 0,
            $h = 0,
            $x = '',
            $y = '',
            $html,
            $border = '',
            $ln = 1,
            $fill = 0,
            $reseth = true,
            $align = 'top',
            $autopadding = true
        );
    }
}
