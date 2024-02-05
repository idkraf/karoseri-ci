<div class="card no-border bg-light">    
    <div class="card-body no-border">
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div> 
        <table id="jurnal" class="table table-striped table-bordered zero-configuration table-sm ">
                <thead>
                    <tr>
                        <th class="no-sort">#</th>
                        <th>Level</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
        </table>
    </div>
</div>

<div id="add" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form id="add_form">

                    <input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">

                        <div class="row">
                        <div class="col mb-1">
                            <label for="code">#</label>
                            <input type="text" name="code" class="form-control code">
                        </div>
                        <div class="col mb-1">
                            <label for="name">Date</label>
                            <input type="date" name="tanggal" class="form-control tanggal">
                        </div>
                        <div class="col mb-1">
                            <label for="name">Person</label>
                            <input type="text" name="person" class="form-control person">
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                <button type="button" id="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>

</div>

<div id="edit" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit</h4>
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
                            <label for="code">#</label>
                            <input type="text" name="code" class="form-control code">
                        </div>
                        <div class="col mb-1">
                            <label for="name">Date</label>
                            <input type="date" name="tanggal" class="form-control tanggal">
                        </div>
                        <div class="col mb-1">
                            <label for="name">Person</label>
                            <input type="text" name="person" class="form-control person">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                <button type="button" id="rubah" class="btn btn-primary">Simpan</button>
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
                <p>Jika account dihapus maka semua data yang berkaitan ikut terhapus</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="accounting/delete_jurnal">
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
        $('#edit').modal({backdrop: 'static', keyboard: false});

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
                    'url': "<?php echo site_url('accounting/ajax_list_jurnal') ?>",
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
                ],
                dom: 'Blfrtip',
                lengthMenu: [10, 20, 50, 100, 200, 500],
                buttons: [                    
                    {
                        text: 'Tambah',
                        action: function ( e, dt, node, config ) {
                           $('#add').modal('show');
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

        $('#add').on('click', '#simpan', function (e) {
            //e.prefentDefault();
            jQuery.ajax({
                url: "<?php echo site_url('accounting/create_jurnal') ?>",
                        type: 'POST',
                        data: $("#add_form").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            $("#Add").modal('hide');

                            $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                            $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                            $("html, body").animate({scrollTop: $('#notify').offset().top}, 1000);
                            location.reload(true);
                            //$('#' + $('#object-id').val()).add();
                        }
                });
        });

        $('#edit').on('click', '#rubah', function (e) {
            //e.prefentDefault();
            jQuery.ajax({
                url: "<?php echo site_url('accounting/update_jurnal') ?>",
                        type: 'POST',
                        data: $("#edit_form").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            $("#edit").modal('hide');

                            $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                            $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                            $("html, body").animate({scrollTop: $('#notify').offset().top}, 1000);
                            location.reload(true);
                        }
                });
        });
        
    });
</script>