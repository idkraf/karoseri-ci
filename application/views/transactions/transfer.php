<div class="card border border-1 bg-light">
    <div class="card-header">
        <button class="btn btn-outline-warning rounded-0 text-dark">
            <h5><?php echo $this->lang->line('Add New Transfer'); ?></h5>
        </button>
    </div>
    <div class="card-content">
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card border border-1">
                <div class="card-body">
                    <form method="post" id="data_form" class="form-horizontal">
                <div class="form-group">
                    <label class="form-label" for="pay_cat"><strong><?php echo $this->lang->line('From Account') ?></strong></label>
                    
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
                <div class="form-grou">
                    <label class="form-label" for="pay_cat"><strong><?php echo $this->lang->line('To Account') ?></strong></label>
                  
                        <select name="pay_acc2" class="form-select rounded-0">
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
                    <label class="form-label" for="amount"><strong><?php echo $this->lang->line('Amount') ?></strong></label>
                    <input type="text" placeholder="Amount" class="form-control rounded-0  required" name="amount">
                    
                </div>
                <div class="form-group">
                   
                 
                        <input type="submit" id="submit-data" class="btn btn-primary"
                               value="<?php echo $this->lang->line('Add transaction') ?>"
                               data-loading-text="Adding...">
                        <input type="hidden" value="transactions/save_transfer" id="action-url">
                 
                </div>
            </form>
                </div>
            </div>
                </div>
            </div>
            
           
        </div>
    </div>
</div>

