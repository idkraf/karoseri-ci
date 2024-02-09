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
                                <input id="txt_code" class="form-control" type="text" value="<?php echo $purchase['code'] ?>" placeholder="Auto" disabled>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label class="form-label">Tanggal</label>
                                <input id="txt_date" class="form-control" type="text" name="data[date]" data-toggle="datepicker" autocomplete="false">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label class="form-label">Supplier name</label>
                                <input type="text" class="form-control" id="txt_supplier_name" value="<?php echo $purchase['name'] ?>" disabled="">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div id="saman-row">
                <table id="box_list" class="table small table-bordered table-hover text-nowrap m-0">
                    <thead>
                        <tr class="bg-gray">
                            <th class="th-code2" id="th_code">Code</th>
                            <th id="th_date">Date</th>
                            <th class="th-total2" id="th_total">Total</th>
                            <th class="th-payment2" id="th_payment">Payment</th>
                            <th class="th-action1">&nbsp;</th>
                        </tr>                      
                        <tr>
                            <td class="p-1">
                                <input type="hidden" class="form-control" id="temp_purchase_id" name="data[purchase_id]" value="">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" id="temp_purchase_code" disabled="">
                                    <span class="input-group-append">
                                        <button type="button" id="btn_list" class="btn bg-gray btn-flat" 
                                        style="background-color:#6c757d;color:#fff" 
                                        data-toggle="modal" data-target="#dataPurchase">...</button>
                                    </span>
                                </div>
                            </td>
                            <td class="p-1"><input type="text" class="form-control" id="temp_purchase_date" disabled=""></td>
                            <td class="p-1">
                                <input type="text" class="form-control text-right" id="temp_show_total" disabled="">
                                <input type="hidden" id="temp_txt_total" name="data[total]" value="0">
                            </td>
                            <td class="p-1">
                                <input type="text" class="form-control" id="temp_show_payment">
                                <input type="hidden" id="temp_txt_payment" name="data[payment]" value="0">
                                <script>
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
                                </script>
                            </td>
                            <td class="p-1"><button type="button" class="btn btn-sm btn-danger showAdd"><i class="fa fa-plus"></i></button></td>
                        </tr>
                    </thead>

                    <tbody id="temp_list">  
                    </tbody>
                    <tbody>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                            <td id="lbl_total">Total</td>
                            <td class="th-total  text-right p-1">
                                <input type="text" class="form-control  text-right" id="show_total" disabled="">
                                <input type="hidden" id="txt_total" name="data[total]" value="0">
                            </td>
                            <td class="th-action1">&nbsp;</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                            <td id="lbl_total">Discount</td>
                            <td class="th-total2 p-1">
                                <input type="text" class="form-control text-right" id="show_discount">
                                <input type="hidden" id="txt_discount" name="data[discount]" value="0">
                                <script>
                                    $('#show_discount').focus(function () {
                                        if ($.isNumeric($('#txt_discount').val()) && $('#txt_discount').val() != 0) {
                                            $('#show_discount').val($('#txt_discount').val());
                                        } else
                                            $('#show_discount').val('');
                                    });
                                    $('#show_discount').keyup(function () {
                                        $('#txt_discount').val($('#show_discount').val());
                                        if (!$.isNumeric($('#txt_discount').val()))
                                            $('#txt_discount').val(0);
                                        _calculatePayment()
                                    });
                                    $('#show_discount').blur(function () {
                                        $('#show_discount').val(_numberFormat($('#txt_discount').val()));
                                        _calculatePayment()
                                    });
                                    function _calculatePayment(){
                                        _total = $('#txt_total').val();
                                        _discount = $('#txt_discount').val();
                                        _payment = _total - _discount;
                                        
                                        $('#show_payment').val(_numberFormat(_payment, 4));
                                    }
                                </script>
                            </td>
                            <td class="th-action1">&nbsp;</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>Account</td>
                            <td class=" p-1">
                            <select name="account_id" class="form-control">
                                <?php
                                    foreach ($account as $row) {
                                        $cid = $row['id'];
                                        $title = $row['name'];
                                        echo "<option value='$cid'>$title</option>";
                                    }
                                ?>
                            </select>
                            </td>
                            <td id="lbl_total">Total</td>
                            <td class="th-total  text-right p-1">
                                <input type="text" class="form-control  text-right" id="show_total" disabled="">
                                <input type="hidden" id="txt_total" name="data[total]" value="0">
                            </td>
                            <td class="th-action1">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label id="lbl_datedue">Datedue</label>
                    <input class="form-control" id="txt_datedue" name="data[datedue]" data-toggle="datepicker">
                </div>
                <div class="col-sm-3">
                    <label id="lbl_notes">Notes</label>
                    <input type="text" class="form-control" id="txt_notes" name="data[notes]">
                </div>
            </div>
            <input type="hidden" value="0" id="ganak">
            <input type="hidden" value="0" id="pid">
            <button type="submit" class="btn btn-sm btn-dark mt-2" id="_btn">Save</button>
        </form>
    </div>
</div>
<div class="modal fade" id="dataPurchase" role="dialog">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title">Cari Data Item</h4>
			</div>
			<div class="modal-body">
				<div id="div_student">
					<div class="box-body table-responsive">
						<table id="purchase" class="table table-hover no-footer">
							<thead>
								<tr>
									<th>Purchase#</th>
									<th></th>
									<th></th>
									<th>Supplier</th>
									<th>Datedue</th>
									<th>Total</th>
									<th>Payment</th>
									<th>Balance</th>
									<th></th>
								</tr>	
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>

    $('#dataPurchase').on('shown.bs.modal', function (e) {
        $(document).on('click', ".pilih-purchase", function (e) {
            var cvalue = parseInt($('#ganak').val()) + 1;
            var nxt = parseInt(cvalue);
            $('#ganak').val(nxt);
            $('#pid').val($(this).attr('data-view-id'));
            var functionNum = "'" + cvalue + "'";
            count = $('#temp_list tr').length;
            //console.log(functionNum + count);

            var id = $(this).attr('data-view-id');
            var name = $(this).attr('data-view-name');
            var date = $(this).attr('data-view-date');
            var duedate = $(this).attr('data-view-duedate');
            var kode = $(this).attr('data-view-code');
            var payment = $(this).attr('data-view-payment');
            var total = $(this).attr('data-view-total');

            var datax = '<tr><td class="p-1"> <input type="hidden" class="form-control" id="temp_purchase_id-' + cvalue + '" name="data[purchase_id]" value="'+id+'"><div class="input-group input-group-sm"><input type="text" class="form-control" id="temp_purchase_code" disabled=""  value="'+kode+'"></div></td><td class="p-1"><input type="text" class="form-control" id="temp_purchase_date-' + cvalue + '" disabled="" value="'+date+'"></td><td class="p-1"><input type="text" class="form-control text-right" id="temp_show_total-' + cvalue + '" disabled="" value="'+total+'"><input type="hidden" id="temp_txt_total" name="data[total]" value="0" value="'+total+'"></td><td class="p-1"><input type="text" class="form-control" id="temp_show_payment-' + cvalue + '"><input type="hidden" id="temp_txt_payment" name="data[payment]" value="'+payment+'"></td><td class="p-1"><button type="button"  data-rowid="' + cvalue + '" class="btn btn-sm btn-danger minusAdd"><i class="fa fa-minus"></i></button></td></tr>';
            
            $('#temp_list').append(datax);
        });
    });
    $('.showAdd').on('click', function () {    
        var cvalue = parseInt($('#ganak').val()) + 1;
        var nxt = parseInt(cvalue);
        $('#ganak').val(nxt);
        var functionNum = "'" + cvalue + "'";
        count = $('#temp_list tr').length;
        console.log(functionNum + count);
        var datax = '<tr><td class="p-1"><input type="hidden" class="form-control" id="temp_purchase_id-' + cvalue + '" name="data[purchase_id]" value=""><div class="input-group input-group-sm"><input type="text" class="form-control" id="temp_purchase_code" disabled=""><span class="input-group-append"><button type="button" id="btn_list" class="btn bg-gray btn-flat"  style="background-color:#6c757d;color:#fff" data-toggle="modal" data-target="#dataPurchase">...</button></span></div></td><td class="p-1"><input type="text" class="form-control" id="temp_purchase_date-' + cvalue + '" disabled=""></td><td class="p-1"><input type="text" class="form-control text-right" id="temp_show_tota-' + cvalue + '" disabled=""><input type="hidden" id="temp_txt_total" name="data[total]" value="0"></td><td class="p-1"><input type="text" class="form-control" id="temp_show_payment-' + cvalue + '"><input type="hidden" id="temp_txt_payment" name="data[payment]" value="0"></td><td class="p-1"><button type="button"  data-rowid="' + cvalue + '" class="btn btn-sm btn-danger minusAdd"><i class="fa fa-minus"></i></button></td></tr>';
        $('#temp_list').append(datax);
    });
        
    $('#temp_list').on('click', '.minusAdd', function () {
        
        var cvalue = parseInt($('#ganak').val()) - 1;
        var nxt = parseInt(cvalue);
        $('#ganak').val(nxt);
        $('#pid').val(0);
        
        count = $('#temp_list tr').length;
        //console.log(nxt + count);

        //for edit
        //var pidd = $(this).closest('tr').find('.pdIn').val();
        //var pqty = $(this).closest('tr').find('.amnt').val();
        //pqty = pidd + '-' + pqty;
        //$('<input>').attr({
        //    type: 'hidden',
        //    id: 'restock',
        //    name: 'restock[]',
        //    value: pqty
        //}).appendTo('form');
        $(this).closest('tr').remove();
        //$('#d' + $(this).closest('tr').find('.pdIn').attr('id')).closest('tr').remove();
        $('#show_total').each(function (index) {
            rowTotal(index);
            //billUpyog();
        });

        return false;
    });
    
    var rowTotal = function (numb) {
        console.log(numb);
    }
    
    $(document).on('click', ".pilih-produk", function (e) {        
        $('#txt_item_id').val($(this).attr('data-object-pid'));
        $('#txt_item_code').val($(this).attr('data-object-code'));
        $('#txt_item_name').val($(this).attr('data-object-nama'));
        $('#txt_pricebig').val($(this).attr('data-object-pricebig'));
        $('#txt_disc').val($(this).attr('data-object-disc'));
        $('#txt_tax').val($(this).attr('data-object-tax'));

    });
    
	$('#dataPurchase').on('shown.bs.modal', function (e) {
        
        pid =  $('#pid').val();
        console.log(pid);
		$('#purchase').DataTable({
			'processing': true,
			'serverSide': true,
			'stateSave': true,
			destroy: true,
			'order': [],
			'ajax': {
				'url': "<?php echo site_url('finance/purchase_list') ?>",
				'type': 'POST',
				'data': {
                    'pid': pid
				}
			},
			'columnDefs': [
				{
					'targets': [0,1,2,3,4,5,6,7,8],
					'orderable': false,
				},
			],
			dom: 'Blfrtip',
			lengthMenu: [10, 20, 50, 100, 200, 500],
			buttons: [
			],
		});
    });
    $(document).ready(function () { 
        //$('#lbl_item').html(_ITEM);
        //$('#lbl_size').html(_SIZE);
        //$('#lbl_pricebig').html(_PRICE);
        //$('#lbl_big').html(_QTY);
        //$('#lbl_disc').html(_DISC);
        //$('#lbl_tax').html(_TAX);
        //$('#lbl_subtotal').html(_SUBTOTAL);
        $('#txt_purchase_id').val($('#txt_id').val());
        
        //tempLoading();
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
        //resetItem();
        //$("#modal_list").html('');
        //$("#modal_list").load('/purchase/purchase_item');
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
                        if (_json.status == 1) { 
                            _msgSuccess(_DELETED); 
                           // tempLoading(); 
                        }
                        else _msgError(_FAILED);
                    }
                });
            }
        });
        return false;
    }
    $('#frmTemp_').submit(function () {
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
                       // tempLoading();
                    }
                }
            });
        }
        return false;
    });
</script>