<?php

namespace Voquis\Schema\Base;

use Voquis\Schema\Base;
use Voquis\Schema\Base\Company;
use Voquis\Schema\Collection\InvoiceItems;
use Voquis\Schema\Collection\KeyValuePairs;

class Invoice extends Base
{
    /**
     * Company
     *
     * @var Company $company
     */
    public $company;

    /**
     * Invoice items collection
     *
     * @var InvoiceItems $invoiceItems
     */
    public $invoiceItems;

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
     * Invoice Net value
     *
     * @var float $net
     */
    public $net = 0.00;

    /**
     * Invoice tax value
     *
     * @var float $net
     */
    public $tax = 0.00;


    /**
     * Invoice Gross value
     *
     * @var float $gross
     */
    public $gross = 0.00;

    /**
     * Constructor
     */
    public function __construct(
        Company $company,
        InvoiceItems $invoiceItems,
        KeyValuePairs $keyValuePairs,
        array $config
    ) {
        // populate from input array (use base class)
        $this->populate($config);
        // populate from objects
        $this->company = $company;
        $this->invoiceItems = $invoiceItems;
        $this->keyValuePairs = $keyValuePairs;
    }
}
