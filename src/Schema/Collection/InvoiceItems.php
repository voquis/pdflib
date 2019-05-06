<?php

namespace Voquis\Schema\Collection;

use Voquis\Schema\Collection;

use Voquis\Schema\Base\InvoiceItem;

class InvoiceItems extends Collection
{
    public $items = [];

    public function __construct(array $items)
    {
        $this->populate(InvoiceItem::class, $items);
    }
}
