<div class="card border border-1 bg-light">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-outline-warning rounded-0 text-dark">
                        <strong><?php echo $this->lang->line('Holidays') ?></strong>
                    </button>
                    
                </div>
                <div class="col-md-6">
                    <a href="<?php echo base_url('employee/addhday') ?>"  class="btn btn-primary float-end rounded-0">
                        <?php echo $this->lang->line('Add new') ?>
                    </a>
                </div>
            </div>
            <h5> 
                </h5>
            
        </div>
        <div class="card-body">
            <div class="card-body border border-2">
                <div class="table-responsive">
                    <table id="htable" class="table table-striped table-bordered table-hover table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('From') ?></th>
                            <th><?php echo $this->lang->line('To') ?></th>
                            <th><?php echo $this->lang->line('Days') ?></th>
                            <th><?php echo $this->lang->line('Note') ?></th>
                            <th><?php echo $this->lang->line('Action') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('From') ?></th>
                            <th><?php echo $this->lang->line('To') ?></th>
                            <th><?php echo $this->lang->line('Days') ?></th>
                            <th><?php echo $this->lang->line('Note') ?></th>
                            <th><?php echo $this->lang->line('Action') ?></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
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
            <?php datatable_lang();?>
            'order': [],
            'ajax': {
                'url': "<?php echo site_url('employee/hday_list')?>",
                'type': 'POST',
                'data': {'cid': 7, '<?=$this->security->get_csrf_token_name()?>': crsf_hash}
            },
            'columnDefs': [
                {
                    'targets': [0],
                    'orderable': false,
                },
            ],
        });
    });
</script>
<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>
            </div>
            <div class="modal-body">
                <?php echo $this->lang->line('Delete');
                echo ' ' . $this->lang->line('Holiday'); ?>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="employee/delete_hday">
                <button type="button" data-dismiss="modal" class="btn btn-danger"
                        id="delete-confirm"><?php echo $this->lang->line('Yes') ?></button>
                <button type="button" data-dismiss="modal" class="btn btn-primary"><?php echo $this->lang->line('No') ?></button>
            </div>
        </div>
    </div>
</div>