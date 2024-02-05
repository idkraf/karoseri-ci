<div class="card no-border bg-light">    
    <div class="card-header no-border">
        <h4> <?php echo $title ?></h4>
    </div>
    <div class="card-body no-border">
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div> 
        <table id="item" class="table table-striped table-bordered zero-configuration table-sm ">
            <thead>
                <tr>
                    <th class="no-sort">#</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>


<div id="edit_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Opname</h4>
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
                            <label for="name"><?php echo $this->lang->line('Date') ?></label>
                            <input type="date" name="tanggal" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="name"><?php echo $this->lang->line('Name') ?></label>
                            <input type="text" name="name" class="name form-control" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="name">Notes</label>
                            <input type="text" name="notes" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="name">Stock</label>
                            <input type="text" name="qty" class="qty form-control" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="name">Opname</label>
                            <input type="number" name="opname" class="form-control">
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
<script type="text/javascript">
    $(document).on('click', ".edit-object", function (e) {
        e.preventDefault();
        $('#edit-id').val($(this).attr('data-object-id'));
        $('.name').val($(this).attr('data-object-name'));
        $('.qty').val($(this).attr('data-object-qty'));

        $(this).closest('tr').attr('id', $(this).attr('data-object-id'));
        $('#edit_model').modal({backdrop: 'static', keyboard: false});

    });
    $(document).ready(function () {
        draw_data();

        function draw_data() {
            $('#item').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                'order': [],
                <?php datatable_lang(); ?>
                'ajax': {
                    'url': "<?php echo site_url('warehouse/ajax_list_item_opname') ?>",
                    'type': 'POST',
                    'data': {
                        '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                    }
                },
                'columnDefs': [
                    {
                        'targets': [4,5],
                        'width' :"5%",
                        'orderable': false,
                    },
                ],
                dom: 'Blfrtip',
                lengthMenu: [10, 20, 50, 100, 200, 500],
                buttons: [             
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
    });
    
    $('#edit_model').on('click', '#simpanEdit', function (e) {
            //e.prefentDefault();
            jQuery.ajax({
                url: "<?php echo site_url('warehouse/insert_opname') ?>",
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
</script>
