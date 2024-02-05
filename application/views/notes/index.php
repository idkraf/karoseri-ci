<div class="card border border-1 bg-light">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-outline-warning rounded-0 text-dark">
                    <strong><?php echo $this->lang->line('Notes') ?></strong> 
                </button>
            </div>
            <div class="col-md-6">
                <a href="<?php echo base_url('tools/addnote') ?>" class="btn btn-primary rounded-0 float-end">
                    <?php echo $this->lang->line('Add new') ?>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        
        <div class="card-body border border-2">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>
            <table id="notestable" class="table table-striped table-bordered table-hover table-sm" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Title') ?></th>
                        <th><?php echo $this->lang->line('Added') ?></th>
                        <th><?php echo $this->lang->line('Action') ?></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

    $('#notestable').DataTable({

    "processing": true,
            "serverSide": true,
            "stateSave": true,
            responsive: true,
<?php datatable_lang(); ?>
    "ajax": {
    "url": "<?php echo site_url('tools/notes_load_list') ?>",
            "type": "POST",
            'data': {'<?= $this->security->get_csrf_token_name() ?>': crsf_hash}
    },
            "columnDefs": [
            {
            "targets": [0],
                    "orderable": false,
            },
            ], dom: 'Blfrtip',
            buttons: [
            {
            extend: 'excelHtml5',
                    footer: true,
                    exportOptions: {
                    columns: [0, 1, 2]
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
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('delete this note') ?></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="tools/delete_note">
                <button type="button" data-dismiss="modal" class="btn btn-danger"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn btn-warning"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>
