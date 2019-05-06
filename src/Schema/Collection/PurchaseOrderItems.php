<?php

namespace Voquis\Schema\Collection;

use Voquis\Schema\Collection;

use Voquis\Schema\Base\PurchaseOrderItem;

class PurchaseOrderItems extends Collection
{
    public $items = [];

    public function __construct(array $items)
    {
        $this->populate(PurchaseOrderItem::class, $items);
    }
}
