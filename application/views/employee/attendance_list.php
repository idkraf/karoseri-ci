<div class="card border border-1 bg-light">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <div class="btn btn-outline-warning rounded-0 text-dark">
                    <strong><?php echo $this->lang->line('Attendance') ?></strong>
                </div>
            </div>
            <div class="col-md-6">
                <a href="<?php echo base_url('employee/attendance') ?>" class="btn btn-primary float-end  rounded-0">
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
            <table id="htable" class="table table-striped table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Employee') ?></th>
                        <th><?php echo $this->lang->line('Date') ?></th>
                        <th>Standard Hours</th>
                        <th>ClockIn</th>
                        <th><?php echo $this->lang->line('Note') ?></th>
                        <th><?php echo $this->lang->line('Action') ?></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Employee') ?></th>
                        <th><?php echo $this->lang->line('Date') ?></th>
                        <th>Standard Hours</th>
                        <th>ClockIn</th>
                        <th><?php echo $this->lang->line('Note') ?></th>
                        <th><?php echo $this->lang->line('Action') ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
    $('#htable').DataTable({
    'processing': true,
            'serverSide': true,
            'stateSave': true,
            responsive: true,
<?php datatable_lang(); ?>
    'order': [],
            'ajax': {
            'url': "<?php echo site_url('employee/att_list') ?>",
                    'type': 'POST',
                    'data': {
                    'cid': '<?= $this->input->get('id') ?>',
                            '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                    }
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
                <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php
                echo $this->lang->line('Delete');
                echo ' ' . $this->lang->line('Attendance');
                ?>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="employee/delete_attendance">
                <button type="button" data-dismiss="modal" class="btn btn-danger"
                        id="delete-confirm"><?php echo $this->lang->line('Yes') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn btn-primary"><?php echo $this->lang->line('No') ?></button>
            </div>
        </div>
    </div>
</div>