<div class="row">
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="success" id="dash_0"></h3>
                            <span><?php echo $this->lang->line('Active') ?></span>
                        </div>
                        <div class="align-self-center">
                            <i class="fa fa-check-circle success font-large-2 float-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="danger" id="dash_1"></h3>
                            <span><?php echo $this->lang->line('Used') ?></span>
                        </div>
                        <div class="align-self-center">
                            <i class="fa fa-clock-o danger font-large-2 float-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="blue" id="dash_2"></h3>
                            <span><?php echo $this->lang->line('Expired') ?></span>
                        </div>
                        <div class="align-self-center">
                            <i class="fa fa-flag-checkered blue font-large-2 float-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="purple" id="dash_6"><?php echo $totalt ?></h3>
                            <span><?php echo $this->lang->line('Total') ?></span>
                        </div>
                        <div class="align-self-center">
                            <i class="fa fa-list-alt purple font-large-2 float-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card border border-1 bg-light">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-outline-warning rounded-0">
                    <h5 class="text-dark"><?php echo $this->lang->line('Promo Codes') ?></h5>
                </button>
            </div>
            <div class="col-md-6">
                <a href="<?php echo base_url('promo/create') ?>" class="btn btn-primary float-end rounded-0">
                   <?php echo $this->lang->line('Add new') ?>
                </a>
            </div>
        </div>
        <h3 class="title">
             
        </h3>
    </div>
    
    <div class="card-body">
        <div class="card-body border border-2">
        <div class="card">
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <table id="promotable" class="table table-striped table-bordered table-sm table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Code') ?></th>
                        <th><?php echo $this->lang->line('Amount') ?></th>
                        <th><?php echo $this->lang->line('Valid') ?></th>
                        <th><?php echo $this->lang->line('Status') ?></th>
                        <th><?php echo $this->lang->line('Available') ?></th>
                        <th><?php echo $this->lang->line('Action') ?></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>
        </div>    
        <input type="hidden" id="dashurl" value="promo/promo_stats">
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
                Are you sure you want to delete ?
            </div>

            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="promo/delete_i">
                <button type="button" data-dismiss="modal" class="btn btn-danger"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn btn-primary"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>
<div id="pop_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Change Status'); ?></h4>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form id="form_model">


                    <div class="row">
                        <div class="col">
                            <label  for="status"><?php echo $this->lang->line('Change Status') ?></label>
                            <select name="stat" class="form-select rounded-0">
                                <option value="0"><?= $this->lang->line('Active') ?></option>
                                <option value="1"><?= $this->lang->line('Used') ?></option>
                                <option value="2"><?= $this->lang->line('Expired') ?></option>
                            </select>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" class="form-control"
                               name="tid" id="taskid" value="">
                        <button type="button" class="btn btn-danger"
                                data-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
                        <input type="hidden" id="action-url" value="promo/set_status">
                        <button type="button" class="btn btn-primary"
                                id="submit_model"><?php echo $this->lang->line('Change Status'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {

    $('#promotable').DataTable({

    "processing": true,
            "serverSide": true,
            "stateSave": true,
            responsive: true,
<?php datatable_lang(); ?>
    "ajax": {
    "url": "<?php echo site_url('promo/load_list') ?>",
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
    $(document).on('click', ".set-task", function (e) {
    e.preventDefault();
    $('#taskid').val($(this).attr('data-id'));
    $('#pop_model').modal({backdrop: 'static', keyboard: false});
    });
    $(document).on('click', ".view_task", function (e) {
    e.preventDefault();
    var actionurl = 'tools/view_task';
    var id = $(this).attr('data-id');
    $('#task_model').modal({backdrop: 'static', keyboard: false});
    $.ajax({

    url: baseurl + actionurl,
            type: 'POST',
            data: {'tid': id},
            dataType: 'json',
            success: function (data) {

            $('#description').html(data.description);
            $('#task_title').html(data.name);
            $('#employee').html(data.employee);
            $('#assign').html(data.assign);
            $('#priority').html(data.priority);
            }

    });
    });
    miniDash();
    });

</script>