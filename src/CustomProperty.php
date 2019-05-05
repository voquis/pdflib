<?php

namespace Voquis;

class CustomProperty
{
    public $key = '';

    public $value = '';

    /**
     * Populate
     */
    public function populate(array $item): CustomProperty
    {
        $this->reset();
        // supplied fields
        $this->key = array_key_exists('key', $item) ? $item['key'] : '';
        $this->value = array_key_exists('value', $item) ? $item['value'] : '';
        // Return self for method chaining and copying object after population
        return $this;
    }

    /**
     * Reset current object
     */
    public function reset(): CustomProperty
    {
        $this->key = '';
        $this->value = '';
        return $this;
    }
}
