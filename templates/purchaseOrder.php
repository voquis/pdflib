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
<?php
    echo str_repeat('<br />', 1 + count(array_filter($this->company->address->getArray())));
?>
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
                                $addressArray = $this->purchaseOrder->company->address->getArray();
                                $addressString = implode('<br />', array_filter($addressArray));
                            ?>
                            <td><?php echo($this->purchaseOrder->company->name . '<br />' . $addressString); ?></td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td width="10%"></td>

            <td width="50%">
                <table class="tbl">
                    <tbody>
                        <tr>
                            <td width="40%" class="bg-grey">Purchase Order</td>
                            <td width="60%" align="right"><?php echo($this->purchaseOrder->ref) ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php foreach ($this->purchaseOrder->keyValuePairs->items as $item) : ?>
                <table class="tbl">
                    <tbody>
                        <tr>
                            <td width="40%" class="bg-grey"><?php echo($item->key); ?></td>
                            <td width="60%" align="right"><?php echo($item->value); ?></td>
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
<table class="tbl">
    <tbody>
        <tr>
            <th align="center" class="bg-grey"><h2>Purchase Order <?php echo($this->purchaseOrder->ref); ?></h2></th>
        </tr>
        <?php if ($this->purchaseOrder->summary) : ?>
        <tr>
            <td><?php echo($this->purchaseOrder->summary); ?></td>
        </tr>
        <?php endif ?>
    </tbody>
</table>
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
        <?php foreach ($this->purchaseOrder->purchaseOrderItems->items as $item) : ?>
        <tr>
            <td class="cell item"><?php echo $item->description; ?></td>
            <td class="cell item"><?php echo $item->quantity ?></td>
            <td class="cell item"><?php echo number_format($item->unitPrice, 2) ?></td>
            <td align="right" class="item"><?php echo (number_format($item->net, 2)) ?></td>
        </tr>
        <?php endforeach ?>
        <tr>
            <td colspan="3" class="cell foot" align="right" ><strong>Net</strong></td>
            <td class="foot" align="right"><strong><?php
                echo(
                    $this->purchaseOrder->symbol . ' '
                    . number_format($this->purchaseOrder->net, 2)
                ); ?></strong></td>
        </tr>
        <tr>
            <td colspan="3" class="cell" align="right"><strong>VAT</strong></td>
            <td align="right"><strong><?php
                echo ($this->purchaseOrder->symbol . ' ' . number_format($this->purchaseOrder->tax, 2));
            ?></strong></td>
        </tr>
        <tr>
            <td colspan="3" class="cell" align="right"><strong>Total</strong></td>
            <td align="right"><strong><?php
                echo($this->purchaseOrder->symbol . ' '
                . number_format($this->purchaseOrder->gross, 2)) ?></strong></td>
        </tr>
    </tbody>
</table>

<?php if ($this->purchaseOrder->notes) : ?>
<table class="tbl">
    <tbody>
        <tr>
            <th class="bg-grey"><strong>Supplier Notes</strong></th>
        </tr>
        <tr>
            <td><?php echo($this->purchaseOrder->notes); ?></td>
        </tr>
    </tbody>
</table>
<?php endif; ?>
