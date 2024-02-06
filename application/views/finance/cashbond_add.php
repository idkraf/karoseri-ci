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

            <div class="form-group">
                <label id="lbl_code">#</label>
                <input type="text" class="form-control form-control-sm" id="txt_code" disabled="">
            </div>
            <div class="form-group">
                <label id="lbl_date">Date</label>
                <input type="date" class="form-control form-control-sm" id="txt_date" name="data[date]">
            </div>
            <div class="form-group">
                <label id="lbl_staff">Staff</label>
                <select id="txt_staff_id" name="data[staff_id]" class="form-control form-control-sm">
                </div>
            <div class="form-group">
                <label id="lbl_description">Description</label>
                <input type="text" class="form-control form-control-sm" id="txt_description" name="data[description]">
            </div>
            <div class="form-group">
                <label id="lbl_account">Account</label>
                <select id="txt_account_id" name="data[account_id]" class="form-control form-control-sm">
                </select>
            </div>
            <div class="form-group">
                <label id="lbl_total">Total</label>
                <input type="text" class="form-control form-control-sm" id="show_total">
                <input type="hidden" id="txt_total" name="data[total]" value="0">
                <script>
                    $('#show_total').focus(function () {
                        if ($.isNumeric($('#txt_total').val()) && $('#txt_total').val() != 0) {
                            $('#show_total').val($('#txt_total').val());
                        } else $('#show_total').val('');
                    });
                    $('#show_total').keyup(function () {
                        $('#txt_total').val($('#show_total').val());
                        if (!$.isNumeric($('#txt_total').val())) $('#txt_total').val(0);
                    });
                    $('#show_total').blur(function () {
                        $('#show_total').val(_numberFormat($('#txt_total').val(), 4));
                    });
                </script>
            </div>
            <button type="submit" class="btn btn-sm btn-dark" id="_btn">Save</button>
        </form>
    </div>
</div>
<script>
    
    $(document).ready(function () {
        pageControll();
        function pageControll() {
            $.ajax({
                url: '/finance/api_cashbond_add', type: 'get', dataType: 'json', data: {},
                success: function (_json) {
                    if (_json.status == 1) {
                        $('#_body').show();
                        $('#_caption').html(_CASHBOND);
                        $('#_module').html(_FINANCE);
                        $('#_title').html(_CASHBOND);
                        $('#_event').html(_ADD);
                        
                        $('#lbl_code').html('#');
                        $('#lbl_date').html(_DATE);
                        $('#lbl_staff').html(_STAFF);
                        $('#lbl_description').html(_DESCRIPTION);
                        $('#lbl_account').html(_ACCOUNT);
                        $('#lbl_total').html(_TOTAL);
                        $('#_btn').html(_SAVE);
                        
                        $('#txt_staff_id').html('');
                        $.each(_json._staff, function (_i, _arr) {
                            console.log(_arr.id);
                            _html = '<option value="' + _arr.id + '">' + _arr.code + ' - ' + _arr.name + '</option>';
                            $('#txt_staff_id').append(_html);
                        });
                        
                        $('#txt_account_id').html('');
                        $.each(_json._account, function (_i, _arr) {
                            _html = '<option value="' + _arr.id + '">' + _arr.code + ' - ' + _arr.name + '</option>';
                            $('#txt_account_id').append(_html);
                        });
                        
                        $('#txt_tID').val(localStorage.getItem('tID'));
                        //$('#txt_id').val(_json.data.id);
                        $('#txt_code').val(_AUTO);
                        //$('#txt_date').val(_json.data.date);
                        $('#show_total').val('0.0000');
                        $('#txt_total').val(0);
                        $('#txt_description').focus();
                    }
                }
            });
        }
    });
    $('#frm').submit(function () {
        _msg = '';
        if ($('#txt_total').val() == '0') _msg += _TOTALEMPTY + '<br>';
        if (_msg) { $('#box_message').html(_msg); setTimeout(function () { $('#box_message').html(''); }, _APPLOADING); }
        else {
            $.ajax({
                url: '/finance/api_cashbond_save', type: 'post', dataType: 'json', data: $(this).serialize(),
                success: function (_json) {
                    if (_json.status == 1) { 
                        $('#box_message').html(_SAVED); setTimeout(function () { window.location = '/finance/cashbond'; }, _APPLOADING);
                    } else {
                        $('#box_message').html(_FAILED); setTimeout(function () { $('#box_message').html(''); }, _APPLOADING);
                    }
                }
            });
        }
        return false;
    });
</script>