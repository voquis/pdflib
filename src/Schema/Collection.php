<?php

namespace Voquis\Schema;

/**
 *  Collection schema class that must be extended (abstract)
 */
abstract class Collection
{
    public $items = [];

    /**
     * Populate array of objects
     */
    public function populate(string $className, $items): void
    {
        // populate each item
        foreach ($items as $item) {
            $this->items[] = new $className($item);
        }
    }

    /**
     * Get this object as an array. Calls getArray method on object variables that are also objects.
     */
    public function getArray(): array
    {
        $output = [];
        foreach ($this->items as $item) {
            $output[] = $item->getArray();
        }
        return $output;
    }
}
