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
                                <label class="form-label">Supplier name</label>
                                <input type="text" class="form-control" id="txt_supplier_name" disabled="">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap">
                    <thead>
                        <tr class="bg-gray">
                            <th class="th-code2" id="th_code">Code</th>
                            <th id="th_job">Job</th>
                            <th class="th-total2" id="th_total">Total</th>
                            <th class="th-payment2" id="th_payment">Payment</th>
                            <th class="th-action1">&nbsp;</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" class="form-control form-control-sm" id="temp_projectstaff_id" name="data[projectstaff_id]" value="">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm" id="temp_projectstaff_code" disabled="">
                                    <span class="input-group-append">
                                        <button type="button" id="btn_list" onclick="showProjectstaff(); return false;" class="btn bg-gray btn-flat" data-toggle="modal" data-target="#box_modal">...</button>
                                    </span>
                                </div>
                            </td>
                            <td><input type="text" class="form-control form-control-sm" id="temp_job_name" disabled=""></td>
                            <td>
                                <input type="text" class="form-control form-control-sm text-right" id="temp_show_total" disabled="">
                                <input type="hidden" id="temp_txt_total" name="data[total]" value="0">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" id="temp_show_payment">
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
                                        $('#temp_show_payment').val(_numberFormat($('#temp_txt_payment').val()));
                                    });
                                </script>
                            </td>
                            <td><button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i></button></td>
                        </tr>
                    </thead>
                    <tbody id="temp_list"><tr><td>RSTA23110800001</td><td>BBN n KEUR</td><td class="text-right">3,593,000</td><td class="text-right">3,593,000</td><td class="small"><button class="btn btn-sm btn-danger" onclick="tempDelete('c069434c71daf733e093d91a7a7628d6'); return false;"><i class="fa fa-minus fa-sm"></i></button></td></tr></tbody>
                </table>
            </div>
            <table class="table small table-bordered table-hover text-nowrap m-0">
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
                <tbody>
                    <tr>
                        <td colspan="5">&nbsp;</td>
                        <td id="lbl_total">Discount</td>
                        <td class="th-total2">
                            <input type="text" class="form-control form-control-sm text-right" id="show_discount">
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
                        <td colspan="1">&nbsp;</td>
                        <td>Account</td>
                        <td class=" p-1">
                            <select id="txt_account_id" name="data[account_id]" class="form-control form-control-sm">
                                <option value="e4db4fc1ef9ae443ced49d00f2192445">11101 - Kas Kecil</option>
                                <option value="52c4608c2f126708211b9e0a60eaf050">11102 - Kas Besar</option>
                                <option value="fb25b181bed28630afa6c026a6ed31fe">11106 - Kas Pemilik</option>
                                <option value="dc1d3cb9517bda57aacd65f5b1986c6e">11201 - Bank BCA CV</option>
                                <option value="fe998b49c41c4208c968bce204fa1cbb">11202 - Bank Mandiri CV</option>
                                <option value="44f9537edcc4c4065a1bf6062317026a">11203 - Bank BCA Handoko</option>
                                <option value="99f8339daa3af68c61f1eaa734f16561">11204 - Bank BRI</option>
                                <option value="444e1948854f9a50730f1a6da6b89251">11205 - Giro Mandiri</option>
                                <option value="45f17bfcfd539631fb7ab14f99de1f10">11206 - Konsumen Pemerintah</option>
                            </select>
                        </td>
                        <td id="lbl_total">Total</td>
                            <td class="th-total2">
                                <input type="text" class="form-control form-control-sm text-right" id="show_payment" disabled="">
                            </td>
                        <td class="th-action1">&nbsp;</td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
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

<div class="modal fade" id="dataStaff" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title">Cari Data Item</h4>
			</div>
			<div class="modal-body">
				<div id="div_student">
					<div class="box-body table-responsive">
						<table id="staff" class="table table-hover no-footer">
							<thead>
								<tr>
									<th>#</th>
									<th>Code</th>
									<th>Job</th>
									<th>Staff</th>
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
    
    $(document).on('click', ".pilih-staff", function (e) {        
       // $('#txt_staff_id').val($(this).attr('data-object-pid'));

    });
    
	$('#dataStaff').on('shown.bs.modal', function (e) {
        
		$('#staff').DataTable({
			'processing': true,
			'serverSide': true,
			'stateSave': true,
			retrieve: true,
			'order': [],
			'ajax': {
				'url': "<?php echo site_url('finance/project_staff_list') ?>",
				'type': 'POST',
				'data': {
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
    
</script>
<script>
    $(document).ready(function () { localStorage.setItem('router', '/finance/projectstaffpayment_edit'); ajaxLoading(); });

    function pageControll() {
        $.ajax({
            url: '/finance/api_projectstaffpayment_edit', type: 'post', dataType: 'json', data: {'tID': localStorage.getItem('tID'), 'id': localStorage.getItem('_id')},
            success: function (_json) {
                if (_json.status == 1) {
                    $('#_body').show();
                    $('#_caption').html(_PAYMENT);
                    $('#_module').html(_FINANCE);
                    $('#_title').html(_PAYMENT);
                    $('#_event').html(_EDIT);

                    $('#lbl_code').html('#');
                    $('#lbl_date').html(_DATE);
                    $('#lbl_staff').html(_STAFF);
                    $('#lbl_datedue').html(_DATEDUE);
                    $('#lbl_notes').html(_NOTES);
                    $('#lbl_total').html(_TOTAL);
                    $('#lbl_discount').html(_DISCOUNT);
                    $('#lbl_payment').html(_PAYMENT);
                    $('#lbl_account').html(_ACCOUNT);
                    $('#_btn').html(_SAVE);
                    
                    $('#txt_account_id').html('');
                    $.each(_json._account, function (_i, _arr) {
                        _html = '<option value="' + _arr.id + '">' + _arr.code + ' - ' + _arr.name + '</option>';
                        $('#txt_account_id').append(_html);
                    });

                    $('#txt_tID').val(localStorage.getItem('tID'));
                    $('#txt_staff_id').val(_json.data.staff_id);
                    $('#txt_id').val(_json.data.id);
                    $('#txt_code').val(_json.data.code);
                    $('#txt_date').val(_json.data.date);
                    $('#txt_staff_name').val(_json.data.staff_name);
                    $('#txt_datedue').val(_json.data.datedue);
                    $('#show_discount').val(0);
                    $('#txt_discount').val(0);

                    $("#box_temp").load('/finance/projectstaffpaymenttemp');
                }
            }
        });
    }

    $('#frm').submit(function () {
        _msg = '';
        if ($('#txt_total').val() == '0') _msg += _TOTALEMPTY + '<br>';
        if (_msg) {
            $('#box_message').html(_msg); setTimeout(function () { $('#box_message').html(''); }, _APPLOADING);
        } else {
            $.ajax({
                url: '/finance/api_projectstaffpayment_update', type: 'post', dataType: 'json', data: $(this).serialize(),
                success: function (_json) {
                    if (_json.status == 1) {
                        $('#box_message').html(_SAVED);
                        setTimeout(function () {
                            window.location = '/finance/projectstaffpayment';
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