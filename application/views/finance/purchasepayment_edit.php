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
                                <input id="txt_code" class="form-control" type="text" placeholder="Auto" value="<?php echo $purchase['ppcode'] ?>" disabled>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label class="form-label">Tanggal</label>
                                <input id="txt_date" class="selectpicker form-select rounded-0 teal" type="text" name="data[date]" value="<?php echo $purchase['pdate'] ?>" data-toggle="datepicker">
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
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap">                    
                    <thead>
                        <tr class="bg-gray">
                            <th class="th-code2" id="th_code">Code</th>
                            <th id="th_date">Date</th>
                            <th class="th-total2" id="th_total">Total</th>
                            <th class="th-payment2" id="th_payment">Payment</th>
                            <th class="th-action1">&nbsp;</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" class="form-control" id="temp_purchase_id" name="data[purchase_id]" value="">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" id="temp_purchase_code" disabled="">
                                    <span class="input-group-append">
                                        <button type="button" id="btn_list" class="btn bg-gray btn-flat" 
                                        style="background-color:#6c757d;color:#fff" 
                                        data-toggle="modal" data-target="#dataProject">...</button>
                                    </span>
                                </div>
                            </td>
                            <td><input type="text" class="form-control" id="temp_purchase_date" disabled=""></td>
                            <td>
                                <input type="text" class="form-control text-right" id="temp_show_total" disabled="">
                                <input type="hidden" id="temp_txt_total" name="data[total]" value="0">
                            </td>
                            <td>
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
                            <td><button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i></button></td>
                        </tr>
                    </thead>
                    <tbody id="_list"></tbody>
                </table>
            </div>
            </form>
            <div class="row mt-0">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td colspan="5" >&nbsp;</td>
                                <td class="text-bold text-end" id="lbl_total">Total</td>
                                <td class="th-total2 ps-1 pe-1" style="width:180px">
                                    <input type="text" class="form-control form-control-sm text-end" id="show_total" disabled=""  value="<?php echo $purchase['ptotal'] ?>">
                                    <input type="hidden" id="txt_total" name="data[total]"  value="<?php echo $purchase['ptotal'] ?>">
                                </td>
                                <td class="th-action1">&nbsp;</td>
                            </tr>
                            <!--tr>
                                <td colspan="5" >&nbsp;</td>
                                <td class="text-bold text-end">Tax #1</td>
                                <td class="th-total2 ps-1 pe-1">
                                    <input type="text" class="form-control form-control-sm text-end" id="show_taxes" disabled="">
                                    <input type="hidden" id="txt_taxes" name="data[taxes]" value="0">
                                </td>
                                <td class="th-action1">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="5" >&nbsp;</td>
                                <td class="text-bold text-end">Tax #2</td>
                                <td class="th-total2 ps-1 pe-1">
                                    <input type="text" class="form-control form-control-sm text-end" id="show_taxes2" disabled="">
                                    <input type="hidden" id="txt_taxes2" name="data[taxes2]" value="0">
                                </td>
                                <td class="th-action1">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="5" >&nbsp;</td>
                                <td class="text-bold text-end" id="lbl_cost">Cost</td>
                                <td class="th-total2 ps-1 pe-1">
                                    <input type="text" class="form-control form-control-sm text-end" id="show_cost">
                                    <input type="hidden" id="txt_cost" name="data[cost]" value="0">
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
                                            _calculatePayment()
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
                                    </script>
                                </td>
                                <td class="th-action1">&nbsp;</td>
                            </tr-->
                            <tr>
                                <td colspan="5" >&nbsp;</td>
                                <td class="text-bold text-end" id="lbl_discount">Discount</td>
                                <td class="th-total2 ps-1 pe-1">
                                    <input type="text" class="form-control form-control-sm text-right" id="show_discount" value="<?php echo $purchase['diskon'] ?>">
                                    <input type="hidden" id="txt_discount" name="data[discount]" value="<?php echo $purchase['diskon'] ?>">
                                    <script>
                                        $('#show_discount').focus(function () {
                                            if ($.isNumeric($('#txt_discount').val()) && $('#txt_discount').val() != 0) {
                                                $('#show_discount').val($('#txt_discount').val());
                                            } else
                                                $('#show_discount').val('');
                                        });
                                        $('#show_discount').keyup(function () {
                                            $('#txt_discount').val($('#show_discount').val());
                                            if (!$.isNumeric($('#txt_discount').val())) $('#txt_discount').val(0);
                                            _calculatePayment()
                                        });
                                        $('#show_discount').blur(function () {
                                            $('#show_discount').val(_numberFormat($('#txt_discount').val(), 4));
                                            _calculatePayment()
                                        });
                                    </script>
                                </td>
                                <td class="th-action1">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                                <td class="text-bold text-end" id="lbl_account">Account</td>
                                <td>
                                    <select id="txt_account_id" name="data[account_id]" class="selectpicker form-select rounded-0 teal">
                                    <?php
                                        foreach ($account as $row) {
                                            $cid = $row['id'];
                                            $title = $row['name'];
                                            $selek = '';
                                            if($purchase['account_id'] == $cid) {
                                                $selek = 'selected';
                                            }
                                            echo "<option value='$cid' $selek >$title</option>";
                                        }
                                    ?>
                                    </select>
                                </td>
                                <td class="text-bold text-end" id="lbl_payment">Payment</td>
                                <td class="th-total2 ps-1 pe-1">
                                    <input type="text" class="form-control text-right" id="show_payment" disabled="" value="<?php echo $purchase['ppayment'] ?>">
                                </td>
                                <td class="th-action1">&nbsp;</td>
                            </tr>
                        </tbody></table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label id="lbl_datedue">Datedue</label>
                    <input class="selectpicker form-select rounded-0 teal" data-toggle="datepicker" id="txt_datedue" name="data[datedue]">
                </div>
                <div class="col-sm-3">
                    <label id="lbl_notes">Notes</label>
                    <input type="text" class="form-control" id="txt_notes" name="data[notes]" value="<?php echo $purchase['notes'] ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-dark mt-2" id="_btn">Save</button>
        </form>
    </div>
</div>
<div class="modal fade" id="dataProject" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-gray-light p-1" id="modal_list"><div class="modal-header bg-gray">
            <h5 class="modal-title" id="list_caption">Cari Data Purchase</h5>
            <button class="close" data-dismiss="modal" aria-label="Close" id="btn_close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="frmList" role="form" class="form-inline">
                <input type="hidden" id="list_tID" name="data[tID]" value="">
                <input type="hidden" id="list_customer_id" name="data[customer_id]" value="">
            </form>
            <div class="row mt-2">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table id="project" class="table small table-bordered table-hover text-nowrap m-0">
                            <thead class="bg-gray">
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
                            <tbody id="_list"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('#list_caption').html(_PROJECT);
                $('#th_project_code').html(_PROJECTCODE);
                $('#th_code').html(_CODE);
                $('#th_date').html(_DATE);
                $('#th_customer').html(_CUSTOMER);
                $('#th_vehicle').html(_VEHICLE);
                $('#th_datedue').html(_DATEDUE);
                $('#th_total').html(_TOTAL);
                $('#th_payment').html(_PAYMENT);
                $('#th_balance').html(_BALANCE);
                
                $('#list_tID').val(localStorage.getItem('tID'));
                $('#list_customer_id').val($('#txt_customer_id').val());
                listChange();
            });

            function listChange() { $('#frmList').submit(); }

            $('#frmList').submit(function () {
                $.ajax({
                    url: "/finance/api_purchasepayment_project", type: "post", dataType: "json", data: $(this).serialize(),
                    success: function (_json) {
                        if (_json.status == 1) {
                            $('#_list').html('');
                            
                            $.each(_json.data, function (_i, _arr) {
                                _html= '<tr>';
                                _html+= '<td>' + _arr.code + '</td>';
                                _html+= '<td class="text-right">' + _numberFormat(_arr.total, 4) + '</td>';
                                _html+= '<td class="text-right">' + _numberFormat(_arr.payment, 4) + '</td>';
                                _html+= '<td class="small">';
                                _html+= '<button class="btn btn-sm btn-warning">';
                                _html+= '<i class="fa fa-minus"></i>';
                                _html+= '</button>';
                                _html+= '</td>';
                                _html+= '</tr>';
                                $('#_list').append(_html);
                            });
                        }
                    }
                });
                return false;
            });

            function pickList(_id) {
                $('#temp_project_id').val(_id);
                searchProject();
                $('#btn_close').click();
            }
        </script>
        </div>
    </div>
</div>
<script>
    
    $(document).on('click', ".pilih-project", function (e) {        
        //$('#txt_item_id').val($(this).attr('data-object-pid'));

    });
    
	$('#dataProject').on('shown.bs.modal', function (e) {
        
		$('#project').DataTable({
			'processing': true,
			'serverSide': true,
			'stateSave': true,
			retrieve: true,
			'order': [],
			'ajax': {
				'url': "<?php echo site_url('finance/purchase_list') ?>",
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