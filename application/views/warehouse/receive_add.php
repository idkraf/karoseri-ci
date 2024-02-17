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
            <input type="hidden" id="txt_id" name="id" value="<?php echo $purchase['id'] ?>">
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
                                <input id="txt_date" class="form-control" type="text" name="date" data-toggle="datepicker">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label class="form-label">Purchase#</label>
                                <input class="form-control" type="text" value="<?php echo $purchase['code'] ?>" disabled>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label class="form-label">Supplier name</label>
                                <input type="text" class="form-control" value="<?php echo $purchase['name'] ?>" disabled="">
                                <input type="hidden" value="0" id="ganak">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table id="box_list" class="table small table-bordered table-hover text-nowrap m-0">
                <thead>
                    <tr class="bg-gray">
                        <th class="th-code2" id="lbl_item_code">Item#</th>
                        <th id="lbl_item">Item</th>
                        <th class="th-size2" id="lbl_size">Size</th>
                        <th class="th-qty2" id="lbl_rcvbig">Stock In</th>
                        <th class="th-action1">&nbsp;</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" class="form-control" id="txt_purchasedetail_id" value="">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="txt_item_code" disabled="">
                                <span class="input-group-append">
                                    <button type="button" id="btn_list" 
                                    class="btn bg-gray btn-flat" 
                                    style="background-color:#6c757d;color:#fff" 
                                        data-toggle="modal" data-target="#dataProduk">...</button>
                                </span>
                            </div>
                        </td>
                        <td><input type="text" class="form-control" id="txt_item_name" disabled=""></td>
                        <td><input type="text" class="form-control text-right" id="show_size" disabled=""></td>
                        <td>
                            <input type="text" class="form-control" id="show_rcvbig">
                            <input type="hidden" id="txt_rcvbig" value="0">
        
                        </td>
                        <td><button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i></button></td>
                    </tr>
                </thead>

                <tbody id="temp_list"></tbody>                
                <tbody>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td id="lbl_total">Total</td>
                        <td class="th-total  text-right p-1">
                            <input type="text" class="form-control  text-right" id="show_total" disabled="">
                            <input type="hidden" id="txt_total" name="total" value="0">
                        </td>
                        <td class="th-action1">&nbsp;</td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-3">
                    <label id="lbl_code">Code</label>
                    <input type="text" class="form-control form-control-sm" id="txt_code2" name="code2">
                </div>
                <div class="col-sm-3">
                    <label id="lbl_notes">Notes</label>
                    <input type="text" class="form-control form-control-sm" id="txt_notes" name="notes">
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-dark mt-2" id="_btn">Save</button>
        </form>
    </div>
</div>

<div class="modal fade" id="dataProduk" role="dialog">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title">Cari Data Item</h4>
			</div>
			<div class="modal-body">
				<div id="div_student">
					<div class="box-body table-responsive">
						<table id="produk" class="table table-hover no-footer">
							<thead>
                                <tr>
                                    <th class="th-code" id="th_item_code">Item#</th>
                                    <th id="th_category">Category</th>
                                    <th id="th_item">Item</th>
                                    <th class="th-qty" id="th_size">Size</th>
                                    <th class="th-qty" id="th_big">Purchase</th>
                                    <th class="th-qty" id="th_rcvbig">Stock In</th>
                                    <th class="th-qty" id="th_indent">Indent</th>
                                    <th class="th-action1"></th>
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
    
    $('#dataProduk').on('shown.bs.modal', function (e) {
        $(document).on('click', ".pilih-produk", function (e) {

            var cvalue = parseInt($('#ganak').val()) + 1;
            var nxt = parseInt(cvalue);
            $('#ganak').val(nxt);
            
            var id = $(this).attr('data-view-id');
            var code = $(this).attr('data-view-code');
            var cname = $(this).attr('data-view-cname');
            var iname = $(this).attr('data-view-iname');
            
            var size = $(this).attr('data-view-size');
            var purchase = $(this).attr('data-view-purchase');
            var stockin = $(this).attr('data-view-stockin');
            var indent = $(this).attr('data-view-indent');

            
            var datax = '<tr><td>';
            datax += '<input type="hidden" class="form-control form-control-sm" name="item[id]" value="'+id+'">';
            datax += '<div class="input-group input-group-sm">';
            datax += '<input type="text" class="form-control form-control-sm" value="'+code+'" disabled="">';
            datax += '</div></td>';
            datax += '<td><input type="text" class="form-control form-control-sm" value="'+iname+'" disabled=""></td>';
            datax += '<td><input type="text" class="form-control form-control-sm text-right"  value="'+size+'" disabled=""></td>';
            datax += '<td><input type="text" class="form-control form-control-sm" name="stokin[rcvbig]" value="'+indent+'"></td>';
            datax += '<td><button data-rowid="' + cvalue + '" class="btn btn-sm btn-danger minusAdd"><i class="fa fa-minus"></i></button></td></tr>';
            
            $('#temp_list').append(datax);

        });
        
    });
    
        
    $('#temp_list').on('click', '.minusAdd', function () {
        
        var cvalue = parseInt($('#ganak').val()) - 1;
        var nxt = parseInt(cvalue);
        $('#ganak').val(nxt);
        //$('#pid').val(0);
        
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
	$('#dataProduk').on('shown.bs.modal', function (e) {
        
		$('#produk').DataTable({
			'processing': true,
			'serverSide': true,
			'stateSave': true,
			retrieve: true,
			'order': [],
			'ajax': {
				'url': "<?php echo site_url('warehouse/purchase_product_list') ?>",
				'type': 'POST',
				'data': {
                    'tid': <?php echo $id ?>,
                    '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
				}
			},
			'columnDefs': [
				{
					'targets': [0,1,2,3,4,5,6,7],
					'orderable': false,
				},
			],
			dom: 'Blfrtip',
			lengthMenu: [10, 20, 50, 100, 200, 500],
			buttons: [
			],
		});
    });

    
    $('#show_rcvbig').focus(function () {
        if ($.isNumeric($('#txt_rcvbig').val()) && $('#txt_rcvbig').val() != 0) {
            $('#show_rcvbig').val($('#txt_rcvbig').val());
        } else
            $('#show_rcvbig').val('');
    });
    $('#show_rcvbig').keyup(function () {
        $('#txt_rcvbig').val($('#show_rcvbig').val());
        if (!$.isNumeric($('#txt_rcvbig').val()))
            $('#txt_rcvbig').val(0);
    });
    $('#show_rcvbig').blur(function () {
        $('#show_rcvbig').val(_numberFormat($('#txt_rcvbig').val(), 3));
    });
</script>