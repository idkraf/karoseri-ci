<div class="card no-border bg-light">    
    <div class="card-body no-border">
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div> 
        <div class="row mt-2">
            <div class="col-sm-12">
                <form action="<?php echo base_url() ?>accounting/update_sop_cashbond" method="post"
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
                    
                    <br>
                    <button type="submit" class="btn btn-dark" id="_btn">Save</button>
                </form>
                <div class="text-danger text-sm mt-2" id="box_message"></div>
            </div>
        </div>
    </div>
</div>