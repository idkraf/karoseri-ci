<div class="card no-border bg-light">    
    <div class="card-body no-border">
        <div class="card-body border border-0 bg-light">
            <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div> 
        
        <div class="card shadow shadow-lg mb-2">
            <div class="card-body p-2">
                <div class="row">
                    <div class="col-sm-4">
                        <form id="frmSearch" class="form-inline">
                            <input type="hidden" id="search_tID" name="data[tID]" value="YTQ0OGZiNDRmN2FmZDhmZjZjNzhhODVlMjljNzkxNDc1MDU0OWZlNjY1NzUxYzM4Nzk1NmU5ZTE0Yzg4N2Q0Nw==">
                            <input type="hidden" id="search_p" name="data[search_p]" value="1">

                            <div class="input-group input-group-sm">
                                <input type="date" class="form-control form-control-sm ml-2" id="search_date1" name="data[search_date1]" onchange="searchChange()">
                                <input type="date" class="form-control form-control-sm ml-2" id="search_date2" name="data[search_date2]" onchange="searchChange()">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6"><div class="table-responsive">
                <table class="table table-striped table-bordered zero-configuration table-sm ">
                    <thead>
                        <tr>
                            <th colspan="2" id="th_description1">Description</th>
                            <th class="th-total" id="th_before1">Before</th>
                            <th class="th-total" id="th_total1">Total</th>
                            <th class="th-total" id="th_balance1">Balance</th>
                        </tr>
                    </thead>
                    <tbody id="box_list"></tbody>
                </table>
            </div></div>
            <div class="col-sm-6"><div class="table-responsive">
                <table class="table table-striped table-bordered zero-configuration table-sm ">
                    <thead>
                        <tr>
                            <th colspan="2" id="th_description1">Description</th>
                            <th class="th-total" id="th_before1">Before</th>
                            <th class="th-total" id="th_total1">Total</th>
                            <th class="th-total" id="th_balance1">Balance</th>
                        </tr>
                    </thead>
                    <tbody id="box_list2"></tbody>
                </table>
            </div></div>
        </div>
    </div>
</div>
<script>
    //$(document).ready(function () { localStorage.setItem('router', '/accounting/balancesheet'); ajaxLoading(); });

    function pageControll() {
        $.ajax({
            url: '/accounting/api_balancesheet', type: 'post', dataType: 'json', data: {'tID': localStorage.getItem('tID')},
            success: function (_json) {
                if (_json.status == 1) {
                    $('#_body').show();
                    $('#_caption').html(_BALANCESHEET);
                    $('#_module').html(_ACCOUNTING);
                    $('#_title').html(_BALANCESHEET);
                    $('#_event').html(_INDEX);
                    
                    $('#search_tID').val(localStorage.getItem('tID'));
                    $('#search_date1').val(_json.search_date1);
                    $('#search_date2').val(_json.search_date2);
                    
                    $('#th_description1').html(_DESCRIPTION);
                    $('#th_before1').html(_BEFORE);
                    $('#th_total1').html(_TOTAL);
                    $('#th_balance1').html(_BALANCE);
                    $('#th_description2').html(_DESCRIPTION);
                    $('#th_before2').html(_BEFORE);
                    $('#th_total2').html(_TOTAL);
                    $('#th_balance2').html(_BALANCE);
                    searchChange();
                }
            }
        });
    }
    function searchChange() { $('#frmSearch').submit(); }
    $('#frmSearch').submit(function () {
        $.ajax({
            url: '/accounting/api_balancesheet_search', type: 'post', dataType: 'json', data: $(this).serialize(),
            success: function (_json) {
                if (_json.status == 1) {
                    $('#box_list1').html('');
                    _left = 0;
                    $.each(_json.data1, function (_i, _arr) {
                        _left++;
                        _description = '<b>' + _arr.description + '</b>'; 
                        if(_arr.account_show == '1') _description = '<a onclick="showLedger(\'' + _arr.account_id + '\'); return false;" href="/accounting/ledger/' + _arr.account_code + '">' + _arr.description + '</a>';
                        _before = ''; if(_arr.account_show < 2) _before = _numberFormat(_arr.before);
                        _total = ''; if(_arr.account_show < 2) _total = _numberFormat(_arr.total);
                        _balance = ''; if(_arr.account_show < 2) _balance = _numberFormat(_arr.balance);
                        switch(_arr.show){
                            case '1' : 
                                _html = '<tr>';
                                _html+= '<td colspan="5" class="text-bold bg-pink">' + _description + '</td>';
                                _html+= '</tr>';
                                $('#box_list1').append(_html);
                                break;
                            case '3' : 
                                _html = '<tr>';
                                _html+= '<td></td>';
                                _html+= '<td>' + _description + '</td>';
                                _html+= '<td class="text-right">' + _before + '</td>';
                                _html+= '<td class="text-right">' + _total + '</td>';
                                _html+= '<td class="text-right">' + _balance + '</td>';
                                _html+= '</tr>';
                                $('#box_list1').append(_html);
                                break;
                            case '5' : 
                                _html = '<tr class="text-bold bg-gray">';
                                _html+= '<td colspan="2">' + _description + '</td>';
                                _html+= '<td class="text-right">' + _before + '</td>';
                                _html+= '<td class="text-right">' + _total + '</td>';
                                _html+= '<td class="text-right">' + _balance + '</td>';
                                _html+= '</tr>';
                                $('#box_list1').append(_html);
                                break;
                        }
                    });
                    
                    $('#box_list2').html('');
                    _right = 0;
                    $.each(_json.data2, function (_i, _arr) {
                        _right++;
                        _description = '<b>' + _arr.description + '</b>'; 
                        if(_arr.show < 6 && _arr.account_show == '1') _description = '<a onclick="showLedger(\'' + _arr.account_id + '\'); return false;" href="/accounting/ledger/' + _arr.account_code + '">' + _arr.description + '</a>';
                        _before = ''; if(_arr.account_show < 2) _before = _numberFormat(_arr.before);
                        _total = ''; if(_arr.account_show < 2) _total = _numberFormat(_arr.total);
                        _balance = ''; if(_arr.account_show < 2) _balance = _numberFormat(_arr.balance);
                        switch(_arr.show){
                            case '1' : 
                                _html = '<tr>';
                                _html+= '<td colspan="5" class="text-bold bg-pink">' + _description + '</td>';
                                _html+= '</tr>';
                                $('#box_list2').append(_html);
                                break;
                            case '2' : 
                                _html = '<tr><td colspan="5">&nbsp;</td></tr>';
                                $('#box_list2').append(_html);
                                break;
                            case '3' : 
                                _html = '<tr>';
                                _html+= '<td></td>';
                                _html+= '<td>' + _description + '</td>';
                                _html+= '<td class="text-right">' + _before + '</td>';
                                _html+= '<td class="text-right">' + _total + '</td>';
                                _html+= '<td class="text-right">' + _balance + '</td>';
                                _html+= '</tr>';
                                $('#box_list2').append(_html);
                                break;
                            case '4' : 
                                _html = '<tr class="text-bold bg-warning">';
                                _html+= '<td colspan="2">' + _description + '</td>';
                                _html+= '<td class="text-right">' + _before + '</td>';
                                _html+= '<td class="text-right">' + _total + '</td>';
                                _html+= '<td class="text-right">' + _balance + '</td>';
                                _html+= '</tr>';
                                $('#box_list2').append(_html);
                                break;
                            case '5' : 
                                for(_r = 1; _r <= (_left - _right); _r++){
                                    _html = '<tr><td colspan="5">&nbsp;</td></tr>';
                                    $('#box_list2').append(_html);
                                }
                                _html = '<tr class="text-bold bg-gray">';
                                _html+= '<td colspan="2">' + _description + '</td>';
                                _html+= '<td class="text-right">' + _before + '</td>';
                                _html+= '<td class="text-right">' + _total + '</td>';
                                _html+= '<td class="text-right">' + _balance + '</td>';
                                _html+= '</tr>';
                                $('#box_list2').append(_html);
                                break;
                            case '6' : 
                                _html = '<tr>';
                                _html+= '<td></td>';
                                _html+= '<td class="text-right"><a href="/accounting/profitloss/">' + _description + '</a></td>';
                                _html+= '<td class="text-right">' + _before + '</td>';
                                _html+= '<td class="text-right bg-info">' + _total + '</td>';
                                _html+= '<td class="text-right">' + _balance + '</td>';
                                _html+= '</tr>';
                                $('#box_list2').append(_html);
                                break;
                        }
                    });
                }
            }
        });
        return false;
    });
    
    function showLedger(_id) {window.location = '/accounting/ledger?id='_id; }
</script>