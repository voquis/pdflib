<?php

namespace Voquis;

use \TCPDF;
use Voquis\Schema\Base\Company;

abstract class Document extends TCPDF
{
    /**
     * @var Company $company
     */
    public $company;

    /**
     * @var string $template
     */
    public $template = '';

    /**
     * @var string $title
     */
    public $title = '';

    /**
     * @var boolean $emailTelUnderLogo
     */
    public $emailTelUnderLogo = true;

    /**
     * @var int $logoHeight
     */
    public $logoHeight = 40;

    /**
     * Constructor
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $this->SetMargins(11, PDF_MARGIN_TOP, 11);
        $this->SetHeaderMargin(11);
        $this->SetFooterMargin(11);
        $this->preparePdf();
    }

    //Page header
    public function header()
    {
        $addressString = implode('<br />', $this->company->address->getArray());
        // Logo
        $lhs = '<img height="' . $this->logoHeight . 'px" src="' . $this->company->logoUrl . '">';
        $rhs = $this->company->name . '<br>' . $addressString;
        // Add email and telephone under logo (lhs) or address (rhs)
        if ($this->emailTelUnderLogo) {
            $lhs .= "<br />{$this->company->email} | {$this->company->telephone}";
        } else {
            $rhs .= "<br />{$this->company->email} | {$this->company->telephone}";
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
        $rhs = "{$this->company->name} is a private company limited by shares, registered in England " .
               "and Wales no: {$this->company->number}<br />VAT " .
               "Registration No: {$this->company->vatNumber}";

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

    /**
     * Prepare PDF
     */
    private function preparePdf()
    {
        // set document information
        $this->SetTitle($this->title);
        // set auto page breaks
        $this->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set font
        $this->SetFont('courier', '', 9, '', true);
        // add a page
        $this->AddPage();
        // get template content
        $path = dirname(__DIR__) . '/templates/' . $this->template;
        ob_start();
        include($path);
        $content = ob_get_clean();

        $this->writeHTMLCell(0, 0, '', '', $content, 0, 1, 0, true, '', true);
    }

    /**
     * Return PDF
     */
    public function getPdf()
    {
        return $this->Output($this->title . '.pdf', 'S');
    }
}
