<?php

namespace Voquis\Document;

use Voquis\Document;
use Voquis\Schema\Base\Company;
use Voquis\Schema\Base\Invoice as InvoiceBase;

class Invoice extends Document
{
    /**
     * @var InvoiceBase $invoice
     */
    public $invoice;

    /**
     * @var string $template
     */
    public $template = 'invoice.php';

    /**
     * Constructor
     */
    public function __construct(
        Company $company,
        InvoiceBase $invoice,
        array $config = null
    ) {
        $this->invoice = $invoice;
        $this->logoHeight = $config['logoHeight'] ?? $this->logoHeight;
        $this->emailTelUnderLogo = $config['emailTelUnderLogo'] ?? $this->emailTelUnderLogo;
        parent::__construct($company);
    }
}
