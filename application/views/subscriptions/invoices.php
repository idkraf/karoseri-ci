<div class="card border border-1 bg-light p-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4 class="card-title"><?php echo $this->lang->line('Subscriptions') ?></h4>
            </div>
            <div class="col-md-6">
                <a  href="<?php echo base_url('subscriptions/create') ?>" class="float-end btn btn-primary btn-sm rounded">
                    <?php echo $this->lang->line('Add new') ?>
                </a>
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
                    <label><strong><?php echo $this->lang->line('Invoice Date') ?></strong></label>
                    <input type="text" name="start_date" id="start_date" class="date30 form-control rounded-0" autocomplete="off"/>
                </div>
                <div class="col-md-2">
                    <label><strong><?php echo $this->lang->line('Invoice Date') ?></strong></label>
                    <input type="text" name="end_date" id="end_date" class="form-control rounded-0"  data-toggle="datepicker" autocomplete="off"/>
                </div>
                <div class="col-md-2">
                    <input type="button" name="search" id="search" value="Search" class="btn btn-warning text-white border border-1 border-primary rounded-0 mt-4 btn-sm"/>
                </div>
            </div>
                </div>
            </div>
            
            <div class="card border border-1 p-4">
                <div class="card-body">
                    <table id="subs" class="table table-striped table-bordered zero-configuration table-hover table-sm">
                <thead>
                    <tr>
                        <th><?php echo $this->lang->line('No') ?></th>
                        <th> #</th>
                        <th><?php echo $this->lang->line('Customer') ?></th>
                        <th><?php echo $this->lang->line('Renew Date') ?></th>
                        <th><?php echo $this->lang->line('Amount') ?></th>
                        <th><?php echo $this->lang->line('Status') ?></th>
                        <th><?php echo $this->lang->line('Subscription') ?></th>
                        <th class="no-sort"><?php echo $this->lang->line('Settings') ?></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th><?php echo $this->lang->line('No') ?></th>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Customer') ?></th>
                        <th><?php echo $this->lang->line('Date') ?></th>
                        <th><?php echo $this->lang->line('Amount') ?></th>
                        <th><?php echo $this->lang->line('Status') ?></th>
                        <th><?php echo $this->lang->line('Subscription') ?></th>
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
                <h4 class="modal-title"><?php echo $this->lang->line('Delete Invoice') ?></h4>
               
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('delete this invoice') ?> ?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="subscriptions/delete_i">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn btn-danger"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
    draw_data();
    function draw_data(start_date = '', end_date = '') {
    $('#subs').DataTable({
    'processing': true,
            'serverSide': true,
            'stateSave': true,
            responsive: true,
<?php datatable_lang(); ?>
    'order': [],
            'ajax': {
            'url': "<?php echo site_url('subscriptions/ajax_list') ?>",
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
    $('#subs').DataTable().destroy();
    draw_data(start_date, end_date);
    } else {
    alert("Date range is Required");
    }
    });
    });</script>
<script type="text/javascript">
    $(document).ready(function () {
    $('#invoices').DataTable({
    'processing': true,
            'serverSide': true,
            'stateSave': true,
            responsive: true,
<?php datatable_lang(); ?>
    'order': [],
            'ajax': {
            'url': "<?php echo site_url('subscriptions/ajax_list') ?>",
                    'type': 'POST',
                    'data': {'<?= $this->security->get_csrf_token_name() ?>': crsf_hash}
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
                    columns: [1, 2, 3, 4, 5, 6]
                    }
            }
            ],
    });
    });
</script>