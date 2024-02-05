<div class="card border border-1 bg-light">
    <div class="card-header">
        <button class="btn btn-outline-warning rounded-0 text-dark">
            <h5><?php echo $this->lang->line('Add') . ' ' . $this->lang->line('Department') ?></h5>
        </button>
    </div>
    <div class="card-body">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card border border-1">
                    <div class="card-body">
                        <form method="post" id="data_form">
                            <div class="form-group">
                                <label class="form-label" for="note"><strong><?php echo $this->lang->line('Name') ?></strong></label>
                                <input type="text" placeholder="Department Name" class="form-control rounded-0 b_input required" name="name">
                            </div>
                            <div class="form-group text-center">
                                <label class="form-label"></label>
                                <input type="submit" id="submit-data" class="btn btn-primary" value="<?php echo $this->lang->line('Add') ?>" data-loading-text="Adding...">
                                <input type="hidden" value="employee/adddep" id="action-url">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>