<div class="card border border-1 bg-light rounded-0">
    <div class="card-header">
        <button class="btn btn-outline-warning rounded-0">
            <h4 class="card-title text-dark"> <?php echo $this->lang->line('ProductSales') ?> </h4>
        </button>


    </div>
    <div class="card-body">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>
        <div class="card-body">

            <div class="card border border-1">
                <div class="card-body p-4">
                    <div class="row">

                        <div class="col-md-1"><strong><?php echo $this->lang->line('Invoice Date') ?></strong></div>
                        <div class="col-md-2">
                            <input type="text" name="start_date" id="start_date"
                                   class="date30 form-control rounded-0" autocomplete="off"/>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="end_date" id="end_date" class="form-control rounded-0"
                                   data-toggle="datepicker" autocomplete="off"/>
                        </div>

                        <div class="col-md-2">
                            <input type="button" name="search" id="search" value="Search" class="btn btn-primary"/>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card border border-2">
                <div class="card-body">
                    <table id="invoices_rp" class="table table-striped table-bordered table-sm table-hover  dataex-res-constructor">
                        <thead>
                            <tr>
                                <th><?php echo $this->lang->line('No') ?></th>
                                <th> #</th>
                                <th><?php echo $this->lang->line('Customer') ?></th>
                                <th><?php echo $this->lang->line('Product Name') ?></th>
                                <th><?php echo $this->lang->line('Qty') ?></th>
                                <th><?php echo $this->lang->line('Qty') ?></th>
                                <th><?php echo $this->lang->line('Amount') ?></th>
                                <th><?php echo $this->lang->line('Discount') ?></th>
                                <th><?php echo $this->lang->line('Tax') ?></th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th><?php echo $this->lang->line('No') ?></th>
                                <th> #</th>
                                <th><?php echo $this->lang->line('Customer') ?></th>
                                <th><?php echo $this->lang->line('Date') ?></th>
                                <th><?php echo $this->lang->line('Description') ?></th>
                                <th><?php echo $this->lang->line('Qty') ?></th>
                                <th><?php echo $this->lang->line('Amount') ?></th>
                                <th><?php echo $this->lang->line('Discount') ?></th>
                                <th><?php echo $this->lang->line('Tax') ?></th>
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
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('delete this invoice') ?> ?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="pos_invoices/delete_i">
                <button type="button" data-dismiss="modal" class="btn btn-danger"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn btn-primary"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
    draw_data();
    function draw_data(start_date = '', end_date = '') {
    $('#invoices_rp').DataTable({
    'processing': true,
            'serverSide': true,
            'stateSave': true,
            responsive: true,
<?php datatable_lang(); ?>
    'order': [],
            'ajax': {
            'url': "<?php echo site_url('pos_invoices/extended_ajax_list') ?>",
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
            pageLength: 100,
            lengthMenu: [10, 20, 50, 100, 200, 500],
            buttons: [
            {
            extend: 'excelHtml5',
                    footer: true,
                    exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
            }
            ],
    });
    }

    $('#search').click(function () {
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    if (start_date != '' && end_date != '') {
    $('#invoices_rp').DataTable().destroy();
    draw_data(start_date, end_date);
    } else {
    alert("Date range is Required");
    }
    });
    });
</script>