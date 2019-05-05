<?php

namespace Voquis;

class InvoiceConfig
{
    /**
     * @var InvoiceItem $invoiceItem
     */
    private $invoiceItem;

    /**
     * @var InvoiceCustomProperty $invoiceCustomProperty
     */
    private $invoiceCustomProperty;

    private $invoiceRef;

    public $ref = '';

    public $customerName = '';

    public $addressLine1 = '';

    public $addressLine2 = '';

    public $addressLine3 = '';

    public $addressCity = '';

    public $addressCounty = '';

    public $addressPostcode = '';

    public $taxPoint = '';

    public $items = [];

    public $summary = '';

    public $notes = '';

    public $instructions = '';

    public $net = 0.00;

    public $vat = 0.00;

    public $gross = 0.00;

    public $customProperties = [];

    /**
     * Construct
     */
    public function __construct(InvoiceItem $invoiceItem, InvoiceCustomProperty $invoiceCustomProperty)
    {
        $this->invoiceItem = $invoiceItem;
        $this->invoiceCustomProperty = $invoiceCustomProperty;
    }

    /**
     * Populate
     */
    public function populate(array $config)
    {
        // Address fields
        $this->addressLine1 = array_key_exists('addressLine1', $config) ? $config['addressLine1'] : '';
        $this->addressLine2 = array_key_exists('addressLine2', $config) ? $config['addressLine2'] : '';
        $this->addressLine3 = array_key_exists('addressLine3', $config) ? $config['addressLine3'] : '';
        $this->addressCity = array_key_exists('addressCity', $config) ? $config['addressCity'] : '';
        $this->addressCounty = array_key_exists('addressCounty', $config) ? $config['addressCounty'] : '';
        $this->addressPostcode = array_key_exists('addressPostcode', $config) ? $config['addressPostcode'] : '';
        // Invoice fields
        $this->ref = array_key_exists('ref', $config) ? $config['ref']: '';
        $this->customerName = array_key_exists('customerName', $config) ? $config['customerName'] : '';
        $this->taxPoint = array_key_exists('taxPoint', $config) ? $config['taxPoint']: '';
        $this->summary = array_key_exists('summary', $config) ? $config['summary'] : '';
        $this->instructions = array_key_exists('instructions', $config) ? $config['instructions'] : '';
        $this->notes = array_key_exists('notes', $config) ? $config['notes'] : '';
        // Invoice items
        if (array_key_exists('items', $config) && is_array($config['items'])) {
            foreach ($config['items'] as $item) {
                $populatedItem = $this->invoiceItem->populate($item);
                // Calculate totals
                $this->net += $populatedItem->net;
                $this->vat += $populatedItem->vat;
                $this->gross += $populatedItem->gross;
                // Use clone otherwise last object is repeated in output
                $this->items[] = clone $populatedItem;
            }
        } else {
            $this->items = [];
        }
        // Custom Properties
        if (array_key_exists('customProperties', $config) && is_array($config['customProperties'])) {
            foreach ($config['customProperties'] as $customProperty) {
                $populatedCustomProperty = $this->invoiceCustomProperty->populate($customProperty);
                // Use clone otherwise last object is repeated in output
                $this->customProperties[] = clone $populatedCustomProperty;
            }
        } else {
            $this->customProperties = [];
        }
    }
}
