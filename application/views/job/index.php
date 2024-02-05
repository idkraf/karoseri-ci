<div class="card no-border bg-light">  
    
    <div class="card-body no-border">
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <table id="jobs" class="table table-striped table-bordered zero-configuration table-sm ">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="small"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
        </table>
    </div>
</div>

<div id="AddJobs" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Job</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form id="addjob_form">

                    <input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">


                    <div class="row">
                        <div class="col mb-1">
                            <label for="name"><?php echo $this->lang->line('Name') ?></label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                <button type="button" id="simpanAddJob" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>

</div>

<div id="edit_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Job</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form id="edit_form">

                    <input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">

                    <input type="hidden" name="editid" id="edit-id" value="">

                    <div class="row">
                        <div class="col mb-1">
                            <label for="name"><?php echo $this->lang->line('Name') ?></label>
                            <input type="text" name="name" id="edit-name" class="form-control">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                <button type="button" id="simpanEdit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>

</div>

<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Jika task job ada pada produksi dan template maka tidak bisa dihapus</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="job/delete_i">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?> </button>
                <button type="button" data-dismiss="modal"
                        class="btn"><?php echo $this->lang->line('Cancel') ?> </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).on('click', ".edit-object", function (e) {
        e.preventDefault();
        $('#edit-id').val($(this).attr('data-object-id'));
        $('#edit-name').val($(this).attr('data-object-name'));

        $(this).closest('tr').attr('id', $(this).attr('data-object-id'));
        $('#edit_model').modal({backdrop: 'static', keyboard: false});

    });

    $(document).ready(function () {
        draw_data();

        function draw_data() {
            $('#jobs').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('job/ajax_list') ?>",
                    'type': 'POST',
                    'data': {
                        '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                    }
                },
                'columnDefs': [
                    {
                        'targets': [0],
                        'width' :"90%",
                    },
                    {
                        'targets': [1],
                        'width' :"10%",
                        'orderable': false,
                    },
                ],
                dom: 'Blfrtip',
                lengthMenu: [10, 20, 50, 100, 200, 500],
                buttons: [                    
                    {
                        text: 'Add Job',
                        action: function ( e, dt, node, config ) {
                           $('#AddJobs').modal('show');
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        footer: false,
                        exportOptions: {
                            columns: [1]
                        }
                    },
                ],
            });
        };

        $('#AddJobs').on('click', '#simpanAddJob', function (e) {
            //e.prefentDefault();
            jQuery.ajax({
                url: "<?php echo site_url('job/create') ?>",
                        type: 'POST',
                        data: $("#addjob_form").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            $("#AddJobs").modal('hide');

                            $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                            $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                            $("html, body").animate({scrollTop: $('#notify').offset().top}, 1000);
                            location.reload(true);
                            //$('#' + $('#object-id').val()).add();
                        }
                });
        });

        $('#edit_model').on('click', '#simpanEdit', function (e) {
            //e.prefentDefault();
            jQuery.ajax({
                url: "<?php echo site_url('job/update') ?>",
                        type: 'POST',
                        data: $("#edit_form").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            $("#edit_model").modal('hide');

                            $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                            $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                            $("html, body").animate({scrollTop: $('#notify').offset().top}, 1000);
                            location.reload(true);
                        }
                });
        });
        
    });
</script>