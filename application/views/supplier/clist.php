<div class="card shadow border border-1 bg-light">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h5><?php echo $this->lang->line('Supplier') ?></h5>
            </div>
            <div class="col-md-6">
                <a href="<?php echo base_url('supplier/create') ?>" class="btn btn-primary btn-sm rounded float-end">
                    <?php echo $this->lang->line('Add new') ?>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>
        <div class="card-body">
            <table id="clientstable" class="table table-striped table-bordered table-sm" cellspacing="0"
                   width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Address') ?></th>
                        <th><?php echo $this->lang->line('Email') ?></th>
                        <th><?php echo $this->lang->line('Phone') ?></th>
                        <th><?php echo $this->lang->line('Settings') ?></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Address') ?></th>
                        <th><?php echo $this->lang->line('Email') ?></th>
                        <th><?php echo $this->lang->line('Phone') ?></th>
                        <th><?php echo $this->lang->line('Settings') ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
    $('#clientstable').DataTable({
    'processing': true,
            'serverSide': true,
            'stateSave': true,
            responsive: true,
<?php datatable_lang(); ?>
    'order': [],
            'ajax': {
            'url': "<?php echo site_url('supplier/load_list') ?>",
                    'type': 'POST',
                    'data': {'<?= $this->security->get_csrf_token_name() ?>': crsf_hash}
            },
            'columnDefs': [
            {
            'targets': [0],
                    'orderable': false,
            },
            ], dom: 'Blfrtip',
            buttons: [
            {
            extend: 'excelHtml5',
                    footer: true,
                    exportOptions: {
                    columns: [0, 1, 2, 3, 4]
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

                <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>

            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('delete this supplier') ?></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="supplier/delete_i">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn btn-danger"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>