<div class="card border border-1 bg-light">
    <div class="card-header">
        <button class="btn btn-outline-warning rounded-0 text-dark">
            <h5><?php echo $this->lang->line('Supplier') . ' ' . $this->lang->line('Account Statement') ?></h5>
        </button>
    </div>
    <div class="card-body">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card-body">
                    <div class="card border border-1">
                        <div class="card-body">
                            <form action="<?php echo base_url() ?>reports/supplierviewstatement" method="post" role="form">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                       value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <div class="form-group">
                                    <label class="form-label"
                                           for="pay_cat"><strong><?php echo $this->lang->line('Supplier') ?></strong></label>
                                    
                                        <select name="supplier" class="form-control" id="customer_statement">
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
                                               data-toggle="datepicker" autocomplete="false">
                               
                                </div>
                                <div class="form-group">
                                    <label class="form-label"
                                           for="edate"><strong><?php echo $this->lang->line('To Date') ?></strong></label>
                                    
                                        <input type="text" class="form-control rounded-0 required"
                                               placeholder="End Date" name="edate"
                                               data-toggle="datepicker" autocomplete="false">
                                    
                                </div>
                                <div class="form-group">
                                    
                                    
                                        <input type="submit" class="btn btn-primary btn-md" value="View">
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#customer_statement").select2({
        minimumInputLength: 4,
        tags: [],
        ajax: {
            url: baseurl + 'search/supplier_select',
            dataType: 'json',
            type: 'POST',
            quietMillis: 50,
            data: function (supplier) {
                return {
                    supplier: supplier,
                    '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
        }
    });
</script>
