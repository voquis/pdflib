<?php

namespace Voquis\Document;

use Voquis\Document;
use Voquis\Schema\Base\Company;
use Voquis\Schema\Base\PurchaseOrder as PurchaseOrderBase;

class PurchaseOrder extends Document
{
    /**
     * @var PurchaseOrderBase $purchaseOrder
     */
    public $purchaseOrder;

    /**
     * @var string $template
     */
    public $template = 'purchaseOrder.php';

    /**
     * Constructor
     */
    public function __construct(
        Company $company,
        PurchaseOrderBase $purchaseOrder,
        array $config = null
    ) {
        $this->purchaseOrder = $purchaseOrder;
        $this->logoHeight = $config['logoHeight'] ?? $this->logoHeight;
        $this->emailTelUnderLogo = $config['emailTelUnderLogo'] ?? $this->emailTelUnderLogo;
        parent::__construct($company);
    }
}
