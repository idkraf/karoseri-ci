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
                    <td><input id="search_date1" class="selectpicker form-select rounded-0 teal" type="text" name="data[search_date1]" data-toggle="datepicker"></td>
                    <td><input id="search_date2" class="selectpicker form-select rounded-0 teal" type="text" name="data[search_date2]" data-toggle="datepicker"></td>
                    <td><input type="text" class="form-control" id="search_name" name="data[search_name]" onkeyup="nameChange()" placeholder="Search"></td>
                    <td>
                        <div class="form-group">
                            <select id="search_posting" class="selectpicker form-select rounded-0 teal" name="data[search_posting]">
                                <option value="0"> All Status </option>
                                <option value="1"> Posting </option>
                                <option value="2"> Unposting  </option>
                            </select>
                        </div>
                    </td>
            </tbody>
        </table>
        <table id="staffpayment" class="table table-striped table-bordered zero-configuration table-sm ">
        </table>
    </div>
</div>
<div class="modal fade" id="box_modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-gray-light p-1" id="modal_view"></div>
    </div>
</div>
<script>

    
    function nameChange() { if ($('#search_name').val().length == 0 || $('#search_name').val().length > 2) searchChange(); }
    function searchChange() { $('#frmSearch').submit(); $('#search_name').focus(); }
    $('#frmSearch').submit(function () {
        $.ajax({
            url: '/finance/api_projectstaffpayment', type: 'post', dataType: 'json', data: $(this).serialize(),
            success: function (_json) {
                if (_json.status == 1) {
                    _temp = ($('#search_p').val() - 1) * _PAGING;
                    _start = 0;
                    if (_json.rows > 0) _start = _temp + 1;
                    _end = _temp + _json.data.length;
                    _rows = _json.rows;
                    _page = 0;
                    if (_json.rows > 0) _page = $('#search_p').val();
                    _pages = _json.pages;

                    $('#box_list').html('');
                    $.each(_json.data, function (_i, _arr) {
                        _html = '<tr class="bg-gray">';
                        _html+= '<th class="th-code">#</th>';
                        _html+= '<th class="th-date">' + _DATE + '</th>';
                        _html+= '<th class="th-date">' + _DATEDUE + '</th>';
                        _html+= '<th>' + _STAFF + '</th>';
                        _html+= '<th>' + _ACCOUNT + '</th>';
                        _html+= '<th class="th-total">' + _TOTAL + '</th>';
                        _html+= '<th class="th-payment">' + _DISCOUNT + '</th>';
                        _html+= '<th class="th-payment">' + _PAYMENT + '</th>';
                        _html+= '<th class="th-action2">&nbsp;</th>';
                        _html+= '</tr>';
                        $('#box_list').append(_html);
                        
                        _del = ''; if(_arr.status > 1) _del = ' class="bg-warning"';
                        _html = '<tr' + _del + '>';
                        _html+= '<td>' + _arr.code + '</td>';
                        _html+= '<td>' + _arr.date + '</td>';
                        _html+= '<td>' + _arr.datedue + '</td>';
                        _html+= '<td>' + _arr.staff_name + '</td>';
                        _html+= '<td class="text-right">' + _arr.account_name + '</td>';
                        _html+= '<td class="text-right">' + _numberFormat(_arr.total) + '</td>';
                        _html+= '<td class="text-right bg-warning">' + _numberFormat(_arr.discount) + '</td>';
                        _html+= '<td class="text-right bg-success">' + _numberFormat(_arr.payment) + '</td>';
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
                        $('#box_list').append(_html);
                        
                        _html = '<tr' + _del + '>';
                        _html+= '<td colspan="6">';
                        _html+= '<div class="table-responsive">';
                        _html+= '<table class="table bg-white table-bordered text-nowrap">';
                        _html+= '<tr class="bg-gray-light">';
                        _html+= '<th class="th-code">' + _CODE + '</th>';
                        _html+= '<th colspan="2">' + _JOB + '</th>';
                        _html+= '<th class="th-total">' + _TOTAL + '</th>';
                        _html+= '<th class="th-payment">' + _PAYMENT + '</th>';
                        _html+= '</tr>';
                        $.each(_arr.detail, function (_i2, _detail) {
                            _indent = ''; if(_arr.posting == 1) { _indent = ' bg-success'; if(_detail.indent > 0) _indent = ' bg-red'; }
                            
                            _html+= '<tr>';
                            _html+= '<td>' + _detail.projectstaff_code + '</td>';
                            _html+= '<td>' + _detail.job_name + '</td>';
                            _html+= '<td>' + _detail.vehicle_name + '</td>';
                            _html+= '<td class="text-right">' + _numberFormat(_detail.total) + '</td>';
                            _html+= '<td class="text-right">' + _numberFormat(_detail.payment) + '</td>';
                            _html+= '</td>';
                            _html+= '</tr>';
                        });
                        _html+= '</table>';
                        _html+= '</div>';
                        _html+= '</td>';
                        _html+= '<td colspan="2">&nbsp;</td>';
                        _html+= '</tr>';
                        $('#box_list').append(_html);
                    });
                    _html = '<tr class="bg-gray-light">';
                    _html+= '<td colspan="100" class="pt-2 pb-1">';
                    _html+= '<div class="float-left">';
                    _html+= '<b>' + _ROWS + ':</b> ' + _start + '-' + _end;
                    _html+= '&nbsp; | &nbsp;';
                    _html+= '<b>' + _TOTAL + ':</b> ' + _json.data.length + '/' + _rows + ' ' + _ROWS;
                    _html+= '</div>';
                    _html+= '<div class="float-right">';
                    _html+= '<b>' + _PAGE + ':</b> ' + _page + '/' + _pages;
                    _html+= '<div class="btn-group ml-2">';

                    _bg = ' btn-dark'; _disabled = ' disabled';
                    if (_page > 1) { _bg = ' btn-info'; _disabled = ''; }
                    _html+= '<button onclick=clickPrev() class="btn btn-sm pl-2 pr-2' + _bg + '"' + _disabled + '>';
                    _html+= '<i class="fas fa-chevron-left"></i>';
                    _html+= '</button>';

                    _bg = ' btn-dark'; _disabled = ' disabled';
                    if (_page < _pages) { _bg = ' btn-info'; _disabled = ''; }
                    _html+= '<button onclick=clickNext() class="btn btn-sm ml-1 pl-2 pr-2' + _bg + '"' + _disabled + '>';
                    _html+= '<i class="fas fa-chevron-right"></i>';
                    _html+= '</button>';

                    _html+= '</div>';
                    _html+= '</div>';
                    _html+= '</td>';
                    _html+= '</tr>';
                    $('#box_list').append(_html);
                }
            }
        });
        return false;
    });
    
    function showEdit(_id) { localStorage.setItem('_id', _id); window.location = '/finance/projectstaffpayment_edit'; }
    
    function showDelete(_id) {
        Swal.fire({
            title: _DELETEQUESTION, confirmButtonText: _OK, confirmButtonColor: '#f00', cancelButtonText: _CANCEL, cancelButtonColor: '#557', showCancelButton: true, position: 'top', toast: true, background: '#fee'
        }).then((_confirm) => {
            if (_confirm.value) {
                $.ajax({
                    url: '/finance/api_projectstaffpayment_delete', type: 'post', dataType: 'json', data: {'deleteid': _id},
                    success: function (_json) {
                        if (_json.status == 1) { _msgSuccess(_DELETED); setTimeout(function () { searchChange(); }, _APPLOADING); }
                        else _msgError(_FAILED);
                    }
                });
            }
        });
        return false;
    }
    
    function clickPrev() { _p = $('#search_p').val(); _p--; $('#search_p').val(_p); searchChange(); }
    function clickNext() { _p = $('#search_p').val(); _p++; $('#search_p').val(_p); searchChange(); }
</script>