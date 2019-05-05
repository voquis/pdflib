<?php

namespace Voquis;

class PurchaseOrderConfig
{
    /**
     * @var PurchaseOrderItem $purchaseOrderItem
     */
    private $purchaseOrderItem;

    /**
     * @var CustomProperty $customProperty
     */
    private $customProperty;

    public $ref = '';

    public $supplierName = '';

    public $addressLine1 = '';

    public $addressLine2 = '';

    public $addressLine3 = '';

    public $addressCity = '';

    public $addressCounty = '';

    public $addressPostcode = '';

    public $date = '';

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
    public function __construct(PurchaseOrderItem $purchaseOrderItem, CustomProperty $customProperty)
    {
        $this->purchaseOrderItem = $purchaseOrderItem;
        $this->customProperty = $customProperty;
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
        // Purchase Order fields
        $this->ref = array_key_exists('ref', $config) ? $config['ref']: '';
        $this->supplierName = array_key_exists('supplierName', $config) ? $config['supplierName'] : '';
        $this->date = array_key_exists('date', $config) ? $config['date']: '';
        $this->summary = array_key_exists('summary', $config) ? $config['summary'] : '';
        $this->instructions = array_key_exists('instructions', $config) ? $config['instructions'] : '';
        $this->notes = array_key_exists('notes', $config) ? $config['notes'] : '';
        // Purchase Order items
        if (array_key_exists('items', $config) && is_array($config['items'])) {
            foreach ($config['items'] as $item) {
                $populatedItem = $this->purchaseOrderItem->populate($item);
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
                $populatedCustomProperty = $this->customProperty->populate($customProperty);
                // Use clone otherwise last object is repeated in output
                $this->customProperties[] = clone $populatedCustomProperty;
            }
        } else {
            $this->customProperties = [];
        }
    }
}
