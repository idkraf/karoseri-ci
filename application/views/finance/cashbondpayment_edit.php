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
        <form id="frm" class="small">
            <input type="hidden" id="txt_tID" name="data[tID]" value="">
            <input type="hidden" id="txt_id" name="data[id]" value="">
            <input type="hidden" id="txt_cashbond_id" name="data[cashbond_id]" value="">

            <div class="form-group">
                <label id="lbl_cashbond_code">#</label>
                <input type="text" class="form-control form-control-sm" id="txt_cashbond_code" disabled="">
            </div>
            <div class="form-group">
                <label id="lbl_staff">Staff</label>
                <input type="text" class="form-control form-control-sm" id="txt_staff" disabled="">
            </div>
            <div class="form-group">
                <label id="lbl_description">Description</label>
                <input type="text" class="form-control form-control-sm" id="txt_description" disabled="">
            </div>
            <div class="form-group">
                <label id="lbl_total">Total</label>
                <input type="text" class="form-control form-control-sm" id="show_total" disabled="">
                <input type="hidden" id="txt_total" name="data[total]" value="0">
            </div>
            <hr>
            
            <div class="form-group">
                <label id="lbl_code">#</label>
                <input type="text" class="form-control form-control-sm" id="txt_code" disabled="">
            </div>
            <div class="form-group">
                <label id="lbl_date">Date</label>
                <input type="date" class="form-control form-control-sm" id="txt_date" name="data[date]">
            </div>
            <div class="form-group">
                <label id="lbl_account">Account</label>
                <select id="txt_account_id" name="data[account_id]" class="form-control form-control-sm">
                </select>
            </div>
            <div class="form-group">
                <label id="lbl_payment">Payment</label>
                <input type="text" class="form-control form-control-sm" id="show_payment">
                <input type="hidden" id="txt_payment" name="data[payment]" value="0">
                <script>
                    $('#show_payment').focus(function () {
                        if ($.isNumeric($('#txt_payment').val()) && $('#txt_payment').val() != 0) {
                            $('#show_payment').val($('#txt_payment').val());
                        } else $('#show_payment').val('');
                    });
                    $('#show_payment').keyup(function () {
                        $('#txt_payment').val($('#show_payment').val());
                        if (!$.isNumeric($('#txt_payment').val())) $('#txt_payment').val(0);
                    });
                    $('#show_payment').blur(function () {
                        $('#show_payment').val(_numberFormat($('#txt_payment').val(), 4));
                    });
                </script>
            </div>
            <button type="submit" class="btn btn-sm btn-dark" id="_btn">Save</button>
        </form>

    </div>
</div>

<script>
    function pageControll() {
        $.ajax({
            url: '/finance/api_cashbondpayment_add', type: 'post', dataType: 'json', data: {'id': $id},
            success: function (_json) {
                if (_json.status == 1) {
                    $('#_body').show();
                    $('#_caption').html(_CASHBONDPAYMENT);
                    $('#_module').html(_FINANCE);
                    $('#_title').html(_CASHBONDPAYMENT);
                    $('#_event').html(_ADD);
                    
                    $('#lbl_cashbond_code').html('#');
                    $('#lbl_staff').html(_STAFF);
                    $('#lbl_description').html(_DESCRIPTION);
                    $('#lbl_total').html(_TOTAL);
                    
                    $('#lbl_code').html('#');
                    $('#lbl_date').html(_DATE);
                    $('#lbl_account').html(_ACCOUNT);
                    $('#lbl_payment').html(_PAYMENT);
                    $('#_btn').html(_SAVE);
                    
                    $('#txt_account_id').html('');
                    $.each(_json._account, function (_i, _arr) {
                        _html = '<option value="' + _arr.id + '">' + _arr.code + ' - ' + _arr.name + '</option>';
                        $('#txt_account_id').append(_html);
                    });
                    
                    $('#txt_tID').val(localStorage.getItem('tID'));
                    $('#txt_id').val(_json.data.id);
                    $('#txt_cashbond_id').val(_json._cashbond.id);
                    $('#txt_cashbond_code').val(_json._cashbond.code);
                    $('#txt_staff').val(_json._cashbond.staff_name);
                    $('#txt_description').val(_json._cashbond.description);
                    $('#show_total').val(_numberFormat(_json._cashbond.balance, 4));
                    $('#txt_total').val(_json._cashbond.balance);
                    
                    $('#txt_code').val(_AUTO);
                    $('#txt_date').val(_json.data.date);
                    $('#show_payment').val(_numberFormat(_json._cashbond.balance, 4));
                    $('#txt_payment').val(_json._cashbond.balance);
                    
                    $('#show_payment').focus();
                }
            }
        });
    }
    
    $('#frm').submit(function () {
        _msg = '';
        if ($('#txt_payment').val() == '0') _msg += _PAYMENTEMPTY + '<br>';
        if (parseFloat($('#txt_payment').val()) > parseFloat($('#txt_total').val())) _msg += _PAYMENTOVER + '<br>';
        if (_msg) { $('#box_message').html(_msg); setTimeout(function () { $('#box_message').html(''); }, _APPLOADING); }
        else {
            $.ajax({
                url: '/finance/api_cashbondpayment_save', type: 'post', dataType: 'json', data: $(this).serialize(),
                success: function (_json) {
                    if (_json.status == 1) { 
                        $('#box_message').html(_SAVED); setTimeout(function () { window.location = '/finance/cashbondpayment'; }, _APPLOADING);
                    } else {
                        $('#box_message').html(_FAILED); setTimeout(function () { $('#box_message').html(''); }, _APPLOADING);
                    }
                }
            });
        }
        return false;
    });
</script>