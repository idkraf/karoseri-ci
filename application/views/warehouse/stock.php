<div class="card no-border bg-light">    
    <div class="card-body no-border">
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div> 
        <table id="stock" class="table table-striped table-bordered zero-configuration table-sm ">
            <thead>
                <tr>
                    <th class="no-sort">#</th>
                    <th>Entry</th>
                    <th>#</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>+</th>
                    <th>-</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
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
                'url': "<?php echo site_url('warehouse/ajax_list_stock') ?>",
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
</script>