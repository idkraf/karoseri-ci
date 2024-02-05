<div class="card border border-1 bg-light p-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <button type="button" class="btn btn-outline-primary rounded-0">
                    <?php echo $this->lang->line('Customer') . ' ' . $this->lang->line('Credit Notes') ?> 
                </button>
            </div>
            <div class="col-md-6">
                <a href="<?php echo base_url('stockreturn/create_note') ?>" class="btn btn-primary float-end rounded"><?php echo $this->lang->line('Add new'); ?></a>
            </div>
        </div>
    </div>
    <div class="card-body border border-2">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>
        <div class="card-body">
            <div class="card border border-1">
                <div class="card-body">
                    <div class="row">
                
                <div class="col-md-2">
                    <label><strong><?php echo $this->lang->line('Date') ?></strong></label>
                    <input type="text" name="start_date" id="start_date"
                           class="date30 form-control rounded-0" autocomplete="off"/>
                </div>
                <div class="col-md-2">
                    <label><strong><?php echo $this->lang->line('Date') ?></strong></label>
                    <input type="text" name="end_date" id="end_date" class="form-control rounded-0"
                           data-toggle="datepicker" autocomplete="off"/>
                </div>
                <div class="col-md-2">
                    <input type="button" name="search" id="search" value="Search" class="btn btn-warning mt-4 border border-1 border-primary rounded-0 btn-sm"/>
                </div>
            </div>
                </div>
            </div>
            
            <div class="card border border-1">
                <div class="card-body">
                    <table id="invoices_c" class="table table-striped table-bordered  table-sm table-hover">
                <thead>
                    <tr>
                        <th><?php echo $this->lang->line('No') ?></th>
                        <th>Order #</th>
                        <th><?php echo $this->lang->line('Customer') ?></th>
                        <th><?php echo $this->lang->line('Date') ?></th>
                        <th><?php echo $this->lang->line('Amount') ?></th>
                        <th><?php echo $this->lang->line('Status') ?></th>
                        <th class="no-sort"><?php echo $this->lang->line('Settings') ?></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>

                <tfoot>
                    <tr>
                        <th><?php echo $this->lang->line('No') ?></th>
                        <th>Order #</th>
                        <th><?php echo $this->lang->line('Customer') ?></th>
                        <th><?php echo $this->lang->line('Date') ?></th>
                        <th><?php echo $this->lang->line('Amount') ?></th>
                        <th><?php echo $this->lang->line('Status') ?></th>
                        <th class="no-sort"><?php echo $this->lang->line('Settings') ?></th>
                    </tr>
                </tfoot>
            </table>
                </div>
            </div>
          
        </div>
    </div>


</div>
<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Delete Order') ?></h4>
                
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('delete this order') ?></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="stockreturn/delete_i">
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete-confirm">Delete
                </button>
                <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
    draw_data();
    function draw_data(start_date = '', end_date = '') {
    $('#invoices_c').DataTable({
    'processing': true,
            'serverSide': true,
            'stateSave': true,
            responsive: true,
<?php datatable_lang(); ?>
    'order': [],
            'ajax': {
            'url': "<?php echo site_url('stockreturn/ajax_list?t=2') ?>",
                    'type': 'POST',
                    'data': {
                    '<?= $this->security->get_csrf_token_name() ?>': crsf_hash,
                            start_date: start_date,
                            end_date: end_date
                    }
            },
            'columnDefs': [
            {
            'targets': [0],
                    'orderable': false,
            },
            ],
            dom: 'Blfrtip',
            buttons: [
            {
            extend: 'excelHtml5',
                    footer: true,
                    exportOptions: {
                    columns: [1, 2, 3, 4, 5]
                    }
            }
            ],
    });
    };
    $('#search').click(function () {
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    if (start_date != '' && end_date != '') {
    $('#invoices_c').DataTable().destroy();
    draw_data(start_date, end_date);
    } else {
    alert("Date range is Required");
    }
    });
    });
</script>
