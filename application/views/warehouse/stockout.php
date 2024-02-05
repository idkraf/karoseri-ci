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
        <table border="0" cellspacing="5" cellpadding="5" class="mb-2">
            <tbody>
                <tr>
                    <td><input type="text" id="min" name="min" data-toggle="datepicker"></td>
                    <td><input type="text" id="max" name="max" data-toggle="datepicker"></td>
                    <td>
                        <select id="status" name="status">
                            <option value="0"> All Status </option>
                            <option value="1"> Posting </option>
                            <option value="2"> Unposting  </option>
                        </select>
                    </td>
            </tbody>
        </table>
        <table id="stokout" class="table table-striped table-bordered zero-configuration table-sm ">
            <thead>
                <tr>
                    <th class="no-sort">#</th>
                    <th>Date</th>
                    <th>Project#</th>
                    <th>Customer</th>
                    <th>Vehicle</th>
                    <th>Item#</th>
                    <th>Item</th>
                    <th>Qty</th>
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
        let minDate, maxDate;
        draw_data();
        function draw_data() {
            minData = $('#min').val();
            maxData = $('#max').val();
            statusData = $('#status').val();
            console.log(statusData);
            console.log(minData);
            console.log(maxData);
            
            $('#stokout').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
				paging: true,
				destroy: true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('warehouse/ajax_list_stockout') ?>",
                    'type': 'GET',
                    'data': {
                        'min':minData,
                        'max':maxData,
                        'status':statusData,
                        '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                    }
                },
                'columnDefs': [
                    {
                        'targets': [0,1,2,3,4,5],
                        'orderable': false,
                    },
                ],
                dom: 'Blfrtip',
                lengthMenu: [100, 200, 500],
                //buttons: [             
                //    {
                //        extend: 'excelHtml5',
                //        footer: false,
                //        exportOptions: {
                //            columns: [1]
                //        }
                //    },
                    //{
                    //    extend: 'collection',
                    //    text:'Tanggal',
                    //    autoClose: true,
                    //    buttons:[
                    //    ]
                    //}
                //],         
            });
        };
                
        
        // Refilter the table
        $('#status').on('change', function() {
            draw_data();
        });
        $('#min').on('change', function() {
            draw_data();
        });
        $('#max').on('change', function() {
            draw_data();
        });
    });
    

</script>