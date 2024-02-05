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
        <table class="table table-striped table-bordered zero-configuration table-sm ">
            <thead class="bg-gray">
                <tr>
                    <th colspan="2" id="th_description">Description</th>
                    <th class="th-total" id="th_total">Total</th>
                    <th class="th-total" id="th_balance">Balance</th>
                </tr>
            </thead>
            <tbody id="box_list"></tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function () { localStorage.setItem('router', '/accounting/profitloss'); ajaxLoading(); });

function pageControll() {
    $.ajax({
        url: '/accounting/api_profitloss', type: 'post', dataType: 'json', data: {'tID': localStorage.getItem('tID')},
        success: function (_json) {
            if (_json.status == 1) {
                $('#_body').show();
                $('#_caption').html(_PROFITLOSS);
                $('#_module').html(_ACCOUNTING);
                $('#_title').html(_PROFITLOSS);
                $('#_event').html(_INDEX);
                
                $('#search_tID').val(localStorage.getItem('tID'));
                $('#search_date1').val(_json.search_date1);
                $('#search_date2').val(_json.search_date2);
                
                $('#th_description').html(_DESCRIPTION);
                $('#th_total').html(_TOTAL);
                $('#th_balance').html(_BALANCE);
                searchChange();
            }
        }
    });
}
function searchChange() { $('#frmSearch').submit(); }
$('#frmSearch').submit(function () {
    $.ajax({
        url: '/accounting/api_profitloss_search', type: 'post', dataType: 'json', data: $(this).serialize(),
        success: function (_json) {
            if (_json.status == 1) {
                
                $('#box_list').html('');
                $.each(_json.data, function (_i, _arr) {
                    switch(_arr.show){
                        case '1' : 
                            _html = '<tr>';
                            _html+= '<td colspan="4" class="text-bold bg-pink">' + _arr.description + '</td>';
                            _html+= '</tr>';
                            $('#box_list').append(_html);
                            break;
                            
                        case '2' : 
                            _html = '<tr><td colspan="4">&nbsp;</td></tr>';
                            $('#box_list').append(_html);
                            break;
                            
                        case '3' : 
                            _desc = '<b>' + _arr.description + '</b>'; 
                            if(_arr.account_id) _desc = '<a onclick="showLedger(\'' + _arr.account_id + '\');return false;" href="/accounting/ledger/' + _arr.account_id + '">' + _arr.description + '</a>';
                            
                            _html = '<tr>';
                            _html+= '<td></td>';
                            _html+= '<td>' + _desc + '</td>';
                            _html+= '<td class="text-right">' + _numberFormat(_arr.subtotal) + '</td>';
                            _html+= '<td></td>';
                            _html+= '</tr>';
                            $('#box_list').append(_html);
                            break;
                        case '4' : 
                            _html = '<tr class="text-bold">';
                            _html+= '<td colspan="3">' + _arr.description + '</td>';
                            _html+= '<td class="text-right bg-gray-light">' + _numberFormat(_arr.total) + '</td>';
                            _html+= '</tr>';
                            $('#box_list').append(_html);
                            break;
                        case '5' : 
                            _html = '<tr class="text-bold bg-warning">';
                            _html+= '<td colspan="3" class="text-right">' + _arr.description + '</td>';
                            _html+= '<td class="text-right bg-gray">' + _numberFormat(_arr.total) + '</td>';
                            _html+= '</tr>';
                            $('#box_list').append(_html);
                            break;
                    }
                });
            }
        }
    });
    return false;
});

function showLedger(_id) { localStorage.setItem('_id', _id); window.location = '/accounting/ledger'; }
</script>