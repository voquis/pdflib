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
                            <td class="bg-grey">Customer</td>
                        </tr>
                        <tr>
                            <?php
                                $customerAddressArray = $this->invoice->company->address->getArray();
                                $customerAddressString = implode('<br />', array_filter($customerAddressArray));
                            ?>
                            <td><?php echo($this->invoice->company->name . '<br />' . $customerAddressString); ?></td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td width="10%"></td>

            <td width="50%">
                <table class="tbl">
                    <tbody>
                        <tr>
                            <td width="40%" class="bg-grey">Invoice Ref</td>
                            <td width="60%" align="right"><?php echo($this->invoice->ref) ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php foreach ($this->invoice->keyValuePairs->items as $item) : ?>
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
<br>
<br>
<br>
<table class="tbl">
    <tbody>
        <tr>
            <th align="center" class="bg-grey"><h2>Invoice <?php echo($this->invoice->ref); ?></h2></th>
        </tr>
        <?php if ($this->invoice->summary) : ?>
        <tr>
            <td><?php echo($this->invoice->summary); ?></td>
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
        <?php foreach ($this->invoice->invoiceItems->items as $item) : ?>
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
                    $this->invoice->symbol . ' '
                    . number_format($this->invoice->net, 2)
                ); ?></strong></td>
        </tr>
        <tr>
            <td colspan="3" class="cell" align="right"><strong>VAT</strong></td>
            <td align="right"><strong><?php
                echo ($this->invoice->symbol . ' ' . number_format($this->invoice->tax, 2));
            ?></strong></td>
        </tr>
        <tr>
            <td colspan="3" class="cell" align="right"><strong>Total</strong></td>
            <td align="right"><strong><?php
                echo($this->invoice->symbol . ' '
                . number_format($this->invoice->gross, 2)) ?></strong></td>
        </tr>
    </tbody>
</table>

<?php if ($this->invoice->instructions) : ?>
<table class="tbl">
    <tbody>
        <tr>
            <th class="bg-grey"><strong>Payment Instructions</strong></th>
        </tr>
        <tr>
            <td><?php echo($this->invoice->instructions); ?></td>
        </tr>
    </tbody>
</table>
<?php endif; ?>
<?php if ($this->invoice->notes) : ?>
<table class="tbl">
    <tbody>
        <tr>
            <th class="bg-grey"><strong>Additional Notes</strong></th>
        </tr>
        <tr>
            <td><?php echo($this->invoice->notes); ?></td>
        </tr>
    </tbody>
</table>
<?php endif; ?>