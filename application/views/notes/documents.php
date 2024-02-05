    <div class="card border  border-1 rounded-0 bg-light">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-outline-warning rounded-0 text-dark">
                        <strong><?php echo $this->lang->line('Documents') ?> </strong>
                    </button>
                   
                </div>
                <div class="col-md-6">
                 <a href="<?php echo base_url('tools/adddocument') ?>" class="btn btn-primary rounded-0 float-end">
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
            <div class="card-body border border-2">
            
                <table id="doctable" class="table table-striped table-bordered table-sm table-hover">
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
        <div id="delete_model" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo $this->lang->line('delete this document') ?></p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="object-id" value="">
                        <input type="hidden" id="action-url" value="tools/delete_document">
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

                $('#doctable').DataTable({

                    "processing": true,
                    "serverSide": true,
                    responsive: true,
                    <?php datatable_lang();?>
                    "ajax": {
                        "url": "<?php echo site_url('tools/document_load_list')?>",
                        "type": "POST",
                        'data': {'<?=$this->security->get_csrf_token_name()?>': crsf_hash}
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
