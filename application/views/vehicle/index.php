<div class="card no-border bg-light">    
    <div class="card-body no-border">
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div> 
        <table id="vehicles" class="table table-striped table-bordered zero-configuration table-sm ">
                <thead>
                    <tr>
                        <th class="no-sort">#</th>
                        <th>Nama</th>
                        <th>Police</th>
                        <th>Body</th>
                        <th>Machine</th>
                        <th>Colour</th>
                        <th>Year</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
        </table>
    </div>
</div>

<div id="AddVehicle" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Vehicle</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form id="addvehicle_form">

                    <input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">

                    <div class="row">
                        <div class="col mb-1">
                            <label for="code">Code</label>
                            <input type="text" name="code" placeholder="auto" class="form-control">
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col mb-1">
                            <label for="name"><?php echo $this->lang->line('Name') ?></label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-1">
                            <label for="police">Police</label>
                            <input type="text" name="police" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-1">
                            <label for="body">Body</label>
                            <input type="text" name="body" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="machine">Machine</label>
                            <input type="text" name="machine" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="colour">Colour</label>
                            <input type="text" name="colour" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="year">Year</label>
                            <input type="text" name="year" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="notes">Notes</label>
                            <input type="text" name="notes" class="form-control">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                <button type="button" id="simpanAddVehicle" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>

</div>

<div id="edit_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Vehicle</h4>
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
                            <label for="code">Code</label>
                            <input id="edit-code" type="text" name="code" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-1">
                            <label for="name"><?php echo $this->lang->line('Name') ?></label>
                            <input id="edit-name" type="text" name="name" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-1">
                            <label for="police">Police</label>
                            <input id="edit-police" type="text" name="police" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-1">
                            <label for="body">Body</label>
                            <input id="edit-body" type="text" name="body" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="machine">Machine</label>
                            <input id="edit-machine" type="text" name="machine" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="colour">Colour</label>
                            <input id="edit-colour" type="text" name="colour" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="year">Year</label>
                            <input id="edit-year" type="text" name="year" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="notes">Notes</label>
                            <input id="edit-notes" type="text" name="notes" class="form-control">
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Jika vehicle ada pada produksi dan template maka tidak bisa dihapus</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="vehicle/delete_i">
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
        $('#edit-code').val($(this).attr('data-object-code'));
        $('#edit-name').val($(this).attr('data-object-name'));
        $('#edit-police').val($(this).attr('data-object-police'));
        $('#edit-body').val($(this).attr('data-object-body'));
        $('#edit-machine').val($(this).attr('data-object-machine'));
        $('#edit-colour').val($(this).attr('data-object-colour'));
        $('#edit-year').val($(this).attr('data-object-year'));
        $('#edit-notes').val($(this).attr('data-object-notes'));

        $(this).closest('tr').attr('id', $(this).attr('data-object-id'));
        $('#edit_model').modal({backdrop: 'static', keyboard: false});

    });


    $(document).ready(function () {
        draw_data();

        function draw_data() {
            $('#vehicles').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('vehicle/ajax_list') ?>",
                    'type': 'POST',
                    'data': {
                        '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                    }
                },
                'columnDefs': [
                    {
                        'targets': [0],
                        'width' :"10%",
                        'orderable': false,
                    },
                    {
                        'targets': [7],
                        'width' :"10%",
                        'orderable': false,
                    },
                ],
                dom: 'Blfrtip',
                lengthMenu: [10, 20, 50, 100, 200, 500],
                buttons: [                    
                    {
                        text: 'Add Vehicle',
                        action: function ( e, dt, node, config ) {
                           //window.location = '<//?php echo site_url('vehicle/create') ?>'
                           $('#AddVehicle').modal('show');
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        footer: false,
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                ],
            });
        };

        
        $('#AddVehicle').on('click', '#simpanAddVehicle', function (e) {
            //e.prefentDefault();
            jQuery.ajax({
                url: "<?php echo site_url('vehicle/create') ?>",
                        type: 'POST',
                        data: $("#addvehicle_form").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            $("#AddVehicle").modal('hide');

                            $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                            $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                            $("html, body").animate({scrollTop: $('#notify').offset().top}, 1000);
                        }
                });
        });

        $('#edit_model').on('click', '#simpanEdit', function (e) {
            //e.prefentDefault();
            jQuery.ajax({
                url: "<?php echo site_url('vehicle/update') ?>",
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