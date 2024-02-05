<div class="card no-border bg-light">    
    <div class="card-body no-border">
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div> 
        <table id="projectpayment" class="table table-striped table-bordered zero-configuration table-sm ">
        </table>
    </div>
</div>
<script>
    $(document).ready(function () { localStorage.setItem('router', '/finance/projectpayment'); ajaxLoading(); });

    function pageControll() {
        $.ajax({
            url: '/finance/api_projectpayment', type: 'post', dataType: 'json', data: {'tID': localStorage.getItem('tID')},
            success: function (_json) {
                if (_json.status == 1) {
                    $('#_body').show();
                    $('#_caption').html(_PROJECTPAYMENT);
                    $('#_module').html(_FINANCE);
                    $('#_title').html(_PROJECTPAYMENT);
                    $('#_event').html(_INDEX);
                    $('#search_name').attr('placeholder', _SEARCH);
                    
                    $('#search_tID').val(localStorage.getItem('tID'));
                    $('#search_date1').val(_json.search_date1);
                    $('#search_date2').val(_json.search_date2);
                    
                    $('#search_account').html('<option value="0">' + _ALL + ' ' + _ACCOUNT + '</option>');
                    $.each(_json._account, function (_i, _arr) {
                        $('#search_account').append('<option value="' + _i + '">' + _arr + '</option>');
                    });
                    
                    $('#search_posting').html('<option value="0">' + _ALL + ' ' + _STATUS + '</option>');
                    $.each(_json._posting, function (_i, _arr) {
                        $('#search_posting').append('<option value="' + _i + '">' + _arr + '</option>');
                    });
                    searchChange();
                }
            }
        });
    }
    
    function nameChange() { if ($('#search_name').val().length == 0 || $('#search_name').val().length > 2) searchChange(); }
    function searchChange() { $('#frmSearch').submit(); $('#search_name').focus(); }
    $('#frmSearch').submit(function () {
        $.ajax({
            url: '/finance/api_projectpayment_search', type: 'post', dataType: 'json', data: $(this).serialize(),
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
                        _html+= '<th>' + _CUSTOMER + '</th>';
                        _html+= '<th>' + _ACCOUNT + '</th>';
                        _html+= '<th class="th-total">' + _TOTAL + '</th>';
                        _html+= '<th class="th-total">' + _TAX + ' #1</th>';
                        _html+= '<th class="th-total">' + _TAX + ' #2</th>';
                        _html+= '<th class="th-total">' + _COST + '</th>';
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
                        _html+= '<td>' + _arr.customer_name + '</td>';
                        _html+= '<td class="text-right">' + _arr.account_name + '</td>';
                        _html+= '<td class="text-right">' + _numberFormat(_arr.total, 4) + '</td>';
                        _html+= '<td class="text-right">' + _numberFormat(_arr.taxes, 4) + '</td>';
                        _html+= '<td class="text-right">' + _numberFormat(_arr.taxes2, 4) + '</td>';
                        _html+= '<td class="text-right">' + _numberFormat(_arr.cost, 4) + '</td>';
                        _html+= '<td class="text-right bg-warning">' + _numberFormat(_arr.discount, 2) + '</td>';
                        _html+= '<td class="text-right bg-success">' + _numberFormat(_arr.payment, 4) + '</td>';
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
                        _html+= '<td colspan="10">';
                        _html+= '<div class="table-responsive">';
                        _html+= '<table class="table bg-white table-bordered text-nowrap">';
                        _html+= '<tr class="bg-gray-light">';
                        _html+= '<th class="th-code">' + _PROJECTCODE + '</th>';
                        _html+= '<th class="th-date">' + _DATE + '</th>';
                        _html+= '<th>' + _VEHICLE + '</th>';
                        _html+= '<th class="th-total">' + _TOTAL + '</th>';
                        _html+= '<th class="th-payment">' + _PAYMENT + '</th>';
                        _html+= '</tr>';
                        $.each(_arr.detail, function (_i2, _detail) {
                            _indent = ''; if(_arr.posting == 1) { _indent = ' bg-success'; if(_detail.indent > 0) _indent = ' bg-red'; }
                            
                            _html+= '<tr>';
                            _html+= '<td>' + _detail.project_code + '</td>';
                            _html+= '<td>' + _detail.project_date + '</td>';
                            _html+= '<td>' + _detail.vehicle_name + ' | ' + _detail.vehicle_police + '</td>';
                            _html+= '<td class="text-right">' + _numberFormat(_detail.total, 4) + '</td>';
                            _html+= '<td class="text-right">' + _numberFormat(_detail.payment, 4) + '</td>';
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
    
    function showEdit(_id) { localStorage.setItem('_id', _id); window.location = '/finance/projectpayment_edit'; }
    
    function showDelete(_id) {
        Swal.fire({
            title: _DELETEQUESTION, confirmButtonText: _OK, confirmButtonColor: '#f00', cancelButtonText: _CANCEL, cancelButtonColor: '#557', showCancelButton: true, position: 'top', toast: true, background: '#fee'
        }).then((_confirm) => {
            if (_confirm.value) {
                $.ajax({
                    url: '/finance/api_projectpayment_delete', type: 'post', dataType: 'json', data: {'tID': localStorage.getItem('tID'), 'id': _id},
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