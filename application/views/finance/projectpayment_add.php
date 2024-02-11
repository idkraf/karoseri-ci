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
            <input type="hidden" id="txt_customer_id" name="data[customer_id]" value="<?php echo $cust['id'] ?>">
            <table border="0" cellspacing="8" cellpadding="8" class="mb-2">
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label class="form-label">#</label>
                                <input id="txt_code" name="data[code]" class="form-control" type="text"  value="PPRO<?php echo date('Ymd'); ?><?php echo random_string('numeric', 4) ?>" disabled>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label class="form-label">Tanggal</label>
                                <input id="txt_date" class="selectpicker form-select rounded-0 teal" type="text" name="data[date]" data-toggle="datepicker">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label class="form-label">Customer</label>
                                <input type="text" class="form-control" id="txt_customer_name" disabled="" value="<?php echo $cust['name'] ?>">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-nowrap">
                        <thead>
                            <tr class="bg-gray">
                                <th class="th-code2" id="th_code">Project#</th>
                                <th id="th_date">Date</th>
                                <th id="th_vehicle">Vehicle</th>
                                <th class="th-total2" id="th_taxes">Tax#1</th>
                                <th class="th-total2" id="th_taxes2">Tax#2</th>
                                <th class="th-total2" id="th_total">Total</th>
                                <th class="th-payment2" id="th_payment">Payment</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" disabled="">
                                        <span class="input-group-append">
                                            <button type="button" id="btn_list"
                                            style="background-color:#6c757d;color:#fff" class="btn bg-gray btn-flat" 
                                            data-toggle="modal" data-target="#dataProject">...</button>
                                        </span>
                                    </div>
                                </td>
                                <td><input type="text" class="form-control"  disabled=""></td>
                                <td><input type="text" class="form-control" disabled=""></td>
                                <td>
                                    <input type="text" class="form-control text-right"   disabled="">
                                </td>
                                <td>
                                    <input type="text" class="form-control text-right"   disabled="">
                                </td>
                                <td>
                                    <input type="text" class="form-control  text-right" disabled="">
                                </td>
                                <td>
                                    <input type="text" class="form-control "   disabled="">
                                </td>
                            </tr>
                        </thead>
                        <tbody id="temp_list"></tbody>
                    </table>
                </div>
            <div class="row mt-0">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody><tr>
                                <td colspan="5" class="text-bold text-end" id="lbl_total">Total</td>
                                <td class="th-total2 p-1" style="width:180px">
                                    <input type="text" class="form-control text-end" id="show_total" disabled="">
                                    <input type="hidden" id="txt_total" name="data[total]" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-bold text-end">Tax #1</td>
                                <td class="th-total2 p-1">
                                    <input type="text" class="form-control text-end" id="show_taxes" disabled="">
                                    <input type="hidden" id="txt_taxes" name="data[tax]" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-bold text-end">Tax #2</td>
                                <td class="th-total2 p-1">
                                    <input type="text" class="form-control text-end" id="show_taxes2" disabled="">
                                    <input type="hidden" id="txt_taxes2" name="data[taxppn]" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-bold text-end" id="lbl_cost">Cost</td>
                                <td class="th-total2 p-1">
                                    <input type="text" class="form-control text-end" id="show_cost">
                                    <input type="hidden" id="txt_cost" name="data[cost]" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-bold text-end" id="lbl_discount">Discount</td>
                                <td class="th-total2 p-1">
                                    <input type="text" class="form-control form-control-sm text-end" id="show_discount">
                                    <input type="hidden" id="txt_discount" name="data[disc]" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-bold text-end" id="lbl_account">Account</td>
                                <td>
                                    <select id="txt_account_id" name="data[account_id]" class="selectpicker form-select rounded-0 teal p-1">
                                    <?php
                                        foreach ($account as $row) {
                                            $cid = $row['id'];
                                            $title = $row['name'];
                                            echo "<option value='$cid'>$title</option>";
                                        }
                                    ?>
                                    </select>
                                </td>
                                <td class="text-bold text-end" id="lbl_payment">Payment</td>
                                <td class="th-total2 p-1">
                                    <input type="text" class="form-control text-end" id="show_payment"  name="data[payment]" disabled="">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label id="lbl_datedue">Datedue</label>
                    <input class="selectpicker form-select rounded-0 teal" id="txt_datedue" name="data[datedue]" data-toggle="datepicker">
                </div>
                <div class="col-sm-3">
                    <label id="lbl_notes">Notes</label>
                    <input type="text" class="form-control" id="txt_notes" name="data[notes]">
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-dark mt-2" id="_btn">Save</button>
        </form>
        <div class="text-danger text-sm mt-2" id="box_message"></div>
    </div>
</div>
<div class="modal fade" id="dataProject" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-gray-light p-1" id="modal_list"><div class="modal-header bg-gray">
            <h5 class="modal-title" id="list_caption">Project</h5>
            <button class="close" data-dismiss="modal" aria-label="Close" id="btn_close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row mt-2">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table id="project" class="table small table-bordered table-hover text-nowrap m-0">
                            <thead class="bg-gray">
                                <tr>
                                    <th class="th-code" id="th_project_code">Project#</th>
                                    <!--th class="th-code" id="th_code"></th-->
                                    <th class="th-date" id="th_date"></th>
                                    <th id="th_customer">Customer</th>
                                    <th id="th_vehicle"></th>
                                    <th class="th-date" id="th_datedue">Datedue</th>
                                    <th class="th-total" id="th_total"></th>
                                    <th class="th-payment" id="th_payment"></th>
                                    <th class="th-balance" id="th_balance">Balance</th>
                                    <th class="th-action1"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<script>
    $('#show_cost').focus(function () {
        if ($.isNumeric($('#txt_cost').val()) && $('#txt_cost').val() != 0) {
            $('#show_cost').val($('#txt_cost').val());
        } else
            $('#show_cost').val('');
    });
    $('#show_cost').keyup(function () {
        $('#txt_cost').val($('#show_cost').val());
        if (!$.isNumeric($('#txt_cost').val())) $('#txt_cost').val(0);
        _calculatePayment()
    });
    $('#show_cost').blur(function () {
        $('#show_cost').val(_numberFormat($('#txt_cost').val(), 4));
        _calculatePayment();
    });
    
    $('#show_discount').focus(function () {
        if ($.isNumeric($('#txt_discount').val()) && $('#txt_discount').val() != 0) {
            $('#show_discount').val($('#txt_discount').val());
        } else
            $('#show_discount').val('');
    });
    $('#show_discount').keyup(function () {
        $('#txt_discount').val($('#show_discount').val());
        if (!$.isNumeric($('#txt_discount').val())) $('#txt_discount').val(0);
        _calculatePayment();
    });
    $('#show_discount').blur(function () {
        $('#show_discount').val(_numberFormat($('#txt_discount').val(), 4));
        _calculatePayment();
    });

    function _calculatePayment(){
        _total = parseFloat($('#txt_total').val());
        _taxes = parseFloat($('#txt_taxes').val());
        _taxes2 = parseFloat($('#txt_taxes2').val());
        _cost = parseFloat($('#txt_cost').val());
        _discount = parseFloat($('#txt_discount').val());
        _payment = _total - _taxes - _taxes2 - _cost - _discount;
        
        $('#show_payment').val(_numberFormat(_payment, 4));
    }
    
    $('#temp_show_payment').focus(function () {
        if ($.isNumeric($('#temp_txt_payment').val()) && $('#temp_txt_payment').val() != 0) {
            $('#temp_show_payment').val($('#temp_txt_payment').val());
        } else
            $('#temp_show_payment').val('');
    });
    $('#temp_show_payment').keyup(function () {
        $('#temp_txt_payment').val($('#temp_show_payment').val());
        if (!$.isNumeric($('#temp_txt_payment').val()))
            $('#temp_txt_payment').val(0);
    });
    $('#temp_show_payment').blur(function () {
        $('#temp_show_payment').val(_numberFormat($('#temp_txt_payment').val(), 4));
    });
    
    
    $('#temp_list').on('click', '.minusAdd', function () {
        
        _total = parseFloat($('#txt_total').val());
        _total = _total +  $(this).attr('data-row-total');
        $('#show_total').val(_numberFormat(_total, 4));
        //var cvalue = parseInt($('#ganak').val()) - 1;
        //var nxt = parseInt(cvalue);
        //$('#ganak').val(nxt);
        //$('#pid').val(0);
        
        //count = $('#temp_list tr').length;
        $(this).closest('tr').remove();
        //$('#d' + $(this).closest('tr').find('.pdIn').attr('id')).closest('tr').remove();
        //$('#show_total').each(function (index) {
        //    rowTotal(index);
            //billUpyog();
        //});

        return false;
    });

    $(document).on('click', ".pilih-project", function (e) {        
        //$('#txt_item_id').val($(this).attr('data-object-pid'));
        var id = $(this).attr('data-view-id');
        var cid = $(this).attr('data-view-customer-id');
        var name =$(this).attr('data-view-name');
        var vid = $(this).attr('data-view-vehicle-id');
        var vname = $(this).attr('data-view-vname');
        var code = $(this).attr('data-view-code');
        var total = $(this).attr('data-view-total');
        var payment = $(this).attr('data-view-payment');
        var date = $(this).attr('data-view-date');
        var duedate = $(this).attr('data-view-duedate');
        var tax = $(this).attr('data-view-tax');
        var taxppn = $(this).attr('data-view-taxppn');

        _total = parseFloat($('#txt_total').val());
        _total = _total + total;
        $('#show_total').val(_numberFormat(_total, 4));
        $('#txt_total').val(total);
        $('#show_taxes').val(_numberFormat(tax, 4));
        $('#txt_taxes').val(tax);
        $('#show_taxes2').val(_numberFormat(taxppn, 4));
        $('#txt_taxes2').val(taxppn);
        _calculatePayment();

        _html= '<tr>';
        _html+= '<td><div class="input-group input-group-sm">';
        _html+= '<input type="text" class="form-control form-control-sm" name="iproject_id[]"  value="' + code + '" id="temp_project_code" disabled="" >';
        _html+= '</div></td>';
        _html+= '<td>';
        _html+= '<input type="text" class="form-control form-control-sm" id="temp_project_date" disabled=""  value="' + name + '">';   
        _html+= '<input type="hidden" id="temp_txt_total" name="icustomer_id[]" value="' + cid + '">';
        _html+= '</td>';
        _html+= '<td>';
        _html+= '<input type="text" class="form-control form-control-sm" id="temp_project_vehicle" disabled=""  value="' + vname + '">';                
        _html+= '<input type="hidden" id="temp_txt_total" name="ivehicle_id[]" value="' + vid + '">';
        _html+= '</td>';
        _html+= '<td><input type="text" class="form-control form-control-sm text-right"  name="itaxes[]" id="temp_show_taxes" value="' + tax + '"></td>';
        _html+= '<td><input type="text" class="form-control form-control-sm text-right" id="temp_show_taxes2" name="itaxes2[]"  value="' + taxppn + '"></td>';
        _html+= '<td><input type="text" class="form-control form-control-sm text-right" id="temp_show_total"  name="itotal[]" disabled="" value="' + total + '"></td>';
        _html+= '<td><input type="text" class="form-control form-control-sm" id="temp_show_payment" name="ipayment[]"  value="' + payment + '"></td>';
        _html+= '<td><button type="submit" data-row-id="' + id + '" data-row-total="' + total + '" class="btn btn-sm btn-danger minusAdd"><i class="fa fa-minus"></i></button></td>';
        _html+= '</tr>';
        
        $('#temp_list').append(_html);
    });
    
	$('#dataProject').on('shown.bs.modal', function (e) {
        
		$('#project').DataTable({
			'processing': true,
			'serverSide': true,
			'stateSave': true,
			retrieve: true,
			'order': [],
			'ajax': {
				'url': "<?php echo site_url('finance/project_list') ?>",
				'type': 'POST',
				'data': {
                    'id': <?php echo $id ?>
				}
			},
			'columnDefs': [
				{
					'targets': [0,1,2,3,4],
					'orderable': false,
				},
			],
			dom: 'Blfrtip',
			lengthMenu: [10, 20, 50, 100, 200, 500],
			buttons: [
			],
		});
    });
    

    $('#frm').submit(function () {
        _msg = '';
        if ($('#txt_total').val() == '0') _msg += _TOTALEMPTY + '<br>';
        if (_msg) {
            $('#box_message').html(_msg); setTimeout(function () { $('#box_message').html(''); }, _APPLOADING);
        } else {
                    console.log(_msg);
            $.ajax({
                url: "<?php echo site_url('finance/api_projectpayment_save') ?>", 
                type: 'post', 
                dataType: 'json', 
                data: $(this).serialize(),
                success: function (_json) {
                    console.log(_json);
                    if (_json.status == 1) {
                        $('#box_message').html(_SAVED);
                        setTimeout(function () {
                            window.location = '/finance/projectpayment';
                        }, _APPLOADING);
                    } else {
                        $('#box_message').html(_FAILED);
                        setTimeout(function () {
                            $('#box_message').html('');
                        }, _APPLOADING);
                    }
                }
            });
        }
        return false;
    });
</script>