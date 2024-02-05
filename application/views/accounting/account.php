<div class="card no-border bg-light">    
    <div class="card-body no-border">
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div> 
        <table 
            id="account" class="table table-striped table-bordered zero-configuration table-sm ">
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
                            <label for="code">#Kode Account</label>
                            <input type="text" name="code" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="level">Sub</label>
                            <select name="sub" class="form-control select-box" style="width:100%">
                            <?php
                            foreach ($akun as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                echo "<option value='$id' data-name='$name'>$name</option>";
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="level">Level</label>
                            <input type="text" name="level" class="form-control">
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
                            <label for="show">Show</label>
                            <select name="status" class="form-control">
                                <option value="1">Show</option>
                                <option value="2">Hide</option>
                            </select>
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
                            <label for="code">#Kode Account</label>
                            <input type="text" name="code" class="form-control code">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="level">Sub</label>
                            
                            <select name="sub" class="form-control select-box2 akun" style="width:100%">
                            <?php
                            foreach ($akun as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                echo "<option value='$id' data-name='$name'>$name</option>";
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="level">Level</label>
                            <input type="text" name="level" class="form-control level">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="name"><?php echo $this->lang->line('Name') ?></label>
                            <input type="text" name="name" class="form-control name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="show">Show</label>
                            <select name="status" class="form-control show">
                                <option value="1">Show</option>
                                <option value="2">Hide</option>
                            </select>
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
                <input type="hidden" id="action-url" value="accounting/delete_account">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?> </button>
                <button type="button" data-dismiss="modal"
                        class="btn"><?php echo $this->lang->line('Cancel') ?> </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    $(".select-box").select2({ 
        dropdownParent: $("#add") 
    });

    $(".select-box2").select2({ 
        dropdownParent: $("#edit") 
    });


    $(document).on('click', ".edit-object", function (e) {
        e.preventDefault();
        $('#edit-id').val($(this).attr('data-object-id'));
        $('.akun').val($(this).attr('data-object-sub'));
        $('.code').val($(this).attr('data-object-code'));
        $('.level').val($(this).attr('data-object-level'));
        $('.name').val($(this).attr('data-object-name'));
        $('.show').val($(this).attr('data-object-show'));

        $(this).closest('tr').attr('id', $(this).attr('data-object-id'));
        $('#edit').modal({backdrop: 'static', keyboard: false});

    });

    $(document).ready(function () {
        draw_data();

        function draw_data() {
            $('#account').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                paging: false,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('accounting/ajax_list_account') ?>",
                    'type': 'POST',
                    'data': {
                        '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                    }
                },
                'columnDefs': [
                    {
                        'targets': [0],
                        'width' :"10%",
                    },
                    {
                        'targets': [1,3],
                        'width' :"5%",
                    },
                    {
                        'targets': [4],
                        'width' :"10%",
                        'orderable': false,
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
                url: "<?php echo site_url('accounting/create_account') ?>",
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
                url: "<?php echo site_url('accounting/update_account') ?>",
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