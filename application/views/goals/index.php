<div class="card border border-1 bg-light  rounded-0">
    <div class="card-header">
        <div class="btn btn-outline-warning rounded-0">
            <strong><?php echo $this->lang->line('Set Goals') ?></strong>
            <small>(in <?php echo $this->config->item('currency') ?>)</small>
        </div>
    </div>
    <div class="card-body">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card border border-1">
                        <div class="card-body">
                            <form method="post" id="data_form" class="form-horizontal">

                                <div class="form-group">

                                    <label class="form-label" for="income"><?php echo $this->lang->line('Income') ?></label>
                                  
                                        <input type="text" placeholder="Income"
                                               class="form-control rounded-0  required" name="income"
                                               value="<?php echo $goals['income'] ?>">
                                 
                                </div>

                                <div class="form-group">

                                    <label class="form-label"
                                           for="expense"><?php echo $this->lang->line('Expenses') ?></label>

                                   
                                        <input type="text" placeholder="Expenses"
                                               class="form-control rounded-0  required" name="expense"
                                               value="<?php echo $goals['expense'] ?>">
                             
                                </div>

                                <div class="form-group">
                                    <label class="form-label"
                                           for="sales"><?php echo $this->lang->line('Sales') ?></label>
                                   
                                        <input type="text" placeholder="Sales"
                                               class="form-control rounded-0  required" name="sales"
                                               value="<?php echo $goals['sales'] ?>">
                                   
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                           for="netincome"><?php echo $this->lang->line('Net Income') ?></label>
                                    
                                        <input type="text" placeholder="Net Income"
                                               class="form-control rounded-0  required" name="netincome"
                                               value="<?php echo $goals['netincome'] ?>">
                                   
                                </div>
                                
                                   
                                 
                                        <input type="submit" id="submit-data" class="btn btn-primary float-end mt-2" value="<?php echo $this->lang->line('Update') ?>" data-loading-text="Adding...">
                                        <input type="hidden" value="tools/setgoals" id="action-url">
                                   
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
