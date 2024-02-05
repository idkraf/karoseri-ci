<div class="card no-border bg-light">    
    <div class="card-body no-border">
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div> 
        <div class="row mt-2">
            <div class="col-sm-12">
                <form action="<?php echo base_url() ?>accounting/update_sop_project" method="post"
                        role="form">
                        
                    <input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">

                    <input type="hidden" id="txt_tID" name="tID" value="">
                    <input type="hidden" id="txt_id" name="id" value="">

                    <div class="form-group">
                        <label id="lbl_payable">Receivable</label>
                        <select name="receivable_id" class="form-control">
                            <option value="0"> -- Pilih --</option>
                            <?php
                            foreach ($receivable as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $code = $row['code'];
                                $selected = (isset($receivable_id) AND $receivable_id == $id) ? 'selected' : '';
                                echo "<option value='$id' data-name='$name' $selected >$code - $name</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label id="lbl_sale">Sale</label>
                        <select name="sale_id" class="form-control">
                            <option value="0">-- Pilih --</option>
                            <?php
                            foreach ($sale as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $code = $row['code'];
                                $selected = (isset($sale_id) AND $sale_id == $id) ? 'selected' : '';
                                echo "<option value='$id' data-name='$name' $selected >$code - $name</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label id="lbl_disc">Disc</label>
                        <select name="discount_id" class="form-control">
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
                        <label id="lbl_tax">Tax PPN</label>
                        <select id="txt_taxes_id" name="ppn_id" class="form-control">
                            <option value="0" >-- Pilih --</option>
                            <?php
                            foreach ($pajak as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $code = $row['code'];
                                $selected = (isset($ppn_id) AND $ppn_id == $id) ? 'selected' : '';
                                echo "<option value='$id' data-name='$name' $selected >$code -  $name </option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label id="lbl_tax">Tax PPH</label>
                        <select id="txt_taxes_id" name="pph_id" class="form-control">
                            <option value="0" >-- Pilih --</option>
                            <?php
                            foreach ($pajak as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $code = $row['code'];
                                $selected = (isset($pph_id) AND $pph_id == $id) ? 'selected' : '';
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
                            foreach ($inventory as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $code = $row['code'];
                                $selected = (isset($inventory_id) AND $inventory_id == $id) ? 'selected' : '';
                                echo "<option value='$id' data-name='$name' $selected >$code - $name</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Cogs</label>
                        <select name="cogs_id" class="form-control">
                            <option value="0" >-- Pilih --</option>
                            <?php
                            foreach ($cogs as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $code = $row['code'];
                                $selected = (isset($cogs_id) AND $cogs_id == $id) ? 'selected' : '';
                                echo "<option value='$id' data-name='$name' $selected >$code -  $name </option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Cost</label>
                        <select name="cost_id" class="form-control">
                            <option value="0" >-- Pilih --</option>
                            <?php
                            foreach ($cost as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $code = $row['code'];
                                $selected = (isset($cost_id) AND $cost_id == $id) ? 'selected' : '';
                                echo "<option value='$id' data-name='$name' $selected >$code -  $name </option>";
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