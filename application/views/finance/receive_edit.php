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
        <form id="frm" class="form-horizontal small">
            <input type="hidden" id="txt_tID" name="data[tID]" value="MDg0MGMzOWMxZTg1Y2EwZGEyOTdiMTNkNjBkYjNmZDAzM2U3YzRiZGU4NDdiNzkxMzdmODg2OTRhZThmMDQwYw==">
            <input type="hidden" id="txt_id" name="data[id]" value="1dd6fdda38ec172e64e74362c61bd047">
            
            <div class="row">
                <div class="col-sm-3">
                    <label id="lbl_receive_code">#</label>
                    <input type="text" class="form-control form-control-sm" id="txt_code" disabled="">
                </div>
                <div class="col-sm-3">
                    <label id="lbl_date">Date</label>
                    <input type="date" class="form-control form-control-sm" id="txt_date" name="data[date]">
                </div>
                <div class="col-sm-3">
                    <label id="lbl_person">Person</label>
                    <input type="text" class="form-control form-control-sm" id="txt_person" name="data[person]">
                </div>
                <div class="col-sm-3 text-right">
                    <button class="btn btn-sm bg-red" onclick="showDelete(); return false;" id="btn_delete">Delete</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label id="lbl_description">Description</label>
                    <input type="text" class="form-control form-control-sm" id="txt_description" name="data[description]">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-12" id="box_temp">
                    <form id="frmTemp" class="form-horizontal">
                        <input type="hidden" id="txt_temp_tID" name="data[tID]">
                        <input type="hidden" id="txt_temp_id" name="data[id]">

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                    <tr class="bg-gray">
                                        <th id="lbl_account">Account</th>
                                        <th class="th-total2" id="lbl_debit">Debit</th>
                                        <th class="th-total2" id="lbl_credit">Credit</th>
                                        <th class="th-action1">&nbsp;</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <input type="hidden" class="form-control form-control-sm" id="txt_account_id" name="data[account_id]" value="">
                                                    <div class="input-group input-group-sm">
                                                        <input onkeyup="searchAccount(); return false;" type="text" class="form-control form-control-sm" id="txt_account_code">
                                                        <span class="input-group-append">
                                                            <button type="button" onclick="showAccount(); return false;" class="btn bg-gray btn-flat" data-toggle="modal" data-target="#box_modal">...</button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control form-control-sm" id="txt_account_name" disabled="">
                                                </div>
                                            </div>  
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" id="show_debit">
                                            <input type="hidden" id="txt_debit" name="data[debit]" value="5664450">
                                            <script>
                                                $('#show_debit').focus(function () {
                                                    if ($.isNumeric($('#txt_debit').val()) && $('#txt_debit').val() != 0) {
                                                        $('#show_debit').val($('#txt_debit').val());
                                                    } else $('#show_debit').val('');
                                                });
                                                $('#show_debit').keyup(function () {
                                                    $('#txt_debit').val($('#show_debit').val());
                                                    if (!$.isNumeric($('#txt_debit').val())) $('#txt_debit').val(0);
                                                });
                                                $('#show_debit').blur(function () {
                                                    $('#show_debit').val(_numberFormat($('#txt_debit').val(), 4));
                                                });
                                            </script>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" id="show_credit">
                                            <input type="hidden" id="txt_credit" name="data[credit]" value="5664450">
                                            <script>
                                                $('#show_credit').focus(function () {
                                                    if ($.isNumeric($('#txt_credit').val()) && $('#txt_credit').val() != 0) {
                                                        $('#show_credit').val($('#txt_credit').val());
                                                    } else $('#show_credit').val('');
                                                });
                                                $('#show_credit').keyup(function () {
                                                    $('#txt_credit').val($('#show_credit').val());
                                                    if (!$.isNumeric($('#txt_credit').val())) $('#txt_credit').val(0);
                                                });
                                                $('#show_credit').blur(function () {
                                                    $('#show_credit').val(_numberFormat($('#txt_credit').val(), 4));
                                                });
                                            </script>
                                        </td>
                                        <td><button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i></button></td>
                                    </tr>
                                </thead>
                                <tbody id="temp_list"></tbody>
                            </table>
                        </div>

                    </form>
                </div>
            </div>
            <input type="hidden" id="txt_debit">
            <input type="hidden" id="txt_credit">
            <button type="submit" class="btn btn-sm btn-dark mt-2" id="_btn">Save</button>
        </form>
    </div>
</div>
<div class="modal fade" id="box_modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-gray-light p-1" id="modal_list"></div>
    </div>
</div>

<script>
    $(document).ready(function () { 
        $('#lbl_account').html(_ACCOUNT);
        $('#lbl_debit').html(_DEBIT);
        $('#lbl_credit').html(_CREDIT);
        
        tempLoading();
    });
    
    function tempLoading() {
        $.ajax({
            url: '/finance/api_receivetemp', type: 'post', dataType: 'json', data: {'tID': localStorage.getItem('tID')},
            success: function (_json) {
                if (_json.status == 1) {
                    $('#txt_temp_tID').val(localStorage.getItem('tID'));
                    $('#txt_temp_id').val(_json.temp_id);
                    resetAccount();
                    
                    $('#temp_list').html('');
                    _debit = 0;
                    _credit = 0;
                    $.each(_json.data, function (_i, _arr) {
                        _debit+=parseFloat(_arr.debit);
                        _credit+=parseFloat(_arr.credit);
                        
                        _html = '<tr>';
                        _html+= '<td>' + _arr.account_code + ' - ' + _arr.account_name + '</td>';
                        _html+= '<td class="text-right">' + _numberFormat(_arr.debit, 4) + '</td>';
                        _html+= '<td class="text-right">' + _numberFormat(_arr.credit, 4) + '</td>';
                        _html+= '<td class="small">';
                        _html+= '<button class="btn btn-sm btn-danger" onclick="tempDelete(\'' + _arr.id + '\'); return false;">';
                        _html+= '<i class="fa fa-minus fa-sm"></i>';
                        _html+= '</button>';
                        _html+= '</td>';
                        _html+= '</tr>';
                        $('#temp_list').append(_html);
                    });
                    _html = '<tr>';
                    _html+= '<td></td>';
                    _html+= '<td class="text-bold text-right">' + _numberFormat(_debit, 4) + '</td>';
                    _html+= '<td class="text-bold text-right">' + _numberFormat(_credit, 4) + '</td>';
                    _html+= '<td></td>';
                    _html+= '</tr>';
                    $('#temp_list').append(_html);
                    $('#txt_debit').val(_debit);
                    $('#txt_credit').val(_credit);
                    
                    $('#txt_account_code').focus();
                }
            }
        });
    }
    
    function resetAccount(){
        $('#txt_account_id').val('');
        $('#txt_account_code').val('');
        $('#txt_account_name').val('');
        $('#show_debit').val(0);
        $('#txt_debit').val(0);
        $('#show_credit').val(0);
        $('#txt_credit').val(0);
    }
    
    function showAccount() {
        resetAccount();
        $("#modal_list").html('');
        $("#modal_list").load('/finance/receive_account');
    }

    function searchAccount() {
        if($('#txt_account_code').val().length == 5){
            $.ajax({
                url: "/finance/api_receive_account_search", type: "POST",
                dataType: "json", data: {'tID': localStorage.getItem('tID'), 'code': $('#txt_account_code').val()},
                success: function (_json) {
                    if (_json.status == 1) {
                        $('#txt_account_id').val(_json.data.id);
                        $('#txt_account_name').val(_json.data.name);

                        $('#show_debit').focus();
                    }
                }
            });
            return false;
        }
    }
    function tempDelete(_id) {
        Swal.fire({
            title: _DELETEQUESTION, confirmButtonText: _OK, confirmButtonColor: '#f00', cancelButtonText: _CANCEL, cancelButtonColor: '#557', showCancelButton: true, position: 'top', toast: true, background: '#fee'
        }).then((_confirm) => {
            if (_confirm.value) {
                $.ajax({
                    url: '/finance/api_receivetemp_delete', type: 'post', dataType: 'json', data: {'tID': localStorage.getItem('tID'), 'id': _id},
                    success: function (_json) {
                        if (_json.status == 1) { _msgSuccess(_DELETED); tempLoading(); }
                        else _msgError(_FAILED);
                    }
                });
            }
        });
        return false;
    }
    $('#frmTemp').submit(function () {
        _msg = '';
        if (_msg) { $('#box_message').html(_msg); setTimeout(function () { $('#box_message').html(''); }, _APPLOADING); }
        else {
            $.ajax({
                url: '/finance/api_receivetemp_save', type: 'post', dataType: 'json', data: $(this).serialize(),
                success: function (_json) {
                    if (_json.status == 1) { 
                        tempLoading();
                    }
                }
            });
        }
        return false;
    });



    function showDelete() {
        _id = $('#txt_id').val();
        
        Swal.fire({
            title: _DELETEQUESTION, confirmButtonText: _OK, confirmButtonColor: '#f00', cancelButtonText: _CANCEL, cancelButtonColor: '#557', showCancelButton: true, position: 'top', toast: true, background: '#fee'
        }).then((_confirm) => {
            if (_confirm.value) {
                $.ajax({
                    url: '/finance/api_receive_delete', type: 'post', dataType: 'json', data: {'tID': localStorage.getItem('tID'), 'id': _id},
                    success: function (_json) {
                        if (_json.status == 1) { _msgSuccess(_DELETED); setTimeout(function () { window.location = '/finance/receive'; }, _APPLOADING); }
                        else _msgError(_FAILED);
                    }
                });
            }
        });
        return false;
    }

    $('#frm').submit(function () {
        _msg = '';
        if ($('#txt_debit').val() == '' || $('#txt_debit').val() == '0') _msg = 'Empty !';
        if ($('#txt_debit').val() != $('#txt_credit').val()) _msg = 'Debit <> Credit !';
        if (_msg) {
            $('#box_message').html(_msg); setTimeout(function () { $('#box_message').html(''); }, _APPLOADING);
        } else {
            $.ajax({
                url: '/finance/api_receive_update', type: 'post', dataType: 'json', data: $(this).serialize(),
                success: function (_json) {
                    if (_json.status == 1) { 
                        $('#box_message').html(_SAVED);
                        setTimeout(function () { window.location = '/finance/receive'; }, _APPLOADING); 
                    } else { 
                        $('#box_message').html(_FAILED);
                        setTimeout(function () { $('#box_message').html(''); }, _APPLOADING);
                    }
                }
            });
        }
        return false;
    });
</script>