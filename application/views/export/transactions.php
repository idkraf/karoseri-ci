<div class="card border border-1 bg-light">
    <div class="card-header">
        <button class="btn btn-outline-warning rounded-0 text-dark">
            <h5><?php echo $this->lang->line('Transactions Export') ?></h5>
        </button>
    </div>
    <div class="card-body">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card border border-1">
                        <div class="card-body">
                            <form action="<?php echo base_url() ?>export/transactions_o" method="post" role="form">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                       value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <div class="form-group">
                                    <label class="form-label" for="pay_cat"><strong><?php echo $this->lang->line('Account') ?></strong></label>
                                    <select name="pay_acc" class="form-select rounded-0">
                                        <?php
                                        foreach ($accounts as $row) {
                                            $cid = $row['id'];
                                            $acn = $row['acn'];
                                            $holder = $row['holder'];
                                            echo "<option value='$cid'>$acn - $holder</option>";
                                        }
                                        ?>
                                        <option value='All'><?php echo $this->lang->line('All Accounts') ?></option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label class="form-label"  for="pay_cat"><?php echo $this->lang->line('Type') ?></label>
                                    <select name="trans_type" class="form-select rounded-0">
                                        <option value='All'><?php echo $this->lang->line('All Transactions') ?></option>
                                        <option value='Expense'><?php echo $this->lang->line('Debit') ?></option>
                                        <option value='Income'><?php echo $this->lang->line('Credit') ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="sdate"><?php echo $this->lang->line('From Date') ?></label>
                                    <input type="text" class="form-control required" placeholder="Start Date" name="sdate" id="sdate" data-toggle="datepicker" autocomplete="false">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="edate"><?php echo $this->lang->line('To Date') ?></label>
                                    <input type="text" class="form-control required" placeholder="End Date" name="edate" data-toggle="datepicker" autocomplete="false">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="pay_cat"></label>
                                    <input type="submit" class="btn btn-primary btn-md" value="<?php echo $this->lang->line('Export') ?>">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
