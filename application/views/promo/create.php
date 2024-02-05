<div class="card border border-1 bg-light">
    <div class="card-header">
        <button class="btn btn-outline-warning rounded-0 text-dark">
            <h5><?php echo $this->lang->line('Add Promo') ?></h5>
        </button>
        
    </div>
    <div class="card-body">
        
        <div class="card-body">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card border border-1">
                <div class="card-body">
                    <form method="post" id="data_form" class="form-horizontal">
                <div class="form-group">
                    <label class="form-label" for="code"><strong><?php echo $this->lang->line('Code') ?></strong></label>
                    <input type="text" placeholder="Code" class="form-control rounded-0 required" name="code" value="<?php echo $this->coupon->generate(8) ?>">
                    
                </div>
                <div class="form-group">
                    <label class="form-label" for="amount"><strong><?php echo $this->lang->line('Amount') ?></strong></label>
                   <input type="text" placeholder="Amount" class="form-control rounded-0  required" name="amount" value="0"
                               onkeypress="return isNumber(event)">
                    
                </div>
                <div class="form-group">
                    <label class="form-label" for="qty"><strong><?php echo $this->lang->line('Qty') ?></strong></label>
                    <input type="number" placeholder="Amount" class="form-control rounded-0  required" name="qty" value="1">
                    
                </div>
                <div class="form-group">
                    <label class="form-label" for="valid"><strong><?php echo $this->lang->line('Valid') ?></strong></label>
                    <input type="text" class="form-control rounded-0 required" placeholder="Start Date" name="valid" data-toggle="datepicker" autocomplete="false">
                    
                </div>
                <div class="form-group">
                    <label class="form-label" for="link_ac"><strong><?php echo $this->lang->line('Link to account') ?></strong></label>
                   
                        <fieldset>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="link_ac" id="customRadio1"
                                       value="yes" checked="">
                                <label class="custom-control-label"
                                       for="customRadio1"><?php echo $this->lang->line('Yes') ?> &nbsp;</label>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="link_ac" id="customRadio2"
                                       value="no">
                                <label class="custom-control-label"
                                       for="customRadio2"><?php echo $this->lang->line('No') ?></label>
                            </div>
                        </fieldset>
                    
                </div>
                <div class="form-group">
                    <label class="form-label" for="pay_acc"><?php echo $this->lang->line('Account') ?></label>
                    
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
                    <label class="form-label" for="note"><?php echo $this->lang->line('Note') ?></label>
                    <input type="text" placeholder="Short Note" class="form-control rounded-0" name="note">
                   
                </div>
                <div class="form-group">
               
                        <input type="submit" id="submit-data" class="btn btn-primary"
                               value="<?php echo $this->lang->line('Add') ?>" data-loading-text="Adding...">
                        <input type="hidden" value="promo/create" id="action-url">
                  
                </div>
            </form>
                </div>
            </div>
                </div>
            </div>
                   
            
        </div>
    </div>
</div>
