<div class="card border border-1 bg-light">
    <div class="card-header">
        <a href="<?php echo base_url('employee/adddep') ?>" class="btn btn-primary rounded-0">
            Add New Department
        </a>
    </div>
    <div class="card-body">
        <div class="card bg-light">
            <div class="card-header bg-light">
                <button class="btn btn-outline-warning rounded-0 text-dark">
                    <h5><?php echo $this->lang->line('Export Products') ?></h5>
                </button>
            </div>
          
               
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border border-1">
                        <div class="card-body">
                            <form method="post" action="<?php echo base_url('export/products_o') ?>">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                       value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <div class="form-group">
                                    <select name="type" class="form-select rounded-0">
                                        <option value="1"><?php echo $this->lang->line('Products') ?></option>
                                        <option value="2"><?php echo $this->lang->line('Products with categories') ?></option>
                                    </select>
                                </div>
                                <div class="form-group mt-4 text-center">
                                    
                                        <input type="submit" class="btn btn-primary" value="Backup" data-loading-text="Updating...">
                                    
                                </div>
                            </form>
                        </div>

                    </div>
                        </div>
                    </div>
                    

                </div>
            
        </div>
    </div>
</div>    

<script type="text/javascript">
    $(function () {
        $('.summernote').summernote({
            height: 250,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']]

            ]
        });
    });
</script>

