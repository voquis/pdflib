<?php

namespace Voquis\Schema;

/**
 *  Base schema class that must be extended (abstract)
 */
abstract class Base
{
    public function populate($config): void
    {
        // populate from input array
        foreach (get_object_vars($this) as $key => $value) {
            $this->$key = $config[$key] ?? $value;
        }
    }

    /**
     * Get this object as an array. Calls getArray method on object variables that are also objects.
     */
    public function getArray(): array
    {
        $output = [];
        foreach (get_object_vars($this) as $key => $value) {
                $output[$key] = gettype($value) === 'object' ? $value->getArray() : $value;
        }
        return $output;
    }
}
