<?php

namespace Voquis\Schema\Collection;

use Voquis\Schema\Collection;

use Voquis\Schema\Base\KeyValuePair;

class KeyValuePairs extends Collection
{
    public $items = [];

    public function __construct(array $items)
    {
        $this->populate(KeyValuePair::class, $items);
    }
}
