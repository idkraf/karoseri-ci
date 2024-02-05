<div class="card border border-1 rounded-0 bg-light">
    <div class="card-header">
        <button class="btn btn-outline-warning rounded-0 text-dark">
            <h5><?php echo $this->lang->line('Export Customers & Suppliers') ?></h5>
        </button>
    </div>
    <div class="card-body">
        <div class="card border border-1">
            <div class="card-body">
                <form method="post" action="<?php echo base_url('export/crm_now') ?>" class="form-horizontal">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                           value="<?php echo $this->security->get_csrf_hash(); ?>">


                    <div class="form-group row">
                        <div class="col-sm-4">
                            <select name="type" class="form-select rounded-0">
                                <option value="1"><?php echo $this->lang->line('Customers') ?></option>
                                <option value="2"><?php echo $this->lang->line('Suppliers') ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <input type="submit" class="btn btn-primary rounded-0"
                                   value="<?php echo $this->lang->line('Export File') ?>"
                                   data-loading-text="Updating...">
                        </div>
                    </div>
                </form>
            </div>
        </div>    
    </div>
</div>
