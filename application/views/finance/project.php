<div class="card no-border bg-light">    
    <div class="card-body no-border">
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div> 
        <table id="project" class="table table-striped table-bordered zero-configuration table-sm ">
                <thead>
                    <tr>
                        <th class="no-sort">#</th>
                        <th>Date</th>
                        <th>Datedue</th>
                        <th>Customer</th>
                        <th>Vehicle</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Balance</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    function showAdd(_id) {
        console.log(_id);
        window.location = '/finance/projectpayment_add?id='+_id;
    }
$(document).ready(function () {
        draw_data();

        function draw_data() {
            $('#project').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('finance/ajax_project_list') ?>",
                    'type': 'POST',
                    'data': {
                        '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                    }
                },
                'columnDefs': [
                    {
                        'targets': [0,1,2,3,4,5,6,7,8],
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
    });
</script>