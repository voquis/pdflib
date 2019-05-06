<?php

namespace Voquis\Schema\Base;

use Voquis\Schema\Base;

/**
 * Purchase order item
 */
class PurchaseOrderItem extends Base
{
    /**
     * @var string $description
     */
    public $description;

    /**
     * @var float $quantity
     */
    public $quantity = 0.0;

    /**
     * @var float $unitPrice
     */
    public $unitPrice = 0.0;

    /**
     * @var float $taxPercent
     */
    public $taxPercent = 0.0;

    /**
     * @var float $net
     */
    public $net = 0.0;

    /**
     * @var float $tax
     */
    public $tax = 0.0;

    /**
     * @var float $gross
     */
    public $gross = 0.0;

    /**
     * Constructor
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        // populate from input array (use base class)
        $this->populate($config);
    }
}
