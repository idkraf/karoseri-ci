<div class="card no-border bg-light">    
    <div class="card-body no-border">
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div> 
        <div class="row mt-2">
            <div class="col-sm-12">
                <form action="<?php echo base_url() ?>accounting/update_sop_purchase" method="post"
                        role="form">
                        
                    <input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">

                    <input type="hidden" id="txt_tID" name="tID" value="">
                    <input type="hidden" id="txt_id" name="id" value="">

                    <div class="form-group">
                        <label id="lbl_payable">Payable</label>
                        <select id="txt_payable_id" name="payable_id" class="form-control">
                            <option value="0"> -- Pilih --</option>
                            <?php
                            foreach ($hutang as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $code = $row['code'];
                                $selected = (isset($payable_id) AND $payable_id == $id) ? 'selected' : '';
                                echo "<option value='$id' data-name='$name' $selected >$code - $name</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label id="lbl_purchase">Purchase</label>
                        <select id="txt_purchase_id" name="purchase_id" class="form-control">
                            <option value="0">-- Pilih --</option>
                            <?php
                            foreach ($persediaan as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $code = $row['code'];
                                $selected = (isset($purchase_id) AND $purchase_id == $id) ? 'selected' : '';
                                echo "<option value='$id' data-name='$name' $selected >$code - $name</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label id="lbl_disc">Disc</label>
                        <select id="txt_discount_id" name="discount_id" class="form-control">
                            <option value="0">-- Pilih --</option>
                            <?php
                            foreach ($discount as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $code = $row['code'];
                                $selected = (isset($discount_id) AND $discount_id == $id) ? 'selected' : '';
                                echo "<option value='$id' data-name='$name' $selected >$code - $name</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label id="lbl_tax">Tax</label>
                        <select id="txt_taxes_id" name="taxes_id" class="form-control">
                            <option value="0" <?php echo (isset($taxes_id) AND $taxes_id == $id) ? 'selected' : ''?>>-- Pilih --</option>
                            <?php
                            foreach ($pajak as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $code = $row['code'];
                                $selected = (isset($taxes_id) AND $taxes_id == $id) ? 'selected' : '';
                                echo "<option value='$id' data-name='$name' $selected >$code -  $name </option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label id="lbl_inventory">Inventory</label>
                        <select id="txt_inventory_id" name="inventory_id" class="form-control">
                            <option value="0">-- Pilih --</option>
                            <?php
                            foreach ($persediaan as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $code = $row['code'];
                                $selected = (isset($inventory_id) AND $inventory_id == $id) ? 'selected' : '';
                                echo "<option value='$id' data-name='$name' $selected >$code - $name</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-dark" id="_btn">Save</button>
                </form>
                <div class="text-danger text-sm mt-2" id="box_message"></div>
            </div>
        </div>
    </div>
</div>