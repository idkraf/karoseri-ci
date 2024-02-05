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
                    <td><input type="hidden" id="search_p" name="data[search_p]" value="1"></td>
                    <td><input id="search_date1" class="form-control" type="text" name="data[search_date1]" data-toggle="datepicker"></td>
                    <td><input id="search_date2" class="form-control" type="text" name="data[search_date2]" data-toggle="datepicker"></td>
                    <td><input type="text" class="form-control" id="search_name" name="data[search_name]" onkeyup="nameChange()" placeholder="Search"></td>
                    <td>
                        <select id="search_posting" class="form-control" name="data[search_posting]">
                            <option value="0"> All Status </option>
                            <option value="1"> Posting </option>
                            <option value="2"> Unposting  </option>
                        </select>
                    </td>
            </tbody>
        </table>
        <table id="stokin" class="table table-striped table-bordered zero-configuration">
            <thead>
                <tr class="bg-gray">
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
<script type="text/javascript">
$(document).ready(function () {
    minData = $('#search_date1').val();
    maxData = $('#search_date2').val();
    statusData = $('#search_posting').val();
    console.log(statusData);
    console.log(minData);
    console.log(maxData);
    
    $.ajax({
        url: "<?php echo site_url('warehouse/ajax_list_stockin') ?>",
        type: 'GET', 
        dataType: 'json', 
        data: {            
            'min':minData,
            'max':maxData,
            'status':statusData,
            '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
        },
        success: function (_json) {
            if (_json.status) {
                console.log(_json);
                _temp = ($('#search_p').val() - 1) * 1;
                _start = 0;
                if (_json.rows > 0) _start = _temp + 1;
                _end = _temp + _json.data.length;
                _rows = _json.rows;
                _page = 0;
                if (_json.rows > 0) _page = $('#search_p').val();
                _pages = _json.pages;

                $('#stokin').html('');
                $.each(_json.data, function (_i, _arr) {
                    _html = '<tr class="bg-gray" style="background-color: #6c757d;color:#fff">';
                    _html+= '<th class="th-code" style="width: 115px">#</th>';
                    _html+= '<th class="th-code" style="width: 115px">Code</th>';
                    _html+= '<th class="th-date"style="width: 75px">Tanggal</th>';
                    _html+= '<th>Supplier</th>';
                    _html+= '<th class="th-action2" style="width: 65px">&nbsp;</th>';
                    _html+= '</tr>';
                    $('#stokin').append(_html);
                    
                    _del = ''; if(_arr.status == "canceled") _del = ' class="bg-warning"';
                    _html = '<tr' + _del + '>';
                    _html+= '<td>' + _arr.code + '</td>';
                    _html+= '<td>' + _arr.code2 + '</td>';
                    _html+= '<td>' + _arr.date + '</td>';
                    _html+= '<td>' + _arr.supplier_name + '</td>';
                    _html+= '<td class="small">';
                    if(_arr.status == 2){
                        _html+= '<button class="btn btn-sm btn-danger" disabled>';
                        _html+= '<i class="fa fa-ban fa-sm"></i>';
                        _html+= '</button>';
                    }else if(_arr.posting == 1){
                        _html+= '<button class="btn btn-sm btn-success" disabled>';
                        _html+= '<i class="fa fa-check fa-sm"></i>';
                        _html+= '</button>';
                    }else{
                        _html+= '<button class="btn btn-sm btn-warning" onclick="showEdit(\'' + _arr.id + '\'); return false;">';
                        _html+= '<i class="fa fa-pencil-alt fa-sm"></i>';
                        _html+= '</button>';
                        _html+= '<button class="btn btn-sm btn-danger ml-2" onclick="showDelete(\'' + _arr.id + '\'); return false;">';
                        _html+= '<i class="fa fa-minus fa-sm"></i>';
                        _html+= '</button>';
                    }
                    _html+= '</td>';
                    _html+= '</tr>';
                    $('#stokin').append(_html);
                    
                    _html = '<tr' + _del + '>';
                    _html+= '<td colspan="4">';
                    _html+= '<div class="table-responsive">';
                    _html+= '<table class="table bg-white table-bordered text-nowrap">';
                    _html+= '<tr class="bg-gray-light">';
                    _html+= '<th class="th-code" style="width: 115px">Item#</th>';
                    _html+= '<th>Item</th>';
                    _html+= '<th class="th-qty" style="width: 70px">Size</th>';
                    _html+= '<th class="th-qty" style="width: 70px">Purchase</th>';
                    _html+= '<th class="th-disc" style="width: 40px">Stockin</th>';
                    _html+= '</tr>';
                    $.each(_arr.detail, function (_i2, _detail) {
                        _html+= '<tr>';
                        _html+= '<td>' + _detail.item_code + '</td>';
                        _html+= '<td>' + _detail.item_name + '</td>';
                        _html+= '<td class="text-right">' + _numberFormat(_detail.size, 3) + '</td>';
                        _html+= '<td class="text-right">' + _numberFormat(_detail.big, 3) + '</td>';
                        _html+= '<td class="text-right">' + _numberFormat(_detail.rcvbig, 3) + '</td>';
                        _html+= '</td>';
                        _html+= '</tr>';
                    });
                    _html+= '</table>';
                    _html+= '</div>';
                    _html+= '</td>';
                    _html+= '<td colspan="2">&nbsp;</td>';
                    _html+= '</tr>';
                    $('#stokin').append(_html);
                });
                _html = '<tr class="bg-gray-light">';
                _html+= '<td colspan="100" class="pt-2 pb-1">';
                _html+= '<div class="float-left" style="float: left !important;">';
                _html+= '<b>Rows:</b> ' + _start + '-' + _end;
                _html+= '&nbsp; | &nbsp;';
                _html+= '<b>Total:</b> ' + _json.data.length + '/' + _rows + ' ' + 1;
                _html+= '</div>';
                _html+= '<div class="float-right" style="float: right !important;">';
                _html+= '<b>Page:</b> ' + _page + '/' + _pages;
                _html+= '<div class="btn-group ml-2">';

                _bg = ' btn-dark'; _disabled = ' disabled';
                if (_page > 1) { _bg = ' btn-info'; _disabled = ''; }
                _html+= '<button onclick=clickPrev() class="btn btn-sm pl-2 pr-2' + _bg + '"' + _disabled + '>';
                _html+= '<i class="fa fa-chevron-left"></i>';
                _html+= '</button>';

                _bg = ' btn-dark'; _disabled = ' disabled';
                if (_page < _pages) { _bg = ' btn-info'; _disabled = ''; }
                _html+= '<button onclick=clickNext() class="btn btn-sm ml-1 pl-2 pr-2' + _bg + '"' + _disabled + '>';
                _html+= '<i class="fa fa-chevron-right"></i>';
                _html+= '</button>';

                _html+= '</div>';
                _html+= '</div>';
                _html+= '</td>';
                _html+= '</tr>';
                $('#stokin').append(_html);
            }
        }
    })
});
</script>