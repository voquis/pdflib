<style>
    .tbl{
        border: 1px solid black;
        padding: 3px;
    }
    .bg-grey{
        background-color: #e6e6e6;
        border: 1px solid black;
    }
    .cell{
        border-right: 1px solid black;
    }
    .item{
        border-bottom: 1px solid black;
    }
    .foot{
        border-top: 1px solid black;
    }
    .padded{
        padding: 3px;
    }

    ul {
        list-style-type: none;
    }
</style>
<br />
<br />
<br />
<br />
<br />
<table>
    <tbody>
        <tr>
            <td width="40%"><table class="tbl">
                    <tbody>
                        <tr>
                            <td class="bg-grey">Supplier</td>
                        </tr>
                        <tr>
                            <?php
                                $customerAddress = implode('<br />', array_filter([
                                    $this->config->addressLine1,
                                    $this->config->addressLine2,
                                    $this->config->addressLine3,
                                    $this->config->addressCity,
                                    $this->config->addressCounty,
                                    $this->config->addressPostcode
                                ]))
                                ?>
                            <td><?php echo($this->config->supplierName) ?><br><?php echo ($supplierAddress); ?></td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td width="10%"></td>

            <td width="50%">
                <table class="tbl">
                    <tbody>
                        <tr>
                            <td width="40%" class="bg-grey">Date</td>
                            <td width="60%" align="right"><?php echo($this->config->purchaseOrderDate) ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="tbl">
                    <tbody>
                        <tr>
                            <td width="40%" class="bg-grey">Purchase Order Ref</td>
                            <td width="60%" align="right"><?php echo($this->config->ref) ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php foreach ($this->config->customProperties as $customProperty) : ?>
                <table class="tbl">
                    <tbody>
                        <tr>
                            <td width="40%" class="bg-grey"><?php echo($customProperty->key); ?></td>
                            <td width="60%" align="right"><?php echo($customProperty->value); ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php endforeach ?>
            </td>
        </tr>
    </tbody>
</table>
<br>
<br>
<br>
<br>
<br>
<table class="tbl">
    <tbody>
        <tr>
            <th align="center" class="bg-grey"><h2>Purchase Order <?php echo($this->config->ref); ?></h2></th>
        </tr>
        <?php if ($this->config->summary) : ?>
        <tr>
            <td><?php echo($this->config->summary); ?></td>
        </tr>
        <?php endif ?>
    </tbody>
</table>
<br>
<br>
<br>
<br>
<br>

<table class="tbl">
    <tbody>
        <tr>
            <th class="bg-grey" width="65%"><strong>Description</strong></th>
            <th class="bg-grey" width="10%"><strong>Qty</strong></th>
            <th class="bg-grey" width="10%"><strong>Unit</strong></th>
            <th class="bg-grey" width="15%" align="right"><strong>Total</strong></th>
        </tr>
        <?php foreach ($this->config->items as $item) : ?>
        <tr>
            <td class="cell item"><?php echo $item->description; ?></td>
            <td class="cell item"><?php echo $item->quantity ?></td>
            <td class="cell item"><?php echo number_format($item->unitPrice, 2) ?></td>
            <td align="right" class="item"><?php echo (number_format($item->net, 2)) ?></td>
        </tr>
        <?php endforeach ?>
        <tr>
            <td colspan="3" class="cell foot" align="right" ><strong>Net</strong></td>
            <td class="foot" align="right"><strong>&pound; <?php
                echo(number_format($this->config->net, 2)) ?></strong></td>
        </tr>
        <tr>
            <td colspan="3" class="cell" align="right"><strong>VAT</strong></td>
            <td align="right"><strong>&pound; <?php echo(number_format($this->config->vat, 2)) ?></strong></td>
        </tr>
        <tr>
            <td colspan="3" class="cell" align="right"><strong>Total</strong></td>
            <td align="right"><strong>&pound; <?php echo(number_format($this->config->gross, 2)) ?></strong></td>
        </tr>
    </tbody>
</table>

<?php if ($this->config->instructions) : ?>
<table class="tbl">
    <tbody>
        <tr>
            <th class="bg-grey"><strong>Supplier Instructions</strong></th>
        </tr>
        <tr>
            <td><?php echo($this->config->instructions); ?></td>
        </tr>
    </tbody>
</table>
<?php endif; ?>
<?php if ($this->config->notes) : ?>
<table class="tbl">
    <tbody>
        <tr>
            <th class="bg-grey"><strong>Additional Notes</strong></th>
        </tr>
        <tr>
            <td><?php echo($this->config->notes); ?></td>
        </tr>
    </tbody>
</table>
<?php endif; ?>