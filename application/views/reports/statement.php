
<div class="card border  border-1 bg-light">
    <div class="card-header">
        <button class="btn btn-outline-primary rounded-0">
            <h5><?php echo $this->lang->line('Account Statement') ?></h5>
        </button>
    </div>
    <div class="card-body">
       

        <div class="card-body">
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <div class="message"></div>
            </div>
             <a  href="<?php echo base_url() ?>export/account" class="btn btn-danger rounded-0 mb-3">Export</a>
            <div class="row">
                <div class="col-md-6">
                    <div class="card border border-1">
                        <div class="card-body">
                            <form action="<?php echo base_url() ?>reports/viewstatement" method="post" role="form">
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
                                        </select>
                             

                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                           for="pay_cat"><strong><?php echo $this->lang->line('Type') ?></strong></label>
                                    
                                        <select name="trans_type" class="form-select rounded-0">
                                            <option value='All'><?php echo $this->lang->line('All Transactions') ?></option>
                                            <option value='Expense'><?php echo $this->lang->line('Debit') ?></option>
                                            <option value='Income'><?php echo $this->lang->line('Credit') ?></option>
                                        </select>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                           for="sdate"><strong><?php echo $this->lang->line('From Date') ?></strong></label>
                                    
                                        <input type="text" class="form-control rounded-0 required"
                                               placeholder="Start Date" name="sdate" id="sdate"
                                               autocomplete="false">
                                    
                                </div>
                                <div class="form-group">

                                    <label class="form-label"
                                           for="edate"><strong><?php echo $this->lang->line('To Date') ?></strong></label>
                                   
                                        <input type="text" class="form-control rounded-0 required"
                                               placeholder="End Date" name="edate"
                                               data-toggle="datepicker" autocomplete="false">
                                    
                                </div>
                                <div class="form-group">
                                   <input type="submit" class="btn btn-primary" value="View"> 

                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

