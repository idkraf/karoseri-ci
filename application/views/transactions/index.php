
    <div class="card">
        <div class="card-header">
            <h5> <a
                        href="<?php echo base_url('transactions/add') ?>"
                        class="btn btn-primary rounded-0 rounded-0">
                    <?php echo $this->lang->line('Add new') ?> <?php echo $this->lang->line('Transactions') ?>
                </a></h5>
            
        </div>
        <div class="card-body">
        <div class="card-body border border-2">
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
           
            <table id="trans_table" class="table table-striped table-bordered table-hover  table-sm" cellspacing="0"
                   width="100%">
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
            <?php datatable_lang();?>
            "ajax": {
                "url": "<?php echo site_url('transactions/translist')?>",
                "type": "POST",
                'data': {'<?=$this->security->get_csrf_token_name()?>': crsf_hash}
            },
            "columnDefs": [
                {
                    "targets": [0],
                    "orderable": true,
                },
            ],
            dom: 'Blfrtip',
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
                        aria-hidden="true">X</span></button>
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
                        class="btn btn-warning"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>