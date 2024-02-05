<div class="card border border-1 bg-light rounded-0">
    <div class="card-header">
        <button class="btn btn-outline-warning rounded-0 text-dark">
            <h5><?php echo $this->lang->line('Expense Statement') ?></h5>
        </button>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card border border-1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn btn-primary rounded-0" style="width:100%">
                                    <?php echo $this->lang->line('This Month Expenses') ?><?php echo amountExchange($income['monthinc'], 0, $this->aauth->get_user()->loc) ?> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn btn-danger rounded-0 mt-2" style="width:100%">
                                    <p id="param1">xxxxxxxxxx</p>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card border border-1 bg-light rounded-0">
    <div class="card-header">
        <button class="btn btn-outline-warning rounded-0">
            <h5><?php echo $this->lang->line('Custom Range') ?></h5>
        </button>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card border border-1">
                    <div class="card-body">
                        <form method="post" id="product_action">
                            <div class="form-group">
                                <label class="form-label" for="pay_cat"><strong><?php echo $this->lang->line('Account') ?></strong></label>
                                <select name="pay_acc" class="form-select rounded-0">
                                    <option value='0'><?php echo $this->lang->line('All Accounts') ?></option>
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
                                       for="sdate"><strong><?php echo $this->lang->line('From Date') ?></strong></label>
                             
                                    <input type="text" class="form-control rounded-0 required"
                                           placeholder="Start Date" name="sdate" id="sdate"
                                           data-toggle="datepicker" autocomplete="false">
                            
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="edate"><strong><?php echo $this->lang->line('To Date') ?></strong></label>
                                <input type="text" class="form-control rounded-0 required" placeholder="End Date" name="edate" data-toggle="datepicker" autocomplete="false">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="check" value="ok">
                                <input type="submit" id="calculate_expense" class="btn btn-primary rounded-0"
                                           value="<?php echo $this->lang->line('Calculate') ?>"
                                           data-loading-text="Calculating...">
                          
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>

