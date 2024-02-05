
<div class="card border border-1 bg-light">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-outline-warning rounded-0 text-dark">
                    <h5><?php echo $this->lang->line('Income Transactions') ?></h5>
                </button>
            </div>
            <div class="col-md-6">
                <a href="<?php echo base_url('transactions/add') ?>" class="btn btn-primary float-end rounded-0"><?php echo $this->lang->line('Add new');?></a>
            </div>
        </div>
      
    </div>
    <div class="card-body">

        <div class="card-body border border-2">


            <table id="trans_table" class="table table-sm  table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th><?php echo $this->lang->line('Date') ?></th>
                        <th><?php echo $this->lang->line('Account') ?></th>
                        <th><?php echo $this->lang->line('Debit') ?></th>
                        <th><?php echo $this->lang->line('Credit') ?></th>
                        <th><?php echo $this->lang->line('Payer') ?></th>
                        <th><?php echo $this->lang->line('Method') ?></th>
                        <th><?php echo $this->lang->line('Action') ?></th>


                    </tr>
                </thead>
                <tbody>
                </tbody>

                <tfoot>
                    <tr>
                        <th><?php echo $this->lang->line('Date') ?></th>
                        <th><?php echo $this->lang->line('Account') ?></th>
                        <th><?php echo $this->lang->line('Debit') ?></th>
                        <th><?php echo $this->lang->line('Credit') ?></th>
                        <th><?php echo $this->lang->line('Payer') ?></th>
                        <th><?php echo $this->lang->line('Method') ?></th>
                        <th><?php echo $this->lang->line('Action') ?></th>


                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
    $('#trans_table').DataTable({
    "processing": true,
            "serverSide": true,
            "stateSave": true,
            responsive: true,
<?php datatable_lang(); ?>
    "ajax": {
    "url": "<?php echo site_url('transactions/translist?type=income') ?>",
            "type": "POST",
            'data': {'<?= $this->security->get_csrf_token_name() ?>': crsf_hash}
    },
            "columnDefs": [
            {
            "targets": [0],
                    "orderable": true,
            },
            ], dom: 'Blfrtip',
            buttons: [
            {
            extend: 'excelHtml5',
                    footer: true,
                    exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                    }
            }
            ],
    });
    });
</script>

<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('delete this transaction') ?></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="transactions/delete_i">
                <button type="button" data-dismiss="modal" class="btn btn-danger"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn btn-primary"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>