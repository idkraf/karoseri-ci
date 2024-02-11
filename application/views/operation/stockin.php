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
        
        <table border="0" cellspacing="5" cellpadding="5" class="mb-2">
            <tbody>
                <tr>
                    <td><input id="search_date1" class="selectpicker form-select rounded-0" type="text" name="data[search_date1]" data-toggle="datepicker"></td>
                    <td><input id="search_date2" class="selectpicker form-select rounded-0" type="text" name="data[search_date2]" data-toggle="datepicker"></td>
                    <td>
                        <select id="search_posting" class="selectpicker form-select rounded-0" name="data[search_posting]">
                            <option value="0"> All Status </option>
                            <option value="1"> Posting </option>
                            <option value="2"> Unposting  </option>
                        </select>
                    </td>
            </tbody>
        </table>
        <table id="stockin" class="table table-striped table-bordered zero-configuration table-sm ">
                <thead>
                    <tr>
                        <th class="no-sort">#</th>
                        <th>Code</th>
                        <th>Date</th>
                        <th>Supplier</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
        </table>
    </div>
</div>

<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Unposting ?') ?> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="operation/posting_stockin">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                        id="delete-confirm"><?php echo $this->lang->line('Ok') ?> </button>
                <button type="button" data-dismiss="modal"
                        class="btn"><?php echo $this->lang->line('Cancel') ?> </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        draw_data();
        

        function draw_data() {
            minData = $('#search_date1').val();
            maxData = $('#search_date2').val();
            statusData = $('#search_posting').val();
            console.log(statusData);
            console.log(minData);
            console.log(maxData);
            $('#stockin').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                destroy: true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('operation/ajax_list_stockin') ?>",
                    'type': 'POST',
                    'data': {
                        'min':minData,
                        'max':maxData,
                        'status':statusData,
                        '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                    }
                },
                'columnDefs': [
                    {
                        'targets': [0,1,2,3,4],
                        'orderable': false,
                    },
                ],
                dom: 'Blfrtip',
                lengthMenu: [10, 20, 50, 100, 200, 500],
            });
        };

        
        // Refilter the table
        $('#search_date1').on('change', function() {
            draw_data();
        });
        $('#search_date2').on('change', function() {
            draw_data();
        });
        $('#search_posting').on('change', function() {
            draw_data();
        });
    });
</script>