<?php

namespace Voquis\Schema\Base;

use Voquis\Schema\Base;
use Voquis\Schema\Base\Company;
use Voquis\Schema\Collection\PurchaseOrderItems;
use Voquis\Schema\Collection\KeyValuePairs;

class PurchaseOrder extends Base
{
    /**
     * Company
     *
     * @var Company $company
     */
    public $company;

    /**
     * PurchaseOrder items collection
     *
     * @var PurchaseOrderItems $purchaseOrderItems
     */
    public $purchaseOrderItems;

    /**
     * Key-value pairs collection
     *
     * @var KeyValuePairs $keyValuePairs
     */
    public $keyValuePairs;

    /**
     * Reference
     *
     * @var string $ref
     */
    public $ref = '';

    /**
     * Summary
     *
     * @var string $summary
     */
    public $summary = '';

    /**
     * Notes
     *
     * @var string $notes
     */
    public $notes = '';

    /**
     * Payment instructions
     *
     * @var string $notes
     */
    public $instructions = '';

    /**
     * Currency symbol
     *
     * @var string $symbol
     */
    public $symbol = '';

    /**
     * PurchaseOrder Net value
     *
     * @var float $net
     */
    public $net = 0.00;

    /**
     * PurchaseOrder tax value
     *
     * @var float $net
     */
    public $tax = 0.00;


    /**
     * PurchaseOrder Gross value
     *
     * @var float $gross
     */
    public $gross = 0.00;

    /**
     * Constructor
     */
    public function __construct(
        Company $company,
        PurchaseOrderItems $purchaseOrderItems,
        KeyValuePairs $keyValuePairs,
        array $config
    ) {
        // populate from input array (use base class)
        $this->populate($config);
        // populate from objects
        $this->company = $company;
        $this->purchaseOrderItems = $purchaseOrderItems;
        $this->keyValuePairs = $keyValuePairs;
    }
}
