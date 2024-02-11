<div class="card no-border bg-light">  
    
    <div class="card-body no-border">
        <div class="card shadow shadow-lg mb-0">
            <div class="card-header no-border pb-0 pt-1">
                <h4> <?php echo $title ?></h4>
            </div>
        </div>
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <table id="leds" class="table table-striped table-bordered zero-configuration table-sm ">
            <thead>
                <tr>
                    <th></th>
                    <th>Entry</th>
                    <th>#</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th></th>
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
            $('#leds').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('ledger/ajax_list') ?>",
                    'type': 'POST',
                    'data': {
                        'ledger_id': <?php echo $id ?>,
                        '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                    }
                },
                'columnDefs': [
                   // {
                    //    'targets': [4],
                    //    'width' :"90%",
                    //},
                    {
                        'targets': [0,1,2,3,4,5],
                        'orderable': false,
                    },
                ],
                dom: 'Blfrtip',
                lengthMenu: [40, 80, 200, 500],
            });
        };
        
    });
</script>