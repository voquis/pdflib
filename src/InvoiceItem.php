<?php

namespace Voquis;

class InvoiceItem
{
    public $description = '';

    public $quantity = 0.0;

    public $unitPrice = 0.0;

    public $vatPercent = 0.00;

    public $net = 0.00;

    public $vat = 0.00;

    public $gross = 0.00;

    /**
     * Populate
     */
    public function populate(array $item)
    {
        $this->reset();
        // supplied fields
        $this->description = array_key_exists('description', $item) ? $item['description'] : '';
        $this->quantity = array_key_exists('quantity', $item) ? $item['quantity'] : 0.00;
        $this->unitPrice = array_key_exists('unitPrice', $item) ? $item['unitPrice'] : 0.00;
        $this->vatPercent = array_key_exists('vatPercent', $item) ? $item['vatPercent'] : 0.00;
        // calculated fields
        $this->net = $this->quantity * $this->unitPrice;
        $this->vat = $this->net * ($this->vatPercent/100);
        $this->gross = $this->vat + $this->net;
        // Return self for method chaining and copying object after population
        return $this;
    }

    /**
     * Reset current object
     */
    public function reset()
    {
        $this->description = '';
        $this->quantity = 0.00;
        $this->unitPrice = 0.00;
        $this->vatPercent = 0.00;
        // calculated fields
        $this->net = 0.00;
        $this->vat = 0.00;
        $this->gross = 0.00;
    }
}
