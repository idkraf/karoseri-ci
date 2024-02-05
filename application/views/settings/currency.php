<div class="card border border-1 bg-light shadow">
    <div id="notify" class="alert alert-success" style="display:none;">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <div class="message"></div>
    </div>
    <form method="post" id="product_action" class="form-horizontal">
        <div class="card-body">
            <div class="card-body border border-2 border-success">
                <a class="btn btn-success rounded-0 top-badge"><?php echo $this->lang->line('Currency Format') ?></a>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border border-1">
                            <div class="card-body">
                                <div class="form-group">

                                    <label class="form-label" for="invoiceprefix"><?php echo $this->lang->line('Currency') ?></label>
                                    <input type="text"
                                           class="form-control rounded-0 rounded-0" name="currency"
                                           value="<?php echo $currency['currency'] ?>">

                                </div>

                                <div class="form-group">

                                    <label class="form-label" for="currency"><?php echo $this->lang->line('Decimal Saparator') ?></label>


                                    <select name="deci_sep" class="form-select rounded-0">
                                        <?php
                                        echo '<option value="' . $currency['key1'] . '">' . $currency['key1'] . '</option>';
                                        ?>
                                        <option value=",">, (Comma)</option>
                                        <option value=".">. (Dot)</option>
                                        <option value="">None</option>
                                    </select>

                                </div>
                                <div class="form-group">

                                    <label class="form-label"
                                           for="thous_sep"><?php echo $this->lang->line('Thousand Saparator') ?></label>


                                    <select name="thous_sep" class="form-select rounded-0">
                                        <?php echo '<option value="' . $currency['key2'] . '">' . $currency['key2'] . '</option>'; ?>
                                        <option value=",">, (Comma)</option>
                                        <option value=".">. (Dot)</option>
                                        <option value="">None</option>
                                    </select>

                                </div>

                                <div class="form-group">

                                    <label class="form-label"
                                           for="currency"><?php echo $this->lang->line('Decimal Place') ?></label>


                                    <select name="decimal" class="form-select rounded-0">
                                        <?php echo '<option value="' . $currency['url'] . '">' . $currency['url'] . '</option>'; ?>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>

                                </div>

                                <div class="form-group">

                                    <label class="form-label"
                                           for="spost"><?php echo $this->lang->line('Symbol Position') ?></label>


                                    <select name="spos" class="form-select rounded-0">
                                        <?php
                                        if ($currency['method'] == 'l')
                                            $method = '**Left**';
                                        else
                                            $method = '**Right**';
                                        echo '<option value="' . $currency['method'] . '">' . $method . '</option>';
                                        ?>
                                        <option value="l">Left</option>
                                        <option value="r">Right</option>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label class="form-label"
                                           for="spost"><?php echo $this->lang->line('Invoice') ?><?php echo $this->lang->line('Round Off') ?></label>

                                    <select name="roundoff" class="form-select rounded-0">
                                        <?php
                                        if ($currency['other'] == 'PHP_ROUND_HALF_UP') {
                                            $method = '**ROUND_HALF_UP**';
                                        } elseif ($currency['other'] == 'PHP_ROUND_HALF_DOWN') {
                                            $method = '**ROUND_HALF_DOWN**';
                                        } else {
                                            $method = '**Off**';
                                        }
                                        echo '<option value="' . $currency['other'] . '">' . $method . '</option>';
                                        ?>
                                        <option value="">Off</option>
                                        <option value="PHP_ROUND_HALF_UP">ROUND_HALF_UP</option>
                                        <option value="PHP_ROUND_HALF_DOWN">ROUND_HALF_DOWN</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                           for="spost"><?php echo $this->lang->line('Round Off') ?> Precision</label>
                                    <select name="r_precision" class="form-select rounded-0">
                                        <?php echo '<option value="' . $currency['active'] . '">' . $currency['active'] . '</option>'; ?>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <input type="submit" id="billing_update" class="btn btn-danger rounded-0 float-end"
                                           value="<?php echo $this->lang->line('Update') ?>" data-loading-text="Updating...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</article>
<script type="text/javascript">
    $("#billing_update").click(function (e) {
        e.preventDefault();
        var actionurl = baseurl + 'settings/currency';
        actionProduct(actionurl);
    });
</script>

