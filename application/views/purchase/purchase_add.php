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
            <input type="hidden" id="txt_id" name="data[id]">
            <table border="0" cellspacing="8" cellpadding="8" class="mb-2">
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label class="form-label">#</label>
                                <input id="txt_code" class="form-control" type="text" placeholder="Auto" disabled>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label class="form-label">Tanggal</label>
                                <input id="txt_date" class="form-control" type="text" name="data[date]" data-toggle="datepicker">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label class="form-label">Supplier#</label>
                                <div class="input-group input-group-sm">
                                    <input onkeyup="searchSupplier(); return false;" type="text" class="form-control" id="txt_supplier_code">
                                    <span class="input-group-append">
                                        <button type="button" onclick="showSupplier(); return false;" class="btn bg-gray btn-flat"
                                        style="background-color:#6c757d;color:#fff" data-toggle="modal" data-target="#box_supplier_modal">...</button>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label class="form-label">Supplier name</label>
                                <input type="text" class="form-control" id="txt_supplier_name" disabled="">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table id="box_list" class="table small table-bordered table-hover text-nowrap m-0">
                <thead>
                    <tr class="bg-gray">
                            <th id="lbl_item">Item</th>
                            <th class="th-size2" id="lbl_size" style="width:75px">Size</th>
                            <th class="th-price2" id="lbl_pricebig">Price</th>
                            <th class="th-qty2" id="lbl_big" style="width:75px">Qty</th>
                            <th class="th-disc2" id="lbl_disc" style="width:75px">Disc</th>
                            <th class="th-tax2" id="lbl_tax" style="width:75px">Tax</th>
                            <th class="th-subtotal2" id="lbl_subtotal">Subtotal</th>
                            <th class="th-action1">&nbsp;</th>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <div class="row">
                                <div class="col-sm-5">
                                    <input type="hidden" class="form-control" id="txt_item_id" name="data[item_id]" value="">
                                    <div class="input-group input-group-sm">
                                        <input onkeyup="searchItem(); return false;" type="text" class="form-control" id="txt_item_code">
                                        <span class="input-group-append">
                                            <button type="button" onclick="showItem(); return false;" class="btn bg-gray btn-flat"
                                            style="background-color:#6c757d;color:#fff" 
                                            data-toggle="modal" data-target="#box_modal">...</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="txt_item_name" disabled="">
                                </div>
                            </div>  
                        </td>
                        <td class="p-1">
                            <input type="text" class="form-control" id="show_size">
                            <input type="hidden" id="txt_size" name="data[size]" value="1">
                            <script>
                                $('#show_size').focus(function () {
                                    if ($.isNumeric($('#txt_size').val()) && $('#txt_size').val() != 0) {
                                        $('#show_size').val($('#txt_size').val());
                                    } else
                                        $('#show_size').val('');
                                });
                                $('#show_size').keyup(function () {
                                    $('#txt_size').val($('#show_size').val());
                                    if (!$.isNumeric($('#txt_size').val()))
                                        $('#txt_size').val(0);
                                    _sumSubtotal();
                                });
                                $('#show_size').blur(function () {
                                    $('#show_size').val(_numberFormat($('#txt_size').val(), 3));
                                    _sumSubtotal();
                                });
                            </script>
                        </td>
                        <td class="p-1">
                            <input type="text" class="form-control" id="show_pricebig">
                            <input type="hidden" id="txt_pricebig" name="data[pricebig]" value="0">
                            <script>
                                $('#show_pricebig').focus(function () {
                                    if ($.isNumeric($('#txt_pricebig').val()) && $('#txt_pricebig').val() != 0) {
                                        $('#show_pricebig').val($('#txt_pricebig').val());
                                    } else
                                        $('#show_pricebig').val('');
                                });
                                $('#show_pricebig').keyup(function () {
                                    $('#txt_pricebig').val($('#show_pricebig').val());
                                    if (!$.isNumeric($('#txt_pricebig').val()))
                                        $('#txt_pricebig').val(0);
                                    _sumSubtotal();
                                });
                                $('#show_pricebig').blur(function () {
                                    $('#show_pricebig').val(_numberFormat($('#txt_pricebig').val(), 4));
                                    _sumSubtotal();
                                });
                            </script>
                        </td>
                        <td class="p-1">
                            <input type="text" class="form-control" id="show_big">
                            <input type="hidden" id="txt_big" name="data[big]" value="0">
                            <script>
                                $('#show_big').focus(function () {
                                    if ($.isNumeric($('#txt_big').val()) && $('#txt_big').val() != 0) {
                                        $('#show_big').val($('#txt_big').val());
                                    } else
                                        $('#show_big').val('');
                                });
                                $('#show_big').keyup(function () {
                                    $('#txt_big').val($('#show_big').val());
                                    if (!$.isNumeric($('#txt_big').val()))
                                        $('#txt_big').val(0);
                                    _sumSubtotal();
                                });
                                $('#show_big').blur(function () {
                                    $('#show_big').val(_numberFormat($('#txt_big').val(), 3));
                                    _sumSubtotal();
                                });
                            </script>
                        </td>
                        <td class="p-1">
                            <input type="text" class="form-control" id="show_disc">
                            <input type="hidden" id="txt_disc" name="data[disc]" value="0">
                            <script>
                                $('#show_disc').focus(function () {
                                    if ($.isNumeric($('#txt_disc').val()) && $('#txt_disc').val() != 0) {
                                        $('#show_disc').val($('#txt_disc').val());
                                    } else
                                        $('#show_disc').val('');
                                });
                                $('#show_disc').keyup(function () {
                                    $('#txt_disc').val($('#show_disc').val());
                                    if (!$.isNumeric($('#txt_disc').val()))
                                        $('#txt_disc').val(0);
                                    _sumSubtotal();
                                });
                                $('#show_disc').blur(function () {
                                    $('#show_disc').val(_numberFormat($('#txt_disc').val()));
                                    _sumSubtotal();
                                });
                            </script>
                        </td>
                        <td class="p-1">
                            <input type="text" class="form-control" id="show_tax">
                            <input type="hidden" id="txt_tax" name="data[tax]" value="0">
                            <script>
                                $('#show_tax').focus(function () {
                                    if ($.isNumeric($('#txt_tax').val()) && $('#txt_tax').val() != 0) {
                                        $('#show_tax').val($('#txt_tax').val());
                                    } else
                                        $('#show_tax').val('');
                                });
                                $('#show_tax').keyup(function () {
                                    $('#txt_tax').val($('#show_tax').val());
                                    if (!$.isNumeric($('#txt_tax').val()))
                                        $('#txt_tax').val(0);
                                    _sumSubtotal();
                                });
                                $('#show_tax').blur(function () {
                                    $('#show_tax').val(_numberFormat($('#txt_tax').val()));
                                    _sumSubtotal();
                                });
                            </script>
                        </td>
                        <td class="p-1">
                            <input type="text" class="form-control text-right" id="show_subtotal" disabled="">
                            <input type="hidden" id="txt_subtotal" name="data[subtotal]" value="0">
                        </td>
                        <td class="p-1"><button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i></button></td>
                    </tr>
                </thead>

                <tbody id="temp_list"></tbody>                
                <tbody>
                    <tr>
                        <td colspan="5">&nbsp;</td>
                        <td id="lbl_total">Total</td>
                        <td class="th-total  text-right p-1">
                            <input type="text" class="form-control  text-right" id="show_total" disabled="">
                            <input type="hidden" id="txt_total" name="data[total]" value="0">
                        </td>
                        <td class="th-action1">&nbsp;</td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-3">
                    <label id="lbl_code">Code</label>
                    <input type="text" class="form-control form-control-sm" id="txt_code2" name="data[code2]">
                </div>
                <div class="col-sm-3">
                    <label id="lbl_datedue">Datedue</label>
                    <input type="date" class="form-control form-control-sm" id="txt_datedue" name="data[datedue]">
                </div>
                <div class="col-sm-3">
                    <label id="lbl_notes">Notes</label>
                    <input type="text" class="form-control form-control-sm" id="txt_notes" name="data[notes]">
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-dark mt-2" id="_btn">Save</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () { 
        //$('#lbl_item').html(_ITEM);
        //$('#lbl_size').html(_SIZE);
        //$('#lbl_pricebig').html(_PRICE);
        //$('#lbl_big').html(_QTY);
        //$('#lbl_disc').html(_DISC);
        //$('#lbl_tax').html(_TAX);
        //$('#lbl_subtotal').html(_SUBTOTAL);
        $('#txt_purchase_id').val($('#txt_id').val());
        
        tempLoading();
    });
    
    function tempLoading() {
        $.ajax({
            url: '/purchase/api_purchasetemp', type: 'post', dataType: 'json', data: {'tID': localStorage.getItem('tID'), 'purchase_id': $('#txt_id').val()},
            success: function (_json) {
                if (_json.status == 1) {
                    $('#txt_temp_tID').val(localStorage.getItem('tID'));
                    $('#txt_temp_id').val(_json.temp_id);
                    resetItem();
                    
                    _total = 0;
                    $('#temp_list').html('');
                    $.each(_json.data, function (_i, _arr) {
                        _total+=parseFloat(_arr.subtotal);
                        
                        _html = '<tr>';
                        _html+= '<td>' + _arr.item_name + '</td>';
                        _html+= '<td class="text-right">' + _numberFormat(_arr.size, 3) + '</td>';
                        _html+= '<td class="text-right">' + _numberFormat(_arr.pricebig, 4) + '</td>';
                        _html+= '<td class="text-right">' + _numberFormat(_arr.big, 3) + '</td>';
                        _html+= '<td class="text-right">' + _numberFormat(_arr.disc) + '</td>';
                        _html+= '<td class="text-right">' + _numberFormat(_arr.tax) + '</td>';
                        _html+= '<td class="text-right">' + _numberFormat(_arr.subtotal, 4) + '</td>';
                        _html+= '<td class="small">';
                        _html+= '<button class="btn btn-sm btn-danger" onclick="tempDelete(\'' + _arr.id + '\'); return false;">';
                        _html+= '<i class="fa fa-minus fa-sm"></i>';
                        _html+= '</button>';
                        _html+= '</td>';
                        _html+= '</tr>';
                        $('#temp_list').append(_html);
                    });
                    $('#show_total').val(_numberFormat(_total, 4));
                    $('#txt_total').val(_total);
                    
                    $('#txt_item_code').focus();
                }
            }
        });
    }
    
    function resetItem(){
        $('#txt_item_id').val('');
        $('#txt_item_code').val('');
        $('#txt_item_name').val('');
        $('#show_size').val(_numberFormat(1, 3));
        $('#txt_size').val(1);
        $('#show_pricebig').val(_numberFormat(0, 4));
        $('#txt_pricebig').val(0);
        $('#show_big').val(_numberFormat(0, 3));
        $('#txt_big').val(0);
        $('#show_disc').val(0);
        $('#txt_disc').val(0);
        $('#show_tax').val(0);
        $('#txt_tax').val(0);
        $('#show_subtotal').val(_numberFormat(0, 4));
        $('#txt_subtotal').val(0);
    }
    
    function showItem() {
        resetItem();
        $("#modal_list").html('');
        $("#modal_list").load('/purchase/purchase_item');
    }

    function searchItem() {
        if($('#txt_item_code').val().length > 2){
            $.ajax({
                url: "/purchase/api_purchase_item_search", type: "POST",
                dataType: "json", data: {'tID': localStorage.getItem('tID'), 'code': $('#txt_item_code').val()},
                success: function (_json) {
                    if (_json.status == 1) {
                        $('#txt_item_id').val(_json.data.id);
                        $('#txt_item_name').val(_json.data.name);
                        $('#show_pricebig').val(_numberFormat(_json.data.pricebuy, 4));
                        $('#txt_pricebig').val(_json.data.pricebuy);

                        $('#show_big').focus();
                    }
                }
            });
            return false;
        }
    }
    
    function _sumSubtotal() {
        item_pricebig = $('#txt_pricebig').val();
        item_big = $('#txt_big').val();
        item_disc = $('#txt_disc').val();
        item_tax = $('#txt_tax').val();
        sub = item_pricebig * item_big;
        discount = (item_disc / 100) * sub;
        sub_discount = sub - discount;
        taxes = (item_tax / 100) * sub_discount;
        subtotal = sub_discount + taxes;

        $('#show_subtotal').val(_numberFormat(subtotal, 4));
        $('#txt_subtotal').val(subtotal);
    }
    function tempDelete(_id) {
        Swal.fire({
            title: _DELETEQUESTION, confirmButtonText: _OK, confirmButtonColor: '#f00', cancelButtonText: _CANCEL, cancelButtonColor: '#557', showCancelButton: true, position: 'top', toast: true, background: '#fee'
        }).then((_confirm) => {
            if (_confirm.value) {
                $.ajax({
                    url: '/purchase/api_purchasetemp_delete', type: 'post', dataType: 'json', data: {'tID': localStorage.getItem('tID'), 'id': _id},
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
        if ($('#txt_item_code').val() == '') {
            _msg += _ITEMEMPTY + '<br>';
            $('#txt_item_code').focus();
        }
        if (_msg) { $('#box_message').html(_msg); setTimeout(function () { $('#box_message').html(''); }, _APPLOADING); }
        else {
            $.ajax({
                url: '/purchase/api_purchasetemp_save', type: 'post', dataType: 'json', data: $(this).serialize(),
                success: function (_json) {
                    if (_json.status == 1) { 
                        tempLoading();
                    }
                }
            });
        }
        return false;
    });
</script>